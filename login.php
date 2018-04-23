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
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
		<style type="text/css">
		.formInput{
			margin-top: 30px; 
			font-size: 18px; 
			width: 100%;
			padding-right: 3em;
			border: none;border: 2px 
			solid #fff;background: #fff;
			color: #333333 !important;
			-webkit-border-radius: 30px;
			-moz-border-radius: 30px;
			-ms-border-radius: 30px;
			border-radius: 30px;
			width: 80%; 
		}
	</style>

	</head>
	<body>
	<?php
		include('config.php');
		include('header.php');

		if($_SERVER["REQUEST_METHOD"] == "POST") {

		       $myusername = mysqli_real_escape_string($db,$_POST['email']);
		       $pwd = mysqli_real_escape_string($db,$_POST['password']); 
		       $mypassword = md5($pwd);
		      $sql = "SELECT  * FROM USER_INFORMATION WHERE Email = '$myusername' and Password = '$mypassword'";
			  $result = mysqli_query($db,$sql);
		      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		      //$active = $row['active'];
		      
		      $count = mysqli_num_rows($result);
		      
		      // If result matched $myusername and $mypassword, table row must be 1 row
				
		      if($count == 1) {
		        $_SESSION['login_user'] = $myusername;
				$_SESSION['UserID'] = $row["UserID"];
				$_SESSION['firstName'] = $row["FirstName"];
				$_SESSION['UserType'] = $row["UserType"];
		      	if($row["UserType"] == "USER" && $row["Status"] == "ACTIVE"){
			  		header("location: userdashboard.php");
			  	} else if($row["UserType"] == "ADMIN"){
			  		header("location: admindashboard.php");
			  	}else if($row["UserType"] == "USER" && $row["Status"] == "BLOCKED"){
			  		echo '<script type="text/javascript">alert("Your account is blocked. Please contact system administrator"); </script>';
			  	}

		      }else {
		      	echo '<script type="text/javascript">alert("Your Login Name or Password is invalid"); </script>';
		         $error = "Your Login Name or Password is invalid";
		      }
		   }
	?> 

	<div class="colorlib-loader"></div>

	<div id="page">
	
		<div id="colorlib-subscribe" style="background-image: url(images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
						<h2>Login</h2>
						
						<form class="form-inline remove-padding"  style="background-color: transparent;border:transparent;" method="post"  action="login.php">
							<div class="row">
								<div class="col-md-12 col-md-offset-0">
									<div class="form-group" style = "width : 80%">
											<input type="text" class="form-control textInput formInput" name="email" id="email" placeholder="Enter your email" required="true">
											<br>
											<input type="password" class="form-control textInput formInput" name="password" id="password" placeholder="Enter your password" required="true">

											<input type="submit" class=" btn btn-primary" value="Submit" placeholder="Enter your email" style="width :60%;margin-top: 30px; background-color: #FFDD00";>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
		include 'footer.html';
		?>
	</body>
</html>

