<?php 
	session_start();
	include 'partials/_dbconnect.php';
	require 'partials/_manageThaiLang.php';
	
	if (isset($_SESSION['driverloggedin']) && $_SESSION['driverloggedin'] == true) {
		$driverloggedin = true;
		$userId = $_SESSION['driveruserId'];
	} else {
		$driverloggedin = false;
		$userId = 0;
	}

	if ($driverloggedin) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title id=title>Home</title>
	<link rel="icon" href="../../OnlineStore/img/logo (4).png" type="image/x-icon">

	<!-- Custom fonts for this template -->
	<link href="assetsForSideBar/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="assetsForSideBar/css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="assetsForSideBar/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		
		<?php require 'partials/_sidebar.php'; ?>

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				
				<?php require 'partials/_nav.php'; ?>

				<!-- Begin Page Content -->
				<div class="container-fluid">
					<?php
						if (isset($_SESSION['delivery']) && $_SESSION['delivery'] == true) {
							$notificationId = $_SESSION['notificationId'];
							echo '<script> document.getElementById("title").innerHTML = "Job No. ' . $notificationId . '"; </script>';
							$sql = "SELECT * FROM `notifications` WHERE `notificationId` = $notificationId";
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_assoc($result);
							$time = $row['time'];
							$orderId = $row['orderId'];
							$locationSql = "SELECT * FROM `orders` WHERE `orderId` = '$orderId'";
							$locationResult = mysqli_query($conn, $locationSql);
							$location = mysqli_fetch_assoc($locationResult);
							$address = $location['address'];
							$zipCode = $location['zipCode'];
							$phoneNo = $location['phoneNo'];
							$latitude = $location['latitude'];
							$longitude = $location['longitude'];
							$customerId = $location['userId'];
							$nameSql = "SELECT * FROM `users` WHERE `id` = '$customerId'";
							$nameResult = mysqli_query($conn, $nameSql);
							$customerName = mysqli_fetch_assoc($nameResult);
							$firstName = $customerName['firstName'];
							$lastName = $customerName['lastName'];
							$productIdSql = "SELECT `productId` FROM `orderitems` WHERE `orderId` = '$orderId'";
							$productIdResult = mysqli_query($conn, $productIdSql);
							$productIdRow = mysqli_fetch_assoc($productIdResult);
							$productId = $productIdRow['productId'];
							$shopNameSql = "SELECT * FROM `products` JOIN `shops` ON products.shopId = shops.shopId WHERE `productId` = '$productId'";
							$shopNameResult = mysqli_query($conn, $shopNameSql);
							$shopNameRow = mysqli_fetch_assoc($shopNameResult);
							$shopName = $shopNameRow['shopName'];
							$shopLatitude = $shopNameRow['latitude'];
							$shopLongitude = $shopNameRow['longitude'];
					?>
							<h1 class="h3 mb-2 text-gray-800">Job No. <?php echo $notificationId; ?></h1>
							<h1 class="h5 mb-2"><strong>Name: </strong><?php echo $firstName . " " . $lastName; ?></h1>
							<h1 class="h6 mb-2">
								<strong>Deliver to: </strong><?php echo $address . " " . $zipCode; ?>
								<?php
									if (!is_null($latitude) && !is_null($longitude)) {
										echo '<a target="_blank" href="https://maps.google.com/maps?q=' . $latitude . ',' .  $longitude . '"><i class="fas fa-directions"></i></a>';
									}
								?>
							</h1>
							<h1 class="h6 mb-2">
								<strong>From: </strong><?php echo $shopName; ?>
								<?php
									if (!is_null($shopLatitude) && !is_null($shopLongitude)) {
										echo '<a target="_blank" href="https://maps.google.com/maps?q=' . $shopLatitude . ',' .  $shopLongitude . '"><i class="fas fa-directions"></i></a>';
									}
								?>
							</h1>
							<h1 class="h6 mb-2"><strong>Contact: </strong><a href="tel:<?php echo $phoneNo; ?>"><?php echo $phoneNo; ?></a></h1>
							<div class="card shadow mb-3">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary col-md-6 d-flex align-items-center">Order Detail</h6>
								</div>
									
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Item</th>
													<th>Quantity</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sql = "SELECT * FROM `orderitems` WHERE `orderId` = '$orderId'"; 
													$result = mysqli_query($conn, $sql);
													while ($row = mysqli_fetch_assoc($result)) {
														$productId = $row['productId'];
														$itemQuantity = $row['itemQuantity'];
														$itemsql = "SELECT * FROM `products` WHERE `productId` = $productId";
														$itemresult = mysqli_query($conn, $itemsql);
														$itemrow = mysqli_fetch_assoc($itemresult);
														$productName = $itemrow['productName'];
														echo '<tr>
																<td>
																	<div class="p-2">
																		<img src="../img/product-' . $productId . '.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
																		<div class="ml-3 d-inline-block align-middle">
																			<h5 class="mb-0">' . $productName . '</h5>
																		</div>
																	</div>
																</td>
																<td>' . $itemQuantity . '</td>
															</tr>';
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<form class="text-center" action="partials/_manageNotification.php" method="POST">
								<button name="done" class="btn btn-primary mb-3">Done</button>
							</form>
					<?php
						} else {
							echo '<div class="text-center">
									<div class="error mx-auto"><i class="far fa-hourglass"></i></div>
									<p class="lead text-gray-800 mb-5">Waiting for Order</p>
								</div>';
						}
					?>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->

			<?php require 'partials/_footer.php'; ?>

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Bootstrap core JavaScript-->
	<script src="assetsForSideBar/vendor/jquery/jquery.min.js"></script>
	<script src="assetsForSideBar/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="assetsForSideBar/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="assetsForSideBar/js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="assetsForSideBar/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="assetsForSideBar/vendor/datatables/dataTables.bootstrap4.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="assetsForSideBar/js/demo/datatables-demo.js"></script>
	<!-- Reload whole page -->
	<!-- <script>
		setTimeout(function() {
			window.location.reload(1);
		}, 1000);
		console.log("reload");
	</script> -->
</body>
</html>

<?php
	} else {
		header("location: ../driver/login.php");
	}
?>
