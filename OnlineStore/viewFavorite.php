<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	
	<title>Favorite Lists</title>
	<link rel="icon" href="img/logo (4).png" type="image/x-icon">
	
	<style>
		#cont {
			min-height: 626px;
		}
	</style>
</head>
<body>
	<?php include 'partials/_dbconnect.php'; ?>
	<?php require 'partials/_nav.php' ?>
	<?php 
	if ($loggedin) {
	?>
	
	<div class="container" id="cont">
		<div class="row">
			<div class="col-lg-12 text-center border rounded bg-light my-3">
				<h1>My Favorite Lists</h1>
			</div>

			<div class="col-lg-12">
				<div class="card wish-list mb-3">
					<table class="table text-center">
						<thead class="thead-light">
							<tr>
								<th scope="col">No.</th>
								<th scope="col"></th>
								<th scope="col">Shop Name</th>
								<th scope="col">
									<button onclick="removeAllFav()" class="btn btn-sm btn-outline-danger">Remove All</button>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM `favorite` WHERE `userId`= $userId";
								$result = mysqli_query($conn, $sql);
								$counter = 0;
								while ($row = mysqli_fetch_assoc($result)) {
									$shopId = $row['shopId'];
									$mysql = "SELECT * FROM `shops` WHERE `shopId` = $shopId";
									$myresult = mysqli_query($conn, $mysql);
									$myrow = mysqli_fetch_assoc($myresult);
									$shopName = $myrow['shopName'];
									$counter++;

									echo '<tr>
											<td>' . $counter . '</td>
											<td><img src="img/shop-' . $shopId . '.jpg" class="img-thumbnail" alt="image for ' . $shopName . '" width="249px" height="270px"></td>
											<td><a href="viewShop.php?shopId=' . $shopId . '">' . $shopName . '</a></td>
											<td>
												<button onclick="removeFav(' . $shopId . ')" class="btn btn-sm btn-outline-danger">Remove</button>
											</td>
										</tr>';
								}
								if ($counter == 0) {
							?>
									<script>
										document.getElementById("cont").innerHTML = '<div class="col-md-12 my-5"><div class="card"><div class="card-body cart"><div class="col-sm-12 empty-cart-cls text-center"> <img src="https://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/128/favorite-icon.png" width="130" height="130" class="img-fluid mb-4 mr-3"><h3><strong>Your Favorite List is Empty</strong></h3><h4>Add something to make me happy :)</h4> <a href="index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a> </div></div></div></div>';
									</script>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
								
	<?php 
	} else {
		echo '<div class="container" style="min-height: 610px;">
				<div class="alert alert-info my-3">
					<font style="font-size:22px"><center>Before look your favorite list you need to <strong><a class="alert-link" data-toggle="modal" data-target="#loginModal">Login</a></strong></center></font>
				</div>
			</div>';
	}
	?>

	<?php require 'partials/_checkoutModal.php'; ?>
	<?php require 'partials/_footer.php' ?>
	
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="assets/js/sweetAlert.js"></script>
</body>
</html>
