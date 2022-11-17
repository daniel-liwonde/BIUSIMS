<?php
include('connect.php');
$idz=$_COOKIE["id"];
mysqli_query($conn,"update user set auth='0' where user_id='$idz'") or die(mysqli_error($conn));
setcookie($_COOKIE['id'],'',time()-360);
setcookie($_COOKIE['level'],'',time()-360);

header('location:../index.php');

?>