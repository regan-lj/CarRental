<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoCars | Fleet</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<?php
include('../hidden/header.php');
?>
<body>
<div class="center">

<?php

// Get the json from vehicles.json
$input_filename = "../json/vehicles.json";
$output_filename = "../json/vehicles.json";
$json_input = file_get_contents($input_filename);
$json = json_decode($json_input, true);

// DELETE VEHICLE
if (isset($_POST['deleteVehicle'])) {
    // Identify index of booking and update the json
    $index = $_POST['allVehicles'];
    // Get all vehicles before deleted vehicle
    $updated_vehicles = array_slice($json["fleet"]["vehicle"], 0, $index);
    // Add the bookings after cancelled booking
    $after = array_slice($json["fleet"]["vehicle"], $index+1);
    foreach ($after as $vehicle) {
        array_push($updated_vehicles, $vehicle);
    }

    // Make the new json structure
    $new_vehicle = array("vehicle" => $updated_vehicles);
    $new_vehicles = array("fleet" => $new_vehicle);

    // Put back the new json
    $newJsonString = json_encode($new_vehicles, JSON_PRETTY_PRINT)."\n";
    file_put_contents($output_filename, $newJsonString);

    echo "<p class='notify'>Vehicle successfully deleted.</p>";
}

// EDIT VEHICLE
if (isset($_POST['editVehicle'])) {
    $index = $_POST['allVehicles'];
}

?>

<form method="post">
    <br><label for='allVehicles'>Please select a vehicle from the list below.</label>
    <br<br><br><br><br>
    <select name='allVehicles' id='allVehicles'>
        <?php
        $count = 0; // Keep track of index for easy identification
        foreach ($json["fleet"]["vehicle"] as $vehicle) {
            $name = $vehicle["registration"];
            echo "<option value=$count>$name</option>";
            $count += 1;
        }
        ?>
    </select>
    <br><br><br><input type="submit" name="editVehicle" class="editButton" value="Edit Vehicle Details"><br><br>
    <input type="submit" name="deleteVehicle" class="deleteButton" value="Delete Vehicle">
</form>

</div>
</body>
</html>