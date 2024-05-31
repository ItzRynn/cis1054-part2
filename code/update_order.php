<?php
session_start();
include 'config.php';

// Check if the user has admin privileges
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_POST['order'])) {
    $order = $_POST['order'];
    foreach ($order as $position => $id) {
        $id = str_replace('category-', '', $id); // remove 'category-' prefix
        $stmt = $mysqli->prepare("UPDATE categories SET display_order = ? WHERE id = ?");
        $stmt->bind_param('ii', $position, $id);
        $stmt->execute();
    }
}
?>
