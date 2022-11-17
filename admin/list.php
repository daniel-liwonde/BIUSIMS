<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <title>Students</title>
    <?php 
	include('connect.php');
include('functions.php');
	//include('stud.php');
  	// end of function databaseOutput()

if (isset($_GET['send'])) { // word output
  header("Content-Type:application/msExcel");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("content-disposition: attachment;filename=report.xlx");

?>
<html>
<head>
</head>
  <body>
     
     <h3><center><font color="#0066FF">BLANTYRE INTERNATIONAL UNIVERSITY</font></center>
<?php
    $thisub=$_GET['subject'];
$sh=mysqli_query($conn,"select * from subject where subject_id='$thisub'");
$subn=mysqli_fetch_assoc($sh);
{?>
<div class="alert alert-info">
                        
                            
                            <strong><i class="icon-user icon-large"></i>&nbsp;Showing &nbsp;<font color="green"><?php if($_GET['mode']==1) echo "Fulltime";if($_GET['mode']==2) echo "Distance" ?></font>&nbsp; Students doing<font color="green" >&nbsp; <?php echo $subn['subject_title'] ?>&nbsp;</font><?php if(checksem()==1) echo "Jan-June"; else echo "July-Dec" ?>&nbsp; Semester &nbsp;<?php  echo date('Y')?></strong>                      </div> 
                           <?php } ?>
    <table  width="60%" border="1">
     <tr bgcolor="#DDDDDD" >
 <thead>
                                 <tr>
                                <th>No</th>
                               <th>StudentID</th>
 <th>Lastname</th>
                              <th>Firstname</th>
                             
                                <th>Mode</th>
                                  <th>Prog</th>
                                  <th>Year</th>
                                  <th>Sem</th>
                                  <th>Phone</th>
                                  <th>Email</th>
                                  <th>Gender</th>                        
                   </tr>
      <?php include('studlic.php'); ?>
    </table>
  </body>
</html>
<?php

  exit; // end of word output

}
?>
