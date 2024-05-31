<?php
session_start();
include 'config.php';
include 'templates/header.html';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];

    // Insert new category into the database
    $stmt = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $category_name);
    if ($stmt->execute()) {
        // Category added successfully, redirect to admin panel
        header('Location: admin.php');
        exit();
    } else {
        // Error occurred while adding category
        $error = 'Error: Unable to add category.';
    }
}

include 'templates/add_category.html';
include 'footer.php';
?>
