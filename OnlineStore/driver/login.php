<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Custom fonts for this template-->
	<link href="assetsForSideBar/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="assetsForSideBar/css/sb-admin-2.min.css" rel="stylesheet">
	
	<title>Login</title>
	<link rel="icon" href="../../OnlineStore/img/logo (4).png" type="image/x-icon">
</head>
<body class="bg-gradient-primary">
	<div class="container">
		<?php
			if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> Invalid Credentials
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
					</div>';
			}
		?>
		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block">
								<img class="img-fluid" src="assetsForSideBar/img/login.png">
							</div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
									</div>
									<form class="user" action="partials/_handleLogin.php" method="POST">
										<div class="form-group">
											<input type="text" class="form-control form-control-user" name="username" placeholder="Username">
										</div>

										<div class="form-group">
											<input type="password" class="form-control form-control-user" name="password" placeholder="Password">
										</div>

										<div class="form-group">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" class="custom-control-input" id="customCheck">
												<label class="custom-control-label" for="customCheck">Remember Me</label>
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
									</form>
									<hr>
									<button class="btn btn-google btn-user btn-block"><i class="fab fa-google fa-fw"></i> Login with Google</button>

									<button class="btn btn-facebook btn-user btn-block"><i class="fab fa-facebook-f fa-fw"></i> Login with Facebook</button>
									<hr>
									<div class="text-center">
										<a class="small" href="signup.php">Create an Account!</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="assetsForSideBar/vendor/jquery/jquery.min.js"></script>
	<script src="assetsForSideBar/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="assetsForSideBar/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="assetsForSideBar/js/sb-admin-2.min.js"></script>
</body>
</html>
