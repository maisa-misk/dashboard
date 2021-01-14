<?php
session_start();
unset($_SESSION['id']);
header("location:login_ven.php");
?>