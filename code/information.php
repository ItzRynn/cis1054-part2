<?php
include 'templates/header.html';
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="styles.css">
<head>
    <title>Information page</title>
</head>
<body>
    <div class="headers">
        <h2>Information</h2>
    </div>
    <br>
    <div class="infocategories">
        <h3>
            Address<br>
            <img class="pic" src="uploads/map.jpg" alt="Map image">
        </h3>
        <div class="infocategoriesmid">
            <p>Royal Burgers</p>
            <p>789 Main Street</p>
            <p>Sizzleville</p>
            <p>Malta</p>
        </div>
        <br>
        <h3>Opening hours</h3>
        <div class="infocategoriesmid">
            <p>Monday - Friday</p>
            <p>19:00 - 22:00</p>
            <br>
            <p>Saturday - Sunday</p>
            <p>18:00 - 23:00</p>
        </div>
    </div>
    <br>
    <div class="headers">
        <h3>Our Staff</h3>
    </div>
    <div class="panels">
        <div id="w1" class="worker">
            <img src="uploads/chef_pic.jpg" height="150" width="175" alt="Chef Picture">
            <p>Ryan Mizzi</p>
            <p>Chef</p>
        </div>
        <div id="w2" class="worker">
            <img src="uploads/waiter.jpg" height="150" width="175" alt="Waiter Picture">
            <p>Julian Zerafa</p>
            <p>Waiter</p>
        </div>
        <div id="w3" class="worker">
            <img src="uploads/shift_supervisor.jpg" height="150" width="175" alt="Shift Supervisor Picture">
            <p>Christian Mercieca</p>
            <p>Shift Supervisor</p>
        </div>
        <!-- Clearing div -->
        <div style="clear: both;"></div>
    </div>
</body>
</html>

<?php
include 'footer.php';
?>