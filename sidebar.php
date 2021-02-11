<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
                     <?php
                        include "config.php";
                        $limit=3;

                        $sql1 = "SELECT post.post_id, post.title, post.post_date,
                        category.category_name,post.category,post.post_img  FROM post 
                        LEFT JOIN category ON post.category=category.category_id
                        
                        ORDER BY post.post_id DESC LIMIT {$limit}";

                        $result1=mysqli_query($conn,$sql1) or die("Recent: Query Failed.");
                        if(mysqli_num_rows($result1)>0){
                            while($row1=mysqli_fetch_assoc($result1)){
                           
                    ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $row1['post_id'];?>">
                <img src="admin/upload/<?php echo $row1['post_img'];?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $row1['post_id'];?>"><?php echo $row1['title'];?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=<?php echo $row1['category'];?>'><?php echo $row1['category_name'];?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row1['post_date'];?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $row1['post_id'];?>">read more</a>
            </div>
        </div>
        <?php
         }
        }
        ?>
        
    <!-- /recent posts box -->
</div>
