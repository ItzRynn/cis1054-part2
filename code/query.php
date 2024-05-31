<?php
include 'templates/header.html';
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="styles.css">
<head>
    <title>Submit a Query</title>
</head>
<body>
    <h1>Submit a Query</h1>
    <form action="submit_query.php" method="post">
        Name: <input type="text" name="user_name" required><br>
        Telephone Number: <input type="text" name="telephone_number" required><br>
        Email: <input type="email" name="email_address" required><br>
        Date and Time of Query: <input type="datetime-local" name="date_time" required><br>
        Query: <textarea name="query" required></textarea><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
include 'footer.php';
?>