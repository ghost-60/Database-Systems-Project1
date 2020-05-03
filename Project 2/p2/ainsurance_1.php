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
        <thead class="thead-dark">
        <tr>
			<th >Insurance ID</th>
            <th >Insurance Plan</th>
			<th >Status</th>
            <th>Purchase Date (YYYY-MM-DD)</th>
			<th >Valid Till (YYYY-MM-DD)</th>
            <th>Payable amount per Month</th>
        </tr>
        </thead>
    <?php
        $email = $_SESSION['email'];
        $query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
        $cid = $result['c_id'];       
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
                echo "<tr><td>". $row["i_id"] ."</td><td>". $fplan ."</td><td>". $fpool ."</td><td>". $row["start_date"] ."</td><td>". $row["end_date"] ."</td><td>"
				. $row["premium_amount"] ."</td></tr>";
				$counter += 1;
            }
            echo "</table>";
        }
    ?>
    
    </table>
    </div>
	</form>
	

	<?php
	
	
	
	
	?>
	</div>
	</div>
</body>

</html>