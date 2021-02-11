<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                 <!-- post-container -->
                <div class="post-container">
                    <?php
                    include "config.php";
                    if(isset($_GET['aid'])){
                        $auth_id=$_GET['aid'];
                    }else{
                        header("Location: {$hostname}");
                    }
                     $sql="SELECT * FROM post JOIN user 
                     ON user.user_id=post.author 
                     WHERE post.author={$auth_id}";
                     $result=mysqli_query($conn,$sql);
                     $row=mysqli_fetch_assoc($result);

                    ?>
                  <h2 class="page-heading"><?php echo $row['username']?></h2>
                  <?php
                        include "config.php";

                        
                        /*OFFSET */
                        $limit=3;

                        if(isset($_GET['page'])){
                            $page=$_GET['page'];
                        }
                        else{
                            $page=1;
                        }
                       
                        $offset=($page-1)*$limit;

                        $sql1 = "SELECT post.post_id, post.title, post.post_date, user.username,post.author,
                        category.category_name,post.category,post.description,post.post_img  FROM post 
                        LEFT JOIN category ON post.category=category.category_id
                        LEFT JOIN user ON post.author=user.user_id
                        WHERE post.author={$auth_id}
                        ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";

                        $result1=mysqli_query($conn,$sql1);
                        if(mysqli_num_rows($result1) >0){
                            while($row1=mysqli_fetch_assoc($result1)){
                           
                    ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row1['post_id'];?>"><img src="admin/upload/<?php echo $row1['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row1['post_id'];?>'><?php echo $row1['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <?php echo $row1['category_name'];?>
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
                                        <div class="description">
                                        
                                        <?php echo substr($row1['description'],0,130)."...";?>
                                        
                                        </div>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row1['post_id'];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <?php 
                                    }
                                  }
                                  else{
                                      echo "<h1>no post found.</h1>";
                                  }
                                  /*show pagination */
                               


                                if(mysqli_num_rows($result)>0)
                                {   
                                    $total_records=mysqli_num_rows($result);
                                    $total_page=ceil( $total_records/$limit);
                    
                                    echo"<ul class='pagination'>";
                                     if($page>1){
                                        echo '<li><a href="category.php?aid='.$auth_id.'&page=' . ($page - 1) . '">Prev</a></li>';
                                     }
                                    for($i=1;$i<=$total_page;$i++){
                                        if($i==$page){
                                            $active="active";
                                        }
                                        else{
                                            $active="";
                                        }
                                       echo "<li class='{$active}'><a href='category.php?aid={$auth_id}&page={$i}'>{$i}</a></li>";
                                    }
                                    if($total_page > $page){
                                        echo '<li><a href="category.php?aid='.$auth_id.'&page=' . ($page + 1) . '">Next</a></li>';
                                     }
                                    echo "</ul>";
                                }
                            ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
