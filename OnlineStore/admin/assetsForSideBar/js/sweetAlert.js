function approveAll() {
	swal({
		title: "Are you sure?",
		text: "Once approved, you will not be able to change!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willApprove) => {
		if (willApprove) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/admin/partials/_handleAdmin.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("approveAll=approveAll");
			swal("All users are approved!", {
				icon: "success",
			})
			.then(() => {
				location.reload();
			});
		}
	})
}

function denyAll() {
	swal({
		title: "Are you sure?",
		text: "Once denied, you will not be able to change!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDeny) => {
		if (willDeny) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/admin/partials/_handleAdmin.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("denyAll=denyAll");
			swal("All users are denied!", {
				icon: "success",
			})
			.then(() => {
				location.reload();
			});
		}
	})
}
