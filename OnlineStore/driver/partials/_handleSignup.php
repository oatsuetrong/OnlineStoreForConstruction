<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include '_dbconnect.php';
	$username = $_POST["username"];
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
	
	// Check whether this username exists
	$existSql = "SELECT * FROM `users` WHERE `username` = '$username'";
	$result = mysqli_query($conn, $existSql);
	$numExistRows = mysqli_num_rows($result);
	if ($numExistRows > 0) {
		$showError = "Username Already Exists";
		header("Location: ../signup.php?signupsuccess=false&error=$showError");
	} else {
		if ($password == $cpassword) {
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO `users` ( `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`, `joinDate`) VALUES ('$username', '$firstName', '$lastName', '$email', '$phone', '2', '$hash', current_timestamp())";   
			$result = mysqli_query($conn, $sql);
			if ($result){
				$showAlert = true;
				header("Location: ../login.php");
			}
		} else {
			$showError = "Passwords do not match";
			header("Location: ../signup.php?signupsuccess=false&error=$showError");
		}
	}
}	
?>
