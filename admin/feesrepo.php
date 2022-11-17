<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <title>Students</title>
    <?php 
	include('connect.php');
	//include('fees.php');
  	// end of function databaseOutput()

if (isset($_GET['send'])) { // word output
$year=$_GET['fees'];
$sem=$_GET['ssem'];
 if($_GET['fees']==1)
 {
 $doc="STUDENTS WHO COMPLETED FEES PAYMENT";
 }
  if($_GET['fees']==2){
  $doc="STUDENTS WITH FEES BALANCE";
 }
  if($_GET['fees']==3){
  $doc="STUDENTS WHO DID NOT PAY";
 }
  if($_GET['fees']==4){
  $doc="ALL REVENUE COLLECTED FROM FEES";
  $syear="";
  $sem="";
 }
  header("Content-Type:application/msExcel");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("content-disposition: attachment;filename=Fees_Payment_Report.xlx");

?>
<html>
<head>
<style>
center{font-variant:small-caps}
</style>
</head>
  <body>
     
     <h3><center><font color="#0066FF">BLANTYRE INTERNATIONAL UNIVERSITY</font></center>
    <center ><h3><?php echo $doc ."&nbsp;&nbsp;".$syear."&nbsp;&nbsp; ".$sem."&nbsp;&nbsp;";if($_GET['sem']==1) echo "JAN-JUNE";else echo "JULY-DEC"; echo ",". $_GET['year']?> &nbsp;</h3></center>
    <table width="60%"  border="1">
     <tr  bgcolor="#DDDDDD">
                                <th>No</th>
                               <th>StudentID</th>
                              <th>Lastname</th>
                              <th>Firstname</th>
                                <th>Mode</th>
                                  <th>Amount</th>
                                  <th>Balance</th>
                                  <th>Exam No</th>
                                    
               </tr>
      <?php include('feesrp.php'); ?>
    </table>
  </body>
</html>
<?php

  exit; // end of word output

}
?>
