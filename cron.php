<?php
// cron.php
// This file should be run via server cron job (e.g., daily at midnight)
// 0 0 * * * /usr/bin/php /path/to/grovixonew/cron.php

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/domain_reminder_workflow.php';

echo "Running Cron Automations...\n";
echo run_domain_reminder_workflow($pdo) . "\n";
