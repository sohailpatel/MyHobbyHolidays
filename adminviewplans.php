<?php
session_start();
ob_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin View Plans</title>
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
		<div id="colorlib-contact" style="min-height: 500px;">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 animate-box margin-topby">
						<h3>Current Plans</h3>
						<form>

							<?php
								 $sql = "SELECT distinct tour_id, tour_name, tour_country, duration, standard_price, premium_price, image_link FROM destinations";
	      						 $result = mysqli_query($db,$sql);
	      						 $run = false;

	      						 if ($result->num_rows > 0) {
								    // output data of each row
								    echo '<table class="table">';
								    echo '<thead><tr><th>Tour ID</th><th>Tour Name</th><th>Country</th><th>Duration</th><th>Standard Price</th>
								    <th>Premium Price</th></tr></thead>';
								    while($row = $result->fetch_assoc()) {
								    	echo '<tr>';
								        echo '<td><a href="#" onclick="callUpdateTours(this.name)" name='. $row["tour_id"] .'>' .$row["tour_id"]. '</a></td><td>' .$row["tour_name"]. '</td><td>' .$row["tour_country"]. '</td><td>' . $row["duration"].'</td><td>'. $row["standard_price"].'</td><td>' . $row["premium_price"].'</td>';
								        echo '</tr>';
								    }
								    echo '</table>';

								} else {
								    echo "0 results";
									}
								
							?>
						</form>		
					</div>
					
					</div>
				</div>
			</div>
		</div>
		<?php
		include 'footer.html';
		?>
		<script>
			function callUpdateTours(tourId) {
			var tourId = "tour-id" + "=" + tourId;
			document.cookie= tourId;
			window.location='updatetours.php';
		}
		</script>
	</body>
</html>

