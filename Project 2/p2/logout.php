<?php

session_start();
unset($_SESSION['email']);
session_destroy();
echo "<script>window.location.href = 'front_page.php';</script>";

?>