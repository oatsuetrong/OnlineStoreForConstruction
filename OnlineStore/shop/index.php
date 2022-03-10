<?php 
	session_start();
	if (isset($_SESSION['shoploggedin']) && $_SESSION['shoploggedin'] == true) {
		$shoploggedin = true;
		$shopId = $_SESSION['shopId'];
		$shopuserId = $_SESSION['shopuserId'];
		$username = $_SESSION['shopusername'];
	} else {
		$shoploggedin = false;
		$shopId = 0;
		$shopuserId = 0;
	}

	if ($shoploggedin) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	
	<title id="title">Shop</title>
	<link rel="icon" href="../../OnlineStore/img/logo (4).png" type="image/x-icon">
	
	<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="assetsForSideBar/css/styles.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<body id="body-pd" style="background: #80808045;">
	 
	<?php
		require 'partials/_dbconnect.php';
		require 'partials/_nav.php';
		require 'partials/_manageThaiLang.php';

		$shopNameSql = "SELECT * FROM `shops` WHERE `shopId` = '$shopId'";
		$shopNameResult = mysqli_query($conn, $shopNameSql);
		$shopNameRow = mysqli_fetch_assoc($shopNameResult);
		$shopName = $shopNameRow['shopName'];

		if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true") {
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:100%">
					<strong>Success!</strong> You are logged in
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
				</div>';
		}
	?>

	<script> document.getElementById("title").innerHTML = "<?php echo $shopName; ?>"; </script>

	<?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
	<?php include $page.'.php' ?>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
	<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="assetsForSideBar/js/datatables.js"></script>
	<script src="assetsForSideBar/js/main.js"></script>
	<script src="assetsForSideBar/js/maps.js"></script>
	<script src="assetsForSideBar/package/dist/sweetalert2.all.min.js"></script>
	<script src="assetsForSideBar/package/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="assetsForSideBar/package/dist/sweetalert2.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="assetsForSideBar/js/sweetAlert.js"></script>
	<script>
		function check(input) {
			if (input.value <= 0) {
				input.value = 1;
			}
		}

		function updateCart(id) {
			$.ajax({
				url: 'partials/_manageCart.php',
				type: 'POST',
				data: $("#frm"+id).serialize(),
				success: function(res) {
					location.reload();
				} 
			})
		}
	</script>
</body>
</html>

<?php
	}
	else{
		header("location: ../shop/login.php");
	}
?>
