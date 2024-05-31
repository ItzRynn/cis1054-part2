<?php
session_start();
include 'config.php';
include 'templates/header.html';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to retrieve user credentials
    $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = 'admin'; // Assuming all users are admins for simplicity
        header('Location: admin.php');
        exit();
    } else {
        $error = 'Incorrect username or password';
    }
}

include 'templates/login.html';
include 'footer.php';
?>
