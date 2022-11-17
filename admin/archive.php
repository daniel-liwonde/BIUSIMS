<?php
//session_start();
include('connect.php');
include('functions.php');
if(isset($_POST['go']))
{
$sname=$_POST['arcid'];
if($sname=='')
{
$_COOKIE['ERR']="Select Transcript first";
header("location:transcript.php");
}
else
{
$dup=mysqli_query($conn,"select * from archive where uid='$sname'") or die(mysqli_error($conn));
if(mysqli_num_rows($dup)>0)
{
$_COOKIE['ERR']="Results already archived";
header("location:transcript.php");
}
else
{
$results=mysqli_query($conn,"select * from results where uid='$sname'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($results))
{
$id=GenKey2();
mysqli_query($conn,"insert into archive(result_id,uid,student_id,firstname,surname,course_code,assign_1,assign_2,EOS,fgrade,year,sem,comment,prog,mode,stud_year,dept) values('$id','$row[uid]','$row[student_id]','$row[firstname]','$row[surname]','$row[course_code]','$row[assign_1]','$row[assign_2]','$row[EOS]','$row[fgrade]','$row[year]','$row[sem]','$row[comment]','$row[prog]','$row[mode]','$row[stud_year]','$row[dept]')") or die(mysqli_error($conn));
}
mysqli_query($conn,"delete from results where uid='$sname'") or die("here".mysqli_error($conn));
mysqli_query($conn,"delete from teacher_student where uid='$sname'") or die("here".mysqli_error($conn));
mysqli_query($conn,"delete from student_fees where id='$sname'") or die(mysqli_error($conn));
mysqli_query($conn,"delete from student where id='$sname'") or die(mysqli_error($conn));
$_COOKIE['ERR']="Results archived";
header("location:transcript.php");
}
}
}
?>