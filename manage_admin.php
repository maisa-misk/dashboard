<?php
ob_start();
include_once('include/header.php');
require('include/connection.php');
if(isset($_POST['submit'])){
   $image_name = $_FILES['img']['name'];
   $tmp_name = $_FILES['img']['tmp_name'];
   $path = 'img/';
   //move files to images folder
   move_uploaded_file($tmp_name, $path.$image_name);
   $fullname =  $_POST['name'];
   $email    =  $_POST['email'];
   $password =  $_POST['password'];
$query = "INSERT INTO admin (admin_name,admin_email,admin_password,admin_img)
         values('$fullname','$email','$password','$image_name')";
         mysqli_query($conn,$query);
         header("Location: manage_admin.php");
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

   $query = "UPDATE admin SET admin_name = '$fullname',
                           admin_email = '$email',
                       admin_password = '$password',
                       admin_img = '$image_name'
                       where admin_id = {$_GET['id']}";
         mysqli_query($conn, $query);
         header("Location: manage_admin.php");

   }
   if(isset($_GET['id1'])) {
     $query = "DELETE FROM admin where admin_id = {$_GET['id1']}";
mysqli_query($conn,$query);
header("Location: manage_admin.php");
}

if (isset($_GET['id'])) {


  $query = " SELECT * from admin where admin_id = {$_GET['id']}";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);
}


?>
 <section id="main-content">
      <section class="wrapper">
      	 <h3><i class="fa fa-angle-right"></i> Manage Admin</h3>
   <div class="row mt ">
          <div class="col-lg-12">
            <?php 
            if (isset($_GET['id'])) {
              echo "<h4><i class='fa fa-angle-right'></i> Edit Admin</h4>";}
              elseif (!isset($_GET['id'])) {echo "<h4><i class='fa fa-angle-right'></i> Create Admin</h4>";}
            ?>
            
            <div class="form-panel">
              <div class="form">
                <form class="cmxform form-horizontal style-form" id="signupForm" method="post" action="" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Admin Name</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="firstname" name="name" type="text" value="<?php if (isset($_GET['id'])) { echo $admin['admin_name'];} ?>" />
                    </div>
                  </div>
                   <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Admin Email</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="email" name="email" type="email" value="<?php if (isset($_GET['id'])) {echo $admin['admin_email'];} ?>" />
                    </div>
                  </div>
                  
                  <div class="form-group ">
                    <label for="password" class="control-label col-lg-2">Admin Password</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="password" name="password" type="password" value="<?php if (isset($_GET['id'])) {echo $admin['admin_password'];} ?>"  />
                    </div>
                  </div>
                    <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Admin Image</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="img" name="img" type="file" value="<?php if (isset($_GET['id'])) { echo $image_name; ?>"  /><img src="img/<?php echo $admin['admin_img'];} ?>" />
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
                      <th>E_mail</th>
                      <th>Image</th>
                      <th>Edit</th>
                      <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = "SELECT * from admin";
                     $result = mysqli_query($conn , $query);
                      while($admin = mysqli_fetch_assoc($result)){
                      echo '<tr>';
                      echo "<td>{$admin['admin_id']}</td>";
                      echo "<td>{$admin['admin_name']}</td>";
                      echo "<td>{$admin['admin_email']}</td>";
                       echo "<td><img src='img/{$admin['admin_img']}' width='120' height='120'></td>";
                      echo "<td><a href='manage_admin.php?id={$admin['admin_id']}' 
                      class='btn btn-warning'> EDIT </a ></td>";
                      echo "<td><a href='manage_admin.php?id1={$admin['admin_id']}' 
                       class='btn btn-danger'> Delete </a ></td>";
                                            
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
