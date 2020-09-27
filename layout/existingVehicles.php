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

<form method="post">
    <br><label for='allVehicles'>Please select a vehicle from the list below.</label>
    <br<br><br><br><br>
    <select name='allVehicles' id='allVehicles'>
        <?php
        // Get the json from bookings.json
        $input_filename = "../json/vehicles.json";
        $json_input = file_get_contents($input_filename);
        $json = json_decode($json_input, true);

        foreach ($json["fleet"]["vehicle"] as $vehicle) {
            $name = $vehicle["registration"];
            echo "<option value=$name>$name</option>";
        }
        ?>
    </select>
    <br><br><br><input type="submit" name="edit" class="editButton" value="Edit Vehicle Details"><br><br>
    <input type="submit" name="delete" class="deleteButton" value="Delete Vehicle">
</form>

</div>
</body>
</html>