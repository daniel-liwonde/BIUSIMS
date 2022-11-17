<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <title>Students</title>
    <?php 
	include('connect.php');
	include('financial_exe.php');
  	// end of function databaseOutput()

if (isset($_GET['send'])) { // word output
 if($_GET['sem']==1)
 {
 $doc="Jan-June semester";
 }
  if($_GET['sem']==2){
  $doc="July-Dec semester";
 }
  if($_GET['sem']==3){
  $doc="First and Second semesters";
 }
  header("Content-Type:application/msword");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("content-disposition: attachment;filename=report.doc");

?>
<html>
<head>
</head>
  <body>
     
     <h3><center><font color="#0066FF">BLANTYRE INTERNATIONAL UNIVERSITY</font></center>
    <center><h3><?php echo $doc; if(isset($_GET['year'])){echo $_GET['year'];}?> &nbsp; Financial Report</h3></center>
    <table width="60%" align="center">
     <tr  bgcolor="#333333">

                              <th>No</th>
                               <th>Total Revenue</th>
                              <th>Total expense</th>
                                <th>Balance</th>
                                    <th>Remarks</th>                      
                   </tr>
      <?php include('financial_exe.php'); ?>
    </table>
  </body>
</html>
<?php

  exit; // end of word output

}
?>
