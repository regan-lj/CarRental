<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoCars | Rentals</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<?php
$scriptList = array('../javascript/jquery-3.5.1.min.js',
                    '../javascript/displayCars.js',
                    '../javascript/makeBooking.js');
include('../hidden/header.php');
?>
<body>
<!-- Booking Modal -->
<div id="modal-box" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times</span>
        <h1 id="registration-number"></h1>
        <p id="validateDates"></p>
        <p id="validateName"></p><br>
        <form id="bookingForm" method="post" action="saveBooking.php">

            <label for="pick-up">Pick Up:</label>&ensp;
            <input type="date" id="pick-up" name="pick-up">&nbsp;&nbsp;&nbsp;&nbsp;

            <label for="drop-off">Drop Off:</label>&ensp;
            <input type="date" id="drop-off" name="drop-off"><br><br>

            <p id="availability">Please Select Your Dates</p><br><br class="nameInput">

            <label for="nameInput" class="nameInput">Name:</label>&ensp;
            <input type="text" id="name" name="nameInput" class="nameInput">

            <br class="nameInput"><br class="nameInput"><br class="nameInput">
            <input type="submit" id="proceed" value="Proceed With Booking" class="proceedButton">
        </form>
    </div>

</div>

<div class="car-info"></div>

</body>
<?php include("../hidden/footer.php"); ?>
</html>