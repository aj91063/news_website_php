<?php
 include "config.php";
if($_SESSION['user_role']!=0 or $_SESSION['user_role']!=1){
    header("Location: {$hostname}admin/");
 }else{
    header("Location: {$hostname}admin/post.php"); 
 }

$p_id=$_GET['p_id'];
$catid=$_GET['catid'];

$sql1="SELECT * FROM post WHERE post_id={$p_id}";
$result=mysqli_query($conn,$sql1) or die("Select query failed.");
$row=mysqli_fetch_assoc($result);
unlink("upload/".$row['post_img']);


$sql="DELETE FROM post WHERE post_id={$p_id};";
$sql .="UPDATE category SET post=post-1 WHERE category_id={$catid}";
if(mysqli_multi_query($conn,$sql)){
   header("Location: {$hostname}admin/post.php");
}
else{
    echo "<p style='color: red'> can not delete</p>";
}
mysqli_close($conn);
?>