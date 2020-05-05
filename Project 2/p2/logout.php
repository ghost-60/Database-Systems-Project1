<?php

session_start();
unset($_SESSION['email']);
unset($_SESSION['c_id']);
session_destroy();
echo "<script>window.location.href = 'front_page.php';</script>";

?>