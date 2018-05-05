<?php
include('database_connection.php');
session_start();
$tour_id = $_COOKIE['tour-id']; 
$hotel_id = $_COOKIE['hotel-id'];
$tour_price = $_SESSION['tour_total']; 
$checkin_date = $_SESSION['checkin-date'];
$user_id = $_SESSION['login_user'];
$tour_type = $_SESSION['tour_type'];
$group_id = $_SESSION['group_id'];
$checkin_time = strtotime($checkin_date);
$formated_date = date('Y-m-d',$checkin_time);
$insert_sql = 'insert into tour_bookings(tour_id, tour_type, hotel_id,booked_by, group_id, total_cost, booking_date, booking_status) values('.$tour_id.','. $tour_type .','. $hotel_id .',\''. $user_id .'\','. $group_id .','. $tour_price .',\''. $formated_date .'\',1)';
$insert_result = mysqli_query($conn, $insert_sql) or die ("break here");
if (!$insert_result){
	echo "Error creating database: " . mysql_error();
}
else{
	$to      = $user_id;
	$message = "<b>Your Booking has been confirmed.</b>";
	$message .= "<h1>Thanks for booking a tour with <a href='http://ella.ils.indiana.edu/~szpatel/HappyHolidays-InfoArch/login.php'>MyHobbyHolidays</a></h1>";
	$message .= "<b>You have booked a tour on ". $checkin_date ."</b></br>";
	$message .= "<b>Total payment received is ". $tour_price ."</b>";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html\r\n";
	$retval = mail ($to,$subject,$message,$header);
	if( !$retval) {
		echo "Email could not be send";
	}
}
echo "
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible'content='IE=edge'>
	<title>Payment Result</title>
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
					<div class='col-md-2'>
					</div>
					<div class='col-md-9'>
						<div class='row'>
							<h2>Payment - Successfull</h2>
							<h3>Your bookings</h3>";
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
							echo"
							<a href='tours.php'>Back to search page</a>
						</div>
					</div>
				</div>
			</div>
		</div>";
		include 'footer.html';
	echo"
	</body>
</html>";

?>
