<!DOCTYPE html>
<html lang="en">
<head>
    <title>Complaint Management</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php
include 'config.php';
include 'templates/header.html';

// Fetch all complaints
$sql = "SELECT id, user_name, telephone_number, email_address, date_time, complaint, response FROM complaints";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>User Name</th><th>Telephone Number</th><th>Email Address</th><th>Date and Time</th><th>Complaint</th><th>Response</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['user_name'] . "</td>";
        echo "<td>" . $row['telephone_number'] . "</td>";
        echo "<td>" . $row['email_address'] . "</td>";
        echo "<td>" . $row['date_time'] . "</td>";
        echo "<td>" . $row['complaint'] . "</td>";
        echo "<td>" . $row['response'] . "</td>";
        echo "<td>";
        echo "<form action='resolve_complaint.php' method='post' style='display:inline;'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='text' name='response' placeholder='Enter response'>";
        echo "<input type='submit' value='Resolve'>";
        echo "</form>";
        echo "<form action='delete_complaint.php' method='post' style='display:inline;'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No complaints found.";
}

$mysqli->close();

include 'footer.php';
?>
