<?php
include 'config.php';
include 'templates/header.html';

if (!isset($_POST['id']) || !isset($_POST['response'])) {
    echo "No query ID or response provided.";
    exit;
}

$id = $_POST['id'];
$response = $_POST['response'];

// Prepare the SQL statement
$sql = "UPDATE queries SET response = ? WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('si', $response, $id);

if ($stmt->execute()) {
    // Send email
    require 'send_mail.php';

    $sqlEmail = "SELECT email_address FROM queries WHERE id = ?";
    $stmtEmail = $mysqli->prepare($sqlEmail);
    $stmtEmail->bind_param('i', $id);
    $stmtEmail->execute();
    $stmtEmail->bind_result($email_address);
    $stmtEmail->fetch();
    $stmtEmail->close();

    $subject = "Your Query Response";
    $message = "Response: " . $response;
    if (send_mail($email_address, $subject, $message)) {
        echo "Query resolved successfully and email sent.";
    } else {
        echo "Query resolved successfully, but email could not be sent.";
    }

    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();

include 'footer.php';
?>
