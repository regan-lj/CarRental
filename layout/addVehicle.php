<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoCars | Add Vehicle</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<?php
include('../hidden/header.php');
?>
<body>
<div class="center">
<?php

if (isset($_POST['submitVehicle'])) {
    // Get the submitted details
    $registration = $_POST['registration'];
    $vehicleType = $_POST['vehicleType'];
    $description = $_POST['description'];
    $pricePerDay = $_POST['pricePerDay'];

    // Get the json from vehicles.json
    $input_filename = "../json/vehicles.json";
    $output_filename = "../json/vehicles.json";
    $json_input = file_get_contents($input_filename);
    $json = json_decode($json_input,true);

    // Create our new vehicle array and add it to the json
    $new_vehicle = array("registration" => $registration,
                    "vehicleType" => $vehicleType,
                    "description" => $description,
                    "pricePerDay" => $pricePerDay);
    array_push($json["fleet"]["vehicle"], $new_vehicle);

    $newJsonString = json_encode($json,JSON_PRETTY_PRINT)."\n";
    file_put_contents($output_filename, $newJsonString);

    // Inform admin that the vehicle has been added
    echo "<br>Vehicle successfully added.<br><br>";
}

?>
<br><form method='post' class='editForm'>
    <label for='registration'>Registration: </label><br>
    <input type='text' name='registration' required><br><br>
    <label for='vehicleType'>Vehicle Type: </label><br>
    <input type='text' name='vehicleType' required><br><br>
    <label for='description'>Description: </label><br>
    <textarea rows='5' name='description' required></textarea><br><br>
    <label for='pricePerDay'>Price Per Day: </label><br>
    <input type='number' step='.01' name='pricePerDay' required><br><br>
    <input type='hidden' value=$index name='index'><br>
    <input class='editVButton' type='submit' value='Save Vehicle' name='submitVehicle'><br><br><br>
</form>
</div>

</body>
</html>