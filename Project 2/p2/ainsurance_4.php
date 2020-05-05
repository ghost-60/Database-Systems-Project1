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

    <form method="POST" action="" class="text-left">
    <div class="row justify-content-center" style="margin-top: 15px;">
    <table class="table col-md-11 text-center table-striped">
        <thead class="text-white bg-info">
        <tr>
            <th >Driver ID</th>
            <th >License number</th>
            <th>First Name</th>
            <th>Last name</th>
            <th>Date of birth</th>
            <th>Select</th>
        </tr>
        </thead>
    <?php
        $cid = $_SESSION['c_id'];       
        $homes_list_query = "SELECT * FROM drivers WHERE c_id='$cid'";
        $result = $conn->query($homes_list_query);
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $radioButton = "<input type='checkbox' name=d".$row['d_id']." value=".$row['d_id'].">";
                echo "<tr><td>". $row["d_id"] ."</td><td>". $row['license_number'] ."</td><td>". $row["first_name"] ."</td><td>". $row["last_name"] ."</td><td>". $row["birthdate"] ."</td><td>".$radioButton."</td></tr>";
            }
            echo "</table>";
        }
    ?>
    
    </table>
    <input type="submit" class="btn btn-success" value="Delete Selected" name="submitButton2" style="margin-top: 20px;"></input>
    </div>
    </form>
	<hr class="my-4"></hr>

    <h3 style="margin-left:125px; margin-top: 20px; margin-bottom: 40px;"> Add another Driver </h3>
    <form method="POST" action="" class="text-left">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="pdate" style="margin-top:5px;">License number:</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="text" class="form-control" name="pdate" id="pdate" required>
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="pvalue" style="margin-top:5px;">First Name:</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="text" class="form-control" name="pvalue" id="pvalue" required>
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="area" style="margin-top:5px;">Last Name</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="text" class="form-control" name="area" id="area" required>
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="dob" style="margin-top:5px;">Date of Birth</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="date" class="form-control" name="dob" id="dob" required>
                    </div>
                </div>
                
                
                <input type="submit" class="btn btn-success" value="Submit" name="submitButton" style="margin-left:125px; margin-top: 20px;"></input>
            </form>


        </div>
    </div>
    <!-- Ending of navbr header -->
</body>

</html>

<?php
function deleteD() {
    global $conn;
    $cid = $_SESSION['c_id'];      
    $homes_list_query = "SELECT * FROM drivers WHERE c_id='$cid'";
    $result = $conn->query($homes_list_query);
    $res = "1";
    if($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cb = "d".$row['d_id'];
            $did = $row['d_id'];
            if(isset($_POST[$cb])) {
                $vehicle_query = "SELECT * from vehicle_drivers WHERE d_id='$did'";
                $vresult = $conn->query($vehicle_query);
                $deletable = "1";
                while($vrow = $vresult->fetch_assoc()) {
                    $vin = $vrow['v_in'];
                    $vehicle_num = "SELECT * FROM vehicle_drivers WHERE v_in='$vin'";
                    $nquery = $conn->query($vehicle_num);
                    if($nquery-> num_rows <= 1) {
                        $deletable = "0";
                        break;
                    }
                }
                if($deletable == "1") {
                    $query = "DELETE FROM drivers where d_id=".$row['d_id'];
                    $stmt = $conn->prepare($query);
                    $res = $stmt->execute();
                    $query = "DELETE FROM vehicle_drivers where d_id=".$row['d_id'];
                    $stmt = $conn->prepare($query);
                    $res = $stmt->execute();
                }     
            }
        }
        
    }
    return $res;
}


function register($license, $fname, $lname, $dob) {
    global $conn;
    $cid = $_SESSION['c_id'];
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
if(isset($_POST["submitButton2"])){
    echo "Hellow";
$status = deleteD();
if($status == 1) {
echo "
          <script> 
            window.location.replace('ainsurance_4.php');
            alert('Successful');
          </script>
          ";
          } else {
    echo "
          <script> 
            window.location.replace('ainsurance_4.php');
            alert('Failed');
          </script>
          ";
}
}

if(isset($_POST["submitButton"])){
$license = $_POST['pdate'];
$fname = $_POST['pvalue'];
$lname = $_POST['area'];
$dob = $_POST['dob'];

$status = register($license, $fname, $lname, $dob);
if($status == 1) {
    echo "
          <script> 
            window.location.replace('ainsurance_4.php');
            alert('Successful');
          </script>
          ";
} else {
    echo "
          <script> 
            window.location.replace('ainsurance_4.php');
            alert('Failed');
          </script>
          ";
}
}


?>

