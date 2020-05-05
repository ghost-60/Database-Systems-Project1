<?php

require_once 'db.php';
require_once 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
	<div class="container-fluid padding">
		<div class="row welcome text-center">
			<div class="col-12">
				<h1 class="display-5" style="margin-bottom: 50px">Profile</h1>
			</div>
		</div>
	</div>

    

	
	
    <?php
        $email = $_SESSION['email'];
        $query = mysqli_query($conn, "SELECT * FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
        $cid = $result['c_id'];
        $gender = $result['gender'];
        if($gender == "M") {
            $gender = "Male";
        } else {
            $gender = "Female";
        }
        $ms = $result['marital_status'];
        if($ms == "S") {
            $ms = "Single";
        } else if($ms == "M") {
            $ms = "Married";
        } else if($gender == "M") {
            $ms = "Widower";
        } else {
            $ms = "Widow";
        }    
        echo"
        <div class='container-fluid padding'>
	    <div class='row padding  justify-content-center'>   
            <div class='col-md-2 text-left'>
                <div class='card '>
                    <div class='card-header text-white bg-info'>
                        Name
                    </div>
                    <div class='card-body'>".
                        $result['first_name']." ". $result['last_name'].
                    "</div>
                </div>
            </div>  
       
            <div class='col-md-2 text-left'>
                <div class='card '>
                    <div class='card-header text-white bg-success'>
                        Email
                    </div>
                    <div class='card-body'>".
                        $result['Email'].
                    "</div>
                </div>
            </div>
 
            <div class='col-md-2 text-left'>
                <div class='card '>
                    <div class='card-header text-white bg-danger'>
                        Address
                    </div>
                    <div class='card-body'>".
                        $result['street'].", ".$result['state'].", ".$result['zip'].
                    "</div>
                </div>
            </div>
            <div class='col-md-2 text-left'>
                <div class='card '>
                    <div class='card-header text-white bg-warning'>
                        Gender
                    </div>
                    <div class='card-body'>".
                        $gender.
                    "</div>
                </div>
            </div>

            <div class='col-md-2 text-left'>
                <div class='card'>
                    <div class='card-header  text-white bg-dark'>
                        Marital Status
                    </div>
                    <div class='card-body'>".
                        $ms.
                    "</div>
                </div>
            </div>
        </div></div>";
    ?>
    <div class="mt-3" style="margin-left:155px">
    <button class='btn btn-success' type='button' data-toggle='collapse' data-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample'>
    Edit
    </button>
	</div>
    <div class='collapse' id='collapseExample'>
        <div class='card card-body'>
            <?php
                $email = $_SESSION['email'];
                $query = mysqli_query($conn, "SELECT * FROM customer WHERE EMAIL='$email'");
                $result = mysqli_fetch_array($query);
                $gender = $result['gender'];
                if($gender == "M") {
                $gender = "Male:<input type='radio' style='margin-left:3px; margin-top:6px; margin-right:10px' name='gender' value='M' checked>
							Female:<input type='radio' style='margin-left:3px; margin-top:6px;' name='gender' value='F'>";
                } else {
                    $gender = "Male:<input type='radio' style='margin-left:3px; margin-top:6px; margin-right:10px' name='gender' value='M'>
							Female:<input type='radio' style='margin-left:3px; margin-top:6px;' name='gender' value='F' checked>";
                }
                $ms = $result['marital_status'];
                if($ms == "S") {
                    $ms = "Single:<input type='radio' style='margin-left:3px; margin-top:6px; margin-right:10px' name='ms' value='S' checked>
							Married:<input type='radio' style='margin-left:3px; margin-top:6px;' name='ms' value='M'>
							Widow/Widower:<input type='radio' style='margin-left:3px; margin-top:6px;' name='ms' value='W'>";
                } else if($ms == "M") {
                    $ms = "Single:<input type='radio' style='margin-left:3px; margin-top:6px; margin-right:10px' name='ms' value='S'>
							Married:<input type='radio' style='margin-left:3px; margin-top:6px;' name='ms' value='M' checked>
							Widow/Widower:<input type='radio' style='margin-left:3px; margin-top:6px;' name='ms' value='W'>";
                }  else {
                    $ms = "Single:<input type='radio' style='margin-left:3px; margin-top:6px; margin-right:10px' name='ms' value='S'>
							Married:<input type='radio' style='margin-left:3px; margin-top:6px;' name='ms' value='M'>
							Widow/Widower:<input type='radio' style='margin-left:3px; margin-top:6px;' name='ms' value='W' checked>";
                } 
                echo "<form method='POST' action='' class='text-center'>
					
					<div class='row'>
						<div class='col-md-1'></div>
						<div class='col-md-1'>
							<label for='fname' style='margin-top:5px;'>First Name:</label>
						</div>
						<div class='col-md-2 text-left'>
							<input type='text' class='form-control' name='fname' id='fname' placeholder='First Name' value=".$result['first_name'].">
						</div>
					</div>

					<div class='row'>
						<div class='col-md-1'></div>
						<div class='col-md-1 text-right'>
							<label for='lname' style='margin-top:5px;'>Last Name:</label>
						</div>
						<div class='col-md-2 text-left'>
							<input type='text' class='form-control' name='lname' id='lname' placeholder='Last Name' value=".$result['last_name'].">
						</div>
					</div>

					<div class='row'>
						<div class='col-md-1'></div>
						<div class='col-md-1 text-right'>
							<label for='email' style='margin-top:5px;'>Email:</label>
						</div>
						<div class='col-md-2 text-left'>
							<input type='email' class='form-control' name='email' id='email' placeholder='Email' value=".$result['Email']." disabled>
						</div>
					</div>

					
					<div class='row'>
						<div class='col-md-1'></div>
						<div class='col-md-1 text-right'>
							<label for='street' style='margin-top:5px;'>Street:</label>
						</div>
						<div class='col-md-2 text-left'>
							<input type='text' class='form-control' name='street' id='street' placeholder='Street' value=".$result['street'].">
						</div>
					</div>

					<div class='row'>
						<div class='col-md-1'></div>
						<div class='col-md-1 text-right'>
							<label for='state' style='margin-top:5px;'>State:</label>
						</div>
						<div class='col-md-2 text-left'>
							<input type='text' class='form-control' name='state' id='state' placeholder='State' value=".$result['state'].">
						</div>
					</div>

					<div class='row'>
						<div class='col-md-1'></div>
						<div class='col-md-1 text-right'>
							<label for='zip' style='margin-top:5px;'>Zip:</label>
						</div>
						<div class='col-md-2 text-left'>
							<input type='text' class='form-control' name='zip' id='zip' placeholder='Zip' value=".$result['zip'].">
						</div>
					</div>
					<div class='row'>
						<div class='col-md-1'></div>
						<div class='col-md-1 text-right'>
							<label for='gender' style='margin-top:0px;'>Gender:</label>
						</div>
						<div class='radio col-md-6 text-left'>
							".$gender."
						</div>
					</div>
					<div class='row'>
						<div class='col-md-1'></div>
						<div class='col-md-1 text-right'>
							<label for='ms' style='margin-top:0px;'>Marital Status:</label>
						</div>
						<div class='radio col-md-6 text-left'>
							".$ms."
						</div>
					</div>
					<input type='submit' class='btn btn-success' value='Submit' name='registerButton'></input>
				</form>"
            ?>
        </div>
    </div>  
    <?php

    function register($fname, $lname, $street, $state, $zip, $gender, $MS) {
        global $conn;
        $email = $_SESSION['email'];
		$query = "SELECT * FROM customer WHERE EMAIL='$email'";
		$result = mysqli_query($conn,$query);
		$stmt = $conn->prepare("UPDATE customer SET first_name=?, last_name=?, street=?, state=?, zip=?, gender=?, marital_status=? WHERE Email=?");
		$stmt->bind_param("ssssssss", $fname, $lname, $street, $state, $zip, $gender, $MS, $email);
        $res=$stmt->execute();		
		return $res;
    }

    if(isset($_POST["registerButton"])){
		// echo "<script>alert('Hello');</script>";
		$fname = $_POST['fname'];
        $lname = $_POST['lname'];    
		$street = $_POST['street'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$gender = $_POST['gender'];
		$MS = $_POST['ms'];
		
        $status = register($fname, $lname, $street, $state, $zip, $gender, $MS);
        if($status) {
            echo "
          <script> 
            window.location.replace('profile.php');
            alert('Successfull');
          </script>
          ";
        } else {

        }      
    }
    ?>

	</div>
	</div>
</body>

</html>