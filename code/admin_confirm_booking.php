<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking Management</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php
include 'config.php';
include 'templates/header.html';

// Fetch all bookings
$sql = "SELECT id, booking_name, telephone_number, number_of_seats, date_time, email_address, booking_confirmation FROM bookings";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Booking Name</th><th>Telephone Number</th><th>Number of Seats</th><th>Date and Time</th><th>Email Address</th><th>Booking Confirmation</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['booking_name'] . "</td>";
        echo "<td>" . $row['telephone_number'] . "</td>";
        echo "<td>" . $row['number_of_seats'] . "</td>";
        echo "<td>" . $row['date_time'] . "</td>";
        echo "<td>" . $row['email_address'] . "</td>";
        echo "<td>" . $row['booking_confirmation'] . "</td>";
        echo "<td>";
        echo "<form action='confirm_booking.php' method='post' style='display:inline;'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='hidden' name='email_address' value='" . $row['email_address'] . "'>";
        echo "<input type='text' name='booking_confirmation' placeholder='Enter confirmation'>";
        echo "<input type='submit' value='Confirm'>";
        echo "</form>";
        echo "<form action='delete_booking.php' method='post' style='display:inline;'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No bookings found.";
}

$mysqli->close();

include 'footer.php';
?>
