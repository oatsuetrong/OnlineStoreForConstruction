<?php
include '_dbconnect.php';
include '_swal.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['removeUser'])) {
		$shopuserId = $_POST["shopuserId"];
		$sql = "DELETE FROM `shopuser` WHERE `shopuserId` = '$shopuserId'";   
		$result = mysqli_query($conn, $sql);
		echo "<script>alert('Removed');
				window.location=document.referrer;
			</script>";
	}

	if (isset($_POST['createUser'])) {
		//$shopId = $_POST["shopId"];
		$username = $_POST["username"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$cpassword = $_POST["cpassword"];
		
		// Check whether this username exists
		$existSql = "SELECT * FROM `shopuser` WHERE `username` = '$username'";
		$result = mysqli_query($conn, $existSql);
		$numExistRows = mysqli_num_rows($result);
		// $numExistRows2 = mysqli_fetch_array($result);

		// $shopId = $numExistRows2['shopId'];
		$shopId = $_SESSION['shopId'] ;

		if ($numExistRows > 0) {
					echo "<body>
							<script>
							swal('Fail','Username Already Exists','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
		} else {
			if (($password == $cpassword)) {
				$hash = password_hash($password, PASSWORD_DEFAULT);
				$sql = "INSERT INTO `shopuser` (shopId, firstname, lastname, username, password, userType, status, email) VALUES ('$shopId', '$firstname' , '$lastname' , '$username', '$hash', '2' , '1', '$email')"; 
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo "<body>
							<script>
							swal('success','','success').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
				} else {
					echo "<body>
							<script>
							swal('Fail','','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
				}
			} else {
					echo "<body>
							<script>
							swal('Fail','Passwords do not match','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
			}
		}
	}

	if (isset($_POST['editUser'])) {
		$id = $_POST["shopuserId"];
		$firstname = $_POST["firstName"];
		$lastname = $_POST["lastName"];
		$email = $_POST["email"];

		$sql = "UPDATE `shopuser` SET `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email' WHERE `shopuserid` = '$id'";   
		$result = mysqli_query($conn, $sql);
		if ($result) {
					echo "<body>
							<script>
							swal('success','update successfully','success').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
		} else {
					echo "<body>
							<script>
							swal('Fail','','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
		}
	}
	
	if (isset($_POST['updateProfilePhoto'])) {
		$id = $_POST["shopuserId"];
		$check = getimagesize($_FILES["userimage"]["tmp_name"]);
		if ($check !== false) {
			$newfilename = "person-".$id.".jpg";

			$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/website/OnlineStore/shop/assetsForSideBar/img/';
			$uploadfile = $uploaddir . $newfilename;

			if (move_uploaded_file($_FILES['userimage']['tmp_name'], $uploadfile)) {
					echo "<body>
							<script>
							swal('success','','success').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
			} else {
					echo "<body>
							<script>
							swal('Fail','','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
			}
		} else {
					echo "<body>
							<script>
							swal('Fail','Please select an image file to upload.','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
		}
	}
	
	if (isset($_POST['removeProfilePhoto'])) {
		$id = $_POST["shopuserId"];
		$filename = $_SERVER['DOCUMENT_ROOT']."/website/OnlineStore/shop/assetsForSideBar/img/person-".$id.".jpg";
		if (file_exists($filename)) {
			unlink($filename);
					echo "<body>
							<script>
							swal('Removed','Remove successfully','success').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
		} else {
					echo "<body>
							<script>
							swal('Fail','no photo available','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";

		}
	}
}
?>
