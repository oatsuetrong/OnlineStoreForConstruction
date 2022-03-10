<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
	function addFunction() {
		swal('Done','Item Already Added.','success').then((value) => {
						  window.history.back(1);
						});
	}
	function failFunction() {
		swal('Fail','Do not have this product in the stock','error').then((value) => {
						  window.history.back(1);
						});
	}
	function selectFunction() {
		swal('Done','Selected " . $shopName . "','success').then((value) => {
						  				window.location.href = '../viewCartOriginal.php';

						});
	}
	function tyFunction() {
		swal('Done','Thanks for ordering with us. Your order id is ' . $orderId . '.','success').then((value) => {
						  				window.location.href="../index.php";  
						});
	}
	function incorFunction() {
		swal('Fail','Incorrect Password! Please enter correct Password.','error').then((value) => {
						  window.history.back(1);
						});
	}

</script>