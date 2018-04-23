<?php
session_start();
echo "drop " . $_POST['dropdown-budget'] . "<br/>";
if (empty($_SESSION['query'])) {
	$_SESSION['query'] = 'select * from destinations;';
	unset($_SESSION['new_query']);
	$_SESSION['budget'] = 'Upto $500';
 } 
else {
	$new_query = 'select * from destinations ';
	$added_condition = false;
	if ( (!empty($_POST['dropdown-budget']) && $_POST['dropdown-budget'] != 'all') || (!empty($_POST['dropdown-duration']) && $_POST['dropdown-duration'] != 'all') || (!empty($_POST['dropdown-country']) && $_POST['dropdown-country'] != 'all') ) {
		$new_query .= 'where '; 
	}
	if ($_POST['dropdown-budget']) {
		if($_POST['dropdown-budget'] != 'all'){
			$current_budgets = explode("-", $_POST['dropdown-budget']);
			if(count($current_budgets) == 1){
				$new_query .= 'budget = ' . $_POST['dropdown-budget'];
			}
			else{
				if($current_budgets[1] == '>'){
					$new_query .= 'budget > ' . $current_budgets[0];
				}
				else{
					$new_query .= 'budget > ' . $current_budgets[0] . ' and budget < ' .  $current_budgets[1];
				}
			}
		}
		$added_condition = true;
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
		}
		$added_condition = true;
	}
	if ($_POST['dropdown-country']) {
		if($added_condition && $_POST['dropdown-country'] != 'all'){
			$added_condition = false;
			$new_query .= ' and '; 
		}
		if($_POST['dropdown-country'] != 'all'){
			$new_query .= 'country = \'' . $_POST['dropdown-country'] .'\'';
		}
	}
	$_SESSION['new_query'] = $new_query . ';';
}
echo " query " . $_SESSION['query'];
echo "<br/>";
echo " new " . $_SESSION['new_query'];
echo "<br/>";
//session_destroy();

