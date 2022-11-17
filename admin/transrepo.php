<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <title>Students</title>
    <?php 
	include('connect.php');
	include('functions.php');
  	// end of function databaseOutput()

if (isset($_GET['send'])) { // word output
$st=$_GET['sname'];
$querys=mysqli_query($conn,"select* from student where id='$st'") or die(mysqli_error($conn));
$fetch=mysqli_fetch_array($querys);
  header("Content-Type:application/msword");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("content-disposition: attachment;filename=report.doc");
?>
<html>
<head>
</head>
  <body>
    
     
     <table  width="98%" align="center">
      <?php include('transgen.php'); ?>
    </table>
  </body>
</html>
<?php

  exit; // end of word output

}
?>
