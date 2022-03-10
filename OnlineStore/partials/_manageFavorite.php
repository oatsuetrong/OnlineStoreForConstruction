<?php
include '_dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$userId = $_SESSION['userId'];

	if (isset($_POST['addToFavorite'])) {
		$shopId = $_POST["shopId"];
		
		// Check whether this item exists
		$existSql = "SELECT * FROM `favorite` WHERE `shopId` = '$shopId' AND `userId` = '$userId'";
		$result = mysqli_query($conn, $existSql);
		$numExistRows = mysqli_num_rows($result);
		if ($numExistRows > 0) {
			echo "<script>
					alert('Item Already Added.');
					window.history.back(1);
				</script>";
		} else {
			$sql = "INSERT INTO `favorite` (`shopId`, `userId`, `addedDate`) VALUES ('$shopId', '$userId', current_timestamp())";   
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>
						window.history.back(1);
					</script>";
			}
		}
	}

	if (isset($_POST['removeShop'])) {
		$shopId = $_POST["shopId"];
		$sql = "DELETE FROM `favorite` WHERE `shopId` = '$shopId' AND `userId` = '$userId'";   
		$result = mysqli_query($conn, $sql);
		echo "<script>
				alert('Removed');
				window.history.back(1);
			</script>";
	}

	if (isset($_POST['removeShopIndex'])) {
		$shopId = $_POST["shopId"];
		$sql = "DELETE FROM `favorite` WHERE `shopId` = '$shopId' AND `userId` = '$userId'";   
		$result = mysqli_query($conn, $sql);
		echo "<script>
				window.history.back(1);
			</script>";
	}

	if (isset($_POST['removeAllShop'])) {
		$sql = "DELETE FROM `favorite` WHERE `userId` = '$userId'";   
		$result = mysqli_query($conn, $sql);
		echo "<script>
				alert('Removed all');
				window.history.back(1);
			</script>";
	}
}
?>
