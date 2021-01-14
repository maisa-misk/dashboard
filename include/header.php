  <?php
require('include/connection.php');
session_start();
if (!isset($_SESSION['id'])) {
  header("location: login_admin.php");
  $user = "";
}
else {
  $user = $_SESSION['id'];
 $query= "SELECT * FROM admin ";
$result = mysqli_query($conn,$query);
   
    while($admin = mysqli_fetch_assoc($result)){
      $user = $admin['admin_id'];
    }

}
?>

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.php" class="logo"><b>DASH<span>IO</span></b></a>
      <!--logo end-->

      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="login_admin.php">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <?php
          if($user!=""){
            $query = "SELECT * FROM admin WHERE admin_id = {$_SESSION['id']}";
                  $result = mysqli_query($conn,$query);
                while($admin = mysqli_fetch_assoc($result)){
          
                  
                
         echo  "<p class='centered'><a href='profile.html'><img src='img/{$admin['admin_img']}' class='img-circle' width='80'></a></p>
                   <h5 class='centered'>
                   ";
                   echo $admin['admin_name'];}
                  echo " </h5>";}
          ?>
          <li class="mt">
            <a class="active" href="index.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          <li class="mt">
            <a class="active" href="manage_admin.php">
              <i class="fa fa-dashboard"></i>
              <span>Manage Admin</span>
              </a>
          </li>
           <li class="mt">
            <a class="active" href="manage_category.php">
              <i class="fa fa-dashboard"></i>
              <span>Manage Category</span>
              </a>
          </li>
          <li class="mt">
            <a class="active" href="manageadmin_product.php">
              <i class="fa fa-dashboard"></i>
              <span>Manage Product</span>
              </a>
          </li>
          <li class="mt">
            <a class="active" href="manage_customer.php">
              <i class="fa fa-dashboard"></i>
              <span>Manage Customer</span>
              </a>
          </li>
          <li class="mt">
            <a class="active" href="manage_order.php">
              <i class="fa fa-dashboard"></i>
              <span>Manage Order</span>
              </a>
          </li>
          
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    
   
  

  


    <!--sidebar end-->
  
