<div class="container" id="cont">
	<div class="row">
		<div class="col-lg-12 text-center border rounded bg-light my-3">
			<form method="POST" action = "partials/_manageCart.php" class="form-inline my-2 my-lg-0 mx-3">
				<input class="form-control mr-sm-2" type="search" name="search" id="search" placeholder="Serial No." aria-label="Search" required>
				<button class="btn btn-outline-success my-2 my-sm-0" name="addToCart" type="submit">Add</button>
			</form>
		</div>

		<div class="col-lg-8">
			<div class="card wish-list mb-3">
				<table class="table text-center">
					<thead class="thead-light">
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Item Name</th>
							<th scope="col">Item Price</th>
							<th scope="col">Quantity</th>
							<th scope="col">Total Price</th>
							<th scope="col">
								<button onclick="removeAll()" class="btn btn-sm btn-outline-danger">Remove All</button>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php

							$sql = "SELECT * FROM `onsitecart` WHERE `shopuserId`= $shopuserId";
							$result = mysqli_query($conn, $sql);
							$counter = 0;
							$totalPrice = 0;
							while ($row = mysqli_fetch_assoc($result)) {
								$productId = $row['productId'];
								$Quantity = $row['itemQuantity'];
								$mysql = "SELECT * FROM `products` WHERE `productId` = $productId";
								$myresult = mysqli_query($conn, $mysql);
								$myrow = mysqli_fetch_assoc($myresult);
								$productName = $myrow['productName'];
								$productPrice = $myrow['productPrice'];
								$inStock = $myrow['quantity'];
								$total = $productPrice * $Quantity;
								$counter++;
								$totalPrice = $totalPrice + $total;

								echo '<tr>
										<td>' . $counter . '</td>
										<td>' . $productName . '</td>
										<td>' . $productPrice . '</td>
										<td>
											<form id="frm' . $productId . '">
												<input type="hidden" name="productId" value="' . $productId . '">
												<input type="number" name="quantity" value="' . $Quantity . '" class="text-center" onchange="updateCart(' . $productId . ')" onkeyup="return false" style="width:60px" min=1 max="' . $inStock . '"oninput="check(this)" onClick="this.select();">
											</form>
										</td>
										<td>' . $total . '</td>
										<td>
											<form action="partials/_manageCart.php" method="POST">
												<button name="removeItem" class="btn btn-sm btn-outline-danger">Remove</button>
												<input type="hidden" name="itemId" value="' . $productId . '">
											</form>
										</td>
									</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="card wish-list mb-3">
				<div class="pt-4 border bg-light rounded p-3">
					<h5 class="mb-3 text-uppercase font-weight-bold text-center">Order summary</h5>
					<ul class="list-group list-group-flush">
						<li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light">Total Price<span><?php echo $totalPrice ?> ฿</span></li>
						<li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-light">
							<div>
								<strong>The total amount of</strong>
								<strong><p class="mb-0">(including Tax & Charge)</p></strong>
							</div>
							<span><strong><?php echo $totalPrice ?> ฿</strong></span>
						</li>
					</ul>
                    <form action="partials/_manageCart.php" method="POST">
					   <button name ="checkout" onclick="window.print()" type="submit" class="btn btn-primary btn-block"   >checkout</button>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
