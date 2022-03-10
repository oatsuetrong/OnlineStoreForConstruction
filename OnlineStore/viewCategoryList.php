<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	
	<title id="title">Category</title>
	<link rel="icon" href="img/logo (4).png" type="image/x-icon">
	
	<style>
		.jumbotron {
			padding: 2rem 1rem;
		}

		#cont {
			min-height: 570px;
		}
	</style>
</head>
<body>
	<?php include 'partials/_dbconnect.php'; ?>
	<?php require 'partials/_nav.php' ?>
	<?php require 'partials/_manageThaiLang.php'; ?>

	<?php
		$id = $_GET['catid'];
		$sql = "SELECT * FROM `categories` WHERE `categorieId` = $id";
		$result = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$catname = $row['categorieName'];
		}
	?>
	<!-- Pizza container starts here -->
	<div class="container my-3" id="cont">
		<div class="col-lg-4 text-center bg-light my-3" style="margin: auto; border-top: 2px groove black; border-bottom: 2px groove black;">
			<h2 class="text-center"><span id="catTitle">Items</span></h2>
		</div>

		<div class="row">
		<?php
			$id = $_GET['catid'];
			$sql = "SELECT COUNT(`productId`), `productId`, `productCode`, `productName`, `productPrice`, `productDesc`, `shopId` FROM `products` WHERE `quantity` != 0 AND `productCategorieId` = '$id' GROUP BY `productCode`";
			$result = mysqli_query($conn, $sql);
			$noResult = true;
			while ($row = mysqli_fetch_assoc($result)) {
				$noResult = false;
				$productId = $row['productId'];
				$productCode = $row['productCode'];
				$productName = $row['productName'];
				$productPrice = $row['productPrice'];
				$productDesc = $row['productDesc'];
				$shopId = $row['shopId'];
				$productIdCount = $row['COUNT(`productId`)'];
				if (getStrLenTH($productName) > 30) {
					$productName = getSubStrTH($productName, 0, 30) . '...';
				}
				if (getStrLenTH($productDesc) > 29) {
					$productDesc = getSubStrTH($productDesc, 0, 29) . '...';
				}

				if ($productIdCount > 1) {
					echo '<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="card" style="width: 18rem;">
								<img src="img/product-' . $productId . '.jpg" class="card-img-top" alt="image for this product" width="249px" height="270px">
								<div class="card-body">
									<h5 class="card-title">' . $productName . '</h5>
									<h6 class="text-right">
										<span class="badge badge-danger badge-counter">
											' . $productIdCount . '
										</span>
										<svg xmlns="img/shop.svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
											<path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
										</svg>
										<i class="bi bi-shop"></i>
									</h6>
									<p class="card-text">' . $productDesc . '</p>   
									<div class="row justify-content-center">';
										if ($loggedin) {
											$quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE `productId` = '$productId' AND `userId` = '$userId'";
											$quaresult = mysqli_query($conn, $quaSql);
											$quaExistRows = mysqli_num_rows($quaresult);
											if ($quaExistRows == 0) {
												echo '<form action="partials/_manageCartOriginal.php" method="POST">
														<input type="hidden" name="itemId" value="' . $productId . '">
														<input type="hidden" name="productCode" value="' . $productCode . '">
														<button type="submit" name="addCheapest" class="btn btn-primary mx-2">Add to Cart</button>';
											} else {
												echo '<a href="viewCartReserved.php"><button class="btn btn-primary mx-2">Go to Cart</button></a>';
											}
										} else {
											echo '<button class="btn btn-primary mx-2" data-toggle="modal" data-target="#loginModal">Add to Cart</button>';
										}
										echo '</form>                            
										<a href="viewCompare.php?productCode=' . $productCode . '" class="mx-2"><button class="btn btn-primary">Compare</button></a>
									</div>
								</div>
							</div>
						</div>';
				} else {
					echo '<div class="col-xs-3 col-sm-3 col-md-3">
							<div class="card" style="width: 18rem;">
								<img src="img/product-' . $productId . '.jpg" class="card-img-top" alt="image for this product" width="249px" height="270px">
								<div class="card-body">
									<h5 class="card-title">' . $productName . '</h5>
									<h6 style="color: #ff0000">' . $productPrice . ' ฿</h6>
									<p class="card-text">' . $productDesc . '</p>   
									<div class="row justify-content-center">';
									if ($loggedin) {
										$quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE `productId` = '$productId' AND `userId`='$userId'";
										$quaresult = mysqli_query($conn, $quaSql);
										$quaExistRows = mysqli_num_rows($quaresult);
										if ($quaExistRows == 0) {
											echo '<form action="partials/_manageCartOriginal.php" method="POST">
												  <input type="hidden" name="itemId" value="' . $productId . '">
												  <input type="hidden" name="productCode" value="' . $productCode . '">
												  <input type="hidden" name="shopId" value="' . $shopId . '">
												  <button type="submit" name="addToCart" class="btn btn-primary mx-2">Add to Cart</button>';
										} else {
											echo '<a href="viewCartReserved.php"><button class="btn btn-primary mx-2">Go to Cart</button></a>';
										}
									} else{
										echo '<button class="btn btn-primary mx-2" data-toggle="modal" data-target="#loginModal">Add to Cart</button>';
									}
								echo '</form>                            
									<a href="viewProduct.php?productId=' . $productId . '" class="mx-2"><button class="btn btn-primary">Quick View</button></a> 
									</div>
								</div>
							</div>
						</div>';
				}
			}
			
			if ($noResult) {
				echo '<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<p class="display-4">Sorry In this category No items available.</p>
							<p class="lead"> We will update Soon.</p>
						</div>
					</div>';
			}
			?>
		</div>
	</div>

	<?php require 'partials/_footer.php' ?>
	
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
	<script> 
		document.getElementById("title").innerHTML = "<?php echo $catname; ?>";
		document.getElementById("catTitle").innerHTML = "<?php echo $catname; ?>";
	</script>
</body>
</html>
