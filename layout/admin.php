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

<br><h2 class="center">Admin</h2>

<?php
$input_filename = "../json/bookings.json";
$json_input = file_get_contents($input_filename);
$json = json_decode($json_input,true);

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

    echo "<div id='custViewBookings' class=\"car-info\">";
    echo "<h3>$rego</h3>";
    echo "<p>$name</p>";
    echo "<p>Pick Up: $p_day-$p_month-$p_year</p>";
    echo "<p>Drop Off: $d_day-$d_month-$d_year</p>";
    echo "</div>";
}
?>

</body>
</html>