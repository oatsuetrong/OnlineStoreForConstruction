var x = document.getElementById("location");

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else { 
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;
	x.innerHTML = 
	"<iframe width='100%' src='https://maps.google.com/maps?q=" + latitude + "," + longitude + "&output=embed'></iframe>" + 
	"<input type='hidden' name='latitude' value='" + latitude + "'>" + 
	"<input type='hidden' name='longitude' value='" + longitude + "'>";

}

function showError(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
			x.innerHTML = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			x.innerHTML = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			x.innerHTML = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			x.innerHTML = "An unknown error occurred."
			break;
	}
}
