<?php
session_start();
ob_start();
$tour_id = $_COOKIE["tour-id"];
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Update Profile</title>
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
			margin-top: 30px; font-size: 18px; width: 100%; padding-right: 3em; border: none;border: 2px solid #fff;background: #fff;color: #333333 !important;-webkit-border-radius: 30px;-moz-border-radius: 30px;-ms-border-radius: 30px;border-radius: 30px;width: 50%; 
		}

		.hobbyChoice{
			width: 29%;
			background-color: #eeeeee;
			margin-left: 2%;
		}
	</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	</head>
	<body>
	<?php
		include('session.php');
		include('header.php');
   
		$username = $_SESSION['login_user'];
		      $sql = "SELECT distinct tour_id, tour_name, tour_country, duration, standard_price, premium_price FROM destinations WHERE tour_id = '$tour_id'";
		      $result = mysqli_query($db,$sql);
		      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		      $count = mysqli_num_rows($result);

		      if($count >= 1) {
		      
	      		echo '<script type="text/javascript">
	      		$(document).ready(function() {
				    console.log( "ready! php" );
				    document.getElementById("tourname").value ="'. $row["tour_name"].'";
				    document.getElementById("tourcountry").value ="'. $row["tour_country"].'";
				    document.getElementById("duration").value ="'. $row["duration"].'";
				    document.getElementById("standardprice").value ="'. $row["standard_price"].'";
				    document.getElementById("premiumprice").value ="'. $row["premium_price"].'";
				});
	      		</script>';
		      	}


		      	if($_SERVER["REQUEST_METHOD"] == "POST") {
		      // username and password sent from form 
			      
			       $tourname = mysqli_real_escape_string($db,$_POST['tourname']); 
			       $tourcountry = mysqli_real_escape_string($db,$_POST['tourcountry']); 
			       $duration = mysqli_real_escape_string($db,$_POST['duration']); 
			       $standardprice = mysqli_real_escape_string($db,$_POST['standardprice']); 
			       $premiumprice = mysqli_real_escape_string($db,$_POST['premiumprice']); 
		      		$sqlUpdate="UPDATE destinations SET tour_name = '".$tourname."' ,tour_country = '".$tourcountry."',duration =".$duration.",standard_price=".$standardprice.",premium_price=".$premiumprice." where tour_id=".$tour_id;
					if (mysqli_query($db, $sqlUpdate))
					{
						echo '<script type="text/javascript">alert("Update successful!")</script>';
						//header("location: admindashboard.php");
					}
					else{
			      	echo '<script type="text/javascript">alert("Update Failed"); </script>';
					 $error = "Update failed!";
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
						<h2>Update your profile</h2>
						
						<form class="form-inline qbstp-header-subscribe" style="background-color: transparent;border:transparent;" method="post">
							<div class="row">
								<div class="col-md-12 col-md-offset-0">
									<div class="form-group" style = "width : 80%"">

										<input type="text" class="form-control formInput" name="tourname" id="tourname" placeholder="Tour Name" style="width:100%;" required="true">

										<input type="text" class="form-control formInput" name="tourcountry" id="tourcountry" placeholder="Tour Country" style="float:left;" required="true">

										<input type="text" class="form-control formInput" name="duration" id="duration" placeholder="Duration" style="float:right;" required="true">

										<input type="text" class="form-control formInput" name="standardprice" id="standardprice" placeholder="Standard Price" style="float:left;" required="true">

										<input type="text" class="form-control formInput" name="premiumprice" id="premiumprice" placeholder="Premium Price" style="float:right;" required="true">

										<input type="submit" class=" btn btn-primary" value="Submit" style="width :60%;margin-top: 30px; background-color: #FFDD00";>

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
	<script type="text/javascript">
		$( document ).ready(function() {
		    console.log( "ready!" );

		    $('.hobbyChoice').click(function(){
		    	if($("#hobby").val()=="" || $("#hobby").val()== undefined){
		    		$("#hobby").val($(this).text());
		    	}else if($("#hobby").val().indexOf($(this).text()) <= -1){
		    		$("#hobby").val($("#hobby").val()+', '+$(this).text());
		    	}
		    });
		});
	</script>

	</body>
</html>

