<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoCars | Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<?php
include('../hidden/header.php');
?>
<body>

<?php
if (isset($_POST['cancel'])) {

    // Get the json from bookings.json
    $input_filename = "../json/bookings.json";
    $output_filename = "../json/bookings.json";
    $json_input = file_get_contents($input_filename);
    $json = json_decode($json_input, true);

    // Identify index of booking and update the json
    $index = $_POST['index'];
    // Get all bookings before cancelled booking
    $updated_bookings = array_slice($json["bookings"]["booking"], 0, $index);
    // Add the bookings after cancelled booking
    $after = array_slice($json["bookings"]["booking"], $index+1);
    foreach ($after as $booking) {
        array_push($updated_bookings, $booking);
    }

    // Make the new json structure
    $new_booking = array("booking" => $updated_bookings);
    $new_bookings = array("bookings" => $new_booking);

    // Put back the new json
    $newJsonString = json_encode($new_bookings, JSON_PRETTY_PRINT)."\n";
    file_put_contents($output_filename, $newJsonString);

    // Notify admin that booking has been cancelled
    echo "<br><p class='center'>Booking successfully cancelled</p>";
}
?>

<br><h2 class="center">Admin</h2>

<?php
$input_filename = "../json/bookings.json";
$json_input = file_get_contents($input_filename);
$json = json_decode($json_input,true);
$index = 0; // Keep track of index

foreach ($json["bookings"]["booking"] as $booking) {
    $name = $booking["name"];
    $rego = $booking["number"];
    $pickup = $booking["pickup"];
    $dropoff = $booking["dropoff"];

    $p_day = $pickup["day"];
    $p_month = $pickup["month"];
    $p_year = $pickup["year"];
    $d_day = $dropoff["day"];
    $d_month = $dropoff["month"];
    $d_year = $dropoff["year"];

    // Display the booking information
    echo "<div class='car-info'>";
    echo "<h3>$rego</h3>";
    echo "<p>$name</p>";
    echo "<p>Pick Up: $p_day-$p_month-$p_year</p>";
    echo "<p>Drop Off: $d_day-$d_month-$d_year</p><br>";

    // Create a hidden form for cancellation
    echo "<form method='post'>";
    echo "<input type='hidden' value=$index name='index'>";
    echo "<input type='submit' name='cancel' class='cancelButton' value='Cancel'>";
    echo "</form>";
    echo "</div>";

    $index += 1;
}
?>

</body>
</html>