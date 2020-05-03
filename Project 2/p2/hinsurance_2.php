<?php

require_once 'db.php';
require_once 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
	
	<div class="container-fluid padding">
		<div class="row welcome text-center">
			<div class="col-12">
				<h1 class="display-5" style="margin-bottom: 50px">Select homes to insure</h1>
			</div>
		</div>
	</div>
	
	<p style="display:inline; color:#be311b; margin-left: 20px;">
		ALERT:
	</p>

<form method="POST" class="text-left">

<div class="row justify-content-center" style="margin-top: 15px;">
	
    <table class="table col-md-3 text-center">
        <tr>
            <th >Home ID</th>
            <th ><label for="homeid">Select</label></th>
        </tr>
    <?php
        $email = $_SESSION['email'];
        $query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
        $cid = $result['c_id'];       
        $homes_list_query = "SELECT * FROM homes WHERE c_id='$cid'";
        $result = $conn->query($homes_list_query);
		$isInsured = "0";
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $fiid = $row["h_id"];
				$radioButton = "<input type='checkbox' name=h".$fiid." value=".$fiid.">";
				if($row['i_id'] == "") {
                	echo "<tr><td>". $row["h_id"] ."</td><td>". $radioButton ."</td></tr>";
					$isInsured = "1";
				}
            }
			if($isInsured == "0") {
				echo "<p style='display:inline; color:red'>" . "You have no homes registered. Please register homes that you want to insure." ."</p>";
			}
            echo "</table>";
        }
    ?>  
    </table>
	 </div>
	<hr class="my-4"></hr>
	
	<div class="container-fluid padding">
		<div class="row welcome text-center">
			<div class="col-12">
				<h4 class="display-5" style="margin-bottom: 30px">Buy a new insurance</h4>
			</div>
		</div>
	</div>
   
<!-- </form>
	<h3 style="margin-left:20px; margin-top: 20px; margin-bottom: 20px;"> Insurance plan </h3>
    <form method="POST" action="" class="text-left"> -->
		<div class="row justify-content-center" style="margin-top: 15px;">
			<label for="type" style="margin-top:5px;"></label>
			<table class="table col-md-6 text-center">
       		 <tr>
            <th><font color="#e66500">Bronze</font>: 1 Year<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="1"></th>
            <th><font color="#8b8b8b">Silver</font>: 2 Years<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="2"></th>
            <th><font color="#f6af04">Gold</font>: 5 Years<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="5"></th>
            <th><font color="#00dbc4">Platinum</font>: 10 Years<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="10"></th>
        	</tr>
			</table>
			
		</div>
		<div class="row justify-content-center" style="margin-top: 15px;">
		<input type="submit" class="btn btn-primary" value="Submit" name="submitButton"></input>
		</div>
		
		<hr class="my-4"></hr>
		<div class="container-fluid padding">
		<div class="row welcome text-center">
			<div class="col-12">
				<h4 class="display-5" style="margin-bottom: 30px">Add to an existing insurance</h4>
			</div>
		</div>
		</div>

		<div class="row justify-content-center" style="margin-top: 15px;">
			<table class="table col-md-11 text-center">
				<tr>
					<th >Insurance ID</th>
					<th >Insurance Plan</th>
					<th>Payable amount per Month</th>
					<th> Select </th>
				</tr>
			<?php
				$email = $_SESSION['email'];
				$query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
				$result = mysqli_fetch_array($query);
				$cid = $result['c_id'];       
				$homes_list_query = "SELECT * FROM insurance WHERE c_id='$cid' and insurance_type='H'";
				$result = $conn->query($homes_list_query);
				if($result-> num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$fplan = $row["insurance_plan"]." years";
						$fiid = $row["i_id"];
						$radioButton = "<input type='radio' name='iplan' value=".$fiid.">";
						echo "<tr><td>". $row["i_id"] ."</td><td>". $fplan ."</td><td>" . $row["premium_amount"] ."</td><td>".$radioButton. "</td></tr>";	
					}
					echo "</table>";
				}
			?>
			
			</table>
    	</div>
		<div class="row justify-content-center" style="margin-top: 15px;">
		<input type="submit" class="btn btn-primary" value="Submit" name="submitButton2"></input>
		</div>
	</form>




	<?php
	
	function registerIns($plan) {
		global $conn;
		$email = $_SESSION['email'];
        $query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
        $cid = $result['c_id'];
		$homes_list_query = "SELECT * FROM homes WHERE c_id='$cid'";
        $result = $conn->query($homes_list_query);
		$insurance_type = "H";
		$start_date = date("Y-m-d");
		$end_date = date('Y-m-d', strtotime('+'.$plan.' years'));
		$p_amount = "1000";
		if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
				if($row['i_id'] == "" and isset($_POST["h".$row['h_id']])) {
                	$p_amount += $row['purchase_value'] / $plan;
				}
            }
        }
		$result = $conn->query($homes_list_query);
		$istatus = "C";
		$stmt = $conn->prepare("INSERT INTO insurance (c_id, insurance_type, insurance_plan, start_date, end_date, premium_amount, i_status, last_invoice) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssss", $cid, $insurance_type, $plan, $start_date, $end_date, $p_amount, $istatus, $start_date);
    	$res = $stmt->execute();
		$i_id = $conn->insert_id;
		if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
				if($row['i_id'] == "" and isset($_POST["h".$row['h_id']])) {
					$query = "UPDATE homes SET i_id=".$i_id." WHERE h_id=".$row['h_id'];
                	$stmt = $conn->prepare($query);
					$res = $stmt->execute();
				}
            }
        }
		return $res;
	}

	function updateIns($plan) {
		global $conn;
		$email = $_SESSION['email'];
		$query = mysqli_query($conn, "SELECT * FROM insurance WHERE i_id='$plan' and insurance_type='H'");
        $result = mysqli_fetch_array($query);
		$in_plan = $result['insurance_plan'];
		$add_amount = $result['premium_amount'];
        $query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
        $cid = $result['c_id'];
		$homes_list_query = "SELECT * FROM homes WHERE c_id='$cid'";
        $result = $conn->query($homes_list_query);
		
		if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
				if($row['i_id'] == "" and isset($_POST["h".$row['h_id']])) {
					$query = "UPDATE homes SET i_id=".$plan." WHERE h_id=".$row['h_id'];
                	$stmt = $conn->prepare($query);
					$res = $stmt->execute();
					$add_amount += $row['purchase_value'] / $in_plan;
				}
            }
			$query = "UPDATE insurance SET premium_amount=".$add_amount." WHERE i_id=".$plan;
			$stmt = $conn->prepare($query);
			$res = $stmt->execute();
        }
		return $res;
	}
	if(isset($_POST["submitButton"]) and isset($_POST["type"])){
		$plan = $_POST['type'];
		$status = registerIns($plan);
		if($status == 1) {
			echo "<script>alert('Successfull');</script>";
		} else {
			echo "<script>alert('Failed');</script>";
		}
	}

	if(isset($_POST["submitButton2"]) and isset($_POST["iplan"])){
		$plan = $_POST['iplan'];
		$status = updateIns($plan);
		if($status == 1) {
			echo "<script>alert('Successfull');</script>";
		} else {
			echo "<script>alert('Failed');</script>";
		}
	}

	?>
	</div>
    </div>
    <!-- Ending of navbr header -->
</body>

</html>