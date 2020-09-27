<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoCars | Map</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="../leaflet/leaflet.css"/>
</head>
<?php
$scriptList = array('../javascript/jquery-3.5.1.min.js',
    '../leaflet/leaflet.js',
    '../javascript/map.js');
include('../hidden/header.php');
?>
<body>

<div class="markerButtons"><br>
<input type="button" id="toggleRestaurants" value="Show Restaurants" class="markersButton">
<input type="button" id="toggleLandmarks" value="Show Landmarks" class="markersButton">
</div><br>

<figure id="map"></figure><br>

</body>
<?php include("../hidden/footer.php"); ?>
</html>