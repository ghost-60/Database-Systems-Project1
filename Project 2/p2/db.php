<?php

    $conn = new mysqli("localhost:3308","root", "", "user_db");

    if(!$conn){
        echo "error in connecting to database" . mysqli_error($conn);
    }

?>