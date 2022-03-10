<?php

session_start();
echo "Logging you out. Please wait...";
unset($_SESSION["driverloggedin"]);
unset($_SESSION["driverusername"]);
unset($_SESSION["driveruserId"]);

// session_unset();
// session_destroy();

header("location: ../../driver/login.php");
?>
