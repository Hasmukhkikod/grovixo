<?php
// member_dashboard.php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'member') {
    header("Location: login.php");
    exit;
}

$member_id = $_SESSION['user_id'];
$member_name = $_SESSION['user_name'];

// Handle task status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_task'])) {
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];
    $stmt = $pdo->prepare("UPDATE tasks SET status = ? WHERE id = ? AND assigned_to = ?");
    $stmt->execute([$status, $task_id, $member_id]);
    header("Location: member_dashboard.php");
    exit;
}

// Fetch assigned tasks with project info
$tasks = $pdo->prepare("
    SELECT t.*, p.name as project_name 
    FROM tasks t 
    JOIN projects p ON t.project_id = p.id 
    WHERE t.assigned_to = ? 
    ORDER BY t.created_at DESC
");
$tasks->execute([$member_id]);
$tasks = $tasks->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard - Grovixo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen">
    <nav class="bg-white shadow-sm px-6 py-4 flex justify-between items-center mb-8">
        <h1 class="font-bold text-xl text-slate-800">Team Portal</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm text-slate-500">Welcome, <?= htmlspecialchars($member_name) ?></span>
            <a href="admin/logout.php" class="text-sm font-medium text-red-600 hover:text-red-800">Logout</a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 pb-20">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
            <h2 class="text-lg font-bold mb-4">Your Assigned Tasks</h2>
            <div class="space-y-4">
                <?php if (!$tasks): ?>
                    <p class="text-slate-500 text-sm">No tasks assigned to you right now.</p>
                <?php endif; ?>
                <?php foreach ($tasks as $t): ?>
                    <div class="p-4 border border-slate-100 rounded bg-slate-50 flex flex-col md:flex-row justify-between md:items-center gap-4">
                        <div>
                            <span class="text-xs font-bold text-blue-600 uppercase"><?= htmlspecialchars($t['project_name']) ?></span>
                            <h3 class="font-bold text-slate-800"><?= htmlspecialchars($t['title']) ?></h3>
                            <p class="text-sm text-slate-600 mt-1"><?= htmlspecialchars($t['description']) ?></p>
                        </div>
                        <div class="shrink-0">
                            <form method="POST" class="flex items-center gap-2">
                                <input type="hidden" name="task_id" value="<?= $t['id'] ?>">
                                <select name="status" class="border border-slate-300 rounded px-2 py-1 text-sm bg-white" onchange="this.form.submit()">
                                    <option value="todo" <?= $t['status'] == 'todo' ? 'selected' : '' ?>>To Do</option>
                                    <option value="in_progress" <?= $t['status'] == 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                                    <option value="done" <?= $t['status'] == 'done' ? 'selected' : '' ?>>Done</option>
                                </select>
                                <input type="hidden" name="update_task" value="1">
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
