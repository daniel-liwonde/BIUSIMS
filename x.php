<?php
include('admin/connect.php');
//session_start();
$id=$_COOKIE["id"];
$myauth=mysqli_query($conn,"select * from teacher where teacher_id='$id'")or die(mysqli_error($conn));
if(mysqli_num_rows($myauth)>0){
	mysqli_query($conn,"update teacher set auth=1 where teacher_id='$id'");
header('location:teacher_home.php');
}
else
header('location:teacher_home.php');

?>