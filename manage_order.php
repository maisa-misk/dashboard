<?php
ob_start();
include_once('include/header.php');
require('include/connection.php');
if(isset($_POST['submit'])){
    //get file info
   $total     =  $_POST['tot'];
   $payment    =  $_POST['pay'];
   $qty     =  $_POST['qt'];
   $date     =  $_POST['date'];
   $custid       =  $_POST['select'];
   $prdid       =  $_POST['ssl'];}
?>