<?php
session_start();
ob_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Blocked Users</title>
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
						<h3>Blocked Users</h3>
						<form>

							<?php
								 $sql = "SELECT  * FROM USER_INFORMATION WHERE Status = 'BLOCKED' AND UserType='USER'";
	      						 $result = mysqli_query($db,$sql);
	      						 $run = false;

	      						 if ($result->num_rows > 0) {
								    echo '<table class="table">';
								    while($row = $result->fetch_assoc()) {
								    	echo '<tr id="row_'.$row["Email"].'">';
								    	echo '<thead><tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Hobbies</th><th>City</th>
								    <th>State</th></tr></thead>';
								        echo '<td>' .$row["Email"]. '</td><td>' .$row["FirstName"]. '</td><td>' .$row["LastName"]. '</td><td>'. $row["Hobbies"].'</td><td>' . $row["City"].'</td><td>' . $row["State"].'</td>';
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
	</body>
</html>

