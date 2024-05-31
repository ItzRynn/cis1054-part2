<?php
// Check if a session is already started, and start it if not
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define the root directory
define('ROOT', __DIR__);

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'restaurant');
define('DB_USER', 'root');  // Update with your MySQL username
define('DB_PASS', '');      // Update with your MySQL password

// Create a connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Include the functions file
include ROOT . '/includes/functions.php';
?>
