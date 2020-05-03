$email = $_SESSION['email'];
			$query = mysqli_query($conn, "SELECT c_id FROM customer WHERE EMAIL='$email'");
        	$result = mysqli_fetch_array($query);
        	$cid = $result['c_id'];
			$query = "SELECT * FROM homes WHERE c_id='$cid'";
			$result = mysqli_query($conn,$query);
			$rows = mysqli_num_rows($result);
			$isInsured = "0";
			while($row = $result->fetch_assoc()) {
				$fiid = $row["h_id"];
				$radioButton = "<input type='radio' name='homeid' value=".$fiid.">";
				if($row['i_id'] == "") {
					echo "<tr><td>". $fiid ."</td><td>". $radioButton ."</td><tr>";
					$isInsured="1";
				}			
			}
			
			if($isInsured == "0") {
				echo "<p style='display:inline; color:red'>" . "You have no homes registered. Please register homes that you want to insure." ."</p>";
			}
			echo "</table>";