<?php
include 'config.php';

// Check if a session is already started, and start it if not
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $stmt = $mysqli->prepare("DELETE FROM dishes WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $stmt->close();
}

header('Location: admin.php');
exit();
?>
