<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include '_dbconnect.php';
	$shopname = $_POST['shopname'];   
	$firstname = $_POST['firstname'];   
	$lastname = $_POST['lastname'];   
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST["cpassword"];
	$contact = $_POST['contact'];
	$address = $_POST['address'];

	// Check whether this username exists
	$existSql = "SELECT * FROM `shopuser` WHERE `username` = '$username'";
	$result2 = mysqli_query($conn, $existSql);
	$numExistRows = mysqli_num_rows($result2);
	if ($numExistRows > 0) {
		$showError = "Username Already Exists";
		header("Location: ../register.php?signupsuccess=false&error=$showError");
	} else {
		if ($password == $cpassword) {
			// Add shop first
			$addshop = "INSERT INTO `shops` (shopName, contact, address) VALUES ('$shopname', '$contact' , '$address')"; 
			$result3 = mysqli_query($conn, $addshop);

			// Then, query shopId
			$sql = "SELECT * FROM `shops` WHERE `shopName` = '$shopname'"; 
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$shopuserId = $row['shopId'];

			// Finally, add shop user
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO `shopuser` (shopId, firstname, lastname, username, password, userType, status, email) VALUES ('$shopuserId', '$firstname' , '$lastname' , '$username', '$hash', '1' , '0', '$email')"; 
			$result = mysqli_query($conn, $sql);
			if ($result2){
				$showAlert = true;
				header("Location: ../index.php?signupsuccess=true");
			}
		} else {
			$showError = "Passwords do not match";
			header("Location: ../register.php?signupsuccess=false&error=$showError");
		}
	}
}	
?>
