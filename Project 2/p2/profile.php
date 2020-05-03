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
        } else if($ms = "M") {
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
    

	
	</div>
	</div>
</body>

</html>