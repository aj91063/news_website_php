<?php
include "config.php";
if(isset($_FILES['fileToUpload'])){
    $error=array();

    $file_name=$_FILES['fileToUpload']['name'];
    $file_size=$_FILES['fileToUpload']['size'];
    $file_tmp=$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
    $file_ext=strtolower(end(explode('.',$file_name)));
     $extention=array("jpeg","jpg","png");
     if(in_array($file_ext,$extention)===false){
       $error[]="This extention is not allowed. only jpeg, jpg, png file.";
       
     }
     if($file_size>2097152){
        $error[]="File size must be 2MB or lower allowed.";
     }
     if(empty($error)==true){
         move_uploaded_file($file_tmp,"upload/".$file_name);
     }
     else{
         echo "<script>
               alert('{$error[0]}');
         </script>";
         
         die();
     }
}
    session_start(); 
    $title=mysqli_real_escape_string($conn,$_POST['post_title']);
    $postdesc=mysqli_real_escape_string($conn,$_POST['postdesc']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $date=date("d M, Y");
    $author=$_SESSION['user_id'];

    $sql="INSERT INTO post(title,description,category,post_date,author,post_img	) 
          VALUES('{$title}','{$postdesc}',{$category},'{$date}',{$author},'{$file_name}');";
    $sql.="UPDATE category SET post=post+1 WHERE category_id={$category}";
    if(mysqli_multi_query($conn,$sql)){
        header("Location: {$hostname}admin/post.php");
    }else{
        echo "<div class='alert alert-danger'>file not uploaded</div>";
    }

?>