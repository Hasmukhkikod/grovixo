<?php
// verify.php
session_start();
require_once __DIR__ . '/includes/db.php';

$error = '';
$success = '';
$token = $_GET['token'] ?? '';

if (empty($token)) {
    die("Invalid verification link.");
}

// Check token
$stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE verification_token = ? AND is_verified = 0");
$stmt->execute([$token]);
$user = $stmt->fetch();

if (!$user) {
    die("Invalid or expired verification link.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (empty($password) || empty($confirm)) {
        $error = "Please fill in all fields.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Hash and update
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ?, is_verified = 1, verification_token = NULL WHERE id = ?");
        
        if ($stmt->execute([$hashed, $user['id']])) {
            $_SESSION['flash_msg'] = "Password set successfully! Please login.";
            header("Location: login.php");
            exit;
        } else {
            $error = "Failed to set password. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password - Grovixo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
        <h1 class="text-2xl font-bold mb-2 text-center text-slate-800">Set Your Password</h1>
        <p class="text-center text-slate-500 mb-6 text-sm">Welcome, <?= htmlspecialchars($user['name']) ?>!</p>
        
        <?php if ($error): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">New Password</label>
                <input type="password" name="password" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                <input type="password" name="confirm_password" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition">Set Password & Login</button>
        </form>
    </div>
</body>
</html>
