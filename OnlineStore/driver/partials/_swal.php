<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	function addpicFunction() {
		swal('Done','','success').then((value) => {
						  window.location = document.referrer;
						});
	}
	function addpicfailFunction() {
		swal('Fail','image upload failed, please try again.','error').then((value) => {
						  					window.location = document.referrer;
						});
	}
	function tryaddpicFunction() {
		swal('Fail','Please select an image file to upload.','error').then((value) => {
						  					window.history.back(1);
						});
	}
	function updateFunction() {
		swal('Done','Update successfully.','success').then((value) => {
						  					window.history.back(1);
						});
	}
	function updatefailFunction() {
		swal('Fail','Update failed, please try again.','error').then((value) => {
						  					window.history.back(1);
						});
	}
	function incorrectFunction() {
		swal('Fail','Password is incorrect.','error').then((value) => {
						  					window.history.back(1);
						});
	}
	function nopicFunction() {
		swal('Fail','no photo available.','error').then((value) => {
						  					window.location = document.referrer;
						});
	}
	function fullFunction() {
		swal('Fail','You already have the Job! Please finish it before accept a new Job.','error').then((value) => {
						  					window.location.href = '../index.php';

						});
	}
</script>