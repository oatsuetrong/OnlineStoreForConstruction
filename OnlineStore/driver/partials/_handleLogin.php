<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include '_dbconnect.php';
	$username = $_POST["username"];
	$password = $_POST["password"]; 
	
	$sql = "SELECT * FROM `users` WHERE `username` = '$username'"; 
	$result = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($result);
	if ($num == 1) {
		$row = mysqli_fetch_assoc($result);
		$userType = $row['userType'];
		if ($userType == 2) {
			$userId = $row['id'];
			if (password_verify($password, $row['password'])) { 
				session_start();
				$_SESSION['driverloggedin'] = true;
				$_SESSION['driverusername'] = $username;
				$_SESSION['driveruserId'] = $userId;
				header("location: ../../driver/index.php");
				exit();
			} else {
				header("location: ../../driver/login.php?loginsuccess=false");
			}
		} else {
			header("location: ../../driver/login.php?loginsuccess=false");
		}
	} else {
		header("location: ../../driver/login.php?loginsuccess=false");
	}
}
?>
