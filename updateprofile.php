<?php
session_start();
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
		      $sql = "SELECT  * FROM USER_INFORMATION WHERE Email = '$username'";
		      $result = mysqli_query($db,$sql);
		      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		      $count = mysqli_num_rows($result);

		      if($count >= 1) {
		      
	      		echo '<script type="text/javascript">
	      		$(document).ready(function() {
				    console.log( "ready! php" );
				    document.getElementById("firstname").value ="'. $row["FirstName"].'";
				    document.getElementById("lastname").value ="'. $row["LastName"].'";
				    document.getElementById("phone").value ="'. $row["Phone"].'";
				    document.getElementById("street").value ="'. $row["Street"].'";
				    document.getElementById("zip").value ="'. $row["Zip"].'";
				    document.getElementById("city").value ="'. $row["City"].'";
				    document.getElementById("state").value ="'. $row["State"].'";
				    document.getElementById("hobby").value ="'. $row["Hobbies"].'";
				});
	      		</script>';
		      	}


		      	if($_SERVER["REQUEST_METHOD"] == "POST") {
		      // username and password sent from form 
			      
			       $phone = mysqli_real_escape_string($db,$_POST['phone']); 
			       $firstname = mysqli_real_escape_string($db,$_POST['firstname']); 
			       $lastname = mysqli_real_escape_string($db,$_POST['lastname']); 
			       $street = mysqli_real_escape_string($db,$_POST['street']); 
			       $city = mysqli_real_escape_string($db,$_POST['city']); 
			       $zip = mysqli_real_escape_string($db,$_POST['zip']); 
			       $state = mysqli_real_escape_string($db,$_POST['state']); 
			       $hobby = mysqli_real_escape_string($db,$_POST['hobby']);
			      
		      		$sqlUpdate="UPDATE USER_INFORMATION SET FirstName = '".$firstname."' ,LastName = '".$lastname."',Phone ='".$phone."',Street='".$street."',City='".$city."',State = '".$state."',Zip ='".$zip."', Hobbies='".$hobby."' WHERE Email = '".$username."'";
					   if (mysqli_query($db, $sqlUpdate))
					   {
						   echo '<script type="text/javascript">alert("Update successful!")</script>';
						   //header("location: welcome.php");
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

										<input type="text" class="form-control formInput" name="firstname" id="firstname" placeholder="First Name" style="float:left;" required="true">

										<input type="text" class="form-control formInput" name="lastname" id="lastname" placeholder="Last Name" style="float:right;" required="true">

										<input type="text" class="form-control formInput" name="phone" id="phone" placeholder="Phone number" style="float:left;" required="true">

										<input type="text" class="form-control formInput" name="street" id="street" placeholder="Street" style="float:left;width: 100%" required="true">

											<input type="text" class="form-control formInput" name="city" id="city" placeholder="City" style="float:left;" required="true">

										<input type="text" class="form-control formInput" name="state" id="state" placeholder="State" style="float:right;" required="true">

										<input type="text" class="form-control formInput" name="zip" id="zip" placeholder="Zip Code" style="float:left;" required="true">

										<div style="width: 100% ; height: auto;float: left;background-color: grey; margin-top: 20px;">
											<input type="text" class="form-control formInput" name="hobby" id="hobby" placeholder="Hobby" style="float:left;margin-left: 5px;" readonly="false">
											<div style="width: 100% ; height: auto;float: left;margin-top: 15px;">
												<label class="hobbyChoice">History</label> <label class="hobbyChoice">Architecture</label><label class="hobbyChoice">Marine</label>
												<label class="hobbyChoice">Sculpture</label> <label class="hobbyChoice">Adventure</label><label class="hobbyChoice">Arts</label><label class="hobbyChoice">Nature</label><label class="hobbyChoice">Sports</label><label class="hobbyChoice">Food</label>
											</div>
										</div>
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

