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
   while($vendor = mysqli_fetch_assoc($result)){
      $user = $vendor['vendor_id'];

   }
   
    
}
if(isset($_POST['submit'])){
   $image_name = $_FILES['img']['name'];
   $tmp_name = $_FILES['img']['tmp_name'];
   $path = 'img/';
   //move files to images folder
   move_uploaded_file($tmp_name, $path.$image_name);
   $prodname     =  $_POST['name'];
   $prodprice    =  $_POST['price'];
   $proddesc     =  $_POST['desc'];
   $select       =  $_POST['select'];
   
   
$query = "INSERT INTO product (product_name,product_price,product_desc,product_img,cat_id,vendor_id)
         values('$prodname','$prodprice','$proddesc','$image_name','$select','{$_SESSION['id']}')";
         mysqli_query($conn,$query);
         header("location:manage_product.php");
       
}
if(isset($_POST['submit1'])){
 
  $image_name = $_FILES['img']['name'];
   $tmp_name = $_FILES['img']['tmp_name'];
   $path = 'img/';
   //move files to images folder
   move_uploaded_file($tmp_name, $path.$image_name);
   $prodname     =  $_POST['name'];
   $prodprice    =  $_POST['price'];
   $proddesc     =  $_POST['desc'];
   $select       =  $_POST['select'];
   
$query2 = "UPDATE product SET product_name = '$prodname',
                            product_price = '$prodprice',
                            product_desc  = '$proddesc',
                            product_img   = '$image_name',
                            cat_id      = '$select'
                           
                         where product_id = {$_GET['id']}";
         mysqli_query($conn, $query2);
         header("location: manage_product.php");

   }
   if(isset($_GET['id1'])) {
     $query = "DELETE FROM product where product_id = {$_GET['id1']}";
mysqli_query($conn,$query);
header("location:manage_product.php");
}

if (isset($_GET['id'])) {


  $query = " SELECT * from product where product_id = {$_GET['id']}";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
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
      <a href="index.html" class="logo"><b>DASH<span>IO</span></b></a>
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
                while($vendor = mysqli_fetch_assoc($result)){
          
                  
                
         echo  "<p class='centered'><a href='profile.html'><img src='img/{$vendor['vendor_img']}' class='img-circle' width='80'></a></p>
                   <h5 class='centered'>
                   ";
                   echo $vendor['vendor_name'];}
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
    <!--sidebar end-->
<section id="main-content">
      <section class="wrapper">
      	 <h3><i class="fa fa-angle-right"></i> Manage Product</h3>
   <div class="row mt ">
          <div class="col-lg-12">
            <?php 
            if (isset($_GET['id'])) {
              echo "<h4><i class='fa fa-angle-right'></i> Edit Product</h4>";}
              elseif (!isset($_GET['id'])) {echo "<h4><i class='fa fa-angle-right'></i> Create Product</h4>";}
            ?>
            <div class="form-panel">
              <div class="form">
                <form class="cmxform form-horizontal style-form" id="signupForm" method="post" action="" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Product Name</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="firstname" name="name" type="text" value="<?php if (isset($_GET['id'])) { echo $product['product_name'];} ?>" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Product Price</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="firstname" name="price" type="text" value="<?php if (isset($_GET['id'])) { echo $product['product_price'];} ?>" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Product Description</label>
                    <div class="col-lg-10">
                      <textarea class=" form-control" id="firstname" name="desc" type="text" value="<?php if (isset($_GET['id'])) { echo $product['product_desc'];} ?>" /></textarea>
                    </div>
                  </div>
                   <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Product Image</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="img" name="img" type="file" value="<?php if (isset($_GET['id'])) { echo $image_name; ?>"  /><img src="img/<?php echo $product['product_img'];} ?>" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Category Name</label>
                    <div class="col-lg-10">
                      <select  name="select" type="text" class="form-control cc-number identified visa" value="" >
                                                    <?php
                                                    $q= "SELECT * from category where cat_id = {$product['cat_id']}";
                                                    $rs = mysqli_query($conn,$q);
                                                    $r= mysqli_fetch_assoc($rs);
                                                    echo "<option>";
                                                    echo $r['cat_name'];
                                                    echo "</option>";
                                                    $query2 = "SELECT *from category";
                                                    $result2 = mysqli_query($conn,$query2);
                                                    while ($cat = mysqli_fetch_assoc($result2)) {
                                                    if ($product['cat_name']!=$r['cat_name']) {
                                                        echo "<option>".$product['cat_name']."</option>";
                                                    }
                                                    
                                                    
                                                     echo"<option value='$cat[cat_id]'>$cat[cat_name]</option>";
                                                    
                                                 }
                                                 ?>
                                               </select>
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
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>category name</th>
                                                <th>Vendor name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                          $query = "SELECT * from product";
                                          $result = mysqli_query($conn , $query);
                                         $query2 = "SELECT cat_name from category INNER join product ON category.cat_id = product.cat_id ";
                                         $result2 = mysqli_query($conn,$query2);
                                        
                                         while($product = mysqli_fetch_assoc($result)){
                                             $categoryname = mysqli_fetch_assoc($result2);
                                         echo '<tr>';
                                         echo "<td>{$product['product_id']}</td>";
                                         echo "<td>{$product['product_name']}</td>";
                                         echo "<td>{$product['product_price']}</td>";
                                         echo "<td>{$product['product_desc']}</td>";
                                         echo "<td><img src='img/{$product['product_img']}' width='120' height='120'></td>";
                                         echo "<td>{$categoryname['cat_name']}</td>";
                                         
              if($user!=""){                            
            $que1 = "SELECT * FROM vendor WHERE vendor_id = {$product['vendor_id']}";
                  $res1 = mysqli_query($conn,$que1);
                while($vend = mysqli_fetch_assoc($res1)){
                                         echo "<td>{$vend['vendor_name']}</td>";}}
                                      
                                         echo "<td><a href='manage_product.php?id={$product['product_id']}' 
                                           class='btn btn-warning'> EDIT </a ></td>";
                                           echo "<td><a href='manage_product.php?id1={$product['product_id']}' 
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

  


    <?php
include_once('include/footer.php');
?>
