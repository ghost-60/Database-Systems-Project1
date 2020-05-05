<?php

require_once 'db.php';
session_start();
if(isset($_SESSION['email'])){
  echo "
          <script> 
            window.location.replace('customer.php');
          </script>
          ";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Homepage</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link href="style.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><img src="img/logo2.png" width="20%" height="20%"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class = "collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home</a>
				</li>
				<li class="nav-item" id = "Login_button">
					<a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="#">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="modal" data-target="#exampleModal2" href="#">Sign Up</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Services</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#footerand">Contact</a>
				</li>
			</ul>
		</div>
	</div>
</nav>



<div class="<?php echo (isset($alert_class)? $alert_class:'none');?>" style="display: <?php echo (isset($display)? $display:'none'); ?>">
	<?php echo (isset($errorMsg)? $errorMsg:'none'); ?>
</div>




<!--- Image Slider -->
<div id="slides" class="carousel slide" data-ride="carousel">
	
	<ul class="carousel-indicators">
		<li data-target="#slides" data-slide-to="0" class="active"></li>
		<li data-target="#slides" data-slide-to="1"></li>
		<li data-target="#slides" data-slide-to="2"></li>
	</ul>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="img/bg.png">
			<div class="carousel-caption">
				<h1 class="display-2">We Do Secure</h1>
				<h3>Insurance professional right in your neighborhood.</h3>
				<!-- <button type="button" class="btn btn-outline-light btn-lg">View Services</button> -->
				<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal2" >Register Today</button>
			</div>
		</div>
		<div class="carousel-item">
			<img src="img/background2.png">
			<div class="carousel-caption">
				<h1 class="display-2">Reliable</h1>
				<h3 >70 years of treasuring the trust of people</h3>
				<!-- <button type="button" class="btn btn-outline-light btn-lg">View Services</button> -->
				<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal2" >Register Today</button>
			</div>
		</div>
		<div class="carousel-item">
			<img src="img/background3.png">
			<div class="carousel-caption">
							<h1 class="display-2">Access anywhere</h1>

				<h3>Every essential service right at your fingertips</h3>
				<!-- <button type="button" class="btn btn-outline-light btn-lg">View Services</button> -->
				<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal2" >Register Today</button>
			</div>
		</div>
	</div>
</div>

<!--Login Modal-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		
		<div class="modal-body">
				<form method="POST" class="text-center">
					<h2 style="color: #563d7c">Login</h2>				
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="email" style="margin-top:5px;">Email:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="email" class="form-control" name="email" id="email" placeholder="Email">
						</div>
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="password" style="margin-top:5px;">Password:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						</div>
					</div>
					<input type="submit" class="btn btn-primary" value="Login" name="loginButton"></input>
				</form>			
		</div>
	  </div>
	</div>
  </div>

  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		
		<div class="modal-body">
				<form method="POST" action="" class="text-center">
					<h2 style="color: #563d7c">Sign Up</h2>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="fname" style="margin-top:5px;">First Name:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="text" class="form-control" name="fname" id="fname" placeholder="First Name">
						</div>
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="lname" style="margin-top:5px;">Last Name:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name">
						</div>
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="email" style="margin-top:5px;">Email:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="email" class="form-control" name="email" id="email" placeholder="Email">
						</div>
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="password" style="margin-top:5px;">Password:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="cpassword" style="margin-top:0px;">Confirm Password:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="street" style="margin-top:5px;">Street:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="text" class="form-control" name="street" id="street" placeholder="Street">
						</div>
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="state" style="margin-top:5px;">State:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="text" class="form-control" name="state" id="state" placeholder="State">
						</div>
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="zip" style="margin-top:5px;">Zip:</label>
						</div>
						<div class="col-md-8 text-left">
							<input type="text" class="form-control" name="zip" id="zip" placeholder="Zip">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="gender" style="margin-top:0px;">Gender:</label>
						</div>
						<div class="radio col-md-6 text-left">
							Male:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="gender" value="M">
							Female:<input type="radio" style="margin-left:3px; margin-top:6px;" name="gender" value="F">
						</div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3 text-right">
							<label for="ms" style="margin-top:0px;">Marital Status:</label>
						</div>
						<div class="radio col-md-6 text-left">
							Single:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="ms" value="S">
							Married:<input type="radio" style="margin-left:3px; margin-top:6px;" name="ms" value="M">
							Widow/Widower:<input type="radio" style="margin-left:3px; margin-top:6px;" name="ms" value="W">
						</div>
					</div>
					<input type="submit" class="btn btn-primary" value="Register" name="registerButton"></input>
				</form>
							
		</div>
	  </div>
	</div>
  </div>


<!--- Welcome Section -->
<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">To keep you secure</h1>
		</div>
		<hr>
		<div class="col-12">
			<p class="lead">
				asdasdasdasass sasdasaas asasass asassas sasaasas assaas asassa sasasa
			</p>
		</div>
	</div>
</div>

<!--- Three Column Section -->

<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<i class="fas fa-code"></i>
			<h3>Home Insurance</h3>
			<p>Secure your home today</p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<i class="fas fa-bold"></i>
			<h3>Auto Insurance</h3>
			<p>Secure your car today</p>
		</div>
		<!-- <div class="col-sm-12 col-md-4">
			<i class="fas fa-bold"></i>
			<h3>Combo Pack</h3>
			<p>Secure your both today</p>
		</div> -->
	</div>
	<hr class="my-4">
</div>
<!--- Two Column Section -->

<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-md-12 col-lg-6">
			<h2>Benefits</h2>
			<p>
				sadasdsadsa
			</p>
			<p>
				sadsasadsa
			</p>
			<p>
				saassaadsas
			</p>
			<br>
			<a href="#" class="btn btn-primary">Learn More</a>
		</div>
		<div class="col-lg-6">
			<img src="img/desk.png" class="img-fluid">
		</div>
	</div>
</div>
<hr class="my-4">
<!--- Fixed background -->
<!-- <figure>
	<div class="fixed-wrap">
		<div id="fixed">

		</div>
	</div>
</figure> -->

<!--- Emoji Section -->

  
<!--- Meet the team -->
<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Meet the Team</h1>
		</div>
	</div>
</div>

<!--- Cards -->

<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-md-6">
			<div class="card">
				<img class="card-img-top" src="img/team1.png">
				<div class="card-body">
					<h4 class="card-title">Kumar Ayush</h4>
					<p class="card-text">blah blal blah</p>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<img class="card-img-top" src="img/team2.png">
				<div class="card-body">
					<h4 class="card-title">VS</h4>
					<p class="card-text">blah blal blah</p>
				</div>
			</div>
		</div>
	</div>
</div>

<hr class="my-4">

<!--- Connect -->
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-12">
			<h2>Connect</h2>
		</div>
		<div class="col-12 social padding">
			<a href="#"><i class="fab fa-facebook"></i></a>
			<a href="#"><i class="fab fa-twitter"></i></a>
			<a href="#"><i class="fab fa-instagram"></i></a>
			<a href="#"><i class="fab fa-youtube"></i></a>
		</div>
	</div>
</div>

<!--- Footer -->
<footer>
	<div class="container-fluid padding" id="footerand">
		<div class="row text-center">
			<div class="col-md-6">
				<img src="img/logo.png" width="20%" height="20%">
				<hr class="light">
				<p>999-999-9999</p>
				<p>email@email.blah.blah</p>
				<p>22 Baker street</p>
				<p>NY, United States, 666666</p>
			</div>
			<div class="col-md-6">
				<hr class="light">
				<h5>Working hours</h5>
				<hr class="light">
				<p>Monday- 69am - 69pm</p>
				<p>Monday- 69am - 69pm</p>
				<p>Monday- 69am - 69pm</p>
			</div>
			<div class="col-md-12">
				<hr class="light-100">
				<h5>&copy; wedosecure.com</h5>
			</div>
		</div>
	</div>
</footer>



</body>
</html>



<?php 


	function register($fname, $lname, $email, $password, $cpassword, $street, $state, $zip, $gender, $MS){
		global $conn;		
		if($password != $cpassword) {
			return 1;
		}
		$password = md5($password); 	//encrypting.
		$query = "SELECT * FROM customer WHERE EMAIL='$email'";
		$result = mysqli_query($conn,$query);
		$rows = mysqli_num_rows($result);
		if($rows > 0){
			return 2;
		}
		else{
			$stmt = $conn->prepare("INSERT INTO customer (Email, Passwrd, first_name, last_name, street, state, zip, gender, marital_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssssss", $email, $password, $fname, $lname, $street, $state, $zip, $gender, $MS);		
			$res = $stmt->execute();
			if($res){
				return 3;
			}
			else{
				return 4;
			}
		}
	}

	function login($email, $password) {
		global $conn;
		$password = md5($password); 	//encrypting
		$query = "SELECT * FROM customer WHERE EMAIL='$email'";
		$result = mysqli_query($conn,$query);
		$rows = mysqli_num_rows($result);
		if($rows > 0){
			return 1;
		} else {
			return 0;
		}
	}

	if(isset($_POST["loginButton"])){

		// echo "<script>alert('Hello');</script>";

        $email = $_POST['email'];
        $password = $_POST['password'];
        $status = login($email,$password);
		
        if($status == 0){
            // $display = "inline;";
            // $errorMsg = "Invalid Credentials. <br> Please Login Again!";
            // $alert_class = "alert alert-danger";
			echo "<script>alert('Invalid credentials');</script>";
        }
        else{
		$query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
		  $_SESSION['c_id'] = $result['c_id'];
		  $_SESSION['email'] = $email;
          echo "
          <script> 
            window.location.replace('customer.php');
          </script>
          ";
        }
		$conn->close();
    }


	if(isset($_POST["registerButton"])){
		// echo "<script>alert('Hello');</script>";
		$fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
		$cpassword = $_POST['cpassword'];       
		$street = $_POST['street'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$gender = $_POST['gender'];
		$MS = $_POST['ms'];
		
        $status = register($fname, $lname, $email, $password, $cpassword, $street, $state, $zip, $gender, $MS);
        if($status == 1){
            $display = "inline;";
            $errorMsg = "Passwords do not match";
            $alert_class = "alert alert-danger";
			echo "<script>alert('pass dnm');</script>";
        }
        else if($status == 2){
            $display = "inline;";
            $errorMsg = "Error! <br> Email already registered <br> Try with different Email";
            $alert_class = "alert alert-danger";
			echo "<script>alert('email eerr');</script>";
        }
		else if(status == 3){ 
          $display = "inline;";
          $errorMsg = "Fail to register! <br> Try again later";
          $alert_class = "alert alert-success";
		  echo "<script>alert('fail');</script>";
        }
        else { 
        //   $display = "inline;";
        //   $errorMsg = "Successfully registered! <br> Log in using your Credentials!";
        //   $alert_class = "alert alert-success";
        //   echo "<script>alert('success');</script>";
		$query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
		$_SESSION['c_id'] = $result['c_id'];
		$_SESSION['email'] = $email;
          echo "
          <script> 
            window.location.replace('customer.php');
          </script>
          ";
        }
		$conn->close();
    }

?>

<!--- Check out my courses! -->
<!-- <div class="udemy-course" style="position: fixed; bottom: 0; right: 0; margin-bottom: -5px; z-index: 100;">
	<a href="https://w3newbie.com/courses" target="_blank" style="z-index: 999!important; cursor: pointer!important;"><img src="https://www.w3newbie.com/wp-content/uploads/nuno-course-banner.png" style="max-width: 100%; min-width: 100%;"></a>
 </div> -->