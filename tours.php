<?php
include('database_connection.php');
session_start();
$_SESSION['tour_type'] = 1;
$_SESSION['group_id'] = 0;
$new_query = 'select distinct tour_id, tour_name, tour_country, duration, standard_price, premium_price, image_link from destinations';
$added_condition = false;
$give_suggestions = true;
if ($_SESSION['login_user']) {
	if ($_POST['dropdown-suggestion']) {
		if($_POST['dropdown-suggestion'] == 'no'){
			$give_suggestions = false;
		}
	}
	if($give_suggestions){
		unset($_SESSION['new_query']);
		$get_tag_sql = 'select Hobbies from USER_INFORMATION where Email="'. $_SESSION['login_user'] . '"';
		$get_tag_result = mysqli_query($conn, $get_tag_sql) or die ("break here");
		if (!$get_tag_result){
			echo "Error creating database: " . mysql_error();
		}
		else{
			if ($get_tag_result->num_rows > 0) {
				while($row = $get_tag_result->fetch_assoc()) {
					$all_tags = $row['Hobbies'];
					$tag_array = explode(',',$all_tags);
				}
			}
			if(count($tag_array) > 0){
				$iterator = 1;
				$new_query .= ' where';
				foreach($tag_array as $tag)
				{
					$tag = str_replace(' ', '', $tag);
					$new_query .= ' tag="'. $tag .'"';
					if($iterator != count($tag_array)){
						$new_query .= ' or ';					
					}
					$iterator++;
				}
			}
		}
		$added_condition = true;
	}
}

