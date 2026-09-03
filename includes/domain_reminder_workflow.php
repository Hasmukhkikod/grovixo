<?php
// includes/domain_reminder_workflow.php
// Shared logic for the "Domain Expiry Reminder" system workflow, used by both
// the scheduled cron.php entry point and the admin dashboard's manual
// "Run Now" button (kept in one place so the two never drift apart).
require_once __DIR__ . '/mailer.php';

function run_domain_reminder_workflow(PDO $pdo): string {
    $log = [];

    $rawSettings = $pdo->query("SELECT * FROM settings")->fetchAll();
    $settings = [];
    foreach ($rawSettings as $s) {
        $settings[$s['setting_key']] = $s['setting_value'];
    }

    if (($settings['enable_domain_reminders'] ?? '0') !== '1') {
        $log[] = "Domain Expiry Reminder Workflow is currently disabled in settings.";
        return implode("\n", $log);
    }

    $stmt = $pdo->prepare("SELECT subject, body FROM email_templates WHERE template_name = 'domain_expiry'");
    $stmt->execute();
    $tmpl = $stmt->fetch();

    if (!$tmpl) {
        $log[] = "Error: domain_expiry template not found in database.";
        return implode("\n", $log);
    }

    $days_str = $settings['domain_reminder_days'] ?? '30,7,1';
    $thresholds = array_filter(array_map('trim', explode(',', $days_str)), 'is_numeric');
    if (empty($thresholds)) {
        $thresholds = [30, 7, 1];
    }

    foreach ($thresholds as $days) {
        $stmt = $pdo->prepare("
            SELECT d.*, u.name, u.email
            FROM domains d
            JOIN users u ON d.client_id = u.id
            WHERE d.expiry_date = DATE_ADD(CURRENT_DATE(), INTERVAL ? DAY)
        ");
        $stmt->execute([$days]);
        $expiring_domains = $stmt->fetchAll();

        foreach ($expiring_domains as $domain) {
            if ($domain['auto_renew']) {
                $log[] = "Skipping {$domain['domain_name']} because it is set to auto-renew.";
                continue;
            }

            $subject = str_replace('{domain_name}', $domain['domain_name'], $tmpl['subject']);
            $body = str_replace(
                ['{name}', '{domain_name}', '{expiry_date}'],
                [$domain['name'], $domain['domain_name'], $domain['expiry_date']],
                $tmpl['body']
            );

            if (sendMail($domain['email'], $subject, $body)) {
                $log[] = "Sent expiry notice for {$domain['domain_name']} to {$domain['email']} ($days days left).";
            } else {
                $log[] = "Failed to send notice for {$domain['domain_name']} to {$domain['email']}.";
            }
        }
    }

    $log[] = "Cron completed.";
    return implode("\n", $log);
}
