<?php
// includes/config.php
session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'petcare');
define('DB_USER', 'root');
define('DB_PASS', '');  // Empty for XAMPP, 'root' for MAMP

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Include functions
require_once 'functions.php';

function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>