<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

$msg = '';
$msg_type = 'success'; // success or error

// Handle actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Blogs & Careers
        if (isset($_POST['add_blog'])) {
            $stmt = $pdo->prepare("INSERT INTO blogs (title, category, read_time, author, image_url, excerpt, content) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$_POST['title'], $_POST['category'], $_POST['read_time'], $_POST['author'], $_POST['image_url'], $_POST['excerpt'], $_POST['content']])) $msg = "Blog added successfully!";
        } elseif (isset($_POST['delete_blog'])) {
            $pdo->prepare("DELETE FROM blogs WHERE id = ?")->execute([$_POST['id']]); $msg = "Blog deleted!";
        } elseif (isset($_POST['add_career'])) {
            $stmt = $pdo->prepare("INSERT INTO careers (title, department, location, type, description, requirements) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$_POST['title'], $_POST['department'], $_POST['location'], $_POST['type'], $_POST['description'], $_POST['requirements']])) $msg = "Job added successfully!";
        } elseif (isset($_POST['delete_career'])) {
            $pdo->prepare("DELETE FROM careers WHERE id = ?")->execute([$_POST['id']]); $msg = "Job deleted!";
        }
        // ERP Actions
        elseif (isset($_POST['delete_user'])) {
            $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$_POST['id']]); $msg = "User deleted!";
        } elseif (isset($_POST['add_project'])) {
            $pdo->prepare("INSERT INTO projects (client_id, name, description) VALUES (?, ?, ?)")->execute([$_POST['client_id'], $_POST['name'], $_POST['description']]); $msg = "Project added!";
        } elseif (isset($_POST['delete_project'])) {
            $pdo->prepare("DELETE FROM projects WHERE id = ?")->execute([$_POST['id']]); $msg = "Project deleted!";
        } elseif (isset($_POST['add_task'])) {
            $pdo->prepare("INSERT INTO tasks (project_id, assigned_to, title, description) VALUES (?, ?, ?, ?)")->execute([$_POST['project_id'], $_POST['assigned_to'], $_POST['title'], $_POST['description']]); $msg = "Task added!";
        } elseif (isset($_POST['delete_task'])) {
            $pdo->prepare("DELETE FROM tasks WHERE id = ?")->execute([$_POST['id']]); $msg = "Task deleted!";
        } elseif (isset($_POST['add_domain'])) {
            $pdo->prepare("INSERT INTO domains (client_id, domain_name, provider, expiry_date, auto_renew) VALUES (?, ?, ?, ?, ?)")->execute([$_POST['client_id'], $_POST['domain_name'], $_POST['provider'], $_POST['expiry_date'], $_POST['auto_renew']]); $msg = "Domain added!";
        } elseif (isset($_POST['delete_domain'])) {
            $pdo->prepare("DELETE FROM domains WHERE id = ?")->execute([$_POST['id']]); $msg = "Domain deleted!";
        } elseif (isset($_POST['update_template'])) {
            $pdo->prepare("UPDATE email_templates SET subject=?, body=? WHERE id=?")->execute([$_POST['subject'], $_POST['body'], $_POST['id']]); $msg = "Template updated!";
        } elseif (isset($_POST['delete_contact'])) {
            $pdo->prepare("DELETE FROM contacts WHERE id = ?")->execute([$_POST['id']]); $msg = "Contact deleted!";
        } elseif (isset($_POST['run_cron'])) {
            $cron_out = shell_exec('php ' . escapeshellarg(__DIR__ . '/../cron.php'));
            $msg = "<b>Cron Executed Manually:</b><br>" . nl2br(htmlspecialchars(trim($cron_out)));
            $msg_type = 'success';
        } elseif (isset($_POST['add_workflow'])) {
            $stmt = $pdo->prepare("INSERT INTO workflows (name, type, trigger_condition, action_type, action_details, is_system) VALUES (?, ?, ?, ?, ?, 0)");
            if ($stmt->execute([$_POST['name'], $_POST['type'], $_POST['trigger_condition'], $_POST['action_type'], $_POST['action_details']])) $msg = "Custom Workflow added!";
        } elseif (isset($_POST['delete_workflow'])) {
            // Only allow deleting non-system workflows
            $pdo->prepare("DELETE FROM workflows WHERE id = ? AND is_system = 0")->execute([$_POST['id']]);
            $msg = "Workflow deleted!";
        } elseif (isset($_POST['update_workflow'])) {
            // First update specific settings for system workflows if they exist
            if (isset($_POST['domain_reminder_days'])) {
                $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = 'domain_reminder_days'")->execute([$_POST['domain_reminder_days']]);
            }
            
            // Loop through all toggles to update is_active in workflows table
            $pdo->query("UPDATE workflows SET is_active = 0"); // Reset all to 0
            if (isset($_POST['workflow_active']) && is_array($_POST['workflow_active'])) {
                foreach ($_POST['workflow_active'] as $w_id) {
                    $pdo->prepare("UPDATE workflows SET is_active = 1 WHERE id = ?")->execute([$w_id]);
                }
            }
            $msg = "Workflows updated successfully!";
        }
    } catch (Exception $e) {
        $msg = "An error occurred: " . $e->getMessage();
        $msg_type = 'error';
    }
}

