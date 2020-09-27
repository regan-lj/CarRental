<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoCars | Map</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../javascript/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../leaflet/leaflet.css"/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="../leaflet/leaflet.js"></script>
    <script src="../javascript/map.js"></script>
    <script src="../javascript/displayReviews.js"></script>
</head>
<header>
    <div id="header">
        <h1>GeoCars</h1>
        <p>Same-day car rentals in Dunedin</p>
        <nav class="table">
            <ul id="page-links">
                <li> <a href="index.php">Rentals</a>
                <li> <a href="custBooking.php">My Bookings</a>
                <li> <a style="background-color: #ffd6ba">More Info</a>
            </ul>
        </nav>
    </div>
</header>
<body>

<div class="markerButtons"><br>
<input type="button" id="toggleRestaurants" value="Show Restaurants" class="markersButton">
<input type="button" id="toggleLandmarks" value="Show Landmarks" class="markersButton">
</div><br>

<figure id="map"></figure><br>

</body>
<footer>
    <br><br>
    <hr style="width:80%">
    <div id="footerReviews" class="reviews">
        <h3>Reviews for GeoCar:</h3>
    </div>
</footer>
</html>