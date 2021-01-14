<?php
ob_start();
require('include/connection.php');
session_start();
if (!isset($_SESSION['id'])) {
  header("location: login_ven.php");
  $user = "";
}
else {
  $user = $_SESSION['id'];
 $query= "SELECT * FROM vendor ";
$result = mysqli_query($conn,$query);
     
      while($vendd = mysqli_fetch_assoc($result)){
        $user = $vendd['vendor_id'];
    }

    

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, vendor, Template, Theme, Responsive, Fluid, Retina">
  <title>Dashio - Bootstrap vendor Template</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

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
    Template URL: https://templatemag.com/dashio-bootstrap-vendor-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>
<?php
if(isset($_POST['submit'])){
  
   $fullname =  $_POST['name'];
   $email    =  $_POST['email'];
   $password =  $_POST['password'];
   $image_name = $_FILES['img']['name'];
   $tmp_name = $_FILES['img']['tmp_name'];
   $path = 'img/';
   //move files to images folder
   move_uploaded_file($tmp_name, $path.$image_name);
$query = "INSERT INTO vendor (vendor_name,vendor_email,vendor_password,vendor_img)
         values('$fullname','$email','$password','$image_name')";
         mysqli_query($conn,$query);
         header("Location: vendor.php");
}
if(isset($_POST['submit1'])){
  
   $fullname =  $_POST['name'];
   $email    =  $_POST['email'];
   $password =  $_POST['password'];
   $image_name = $_FILES['img']['name'];
   $tmp_name = $_FILES['img']['tmp_name'];
   $path = 'img/';
   //move files to images folder
   move_uploaded_file($tmp_name, $path.$image_name);
   $qr = "UPDATE vendor SET vendor_name = '$fullname',
                           vendor_email = '$email',
                       vendor_password = '$password',
                       vendor_img      = '$image_name'
                       where vendor_id = {$_GET['id']}";
         mysqli_query($conn, $qr);
         header("Location: vendor.php");

   }
   if(isset($_GET['id1'])) {
     $query = "DELETE FROM vendor where vendor_id = {$_GET['id1']}";
mysqli_query($conn,$query);
header("Location: vendor.php");
}
if (isset($_GET['id'])) {


  $quer = " SELECT * from vendor where vendor_id = {$_GET['id']}";
$resul = mysqli_query($conn, $quer);
$vendor = mysqli_fetch_assoc($resul);
}




?>
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
          <li><a class="logout" href="login_ven.php">Logout</a></li>
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
          if($user!=" "){
            $query = "SELECT * FROM vendor WHERE vendor_id = {$_SESSION['id']}";
                  $result = mysqli_query($conn,$query);
                while($ven = mysqli_fetch_assoc($result)){
        
         echo  "<p class='centered'><a href='profile.html'><img src='img/{$ven['vendor_img']}' class='img-circle' width='80'></a></p>";
                   echo "<h5 class='centered'>";
                   
                   echo $ven['vendor_name'];}
                  echo " </h5>";}
          ?>
          <li class="mt">
            <a class="active" href="vendor.php">
              <i class="fa fa-dashboard"></i>
              <span>Vendor</span>
              </a>
          </li>
         
          <li class="mt">
            <a class="active" href="manage_product.php">
              <i class="fa fa-dashboard"></i>
              <span>Manage Product</span>
              </a>
          </li>
        
          
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
  </section>

    <!--sidebar end-->
  <section id="main-content">
      <section class="wrapper">
         <h3><i class="fa fa-angle-right"></i> Manage vendor</h3>
   <div class="row mt ">
          <div class="col-lg-12">
            <?php 
            if (isset($_GET['id'])) {
              echo "<h4><i class='fa fa-angle-right'></i> Edit vendor</h4>";}
              elseif (!isset($_GET['id'])) {echo "<h4><i class='fa fa-angle-right'></i> Create vendor</h4>";}
            ?>
            
            <div class="form-panel">
              <div class="form">
                <form class="cmxform form-horizontal style-form" id="signupForm" method="post" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">vendor Name</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="firstname" name="name" type="text" value="<?php if(isset($_GET['id'])) { echo $vendor['vendor_name'];} ?> ">
                    </div>
                  </div>
                   <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">vendor Email</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="email" name="email" type="email" value="<?php if(isset($_GET['id'])) {echo $vendor['vendor_email'];} ?>" >
                    </div>
                  </div>
                  
                  <div class="form-group ">
                    <label for="password" class="control-label col-lg-2">vendor Password</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="password" name="password" type="password" value="<?php if(isset($_GET['id'])) {echo $vendor['vendor_password'];} ?>">
                    </div>
                  </div>
                   <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Vendor Image</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="img" name="img" type="file" value="<?php if (isset($_GET['id'])) { echo $image_name; ?>"><img src="img/<?php echo $vendor['vendor_img'];} ?>">
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <?php
                        if (isset($_GET['id'])) {
                          echo "<input id='payment-button' type= 'submit' name= 'submit1' class='btn btn-lg btn-info'  value='edit'>
                            </input>";
                        }
                         else if (!isset($_GET['id'])) {
                          echo "<input type= 'submit'  name= 'submit' class='btn btn-lg btn-info'  value='create'>
                            </input>";
                        }
                        ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>

  </section>
</section>
</body>
         <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Basic Table Examples</h3>
        <div class="row">
          <div class="col-md-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Basic Table</h4>
              <hr>
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                      <th>Name</th>
                      <th>E_mail</th>
                      <th>Image</th>
                      <th>Edit</th>
                      <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = "SELECT * from vendor";
                     $result = mysqli_query($conn , $query);
                      while($vendor = mysqli_fetch_assoc($result)){
                      echo '<tr>';
                      echo "<td>{$vendor['vendor_id']}</td>";
                      echo "<td>{$vendor['vendor_name']}</td>";
                      echo "<td>{$vendor['vendor_email']}</td>";
                      echo "<td><img src='img/{$vendor['vendor_img']}' width='120' height='120'></td>";
                      echo "<td><a href='vendor.php?id={$vendor['vendor_id']}' 
                      class='btn btn-warning'> Edit </a ></td>";
                      echo "<td><a href='vendor.php?id1={$vendor['vendor_id']}' 
                       class='btn btn-warning'> Delete </a ></td>";
                                            
                        echo "</tr>";
                        }
                        ?> 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </section>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>
 
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
</body>

</html>
