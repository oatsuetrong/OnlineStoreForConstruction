<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<link rel ="stylesheet" type ="assetsForSideBar/css" href = "styles.css">
	<title>Register</title>
	<link rel="icon" href="../../OnlineStore/img/logo (4).png" type="image/x-icon">
</head>
<body>

	<?php
		if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
			$error = $_GET['error'];
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> ' . $error . '
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
				</div>';
		}
	?>

	<article class="card-body mx-auto" style="max-width: 400px;">
		<form action="partials/_handleSignup.php" method="POST">
			<div class="form-group input-group"></div>

			<div class="form-group input-group">
				<input name="shopname" class="form-control" placeholder="Shopname" type="text" required>
			</div>

			<div class="form-group input-group">
				<input name="contact" class="form-control" placeholder="Contact" type="text" required>
			</div>

			<div class="form-group input-group">
				<input name="address" class="form-control" placeholder="Address" type="text" required>
			</div>

			<hr>

			<div class="form-group input-group">
				<input name="firstname" class="form-control" placeholder="Firstname" type="text" required>
			</div>

			<div class="form-group input-group">
				<input name="lastname" class="form-control" placeholder="Last Name" type="text" required>
			</div>

			<div class="form-group input-group">
				<input name="username" class="form-control" placeholder="Username" type="text" required>
			</div>

			<div class="form-group input-group">
				<input name="email" class="form-control" placeholder="Email" type="email" required>
			</div>

			<div class="form-group input-group">
				<input name="password" class="form-control" placeholder="Password" type="password" required>
			</div>

			<div class="form-group input-group">
				<input name="cpassword" class="form-control" placeholder="Repeat Password" type="password" required>
			</div>

			<div class="form-group">
				<button type="submit" value="Register" class="btn btn-primary btn-block"> Create Account  </button>
			</div>  
			<p class="text-center">Have an account? <a href="login.php">Log In</a> </p>
		</form>
	</article>
</body>
</html>
