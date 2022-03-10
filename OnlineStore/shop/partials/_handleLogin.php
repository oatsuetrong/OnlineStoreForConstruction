<?php
include '_swal.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['login'])) {    
		include '_dbconnect.php';
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM `shopuser` WHERE `username` = '$username'";
		$result = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($result);
		if ($num == 1) {
			$row = mysqli_fetch_array($result);
			if (password_verify($password, $row['password'])) {
				$status = $row['status'];
				if ($status == 1) {
					session_start();
					$_SESSION['shoploggedin'] = true;
					$_SESSION['shopusername'] = $row['username'];
					$_SESSION['shopuserId'] = $row['shopuserId'];
					$_SESSION['shopId'] = $row['shopId'];
					header("location: ../index.php?loginsuccess=true");
				} else {
				echo '<body>
				<script>
				swal("Fail","Your account is still pending for approval!","error").then((value) => {
						  				window.location.href = "../index.php";  
						});
				</script>
				</body>';

				}
				
			} else {
				header("location: ../login.php?loginsuccess=false");
			}
		} else {
			header("location: ../login.php?loginsuccess=false");
		}
	}
}
?>
