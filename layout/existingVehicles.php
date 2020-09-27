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

<form method="post" action="processVehicle.php">
    <br><label for='allVehicles'></label>
    <br<br>
    <select name='allVehicles' id='allVehicles'>
        <?php
        // Get the json from vehicles.json
        $input_filename = "../json/vehicles.json";
        $json_input = file_get_contents($input_filename);
        $json = json_decode($json_input, true);
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