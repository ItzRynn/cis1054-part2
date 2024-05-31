<?php
session_start();
include 'config.php';
include 'templates/header.html';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Fetch all categories from the database
$stmt = $mysqli->prepare("SELECT id, name FROM categories");
$stmt->execute();
$result = $stmt->get_result();
$categories = $result->fetch_all(MYSQLI_ASSOC);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];

    // Delete category from the database
    $stmt = $mysqli->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $category_id);
    if ($stmt->execute()) {
        // Category deleted successfully, redirect to admin panel
        header('Location: admin.php');
        exit();
    } else {
        // Error occurred while deleting category
        echo "Error: Unable to delete category.";
    }
}

include 'templates/delete_category.html';
include 'footer.php'; 
?>