<?php
session_start();
include('database_connection.php');
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
	?>
	<div class="colorlib-loader"></div>

	<div id="page">
		<div id="colorlib-contact" style="min-height: 500px;">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 animate-box margin-topby">
						<h3>My Plans</h3>
						<form>
							<?php
								$user_id = $_SESSION['login_user'];
								$sql = 'select * from tour_bookings where booked_by=\''. $user_id .'\'';
								$result = mysqli_query($conn, $sql) or die ("break here");
								 if (!$result){
									 echo "Error creating database: " . mysql_error();
								 }
								 else{
									 echo "<table class='table'>
									 <thead>
									 <tr>
										 <th>Booking Id</th>
										 <th>Tour Name</th>
										 <th>Tour Country</th>
										 <th>Total Payment</th>
										 <th>Check-in Date</th>
										 <th>Status</th>
									 </tr>
									 </thead>
									 <tbody>";
									 $iterator = 1;
									 while($row = $result->fetch_assoc()) {
										 echo "
											 <tr>";
												 $tour_id = $row["tour_id"];
												 $total_cost = $row["total_cost"];
												 $booking_date = $row["booking_date"];
												 $booking_id = $row["booking_id"];
												 $booking_status = $row["booking_status"];
												 $inner_sql = 'select distinct tour_name,tour_country from destinations where tour_id='. $tour_id;
												 $inner_result = mysqli_query($conn, $inner_sql) or die ("break here");
												 if (!$inner_result){
													 echo "Error creating database: " . mysql_error();
												 }
												 else{
													 while($inner_row = $inner_result->fetch_assoc()) {
														 $tour_name = $inner_row["tour_name"];
														 $tour_country = $inner_row["tour_country"];
														 echo "
														 <th scope='row'>". $booking_id ."</th>
														 <td>". $tour_name ."</td>
														 <td>". $tour_country ."</td>
														 <td>". $total_cost ."</td>
														 <td>". $booking_date ."</td>";
														 if($booking_status == 1){
															 echo"<td>Active</td>";
														 }
														 else{
															 echo"<td>Canceled</td>";
														 }
													 }
												 }
											 echo "
											 </tr>";
										 $iterator++;
									 }
									 echo"</tbody>
									 </table>";	
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
	</body>
</html>

