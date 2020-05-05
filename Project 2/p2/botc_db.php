<?php

    $conn = new mysqli("localhost:3308","root", "", "botc");

    if(!$conn){
        echo "error in connecting to database" . mysqli_error($conn);
    }

?>