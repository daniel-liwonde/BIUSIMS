<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <title>Students</title>
    <?php 
	include('connect.php');
	//include('header.php');
	include('functions.php');
  	// end of function databaseOutput()

if (isset($_GET['send'])) { // word output
$subid=$_GET['sub'];
   $subsel=mysqli_query($conn,"select * from subject where subject_id='$subid'")or die(mysqli_error($conn));
   $rows=mysqli_fetch_array($subsel);
   $tid=$rows['teacher_id'];
   $course_title=$rows['subject_title'];
   $lec=mysqli_query($conn,"Select * from teacher where teacher_id='$tid'")or die(mysqli_error($conn));
   $td=mysqli_fetch_array($lec);
  header("Content-Type:application/msExcel");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("content-disposition: attachment;filename=".$course_title.".xlx");

?>
<html>
<head>
<style type="text/css">
#disp:nth-of-type(odd)
{background:#F4F4F4;}
#disp:nth-of-type(even)
{background:#EDEBED;}
</style>
</head>
  <body>
     <center><b><h3>Blantyre International University</h3></b><p> Exam Attendance Registration Form <?php  if(checksem()==1) echo "January-June &nbsp;".date('Y');else  echo "July-December &nbsp;".date('Y');?></p></center>
  <b>Course Title: </b>  <?php echo  $rows['subject_title']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Course Code:</b> <?php echo  $rows['subject_code']; ?>&nbsp;&nbsp;&nbsp;<b>Venue:</b>_____________&nbsp;<b>Date:_____________</b><br />
 <b> Invigilators:</b><br />
  __________________         _____________     ___________________         __________________________<p>
  __________________         _____________     ___________________         __________________________</p>
  
  <p >Number Of Copies Okayed___________________________________________</p>
  <p>Number Of Copies With Issues:_______________________________________(Attach Report)</p>
   
  
     
     <table cellpadding="1" cellspacing="1" border='1' width="55%" >
                    
                                         
                                                
                                 <thead>
                                 <tr align="center" bgcolor="DDDDDD">
                               <th align="left">No</th>
                               <th>StudentID</th>
                              <th>Surname</th>
                              <th>Firstname</th>
                                <th>Exam Number</th>
                                  <th>Signature</th>
                                  <th>Tick</th>
                                  <th>Grade</th>
                                  
                                                                  
                   </tr>
                    </thead>
                        <tbody> 
                        
                           <!-- end script -->
                          
                           <?php include('registers.php')  ?>

                           
                          <!-- user delete modal -->
                            
                        </tbody>
                  </table>
 <p style="background-color:#DDD"> <b> Lecturer:</b>&nbsp;&nbsp;&nbsp;<?php echo $td['lastname'] ?>&nbsp;&nbsp;&nbsp;<?php echo $td['firstname'] ?>&nbsp;&nbsp;&nbsp;<b>Phone:</b>&nbsp;&nbsp;&nbsp;<?php echo $td['pno'] ?></p>
  </body>
</html>
<?php

  exit; // end of word output
}
?>
