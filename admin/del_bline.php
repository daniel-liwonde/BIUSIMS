<?php
include('connect.php');
$get_id=$_GET['id'];
mysqli_query($conn,"delete from budget_line where id='$get_id'")or die(mysqli_error($conn));
header('location:budget_line.php');
?>
