<?php
include ('session.php');
include ('admin/functions.php');
$user_query = mysqli_query($conn,"select * from teacher where teacher_id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
$subjects = mysqli_query($conn,"select * from subject where teacher_id='$session_id'") or die(mysqli_error($conn));
$y= date('Y');
$s=checksem();
$subj=$_GET['sid'];
$user=clean($conn,$_GET['student']);
updyearandsem($user);
repeat($user);
$x=mysqli_query($conn,"select * from teacher_student where uid='$user' and subject_id='$subj' and year='$y' and semester='$s'") or die(mysqli_error($conn));
if(mysqli_num_rows($x)>0){
$message="student already registered on this subject";
//setcookie("success",$message,0);
//header("location:teacher_add_student.php");
}
else
{
 $number_query = mysqli_query($conn,"select * from teacher_student where uid='$user' and semester='$s' and year='$y'") or die(mysqli_error($conn));
$count = mysqli_num_rows($number_query);
mysqli_query($conn,"insert into teacher_student(teacher_id,year,semester,subject_id,uid) values('$session_id','$y','$s','$subj','$user')") or die(mysqli_error($conn));
 $message="Action Succeeded";
//setcookie("success",$message,0);
//header("location:teacher_add_student.php");
}
?>