<?php
session_start();
include 'config.php';
require_once 'includes/functions.php'; // Use require_once to prevent multiple inclusions
include 'templates/header.html';

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Load the menu
$menu = loadMenu($mysqli);

// Include the HTML template for displaying the menu
include 'templates/admin.html';
include 'footer.php';
?>
