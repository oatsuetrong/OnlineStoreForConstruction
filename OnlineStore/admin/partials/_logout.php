<?php

session_start();
echo "Logging you out. Please wait...";
unset($_SESSION["adminloggedin"]);
unset($_SESSION["adminusername"]);
unset($_SESSION["adminuserId"]);

// session_unset();
// session_destroy();

header("location: ../../admin/login.php");
?>
