<?php
/**
 * Database connection (MySQL via PDO).
 * Fill in your phpMyAdmin / hosting credentials below.
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'ak_energies');   // create this database in phpMyAdmin, then import database.sql
define('DB_USER', 'root');          // your MySQL username
define('DB_PASS', '');              // your MySQL password

// Base URL of this admin folder (used to build upload links). No trailing slash.
define('BASE_URL', 'http://localhost/Solar-main/admin');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed: ' . htmlspecialchars($e->getMessage()) .
        '<br>Create a database named "' . DB_NAME . '" in phpMyAdmin and import database.sql, ' .
        'or edit config/db.php with your own credentials.');
}
