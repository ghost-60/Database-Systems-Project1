<?php

require_once 'db.php';
require_once 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="style3.css" />
    </head>

<body>
    
	<div class="container-fluid padding">
		<div class="row welcome text-center">
			<div class="col-12">
				<h1 class="display-5">Registered Drivers</h1>
			</div>
		</div>
	</div>
    
    <div class="row justify-content-center" style="margin-top: 15px;">
    <table class="table col-md-11 text-center">
        <tr>
            <th >Driver ID</th>
            <th >License number</th>
            <th>First Name</th>
            <th>Last name</th>
            <th>Date of birth</th>
        </tr>
    <?php
        $email = $_SESSION['email'];
        $query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
        $cid = $result['c_id'];       
        $homes_list_query = "SELECT * FROM drivers WHERE c_id='$cid'";
        $result = $conn->query($homes_list_query);
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>". $row["d_id"] ."</td><td>". $row['license_number'] ."</td><td>". $row["first_name"] ."</td><td>". $row["last_name"] ."</td><td>". $row["birthdate"] ."</td></tr>";
            }
            echo "</table>";
        }
    ?>
    
    </table>
    </div>


    <h3 style="margin-left:125px; margin-top: 20px; margin-bottom: 40px;"> Add another Driver </h3>
    <form method="POST" action="" class="text-left">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="pdate" style="margin-top:5px;">License number:</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="text" class="form-control" name="pdate" id="pdate">
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="pvalue" style="margin-top:5px;">First Name:</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="text" class="form-control" name="pvalue" id="pvalue">
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="area" style="margin-top:5px;">Last Name</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="text" class="form-control" name="area" id="area">
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="dob" style="margin-top:5px;">Date of Birth</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="date" class="form-control" name="dob" id="dob">
                    </div>
                </div>
                
                
                <input type="submit" class="btn btn-primary" value="Submit" name="submitButton" style="margin-left:125px; margin-top: 20px;"></input>
            </form>


        </div>
    </div>
    <!-- Ending of navbr header -->
</body>

</html>

<?php

function register($license, $fname, $lname, $dob) {
    global $conn;
    $email = $_SESSION['email'];
    $query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
	$result = mysqli_fetch_array($query);
    $cid = $result['c_id'];

    $stmt = $conn->prepare("INSERT INTO drivers (license_number, first_name, last_name, birthdate, c_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $license, $fname, $lname, $dob, $cid);
    $res = $stmt->execute();
    //echo "<script>alert('error: ".mysqli_error($conn)."');</script>";
    //echo mysqli_error($conn);
    // echo $conn->insert_id;
    if($res) {
        return 1;
    } else {
        return 0;
    }
}

if(isset($_POST["submitButton"])){
$license = $_POST['pdate'];
$fname = $_POST['pvalue'];
$lname = $_POST['area'];
$dob = $_POST['dob'];

$status = register($license, $fname, $lname, $dob);
if($status == 1) {
    echo "<script>alert('Successfull');</script>";
} else {
    echo "<script>alert('Failed');</script>";
}
}


?>

