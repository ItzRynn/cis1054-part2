<?php
include 'config.php';

if (!isset($_POST['id'])) {
    echo "No complaint ID provided.";
    exit;
}

$id = $_POST['id'];

// Prepare the SQL statement
$sql = "DELETE FROM complaints WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    header("Location: admin.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
