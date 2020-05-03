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
				<h1 class="display-5">Registered Homes</h1>
			</div>
		</div>
	</div>
    
    <div class="row justify-content-center" style="margin-top: 15px;">
    <table class="table col-md-11 text-center">
        <tr>
            <th >Home ID</th>
            <th >Insurance ID</th>
            <th>Purchase Date (YYYY-MM-DD)</th>
            <th>Purchase Value ($)</th>
            <th>Home Area (sq meters)</th>
            <th>TYPE</th>
            <th>Auto Fire Notification</th>
            <th>Home Security System</th>
            <th>Swimming Pool</th>
            <th>Basement</th>
        </tr>
    <?php
        $email = $_SESSION['email'];
        $query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        $result = mysqli_fetch_array($query);
        $cid = $result['c_id'];       
        $homes_list_query = "SELECT * FROM homes WHERE c_id='$cid'";
        $result = $conn->query($homes_list_query);
        if($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ftype = $row["type"];
                if($row["type"] == "S") {
                    $ftype = "Single Family";
                } else if($row["type"] == "M") {
                    $ftype = "Multi Family";
                } else if($row["type"] == "C") {
                    $ftype = "Condominium";
                } else {
                    $ftype = "Town House";
                }
                $fpool = $row['swimming_pool'];
                if($row['swimming_pool'] == "U") {
                    $fpool = "Underground";
                } else if($row['swimming_pool'] == "O") {
                    $fpool = "Overground";
                } else if($row['swimming_pool'] == "I") {
                    $fpool = "Indoor";
                } else if($row['swimming_pool'] == "M"){
                    $fpool = "Multiple";
                } else {
                    $fpool = "None";
                }
                $fiid = $row["i_id"];
                if($row["i_id"] == "") {
                    $fiid = "None";
                } else {
                    $fiid = $row["i_id"];
                }
                echo "<tr><td>". $row["h_id"] ."</td><td>". $fiid ."</td><td>". $row["purchase_date"] ."</td><td>". $row["purchase_value"] ."</td><td>". $row["home_area"] ."</td><td>". $ftype ."</td><td>". $row["auto_fire_notification"] ."</td><td>". $row["home_security_system"] ."</td><td>". $fpool ."</td><td>". $row["basement"] ."</td></tr>";
            }
            echo "</table>";
        }
    ?>
    
    </table>
    </div>


    <h3 style="margin-left:125px; margin-top: 20px; margin-bottom: 40px;"> Add another Home </h3>
    <form method="POST" action="" class="text-left">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="pdate" style="margin-top:5px;">Purchase Date:</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="date" class="form-control" name="pdate" id="pdate">
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="pvalue" style="margin-top:5px;">Purchase Value ($):</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="number" class="form-control" name="pvalue" id="pvalue">
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="area" style="margin-top:5px;">Area (in sq. meter)</label>
                    </div>
                    <div class="col-md-3 text-left">
                        <input type="number" step="0.01" class="form-control" name="area" id="area">
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="type" style="margin-top:5px;">Type:</label>
                    </div>
                    <div class="radio col-md-7 text-left">
                        Single Family:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="S">
                        Multi Family:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="M">
                        Condominium:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="C">
                        Town house:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="type" value="T">
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="afn" style="margin-top:5px;">Auto Fire Notification:</label>
                    </div>
                    <div class="radio col-md-7 text-left">
                        Yes:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="afn" value="1">
                        No:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="afn" value="0">
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="hss" style="margin-top:5px;">Home Security System:</label>
                    </div>
                    <div class="radio col-md-7 text-left">
                        Yes:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="hss" value="1">
                        No:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="hss" value="0">
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="pool" style="margin-top:5px;">Swimming Pool:</label>
                    </div>
                    <div class="radio col-md-7 text-left">
                        Underground:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="pool" value="U">
                        Overground:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="pool" value="O">
                        Indoor:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="pool" value="I">
                        Multiple:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="pool" value="M">
                        None:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="pool" value="">
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-1"></div>
                    <div class="col-md-2 text-left">
                        <label for="basement" style="margin-top:5px;">Basement:</label>
                    </div>
                    <div class="radio col-md-7 text-left">
                        Yes:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="basement" value="1">
                        No:<input type="radio" style="margin-left:3px; margin-top:6px; margin-right:10px" name="basement" value="0">
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

function register($pdate, $pvalue, $area, $type, $afn, $hss, $pool, $basement) {
    global $conn;
    $email = $_SESSION['email'];
    $query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
	$result = mysqli_fetch_array($query);
    $cid = $result['c_id'];

    $stmt = $conn->prepare("INSERT INTO homes (purchase_date, purchase_value, home_area, type, auto_fire_notification, home_security_system, swimming_pool, basement, c_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $pdate, $pvalue, $area, $type, $afn, $hss, $pool, $basement, $cid);
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
$pdate = $_POST['pdate'];
$pvalue = $_POST['pvalue'];
$area = $_POST['area'];
$type = $_POST['type'];
$afn = $_POST['afn'];
$hss = $_POST['hss'];
$pool = $_POST['pool'];
$basement = $_POST['basement'];

$status = register($pdate, $pvalue, $area, $type, $afn, $hss, $pool, $basement);
if($status == 1) {
    echo "<script>alert('Successfull');</script>";
} else {
    echo "<script>alert('Failed');</script>";
}
}


?>

