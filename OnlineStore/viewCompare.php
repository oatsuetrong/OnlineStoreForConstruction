<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	
	<title id=title>Compare</title>
	<link rel="icon" href="img/logo (4).png" type="image/x-icon">
	
	<style>
		#cont {
			min-height: 515px;
		}
	</style>
</head>
<body>
	<?php include 'partials/_dbconnect.php'; ?>
	<?php require 'partials/_nav.php' ?>
	<?php
		$productCode = $_GET['productCode'];
		$sql = "SELECT * FROM `products` WHERE `productCode`= $productCode";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$productName = $row['productName'];
	?>

	<script> document.getElementById("title").innerHTML = "<?php echo $productName; ?>"; </script>
	<div class="container my-3" id="cont">
		<h2 class="py-2">Compare Result for <em>"<?php  echo $productName ?>"</em> :</h2>
		<div class="row">
			<div class="col-lg-12">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="compareTable" width="100%" cellspacing="0">
							<thead class="thead-light">
								<tr>
									<th class="text-center">No.</th>
									<th>Shop Name</th>
									<th class="text-center">Price</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql = "SELECT * FROM `products` WHERE `productCode`= $productCode AND `quantity` != 0";
									$result = mysqli_query($conn, $sql);
									$counter = 0;
									while ($row = mysqli_fetch_assoc($result)) {
										$productId = $row['productId'];
										$productPrice = $row['productPrice'];
										$shopId = $row['shopId'];
										$mysql = "SELECT * FROM `shops` WHERE `shopId` = $shopId";
										$myresult = mysqli_query($conn, $mysql);
										$myrow = mysqli_fetch_assoc($myresult);
										$shopName = $myrow['shopName'];
										$counter++;
										echo '<tr>
												<td class="text-center">' . $counter . '</td>
												<td>' . $shopName . '</td>
												<td class="text-center">' . $productPrice . '</td>';
												if ($loggedin) {
													echo '<td class="text-center">
															<form class="text-center" action="partials/_manageCartOriginal.php" method="POST">
																<button name="addToCart" class="btn btn-sm btn-outline-primary">Add to cart</button>
																<input type="hidden" name="itemId" value="' . $productId . '">
																<input type="hidden" name="productCode" value="' . $productCode . '">
																<input type="hidden" name="shopId" value="' . $shopId . '">
															</form>
														</td>';
												} else {
													echo '<td class="text-center">
															<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#loginModal">Add to Cart</button>
														</td>';
												}
											echo '</tr>';
									}
								?>
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</div>

	<?php require 'partials/_footer.php' ?>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/datatables.js"></script>
</body>
</html>
