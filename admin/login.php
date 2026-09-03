<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/mailer.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$error = '';
$otpEmail = $_SESSION['admin_otp_email'] ?? null;
$otpExpires = $_SESSION['admin_otp_expires'] ?? 0;
$step = ($otpEmail && time() <= $otpExpires) ? 'otp' : 'credentials';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!hash_equals($csrf_token, $_POST['csrf_token'] ?? '')) {
        $error = "Your session expired. Please try again.";
        $step = 'credentials';
        unset($_SESSION['admin_otp_id'], $_SESSION['admin_otp_email'], $_SESSION['admin_otp_hash'], $_SESSION['admin_otp_expires']);
    } elseif (isset($_POST['login_step'])) {
        // Step 1: verify email + password, then email a one-time code.
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = "Email and password are required.";
        } else {
            $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = ? AND role = 'admin'");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $_SESSION['admin_otp_id'] = $user['id'];
                $_SESSION['admin_otp_email'] = $user['email'];
                $_SESSION['admin_otp_hash'] = password_hash($otp, PASSWORD_DEFAULT);
                $_SESSION['admin_otp_expires'] = time() + 600; // 10 minutes

                $sent = sendMail(
                    $user['email'],
                    "Your Grovixo Admin Login Code",
                    "Hello " . ($user['name'] ?: 'Admin') . ",\n\nYour admin login verification code is: $otp\n\nThis code expires in 10 minutes. If you did not request this, you can ignore this email."
                );

                if ($sent) {
                    $step = 'otp';
                } else {
                    $error = "Could not send the verification email. Check the SMTP settings and try again.";
                    unset($_SESSION['admin_otp_id'], $_SESSION['admin_otp_email'], $_SESSION['admin_otp_hash'], $_SESSION['admin_otp_expires']);
                }
            } else {
                $error = "Invalid email or password.";
            }
        }
    } elseif (isset($_POST['verify_otp'])) {
        // Step 2: verify the emailed code.
        $code = trim($_POST['otp_code'] ?? '');
        $pendingId = $_SESSION['admin_otp_id'] ?? null;
        $expires = $_SESSION['admin_otp_expires'] ?? 0;
        $hash = $_SESSION['admin_otp_hash'] ?? '';

        if (!$pendingId || time() > $expires) {
            $error = "Verification code expired. Please log in again.";
            $step = 'credentials';
            unset($_SESSION['admin_otp_id'], $_SESSION['admin_otp_email'], $_SESSION['admin_otp_hash'], $_SESSION['admin_otp_expires']);
        } elseif ($code !== '' && password_verify($code, $hash)) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $pendingId;
            unset($_SESSION['admin_otp_id'], $_SESSION['admin_otp_email'], $_SESSION['admin_otp_hash'], $_SESSION['admin_otp_expires']);
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid verification code.";
            $step = 'otp';
        }
    } elseif (isset($_POST['cancel_otp'])) {
        unset($_SESSION['admin_otp_id'], $_SESSION['admin_otp_email'], $_SESSION['admin_otp_hash'], $_SESSION['admin_otp_expires']);
        $step = 'credentials';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
        <?php if ($step === 'otp'): ?>
            <h1 class="text-2xl font-bold mb-2 text-center text-slate-800">Check Your Email</h1>
            <p class="text-center text-slate-500 mb-6 text-sm">Enter the 6-digit code sent to <?= htmlspecialchars($_SESSION['admin_otp_email']) ?>.</p>

            <?php if ($error): ?>
                <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Verification Code</label>
                    <input type="text" name="otp_code" inputmode="numeric" maxlength="6" autofocus class="w-full border border-slate-300 rounded px-3 py-2 text-center text-lg tracking-[0.5em] outline-none focus:border-blue-500" required>
                </div>
                <button type="submit" name="verify_otp" class="w-full bg-slate-800 text-white font-bold py-2 rounded hover:bg-slate-900 transition">Verify & Login</button>
            </form>
            <form method="POST" action="login.php" class="mt-3">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                <button type="submit" name="cancel_otp" class="w-full text-center text-sm text-slate-500 hover:text-slate-700 py-1">Use a different account</button>
            </form>
        <?php else: ?>
            <h1 class="text-2xl font-bold mb-6 text-center text-slate-800">Admin Login</h1>

            <?php if ($error): ?>
                <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
                </div>
                <button type="submit" name="login_step" class="w-full bg-slate-800 text-white font-bold py-2 rounded hover:bg-slate-900 transition">Continue</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
