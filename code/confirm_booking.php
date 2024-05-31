<?php
include 'config.php';
include 'templates/header.html';


if (!isset($_POST['id']) || !isset($_POST['booking_confirmation'])) {
    echo "No booking ID or confirmation provided.";
    exit;
}

$id = $_POST['id'];
$booking_confirmation = $_POST['booking_confirmation'];

// Prepare the SQL statement
$sql = "UPDATE bookings SET booking_confirmation = ? WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('si', $booking_confirmation, $id);

if ($stmt->execute()) {
    // Send email
    require 'send_mail.php';

    $sqlEmail = "SELECT email_address FROM bookings WHERE id = ?";
    $stmtEmail = $mysqli->prepare($sqlEmail);
    $stmtEmail->bind_param('i', $id);
    $stmtEmail->execute();
    $stmtEmail->bind_result($email_address);
    $stmtEmail->fetch();
    $stmtEmail->close();

    $subject = "Your Booking Confirmation";
    $message = "Booking Confirmation: " . $booking_confirmation;
    if (send_mail($email_address, $subject, $message)) {
        echo "Booking confirmed successfully and email sent.";
    } else {
        echo "Booking confirmed successfully, but email could not be sent.";
    }

    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();

include 'footer.php';
?>
