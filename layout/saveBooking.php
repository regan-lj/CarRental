<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoCars | Bookings</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<?php
$scriptList = array('../javascript/jquery-3.5.1.min.js');
include('../hidden/header.php');
?>
<body>

<?php

if (isset($_POST['proceed'])) {
    // Get all the submitted details
    $rego = $_POST['rego'];
    $name = $_POST['nameInput'];
    $pickup = $_POST['pick-up'];
    $pickup = explode('-', $pickup);
    $dropoff = $_POST['drop-off'];
    $dropoff = explode('-', $dropoff);

    // Get the json from bookings.json
    $input_filename = "../json/bookings.json";
    $output_filename = "../json/bookings.json";
    $json_input = file_get_contents($input_filename);
    $json = json_decode($json_input, true);

    // Add the details to the json
    $booking_pickup = array("day" => $pickup[2], "month" => $pickup[1], "year" => $pickup[0]);
    $booking_dropoff = array("day" => $dropoff[2], "month" => $dropoff[1], "year" => $dropoff[0]);
    $new_booking = array("number" => $rego, "name" => $name, "pickup" => $booking_pickup, "dropoff" => $booking_dropoff);
    array_push($json["bookings"]["booking"], $new_booking);

    // Put back the new json
    $newJsonString = json_encode($json, JSON_PRETTY_PRINT)."\n";
    file_put_contents($output_filename, $newJsonString);

    // Give the customer confirmation of booking
    echo "<br><p class='center'>Your booking has been successful! Details below.</p>";

    echo "<div id='custViewBookings' class=\"car-info\">";
    echo "<h3>$rego</h3>";
    echo "<p>$name</p>";
    echo "<p>Pick Up: $pickup[2]-$pickup[1]-$pickup[0]</p>";
    echo "<p>Drop Off: $dropoff[2]-$dropoff[1]-$dropoff[0]</p>";
    echo "</div>";

} else {
    header("Location: index.php");
    exit;
}
?>

</body>
<?php include("../hidden/footer.php"); ?>
</html>
