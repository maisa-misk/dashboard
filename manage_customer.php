<?php
ob_start();
include_once('include/header.php');
require('include/connection.php');
if(isset($_POST['submit'])){
   $cusname     =  $_POST['name'];
   $cusemail    =  $_POST['email'];
   $cuspass     =  $_POST['pass'];
   $cmobile        =  $_POST['mob'];
   $caddress        =  $_POST['addr'];
   
   
$query = "INSERT INTO customer (customer_name,customer_email,customer_password,mobile,address)
         values('$cusname','$cusemail','$cuspass','$cmobile','$caddress')";
         mysqli_query($conn,$query);
         header("location:manage_customer.php");

}
if(isset($_POST['submit1'])){
    $cusname    =  $_POST['name'];
   $cusemail    =  $_POST['email'];
   $cuspass     =  $_POST['pass'];
   $cmobile     =  $_POST['mob'];
   $caddress    =  $_POST['addr'];
   


   
$quer = "UPDATE customer SET customer_name   = '$cusname',
                            customer_email    = '$cusemail',
                            customer_password = '$cuspass',
                            mobile            = '$cmobile',
                            address           = '$caddress'
                            where customer_id = {$_GET['id']}";
         mysqli_query($conn, $quer);
         header("location:manage_customer.php");
}
if(isset($_GET['id1'])) {
    $query = "DELETE FROM customer where customer_id = {$_GET['id1']}";
mysqli_query($conn,$query);
header("location:manage_customer.php");
}
if (isset($_GET['id'])) {


  $query = " SELECT * from customer where customer_id = {$_GET['id']}";
$result = mysqli_query($conn, $query);
$customer = mysqli_fetch_assoc($result);
}

?>
<section id="main-content">
      <section class="wrapper">
      	 <h3><i class="fa fa-angle-right"></i> Manage Customer</h3>
   <div class="row mt ">
          <div class="col-lg-12">
            <?php 
            if (isset($_GET['id'])) {
              echo "<h4><i class='fa fa-angle-right'></i> Edit Customer</h4>";}
              elseif (!isset($_GET['id'])) {echo "<h4><i class='fa fa-angle-right'></i> Create Customer</h4>";}
            ?>
            <div class="form-panel">
              <div class="form">
                <form class="cmxform form-horizontal style-form" id="signupForm" method="post" action="" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Customer Name</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="firstname" name="name" type="text" value="<?php if (isset($_GET['id'])) {echo $customer['customer_name'];} ?>" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Customer Email</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="email" name="email" type="email" value="<?php if (isset($_GET['id'])) {echo $customer['customer_email'];} ?>" />
                    </div>
                  </div>
                  
                  <div class="form-group ">
                    <label for="password" class="control-label col-lg-2">Customer Password</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="password" name="pass" type="password" value="<?php if (isset($_GET['id'])) {echo $customer['customer_password'];} ?>"  />
                    </div>
                  </div>
                   <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Mobile </label>
                    <div class="col-lg-10">
                     <input class="form-control "  name="mob" type="mobile" value="<?php if (isset($_GET['id'])) {echo $customer['mobile'];} ?>" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Address </label>
                    <div class="col-lg-10">
                     <input class="form-control " name="addr" type="text" value="<?php if (isset($_GET['id'])) {echo $customer['address'];} ?>" />
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
                                                <th>E_mail</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          $query = "SELECT * from customer";
                                          $result = mysqli_query($conn , $query);
                                         while($customer = mysqli_fetch_assoc($result)){
                                         echo '<tr>';
                                         echo "<td>{$customer['customer_id']}</td>";
                                         echo "<td>{$customer['customer_name']}</td>";
                                          echo "<td>{$customer['customer_email']}</td>";
                                         echo "<td>{$customer['mobile']}</td>";
                                         echo "<td>{$customer['address']}</td>";
                                         echo "<td><a href='manage_customer.php?id={$customer['customer_id']}' 
                                           class='btn btn-warning'> EDIT </a ></td>";
                                           echo "<td><a href='manage_customer.php?id1={$customer['customer_id']}' 
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