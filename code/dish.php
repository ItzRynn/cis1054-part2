<?php
include 'config.php';
include 'templates/header.html';

// Initialize the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize the favorites array if it doesn't exist
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = [];
}

// Sanitize dish ID
$dish_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$dish_id) {
    echo "<p>Invalid dish ID.</p>";
    exit;
}

// Fetch dish details
$query = "SELECT dishes.id, dishes.name, dishes.price, dishes.image, dishes.description, categories.name as category_name 
          FROM dishes 
          JOIN categories ON dishes.category_id = categories.id 
          WHERE dishes.id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $dish_id);
$stmt->execute();
$result = $stmt->get_result();
$dish = $result->fetch_assoc();

if (!$dish) {
    echo "<p>Dish not found.</p>";
    exit;
}

// Check if the dish is in favorites
$isFavorite = in_array($dish_id, $_SESSION['favorites']);

// Handle adding/removing from favorites
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_to_favorites'])) {
        if (!in_array($dish_id, $_SESSION['favorites'])) {
            $_SESSION['favorites'][] = $dish_id;
        }
    } elseif (isset($_POST['remove_from_favorites'])) {
        if (($key = array_search($dish_id, $_SESSION['favorites'])) !== false) {
            unset($_SESSION['favorites'][$key]);
        }
    }
    header("Location: dish.php?id=$dish_id");
    exit;
}

include 'templates/dish.html';
include 'footer.php';
?>
