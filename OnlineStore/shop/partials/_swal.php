<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	function addFunction() {
		swal('Done','Item Already Added.','success').then((value) => {
						  window.history.back(1);
						});
	}
	function addoriFunction() {
		swal('Done','','success').then((value) => {
						  window.history.back(1);
						});
	}

	function failFunction() {
		swal('Fail','Do not have this product in the stock','error').then((value) => {
						  window.history.back(1);
						});
	}
</script>