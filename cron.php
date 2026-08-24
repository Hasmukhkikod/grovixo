<?php
// cron.php
// This file should be run via server cron job (e.g., daily at midnight)
// 0 0 * * * /usr/bin/php /path/to/grovixonew/cron.php

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/mailer.php';

echo "Running Cron Automations...\n";

// Fetch workflow settings
$rawSettings = $pdo->query("SELECT * FROM settings")->fetchAll();
$settings = [];
foreach($rawSettings as $s) {
    $settings[$s['setting_key']] = $s['setting_value'];
}

if (($settings['enable_domain_reminders'] ?? '0') !== '1') {
    die("Domain Expiry Reminder Workflow is currently disabled in settings.\n");
}

// Fetch the domain expiry email template
$stmt = $pdo->prepare("SELECT subject, body FROM email_templates WHERE template_name = 'domain_expiry'");
$stmt->execute();
$tmpl = $stmt->fetch();

if (!$tmpl) {
    die("Error: domain_expiry template not found in database.\n");
}

// Parse custom thresholds
$days_str = $settings['domain_reminder_days'] ?? '30,7,1';
$thresholds = array_filter(array_map('trim', explode(',', $days_str)), 'is_numeric');

if (empty($thresholds)) {
    $thresholds = [30, 7, 1];
}

foreach ($thresholds as $days) {
    // DATE_ADD(CURRENT_DATE(), INTERVAL ? DAY)
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
            echo "Skipping {$domain['domain_name']} because it is set to auto-renew.\n";
            continue;
        }

        $subject = str_replace('{domain_name}', $domain['domain_name'], $tmpl['subject']);
        $body = str_replace(
            ['{name}', '{domain_name}', '{expiry_date}'], 
            [$domain['name'], $domain['domain_name'], $domain['expiry_date']], 
            $tmpl['body']
        );

        if (sendMail($domain['email'], $subject, $body)) {
            echo "Sent expiry notice for {$domain['domain_name']} to {$domain['email']} ($days days left).\n";
        } else {
            echo "Failed to send notice for {$domain['domain_name']} to {$domain['email']}.\n";
        }
    }
}

echo "Cron completed.\n";
?>