echo"
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
		
	<div id='page'>
		<nav class='colorlib-nav remove-image' role='navigation'>
			<div class='container'>
				<div class='row'>
					<div class='top-menu'>
						<div class='container-fluid'>
							<div class='row'>
								<div class='col-xs-2'>
									<div id='colorlib-logo'><a href='index.html'>Tour</a></div>
								</div>
								<div class='col-xs-10 text-right menu-1'>
									<ul>
										<li><a href='index.html'>Home</a></li>
										<li class='has-dropdown'>
											<a href='tours.html'>Tours</a>
											<ul class='dropdown'>
												<li><a href='#'>Destination</a></li>
												<li><a href='#'>Cruises</a></li>
												<li><a href='#'>Hotels</a></li>
												<li><a href='#'>Booking</a></li>
											</ul>
										</li>
										<li><a href='hotels.html'>Hotels</a></li>
										<li><a href='services.html'>Services</a></li>
										<li><a href='blog.html'>Blog</a></li>
										<li><a href='about.html'>About</a></li>
										<li><a href='login.html'>Login</a></li>
										<li><a href='contact.html'>Contact</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<div id='colorlib-testimony' class='colorlib-light-grey'>
			<div class='container'>
				<div class='row'>
					<div class='col-md-6 col-md-offset-3 text-center colorlib-heading animate-box'>
						<h2>Travel with us</h2>
						<p>We filtered out few destination according to your intrest from thousands of places</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-2'>						
						<div class='filter'>
							<h2>Filter</h2>
							<form action='destination_search.php' id='filter' method='post'>
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
									echo "<option value='Austrilia'>Austrilia</option>";
									echo "<option value='China'>China</option>";
									echo "<option value='London'>London</option>";
									echo "<option value='India'>India</option>";
								}
								else{
									switch($_POST['dropdown-country']){
										case 'United States':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States' selected='selected'>United States</option>";
											echo "<option value='Austrilia'>Austrilia</option>";
											echo "<option value='China'>China</option>";
											echo "<option value='London'>London</option>";
											echo "<option value='India'>India</option>";
											break;
										case 'Austrilia':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States'>United States</option>";
											echo "<option value='Austrilia' selected='selected'>Austrilia</option>";
											echo "<option value='China'>China</option>";
											echo "<option value='London'>London</option>";
											echo "<option value='India'>India</option>";
											break;
										case 'China':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States'>United States</option>";
											echo "<option value='Austrilia'>Austrilia</option>";
											echo "<option value='China' selected='selected'>China</option>";
											echo "<option value='London'>London</option>";
											echo "<option value='India'>India</option>";
											break;
										case 'London':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States'>United States</option>";
											echo "<option value='Austrilia'>Austrilia</option>";
											echo "<option value='China'>China</option>";
											echo "<option value='London' selected='selected'>London</option>";
											echo "<option value='India'>India</option>";
											break;
										case 'India':
											echo "<option value='all'>Select Country</option>";
											echo "<option value='United States'>United States</option>";
											echo "<option value='Austrilia'>Austrilia</option>";
											echo "<option value='China'>China</option>";
											echo "<option value='London'>London</option>";
											echo "<option value='India' selected='selected'>India</option>";
											break;
									}
								}
								echo "
								</select><br/>
								<button type='submit' class='btn btn-success'>Apply</button>
							</form>
						</div>
					</div>
					<div class='col-md-10'>						
						<div class='search-panel table-responsive'>
							<h2>Search panel</h2>
							<div class='search-result'>";
							for ($x = 0; $x <= 10; $x++) {
								$id_name = "package1_price{$x}";
								$id_price = 700;
								$id_price_premium = 1000;
								$id_standard = true;
								$id_premium = false;
								echo "
								<div class='destination-result' style='border: 1px solid'>
									<div class='col-md-12 destination-title'>
										<h4>New York |</h4>
										<span>2 Nights 3 Days</span>
									</div>
									<div class='col-md-3'>
										<img src='images/tour-2.jpg' class='img-rounded' alt='Cinque Terre'>
									</div>
									<div class='col-md-6 package-details'>
										<h5>Hobbies matched</h5>
										<h6>Treking</h6><h6>Treking</h6><h6>Treking</h6><h6>Treking</h6><br/><br/>
										<h5><b>Hotels and Transport available for this tour</b></h5>
										<h5>Select Package</h5>
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
									</div>
									<div class='col-md-3 package-price'>
										<span class='price' id='" . $id_name ."'>$700</span>
										<span class='terms'>Per person from Bloomington</span><br/><br/>
										<form>
											<button type='button' class='btn btn-success'>Buy Package</button>
										</form>
									</div>
								</div><br/>";
							} 
								echo"
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>

		<div id='colorlib-testimony' class='colorlib-light-grey'>
			<div class='container'>
				<div class='row'>
					<div class='col-md-6 col-md-offset-3 text-center colorlib-heading animate-box'>
						<h2>Our Satisfied Guests says</h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-8 col-md-offset-2 animate-box'>						
						<div class='owl-carousel2'>
							<div class='item'>
								<div class='testimony text-center'>
									<span class='img-user' style='background-image: url(images/person1.jpg);'></span>
									<span class='user'>Alysha Myers</span>
									<small>Miami Florida, USA</small>
									<blockquote>
										<p>' A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
									</blockquote>
								</div>
							</div>
							<div class='item'>
								<div class='testimony text-center'>
									<span class='img-user' style='background-image: url(images/person2.jpg);'></span>
									<span class='user'>James Fisher</span>
									<small>New York, USA</small>
									<blockquote>
										<p>One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
									</blockquote>
								</div>
							</div>
							<div class='item'>
								<div class='testimony text-center'>
									<span class='img-user' style='background-image: url(images/person3.jpg);'></span>
									<span class='user'>Jacob Webb</span>
									<small>Athens, Greece</small>
									<blockquote>
										<p>Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
									</blockquote>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>

	
		<div id='colorlib-subscribe' style='background-image: url(images/img_bg_2.jpg);' data-stellar-background-ratio='0.5'>
			<div class='overlay'></div>
			<div class='container'>
				<div class='row'>
					<div class='col-md-6 col-md-offset-3 text-center colorlib-heading animate-box'>
						<h2>Sign Up for a Newsletter</h2>
						<p>Sign up for our mailing list to get latest updates and offers.</p>
						<form class='form-inline qbstp-header-subscribe'>
							<div class='row'>
								<div class='col-md-12 col-md-offset-0'>
									<div class='form-group'>
										<input type='text' class='form-control' id='email' placeholder='Enter your email'>
										<button type='submit' class='btn btn-primary'>Subscribe</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<footer id='colorlib-footer' role='contentinfo'>
			<div class='container'>
				<div class='row row-pb-md'>
					<div class='col-md-3 colorlib-widget'>
						<h4>Tour Agency</h4>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						<p>
							<ul class='colorlib-social-icons'>
								<li><a href='#'><i class='icon-twitter'></i></a></li>
								<li><a href='#'><i class='icon-facebook'></i></a></li>
								<li><a href='#'><i class='icon-linkedin'></i></a></li>
								<li><a href='#'><i class='icon-dribbble'></i></a></li>
							</ul>
						</p>
					</div>
					<div class='col-md-2 colorlib-widget'>
						<h4>Book Now</h4>
						<p>
							<ul class='colorlib-footer-links'>
								<li><a href='#'>Flight</a></li>
								<li><a href='#'>Hotels</a></li>
								<li><a href='#'>Tour</a></li>
								<li><a href='#'>Car Rent</a></li>
								<li><a href='#'>Beach &amp; Resorts</a></li>
								<li><a href='#'>Cruises</a></li>
							</ul>
						</p>
					</div>
					<div class='col-md-2 colorlib-widget'>
						<h4>Top Deals</h4>
						<p>
							<ul class='colorlib-footer-links'>
								<li><a href='#'>Edina Hotel</a></li>
								<li><a href='#'>Quality Suites</a></li>
								<li><a href='#'>The Hotel Zephyr</a></li>
								<li><a href='#'>Da Vinci Villa</a></li>
								<li><a href='#'>Hotel Epikk</a></li>
							</ul>
						</p>
					</div>
					<div class='col-md-2'>
						<h4>Blog Post</h4>
						<ul class='colorlib-footer-links'>
							<li><a href='#'>The Ultimate Packing List For Female Travelers</a></li>
							<li><a href='#'>How These 5 People Found The Path to Their Dream Trip</a></li>
							<li><a href='#'>A Definitive Guide to the Best Dining and Drinking Venues in the City</a></li>
						</ul>
					</div>

					<div class='col-md-3 col-md-push-1'>
						<h4>Contact Information</h4>
						<ul class='colorlib-footer-links'>
							<li>291 South 21th Street, <br> Suite 721 New York NY 10016</li>
							<li><a href='tel://1234567920'>+ 1235 2355 98</a></li>
							<li><a href='mailto:info@yoursite.com'>info@yoursite.com</a></li>
							<li><a href='#'>yoursite.com</a></li>
						</ul>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-12 text-center'>
						<p>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class='icon-heart2' aria-hidden='true'></i> by <a href='https://colorlib.com' target='_blank'>Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span> 
							<span class='block'>Demo Images: <a href='http://unsplash.co/' target='_blank'>Unsplash</a> , <a href='http://pexels.com/' target='_blank'>Pexels.com</a></span>
						</p>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class='gototop js-top'>
		<a href='#' class='js-gotop'><i class='icon-arrow-up2'></i></a>
	</div>

	<!-- jQuery -->
	<script src='js/jquery.min.js'></script>
	<!-- jQuery Easing -->
	<script src='js/jquery.easing.1.3.js'></script>
	<!-- Bootstrap -->
	<script src='js/bootstrap.min.js'></script>
	<!-- Waypoints -->
	<script src='js/jquery.waypoints.min.js'></script>
	<!-- Flexslider -->
	<script src='js/jquery.flexslider-min.js'></script>
	<!-- Owl carousel -->
	<script src='js/owl.carousel.min.js'></script>
	<!-- Magnific Popup -->
	<script src='js/jquery.magnific-popup.min.js'></script>
	<script src='js/magnific-popup-options.js'></script>
	<!-- Date Picker -->
	<script src='js/bootstrap-datepicker.js'></script>
	<!-- Stellar Parallax -->
	<script src='js/jquery.stellar.min.js'></script>

	<!-- Main -->
	<script src='js/main.js'></script>
	<script>
		function changeValue(radioID, value, premiumPrice, type) {
			alert('The input value has changed. The new value is: '+ radioID +' price '+value + ' type '+type);
			if(!type)
				value = premiumPrice;
			document.getElementById(radioID).innerHTML = '$' + value;
		}
	</script>

	</body>
</html>";

?>	