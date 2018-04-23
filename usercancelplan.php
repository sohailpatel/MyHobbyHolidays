<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tour Template</title>
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
		$username = $_SESSION['login_user'];

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$tourid = mysqli_real_escape_string($db,$_POST['tourid']);
			$sqlUpdate="UPDATE tour_bookings SET booking_status = '0' WHERE booking_id='".$tourid."' AND booked_by = '".$username."'";
			if (mysqli_query($db, $sqlUpdate))
		   {
			   echo '<script type="text/javascript">alert("The plan has been cancelled"); </script>';
		   }
		   else{
		      	echo '<script type="text/javascript">alert("Cancelling failed. Please check Tour ID."); </script>';
		        $error = "Cancelling failed";  
		   }
		}
	?>
	<div class="colorlib-loader"></div>

	<div id="page">
		<div id="colorlib-contact" style="margin-top: 100px"> 
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 animate-box">
						<h3>Cancel your trip</h3>
						<form method="post">

						<div class="row form-group">
								<div class="col-md-12">
									<label for="email">Booking ID</label>
									<input type="text" id="tourid" name="tourid" class="form-control" placeholder="Booking ID" required="true">
								</div>
							</div>

							
							<div class="form-group text-center">
								<input type="submit" value="Cancel Trip" class="btn btn-primary" >
							</div>
							
						</form>		
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

