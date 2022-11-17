<?php
////session_start();
include('admin/connect.php');
$idz=$_COOKIE["id"];
mysqli_query($conn,"update notice_view set logged_out='1' where viewer_id='$idz'") or die(mysqli_error($conn));
mysqli_query($conn,"update user set auth='0' where user_id='$idz'") or die(mysqli_error($conn));
	mysqli_query($conn,"update teacher set auth=0 where teacher_id='$idz'");
setcookie('id','',time()-360);
setcookie('level','',time()-360);
setcookie('year','',time()-360);
setcookie('ssem','',time()-360);
setcookie('ADM_YEAR','',time()-360);
//session_destroy();
header('location:index.php')
?>
