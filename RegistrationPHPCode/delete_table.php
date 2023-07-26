<?php 
include 'config.php';
$var=$_GET["ID"];
$sqliinsert="SELECT * FROM `user_form` WHERE `id`='$var'";
$result=mysqli_query($conn,$sqliinsert);
$row=mysqli_fetch_array($result);
$url=$row["profile"];
echo $url;
unlink("images/".$url); 
$sql = "DELETE FROM `user_form` WHERE `id`='$var'";
  mysqli_query($conn,$sql);
header("location:view_table.php");

?>