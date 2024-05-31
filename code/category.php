<?php
include 'config.php';
include 'templates/header.html';

// Sanitize category ID
$category_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$category_id) {
    echo "<p>Invalid category ID.</p>";
    exit;
}

// Fetch category details
$query = "SELECT name FROM categories WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();
$category = $result->fetch_assoc();

if (!$category) {
    echo "<p>Category not found.</p>";
    exit;
}

// Fetch dishes for the category
$query = "SELECT id, name, price, image, description FROM dishes WHERE category_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();
$dishes = $result->fetch_all(MYSQLI_ASSOC);

include 'templates/category.html';
include 'footer.php';
?>
