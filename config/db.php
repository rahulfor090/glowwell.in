<?php
/**
 * Database Connection Configuration (PDO & MySQLi)
 * Glow Well Consultants Pvt. Ltd.
 */

if (!defined('DB_HOST')) define('DB_HOST', '127.0.0.1');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');
if (!defined('DB_NAME')) define('DB_NAME', 'glowwellA');
if (!defined('DB_PORT')) define('DB_PORT', 3306);

// Global PDO instance
function get_pdo() {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Fail gracefully or log
            error_log("Database Connection Error: " . $e->getMessage());
            die("<div style='font-family:sans-serif;padding:30px;text-align:center;'><h2>Service Temporarily Unavailable</h2><p>Database connection failed. Please ensure MySQL is running in WAMP.</p></div>");
        }
    }
    return $pdo;
}

// Global MySQLi instance if needed
function get_mysqli() {
    static $mysqli = null;
    if ($mysqli === null) {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        if ($mysqli->connect_error) {
            error_log("MySQLi Connection Error: " . $mysqli->connect_error);
            return null;
        }
        $mysqli->set_charset("utf8mb4");
    }
    return $mysqli;
}
