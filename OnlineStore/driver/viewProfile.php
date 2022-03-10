<?php 
	session_start();
	include 'partials/_dbconnect.php';

	if (isset($_SESSION['driverloggedin']) && $_SESSION['driverloggedin'] == true) {
		$driverloggedin = true;
		$userId = $_SESSION['driveruserId'];
	} else {
		$driverloggedin = false;
		$userId = 0;
	}

	if ($driverloggedin) {
		$sql = "SELECT * FROM `users` WHERE `id` = '$userId'"; 
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$username = $row['username'];
		$firstName = $row['firstName'];
		$lastName = $row['lastName'];
		$email = $row['email'];
		$phone = $row['phone'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Profile</title>
	<link rel="icon" href="../../OnlineStore/img/logo (4).png" type="image/x-icon">

	<!-- Custom fonts for this template-->
	<link href="assetsForSideBar/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="assetsForSideBar/css/sb-admin-2.min.css" rel="stylesheet">

	<style>
		.upload-btn-wrapper {
			position: relative;
			overflow: hidden;
			display: inline-block;
		}

		button.btn.upload {
			border: 2px solid gray;
			background-color: #bababa;
			border-radius: 8px;
			font-size: 10px;
			font-weight: bold;
		}

		.upload-btn-wrapper input[type=file] {
			font-size: 100px;
			position: absolute;
			left: 0;
			top: 0;
			opacity: 0;
		}
	</style>
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
					<div class="row" style="margin: auto;">
						<div class="jumbotron content-panel mb-3 border p-3 col-md-4" style="display: flex; justify-content: center; border: 2px solid rgba(0, 0, 0, 0.1); border-radius: 1.1rem; margin: 0 auto;">
							<div class="user-info">
								<img class="rounded-circle mb-3 bg-dark" src="assetsForSideBar/img/person-<?php echo $userId; ?>.jpg" onError="this.src = 'assetsForSideBar/img/profile.png'" style="width:215px; height:215px; padding:1px;">
								<form action="partials/_manageProfile.php" method="POST">
									<small>Remove Image: </small><button type="submit" class="btn btn-danger" name="removeProfilePic" style="font-size: 12px; padding: 3px 8px; border-radius: 9px;">remove</button>
								</form>

								<form action="partials/_manageProfile.php" method="POST" enctype="multipart/form-data" style="margin-top: 7px;">
									<div class="upload-btn-wrapper">
										<small>Change Image: </small>
										<button class="btn upload">choose</button>
										<input type="file" name="image" id="image" accept="image/*">
									</div>
									<button type="submit" name="updateProfilePic" class="btn btn-primary" style="margin-top: -20px; font-size: 15px; padding: 3px 8px;">Update</button>
								</form>
										
								<ul class="meta list list-unstyled text-center">
									<li class="username my-2"><a href="viewProfile.php">@<?php echo $username ?></a></li>
									<li class="name"><?php echo $firstName . " " . $lastName; ?>
									</li>
									<li class="email"><?php echo $email ?></li>
									<li class="my-2"><a href="partials/_logout.php"><button class="btn btn-secondary" style="font-size: 15px; padding: 3px 8px;">Logout</button></a></li>
								</ul>
							</div>
						</div>

						<div class="content-panel mb-3" style="display: flex; justify-content: center; margin: 0 auto;">
							<div class="border p-3" style="border: 2px solid rgba(0, 0, 0, 0.1); border-radius: 1.1rem; background-color: aliceblue;">
								<h2 class="title text-center">Profile</h2>
								<form action="partials/_manageProfile.php" method="POST">
									<div class="form-group">
										<b><label for="username">Username: </label></b>
										<input class="form-control" id="username" name="username" type="text" disabled value="<?php echo $username ?>">
									</div>

									<div class="form-row">
										<div class="form-group col-md-6">
											<b><label for="firstName">First Name: </label></b>
											<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required value="<?php echo $firstName ?>">
										</div>

										<div class="form-group col-md-6">
											<b><label for="lastName">Last Name: </label></b>
											<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" required value="<?php echo $lastName ?>">
										</div>
									</div>

									<div class="form-group">
										<b><label for="email">Email: </label></b>
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required value="<?php echo $email ?>">
									</div>

									<div class="form-row">
										<div class="form-group  col-md-6">
											<b><label for="phone">Phone No: </label></b>
											<div class="input-group mb-3">
												<input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" required pattern="[0-9]{10}" maxlength="10" value="<?php echo $phone ?>">
											</div>
										</div>
										
										<div class="form-group  col-md-6">
											<b><label for="password">Password: </label></b>    
											<input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required minlength="4" maxlength="21" data-toggle="password">
										</div>
									</div>
									<button type="submit" name="updateProfileDetail" class="btn btn-primary">Update</button>
								</form>
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
	<script>
		$('#image').change(function() {
			var i = $(this).prev('button').clone();
			var file = ($('#image')[0].files[0].name).substring(0, 5) + "..";
			$(this).prev('button').text(file);
		});
	</script>
</body>
</html>

<?php
	} else {
		header("location: ../driver/login.php");
	}
?>
