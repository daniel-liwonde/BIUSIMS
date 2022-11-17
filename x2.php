<?php
include('admin/connect.php');
include('admin/functions.php');
$grant=grant_access(); 
$id=$_COOKIE['id'];
if($grant==1)
{
$myauth=mysqli_query($conn,"select * from teacher where teacher_id='$id'")or die(mysqli_error($conn));
if(mysqli_num_rows($myauth)>0){
	mysqli_query($conn,"update teacher set auth=1 where teacher_id='$id'");
	header('location:teacher_home.php');
}
}
else
{
$myauth=mysqli_query($conn,"select * from user where user_id='$id'") or die(mysqli_error($conn));
if(mysqli_num_rows($myauth)>0){
mysqli_query($conn,"update user set auth=1 where user_id='$id'");
header('location:teacher_home.php');
}
}
?>