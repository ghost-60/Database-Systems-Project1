
	<form action="" method="POST">
	<div class="row justify-content-center" style="margin-top: 15px;">
    <table class="table col-md-11 text-center">
        <tr>
			<th>Invoice ID</th>
            <th>Insurance ID</th>
			<th>Amount Due</th>
            <th>Due date</th>
			<th >Status</th>
			<th> Select </th>
        </tr>
    <?php
        $email = $_SESSION['email'];
        $query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
        $cid = $result['c_id'];       
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
		<input type="submit" class="btn btn-primary" value="Pay selected" name="submitButton2"></input>
	</div>
	</form>
	