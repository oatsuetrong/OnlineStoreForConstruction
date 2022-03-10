

<?php
include '_dbconnect.php';
include '_swal.php';

session_start();

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$shopuserId = $_SESSION['shopuserId'];
	$shopId = $_SESSION['shopId'];
	if (isset($_POST['addToCart'])) {
		$search = $_POST["search"];
		$checkSql = "SELECT * FROM `products` WHERE `productCode` = '$search' AND `shopId` = '$shopId' AND `quantity` != 0";
		$checkResult = mysqli_query($conn, $checkSql);
		$numCheckRows = mysqli_num_rows($checkResult);
		if ($numCheckRows > 0) {
			$row = mysqli_fetch_assoc($checkResult);
			$productId = $row['productId'];
			// Check whether this item exists
			$existSql = "SELECT * FROM `onsitecart` WHERE `productCode` = '$search' AND `shopuserId` = '$shopuserId'";
			$result = mysqli_query($conn, $existSql);
			$numExistRows = mysqli_num_rows($result);
			if ($numExistRows > 0) {
				$updateQuantitySql = "UPDATE `onsitecart` SET `itemQuantity` = itemQuantity + 1 WHERE `productCode` = '$search' AND `shopuserId` = '$shopuserId'";
				$updateQuantityResult = mysqli_query($conn, $updateQuantitySql);
				echo "<script>
						window.history.back(1);
					</script>";
			} else {
				$sql = "INSERT INTO `onsitecart` (`productId`, `productCode`, `itemQuantity`, `shopId`, `shopuserId`, `addedDate`) VALUES ('$productId', '$search', '1', '$shopId', '$shopuserId', current_timestamp())"; 
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo "<body>
							<script>
							addFunction()
						</script>
						</body>";
				}
			}
		} else {
			echo "<body>
				<script>
				failFunction()
			</script>
			</body>";
		}
	}

	if (isset($_POST['removeItem'])) {
		$itemId = $_POST["itemId"];
		$sql = "DELETE FROM `onsitecart` WHERE `productId` = '$itemId' AND `shopuserId` = '$shopuserId'";
		$result = mysqli_query($conn, $sql);
		echo "<script>
						  window.history.back(1);
			</script>";
	}

	if (isset($_POST['removeAllItem'])) {
		$sql = "DELETE FROM `onsitecart` WHERE `shopuserId` = '$shopuserId'";   
		$result = mysqli_query($conn, $sql);
		echo "<script>
						  window.history.back(1);
			</script>";
	}

	if (isset($_POST['checkout'])) {
		$addSql = "SELECT * FROM `onsitecart` WHERE `shopuserId` = '$shopuserId'"; 
		$addResult = mysqli_query($conn, $addSql);
		while ($addrow = mysqli_fetch_assoc($addResult)) {
			$productId = $addrow['productId'];
			$itemQuantity = $addrow['itemQuantity'];
			$updateQuantitySql = "UPDATE `products` SET `quantity` = quantity - '$itemQuantity' WHERE `productId` = '$productId'";
			$updateQuantityResult = mysqli_query($conn, $updateQuantitySql);
		}
		$deletesql = "DELETE FROM `onsitecart` WHERE `shopuserId` = '$shopuserId'";   
		$deleteresult = mysqli_query($conn, $deletesql);
		echo '<script>
				window.location.href="../index.php";  
			</script>';
		exit();	
	}

	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		if (isset($_POST['productId'])) {
			$productId = $_POST['productId'];
			$qty = $_POST['quantity'];
			$updatesql = "UPDATE `onsitecart` SET `itemQuantity` = '$qty' WHERE `productId` = '$productId' AND `shopuserId` = '$shopuserId'";
			$updateresult = mysqli_query($conn, $updatesql);
		}
	}
}
?>
