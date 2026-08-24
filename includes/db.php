<?php
// includes/db.php

$host = 'localhost';
$port = '3306';
$dbname = 'u432404563_grovixowebsite';
$user = 'u432404563_grovixowebsite';
$pass = 'Grovixo@2030';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Fail gracefully on localhost or without DB
    $pdo = null;
    // error_log("Database connection failed: " . $e->getMessage());
}
?>
