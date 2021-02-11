<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php
                    if(isset($_GET['id'])){
                    $id=$_GET['id'];
                }
                    else{
                        header("Location: {$hostname}");
                    }
                   // echo "<h1>{$id}</h1>";
                    include "config.php";
                    $sql="SELECT p.post_id ,p.title,p.author,p.description,p.post_img,p.post_date,u.username,c.category_name,p.category FROM post p
                    LEFT JOIN user u ON u.user_id=p.author
                    LEFT JOIN category c ON c.category_id=p.category
                    WHERE post_id={$id}";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        while($row1=mysqli_fetch_assoc($result)){

                    ?>
                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row1['title'];?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cid=<?php echo $row1['category'];?>'><?php echo $row1['category_name'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row1['author'];?>'><?php echo $row1['username'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row1['post_date'];?>
                                </span>
                            </div>
                            <img class="single-feature-image"  src="admin/upload/<?php echo $row1['post_img'];?>" alt=""/>
                            <p>
                                <?php echo $row1['description'];?>
                            </p>
                        </div>
                    </div>
                    <?php  
                     }
                    }?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
