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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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

	<script>
  $( function() {
    $( "#birthday" ).datepicker();
  } );
  </script>

	</head>
	<body>
	<?php
		include("config.php");
		include('header.php');
		if($_SERVER["REQUEST_METHOD"] == "POST") {
		      // username and password sent from form 
		      
		       $myusername = mysqli_real_escape_string($db,$_POST['emailId']);
		       $pwd = mysqli_real_escape_string($db,$_POST['password']); 
		       $password = md5($pwd); 
		       $password2 = mysqli_real_escape_string($db,$_POST['password2']); 
		       $phone = mysqli_real_escape_string($db,$_POST['phone']); 
		       $firstname = mysqli_real_escape_string($db,$_POST['firstname']); 
		       $lastname = mysqli_real_escape_string($db,$_POST['lastname']); 
		       $street = mysqli_real_escape_string($db,$_POST['street']); 
		       $city = mysqli_real_escape_string($db,$_POST['city']); 
		       $zip = mysqli_real_escape_string($db,$_POST['zip']); 
		       $state = mysqli_real_escape_string($db,$_POST['state']);
		       $hobby = mysqli_real_escape_string($db,$_POST['hobby']);

		       $time = strtotime($_POST['birthday']);
				if ($time) {
				  $birthday = date('Y-m-d', $time);
				} else {
				   echo 'Invalid Date: ' . $_POST['birthday'];
				  // fix it.
				}

		      
		      $sql = "SELECT  * FROM USER_INFORMATION WHERE Email = '$myusername'";
		      $result = mysqli_query($db,$sql);
		      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		      //$active = $row['active'];
		      
		      $count = mysqli_num_rows($result);
		      
		      // If result matched $myusername and $mypassword, table row must be 1 row
				
		      if($count >= 1) {

		      	echo '<script type="text/javascript">alert("The email exist in our records!"); </script>';

		      	}
		      	else{
		      		$sqlInsert="INSERT INTO USER_INFORMATION(FirstName,LastName,Email,Password,Phone,Street,City,State,Zip,Status,UserType,Birthday,Hobbies) values('".$firstname."','".$lastname."','".$myusername."','".$password."','".$phone."','".$street."','".$city."','".$state."','".$zip."','ACTIVE','USER','".$birthday."','".$hobby."')";
					  if (mysqli_query($db, $sqlInsert))
					   {
						    $_SESSION['login_user'] = $myusername;
			      			$sqlGet = "SELECT  * FROM USER_INFORMATION WHERE Email = '$myusername'";
					        $resultGet = mysqli_query($db,$sqlGet);
					        $rowGet = mysqli_fetch_array($resultGet,MYSQLI_ASSOC);

							$_SESSION['UserID'] = $rowGet["UserID"];
							$_SESSION['firstName'] = $rowGet["FirstName"];
				        	echo '<script type="text/javascript">alert("You have successfully signed up!"); </script>';

			  		        header("location: userdashboard.php");
					   }
					   else{
		      	echo '<script type="text/javascript">alert("Sign up failed. Please try again!"); </script>';
		         $error = "Signup failed!";
		      }
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
						<h2>Sign Up</h2>
						
						<form class="form-inline qbstp-header-subscribe" style="background-color: transparent;border:transparent;" method="post">
							<div class="row">
								<div class="col-md-12 col-md-offset-0">
									<div class="form-group" style = "width : 80%">

											<input type="text" class="form-control formInput" name="firstname" id="firstname" placeholder="First Name" style="float:left;" required="true">

											<input type="text" class="form-control formInput" name="lastname" id="lastname" placeholder="Last Name" style="float:right;" required="true">

											<input type="text" class="form-control formInput" name="birthday" id="birthday" placeholder="Birthday" style="float:left;" required="true">
 
											<input type="text" maxlength="10" class="form-control formInput" name="phone" id="phone" placeholder="Phone number" style="float:right;" required="true">

											<input type="text" class="form-control formInput" name="emailId" id="emailId" placeholder="Email" style="float:left;width: 100%;margin-top: 30px;" required="true">
											<br>
											<input type="password" class="form-control formInput" name="password" id="password" placeholder="Enter your password" style="float:left;" required="true">
											<input type="password" class="form-control formInput" name="password2" id="password2" placeholder="Re enter password" style="float:right;" required="true">

											<input type="text" class="form-control formInput" name="street" id="street" placeholder="Street" style="float:left;width: 100%" required="true">

											<input type="text" class="form-control formInput" name="city" id="city" placeholder="City" style="float:left;" required="true">

										<input type="text" class="form-control formInput" name="state" id="state" placeholder="State" style="float:right;" required="true">

										<input type="text" maxlength="5" class="form-control formInput" name="zip" id="zip" placeholder="Zip Code" style="float:left;" required="true">

										

										<div style="width: 100% ; height: auto;float: left;background-color: grey; margin-top: 20px;">
											<input type="text" class="form-control formInput" name="hobby" id="hobby" placeholder="Hobby" style="float:left;margin-left: 5px;" readonly="false">
											<div style="width: 100% ; height: auto;float: left;margin-top: 15px;">
												<label class="hobbyChoice">History</label> <label class="hobbyChoice">Architecture</label><label class="hobbyChoice">Marine</label>
												<label class="hobbyChoice">Sculpture</label> <label class="hobbyChoice">Adventure</label><label class="hobbyChoice">Arts</label><label class="hobbyChoice">Nature</label><label class="hobbyChoice">Sports</label><label class="hobbyChoice">Food</label>
											</div>
										</div>
											<input type="submit" class=" btn btn-primary" value="Submit" id="submit" placeholder="Enter your email" style="width :60%;margin-top: 30px; background-color: #FFDD00";>

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

		$('#submit').on('click',function(){
			validateInputFields();
		});
		function validateInputFields(){

			//alert("P here");

			//checking phone number

			var phoneNumber = $("#phone").val();
			var zipcode = $("#zip").val();
			var email = $("#emailId").val();


			if(isNaN(phoneNumber) || phoneNumber.length != 10){
				alert("Please enter a valid 10 digit phone number");
				event.preventDefault();
				return;
			}

			// reference  : https://www.w3resource.com/javascript/form/email-validation.php

			if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)))
		    {
		    	alert("You have entered an invalid email address!");
		    	event.preventDefault();
		        return;

			}

			if( $("#password").val() != $("#password2").val()){
				alert("The passwords entered do no match !");
				event.preventDefault();
				return;
			}

			if(isNaN(zipcode) || zipcode.length != 5){
				alert("Please enter a valid 5 digit zip code");
				event.preventDefault();
				return;
			}
			// reference https://stackoverflow.com/questions/12090077/javascript-regular-expression-password-validation-having-special-characters
			var password = document.getElementById('password').value,
		        errors = [];
		    if (password.length < 8) {
		        errors.push("Your password must be at least 8 characters"); 
		    }
		    if (password.search(/[a-z]/i) < 0) {
		        errors.push("Your password must contain at least one letter.");
		    }
		    if (password.search(/[0-9]/) < 0) {
		        errors.push("Your password must contain at least one digit."); 
		    }
		    if (errors.length > 0) {
		        alert(errors.join("\n"));
		        event.preventDefault();
		        return;
		    }


   

		}
	</script>

	</body>
</html>

