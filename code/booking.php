<?php
include 'templates/header.html';
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="styles.css">
<head>
    <title>Submit a Booking</title>
    <script>
        function validateBookingForm() {
            var dateTimeInput = document.getElementById('date_time');
            var selectedDateTime = new Date(dateTimeInput.value);
            var currentDateTime = new Date();

            var numberOfSeats = document.getElementById('number_of_seats').value;

            if (selectedDateTime < currentDateTime) {
                alert("Please select a future date and time.");
                return false;
            }
            
            if (numberOfSeats > 10) {
                alert("You cannot book more than 10 seats.");
                return false;
            }

            if (selectedDateTime.getMinutes() % 30 !== 0) {
                alert("Please select a time in 30-minute increments.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h1>Submit a Booking</h1>
    <form action="submit_booking.php" method="post" onsubmit="return validateBookingForm()">
        Booking Name: <input type="text" name="booking_name" required><br>
        Telephone Number: <input type="text" name="telephone_number" required><br>
        Email: <input type="email" name="email_address" required><br>
        Number of Seats: <input type="number" id="number_of_seats" name="number_of_seats" max="10" required><br>
        Date and Time of Reservation: <input type="datetime-local" id="date_time" name="date_time" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
include 'footer.php';
?>