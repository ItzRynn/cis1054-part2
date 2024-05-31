<?php
include 'config.php';

$user_name = $_POST['user_name'];
$telephone_number = $_POST['telephone_number'];
$email_address = $_POST['email_address'];
$date_time = $_POST['date_time'];
$complaint = $_POST['complaint'];

$sql = "INSERT INTO complaints (user_name, telephone_number, email_address, date_time, complaint) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sssss', $user_name, $telephone_number, $email_address, $date_time, $complaint);

if ($stmt->execute()) {
    echo "<script>alert('Complaint submitted successfully'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
