<?php
include '_dbconnect.php';
include '_swal.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$userId = $_SESSION['driveruserId'];

	if (isset($_POST['accept'])) {
		$checkCurrentJobSql = "SELECT * FROM `notifications` WHERE `deliveryId` = '$userId' AND `isDone` = '0' ORDER BY `time` ASC";
		$checkCurrentJobResult = mysqli_query($conn, $checkCurrentJobSql);
		$numCheckCurrentJob = mysqli_num_rows($checkCurrentJobResult);
		if ($numCheckCurrentJob > 0) {
			$checkCurrentJob = mysqli_fetch_assoc($checkCurrentJobResult);
			$notificationId = $checkCurrentJob['notificationId'];
			$_SESSION['delivery'] = true;
			$_SESSION['notificationId'] = $notificationId;
					echo "<body>
							<script>
							fullFunction()
						</script>
						</body>";
		} else {
			$notificationId = $_POST['notificationId'];
			$sql = "UPDATE `notifications` SET `deliveryId` = '$userId' WHERE `notificationId` = '$notificationId'";
			$result = mysqli_query($conn, $sql);
			$orderIdSql = "SELECT `orderId` FROM `notifications` WHERE `notificationId` = '$notificationId'";
			$orderIdResult = mysqli_query($conn, $orderIdSql);
			$orderIdDetail = mysqli_fetch_assoc($orderIdResult);
			$orderId = $orderIdDetail['orderId'];
			$deliveryDetailSql = "SELECT * FROM `users` WHERE `id` = '$userId'";
			$deliveryDetailResult = mysqli_query($conn, $deliveryDetailSql);
			$deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
			$name = $deliveryDetailRow['firstName'] . " " . $deliveryDetailRow['lastName'];
			$phone = $deliveryDetailRow['phone'];
			$insertSql = "INSERT INTO `deliverydetails` (`orderId`, `deliveryBoyName`, `deliveryBoyPhoneNo`, `deliveryTime`, `dateTime`) VALUES ('$orderId', '$name', '$phone', '$time', current_timestamp())";
			$insertResult = mysqli_query($conn, $insertSql);
			$_SESSION['delivery'] = true;
			$_SESSION['notificationId'] = $notificationId;
			echo "<script>
					window.location.href = '../index.php';
				</script>";
		}
	}

	if (isset($_POST['done'])) {
		$notificationId = $_SESSION['notificationId'];
		$orderIdSql = "SELECT `orderId` FROM `notifications` WHERE `notificationId` = '$notificationId'";
		$orderIdResult = mysqli_query($conn, $orderIdSql);
		$orderIdDetail = mysqli_fetch_assoc($orderIdResult);
		$orderId = $orderIdDetail['orderId'];
		$sql = "UPDATE `notifications` SET `isDone` = '1' WHERE `notificationId` = '$notificationId'";
		$result = mysqli_query($conn, $sql);
		$sql = "UPDATE `orders` SET `orderStatus` = '4' WHERE `orderId` = '$orderId'";
		$result = mysqli_query($conn, $sql);
		unset($_SESSION["delivery"]);
		unset($_SESSION["notificationId"]);
		echo "<script>
				window.location.href = '../index.php';
			</script>";
	}
}
?>