// Fetch all data
$blogs = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC")->fetchAll();
$careers = $pdo->query("SELECT * FROM careers ORDER BY created_at DESC")->fetchAll();
$users = $pdo->query("SELECT id, name, email, role, is_verified FROM users ORDER BY created_at DESC")->fetchAll();
$clients = array_filter($users, fn($u) => $u['role'] === 'client');
$members = array_filter($users, fn($u) => $u['role'] === 'member');
$projects = $pdo->query("SELECT p.*, u.name as client_name FROM projects p JOIN users u ON p.client_id = u.id ORDER BY p.created_at DESC")->fetchAll();
$tasks = $pdo->query("SELECT t.*, p.name as project_name, u.name as assignee FROM tasks t JOIN projects p ON t.project_id = p.id LEFT JOIN users u ON t.assigned_to = u.id ORDER BY t.created_at DESC")->fetchAll();
$domains = $pdo->query("SELECT d.*, u.name as client_name FROM domains d JOIN users u ON d.client_id = u.id ORDER BY d.expiry_date ASC")->fetchAll();
$workflows_list = $pdo->query("SELECT * FROM workflows ORDER BY is_system DESC, created_at ASC")->fetchAll(PDO::FETCH_ASSOC);
$templates = $pdo->query("SELECT * FROM email_templates")->fetchAll();
$contacts = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetchAll();

