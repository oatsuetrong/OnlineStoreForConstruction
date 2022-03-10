<?php
include '_dbconnect.php';
include '_swal.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$userId = $_SESSION['userId'];
	if (isset($_POST['addToCart'])) {
		$itemId = $_POST["itemId"];
		$productCode = $_POST["productCode"];
		$shopId = $_POST["shopId"];
		
		// Check whether this item exists
		$existSql = "SELECT * FROM `viewcart` WHERE `productId` = '$itemId' AND `userId` = '$userId'";
		$result = mysqli_query($conn, $existSql);
		$numExistRows = mysqli_num_rows($result);
		if ($numExistRows > 0) {
					echo "<body>
							<script>
							swal('Done','Item Already Added.','success').then((value) => {
						  window.history.back(1);
						});
						</script>
						</body>";
		} else {
			$sql = "INSERT INTO `viewcart` (`productId`, `productCode`, `itemQuantity`, `shopId`, `userId`, `addedDate`) VALUES ('$itemId', '$productCode', '1', '$shopId', '$userId', current_timestamp())";   
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>
						window.history.back(1);
					</script>";
			}
		}
	}

	if (isset($_POST['addCheapest'])) {
		$productCode = $_POST["productCode"];

		// Check whether this item exists
		$existSql = "SELECT * FROM `viewcart` WHERE `productCode` = '$productCode' AND `userId` = '$userId'";
		$result = mysqli_query($conn, $existSql);
		$numExistRows = mysqli_num_rows($result);
		if ($numExistRows > 0) {
					echo "<body>
							<script>
		swal('Done','Item Already Added.','success').then((value) => {
						  window.history.back(1);
						});
						</script>
						</body>";
		} else {
			// Select favorite shop
			$favShopSql = "SELECT * FROM `favorite` WHERE `userId` = '$userId'";
			$favShopResult = mysqli_query($conn, $favShopSql);
			$numFavShop = mysqli_num_rows($favShopResult);
			if ($numFavShop > 0) {
				$combineShopId = "0";
				while ($favShop = mysqli_fetch_assoc($favShopResult)) {
					$shopId = $favShop['shopId'];
					$combineShopId = $combineShopId . "," . $shopId;
				}
				$findItemSql = "SELECT p.* FROM (SELECT * FROM `products` WHERE `shopId` IN ($combineShopId)) p WHERE `productCode` = '$productCode' AND quantity != 0 GROUP BY `productCode` HAVING MIN(`productPrice`)";
				$findItemResult = mysqli_query($conn, $findItemSql);
				$findItem = mysqli_fetch_assoc($findItemResult);
				$itemId = $findItem['productId'];
				$shopId = $findItem['shopId'];
				$sql = "INSERT INTO `viewcart` (`productId`, `productCode`, `itemQuantity`, `shopId`, `userId`, `addedDate`) VALUES ('$itemId', '$productCode', '1', '$shopId', '$userId', current_timestamp())";   
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo "<script>
							window.history.back(1);
						</script>";
				}
			} else {
				$findCheapestSql = "SELECT * FROM `products` WHERE `productCode` = '$productCode' ORDER BY `productPrice` ASC";
				$findCheapestResult = mysqli_query($conn, $findCheapestSql);
				$cheapest = mysqli_fetch_assoc($findCheapestResult);
				$itemId = $cheapest['productId'];
				$shopId = $cheapest['shopId'];
				$sql = "INSERT INTO `viewcart` (`productId`, `productCode`, `itemQuantity`, `shopId`, `userId`, `addedDate`) VALUES ('$itemId', '$productCode', '1', '$shopId', '$userId', current_timestamp())";   
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo "<script>
							window.history.back(1);
						</script>";
				}
			}
		}
	}

	if (isset($_POST['removeItem'])) {
		$itemId = $_POST["itemId"];
		$sql = "DELETE FROM `viewcart` WHERE `productId` = '$itemId' AND `userId` = '$userId'";   
		$result = mysqli_query($conn, $sql);
		echo "<script>
				alert('Removed');
				window.history.back(1);
			</script>";
	}

	if (isset($_POST['removeAllItem'])) {
		$sql = "DELETE FROM `viewcart` WHERE `userId` = '$userId'";   
		$result = mysqli_query($conn, $sql);
		echo "<script>
				alert('Removed All');
				window.history.back(1);
			</script>";
	}

	if (isset($_POST['selectShop'])) {
		$shopId = $_POST["shopId"];
		$_SESSION['selectedShopId'] = $shopId;
		$shopNameSql = "SELECT * FROM `shops` WHERE `shopId` = '$shopId'";
		$shopNameResult = mysqli_query($conn, $shopNameSql);
		$shopNameRow = mysqli_fetch_assoc($shopNameResult);
		$shopName = $shopNameRow['shopName'];
		echo '<body>
				<script>
				swal("Done","Selected ' . $shopName . '","success").then((value) => {
						  				window.location.href = "../viewCartOriginal.php";  
						});
			</script>
			</body>';
	}

	if (isset($_POST['shop'])) {
		echo '<form id="myForm" action="../viewCartOriginal.php" method="POST">
				<input type="hidden" name="shop" value="0">
				<input type="submit"> 
			</form>
		<script>document.getElementById("myForm").submit();</script>';
	}

	if (isset($_POST['system'])) {
		$totalPrice = $_POST['totalPrice'];
		echo '<form id="myForm" action="../viewCartOriginal.php" method="POST">';
				if ($totalPrice > 300) {
					echo '<input type="hidden" name="system" value="0">';
				} else {
					echo '<input type="hidden" name="system" value="300">';
				}
		echo '	<input type="submit">
			</form>
		<script>document.getElementById("myForm").submit();</script>';
	}

