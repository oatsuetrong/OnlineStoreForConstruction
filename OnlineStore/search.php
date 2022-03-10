<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	
	<title>Home</title>
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
	<?php require 'partials/_manageThaiLang.php'; ?>

	<div class="container my-3">
		<h2 class="py-2">Search Result for <em>"<?php echo $_GET['search']?>"</em> :</h2>
		<h3><span id="cat" class="py-2"></span></h3>
		<div class="row">
		<?php 
			$noResult = true;
			$query = $_GET["search"];
			$sql = "SELECT * FROM `categories` WHERE MATCH(categorieName, categorieDesc) against('$query')";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
				<script> document.getElementById("cat").innerHTML = "Category: ";</script>
		<?php 
				$noResult = false;
				$catId = $row['categorieId'];
				$catname = $row['categorieName'];
				$catdesc = $row['categorieDesc'];
				if (getStrLenTH($catname) > 30) {
					$catname = getSubStrTH($catname, 0, 30) . '...';
				}
				if (getStrLenTH($catdesc) > 29) {
					$catdesc = getSubStrTH($catdesc, 0, 29) . '...';
				}
				echo '<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="card" style="width: 18rem;">
							<img src="img/card-' . $catId . '.jpg" class="card-img-top" alt="image for this category" width="249px" height="270px">
							<div class="card-body">
								<h5 class="card-title"><a href="viewCategoryList.php?catid=' . $catId . '">' . $catname . '</a></h5>
								<p class="card-text">' . $catdesc . '</p>
								<a href="viewCategoryList.php?catid=' . $catId . '" class="btn btn-primary">View All</a>
							</div>
						</div>
					</div>';
			}
		?>
		</div>
	</div>

	<div class="container my-3" id="cont">
		<h3><span id="iteam" class="py-2"></span></h3>
		<div class="row">
		<?php 
			$query = $_GET["search"];
			$sql = "SELECT * FROM `products` WHERE MATCH(productName, productDesc) against('$query')"; 
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
		?>
				<script> document.getElementById("iteam").innerHTML = "Items: ";</script>
		<?php
				$noResult = false;
				$productId = $row['productId'];
				$productCode = $row['productCode'];
				$productName = $row['productName'];
				$productPrice = $row['productPrice'];
				$productDesc = $row['productDesc'];
				$productCategorieId = $row['productCategorieId'];
				$shopId = $row['shopId'];
				$shopDetailSql = "SELECT * FROM `shops` WHERE `shopId` = '$shopId'";
				$shopDetailResult = mysqli_query($conn, $shopDetailSql);
				$shopDetailRow = mysqli_fetch_assoc($shopDetailResult);
				$shopName = $shopDetailRow['shopName'];
				if (getStrLenTH($productName) > 30) {
					$productName = getSubStrTH($productName, 0, 30) . '...';
				}
				if (getStrLenTH($productDesc) > 29) {
					$productDesc = getSubStrTH($productDesc, 0, 29) . '...';
				}
				echo '<div class="col-xs-3 col-sm-3 col-md-3">
						<div class="card" style="width: 18rem;">
							<img src="img/product-' . $productId . '.jpg" class="card-img-top" alt="image for this product" width="249px" height="270px">
							<div class="card-body">
								<h5 class="card-title">' . $productName . '</h5>
								<div class="row d-flex">
									<div class="col">
										<h6 style="color: #ff0000">' . $productPrice . ' ฿</h6>
									</div>
									<div class="col text-right">
										<p class="card-text">' . $shopName . '</p>
									</div>
								</div>
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
											  <input type="hidden" name="shopId" value="' . $shopId . '">
											  <button type="submit" name="addToCart" class="btn btn-primary mx-2">Add to Cart</button>';
										} else {
											echo '<a href="viewCartReserved.php"><button class="btn btn-primary mx-2">Go to Cart</button></a>';
										}
									} else {
										echo '<button class="btn btn-primary mx-2" data-toggle="modal" data-target="#loginModal">Add to Cart</button>';
									}
									echo '</form>
									<a href="viewProduct.php?productId=' . $productId . '"><button class="btn btn-primary">Quick View</button></a>
								</div>
							</div>
						</div>
					</div>';
			}

			if ($noResult) {
				echo '<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<h1>Your search - <em>"' . $_GET['search'] . '"</em> - No Result Found.</h1>
							<p class="lead"> Suggestions:
								<ul>
									<li>Make sure that all words are spelled correctly.</li>
									<li>Try different keywords.</li>
									<li>Try more general keywords.</li>
								</ul>
							</p>
						</div>
					</div> ';
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
</body>
</html>
