<?php 
if (isset($_SESSION['driverloggedin']) && $_SESSION['driverloggedin'] == true) {
	$loggedin = true;
	$userId = $_SESSION['driveruserId'];
	$username = $_SESSION['driverusername'];
} else {
	$loggedin = false;
	$userId = 0;
}

?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
	<i class="fa fa-bars"></i>
</button>

	<!-- Topbar Navbar -->
	<ul class="navbar-nav ml-auto">
		<!-- Nav Item - Notifications -->
		<li class="nav-item dropdown no-arrow mx-1">
			<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-bell fa-fw"></i>
				<!-- Counter - Notifications -->
				<?php
					$countNotiSql = "SELECT COUNT(`notificationId`) FROM `notifications` WHERE `deliveryId` IS NULL AND `isDone` = '0'";
					$countNotiResult = mysqli_query($conn, $countNotiSql);
					$countNotiRow = mysqli_fetch_assoc($countNotiResult);
					$countNoti = $countNotiRow['COUNT(`notificationId`)'];
					if (!$countNoti) {
						$countNoti = 0;
					}

					if ($countNoti != 0) {
						echo '<span class="badge badge-danger badge-counter">' . $countNoti . '</span>';
					}
				?>
			</a>

			<!-- Dropdown - Jobs -->
			<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
				<h6 class="dropdown-header">
					Jobs Center
				</h6>
				<?php
					$sql = "SELECT * FROM `notifications` WHERE `deliveryId` IS NULL AND `isDone` = '0' ORDER BY `time` LIMIT 3";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						$notificationId = $row['notificationId'];
						$orderId = $row['orderId'];
						$time = $row['time'];
						echo '<a class="dropdown-item d-flex align-items-center" href="viewNotificationDetail.php?noti=' . $notificationId . '">
								<div class="mr-3">
									<div class="icon-circle bg-primary">
										<i class="fas fa-file-alt text-white"></i>
									</div>
								</div>

								<div>
									<div class="small text-gray-500">' . $time . '</div>
										<span class="font-weight-bold">Job No. ' . $notificationId . '</span>
								</div>
							</a>';
					}
				?>

				<a class="dropdown-item text-center small text-gray-500" href="viewNotification.php">Show All Jobs</a>
			</div>
		</li>

		<div class="topbar-divider d-none d-sm-block"></div>

		<!-- Nav Item - User Information -->
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username; ?></span>
				<img class="img-profile rounded-circle" src="assetsForSideBar/img/person-<?php echo $userId; ?>.jpg" onError="this.src = 'assetsForSideBar/img/profile.png'">
			</a>

			<!-- Dropdown - User Information -->
			<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="viewProfile.php">
					<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
					Profile
				</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="partials/_logout.php">
					<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
					Logout
				</a>
			</div>
		</li>
	</ul>
</nav>
<!-- End of Topbar -->
