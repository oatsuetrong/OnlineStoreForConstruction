<?php
include '_dbconnect.php';
include '_swal.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['contactReply'])) {
		$contactId = $_POST['contactId'];
		$message = $_POST['message'];
		$userId = $_POST['userId'];
		$sql = "INSERT INTO `contactreply` (`contactId`, `userId`, `message`, `datetime`) VALUES ('$contactId', '$userId', '$message', current_timestamp())";   
		$result = mysqli_query($conn, $sql);
		if ($result) {
					echo "<body>
							<script>
							swal('success','','success').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";

		} else {
					echo "<body>
							<script>
							swal('Fail','','error').then((value) => {
						  window.location=document.referrer;
						});
						</script>
						</body>";
		}
	}
}
?>
