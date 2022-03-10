<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Signup</title>
	<link rel="icon" href="../../OnlineStore/img/logo (4).png" type="image/x-icon">

	<!-- Custom fonts for this template-->
	<link href="assetsForSidebar/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="assetsForSidebar/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
	<div class="container">
		<?php
			if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
				$error = $_GET['error'];
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> ' . $error . '
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
					</div>';
			}
		?>
		<div class="card o-hidden border-0 shadow-lg my-5">
			<div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
					<div class="col-lg-5 d-none d-lg-block">
						<img class="img-fluid" src="assetsForSideBar/img/signup.png">
					</div>
					<div class="col-lg-7">
						<div class="p-5">
							<div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
							</div>
							<form class="user" action="partials/_handleSignup.php" method="POST">
								<div class="form-group">
									<input type="text" class="form-control form-control-user" name="username" placeholder="Username">
								</div>
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input type="text" class="form-control form-control-user" name="firstName" placeholder="First Name">
									</div>
									<div class="col-sm-6">
										<input type="text" class="form-control form-control-user" name="lastName" placeholder="Last Name">
									</div>
								</div>
								<div class="form-group">
									<input type="email" class="form-control form-control-user" name="email" placeholder="Email Address">
								</div>
								<div class="form-group">
									<input type="tel" class="form-control form-control-user" name="phone" placeholder="Phone Number">
								</div>
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input type="password" class="form-control form-control-user" name="password" placeholder="Password">
									</div>
									<div class="col-sm-6">
										<input type="password" class="form-control form-control-user" name="cpassword" placeholder="Repeat Password">
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-user btn-block">Signup</button>
							</form>
							<hr>
							<button type="submit" class="btn btn-google btn-user btn-block">
								<i class="fab fa-google fa-fw"></i> Register with Google
							</button>
							<hr>
							<div class="text-center">
								<a class="small" href="login.php">Already have an account?</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="assetsForSidebar/vendor/jquery/jquery.min.js"></script>
	<script src="assetsForSidebar/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="assetsForSidebar/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
