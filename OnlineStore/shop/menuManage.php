<div class="container-fluid" style="margin-top: 98px">
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<?php 
			$sql2 = "SELECT * FROM `shopuser` WHERE `shopuserId` = '$shopuserId'";
			$result2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_assoc($result2);
			$usertype = $row2['userType'];
			if ($usertype == 1) {

			?>
			<div class="col-md-4">
			<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
				<div class="card mb-3">
					<div class="card-header" style="background-color: rgb(111 202 203);">
						Create New Item
					</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">Name: </label>
								<input type="text" class="form-control" name="name" required>
							</div>							
							<div class="form-group">
								<label class="control-label">Serial Number: </label>
								<input type="text" class="form-control" name="productCode" required min="1">
							</div>

							<div class="form-group">
								<label class="control-label">Description: </label>
								<textarea cols="30" rows="3" class="form-control" name="description"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Price: </label>
								<input type="number" class="form-control" name="price" required min="1">
							</div>	
							<div class="form-group">
								<label class="control-label">Quantity: </label>
								<input type="number" class="form-control" name="quantity" required min="1">
							</div>	

							<div class="form-group">
								<label class="control-label">Category: </label>
								<select name="categoryId" id="categoryId" class="custom-select browser-default" required>
								<option hidden disabled selected value>None</option>
								<?php
									$catsql = "SELECT * FROM `categories`"; 
									$catresult = mysqli_query($conn, $catsql);
									while ($row = mysqli_fetch_assoc($catresult)) {
										$catId = $row['categorieId'];
										$catName = $row['categorieName'];
										echo '<option value="' . $catId . '">' . $catName . '</option>';
									}
								?>
								</select>
							</div>
							
							<div class="form-group">
								<label for="image" class="control-label">Image</label>
								<input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
								<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="mx-auto">
								<button type="submit" name="createItem" class="btn btn-sm btn-primary"> Create </button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover mb-0" id="menuTable">
							<thead style="background-color: rgb(111 202 203);">
								<tr>
									<th class="text-center" style="width: 7%;">Serial No.</th>
									<th class="text-center">Img</th>
									<th class="text-center" style="width: 58%;">Item Detail</th>
									<th class="text-center" style="width: 18%;">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$sql = "SELECT * FROM `products` WHERE `shopId`= $shopId";
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {
									$productId = $row['productId'];
									$productCode = $row['productCode'];
									$productName = $row['productName'];
									$productPrice = $row['productPrice'];
									$productDesc = $row['productDesc'];
									$quantity = $row['quantity'];
									$productCategorieId = $row['productCategorieId'];

									echo '<tr>
											<td class="text-center">' . $productCode . '</td>
											<td>
												<img src="../img/product-' . $productId . '.jpg" alt="image for this item" width="150px" height="150px">
											</td>
											<td>
												<p>Name : <b>' . $productName . '</b></p>
												<p>Description : <b class="truncate">' . $productDesc . '</b></p>
												<p>Price : <b>' . $productPrice . '</b></p>
												<p>Quantity : <b>' . $quantity . '</b></p>												
											</td>

											<td class="text-center">
												<div class="row mx-auto" style="width: 112px">
													<button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#updateItem' . $productId . '">Edit</button>
													<button onclick="removeItem(' . $productId . ')" class="btn btn-sm btn-danger" style="margin-left: 9px;">Delete</button>	
												</div>
											</td>
										</tr>';
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		<?php }else {
	echo '
				<h2><b>You do not have a permission for this page.</b></h2>
		';} ?>
		</div>
	</div>	
</div>

<?php 
	$productSql = "SELECT * FROM `products`";
	$productResult = mysqli_query($conn, $productSql);
	while ($productRow = mysqli_fetch_assoc($productResult)) {
		$productId = $productRow['productId'];
		$productCode = $productRow['productCode'];
		$productName = $productRow['productName'];
		$productPrice = $productRow['productPrice'];
		$productCategorieId = $productRow['productCategorieId'];
		$productDesc = $productRow['productDesc'];
		$quantity = $productRow['quantity'];

?>

<!-- Modal -->
<div class="modal fade" id="updateItem<?php echo $productId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateItem<?php echo $productId; ?>" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgb(111 202 203);">
				<h5 class="modal-title" id="updateItem<?php echo $productId; ?>">Item Id: <?php echo $productId; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form action="partials/_menuManage.php" method="post" enctype="multipart/form-data">
					<div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
						<div class="form-group col-md-8">
							<b><label for="image">Image</label></b>
							<input type="file" name="itemimage" id="itemimage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('itemPhoto').src = window.URL.createObjectURL(this.files[0])">
							<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
							<input type="hidden" id="productId" name="productId" value="<?php echo $productId; ?>">
							<button type="submit" class="btn btn-success my-1" name="updateItemPhoto">Update Img</button>
						</div>

						<div class="form-group col-md-4">
							<img src="../img/product-<?php echo $productId; ?>.jpg" id="itemPhoto" name="itemPhoto" alt="item image" width="100" height="100">
						</div>
					</div>
				</form>

				<form action="partials/_menuManage.php" method="post">
					<div class="text-left my-2">
						<b><label for="name">Name</label></b>
						<input class="form-control" id="name" name="name" value="<?php echo $productName; ?>" type="text" required>
					</div>

					<div class="text-left my-2 row">
						<div class="form-group col-md-6">
							<b><label for="price">Price</label></b>
							<input class="form-control" id="price" name="price" value="<?php echo $productPrice; ?>" type="number" min="1" required>
						</div>

						<div class="form-group col-md-6">
							<b><label for="price">Quantity</label></b>
							<input class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>" type="number" min="1" required>
						</div>

						<div class="form-group col-md-6">
							<b><label for="serialNo">Serial No.</label></b>
							<input class="form-control" id="productCode" name="productCode" value="<?php echo $productCode; ?>" type="text" required>
						</div>

						<div class="form-group col-md-6">
							<b><label for="catId">Category Id</label></b>
							<input class="form-control" id="catId" name="catId" value="<?php echo $productCategorieId; ?>" type="number" min="1" required>
						</div>
					</div>

					<div class="text-left my-2">
						<b><label for="desc">Description</label></b>
						<textarea class="form-control" id="desc" name="desc" rows="2" required minlength="6"><?php echo $productDesc; ?></textarea>
					</div>
					<input type="hidden" id="productId" name="productId" value="<?php echo $productId; ?>">
					<button type="submit" class="btn btn-success" name="updateItem">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	}
?>