$rawSettings = $pdo->query("SELECT * FROM settings")->fetchAll();
$settings = [];
foreach($rawSettings as $s) {
    $settings[$s['setting_key']] = $s['setting_value'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grovixo Workspace - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Custom Scrollbar for a premium feel */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .tab-btn.active {
            background-color: #f1f5f9;
            color: #0f172a;
            font-weight: 600;
        }
        .tab-btn.active svg {
            color: #3b82f6;
        }
    </style>
    <script>
        function showTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(tabId).classList.remove('hidden');
            
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('active');
            });
            
            const btn = document.getElementById('btn-' + tabId);
            if(btn) btn.classList.add('active');
            
            // Save state
            localStorage.setItem('activeAdminTab', tabId);
        }

        window.onload = () => {
            const activeTab = localStorage.getItem('activeAdminTab') || 'contacts';
            showTab(activeTab);
            lucide.createIcons();
            
            // Auto hide messages
            const msg = document.getElementById('flash-message');
            if (msg) {
                setTimeout(() => { msg.style.display = 'none'; }, 4000);
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col shrink-0 z-20 shadow-sm relative">
        <div class="h-16 flex items-center px-6 border-b border-slate-100">
            <h1 class="text-xl font-bold tracking-tight text-slate-900 flex items-center gap-2">
                <i data-lucide="command" class="w-5 h-5 text-blue-600"></i> Workspace
            </h1>
        </div>
        
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 px-3 mt-4">CRM</div>
            <button id="btn-contacts" onclick="showTab('contacts')" class="tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i data-lucide="inbox" class="w-4 h-4 text-slate-400"></i> Inbox
            </button>
            <button id="btn-users" onclick="showTab('users')" class="tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i data-lucide="users" class="w-4 h-4 text-slate-400"></i> Directory
            </button>
            
            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 px-3 mt-6">Operations</div>
            <button id="btn-projects" onclick="showTab('projects')" class="tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i data-lucide="folder-kanban" class="w-4 h-4 text-slate-400"></i> Projects
            </button>
            <button id="btn-tasks" onclick="showTab('tasks')" class="tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i data-lucide="check-square" class="w-4 h-4 text-slate-400"></i> Tasks
            </button>
            <button id="btn-domains" onclick="showTab('domains')" class="tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i data-lucide="globe" class="w-4 h-4 text-slate-400"></i> Domains
            </button>

            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 px-3 mt-6">Content</div>
            <button id="btn-blogs" onclick="showTab('blogs')" class="tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i data-lucide="file-text" class="w-4 h-4 text-slate-400"></i> Articles
            </button>
            <button id="btn-careers" onclick="showTab('careers')" class="tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i data-lucide="briefcase" class="w-4 h-4 text-slate-400"></i> Careers
            </button>
            
            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 px-3 mt-6">System</div>
            <button id="btn-settings" onclick="showTab('settings')" class="tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i data-lucide="settings" class="w-4 h-4 text-slate-400"></i> Configurations
            </button>
            <button id="btn-workflows" onclick="showTab('workflows')" class="tab-btn w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                <i data-lucide="git-merge" class="w-4 h-4 text-slate-400"></i> Workflows
            </button>
        </nav>
        
        <div class="p-4 border-t border-slate-100">
            <a href="logout.php" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                <i data-lucide="log-out" class="w-4 h-4"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-[#F8FAFC]">
        <!-- Header -->
        <header class="h-16 flex items-center px-8 border-b border-slate-200 bg-white shrink-0">
            <h2 class="text-lg font-semibold text-slate-800">Overview</h2>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            
            <?php if ($msg): ?>
                <div id="flash-message" class="mb-6 flex items-center gap-3 p-4 rounded-xl <?= $msg_type === 'success' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-red-50 text-red-700 border border-red-100' ?>">
                    <i data-lucide="<?= $msg_type === 'success' ? 'check-circle' : 'alert-circle' ?>" class="w-5 h-5"></i>
                    <span class="font-medium"><?= htmlspecialchars($msg) ?></span>
                </div>
            <?php endif; ?>

            <!-- ===================== CONTACTS ===================== -->
            <div id="contacts" class="tab-content hidden w-full">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Inbox Submissions</h2>
                </div>
                
                <?php if(!$contacts): ?>
                    <div class="bg-white border border-slate-200 border-dashed rounded-2xl p-12 text-center flex flex-col items-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                            <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i>
                        </div>
                        <h3 class="text-slate-800 font-semibold mb-1">Inbox is empty</h3>
                        <p class="text-slate-500 text-sm">You have no new contact form submissions.</p>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($contacts as $c): ?>
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                            <?= strtoupper(substr($c['name'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-900"><?= htmlspecialchars($c['name']) ?></h3>
                                            <p class="text-sm text-slate-500"><?= htmlspecialchars($c['email']) ?> &bull; <?= date('M j, Y g:i A', strtotime($c['created_at'])) ?></p>
                                        </div>
                                    </div>
                                    <form method="POST" onsubmit="return confirm('Delete this message?');">
                                        <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                        <button type="submit" name="delete_contact" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                    <h4 class="font-semibold text-sm text-slate-900 mb-2">Subject: <?= htmlspecialchars($c['subject'] ?? 'No Subject') ?></h4>
                                    <p class="text-slate-600 text-sm leading-relaxed"><?= nl2br(htmlspecialchars($c['message'])) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- ===================== USERS ===================== -->
            <div id="users" class="tab-content hidden w-full">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Directory</h2>
                </div>
                
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                            <tr>
                                <th class="px-6 py-4">Name</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach ($users as $u): ?>
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900"><?= htmlspecialchars($u['name'] ?: 'Unknown') ?></div>
                                        <div class="text-slate-500 text-xs"><?= htmlspecialchars($u['email']) ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 capitalize">
                                            <?= htmlspecialchars($u['role']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($u['is_verified']): ?>
                                            <span class="inline-flex items-center gap-1 text-emerald-600 text-xs font-medium"><i data-lucide="check-circle" class="w-3 h-3"></i> Verified</span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 text-amber-500 text-xs font-medium"><i data-lucide="clock" class="w-3 h-3"></i> Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <?php if($u['role'] !== 'admin'): ?>
                                            <form method="POST" onsubmit="return confirm('Delete user?');" class="inline-block">
                                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                                <button type="submit" name="delete_user" class="text-red-500 hover:text-red-700 transition-colors p-1" title="Delete">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ===================== PROJECTS ===================== -->
            <div id="projects" class="tab-content hidden w-full">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Projects</h2>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-8 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2"><i data-lucide="plus-circle" class="w-4 h-4 text-blue-600"></i> New Project</h3>
                    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <select name="client_id" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50" required>
                            <option value="">Select Client...</option>
                            <?php foreach($clients as $c): ?><option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name'] ?: $c['email']) ?></option><?php endforeach; ?>
                        </select>
                        <input type="text" name="name" placeholder="Project Name" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50" required>
                        <div class="md:col-span-2">
                            <textarea name="description" placeholder="Project Brief / Description" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50 resize-y" rows="3"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" name="add_project" class="bg-slate-900 text-white font-medium px-5 py-2.5 rounded-xl hover:bg-slate-800 transition-colors text-sm">Create Project</button>
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($projects as $p): ?>
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded text-[10px] font-bold bg-blue-50 text-blue-700 uppercase tracking-wider">
                                        Client: <?= htmlspecialchars($p['client_name']) ?>
                                    </span>
                                    <form method="POST" onsubmit="return confirm('Delete project?');">
                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                        <button type="submit" name="delete_project" class="text-slate-400 hover:text-red-500 transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </form>
                                </div>
                                <h3 class="font-bold text-lg text-slate-900 mb-1"><?= htmlspecialchars($p['name']) ?></h3>
                                <p class="text-sm text-slate-500 line-clamp-2"><?= htmlspecialchars($p['description']) ?></p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-slate-100 flex justify-between items-center text-xs text-slate-400 font-medium">
                                <span>Status: <span class="uppercase text-slate-800"><?= $p['status'] ?></span></span>
                                <span><?= date('M j, Y', strtotime($p['created_at'])) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ===================== TASKS ===================== -->
            <div id="tasks" class="tab-content hidden w-full max-w-7xl">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tasks</h2>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-8 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2"><i data-lucide="plus-circle" class="w-4 h-4 text-blue-600"></i> Assign Task</h3>
                    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <select name="project_id" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50" required>
                            <option value="">Select Project...</option>
                            <?php foreach($projects as $p): ?><option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option><?php endforeach; ?>
                        </select>
                        <select name="assigned_to" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50" required>
                            <option value="">Assign to Member...</option>
                            <?php foreach($members as $m): ?><option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['name'] ?: $m['email']) ?></option><?php endforeach; ?>
                        </select>
                        <div class="md:col-span-2">
                            <input type="text" name="title" placeholder="Task Title" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50" required>
                        </div>
                        <div class="md:col-span-2">
                            <textarea name="description" placeholder="Task details..." class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50 resize-y" rows="3"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" name="add_task" class="bg-slate-900 text-white font-medium px-5 py-2.5 rounded-xl hover:bg-slate-800 transition-colors text-sm">Create Task</button>
                        </div>
                    </form>
                </div>

                <div class="space-y-3">
                    <?php foreach ($tasks as $t): ?>
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500">
                                    <i data-lucide="check-square" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900"><?= htmlspecialchars($t['title']) ?></h3>
                                    <div class="text-xs text-slate-500 font-medium mt-1 flex items-center gap-2">
                                        <span class="bg-blue-50 text-blue-700 px-1.5 py-0.5 rounded"><?= htmlspecialchars($t['project_name']) ?></span>
                                        <span>&bull;</span>
                                        <span>Assignee: <span class="text-slate-700"><?= htmlspecialchars($t['assignee']) ?></span></span>
                                        <span>&bull;</span>
                                        <span class="uppercase tracking-wider text-[10px] <?= $t['status'] === 'done' ? 'text-emerald-600' : 'text-amber-600' ?>"><?= $t['status'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" onsubmit="return confirm('Delete task?');" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                <button type="submit" name="delete_task" class="text-red-500 hover:text-red-700 p-2"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ===================== DOMAINS ===================== -->
            <div id="domains" class="tab-content hidden w-full max-w-7xl">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Domains & Hosting</h2>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-8 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2"><i data-lucide="plus-circle" class="w-4 h-4 text-blue-600"></i> Track Domain</h3>
                    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                        <div class="lg:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Client</label>
                            <select name="client_id" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50" required>
                                <option value="">Select...</option>
                                <?php foreach($clients as $c): ?><option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name'] ?: $c['email']) ?></option><?php endforeach; ?>
                            </select>
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Domain Name</label>
                            <input type="text" name="domain_name" placeholder="e.g. example.com" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50" required>
                        </div>
                        <div class="lg:col-span-1">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Provider</label>
                            <input type="text" name="provider" placeholder="e.g. GoDaddy" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50">
                        </div>
                        <div class="lg:col-span-1">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Expiry Date</label>
                            <input type="date" name="expiry_date" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-slate-50" required>
                        </div>
                        <div class="lg:col-span-1 flex items-center h-[42px] px-2">
                            <label class="flex items-center gap-2 cursor-pointer text-sm font-medium text-slate-700">
                                <input type="hidden" name="auto_renew" value="0">
                                <input type="checkbox" name="auto_renew" value="1" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                                Auto-Renew
                            </label>
                        </div>
                        <div class="lg:col-span-1">
                            <button type="submit" name="add_domain" class="w-full bg-slate-900 text-white font-medium px-5 py-2.5 rounded-xl hover:bg-slate-800 transition-colors text-sm">Add</button>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                            <tr>
                                <th class="px-6 py-4">Domain</th>
                                <th class="px-6 py-4">Client</th>
                                <th class="px-6 py-4">Provider</th>
                                <th class="px-6 py-4">Expiry Date</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach ($domains as $d): ?>
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900"><?= htmlspecialchars($d['domain_name']) ?></div>
                                        <?php if($d['auto_renew']): ?>
                                            <div class="text-[10px] font-bold text-emerald-600 uppercase">Auto-Renew ON</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-600"><?= htmlspecialchars($d['client_name']) ?></td>
                                    <td class="px-6 py-4 text-slate-500"><?= htmlspecialchars($d['provider']) ?></td>
                                    <td class="px-6 py-4 font-bold <?= strtotime($d['expiry_date']) < strtotime('+30 days') ? 'text-red-600' : 'text-slate-700' ?>">
                                        <?= date('M j, Y', strtotime($d['expiry_date'])) ?>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form method="POST" onsubmit="return confirm('Delete domain?');" class="inline-block">
                                            <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                            <button type="submit" name="delete_domain" class="text-red-500 hover:text-red-700 transition-colors p-1" title="Delete">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ===================== BLOGS ===================== -->
            <div id="blogs" class="tab-content hidden w-full max-w-7xl">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Website Articles</h2>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-8 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2"><i data-lucide="plus-circle" class="w-4 h-4 text-blue-600"></i> New Article</h3>
                    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="title" placeholder="Title" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50" required>
                        <input type="text" name="category" placeholder="Category" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50" required>
                        <input type="text" name="author" placeholder="Author Name" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50" required>
                        <input type="text" name="read_time" placeholder="Read Time (e.g. 5 min read)" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50" required>
                        <div class="md:col-span-2">
                            <input type="url" name="image_url" placeholder="Cover Image URL" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50" required>
                        </div>
                        <div class="md:col-span-2">
                            <textarea name="excerpt" placeholder="Short Excerpt..." class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50 resize-y" rows="2" required></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <textarea name="content" placeholder="Full Article Content (HTML allowed)..." class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50 resize-y" rows="6" required></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" name="add_blog" class="bg-slate-900 text-white font-medium px-5 py-2.5 rounded-xl hover:bg-slate-800 transition-colors text-sm">Publish Article</button>
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($blogs as $b): ?>
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider"><?= htmlspecialchars($b['category']) ?></span>
                                <form method="POST" onsubmit="return confirm('Delete article?');">
                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                    <button type="submit" name="delete_blog" class="text-slate-400 hover:text-red-500 transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </form>
                            </div>
                            <h3 class="font-bold text-lg text-slate-900 mb-2"><?= htmlspecialchars($b['title']) ?></h3>
                            <p class="text-sm text-slate-500 mb-4 line-clamp-2"><?= htmlspecialchars($b['excerpt']) ?></p>
                            <div class="text-xs text-slate-400 font-medium">By <?= htmlspecialchars($b['author']) ?> &bull; <?= htmlspecialchars($b['read_time']) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ===================== CAREERS ===================== -->
            <div id="careers" class="tab-content hidden w-full max-w-7xl">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Careers / Job Openings</h2>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-8 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2"><i data-lucide="plus-circle" class="w-4 h-4 text-blue-600"></i> New Job Opening</h3>
                    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="title" placeholder="Job Title" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50" required>
                        <input type="text" name="department" placeholder="Department (e.g. Design)" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50" required>
                        <input type="text" name="location" placeholder="Location (e.g. Remote)" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50" required>
                        <select name="type" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50" required>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                        </select>
                        <div class="md:col-span-2">
                            <textarea name="description" placeholder="Job Description..." class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50 resize-y" rows="3" required></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <textarea name="requirements" placeholder="Requirements (bullet points)..." class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm bg-slate-50 resize-y" rows="3" required></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" name="add_career" class="bg-slate-900 text-white font-medium px-5 py-2.5 rounded-xl hover:bg-slate-800 transition-colors text-sm">Post Job</button>
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <?php foreach ($careers as $c): ?>
                        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-lg text-slate-900"><?= htmlspecialchars($c['title']) ?></h3>
                                <div class="text-sm text-slate-500 font-medium mt-1 flex items-center gap-3">
                                    <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3 h-3"></i> <?= htmlspecialchars($c['location']) ?></span>
                                    <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> <?= htmlspecialchars($c['type']) ?></span>
                                    <span class="flex items-center gap-1"><i data-lucide="folder" class="w-3 h-3"></i> <?= htmlspecialchars($c['department']) ?></span>
                                </div>
                            </div>
                            <form method="POST" onsubmit="return confirm('Delete job?');">
                                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                <button type="submit" name="delete_career" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ===================== SETTINGS ===================== -->
            <div id="settings" class="tab-content hidden w-full">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">System Configurations</h2>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2"><i data-lucide="mail" class="w-5 h-5 text-blue-600"></i> Automated Email Templates</h3>
                    
                    <div class="grid lg:grid-cols-2 gap-8">
                        <?php foreach ($templates as $tmpl): ?>
                            <div class="border border-slate-100 rounded-xl p-6 bg-slate-50">
                                <div class="mb-4">
                                    <span class="inline-block px-3 py-1 bg-slate-200 text-slate-700 text-xs font-bold rounded-full uppercase tracking-wider">
                                        <?= htmlspecialchars($tmpl['template_name']) ?>
                                    </span>
                                </div>
                                <form method="POST" class="space-y-4">
                                    <input type="hidden" name="id" value="<?= $tmpl['id'] ?>">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Subject Line</label>
                                        <input type="text" name="subject" value="<?= htmlspecialchars($tmpl['subject']) ?>" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-white font-medium" required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Email Body</label>
                                        <textarea name="body" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 bg-white resize-y font-mono" rows="6" required><?= htmlspecialchars($tmpl['body']) ?></textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" name="update_template" class="bg-blue-600 text-white font-medium px-6 py-2 rounded-xl hover:bg-blue-700 transition-colors text-sm">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- ===================== WORKFLOWS ===================== -->
            <div id="workflows" class="tab-content hidden w-full">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Active Workflows & Automations</h2>
                    <button type="button" onclick="document.getElementById('add-workflow-modal').classList.remove('hidden')" class="bg-blue-600 text-white font-medium px-4 py-2 rounded-xl hover:bg-blue-700 transition-colors flex items-center gap-2 text-sm shadow-sm">
                        <i data-lucide="plus" class="w-4 h-4"></i> New Workflow
                    </button>
                </div>

                <form method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    <?php foreach($workflows_list as $wf): ?>
                    <!-- Dynamic Workflow Card -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm relative overflow-hidden group flex flex-col h-full">
                        <div class="absolute top-0 right-0 w-32 h-32 <?= $wf['type'] === 'cron' ? 'bg-emerald-50' : 'bg-blue-50' ?> rounded-bl-full -mr-16 -mt-16 z-0 transition-transform group-hover:scale-110"></div>
                        <div class="relative z-10 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full <?= $wf['type'] === 'cron' ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-100 text-blue-600' ?> flex items-center justify-center shrink-0">
                                        <i data-lucide="<?= $wf['type'] === 'cron' ? 'zap' : 'activity' ?>" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 text-lg"><?= htmlspecialchars($wf['name']) ?></h3>
                                        <div class="flex items-center gap-3 mt-1">
                                            <span class="text-xs font-bold <?= $wf['type'] === 'cron' ? 'text-emerald-600' : 'text-blue-600' ?> uppercase tracking-wider flex items-center gap-1">
                                                <i data-lucide="<?= $wf['type'] === 'cron' ? 'clock' : 'zap' ?>" class="w-3 h-3"></i> <?= $wf['type'] === 'cron' ? 'Runs Daily (Cron)' : 'Real-time' ?>
                                            </span>
                                            <?php if($wf['type'] === 'cron'): ?>
                                            <button type="submit" name="run_cron" formnovalidate class="text-[10px] bg-emerald-100 text-emerald-700 hover:bg-emerald-200 hover:text-emerald-800 px-2.5 py-1 rounded-full font-bold uppercase tracking-wider transition-colors flex items-center gap-1">
                                                <i data-lucide="play" class="w-3 h-3"></i> Run Now
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button type="button" onclick="document.getElementById('edit-wf-<?= $wf['id'] ?>').classList.toggle('hidden')" class="text-slate-400 hover:text-blue-600 transition-colors" title="View/Edit Workflow"><i data-lucide="edit-2" class="w-4 h-4"></i></button>
                                    <?php if($wf['is_system']): ?>
                                    <button type="button" onclick="showCustomModal('Action Denied', 'Core system workflows cannot be deleted to prevent application errors. Please disable the workflow instead.', true)" class="text-slate-400 hover:text-red-600 transition-colors" title="Delete Workflow"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    <?php else: ?>
                                    <button type="submit" name="delete_workflow" onclick="document.getElementById('del_wf_id').value='<?= $wf['id'] ?>'" class="text-slate-400 hover:text-red-600 transition-colors" title="Delete Workflow"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    <?php endif; ?>
                                    <div class="w-px h-6 bg-slate-200 mx-1"></div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                      <input type="checkbox" name="workflow_active[]" value="<?= $wf['id'] ?>" class="sr-only peer" <?= $wf['is_active'] ? 'checked' : '' ?>>
                                      <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all <?= $wf['type'] === 'cron' ? 'peer-checked:bg-emerald-500' : 'peer-checked:bg-blue-500' ?>"></div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 mb-4 flex-1">
                                <div class="text-sm font-bold text-slate-800 mb-1">Trigger Condition:</div>
                                <div class="text-sm text-slate-600 leading-relaxed">
                                    <?php 
                                        // Specific formatting for the legacy Domain string to maintain aesthetics
                                        if ($wf['id'] == 1 && $wf['is_system']) {
                                            echo "Send reminder when expiry is exactly <span class='font-bold text-slate-900 bg-slate-200 px-2 py-0.5 rounded mx-1'>" . htmlspecialchars($settings['domain_reminder_days'] ?? '30,7,1') . "</span> days away.";
                                        } else {
                                            echo htmlspecialchars($wf['trigger_condition']);
                                        }
                                    ?>
                                </div>
                                
                                <!-- Visual Flowchart / Edit Panel -->
                                <div id="edit-wf-<?= $wf['id'] ?>" class="hidden mt-4 pt-6 border-t border-slate-200">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-4 tracking-wider text-center">Workflow Logic Flow</label>
                                    
                                    <div class="bg-slate-100/50 rounded-2xl p-6 mb-6 flex flex-col items-center border border-slate-200 shadow-inner">
                                        <div class="bg-slate-800 text-white px-6 py-2 rounded-full text-sm font-bold shadow-md flex items-center gap-2 text-center max-w-sm">
                                            <i data-lucide="<?= $wf['type'] === 'cron' ? 'clock' : 'zap' ?>" class="w-4 h-4 <?= $wf['type'] === 'cron' ? 'text-emerald-400' : 'text-blue-400' ?> shrink-0"></i> 
                                            <?= $wf['type'] === 'cron' ? 'Scheduled Trigger' : 'Event Triggered' ?>
                                        </div>
                                        
                                        <div class="h-6 w-px bg-slate-300 relative"></div>
                                        <div class="w-2 h-2 border-r-2 border-b-2 border-slate-400 rotate-45 -mt-1.5 mb-1"></div>
                                        
                                        <div class="bg-amber-50 border-2 border-amber-200 text-amber-900 px-6 py-3 rounded-xl text-sm font-bold shadow-sm flex items-center gap-3 w-full max-w-sm">
                                            <div class="bg-amber-200 text-amber-700 w-6 h-6 rounded-full flex items-center justify-center shrink-0">?</div>
                                            <div class="text-center w-full">
                                                <?php
                                                    if ($wf['id'] == 1 && $wf['is_system']) echo "Is domain expiry exactly <span class='text-amber-600 bg-amber-100 px-1 rounded'>" . htmlspecialchars($settings['domain_reminder_days'] ?? '30,7,1') . "</span> days away?";
                                                    elseif ($wf['id'] == 2 && $wf['is_system']) echo "Is <span class='text-amber-600 bg-amber-100 px-1 rounded font-mono text-xs'>enable_registration_verification</span> toggled ON?";
                                                    else echo htmlspecialchars($wf['trigger_condition']);
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="flex w-full max-w-sm mt-1 mb-1">
                                            <div class="w-1/2 flex flex-col items-center border-r border-slate-300 pr-4 pb-2 relative">
                                                <span class="text-[10px] font-bold <?= $wf['type'] === 'cron' ? 'text-emerald-600' : 'text-blue-600' ?> bg-slate-100/50 px-1 absolute -right-3 top-2">YES</span>
                                                <div class="h-8 w-px <?= $wf['type'] === 'cron' ? 'bg-emerald-400' : 'bg-blue-400' ?> ml-auto mr-[-1px]"></div>
                                                <div class="w-2 h-2 border-r-2 border-b-2 <?= $wf['type'] === 'cron' ? 'border-emerald-500' : 'border-blue-500' ?> rotate-45 -mt-1.5 ml-auto mr-[-4px]"></div>
                                            </div>
                                            <div class="w-1/2 flex flex-col items-center pl-4 pb-2 relative">
                                                <span class="text-[10px] font-bold text-slate-400 bg-slate-100/50 px-1 absolute -left-2 top-2">NO</span>
                                                <div class="h-6 w-px bg-slate-300 mr-auto ml-[-1px]"></div>
                                                <div class="w-2 h-2 border-r-2 border-b-2 border-slate-400 rotate-45 -mt-1.5 mr-auto ml-[-4px]"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="flex w-full max-w-sm justify-between gap-4">
                                            <div class="w-1/2 <?= $wf['type'] === 'cron' ? 'bg-emerald-100 border-emerald-300 text-emerald-900' : 'bg-blue-100 border-blue-300 text-blue-900' ?> border-2 px-3 py-2 rounded-xl text-xs font-bold shadow-sm text-center flex flex-col items-center justify-center">
                                                <i data-lucide="check-circle" class="w-4 h-4 mb-1 <?= $wf['type'] === 'cron' ? 'text-emerald-600' : 'text-blue-600' ?>"></i>
                                                <?= htmlspecialchars($wf['action_details']) ?>
                                            </div>
                                            <div class="w-1/2 bg-slate-200 border-2 border-slate-300 text-slate-600 px-3 py-2 rounded-xl text-xs font-bold shadow-sm text-center flex flex-col items-center justify-center">
                                                <?php 
                                                    if ($wf['id'] == 2 && $wf['is_system']) echo "<i data-lucide='check-circle' class='w-4 h-4 mb-1 text-emerald-600'></i> Auto-verify user instantly";
                                                    else echo "End / Ignore";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php if($wf['id'] == 1 && $wf['is_system']): // Legacy Domain settings ?>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Edit Reminder Days</label>
                                    <div class="flex gap-2">
                                        <input type="text" name="domain_reminder_days" value="<?= htmlspecialchars($settings['domain_reminder_days'] ?? '30,7,1') ?>" class="flex-1 border border-slate-300 rounded-lg px-3 py-2 text-sm font-bold text-slate-800 focus:border-blue-500 outline-none" placeholder="e.g. 30,7,1">
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-2 uppercase tracking-wider mb-4">Comma separated numbers (e.g. 30,7,1)</p>
                                    <?php endif; ?>
                                    
                                    <div class="flex justify-end mt-4">
                                        <button type="button" onclick="document.getElementById('edit-wf-<?= $wf['id'] ?>').classList.add('hidden')" class="bg-slate-200 text-slate-700 px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-300 transition-colors shadow-sm">Close Visualizer</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 text-sm font-medium text-slate-700 <?= $wf['type'] === 'cron' ? 'bg-emerald-50/50 border-emerald-100 text-emerald-800' : 'bg-blue-50/50 border-blue-100 text-blue-800' ?> p-3 rounded-lg border mt-auto">
                                <i data-lucide="<?= $wf['type'] === 'cron' ? 'mail-check' : 'cpu' ?>" class="w-4 h-4 <?= $wf['type'] === 'cron' ? 'text-emerald-600' : 'text-blue-600' ?>"></i>
                                Action: <?= htmlspecialchars($wf['action_details']) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <div class="lg:col-span-2 flex justify-end mt-4">
                        <input type="hidden" name="id" id="del_wf_id" value="">
                        <button type="submit" name="update_workflow" class="bg-slate-900 text-white font-medium px-8 py-3 rounded-xl hover:bg-slate-800 transition-colors flex items-center gap-2">
                            <i data-lucide="save" class="w-4 h-4"></i> Save Workflows State
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>

    <!-- Add Workflow Modal -->
    <div id="add-workflow-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-slate-900">Add Custom Workflow</h3>
                <button onclick="document.getElementById('add-workflow-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form method="POST" class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Workflow Name</label>
                    <input type="text" name="name" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 font-medium" placeholder="e.g. Send Invoice Reminder" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Execution Type</label>
                    <select name="type" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 font-medium">
                        <option value="cron">Scheduled (Cron)</option>
                        <option value="realtime">Event Triggered (Real-time)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Trigger Condition</label>
                    <input type="text" name="trigger_condition" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 font-medium" placeholder="e.g. When invoice is 5 days overdue" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Action Type</label>
                        <select name="action_type" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 font-medium">
                            <option value="email">Send Email</option>
                            <option value="webhook">Trigger Webhook</option>
                            <option value="task">Create Task</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Action Details</label>
                        <input type="text" name="action_details" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-500 font-medium" placeholder="e.g. template_name" required>
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t border-slate-100 mt-6">
                    <button type="submit" name="add_workflow" class="bg-blue-600 text-white font-medium px-6 py-2.5 rounded-xl hover:bg-blue-700 transition-colors text-sm shadow-sm">Create Workflow</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Custom Modal UI -->
    <div id="custom-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300 translate-y-4" id="custom-modal-content">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div id="custom-modal-icon" class="w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <i id="custom-modal-lucide" data-lucide="info" class="w-5 h-5"></i>
                    </div>
                    <h3 id="custom-modal-title" class="text-lg font-bold text-slate-900">Title</h3>
                </div>
                <p id="custom-modal-message" class="text-slate-600 text-sm leading-relaxed mb-6">Message goes here</p>
                <div class="flex justify-end">
                    <button onclick="closeCustomModal()" id="custom-modal-btn" class="px-6 py-2 rounded-xl text-white font-medium text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">Got it</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCustomModal(title, message, isError = false) {
            document.getElementById('custom-modal-title').textContent = title;
            document.getElementById('custom-modal-message').textContent = message;
            
            const iconContainer = document.getElementById('custom-modal-icon');
            const iconEl = document.getElementById('custom-modal-lucide');
            const btn = document.getElementById('custom-modal-btn');
            
            // Reset classes
            iconContainer.className = 'w-10 h-10 rounded-full flex items-center justify-center shrink-0';
            btn.className = 'px-6 py-2 rounded-xl text-white font-medium text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2';
            
            if (isError) {
                iconContainer.classList.add('bg-red-100', 'text-red-600');
                iconEl.setAttribute('data-lucide', 'alert-triangle');
                btn.classList.add('bg-red-600', 'hover:bg-red-700', 'focus:ring-red-600');
            } else {
                iconContainer.classList.add('bg-blue-100', 'text-blue-600');
                iconEl.setAttribute('data-lucide', 'info');
                btn.classList.add('bg-blue-600', 'hover:bg-blue-700', 'focus:ring-blue-600');
            }
            
            lucide.createIcons();
            
            const modal = document.getElementById('custom-modal');
            const content = document.getElementById('custom-modal-content');
            
            modal.classList.remove('opacity-0', 'pointer-events-none');
            content.classList.remove('scale-95', 'translate-y-4');
        }

        function closeCustomModal() {
            const modal = document.getElementById('custom-modal');
            const content = document.getElementById('custom-modal-content');
            
            content.classList.add('scale-95', 'translate-y-4');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }
    </script>
</body>
</html>
