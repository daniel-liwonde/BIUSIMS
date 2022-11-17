<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <title>Students</title>
    <?php 
	include('connect.php');
	include('functions.php');
	//outputresults();
 
						// end of function databaseOutput()

if (isset($_GET['send'])) { // word output
 $su_id=$_GET['sub'];
 $results = mysqli_query($conn,"select * from course where course_id='$su_id'") or die(mysqli_error($conn));            
$results_row = mysqli_fetch_array($results);
$doc=$results_row['cys'];
  header("Content-Type:application/msword");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("content-disposition: attachment;filename=report.doc");

?>
<html>
<head>
<style>
.r #disp:nth-of-type(odd)
{background:#F4F4F4;}
.r #disp:nth-of-type(even)
{background:#EDEBED;} 
</style>
</head>
  <body>
     
     
   
    <table  width="100%" align="center" class="r">
      <?php outputresults(); ?>
    </table>
  </body>
</html>
<?php

  exit; // end of word output

}
?>
