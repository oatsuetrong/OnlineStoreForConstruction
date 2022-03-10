<?php 
	$itemModalSql = "SELECT * FROM `orders`";
	$itemModalResult = mysqli_query($conn, $itemModalSql);
	while ($itemModalRow = mysqli_fetch_assoc($itemModalResult)) {
		$orderid = $itemModalRow['orderId'];
		$userid = $itemModalRow['userId'];
		$orderStatus = $itemModalRow['orderStatus'];
		$deliveryMethod = $itemModalRow['deliveryMethod'];
?>

<!-- Modal -->
<div class="modal fade" id="orderStatus<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderStatus<?php echo $orderid; ?>" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgb(111 202 203);">
				<h5 class="modal-title" id="orderStatus<?php echo $orderid; ?>">Order Status and Delivery Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form action="partials/_orderManage.php" method="post" style="border-bottom: 2px solid #dee2e6;">
					<div class="text-left my-2">
						<b><label for="name">Order Status</label></b>
						<div class="row mx-2">
							<select class="form-control col-md-6" id="status" name="status">
								<option id="status-0" value="0">Order Placed.</option>
								<option id="status-1" value="1">Order Confirmed.</option>
								<option id="status-2" value="2">Preparing your Order.</option>
								<option id="status-3" value="3">Your order is on the way!</option>
								<option id="status-4" value="4">Order Delivered.</option>
								<option id="status-5" value="5">Order Denied.</option>
								<option id="status-6" value="6">Order Cancelled.</option>
							</select>
							<script>
								var option = document.getElementById("status-<?php echo $orderStatus; ?>");
								option.setAttribute('selected', true);
							</script>
						</div>
					</div>
					<input type="hidden" id="orderId" name="orderId" value="<?php echo $orderid; ?>">
					<button type="submit" class="btn btn-success mb-2" name="updateStatus">Update</button>
				</form>

				<?php 
					$deliveryDetailSql = "SELECT * FROM `deliverydetails` WHERE `orderId` = $orderid";
					$deliveryDetailResult = mysqli_query($conn, $deliveryDetailSql);
					if (mysqli_num_rows($deliveryDetailResult) > 0) {
						$deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
						$trackId = $deliveryDetailRow['id'];
						$deliveryBoyName = $deliveryDetailRow['deliveryBoyName'];
						$deliveryBoyPhoneNo = $deliveryDetailRow['deliveryBoyPhoneNo'];
						$deliveryTime = $deliveryDetailRow['deliveryTime'];
					}
					
					if ($orderStatus > 0 && $orderStatus < 5 && $deliveryMethod != 1) {
						if (!isset($deliveryBoyName)) {
							$deliveryBoyName = "";
						}
						if (!isset($deliveryBoyPhoneNo)) {
							$deliveryBoyPhoneNo = "";
						}
						if (!isset($trackId)) {
							$trackId = null;
						}
				?>

				<form action="partials/_orderManage.php" method="post">
					<div class="text-left my-2">
						<b><label for="name">Delivery Boy Name</label></b>
						<input class="form-control" id="name" name="name" value="<?php echo $deliveryBoyName; ?>" type="text" required>
					</div>

					<div class="text-left my-2 row">
						<div class="form-group col-md-6">
							<b><label for="phone">Phone No</label></b>
							<input class="form-control" id="phone" name="phone" value="<?php echo $deliveryBoyPhoneNo; ?>" type="tel" required pattern="[0-9]{10}">
						</div>

						<div class="form-group col-md-6">
							<b><label for="catId">Estimate Time(minute)</label></b>
							<input class="form-control" id="time" name="time" value="<?php echo $deliveryTime; ?>" type="number" min="1" max="120" required>
						</div>
					</div>
					<input type="hidden" id="trackId" name="trackId" value="<?php echo $trackId; ?>">
					<input type="hidden" id="orderId" name="orderId" value="<?php echo $orderid; ?>">
					<button type="submit" class="btn btn-success" name="updateDeliveryDetails">Update</button>
				</form>
				<?php
					unset($trackId);
					unset($deliveryBoyName);
					unset($deliveryBoyPhoneNo);
					unset($deliveryTime);
					}
				?>
			</div>
		</div>
	</div>
</div>

<?php
	}
?>

<style>
	.popover {
		top: -77px !important;
	}
</style>

<script>
	$(function () {
		$('[data-toggle="popover"]').popover();
	});
</script>
