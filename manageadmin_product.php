<?php
ob_start();
include_once('include/header.php');
session_start();
require('include/connection.php');
if (!isset($_SESSION['id'])) {
  
  $ven = "";
}
else {
  $ven = $_SESSION['id'];
 $quu= "SELECT * FROM vendor ";
$ress = mysqli_query($conn,$quu);
    $vendd = mysqli_fetch_assoc($ress);
      
      $user = $vendd['vendor_id'];
   
}


if(isset($_POST['submit'])){
    //get file info
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
         values('$prodname','$prodprice','$proddesc','$image_name','$select','0')";
         mysqli_query($conn,$query);
         header("location:manageadmin_product.php");
       

}
if(isset($_POST['submit1'])){
    //get file info
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
                            cat_id      = '$select',
                            vendor_id = '0';
                         where product_id = {$_GET['id']}";
         mysqli_query($conn, $query2);
         header("location: manageadmin_product.php");
         }
         if(isset($_GET['id1'])) {
         $query = "DELETE FROM product where product_id = {$_GET['id1']}";
mysqli_query($conn,$query);
header("location:manageadmin_product.php");
}
if (isset($_GET['id'])) {
	$query = " SELECT * from product where product_id = {$_GET['id']}";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
}
?>
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
                                                <th>Category name</th>
                                                <th>Vendor name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                          $qq = "SELECT * from product";
                                          $ress = mysqli_query($conn , $qq);
                                         $qq2 = "SELECT cat_name from category INNER join product ON category.cat_id = product.cat_id ";
                                         $ress2 = mysqli_query($conn,$qq2);
                                         
                                         while($product = mysqli_fetch_assoc($ress)){
                                             $categoryname = mysqli_fetch_assoc($ress2);

                                         echo '<tr>';
                                         echo "<td>{$product['product_id']}</td>";
                                         echo "<td>{$product['product_name']}</td>";
                                         echo "<td>{$product['product_price']}</td>";
                                         echo "<td>{$product['product_desc']}</td>";
                                         echo "<td><img src='img/{$product['product_img']}' width='120' height='120'></td>";

                                         echo "<td>{$categoryname['cat_name']}</td>";

                 if($ven!=""){                 
            $que2 = "SELECT * FROM vendor WHERE vendor_id = {$product['vendor_id']}";
                  $res2 = mysqli_query($conn,$que2);
                while($venn = mysqli_fetch_assoc($res2)){

                                         echo "<td>{$venn['vendor_name']}</td>";

                                       }}
            

                                         


                                         echo "<td><a href='manageadmin_product.php?id={$product['product_id']}' 
                                           class='btn btn-warning'> EDIT </a ></td>";
                                           echo "<td><a href='manageadmin_product.php?id1={$product['product_id']}' 
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
