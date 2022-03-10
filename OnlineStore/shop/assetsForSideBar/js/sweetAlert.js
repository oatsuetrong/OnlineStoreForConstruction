function removeAll() {
	swal({
		title: "Are you sure?",
		text: "Once removed, you will not be able to change!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willRemove) => {
		if (willRemove) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/shop/partials/_manageCart.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("removeAllItem=removeAllItem");
			swal("All items are removed!", {
				icon: "success",
			})
			.then(() => {
				location.reload();
			});
		}
	});
}

function removeItem(productId) {
	swal({
		title: "Are you sure?",
		text: "Once removed, you will not be able to change!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willRemove) => {
		if (willRemove) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/shop/partials/_menuManage.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("removeItem=removeItem&productId=" + productId);
			swal("Item is removed!", {
				icon: "success",
			})
			.then(() => {
				location.reload();
			});
		}
	})
}

function removeUser(shopUserId) {
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
			xhttp.open("POST", "http://localhost/website/OnlineStore/shop/partials/_userManage.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("removeUser=removeUser&shopuserId=" + shopUserId);
			swal("User is removed!", {
				icon: "success",
			})
			.then(() => {
				location.reload();
			});
		}
	})
}
