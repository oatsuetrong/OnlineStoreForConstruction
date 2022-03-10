
<?php
$sql = "SELECT * FROM `shops` WHERE `shopId` = '$shopId'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$shopname = $row['shopName'];
$address = $row['address'];
$contact = $row['contact'];
$latitude = $row['latitude'];
$longitude = $row['longitude'];
$sql2 = "SELECT * FROM `shopuser` WHERE `shopuserId` = '$shopuserId'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$usertype = $row2['userType'];
if ($usertype == 1) {
echo '<div class="container-fluid" style="padding-left: 470px;margin-top:98px">
		<div class="card col-lg-6 p-0">
			<div class="title" style="background-color: rgb(111 202 203);">
				<em><h2 class="text-center" style="margin-top: 11px;">' . $shopname . '</h2></em>
			</div>

			<div class="card-body">
				<div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
					<div class="form-group col-md-8">
						<form action="partials/_siteManage.php" method="POST" enctype="multipart/form-data">
							<b><label for="image">Shop Picture</label></b>
							<input type="file" name="shopimage" id="shopimage" accept=".jpg" class="form-control" required style="border:none;">
							<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
							<input type="hidden" id="shopId" name="shopId" value="' . $shopId .  '">
							<button type="submit" class="btn btn-info mt-3" name="updateShopPhoto">Update Img</button>
						</form>
					</div>
					<div class="form-group col-md-4">
						<img src="../img/shop-' . $shopId . '.jpg" alt="Shop Photo" width="100" height="100">
						<form action="partials/_siteManage.php" method="POST">
							<input type="hidden" id="shopId" name="shopId" value="' . $shopId . '">
							<button type="submit" class="btn btn-danger mt-2" name="removeShopPhoto">Remove Img</button>
						</form>
					</div>
				</div>

				<form action="partials/_siteManage.php" method="post">
					<div class="form-group">
						<label for="name" class="control-label">Shop Name</label>
						<input type="text" class="form-control" id="name" name="name" value="' . $shopname . '" required>
					</div>


					<div class="form-group">
						<label for="contact" class="control-label">Contact</label>
						<input type="tel" class="form-control" id="contact" name="contact" value="' . $contact . '" required>
					</div>


					<div class="form-group">
						<label for="address" class="control-label">Address</label>
						<input type="text" class="form-control" id="address" name="address" value="' . $address . '" required>
					</div>';

					if (is_null($latitude) && is_null($longitude)) {
						echo '<div class="form-group">
								<label for="latitude" class="control-label">Latitude</label>
								<input type="text" class="form-control" id="latitude" disabled>
							</div>

							<div class="form-group">
								<label for="longitude" class="control-label">Longitude</label>
								<input type="text" class="form-control" id="longitude" disabled>
							</div>

							<div id="location"></div>

							<button type="button" class="btn btn-outline-dark" onclick="getLocation()">Get location</button>';
					} else {
						echo '<div class="form-group">
								<label for="latitude" class="control-label">Latitude</label>
								<input type="text" class="form-control" id="latitude" value=' . $latitude . ' disabled>
							</div>

							<div class="form-group">
								<label for="longitude" class="control-label">Longitude</label>
								<input type="text" class="form-control" id="longitude" value=' . $longitude . ' disabled>
							</div>

							<div id="location"></div>

							<button type="button" class="btn btn-outline-dark" onclick="getLocation()">Get location</button>';
					}

					echo '<center>
						<button name="updateDetail" class="btn btn-info btn-primary btn-block col-md-2">Save</button>
					</center>
				</form>
			</div>
		</div>
	</div>';
} else {
	echo '
				<div class="container-fluid" style="margin-top:98px"><h2><b>You do not have a permission for this page.</b></h2></div>
		';}
?>
