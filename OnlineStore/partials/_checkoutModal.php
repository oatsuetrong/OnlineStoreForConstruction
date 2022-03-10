<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="checkoutModal">Enter Your Details:</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form action="partials/_manageCartOriginal.php" method="POST">
					<div class="form-group">
						<b><label for="address">Address: </label></b>
						<textarea class="form-control" name="address" placeholder="1234 Main St" required></textarea>
					</div>

					<div class="form-group">
						<button type="button" class="btn btn-outline-dark" onclick="getLocation()">Current location</button>
						<div id="location"></div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6 mb-0">
							<b><label for="phone">Phone No: </label></b>
							<div class="input-group mb-3">
								<input type="tel" class="form-control" id="phone" name="phone" placeholder="xxxxxxxxxx" required pattern="[0-9]{10}" maxlength="10">
							</div>
						</div>

						<div class="form-group col-md-6 mb-0">
							<b><label for="zipcode">Zip Code: </label></b>
							<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="xxxxx" required pattern="[0-9]{5}" maxlength="5">                    
						</div>
					</div>

					<div class="form-group">
						<b><label for="password">Password: </label></b>    
						<input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required minlength="4" maxlength="21" data-toggle="password">
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<input type="hidden" name="amount" value="<?php echo $totalPrice + $deliveryPrice ?>">
						<input type="hidden" name="deliveryMethod" value="<?php echo $deliveryMethod ?>">
						<button type="submit" name="checkout" class="btn btn-success">Order</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
