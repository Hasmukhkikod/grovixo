<?php
// client_dashboard.php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
    header("Location: login.php");
    exit;
}

$client_id = $_SESSION['user_id'];
$client_name = $_SESSION['user_name'];

$projects = $pdo->prepare("SELECT * FROM projects WHERE client_id = ? ORDER BY created_at DESC");
$projects->execute([$client_id]);
$projects = $projects->fetchAll();

$domains = $pdo->prepare("SELECT * FROM domains WHERE client_id = ? ORDER BY expiry_date ASC");
$domains->execute([$client_id]);
$domains = $domains->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - Grovixo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen">
    <nav class="bg-white shadow-sm px-6 py-4 flex justify-between items-center mb-8">
        <h1 class="font-bold text-xl text-slate-800">Client Portal</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm text-slate-500">Welcome, <?= htmlspecialchars($client_name) ?></span>
            <a href="admin/logout.php" class="text-sm font-medium text-red-600 hover:text-red-800">Logout</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 pb-20">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Projects -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                <h2 class="text-lg font-bold mb-4">Your Projects</h2>
                <div class="space-y-4">
                    <?php if (!$projects): ?>
                        <p class="text-slate-500 text-sm">No active projects.</p>
                    <?php endif; ?>
                    <?php foreach ($projects as $p): ?>
                        <div class="p-4 border border-slate-100 rounded bg-slate-50">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-slate-800"><?= htmlspecialchars($p['name']) ?></h3>
                                <span class="px-2 py-1 text-xs font-bold uppercase rounded bg-blue-100 text-blue-700"><?= htmlspecialchars($p['status']) ?></span>
                            </div>
                            <p class="text-sm text-slate-600"><?= htmlspecialchars($p['description']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Domains & Hosting -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                <h2 class="text-lg font-bold mb-4">Domains & Hosting</h2>
                <div class="space-y-4">
                    <?php if (!$domains): ?>
                        <p class="text-slate-500 text-sm">No registered domains.</p>
                    <?php endif; ?>
                    <?php foreach ($domains as $d): ?>
                        <div class="p-4 border border-slate-100 rounded bg-slate-50 flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-slate-800"><?= htmlspecialchars($d['domain_name']) ?></h3>
                                <p class="text-xs text-slate-500">Expires: <?= htmlspecialchars($d['expiry_date']) ?></p>
                            </div>
                            <div>
                                <?php if ($d['auto_renew']): ?>
                                    <span class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-700">Auto-Renew ON</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs font-bold rounded bg-yellow-100 text-yellow-700">Manual Renew</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
