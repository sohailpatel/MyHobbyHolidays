<?php
include('database_connection.php');
session_start();
$tour_id = $_COOKIE['tour-id']; 
$_SESSION['no-of-guest'] = $_POST['no-of-guest'];
$_SESSION['checkin-date'] = $_POST['checkin-date'];
$sql = 'select distinct tour_country from destinations where tour_id='. $tour_id;
$result = mysqli_query($conn, $sql) or die ("break here");
if (!$result){
	echo "Error creating database: " . mysql_error();
}
else{
	while($row = $result->fetch_assoc()) {
		$tour_country = $row["tour_country"];
	}
}

if (empty($_SESSION['query'])) {
	$_SESSION['query'] = 'select * from hotels';
	unset($_SESSION['new_query']);
	$new_query = 'select * from hotels';
 } 
else {
	$new_query = 'select * from hotels';
	if ( (!empty($_POST['dropdown-budget']) && $_POST['dropdown-budget'] != 'all') ) {
		$new_query .= ' where '; 
	}
	if ($_POST['dropdown-budget']) {
		if($_POST['dropdown-budget'] != 'all'){
			$current_budgets = explode("-", $_POST['dropdown-budget']);
			if(count($current_budgets) == 1){
				$new_query .= 'standard_price < ' . $_POST['dropdown-budget'];
			}
			else{
				if($current_budgets[1] == '>'){
					$new_query .= 'standard_price > ' . $current_budgets[0];
				}
				else{
					$new_query .= 'standard_price > ' . $current_budgets[0] . ' and standard_price < ' .  $current_budgets[1];
				}
			}
		}
	}
	$_SESSION['new_query'] = $new_query;
}
echo "
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible'content='IE=edge'>
	<title>Hotels</title>
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
			<div class='container margin-topby'>
				<div class='row'>
					<div class='col-md-9'>
						<div class='row'>
							<div class='wrap-division'>";
							$result = mysqli_query($conn, $new_query) or die ("break here");
							if (!$result){
								echo "Error creating database: " . mysql_error();
							}
							//print_r($new_query);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$hotel_id = $row["hotel_id"];
									$budget = $row["standard_price"];
									$hotel_name = $row["hotel_name"];
									$hotel_desc = $row["description"];
									$hotel_image = $row["image_link"];
									echo "
									<div class='col-md-6 col-sm-6'>
										<div class='hotel-entry'>
											<a href='#'class='hotel-img'style=\"background-image: url(images/". $hotel_image .");\" onclick=\"setSession(". $hotel_id .",". $_POST['no-of-guest'] .")\">
												<p class='price'><span>$". $budget ."</span><small> /night</small></p>
											</a>
											<div class='desc'>
												<h3><a href='hotel-room.html'>". $hotel_name ."</a></h3>
												<span class='place'>". $tour_country ."</span>
												<p>". $hotel_desc ."</p>
											</div>
										</div>
									</div>";
								}
							}
							echo "
							</div>
						</div>
					</div>

					<!-- SIDEBAR-->
					<div class='col-md-3'>
						<div class='sidebar-wrap'>
						<h2>Filter</h2>
						<form action='hotels.php' id='filter' method='post'>
							<select class='form-control' id='select_1' name='dropdown-budget'>";
							if(!$_POST['dropdown-budget'] || $_POST['dropdown-budget'] == 'all'){
								echo "<option value='all' selected='selected'>Select Budget</option>";
								echo "<option value='200'>Upto $199</option>";
								echo "<option value='199-500'>$200 - $499</option>";
								echo "<option value='499-700'>$500 - $699</option>";
								echo "<option value='699->'>Greater than $700</option>";
							}
							else{
								switch($_POST['dropdown-budget']){
									case '200':
										echo "<option value='all'>Select Budget</option>";
										echo "<option value='200' selected='selected'>Upto $199</option>";
										echo "<option value='199-500'>$200 - $499</option>";
										echo "<option value='499-700'>$500 - $699</option>";
										echo "<option value='699->'>Greater than $700</option>";break;
									case '199-500':
										echo "<option value='all'>Select Budget</option>";
										echo "<option value='200'>Upto $199</option>";
										echo "<option value='199-500' selected='selected'>$200 - $499</option>";
										echo "<option value='499-700'>$500 - $699</option>";
										echo "<option value='699->'>Greater than $700</option>";
									break;
									case '499-700':
										echo "<option value='all'>Select Budget</option>";
										echo "<option value='200'>Upto $199</option>";
										echo "<option value='199-500'>$200 - $499</option>";
										echo "<option value='499-700' selected='selected'>$500 - $699</option>";
										echo "<option value='699->'>Greater than $700</option>";
										break;
									case '699->':
										echo "<option value='all'>Select Budget</option>";
										echo "<option value='200'>Upto $199</option>";
										echo "<option value='199-500'>$200 - $499</option>";
										echo "<option value='499-700'>$500 - $699</option>";
										echo "<option value='699->' selected='selected'>Greater than $700</option>";
										break;
								}
							}
							echo "
							</select><br/>
							<button type='submit' class='btn btn-success'>Apply</button>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>";
		include 'footer.html';
	echo "
	</body>
	<script>
		function setSession(hotelId, total) {
			var sessionHotelId = \"hotel-id\" + \"=\" + hotelId;
			var sessionTourGuest = \"tour-guest\" + \"=\" + total;
			document.cookie= sessionHotelId;
			document.cookie= sessionTourGuest;
			window.location='payment.php';
		}
	</script>

	</body>
</html>";

?>
