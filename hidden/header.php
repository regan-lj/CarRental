<?php
if (session_id() === "") {
    session_start();
}
$_SESSION['lastPage'] = $_SERVER['PHP_SELF'];

if (isset($scriptList) && is_array($scriptList)) {
    foreach ($scriptList as $script) {
        echo "<script src='$script'></script>";
    }
}
?>

<header>
    <div id="header">
        <h1>GeoCars</h1>
        <p>Same-day car rentals in Dunedin</p>
        <div class="table">
            <ul id="page-links">
                <?php
                $currentPage = basename($_SERVER['PHP_SELF']);
                if ($currentPage == 'admin.php' || $currentPage == 'addVehicle.php' ||
                $currentPage == 'existingVehicles.php') {
                    if ($currentPage === 'admin.php') {
                        echo "<li> <a style='background-color: #ffd6ba'>Bookings</a>";
                    } else {
                        echo "<li> <a href='../layout/admin.php'>Bookings</a>";
                    }
                    if ($currentPage === 'existingVehicles.php') {
                        echo "<li> <a style='background-color: #ffd6ba'>Fleet</a>";
                    } else {
                        echo "<li> <a href='../layout/existingVehicles.php'>Fleet</a>";
                    }
                    if ($currentPage === 'addVehicle.php') {
                        echo "<li> <a style='background-color: #ffd6ba'>Add Vehicle</a>";
                    } else {
                        echo "<li> <a href='../layout/addVehicle.php'>Add Vehicle</a>";
                    }
                } else {
                    if ($currentPage === 'index.php') {
                        echo "<li> <a style='background-color: #ffd6ba'>Rentals</a>";
                    } else {
                        echo "<li> <a href='../layout/index.php'>Rentals</a>";
                    }
                    if ($currentPage === 'map.php') {
                        echo "<li> <a style='background-color: #ffd6ba'>More Info</a>";
                    } else {
                        echo "<li> <a href='../layout/map.php'>More Info</a>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</header>