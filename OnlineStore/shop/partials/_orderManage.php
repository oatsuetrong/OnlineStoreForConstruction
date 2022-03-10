<?php
include '_dbconnect.php';
include '_swal.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['updateStatus'])) {
		$orderId = $_POST['orderId'];
		$status = $_POST['status'];
		$sql = "UPDATE `orders` SET `orderStatus` = '$status' WHERE `orderId` = '$orderId'";   
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
	
	if (isset($_POST['updateDeliveryDetails'])) {
		$trackId = $_POST['trackId'];
		$orderId = $_POST['orderId'];
		$name = $_POST['name'];
		$time = $_POST['time'];
		$phone = $_POST['phone'];
		if ($trackId == NULL) {
			$sql = "INSERT INTO `deliverydetails` (`orderId`, `deliveryBoyName`, `deliveryBoyPhoneNo`, `deliveryTime`, `dateTime`) VALUES ('$orderId', '$name', '$phone', '$time', current_timestamp())";
			$result = mysqli_query($conn, $sql);
			$trackId = $conn->insert_id;
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
		} else {
			$sql = "UPDATE `deliverydetails` SET `deliveryBoyName` = '$name', `deliveryBoyPhoneNo` = '$phone', `deliveryTime` = '$time',`dateTime` = current_timestamp() WHERE `id` = '$trackId'";   
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
	}
}
?>