if (isset($_POST['checkout'])) {
		$shopId = $_SESSION['selectedShopId'];
		$amount = $_POST["amount"];
		$address = $_POST["address"];
		$phone = $_POST["phone"];
		$zipcode = $_POST["zipcode"];
		$password = $_POST["password"];
		$deliveryMethod = $_POST['deliveryMethod'];
		if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];
		} else {
			$latitude = null;
			$longitude = null;
		}
		
		$passSql = "SELECT * FROM users WHERE id = '$userId'"; 
		$passResult = mysqli_query($conn, $passSql);
		$passRow = mysqli_fetch_assoc($passResult);
		$userName = $passRow['username'];
		if (password_verify($password, $passRow['password'])) { 
			if (!is_null($latitude) && !is_null($longitude)) {
				$sql = "INSERT INTO orders (userId, address, zipCode, latitude, longitude, phoneNo, amount, paymentMode, deliveryMethod, orderStatus, orderDate) VALUES ('$userId', '$address', '$zipcode', '$latitude', '$longitude', '$phone', '$amount', '0', '$deliveryMethod', '0', current_timestamp())";
			} else {
				$sql = "INSERT INTO orders (userId, address, zipCode, phoneNo, amount, paymentMode, orderStatus, orderDate) VALUES ('$userId', '$address', '$zipcode', '$phone', '$amount', '0', '0', current_timestamp())";
			}
			$result = mysqli_query($conn, $sql);
			$orderId = $conn->insert_id;
			if ($result) {
				$addSql = "SELECT * FROM viewcart WHERE userId = '$userId' AND shopId = '$shopId'"; 
				$addResult = mysqli_query($conn, $addSql);
				while ($addrow = mysqli_fetch_assoc($addResult)) {
					$productId = $addrow['productId'];
					$productCode = $addrow['productCode'];
					$itemQuantity = $addrow['itemQuantity'];
					$itemSql = "INSERT INTO orderitems (orderId, productId, itemQuantity) VALUES ('$orderId', '$productId', '$itemQuantity')";
					$itemResult = mysqli_query($conn, $itemSql);
					$updateQuantitySql = "UPDATE pizza SET quantity`= quantity - '$itemQuantity' WHERE productId` = '$productId'";
					$updateQuantityResult = mysqli_query($conn, $updateQuantitySql);
					$deletesql = "DELETE FROM viewcart WHERE userId = '$userId' AND productCode = '$productCode'";   
					$deleteresult = mysqli_query($conn, $deletesql);
				}
				$deletesql = "DELETE FROM viewcart WHERE userId`='$userId' AND shopId`='$shopId'";   
				$deleteresult = mysqli_query($conn, $deletesql);
				if ($deliveryMethod == 1 || $deliveryMethod == 2) {
					$addNotiSql = "INSERT INTO notifications (orderId) VALUES ('$orderId')";
					$addNotiResult = mysqli_query($conn, $addNotiSql);
				}
				unset($_SESSION['selectedShopId']);
				echo '<body>
				<script>
				swal("Done","Thanks for ordering with us. Your order id is ' . $orderId . '.","success").then((value) => {
						  				window.location.href="../index.php";  
						});
				</script>
				</body>';

				exit();
			}
		} else {
			echo "<body>
				<script>
						swal('Fail','Incorrect Password! Please enter correct Password.','error').then((value) => {
						  window.history.back(1);
						});
			</script>
			</body>";
			exit();
		}    
	}

	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		if (isset($_POST['productCode'])) {
			$productCode = $_POST['productCode'];
			$qty = $_POST['quantity'];
			$updatesql = "UPDATE `viewcart` SET `itemQuantity` = '$qty' WHERE `productCode` = '$productCode' AND `userId` = '$userId'";
			$updateresult = mysqli_query($conn, $updatesql);
		}
		else if (isset($_POST['productId'])) {
			$productId = $_POST['productId'];
			$qty = $_POST['quantity'];
			$updatesql = "UPDATE `viewcart` SET `itemQuantity` = '$qty' WHERE `productId` = '$productId' AND `userId` = '$userId'";
			$updateresult = mysqli_query($conn, $updatesql);
		}
	}
}
?>
