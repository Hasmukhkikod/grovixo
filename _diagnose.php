<?php
// TEMPORARY diagnostic script — upload, check the output, then DELETE this file immediately.
// It does not print your password in full, but it does confirm whether things resolve correctly.

require_once __DIR__ . '/includes/env.php';

header('Content-Type: text/plain');

$envPath = __DIR__ . '/.env';
echo "1. .env file exists at $envPath: " . (is_file($envPath) ? "YES" : "NO — this is the problem, create it here") . "\n";
if (is_file($envPath)) {
    echo "   File size: " . filesize($envPath) . " bytes\n";
    echo "   File readable by PHP: " . (is_readable($envPath) ? "YES" : "NO — check file permissions") . "\n";
}

echo "\n2. putenv() available: " . (function_exists('putenv') ? "YES" : "NO (disabled on this host)") . "\n";

echo "\n3. Values env() resolves:\n";
$dbName = env('DB_NAME');
$dbUser = env('DB_USER');
$dbPass = env('DB_PASS');
$smtpUser = env('SMTP_USERNAME');
echo "   DB_HOST = " . var_export(env('DB_HOST'), true) . "\n";
echo "   DB_NAME = " . var_export($dbName, true) . "\n";
echo "   DB_USER = " . var_export($dbUser, true) . "\n";
echo "   DB_PASS = " . ($dbPass ? "set (" . strlen($dbPass) . " chars)" : "NOT SET") . "\n";
echo "   SMTP_USERNAME = " . var_export($smtpUser, true) . "\n";

echo "\n4. Direct PDO connection attempt:\n";
try {
    $dsn = "mysql:host=" . env('DB_HOST', 'localhost') . ";port=" . env('DB_PORT', '3306') . ";dbname=$dbName;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    echo "   SUCCESS — connected to database '$dbName'.\n";
} catch (PDOException $e) {
    echo "   FAILED: " . $e->getMessage() . "\n";
}

echo "\n--- Remember to delete this file (_diagnose.php) now. ---\n";
