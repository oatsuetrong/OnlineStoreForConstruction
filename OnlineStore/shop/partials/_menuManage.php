<?php
include '_dbconnect.php';
include '_swal.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['createItem'])) {
		$name = $_POST["name"];
		$description = $_POST["description"];
		$categoryId = $_POST["categoryId"];
		$price = $_POST["price"];
		$productCode = $_POST["productCode"];
		$quantity = $_POST["quantity"];
		$shopId = $_SESSION['shopId'] ;

		$existSql = "SELECT * FROM `products` WHERE `productCode` = '$productCode' AND `shopId` = '$shopId'";
		$existResult = mysqli_query($conn, $existSql);
		$numExistRows = mysqli_num_rows($existResult);
		if ($numExistRows > 0) {
					echo "<body>
							<script>
							swal('Fail','You have this product in the shop.','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
		} else {
			$sql = "INSERT INTO `products` (`productCode`, `productName`, `productPrice`, `productDesc`, `productCategorieId`, `shopId`, `quantity`, `productPubDate`) VALUES ('$productCode', '$name', '$price', '$description', '$categoryId','$shopId', '$quantity',current_timestamp())";   
			$result = mysqli_query($conn, $sql);
			$productId = $conn->insert_id;
			if ($result) {
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if ($check !== false) {
					$newName = 'product-' . $productId;
					$newfilename = $newName . ".jpg";
					$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/website/OnlineStore/img/';
					$uploadfile = $uploaddir . $newfilename;

					if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
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
	}

	if (isset($_POST['removeItem'])) {
		$productId = $_POST["productId"];
		$sql = "DELETE FROM `products` WHERE `productId`='$productId'";   
		$result = mysqli_query($conn, $sql);
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/OnlineStore/img/product-" . $productId . ".jpg";
		if ($result) {
			if (file_exists($filename)) {
				unlink($filename);
			}
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
							swal('Fail','','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
		}
	}

	if (isset($_POST['updateItem'])) {
		$productId = $_POST["productId"];
		$productCode = $_POST["productCode"];
		$productName = $_POST["name"];
		$productDesc = $_POST["desc"];
		$productPrice = $_POST["price"];
		$productCategorieId = $_POST["catId"];
		$quantity = $_POST["quantity"];		
		$sql = "UPDATE `products` SET `productCode` = '$productCode', `productName` = '$productName', `productPrice` = '$productPrice', `productDesc` = '$productDesc', `productCategorieId` = '$productCategorieId', `quantity` = '$quantity' WHERE `productId` = '$productId'";   
		$result = mysqli_query($conn, $sql);
		if ($result) {
					echo "<body>
							<script>
							swal('Updated','','success').then((value) => {
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

	if (isset($_POST['updateItemPhoto'])) {
		$productId = $_POST["productId"];
		$check = getimagesize($_FILES["itemimage"]["tmp_name"]);
		if ($check !== false) {
			$newName = 'product-' . $productId;
			$newfilename=$newName . ".jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/website/OnlineStore/img/';
			$uploadfile = $uploaddir . $newfilename;
			if (move_uploaded_file($_FILES['itemimage']['tmp_name'], $uploadfile)) {
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
}
?>