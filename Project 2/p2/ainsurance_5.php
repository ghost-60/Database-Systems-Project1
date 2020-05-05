<?php

require_once 'db.php';
require_once 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
	
	<div class="container-fluid padding">
		<div class="row welcome text-center justify-content-center">
			<div class="col-md-5 mr-3">
				<h1 class="display-7" style="margin-bottom: 50px">Select vehicle</h1>
			</div>
            <div class="col-md-5">
				<h1 class="display-7" style="margin-bottom: 50px">Select driver</h1>
			</div>
		</div>
	</div>
	

<form method="POST" class="text-left">

<div class="row justify-content-center" style="margin-top: 15px;">
	
    <table class="table col-md-5 mr-3 text-center table-striped">
        <thead class="text-white bg-success">
        <tr>
            <th >Vehicle ID</th>
            <th>Vehicle License</th>
            <th >Select</th>
        </tr>
        </thead>
    <?php
        $cid = $_SESSION['c_id'];       
        $homes_list_query = "SELECT * FROM vehicles WHERE c_id='$cid'";
        $result = $conn->query($homes_list_query);
		$isInsured = "0";
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $fiid = $row["v_in"];
				$radioButton = "<input type='radio' name=vin value=".$fiid." required>";
                echo "<tr><td>". $row["v_in"] ."</td><td>". $row['License']. "</td><td>".$radioButton ."</td></tr>";
				$isInsured = "1";
				}
            }
			if($isInsured == "0") {
				echo "<p style='display:inline; color:red'>You have no vehicles registered. Please register vehicles that you want to insure.</p>";
			}
            echo "</table>";
        
    ?>  
    </table>
	 <!-- </div> -->
	<!-- <hr class="my-4"></hr> -->
	
	<!-- <div class="container-fluid padding">
		<div class="row welcome text-center">
			<div class="col-12">
				<h4 class="display-5" style="margin-bottom: 30px">Select Driver</h4>
			</div>
		</div>
	</div> -->
   
		<!-- <div class="row justify-content-center" style="margin-top: 15px;"> -->
			<table class="table col-md-5 text-center table-striped">
                <thead class="text-white bg-success">
				<tr>
                    
					<th >Driver ID</th>
					<th >License</th>
					<th>First Name</th>
                    <th>Last Name</th>
					<th> Select </th>
				</tr>
                </thead>
			<?php
				$cid = $_SESSION['c_id'];       
				$homes_list_query = "SELECT * FROM drivers WHERE c_id='$cid'";
				$result = $conn->query($homes_list_query);
                $isInsured = "0";
				if($result-> num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$fiid = $row["d_id"];
                        $radioButton = "<input type='radio' name=did value=".$fiid." required>";
						echo "<tr><td>". $row["d_id"] ."</td><td>". $row['license_number'] ."</td><td>" . $row["first_name"] ."</td><td>".$row['last_name']."</td><td>".$radioButton. "</td></tr>";	
					}
					echo "</table>";
				}
			?>
			
			</table>
    	</div>
		<div class="row justify-content-center" style="margin-top: 15px;">
		<input type="submit" class="btn btn-success" value="Submit" name="submitButton"></input>
		</div>
	</form>
<hr class="my-4"></hr>
    <div class="container-fluid padding mt-3 md-3">
		<div class="row welcome text-center">
			<div class="col-12">
				<h1 class="display-7">Assigned drivers</h1>
			</div>
		</div>
	</div>
<form method="POST" class="text-left">

<div class="row justify-content-center" style="margin-top: 15px;">
    <table class="table col-md-11 text-center table-striped">
        <thead class="text-white bg-info">
        <tr>
			<th >Vehicle License</th>
            <th >Driver License</th>
            <th>Driver Name</th>
			<th>Select</th>
        </tr>
        </thead>
    <?php
        $cid = $_SESSION['c_id'];       
        $homes_list_query = "SELECT * FROM vehicles v JOIN vehicle_drivers vd ON vd.v_in=v.v_in JOIN drivers d ON d.d_id=vd.d_id WHERE vd.c_id='$cid'";
        $result = $conn->query($homes_list_query);
		$counter = 1;
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $fplan = $row["first_name"]." ". $row['last_name'];
				$name = $row['c_id'].$row['v_in'].$row['d_id'];
                $radioButton = "<input type='checkbox' name=".$name." value=".$name.">";
                echo "<tr><td>". $row["License"] ."</td><td>". $row['license_number'] ."</td><td>". $fplan ."</td><td>".$radioButton."</td></tr>";
				$counter += 1;
            }
            echo "</table>";
        }
    ?>
    
    </table>
	<input type="submit" class="btn btn-success" value="Delete Selected" name="submitButton2" style="margin-top: 20px;"></input>
    </div>
</form>

	<?php
	function deleteD() {
		global $conn;
    $cid = $_SESSION['c_id'];       
    $homes_list_query = "SELECT * FROM vehicle_drivers WHERE c_id='$cid'";
    $result = $conn->query($homes_list_query);
	
    if($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $name = $row['c_id'].$row['v_in'].$row['d_id'];
			$deletable = "1";
            if(isset($_POST[$name])) {
                $vin = $row['v_in'];
				$vehicle_num = "SELECT * FROM vehicle_drivers WHERE v_in='$vin'";
				$nquery = $conn->query($vehicle_num);
				$vehicle_num = mysqli_query($conn,"SELECT * FROM vehicles WHERE v_in='$vin'");
				$vresult = mysqli_fetch_array($vehicle_num);
				if($nquery-> num_rows <= 1) {
					$deletable = "0";
				}
				if($vresult['i_id'] == NULL) {
					$deletable = "1";
				}
                if($deletable == "1") {
                    $query = "DELETE FROM vehicle_drivers where d_id=".$row['d_id']." and v_in=".$vin;
                    $stmt = $conn->prepare($query);
                    $res = $stmt->execute();
                }     
            }
        }
        
    }
	return $res;
	}
	function registerIns($veh, $driv) {
		global $conn;
		$cid = $_SESSION['c_id'];
		$homes_list_query = "SELECT * FROM vehicles WHERE c_id='$cid'";
		$stmt = $conn->prepare("INSERT INTO vehicle_drivers (c_id, v_in, d_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $cid, $veh, $driv);
        $res = $stmt->execute();
        return $res;
	}
	if(isset($_POST["submitButton2"])){
    echo "Hellow";
	$status = deleteD();
	if($status == 1) {
		echo "
          <script> 
            window.location.replace('ainsurance_5.php');
            alert('Successful');
          </script>
          ";
	} else {
		echo "
          <script> 
            window.location.replace('ainsurance_5.php');
            alert('Failed');
          </script>
          ";
	}
	}
	if(isset($_POST["submitButton"]) and isset($_POST["vin"]) and isset($_POST["did"]) ){
		$veh = $_POST['vin'];
        $driv = $_POST['did'];
		$status = registerIns($veh, $driv);
		if($status == 1) {
			echo "
          <script> 
            window.location.replace('ainsurance_5.php');
            alert('Successful');
          </script>
          ";
		} else {
echo "
          <script> 
            window.location.replace('ainsurance_5.php');
            alert('Failed');
          </script>
          ";
		  		}
	}


	?>
	</div>
    </div>
    <!-- Ending of navbr header -->
</body>

</html>