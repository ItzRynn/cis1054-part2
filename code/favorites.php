<?php
include 'config.php';
include 'send_mail.php'; // Include the send_mail function
include 'templates/header.html';

// Initialize the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize the favorites array if it doesn't exist
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = [];
}

// Fetch the favorite dish IDs from the session
$favorites = $_SESSION['favorites'];

// Handle removing from favorites
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_from_favorites'])) {
    $remove_id = intval($_POST['remove_id']);
    if (($key = array_search($remove_id, $favorites)) !== false) {
        unset($favorites[$key]);
        $_SESSION['favorites'] = $favorites;
    }
}

// An array to store favorite dishes
$favoriteDishes = [];

if (!empty($favorites)) {
    // Fetch details of each favorite dish from the database
    $placeholders = implode(',', array_fill(0, count($favorites), '?'));
    $types = str_repeat('i', count($favorites));
    $stmt = $mysqli->prepare("SELECT dishes.id, dishes.name, dishes.description, dishes.price, dishes.image, categories.name as category_name 
                              FROM dishes 
                              JOIN categories ON dishes.category_id = categories.id 
                              WHERE dishes.id IN ($placeholders)");
    $stmt->bind_param($types, ...$favorites);
    $stmt->execute();
    $result = $stmt->get_result();
    $favoriteDishes = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Handle sending email
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_email'])) {
    $to = $_POST['email'];
    $subject = "Your Favorite Dishes";
    
    // Prepare the email content with HTML formatting without images
    $message = "<h1>Your Favorite Dishes</h1><div style='font-family: Arial, sans-serif;'>";
    foreach ($favoriteDishes as $dish) {
        $message .= "<div style='margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;'>
                        <h2 style='color: #333;'>" . htmlspecialchars($dish['name']) . "</h2>
                        <p><strong>ID:</strong> " . htmlspecialchars($dish['id']) . "</p>
                        <p><strong>Price:</strong> €" . number_format((float)$dish['price'], 2, '.', '') . "</p>
                        <p><strong>Description:</strong> " . htmlspecialchars($dish['description']) . "</p>
                        <p><strong>Category:</strong> " . htmlspecialchars($dish['category_name']) . "</p>
                    </div>";
    }
    $message .= "</div>";

    // Send the email using the send_mail function
    send_mail($to, $subject, $message);
}

include 'templates/favorites.html';
include 'footer.php';
?>
