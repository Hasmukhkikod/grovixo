<?php
// includes/db.php
require_once __DIR__ . '/env.php';

$host = env('DB_HOST', 'localhost');
$port = env('DB_PORT', '3306');
$dbname = env('DB_NAME');
$user = env('DB_USER');
$pass = env('DB_PASS');

try {
    if (!$dbname || !$user || $pass === null) {
        throw new PDOException('Database credentials are not configured. Set DB_NAME, DB_USER, DB_PASS in .env');
    }
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    http_response_code(503);
    die("Service temporarily unavailable. Please try again shortly.");
}
?>
