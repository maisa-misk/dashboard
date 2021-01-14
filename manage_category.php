<?php
ob_start();
include_once('include/header.php');
require('include/connection.php');
if(isset($_POST['submit'])){
   $image_name = $_FILES['image']['name'];
   $tmp_name = $_FILES['image']['tmp_name'];
   $path = 'img/';
   //move files to images folder
   move_uploaded_file($tmp_name, $path.$image_name);
   $catname =  $_POST['name'];
$query = "INSERT INTO category(cat_name,cat_img)
         values('$catname','$image_name')";

        
         mysqli_query($conn,$query);
         header("location:manage_category.php");
}
if(isset($_POST['submit1'])){
 
  $image_name = $_FILES['image']['name'];
   $tmp_name = $_FILES['image']['tmp_name'];
   $path = 'img/';
   //move files to images folder
   move_uploaded_file($tmp_name, $path.$image_name);
   $catname =  $_POST['name'];
  $query = "UPDATE category SET cat_name = '$catname',
                               cat_img = '$image_name'
                          where cat_id = {$_GET['id']}";
         mysqli_query($conn, $query);
         header("location:manage_category.php");

   }
   if(isset($_GET['id1'])) {
    $query = "DELETE FROM category where cat_id = {$_GET['id1']}";
mysqli_query($conn,$query);
header("location:manage_category.php");
}

if (isset($_GET['id'])) {


  $query = " SELECT * from category where cat_id = {$_GET['id']}";
$result = mysqli_query($conn, $query);
$category = mysqli_fetch_assoc($result);
}

?>
<section id="main-content">
      <section class="wrapper">
      	 <h3><i class="fa fa-angle-right"></i> Manage Category</h3>
   <div class="row mt ">
          <div class="col-lg-12">
            <?php 
            if (isset($_GET['id'])) {
              echo "<h4><i class='fa fa-angle-right'></i> Edit Category</h4>";}
              elseif (!isset($_GET['id'])) {echo "<h4><i class='fa fa-angle-right'></i> Create Category</h4>";}
            ?>
            <div class="form-panel">
              <div class="form">
                <form class="cmxform form-horizontal style-form" id="signupForm" method="post" action="" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Category Name</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="firstname" name="name" type="text" value="<?php if (isset($_GET['id'])) { echo $category['cat_name'];} ?>" />
                    </div>
                  </div>
                   <div class="form-group ">
                    <label for="email" class="control-label col-lg-2">Category image</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="img" name="image" type="file" value="<?php if (isset($_GET['id'])) { echo $image_name; ?>"  /><img src="img/<?php echo $category['cat_img'];} ?>" />
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
                                                <th>Image</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                          $query = "SELECT * from category";
                                          $result = mysqli_query($conn , $query);
                                         while($category = mysqli_fetch_assoc($result)){
                                         echo '<tr>';
                                         echo "<td>{$category['cat_id']}</td>";
                                         echo "<td>{$category['cat_name']}</td>";
                                         echo "<td><img src='img/{$category['cat_img']}' width='120' height='120'></td>";
                                         echo "<td><a href='manage_category.php?id={$category['cat_id']}' 
                                           class='btn btn-warning'> EDIT </a ></td>";
                                           echo "<td><a href='manage_category.php?id1={$category['cat_id']}' 
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
