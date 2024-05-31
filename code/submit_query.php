<?php
include 'config.php';

$user_name = $_POST['user_name'];
$telephone_number = $_POST['telephone_number'];
$email_address = $_POST['email_address'];
$date_time = $_POST['date_time'];
$query = $_POST['query'];

$sql = "INSERT INTO queries (user_name, telephone_number, email_address, date_time, query) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sssss', $user_name, $telephone_number, $email_address, $date_time, $query);

if ($stmt->execute()) {
    echo "<script>alert('Query submitted successfully'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
