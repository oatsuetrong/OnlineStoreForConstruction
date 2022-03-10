function acceptJob() {
	var notificationId = document.getElementById("notificationId").value;
	swal({
		title: "Are you sure?",
		text: "Once accepted, you must finish your job!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willAccept) => {
		if (willAccept) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/driver/partials/_manageNotification.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("accept=accept&notificationId=" + notificationId);
			swal("You accept the Job No. " + notificationId, {
				icon: "success",
			})
			.then(() => {
				window.location.href = "../driver";
			});
		}
	})
}

function acceptJobAllJobPage(notificationId) {
	swal({
		title: "Are you sure?",
		text: "Once accepted, you must finish your job!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willAccept) => {
		if (willAccept) {
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "http://localhost/website/OnlineStore/driver/partials/_manageNotification.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("accept=accept&notificationId=" + notificationId);
			swal("You accept the Job No. " + notificationId, {
				icon: "success",
			})
			.then(() => {
				window.location.href = "../driver";
			});
		}
	})
}
