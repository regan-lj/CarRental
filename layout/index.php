<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoCars | Rentals</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../javascript/jquery-3.5.1.min.js"></script>
    <script src="../javascript/displayCars.js"></script>
    <script src="../javascript/makeBooking.js"></script>
    <script src="../javascript/displayReviews.js"></script>
</head>
<header>
    <div id="header">
        <h1>GeoCars</h1>
        <p>Same-day car rentals in Dunedin</p>
        <div class="table">
            <ul id="page-links">
                <li> <a style="background-color: #ffd6ba">Rentals</a>
                <li> <a href="custBooking.php">My Bookings</a>
                <li> <a href="map.php">More Info</a>
            </ul>
        </div>
    </div>
</header>
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
<footer>
    <br><br><br>
    <hr style="width:80%">
    <div id="footerReviews" class="reviews">
        <h3>Reviews for GeoCar:</h3>
    </div>
</footer>
</html>