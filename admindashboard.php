<?php
session_start();
ob_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	<?php
		include('session.php');
		include('header.php');
	?>
	<div class="colorlib-loader"></div>

	<div id="page">	
		<div id="colorlib-contact">
			<div class="container">

				<div class="row margin-topby">
					<h3 style="margin-left: 40%">Welcome Admin</h3>
					<div class="col-md-10 col-md-offset-1 animate-box">
						<h3>Manager Users</h3>
						<div class="list-group">
						  <a href="activeusers.php" class="list-group-item list-group-item-action">View Active Users</a>
						  <a href="blockedusers.php" class="list-group-item list-group-item-action">View Blocked Users</a>
						  <a href="activateuser.php" class="list-group-item list-group-item-action">Activate User</a>
						  <a href="blockuser.php" class="list-group-item list-group-item-action ">Block User</a>
						</div>
						<br>
						<h3>Manage Plans</h3>
						<div class="list-group">
						  <a href="adminviewplans.php" class="list-group-item list-group-item-action">View/Update Plans</a>
						  <a href="addnewplan.php" class="list-group-item list-group-item-action">Add new Plan</a>
						  <a href="admincanceltour.php" class="list-group-item list-group-item-action">Delate a Plan</a>
						</div>
					</div>
					
					</div>
				</div>
			</div>
		</div>
		<?php
		include 'footer.html';
		?>
	</body>
</html>

