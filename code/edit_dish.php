<?php
include 'config.php';
include 'templates/header.html';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $categoryId = $_POST['category_id'];

    // Fetch existing image path
    $stmt = $mysqli->prepare("SELECT image FROM dishes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $dish = $result->fetch_assoc();
    $stmt->close();

    $imagePath = $dish['image']; // Default to existing image

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Validate file size (5MB max)
        if ($image['size'] > 5000000) {
            die("Sorry, your file is too large.");
        }

        // Move uploaded file
        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            $imagePath = $target_file;
        } else {
            die("Sorry, there was an error uploading your file.");
        }
    }

    // Update the dish details
    $stmt = $mysqli->prepare("UPDATE dishes SET name = ?, description = ?, price = ?, category_id = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssdssi", $name, $description, $price, $categoryId, $imagePath, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: admin.php');
    exit();
}

$id = $_GET['id'];
$stmt = $mysqli->prepare("SELECT * FROM dishes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$dish = $result->fetch_assoc();
$stmt->close();

$categories = $mysqli->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);

include 'templates/edit_dish.html';
include 'footer.php';
?>
