<?php
// register.php
session_start();
require_once 'includes/db.php';
require_once 'includes/mailer.php';

// Fetch workflow settings
$rawSettings = $pdo->query("SELECT * FROM settings")->fetchAll();
$settings = [];
foreach($rawSettings as $s) {
    $settings[$s['setting_key']] = $s['setting_value'];
}
$verify_enabled = ($settings['enable_registration_verification'] ?? '1') === '1';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? 'client'; // default to client
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($email) || (!$verify_enabled && empty($password))) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Check if email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Email is already registered.";
        } else {
            if ($verify_enabled) {
                // VERIFICATION ENABLED (Original Flow)
                $token = bin2hex(random_bytes(32));
                $stmt = $pdo->prepare("INSERT INTO users (name, email, role, is_verified, verification_token) VALUES (?, ?, ?, 0, ?)");
                
                if ($stmt->execute([$name, $email, $role, $token])) {
                    $stmt_tmpl = $pdo->prepare("SELECT subject, body FROM email_templates WHERE template_name = 'verification'");
                    $stmt_tmpl->execute();
                    $tmpl = $stmt_tmpl->fetch();
                    
                    $verifyLink = "http://" . $_SERVER['HTTP_HOST'] . "/verify.php?token=" . $token;
                    
                    if ($tmpl) {
                        $subject = $tmpl['subject'];
                        $body = str_replace(['{name}', '{verification_link}'], [$name, $verifyLink], $tmpl['body']);
                    } else {
                        $subject = "Verify your Grovixo Account";
                        $body = "Hello $name,\n\nPlease click the link to verify your account and set a password:\n$verifyLink";
                    }
                    
                    if (sendMail($email, $subject, $body)) {
                        $success = "Registration successful! A verification email has been sent to $email.";
                    } else {
                        $error = "Registered, but failed to send verification email. Please contact support.";
                    }
                } else {
                    $error = "Registration failed. Please try again.";
                }
            } else {
                // VERIFICATION DISABLED (Auto-Verify)
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, is_verified) VALUES (?, ?, ?, ?, 1)");
                if ($stmt->execute([$name, $email, $hashedPassword, $role])) {
                    $success = "Registration successful! You can now log in.";
                } else {
                    $error = "Registration failed. Please try again.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Grovixo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
        <h1 class="text-2xl font-bold mb-6 text-center text-slate-800">Register</h1>
        
        <?php if ($error): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="bg-green-50 text-green-600 p-3 rounded mb-4 text-sm"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                <input type="text" name="name" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                <input type="email" name="email" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Account Type</label>
                <select name="role" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500">
                    <option value="client">Client</option>
                    <option value="member">Team Member</option>
                </select>
            </div>
            <?php if (!$verify_enabled): ?>
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
            </div>
            <?php endif; ?>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition">Register</button>
        </form>
        <p class="mt-4 text-center text-sm text-slate-500">Already have an account? <a href="login.php" class="text-blue-600 font-bold">Login</a></p>
    </div>
</body>
</html>
