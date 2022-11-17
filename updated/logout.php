<?php
//session_start();
include('admin/connect.php');
$idz=$_COOKIE['id'];
mysqli_query($conn,"update notice_view set logged_out='1' where viewer_id='$idz'") or die(mysqli_error($conn));
unset($_COOKIE['id']);
unset($_COOKIE['level']);
unset($_COOKIE['year']);
unset($_COOKIE['ssem']);
unset($_COOKIE['ADM_YEAR']);
//session_destroy();
header('location:index.php')
?>
