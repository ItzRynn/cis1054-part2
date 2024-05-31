<?php
include 'config.php';

$booking_name = $_POST['booking_name'];
$telephone_number = $_POST['telephone_number'];
$email_address = $_POST['email_address'];
$number_of_seats = $_POST['number_of_seats'];
$date_time = $_POST['date_time'];

$currentDateTime = new DateTime();
$selectedDateTime = new DateTime($date_time);

if ($selectedDateTime < $currentDateTime) {
    echo "Error: The selected date and time is in the past. Please choose a future date and time.";
} elseif ($number_of_seats > 10) {
    echo "Error: The maximum number of seats you can book is 10.";
} elseif ($selectedDateTime->format('i') % 30 !== 0) {
    echo "Error: Please select a time in 30-minute increments.";
} else {
    $sql = "INSERT INTO bookings (booking_name, telephone_number, email_address, number_of_seats, date_time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssis', $booking_name, $telephone_number, $email_address, $number_of_seats, $date_time);

    if ($stmt->execute()) {
        echo "Booking submitted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();

    header('Location: index.php');
}
?>