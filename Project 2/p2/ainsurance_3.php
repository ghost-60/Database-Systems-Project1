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
				<h1 class="display-5">Registered Vehicles</h1>
			</div>
		</div>
	</div>
    <form method="POST" action="" class="text-left">
    <div class="row justify-content-center" style="margin-top: 15px;">
    <table class="table col-md-11 text-center table-striped">
        <thead class="text-white bg-info">
        <tr>
            <th>Vehicle ID</th>
            <th>Insurance ID</th>
            <th>License Number</th>
            <th>Manufactured Date (YYYY-MM-DD)</th>
            <th>Status</th>
            <th>Select</th>
        </tr>
        </thead>
    <?php
        $cid = $_SESSION['c_id'];       
        $homes_list_query = "SELECT * FROM vehicles WHERE c_id='$cid'";
        $result = $conn->query($homes_list_query);
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ftype = $row["v_status"];
                if($row["v_status"] == "L") {
                    $ftype = "Leased";
                } else if($row["v_status"] == "F") {
                    $ftype = "Financed";
                } else {
                    $ftype = "Owned";
                }
                $fiid = $row['i_id'];
                if($fiid == "") {
                    $fiid = "None";
                }
                $fstatus = $row['v_status'];
                if($fstatus == "L") {
                    $fstatus = "Leased";
                } else if($fstatus == "F") {
                    $fstatus = "Financed";
                } else {
                    $fstatus = "Owned";
                }
                $radioButton = "<input type='checkbox' name=v".$row['v_in']." value=".$row['v_in'].">";
                if($row['i_id'] != NULL) {
                    $radioButton = "<input type='checkbox' name=v".$row['v_in']." value=".$row['v_in']." disabled>";
                }
                echo "<tr><td>". $row["v_in"] ."</td><td>". $fiid ."</td><td>". $row["License"] ."</td><td>". $row["make_model_year"] ."</td><td>". $fstatus ."</td><td>".$radioButton."</td></tr>";
            }
            echo "</table>";
        }
    ?>
    
    </table>
    <input type="submit" class="btn btn-success" value="Delete Selected" name="submitButton2" style="margin-top: 20px;"></input>
    </div>
    </form>
    <hr class="my-4"></hr>
    <h3 style="margin-left:125px; margin-top: 20px; margin-bottom: 40px;"> Add another vehicle </h3>
    <form method="POST" action="" class="text-left">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="pdate" style="margin-top:5px;">Make Model Year</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="date" class="form-control" name="pdate" id="pdate" required>
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="pvalue" style="margin-top:5px;">License number:</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="text" class="form-control" name="pvalue" id="pvalue" required>
                    </div>
                </div>

                
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="type" style="margin-top:5px;">Type:</label>
                    </div>
                    <div class="radio col-md-7 text-left">
                        Leased:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="L" required>
                        Financed:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="F">
                        Owned:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="O">
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

function register($mmy, $license, $vtype) {
    global $conn;
    $cid = $_SESSION['c_id'];
    $stmt = $conn->prepare("INSERT INTO vehicles (make_model_year, License, v_status, c_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $mmy, $license, $vtype, $cid);
    $res = $stmt->execute();
    if($res) {
        return 1;
    } else {
        return 0;
    }
}

function deleteV() {
    global $conn;
    $cid = $_SESSION['c_id'];      
    $homes_list_query = "SELECT * FROM vehicles WHERE c_id='$cid'";
    $result = $conn->query($homes_list_query);
    if($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cb = "v".$row['v_in'];
            if(isset($_POST[$cb])) {
                $query = "DELETE FROM vehicles where v_in=".$row['v_in'];
                $stmt = $conn->prepare($query);
				$res = $stmt->execute();
                $query = "DELETE FROM vehicle_drivers where v_in=".$row['v_in'];
                $stmt = $conn->prepare($query);
				$res = $stmt->execute();
            }
        }
        return $res;
    }

}
if(isset($_POST["submitButton2"])){
$status = deleteV();
if($status == 1) {
    echo "
          <script> 
            window.location.replace('ainsurance_3.php');
            alert('Successfull');
          </script>
          ";
} else {
    echo "
          <script> 
            window.location.replace('ainsurance_3.php');
            alert('Failed');
          </script>
          ";
}
}
if(isset($_POST["submitButton"])){
$mmy = $_POST['pdate'];
$license = $_POST['pvalue'];
$vtype = $_POST['type'];

$status = register($mmy, $license, $vtype);
if($status == 1) {
    echo "
          <script> 
            window.location.replace('ainsurance_3.php');
            alert('Successfull');
          </script>
          ";
} else {
    echo "
          <script> 
            window.location.replace('ainsurance_3.php');
            alert('Failed');
          </script>
          ";
}
}


?>

