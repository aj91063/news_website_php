<?php
include "config.php";
if(empty($_FILES['logo']['name'])){
    $file_name=$_POST['old_logo'];
}else{
    $error=array();

    $file_name=$_FILES['logo']['name'];
    $file_size=$_FILES['logo']['size'];
    $file_tmp=$_FILES['logo']['tmp_name'];
    $file_type=$_FILES['logo']['type'];
    $file_ext=strtolower(end(explode('.',$file_name)));
     $extention=array("jpeg","jpg","png");
     if(in_array($file_ext,$extention)===false){
       $error[]="This extention is not allowed. only jpeg, jpg, png file.";
     }
     if($file_size>2097152){
        $error[]="File size must be 2MB or lower allowed.";
     }
     if(empty($error)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
     }
     else{
        echo "<script>
        alert('{$error[0]}');
            </script>";
         die();
        }

}
        $website_name=mysqli_real_escape_string($conn,$_POST['website_name']);
        $footerdesc=mysqli_real_escape_string($conn,$_POST['footerdesc']);
    
        $post_id=$_POST['post_id'];
        $sql="UPDATE setting SET websitename='{$website_name}',footerdesc='{$footerdesc}',logo='{$file_name}'";
        $result=mysqli_query($conn,$sql);
        if($result){
            
            header("Location: {$hostname}admin/setting.php");
        }else
        {
        echo "Quary failed 40.";
}

?>