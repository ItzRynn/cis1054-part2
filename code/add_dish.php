<?php

use Twig\Template;

include 'config.php';
include 'templates/header.html';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $categoryId = $_POST['category_id'];

    // Handle the image upload
    $image = $_FILES['image'];
    $imagePath = 'uploads/' . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $imagePath);

    $stmt = $mysqli->prepare("INSERT INTO dishes (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $name, $description, $price, $categoryId, $imagePath);
    $stmt->execute();
    $stmt->close();

    header('Location: admin.php');
    exit();
}

$categories = $mysqli->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);

include 'templates/add_dish.html';
include 'footer.php'; 
?>
