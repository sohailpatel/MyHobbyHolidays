<?php
session_start();
ob_start();
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
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$name = mysqli_real_escape_string($db,$_POST['name']);
		       $country = mysqli_real_escape_string($db,$_POST['country']); 
		       $duration = mysqli_real_escape_string($db,$_POST['duration']); 
		       $standardprice = mysqli_real_escape_string($db,$_POST['standardprice']); 
		       $premiumprice = mysqli_real_escape_string($db,$_POST['premiumprice']); 

		      
			$sql="INSERT INTO destinations(tour_name,duration,standard_price,premium_price,tour_country) values ('".$name."','".$duration."','".$standardprice."','".$premiumprice."','".$country."')";
		   if (mysqli_query($db, $sql))
		   {
			   echo '<script type="text/javascript">alert("The plan has been added"); </script>';
		   }
		   else{
		      	 echo '<script type="text/javascript">alert("Additon of plan failed"); </script>';
		         $error = "Adding failed";  
		   }
		}
	?>
	<div class="colorlib-loader"></div>

	<div id="page">
		<div id="colorlib-contact" style="margin-top: 100px"> 
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 animate-box">
						<h3>Add a plan</h3>
						<form method="post">

						<div class="row form-group">
								<div class="col-md-12">
									<label for="name">Tour Name</label>
									<input type="text" id="name" name="name" class="form-control" placeholder="Name" required="true">
								</div>

								<div class="col-md-12">
									<label for="country">Tour Country</label>
									<input type="text" id="country" name="country" class="form-control" placeholder="Country" required="true">
								</div>

								<div class="col-md-12">
									<label for="duration">Duration</label>
									<input type="text" id="duration" name="duration" class="form-control" placeholder="Duration" required="true">
								</div>

								<div class="col-md-12">
									<label for="standardprice">Standard Price</label>
									<input type="text" id="standardprice" name="standardprice" class="form-control" placeholder="Standard Price" required="true">
								</div>

								<div class="col-md-12">
									<label for="premiumprice">Premium Price</label>
									<input type="text" id="premiumprice" name="premiumprice" class="form-control" placeholder="Premium Price" required="true">
								</div>

							</div>

							
							<div class="form-group text-center">
								<input type="submit" value="Add Plan" class="btn btn-primary" >
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

