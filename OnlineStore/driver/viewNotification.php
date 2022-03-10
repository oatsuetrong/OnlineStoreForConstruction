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

	<title>Notification</title>
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

					<!-- Page Heading -->
					<h1 class="h3 mb-2 text-gray-800">Job</h1>

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary col-md-6 d-flex align-items-center">Jobs</h6>
						</div>
						
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th class="text-center">Job No.</th>
											<th>Quantity</th>
											<th>Order Time</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql = "SELECT * FROM `notifications` WHERE `deliveryId` IS NULL AND `isDone` = '0'"; 
											$result = mysqli_query($conn, $sql);
											while ($row = mysqli_fetch_assoc($result)) {
												$notificationId = $row['notificationId'];
												$orderId = $row['orderId'];
												$time = $row['time'];
												$countItemSql = "SELECT SUM(`itemQuantity`) FROM `orderitems` WHERE `orderId` = $orderId";
												$countItemResult = mysqli_query($conn, $countItemSql);
												$countItemRow = mysqli_fetch_assoc($countItemResult);
												$countItem = $countItemRow['SUM(`itemQuantity`)'];
												echo '<tr>
														<td class="text-center"><a href="viewNotificationDetail.php?noti=' . $notificationId . '">' . $notificationId . '</a></td>
														<td>' . $countItem . ' items</td>
														<td>' . $time . '</td>
														<td class="text-center">
															<button onclick="acceptJobAllJobPage(' . $notificationId . ')" class="btn btn-sm btn-success">Accept</button>
														</td>
													</tr>';
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
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

	<!-- Sweet Alert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="assetsForSideBar/js/sweetAlert.js"></script>
</body>
</html>

<?php
	} else {
		header("location: ../driver/login.php");
	}
?>
