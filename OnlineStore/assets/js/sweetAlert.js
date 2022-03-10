function removeAllItem() {
	swal({
		title: "Are you sure?",
		text: "Once removed, you will not be able to recovery!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willRemove) => {
		if (willRemove) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/partials/_manageCartOriginal.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("removeAllItem=removeAllItem");
			swal("All items are removed!", {
				icon: "success",
			})
			.then(() => {
				location.reload();
			});
		}
	})
}

function removeItem(productId) {
	swal({
		title: "Are you sure?",
		text: "Once removed, you will not be able to recovery!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willRemove) => {
		if (willRemove) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/partials/_manageCartOriginal.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("removeItem=removeItem&itemId=" + productId);
			swal("Item is removed!", {
				icon: "success",
			})
			.then(() => {
				location.reload();
			});
		}
	})
}

function removeAllFav() {
	swal({
		title: "Are you sure?",
		text: "Once removed, you will not be able to recovery!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willRemove) => {
		if (willRemove) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/partials/_manageFavorite.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("removeAllShop=removeAllShop");
			swal("All favorite lists are removed!", {
				icon: "success",
			})
			.then(() => {
				location.reload();
			});
		}
	})
}

function removeFav(shopId) {
	swal({
		title: "Are you sure?",
		text: "Once removed, you will not be able to recovery!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willRemove) => {
		if (willRemove) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/partials/_manageFavorite.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("removeShop=removeShop&shopId=" + shopId);
			swal("removed!", {
				icon: "success",
			})
			.then(() => {
				location.reload();
			});
		}
	})
}
