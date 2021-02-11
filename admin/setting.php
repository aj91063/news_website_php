<?php 
include "header.php";
include "config.php";

if($_SESSION['user_role']==0){
    
    header("Location: {$hostname}admin/post.php");
}
?>
<div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Setting</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <?php
                    $sql="SELECT * FROM setting"; 
                    $result=mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){

                        
                  
                  ?>
                  <form  action="save-setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                      <div class="form-group">
                          <label for="post_title">Website Name</label>
                          <input type="text" name="website_name" value="<?php echo $row['websitename'];?>" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Logo</label>
                          <input type="file" name="logo">
                          <img height="100px" src="images/<?php echo $row['logo'];?>" alt="">
                          <input type="hidden" name="old_logo" value="<?php echo $row['logo'];?>">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Footer Description</label>
                          <textarea name="footerdesc" class="form-control" style="text-align: left;" rows="5"  required>
                          <?php echo $row['footerdesc'];?>
                          </textarea>
                      </div>
                      
                      
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <?php
                  }
                }
                  ?>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
  <?php include "footer.php"; ?>