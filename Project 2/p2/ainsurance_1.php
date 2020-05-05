<?php

require_once 'db.php';
require_once 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
	<div class="container-fluid padding">
		<div class="row welcome text-center">
			<div class="col-12">
				<h1 class="display-5" style="margin-bottom: 50px">Active insurance</h1>
			</div>
		</div>
	</div>
	<form action="" method="POST">
	<div class="row justify-content-center" style="margin-top: 15px;">
    <table class="table col-md-11 text-center table-striped">
        <thead class="text-white bg-info">
        <tr>
			<th >Insurance ID</th>
            <th >Insurance Plan</th>
			<th >Status</th>
            <th>Purchase Date (YYYY-MM-DD)</th>
			<th >Valid Till (YYYY-MM-DD)</th>
            <th>Payable amount per Month</th>
            <th>Select</th>

        </tr>
        </thead>
    <?php
        $cid = $_SESSION['c_id'];       
        $homes_list_query = "SELECT * FROM insurance WHERE c_id='$cid' and insurance_type='A'";
        $result = $conn->query($homes_list_query);
		$counter = 1;
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $fplan = $row["insurance_plan"]." years";
                $fpool = $row['i_status'];
                if($row['i_status'] == "C") {
                    $fpool = "Active";
                } else {
                    $fpool = "Expired";
                }
                $radioButton = "<input type='checkbox' name=i".$row['i_id']." value=".$row['i_id'].">";
                echo "<tr><td>". $row["i_id"] ."</td><td>". $fplan ."</td><td>". $fpool ."</td><td>". $row["start_date"] ."</td><td>". $row["end_date"] ."</td><td>"
				. $row["premium_amount"] ."</td><td>".$radioButton."</td></tr>";
				$counter += 1;
            }
            echo "</table>";
        }
    ?>
    
    </table>
            <input type="submit" class="btn btn-success" value="Cancel Selected" name="submitButton" style="margin-top: 20px;"></input>

    </div>
	</form>
	

	<?php

    function deleteV() {
        global $conn;
        $cid = $_SESSION['c_id'];       
        $homes_list_query = "SELECT * FROM insurance WHERE c_id='$cid' and insurance_type='A'";
        $result = $conn->query($homes_list_query);
        while($row = $result->fetch_assoc()) {
            $cb = "i".$row['i_id'];
            if(isset($_POST[$cb])) {
                $query = "DELETE FROM insurance where i_id=".$row['i_id'];
                $stmt = $conn->prepare($query);
                $res = $stmt->execute();
                $query = "UPDATE vehicles SET i_id=NULL where i_id=".$row['i_id'];
                $stmt = $conn->prepare($query);
                $res = $stmt->execute();
            }
        }
        return $res;
    }

	if(isset($_POST["submitButton"])){
    $status = deleteV();
    if($status == 1) {
        echo "
            <script> 
                window.location.replace('ainsurance_1.php');
                alert('Successfull');
            </script>
            ";
    } else {
        echo "
            <script> 
                window.location.replace('ainsurance_1.php');
                alert('Failed');
            </script>
            ";
    }
    }
	
	?>
	</div>
	</div>
</body>

</html>