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
                if ($currentPage === 'index.php') {
                    echo "<li> <a style='background-color: #ffd6ba'>Rentals</a>";
                } else {
                    echo "<li> <a href='../layout/index.php'>Rentals</a>";
                }
                if ($currentPage === 'custBooking.php') {
                    echo "<li> <a style='background-color: #ffd6ba'>My Bookings</a>";
                } else {
                    echo "<li> <a href='../layout/custBooking.php'>My Bookings</a>";
                }
                if ($currentPage === 'map.php') {
                    echo "<li> <a style='background-color: #ffd6ba'>More Info</a>";
                } else {
                    echo "<li> <a href='../layout/map.php'>More Info</a>";
                }
                ?>
            </ul>
        </div>
    </div>
</header>