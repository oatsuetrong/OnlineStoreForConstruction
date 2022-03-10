<?php
include '_dbconnect.php';
include '_swal.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['updateDetail'])) {
		$shopId = $_SESSION['shopId'];
		$name = $_POST["name"];
		$contact = $_POST["contact"];
		$address = $_POST["address"];
		if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$sql = "UPDATE `shops` SET `latitude` = '$latitude' WHERE `shopId` = '$shopId'";   
			$result = mysqli_query($conn, $sql);
			$sql = "UPDATE `shops` SET `longitude` = '$longitude' WHERE `shopId` = '$shopId'";   
			$result = mysqli_query($conn, $sql);
		}

		$sql = "UPDATE `shops` SET shopName = '$name' WHERE `shopId` = '$shopId'";   
		$result = mysqli_query($conn, $sql);
		$sql = "UPDATE `shops` SET contact = '$contact' WHERE `shopId` = '$shopId'";   
		$result = mysqli_query($conn, $sql);
		$sql = "UPDATE `shops` SET `address` = '$address' WHERE `shopId` = '$shopId'";   
		$result = mysqli_query($conn, $sql);
		
		if ($result) {
					echo "<body>
							<script>
							swal('success','','success').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
		}
	}

	if (isset($_POST['updateShopPhoto'])) {
		$id = $_POST["shopId"];
		$check = getimagesize($_FILES["shopimage"]["tmp_name"]);
		if ($check !== false) {
			$newfilename = "shop-" . $id . ".jpg";

			$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/website/OnlineStore/img/';
			$uploadfile = $uploaddir . $newfilename;

			if (move_uploaded_file($_FILES['shopimage']['tmp_name'], $uploadfile)) {
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
	
	if (isset($_POST['removeShopPhoto'])) {
		$id = $_POST["shopId"];
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/website/OnlineStore/img/shop-" . $id . ".jpg";
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
