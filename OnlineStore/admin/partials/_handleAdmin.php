<?php
include '_dbconnect.php';
include '_swal.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['approve'])) {
		$id = $_POST['shopuserId'];
		$sql = "UPDATE `shopuser` SET `status` = '1' WHERE `shopuserId` = '$id'";
		$result = mysqli_query($conn, $sql);
		echo '<body>
				<script>
					addFunction()
				</script>
			</body>';
	}

	if (isset($_POST['approveAll'])) {
		$sql = "UPDATE `shopuser` SET `status` = '1'";
		$result = mysqli_query($conn, $sql);
		echo '<script>
				alert("All Users Approved!");
				window.location.href = "../index.php"
			</script>';
	}


	if (isset($_POST['deny'])) {
		$id = $_POST['shopuserId'];
		$sql = "DELETE FROM `shopuser` WHERE `shopuserId` = '$id'";
		$result = mysqli_query($conn, $sql);
		echo '<body>
				<script>
					addFunction()
				</script>
			</body>';
	}

	if (isset($_POST['denyAll'])) {
		$sql = "DELETE FROM `shopuser` WHERE `status` = '0'";
		$result = mysqli_query($conn, $sql);
		echo '<script>
				alert("All Users Denied!");
				window.location.href = "../index.php"
			</script>';
	}
}
?>
