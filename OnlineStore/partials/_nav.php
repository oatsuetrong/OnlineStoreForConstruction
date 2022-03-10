<?php 
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	$loggedin = true;
	$userId = $_SESSION['userId'];
	$username = $_SESSION['username'];
} else {
	$loggedin = false;
	$userId = 0;
}
$sql = "SELECT * FROM `sitedetail`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$systemName = $row['systemName'];

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="index.php">' . $systemName . '</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						All Categories
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
						$sql = "SELECT categorieName, categorieId FROM `categories`"; 
						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<a class="dropdown-item" href="viewCategoryList.php?catid=' . $row['categorieId'] . '">' . $row['categorieName'] . '</a>';
						}
					echo '</div>
				</li>';

				if ($loggedin) {
					echo '<li class="nav-item">
							<a class="nav-link" href="viewOrder.php">Your Orders</a>
						</li>';
				}

				if ($loggedin) {
					echo '<li class="nav-item">
							<a class="nav-link" href="contact.php">Contact Us</a>
						</li>';
				}
			echo '</ul>
			<form method="get" action="../OnlineStore/search.php" class="form-inline my-2 my-lg-0 mx-3">
				<input class="form-control mr-sm-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search" required>
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>';

			if ($loggedin) {
				$countcartsql = "SELECT SUM(`itemQuantity`) FROM `viewcart` WHERE `userId` = $userId";
				$countcartresult = mysqli_query($conn, $countcartsql);
				$countcartrow = mysqli_fetch_assoc($countcartresult);
				$countcart = $countcartrow['SUM(`itemQuantity`)'];
				if (!$countcart) {
					$countcart = 0;
				}
				echo '<a href="viewCartReserved.php">
						<button type="button" class="btn btn-secondary mx-2" title="MyCart">
							<svg xmlns="img/cart.svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
								<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</svg>
							<i class="bi bi-cart">Cart (' . $countcart . ')</i>
						</button>
					</a>';

				$countshopsql = "SELECT COUNT(`shopId`) FROM `favorite` WHERE `userId` = $userId";
				$countshopresult = mysqli_query($conn, $countshopsql);
				$countshoprow = mysqli_fetch_assoc($countshopresult);
				$countshop = $countshoprow['COUNT(`shopId`)'];
				if (!$countshop) {
					$countshop = 0;
				}
				echo '<a href="viewFavorite.php">
						<button type="button" class="btn btn-secondary mx-2" title="Favorite">
							<svg xmlns="img/heart.svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
								<path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
							</svg>
							<i class="bi bi-heart">Favorite (' . $countshop . ')</i>
						</button>
					</a>';

				echo '<ul class="navbar-nav mr-2">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"> Welcome ' . $username . '</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="partials/_logout.php">Logout</a>
							</div>
						</li>
					</ul>
					<div class="text-center image-size-small position-relative">
						<a href="viewProfile.php"><img src="img/person-' . $userId . '.jpg" class="rounded-circle" onError="this.src = \'img/profilePic.jpg\'" style="width: 40px; height: 40px"></a>
					</div>';
			} else {
				echo '
					<button type="button" class="btn btn-success mx-2"  data-toggle="modal" data-target="#loginModal">Login</button>
					<button type="button" class="btn btn-success mx-2"  data-toggle="modal" data-target="#signupModal">SignUp</button>';
			}				
		echo '</div>
	</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
	echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Success!</strong> You can now login.
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">×</span>
			</button>
		</div>';
}

if (isset($_GET['error']) && $_GET['signupsuccess'] == "false") {
	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Warning!</strong> ' .$_GET['error']. '
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">×</span>
			</button>
		</div>';
}

if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true") {
	echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Success!</strong> You are logged in
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">×</span>
			</button>
		</div>';
}

if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Warning!</strong> Invalid Credentials
			<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">×</span>
			</button>
		</div>';
}
?>
