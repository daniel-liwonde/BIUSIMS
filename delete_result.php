<?php
include('admin/connect.php');
include('admin/functions.php');
$sem=checksem();
$year=date('Y');
$stid= $_POST['stud_id'];
$code= $_POST['ccode'];
mysqli_query($conn,"delete from results where student_id='stud_id' and course_code='$code' and year='$year' and sem='$sem'")or die(mysqli_error($conn));
$ret = $_SERVER['QUERY_STRING']. '?'.$_POST['ccode'];
header('location:$ret');

?>