<?php
include('connect.php');
//session_start();
$id=$_COOKIE['id'];
$myauth=mysqli_query($conn,"select * from user where user_id='$id'")or die(mysqli_error($conn));
if(mysqli_num_rows($myauth)>0){
	mysqli_query($conn,"update user set auth=1 where user_id='$id'");
//header('location:file.php');
}
//else
//header('location:file.php');

?>