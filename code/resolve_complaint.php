<?php
include 'config.php'; // Include the configuration file for database connection
include 'templates/header.html'; // Include the header template

// Check if 'id' and 'response' are set in the POST request
if (!isset($_POST['id']) || !isset($_POST['response'])) {
    echo "No complaint ID or response provided.";
    exit;
}

// Sanitize input
$id = intval($_POST['id']); // Ensure ID is an integer
$response = htmlspecialchars($_POST['response'], ENT_QUOTES, 'UTF-8'); // Sanitize the response

// Prepare the SQL statement for updating the complaint response
$sql = "UPDATE complaints SET response = ? WHERE id = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    echo "Error preparing statement: " . $mysqli->error;
    exit;
}

$stmt->bind_param('si', $response, $id);

if ($stmt->execute()) {
    // Include the mail sending function
    require 'send_mail.php';

    // Prepare the SQL statement to get the email address
    $sqlEmail = "SELECT email_address FROM complaints WHERE id = ?";
    $stmtEmail = $mysqli->prepare($sqlEmail);

    if ($stmtEmail === false) {
        echo "Error preparing email statement: " . $mysqli->error;
        $stmt->close();
        exit;
    }

    $stmtEmail->bind_param('i', $id);
    $stmtEmail->execute();
    $stmtEmail->bind_result($email_address);
    $stmtEmail->fetch();
    $stmtEmail->close();

    if ($email_address) {
        // Define the subject and message for the email
        $subject = "Your Complaint Response";
        $message = "Response: " . $response;

        // Send the email and check the result
        if (send_mail($email_address, $subject, $message)) {
            echo "Complaint resolved successfully and email sent.";
        } else {
            echo "Complaint resolved successfully, but email could not be sent.";
        }
    } else {
        echo "Complaint resolved successfully, but no email address found.";
    }
} else {
    echo "Error executing statement: " . $stmt->error;
}

// Close the prepared statement and the database connection
$stmt->close();
$mysqli->close();

include 'footer.php';
?>
