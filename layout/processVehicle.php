<?php
session_start();

// Should not be accessible outside of these forms
if (!isset($_POST['back']) && !isset($_POST['deleteVehicle']) &&
    !isset($_POST['editVehicle']) && !isset($_POST['submitEdit'])) {
    $lastPage = $_SESSION['lastPage'];
    header("Location: $lastPage");
    exit;
}

// GO BACK TO ALL VEHICLES
if (isset($_POST['back'])) {
    header("Location: existingVehicles.php");
    exit;
}

?>

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
    $json_input = file_get_contents($input_filename);
    $json = json_decode($json_input, true);

    // DELETE VEHICLE
    if (isset($_POST['deleteVehicle'])) {
        $output_filename = "../json/vehicles.json";
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

        echo "<p>Vehicle successfully deleted.</p>";
    }

    // SETUP EDIT SCREEN
    if (isset($_POST['editVehicle'])) {
        $index = $_POST['allVehicles'];
        // Get the vehicle information from the json file
        $vehicle = $json["fleet"]["vehicle"][$index];
        $registration = $vehicle["registration"];
        $vehicleType = $vehicle["vehicleType"];
        $description = $vehicle["description"];
        $pricePerDay = $vehicle["pricePerDay"];

        // Display an edit form with values pre-populated
        echo "<br><form method='post' class='editForm'>";
        echo "<label for='registration'>Registration: </label><br>";
        echo "<input type='text' name='registration' value='$registration' required><br><br>";
        echo "<label for='vehicleType'>Vehicle Type: </label><br>";
        echo "<input type='text' name='vehicleType' value='$vehicleType' required><br><br>";
        echo "<label for='description'>Description: </label><br>";
        echo "<textarea rows='5' name='description' required>$description</textarea><br><br>";
        echo "<label for='pricePerDay'>Price Per Day: </label><br>";
        echo "<input type='number' step='.01' name='pricePerDay' value='$pricePerDay' required><br><br>";
        echo "<input type='hidden' value=$index name='index'>";
        echo "<input class='editVButton' type='submit' value='Save' name='submitEdit'><br>";
        echo "</form>";
    }

    // EDIT VEHICLE
    if (isset($_POST['submitEdit'])) {
        $output_filename = "../json/vehicles.json";

        // Get form details
        $index = $_POST['index'];
        $registration = $_POST['registration'];
        $vehicleType = $_POST['vehicleType'];
        $description = $_POST['description'];
        $pricePerDay = $_POST['pricePerDay'];

        // Save the new details in the json file
        $json["fleet"]["vehicle"][$index]["registration"] = $registration;
        $json["fleet"]["vehicle"][$index]["vehicleType"] = $vehicleType;
        $json["fleet"]["vehicle"][$index]["description"] = $description;
        $json["fleet"]["vehicle"][$index]["pricePerDay"] = $pricePerDay;

        $newJsonString = json_encode($json,JSON_PRETTY_PRINT)."\n";
        file_put_contents($output_filename, $newJsonString);

        // Notify admin that details have been saved
        echo "<p>Vehicle successfully saved.</p>";
    }

    ?>

    <form method='post' class='editForm'>
    <input class='backButton' type='submit' value='Back' name='back'>
    </form>

</div>
</body>
</html>