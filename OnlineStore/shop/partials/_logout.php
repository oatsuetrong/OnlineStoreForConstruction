<?php

session_start();
echo "Logging you out. Please wait...";
unset($_SESSION["shoploggedin"]);
unset($_SESSION["shopusername"]);
unset($_SESSION["shopuserId"]);
unset($_SESSION['shopId']);

// session_unset();
// session_destroy();

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
