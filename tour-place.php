<?php
include('database_connection.php');
session_start();
$tour_id = $_COOKIE['tour-id']; 
$sql = 'select distinct tour_name, tour_country, duration, image_link,description from destinations where tour_id='. $tour_id;
$result = mysqli_query($conn, $sql) or die ("break here");
if (!$result){
	echo "Error creating database: " . mysql_error();
}
else{
	while($row = $result->fetch_assoc()) {
		$tour_duration = $row["duration"];
		$tour_name = $row["tour_name"];
		$tour_country = $row["tour_country"];
		$tour_image = $row["image_link"];
		$tour_desc = $row["description"];
	}
}
echo "
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Tour Details</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='description' content='' />
	<meta name='keywords' content='' />
	<meta name='author' content='' />

  <!-- Facebook and Twitter integration -->
	<meta property='og:title' content=''/>
	<meta property='og:image' content=''/>
	<meta property='og:url' content=''/>
	<meta property='og:site_name' content=''/>
	<meta property='og:description' content=''/>
	<meta name='twitter:title' content='' />
	<meta name='twitter:image' content='' />
	<meta name='twitter:url' content='' />
	<meta name='twitter:card' content='' />

	<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700' rel='stylesheet'>
	
	<!-- Animate.css -->
	<link rel='stylesheet' href='css/animate.css'>
	<!-- Icomoon Icon Fonts-->
	<link rel='stylesheet' href='css/icomoon.css'>
	<!-- Bootstrap  -->
	<link rel='stylesheet' href='css/bootstrap.css'>

	<!-- Magnific Popup -->
	<link rel='stylesheet' href='css/magnific-popup.css'>

	<!-- Flexslider  -->
	<link rel='stylesheet' href='css/flexslider.css'>

	<!-- Owl Carousel -->
	<link rel='stylesheet' href='css/owl.carousel.min.css'>
	<link rel='stylesheet' href='css/owl.theme.default.min.css'>
	
	<!-- Date Picker -->
	<link rel='stylesheet' href='css/bootstrap-datepicker.css'>
	<!-- Flaticons  -->
	<link rel='stylesheet' href='fonts/flaticon/font/flaticon.css'>

	<!-- Theme style  -->
	<link rel='stylesheet' href='css/style.css'>

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
			<div class='container'>
				<div class='row'>
					<div class='col-md-9'>
						<div class='row'>
							<div class='col-md-12'>
								<div class='wrap-division'>
									<div class='col-md-12 col-md-offset-0 heading2 animate-box'>
										<h2>" . $tour_name . "</h2>
									</div>
									<div class='row'>
										<div class='col-md-12 animate-box'>
											<div class='room-wrap'>
												<div class='row'>
													<div class='col-md-6 col-sm-6'>
														<div class='room-img' style='background-image: url(images/". $tour_image .");'></div>
													</div>
													<div class='col-md-6 col-sm-6'>
														<div class='desc'>
															<h2>" . $tour_country . "</h2>
															<p>". $tour_desc ."</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- SIDEBAR-->
					<div class='col-md-3'>
						<div class='sidebar-wrap'>
							<div class='side search-wrap animate-box'>
								<h3 class='sidebar-heading'>Find your hotel</h3>
								<form method='post' class='colorlib-form' action='hotels.php'>
									<div class='row'>
										<div class='col-md-12'>
											<div class='form-group'>
												<label for='date'>Check-in:</label>
												<div class='form-field'>
													<i class='icon icon-calendar2'></i>
													<input type='text' id='checkin-date' class='form-control date' placeholder='Check-in date' required='true' name='checkin-date'>
												</div>
											</div>
										</div>
										<div class='col-md-12'>
											<div class='form-group'>
												<label for='date'>Check-out:</label>
												<div class='form-field'>
													<i class='icon icon-calendar2'></i>
													<input type='text' id='checkout-date' class='form-control date' placeholder='Check-out date' name='checkout-date'>
												</div>
											</div>
										</div>
										<div class='col-md-12'>
											<div class='form-group'>
												<label for='guests'>Guest</label>
												<div class='form-field'>
													<input type='text' class='form-control' value=1 name='no-of-guest' required='true'>
												</div>
											</div>
										</div>
										<div class='col-md-12'>
											<input type='submit' name='submit' id='submit' value='Find Hotel' class='btn btn-primary btn-block'>
										</div>
									</div>
				        		</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>";
		include 'footer.html';
	echo"</body>
	<script>
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		var checkin = $('#checkin-date').datepicker({
		beforeShowDay: function(date) {
			return date.valueOf() >= now.valueOf();
		},
		autoclose: true
		
		}).on('changeDate', function(ev) {
		if (ev.date.valueOf() > checkout.datepicker('getDate').valueOf() || !checkout.datepicker('getDate').valueOf()) {
			var newDate = new Date(ev.date);
			newDate.setDate(newDate.getDate() + 1);
			checkout.datepicker('update', newDate);
		}
		$('#checkout-date')[0].focus();
		});
		
		var checkout = $('#checkout-date').datepicker({
		beforeShowDay: function(date) {
			if (!checkin.datepicker('getDate').valueOf()) {
			return date.valueOf() >= new Date().valueOf();
			} else {
			return date.valueOf() > checkin.datepicker('getDate').valueOf();
			}
		},
		autoclose: true
		}).on('changeDate', function(ev) {});
	</script>

	</body>
</html>";

?>