if ( !$added_condition && ((!empty($_POST['dropdown-budget']) && $_POST['dropdown-budget'] != 'all') || (!empty($_POST['dropdown-duration']) && $_POST['dropdown-duration'] != 'all') || (!empty($_POST['dropdown-country']) && $_POST['dropdown-country'] != 'all')) ) {
	$new_query .= ' where '; 
}
if ($_POST['dropdown-budget']) {
	if($added_condition && $_POST['dropdown-budget'] != 'all'){
		$added_condition = false;
		$new_query .= ' and ';
	}
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
		$added_condition = true;
	}
}
if ($_POST['dropdown-duration']) {
	if($added_condition && $_POST['dropdown-duration'] != 'all'){
		$added_condition = false;
		$new_query .= ' and '; 
	}
	if($_POST['dropdown-duration'] != 'all'){
		$current_durations = explode("-", $_POST['dropdown-duration']);
		if(count($current_durations) == 1){
			$new_query .= 'duration = ' . $_POST['dropdown-duration'];
		}
		else{
			if($current_durations[1] == '>'){
				$new_query .= 'duration > ' . $current_durations[0];
			}
			else{
				$new_query .= 'duration > ' . $current_durations[0] . ' and duration < ' .  $current_durations[1];
			}
		}
		$added_condition = true;
	}
}
if ($_POST['dropdown-country']) {
	if($added_condition && $_POST['dropdown-country'] != 'all'){
		$added_condition = false;
		$new_query .= ' and '; 
	}
	if($_POST['dropdown-country'] != 'all'){
		$new_query .= 'tour_country = \'' . $_POST['dropdown-country'] .'\'';
	}
}
$_SESSION['new_query'] = $new_query;
echo "
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Tour Template</title>
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
								$id_count = 0;
								while($row = $result->fetch_assoc()) {
									$id_name = "package_price{$id_count}";
									$tour_id = $row["tour_id"];
									$id_price = $row["standard_price"];
									$id_price_premium = $row["premium_price"];
									$id_standard = true;
									$id_premium = false;
									$id_duration = $row["duration"];
									$tour_name = $row["tour_name"];
									$tour_country = $row["tour_country"];
									$tour_image = $row["image_link"];
									echo"
									<div class='col-md-6 col-sm-6'>
										<div class='tour'>
											<a href='#' class='tour-img' style='background-image: url(images/" . $tour_image .");' onclick='setSession(". $tour_id .",\"". $id_name . "\")'>
												<p class='price'><span id=". $id_name . ">$" . $id_price ."</span> <small>/ ". $id_duration ." Days</small></p>
											</a>
											<span class='desc'>
												<i>
													<form>
														<label class='radio-inline'>
															<input checked type='radio' onchange='changeValue(this.name," . $id_price ."," . $id_price_premium . "," . $id_standard . ")' name='" . $id_name . "'>Standard
														</label>
														<label class='radio-inline'>
															<input type='radio' onchange='changeValue(this.name," . $id_price . "," . $id_price_premium . "," . $id_premium . ")' name='" . $id_name . "'>Premium
														</label>
													</form>
												</i>
												<h2><a href='tour-place.html'>" . $tour_name . "</a></h2>
												<span class='city'>" . $tour_country ."</span>
											</span>
										</div>
									</div>";
									$id_count++;
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
							<form action='tours.php' id='filter' method='post'>
								<select class='form-control' id='select_1' name='dropdown-budget'>";
								if(!$_POST['dropdown-budget'] || $_POST['dropdown-budget'] == 'all'){
									echo "<option value='all' selected='selected'>Select Budget</option>";
									echo "<option value='500'>Upto $499</option>";
									echo "<option value='499-1000'>$500 - $999</option>";
									echo "<option value='999-2000'>$1000 - $1999</option>";
									echo "<option value='1999->'>Greater than $2000</option>";
								}
								else{
									switch($_POST['dropdown-budget']){
										case '500':
											echo "<option value='all'>Select Budget</option>";
											echo "<option value='500' selected='selected'>Upto $499</option>";
											echo "<option value='499-1000'>$500 - $999</option>";
											echo "<option value='999-2000'>$1000 - $1999</option>";
											echo "<option value='1999->'>Greater than $2000</option>";
											break;
										case '499-1000':
											echo "<option value='all'>Select Budget</option>";
											echo "<option value='500'>Upto $499</option>";
											echo "<option value='499-1000' selected='selected'>$500 - $999</option>";
											echo "<option value='999-2000'>$1000 - $1999</option>";
											echo "<option value='1999->'>Greater than $2000</option>";
											break;
										case '999-2000':
											echo "<option value='all'>Select Budget</option>";
											echo "<option value='500'>Upto $499</option>";
											echo "<option value='499-1000'>$500 - $999</option>";
											echo "<option value='999-2000' selected='selected'>$1000 - $1999</option>";
											echo "<option value='1999->'>Greater than $2000</option>";
											break;
										case '1999->':
											echo "<option value='all'>Select Budget</option>";
											echo "<option value='500'>Upto $499</option>";
											echo "<option value='499-1000'  selected='selected'>$500 - $999</option>";
											echo "<option value='999-2000'>$1000 - $1999</option>";
											echo "<option value='1999->' selected='selected'>Greater than $2000</option>";
											break;
									}
								}
								
								echo "
								</select><br/>
								<select class='form-control' id='select_1' name='dropdown-duration'>";
								if(!$_POST['dropdown-duration'] || $_POST['dropdown-duration'] == 'all'){
									echo "<option value='all'>Select Duration</option>";
									echo "<option value='2'>Upto 2 Nights</option>";
									echo "<option value='4'>4 Nights</option>";
									echo "<option value='4-9'>5 to 8 Nights</option>";
									echo "<option value='8->'>9 Nights and above</option>";
								}
								else{
									switch($_POST['dropdown-duration']){
										case '2':
											echo "<option value='all'>Select Duration</option>";
											echo "<option value='2' selected='selected'>Upto 2 Nights</option>";
											echo "<option value='4'>4 Nights</option>";
											echo "<option value='4-9'>5 to 8 Nights</option>";
											echo "<option value='8->'>9 Nights and above</option>";
											break;
										case '4':
											echo "<option value='all'>Select Duration</option>";
											echo "<option value='2'>Upto 2 Nights</option>";
											echo "<option value='4' selected='selected'>4 Nights</option>";
											echo "<option value='4-9'>5 to 8 Nights</option>";
											echo "<option value='8->'>9 Nights and above</option>";
											break;
										case '4-9':
											echo "<option value='all'>Select Duration</option>";
											echo "<option value='2'>Upto 2 Nights</option>";
											echo "<option value='4'>4 Nights</option>";
											echo "<option value='4-9' selected='selected'>5 to 8 Nights</option>";
											echo "<option value='8->'>9 Nights and above</option>";
											break;
										case '8->':
											echo "<option value='all'>Select Duration</option>";
											echo "<option value='2'>Upto 2 Nights</option>";
											echo "<option value='4'>4 Nights</option>";
											echo "<option value='4-9'>5 to 8 Nights</option>";
											echo "<option value='8->' selected='selected'>9 Nights and above</option>";
											break;
									}
								}
								echo "
								</select><br/>
								<select class='form-control' id='select_1' name='dropdown-country'>";
								if(!$_POST['dropdown-country'] || $_POST['dropdown-country'] == 'all'){
									echo "<option value='all'>Select Country</option>";
									echo "<option value='United States'>United States</option>";
									echo "<option value='Australia'>Australia</option>";
									echo "<option value='China'>China</option>";
									echo "<option value='London'>London</option>";
									echo "<option value='India'>India</option>";
								}
								else{
									switch($_POST['dropdown-country']){
										case 'United States':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States' selected='selected'>United States</option>";
											echo "<option value='Australia'>Australia</option>";
											echo "<option value='China'>China</option>";
											echo "<option value='London'>London</option>";
											echo "<option value='India'>India</option>";
											break;
										case 'Australia':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States'>United States</option>";
											echo "<option value='Australia' selected='selected'>Australia</option>";
											echo "<option value='China'>China</option>";
											echo "<option value='London'>London</option>";
											echo "<option value='India'>India</option>";
											break;
										case 'China':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States'>United States</option>";
											echo "<option value='Australia'>Australia</option>";
											echo "<option value='China' selected='selected'>China</option>";
											echo "<option value='London'>London</option>";
											echo "<option value='India'>India</option>";
											break;
										case 'London':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States'>United States</option>";
											echo "<option value='Australia'>Australia</option>";
											echo "<option value='China'>China</option>";
											echo "<option value='London' selected='selected'>London</option>";
											echo "<option value='India'>India</option>";
											break;
										case 'India':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States'>United States</option>";
											echo "<option value='Australia'>Australia</option>";
											echo "<option value='China'>China</option>";
											echo "<option value='London'>London</option>";
											echo "<option value='India' selected='selected'>India</option>";
											break;
									}
								}
								echo "
								</select><br/>
								<select class='form-control' id='select_1' name='dropdown-suggestion'>";
								if(!$_POST['dropdown-suggestion'] || $_POST['dropdown-suggestion'] == 'Suggestion'){
									echo "<option value='no'>Remove Suggestions</option>";
									echo "<option value='Suggestion' selected='selected'>Give Suggestions</option>";
								}
								else{
									switch($_POST['dropdown-suggestion']){
										case 'no':
											echo "<option value='no' selected='selected'>Remove Suggestions</option>";
											echo "<option value='Suggestion'>Give Suggestions</option>";
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
			</div>
		</div>";
		include 'footer.html';
	echo"
	<script>
		function changeValue(radioID, value, premiumPrice, type) {
			if(!type)
				value = premiumPrice;
			document.getElementById(radioID).innerHTML = '$' + value;
		}
	</script>
	<script>
		function setSession(tourId, id) {
			var price = document.getElementById(id).textContent;
			var sessionPrice = \"tour-price\" + \"=\" + price;
			var sessionId = \"tour-id\" + \"=\" + tourId;
			document.cookie= sessionPrice;
			document.cookie= sessionId;
			window.location='tour-place.php';
		}
	</script>

	</body>
</html>";
$conn->close();
?>

