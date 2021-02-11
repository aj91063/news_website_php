<?php include "header.php"; 
if($_SESSION['user_role']==0){
    header("Location: {$hostname}admin/post.php");
 }
 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <?php
                  include "config.php";
                  $cat_id=$_GET['cat_id'];
                  $sql="SELECT category_id,category_name FROM category WHERE category_id={$cat_id}";
                  $result=mysqli_query($conn,$sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'];?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'];?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                    <?php }}
                    if(isset($_POST['sumbit'])){
                        include "config.php";
                        $cat_name=$_POST['cat_name'];
                        $Sql1="UPDATE category SET category_name='{$cat_name}' WHERE category_id={$cat_id}";
                       $result= mysqli_query($conn, $Sql1);
                        if($result){
                            header("Location: {$hostname}admin/category.php");
                        }
                    }
                    
                    ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
