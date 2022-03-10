<?php
	include '_dbconnect.php';
	include '_swal.php';

	session_start();
	$userId = $_SESSION['userId'];
	
	if (isset($_POST["updateProfilePic"])) {
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if ($check !== false) {
			$newfilename = "person-" . $userId . ".jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/website/OnlineStore/img/';
			$uploadfile = $uploaddir . $newfilename;

			if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
					echo "<body>
							<script>
							swal('success','Profile Already updated.','success').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";

			} else {
					echo "<body>
							<script>
							swal('Fail','image upload failed, please try again.','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";

			}
		} else {
					echo "<body>
							<script>
							swal('Fail','Please select an image file to upload.','error').then((value) => {
						  window.history.back(1);
						});
						</script>
						</body>";

		}
	}

	if (isset($_POST["updateProfileDetail"])) {
		$firstName = $_POST["firstName"];
		$lastName = $_POST["lastName"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$password =$_POST["password"];

		$passSql = "SELECT * FROM `users` WHERE `id` = '$userId'";
		$passResult = mysqli_query($conn, $passSql);
		$passRow = mysqli_fetch_assoc($passResult);
		if (password_verify($password, $passRow['password'])) { 
			$sql = "UPDATE `users` SET `firstName` = '$firstName', `lastName` = '$lastName', `email` = '$email', `phone` = '$phone' WHERE `id` ='$userId'";   
			$result = mysqli_query($conn, $sql);
			if ($result) {
					echo "<body>
							<script>
							swal('success','Profile Already updated.','success').then((value) => {
						  window.history.back(1);
						});
						</script>
						</body>";
			} else {
					echo "<body>
							<script>
							swal('Fail','Update failed, please try again.','error').then((value) => {
						  window.history.back(1);
						});
						</script>
						</body>";

			} 
		} else {
					echo "<body>
							<script>
							swal('Fail','Password is incorrect.','error').then((value) => {
						  window.history.back(1);
						});
						</script>
						</body>";

		}
	}
	
	if (isset($_POST["removeProfilePic"])) {
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/website/OnlineStore/img/person-" . $userId . ".jpg";
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
?>
