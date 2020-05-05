<?php

require_once 'db.php';
require_once 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
	<div class="container-fluid padding">
		<div class="row welcome text-center">
			<div class="col-12">
				<h1 class="display-5" style="margin-bottom: 50px">Payments</h1>
			</div>
		</div>
	</div>

    <?php
        global $conn;
        $cid = $_SESSION['c_id'];
        $insurance_query = "SELECT * FROM insurance WHERE c_id='$cid'";
        $result = $conn->query($insurance_query);
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $prev_date = new DateTime(date("Y-m-d", strtotime($row['last_invoice'])));
                $cur_date = new DateTime(date("Y-m-d"));
                $start    = $prev_date->modify('first day of this month');
                $end      = $cur_date->modify('first day of next month');
                $interval = DateInterval::createFromDateString('1 month');
                $period   = new DatePeriod($start, $interval, $end);
                
                foreach ($period as $dt) {
                    $p_due = $dt->format("Y-m-d");
                    $stat = "0";
                    $stmt = $conn->prepare("INSERT INTO invoice (payment_due, amount, i_id, c_id) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $p_due, $row['premium_amount'], $row['i_id'], $cid);
                    $res = $stmt->execute();
                    //echo mysqli_error($conn);
                }
                $linv = date("Y-m-d", strtotime("+1 month", strtotime(date("Y-m-d"))));
                $query = "UPDATE insurance SET last_invoice='".$linv."' WHERE i_id=".$row['i_id'];
                $stmt = $conn->prepare($query);
				$res = $stmt->execute();
            }
        }
    ?>


	<form action="" method="POST">
	<div class="row justify-content-center" style="margin-top: 15px;">
    <table class="table col-md-11 text-center table-striped">
        <thead class="text-white bg-success">
        <tr>
			<th>Invoice ID</th>
            <th>Insurance ID</th>
			<th>Amount Due</th>
            <th>Due date</th>
			<th >Status</th>
			<th> Select </th>
        </tr>
        </thead>
    <?php
        $cid = $_SESSION['c_id'];       
        $invoice_query = "SELECT * FROM invoice WHERE c_id='$cid'";
        $result = $conn->query($invoice_query);
		$counter = 1;
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $fstaus = $row["status"];
                $radioButton = "<input type='checkbox' name=c".$row['inv_id']." value=".$row['inv_id'].">";
                $duedate = date("Y-m-t", strtotime($row['payment_due']));
                if($row['status'] == "0") {
                    $fstatus = "Due";
                    if(date("Y-m-d") > $duedate) {
                        $fstatus = "Ovedue";
                    }
                } else {
                    $fstatus = "Paid";
                    $radioButton = "<input type='checkbox' name=c".$row['inv_id']." value=".$row['inv_id']." disabled>";
                }
                
                echo "<tr><td>". $row["inv_id"] ."</td><td>". $row['i_id'] ."</td><td>". $row['amount'] ."</td><td>". $duedate ."</td><td>". $fstatus ."</td><td>"
				. $radioButton."</td></tr>";
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
				<h4 class="display-5" style="margin-bottom: 30px">Select payment method</h4>
			</div>
		</div>
	</div>

    <div class="row justify-content-center" style="margin-top: 15px;">
			<label for="type" style="margin-top:5px;"></label>
			<table class="table col-md-6 text-center">
       		 <tr>
            <th>Paypal<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="1"></th>
            <th>Debit Card <input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="2"></th>
            <th>Credit Card <input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="3"></th>
            <th>Check<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="4"></th>
        	</tr>
			</table>
			
	</div>


    <div class="row justify-content-center" style="margin-top: 15px;">
		<input type="submit" class="btn btn-success" value="Pay selected" name="submitButton2"></input>
	</div>
	</form>
	

	
	</div>
	</div>
</body>

</html>