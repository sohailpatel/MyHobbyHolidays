<?php
include('database_connection.php');
session_start();
if(!$_SESSION['login_user']){
	header("Location: login.php");
}
else{
$tour_id = $_COOKIE['tour-id']; 
$tour_price = $_COOKIE['tour-price']; 
$hotel_id = $_COOKIE['hotel-id']; 
$sql = 'select distinct duration from destinations where tour_id='. $tour_id;
$result = mysqli_query($conn, $sql) or die ("break here");
if (!$result){
	echo "Error creating database: " . mysql_error();
}
else{
	while($row = $result->fetch_assoc()) {
		$tour_duration = $row["duration"];
	}
}
$sql = 'select standard_price from hotels where hotel_id='. $hotel_id;
$result = mysqli_query($conn, $sql) or die ("break here");
if (!$result){
	echo "Error creating database: " . mysql_error();
}
else{
	while($row = $result->fetch_assoc()) {
		$hotel_rent = $row["standard_price"];
	}
}
echo "
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible'content='IE=edge'>
	<title>Payment</title>
	<meta name='viewport'content='width=device-width, initial-scale=1'>
	<meta name='description'content=''/>
	<meta name='keywords'content=''/>
	<meta name='author'content=''/>

  <!-- Facebook and Twitter integration -->
	<meta property='og:title'content=''/>
	<meta property='og:image'content=''/>
	<meta property='og:url'content=''/>
	<meta property='og:site_name'content=''/>
	<meta property='og:description'content=''/>
	<meta name='twitter:title'content=''/>
	<meta name='twitter:image'content=''/>
	<meta name='twitter:url'content=''/>
	<meta name='twitter:card'content=''/>

	<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700'rel='stylesheet'>
	
	<!-- Animate.css -->
	<link rel='stylesheet'href='css/animate.css'>
	<!-- Icomoon Icon Fonts-->
	<link rel='stylesheet'href='css/icomoon.css'>
	<!-- Bootstrap  -->
	<link rel='stylesheet'href='css/bootstrap.css'>

	<!-- Magnific Popup -->
	<link rel='stylesheet'href='css/magnific-popup.css'>

	<!-- Flexslider  -->
	<link rel='stylesheet'href='css/flexslider.css'>

	<!-- Owl Carousel -->
	<link rel='stylesheet'href='css/owl.carousel.min.css'>
	<link rel='stylesheet'href='css/owl.theme.default.min.css'>
	
	<!-- Date Picker -->
	<link rel='stylesheet'href='css/bootstrap-datepicker.css'>
	<!-- Flaticons  -->
	<link rel='stylesheet'href='fonts/flaticon/font/flaticon.css'>

	<!-- Theme style  -->
	<link rel='stylesheet'href='css/style.css'>

	<!-- Modernizr JS -->
	<script src='js/modernizr-2.6.2.min.js'></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src='js/respond.min.js'></script>
	<![endif]-->

	</head>
	<body>
		
	<div class='colorlib-loader'></div>";
	include('header.php');
	echo"
		<div class='colorlib-wrap'>
			<div class='container margin-topby payment-details'>
				<div class='row'>
					<div class='col-md-5'>
						<form action='payment-result.php' method='post'>
							<div class='row'>
								<h2>Payment - Credit Card</h2>
								<input type='text' class='form-control login' id='cardNo' placeholder='Enter your Name' required='true'><br/>
								<input type='text' class='form-control login' id='cardNo' placeholder='Enter your Card No' required='true'><br/>
								<div class='col-md-2 remove-padding'>
									<input type='text' class='form-control login' id='password' placeholder='CVV' required='true'><br/>
								</div>
								<div class='col-md-3'>
								</div>
								<div class='col-md-3'>
									<h4>Exp Date</h4>
								</div>
								<div class='col-md-2 remove-padding'>
									<input type='text' class='form-control login' id='password' placeholder='MM' required='true'><br/>
								</div>
								<div class='col-md-2 remove-padding'>
									<input type='text' class='form-control login' id='password' placeholder='YY' required='true'><br/>
								</div>
							</div>
							<div class='row'>	
								<div class='col-md-4'>
								</div>
								<div class='col-md-5'>
									<input type='submit' name='submit' id='submit' value='Make Payment' class='btn btn-primary btn-block'>
								</div>
							</div>
						</form>
					</div>
					<div class='col-md-2'>
					</div>
					<!-- SIDEBAR-->
					<div class='col-md-4 payment'>
						<div class='sidebar-wrap'>
							<div class='row'>
								<h2>Payment Details</h2>
							</div>
							<div class='row'>
								<h3>Tour Package - </h3>
								<h4>". $tour_price ."/person</h4>
							</div><br/>
							<div class='row'>
								<h3>No of  Guest - </h3>
								<h4>". $_SESSION['no-of-guest'] ." Members</h4>
							</div><br/>
							<div class='row'>
								<h3>Hotel Rent - </h3>
								<h4>$". $hotel_rent ."/night</h4>
							</div><br/>
							<div class='row'>
								<h3>Total Duration - </h3>
								<h4>". $tour_duration ." Days</h4>
							</div><br/>
							<div class='row'>
								<h3>Total Price - </h3>";
								$tour_price = str_replace("$", "", $tour_price);
								$total = ($tour_price * $_SESSION['no-of-guest']) + ($hotel_rent * $tour_duration);
								$_SESSION['tour_total'] = $total;
								echo "
								<h4>$". $total ."</h4>
							</div><br/>
						</div>
					</div>
				</div>
			</div>
		</div>";
		include 'footer.html';
	echo "</body>
</html>";
}
?>
