<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $file_name=$_POST['old-image'];
}else{
    $error=array();

    $file_name=$_FILES['new-image']['name'];
    $file_size=$_FILES['new-image']['size'];
    $file_tmp=$_FILES['new-image']['tmp_name'];
    $file_type=$_FILES['new-image']['type'];
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
$title=mysqli_real_escape_string($conn,$_POST['post_title']);
$postdesc=mysqli_real_escape_string($conn,$_POST['postdesc']);
$category=mysqli_real_escape_string($conn,$_POST['category']);
$post_id=$_POST['post_id'];
 $sql="UPDATE post SET title='{$title}',description='{$postdesc}',category={$category}, post_img='{$file_name}'
WHERE post_id={$post_id} ";
$result=mysqli_query($conn,$sql);
if($result){
    header("Location: {$hostname}admin/post.php");
}else
{
echo "Quary failed 40.";
}

?>