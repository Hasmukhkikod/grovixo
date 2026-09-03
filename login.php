<?php
// login.php
session_start();
require_once __DIR__ . '/includes/db.php';

if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['user_role'] ?? '';
    if ($role === 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    } elseif ($role === 'member') {
        header("Location: member_dashboard.php");
        exit;
    } elseif ($role === 'client') {
        header("Location: client_dashboard.php");
        exit;
    } else {
        session_unset();
        session_destroy();
        session_start();
    }
}

$error = '';
$success = $_SESSION['flash_msg'] ?? '';
unset($_SESSION['flash_msg']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
    } else {
        $stmt = $pdo->prepare("SELECT id, name, password, role, is_verified FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['is_verified'] == 0) {
                $error = "Please verify your email before logging in.";
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                
                // Also set legacy admin session just in case
                if ($user['role'] === 'admin') {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $user['id'];
                    header("Location: admin/dashboard.php");
                } elseif ($user['role'] === 'member') {
                    header("Location: member_dashboard.php");
                } else {
                    header("Location: client_dashboard.php");
                }
                exit;
            }
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grovixo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
        <h1 class="text-2xl font-bold mb-6 text-center text-slate-800">Login to Grovixo</h1>
        
        <?php if ($error): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="bg-green-50 text-green-600 p-3 rounded mb-4 text-sm"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-slate-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-slate-800 text-white font-bold py-2 rounded hover:bg-slate-900 transition">Login</button>
        </form>
        <p class="mt-4 text-center text-sm text-slate-500">Don't have an account? <a href="register.php" class="text-blue-600 font-bold">Register</a></p>
    </div>
</body>
</html>
