<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	include '_dbconnect.php';
	$username = $_POST["username"];
	$password = $_POST["password"]; 
	
	$sql = "SELECT * FROM `users` WHERE `username` = '$username'"; 
	$result = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($result);
	if ($num == 1) {
		$row = mysqli_fetch_assoc($result);
		$userType = $row['userType'];
		if ($userType == 1) {
			$userId = $row['id'];
			if (password_verify($password, $row['password'])) { 
				session_start();
				$_SESSION['adminloggedin'] = true;
				$_SESSION['adminusername'] = $username;
				$_SESSION['adminuserId'] = $userId;
				header("location: ../../admin/index.php");
				exit();
			} else {
				header("location: ../../admin/login.php?loginsuccess=false");
			}
		} else {
			header("location: ../../admin/login.php?loginsuccess=false");
		}
	} else {
		header("location: ../../admin/login.php?loginsuccess=false");
	}
}
?>
