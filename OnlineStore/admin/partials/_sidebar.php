<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<?php
			include '_dbconnect.php';

			$sql = "SELECT * FROM `sitedetail`"; 
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$systemName = $row['systemName'];

			echo '<div class="sidebar-brand-text mx-3">' . $systemName . '</div>';
		?>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item nav-index">
		<a class="nav-link" href="index.php">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
<!-- End of Sidebar -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	<?php
		$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		$lastUriSegment = array_pop($uriSegments);
		$filename = explode(".php", $lastUriSegment);
	?>
	$('.nav-<?php echo $filename[0]; ?>').addClass('active')
</script>
