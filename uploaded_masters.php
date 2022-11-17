<?php
include('header.php');
include('admin/functions.php');
include ('session.php');
$user_query = mysqli_query($conn,"select * from teacher where teacher_id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
 
//$course_row = mysqli_fetch_array($course_query);
//$get_id = $_GET['id'];
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
if(isset($_POST['Upload'])){// if isset open
if ($_FILES["d"]["error"] > 0) {//open
$msg= "Return Code: " . $_FILES["d"]["error"] . "<br />";
}//closed
else { //open second
if (file_exists($_FILES["d"]["name"])) {//open
unlink($_FILES["d"]["name"]);
} //closed
$filename = basename($_FILES['d']['name']);
$newname = "exam/". $filename;
if (file_exists($newname)) { //open
$msg="file already exist in the directory";
}//closed
else{ // open no file in direc
//Attempt to move the uploaded file to it's new place
if ((move_uploaded_file($_FILES['d']['tmp_name'], $newname))) {//open if uploaded
$inputFileName = $newname;
try { //open
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
}//closed
catch(Exception $e) {//open
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}//closed


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


for($i=7;$i<=$arrayCount;$i++){ //open for
$fn = clean($conn,trim($allDataInSheet[$i]["C"]));
$ln =  clean($conn,trim($allDataInSheet[$i]["B"]));
$reg =  clean($conn,trim($allDataInSheet[$i]["F"]));
$ass1 =  clean($conn,trim($allDataInSheet[$i]["J"]));
$ass2 =  clean($conn,trim($allDataInSheet[$i]["K"]));
$eos = clean($conn, trim($allDataInSheet[$i]["L"]));
$fgrade=  clean($conn,trim($allDataInSheet[$i]["M"]));
$comment =  clean($conn,trim($allDataInSheet[$i]["N"]));
$code =  clean($conn,trim($allDataInSheet[2]["C"]));
$year=  clean($conn,trim($allDataInSheet[4]["C"]));
$s=mysqli_query($conn,"select * from student where student_id='".$reg."'") or die(mysqli_error($conn));
if(mysqli_num_rows($s)==0)
{
$msg="some students are no registerd we can not proceed";
?>
<script type="application/javascript">
alert("results uploaded except for unregistered students");
window.back()
</script>
<?php
exit();
}
else
{
$sutudent_details=mysqli_fetch_array($s);
$myquery = mysqli_query($conn,"select * from subject where subject_code='".$code."'") or die(mysqli_error($conn));
$stud= mysqli_fetch_array($myquery);
$dep=$stud['Dept'];
$studyear=$stud['offered_year'];
$sem=$stud['offered_sem'];
$prog=$stud['prog'];
$sub=$stud['subject_title'];
$depquery = mysqli_query($conn,"select * from department where dep_id='$dep'") or die(mysqli_error($conn));
$f=mysqli_fetch_array($depquery);
$dept=$f['title'];
$rep=0;
$uid=$sutudent_details['id'];
$mode=$sutudent_details['mode'];
$query = mysqli_query($conn,"SELECT * from results WHERE student_id='".$reg."' and course_code = '".$code."' and year = '$year' and sem = '$sem'");
$recResult = mysqli_num_rows($query);
if($recResult>=1) { //open
?>
<script type="application/javascript">
alert("Results already uploaded");
window.back()
</script>
<?php
exit();
}//closed
else
{//open
if($comment=='F')
{
$sel=mysqli_query($conn,"select* from results where uid='$uid' and course_code='".$code."' and comment<>'F'")or die(mysqli_error($conn));
if(mysqli_num_rows($sel)==0) $rep=0;else $rep=1;
}
$insertTable= mysqli_query($conn,"insert into results(firstname,surname,student_id,stud_year, assign_1,assign_2,EOS,fgrade,comment,course_code,year,sem,mode,prog,uid,dept,studsem,repeated) values('".$fn."','".$ln."','".$reg."','$studyear', '".$ass1."','".$ass2."','".$eos."','".$fgrade."','".$comment."','".$code."','$year','$sem','$mode','$prog','$uid','$dept','$sem','$rep')") or die(mysqli_error($conn));
}//closed
}//close for
$msg = $sub.'Results uploaded. ';
}
}//close if uploaded
else
{
$msg="upload failed";
}
}//close no file in direc
}//close second
}//if isset closed
$subjects = mysqli_query($conn,"select * from subject where teacher_id='$session_id' and category='1'") or die(mysqli_error($conn));
?>

<body onLoad="StartTimers();" onmousemove="ResetTimers();">

    <?php include('navhead_user.php'); ?>

    <div class="container">
        <div class="row-fluid">
            <div class="span3">
                <div class="hero-unit-3">
                    <div class="alert-index alert-success">
                        <i class="icon-calendar icon-large"></i>
                        <?php
                        $Today = date('y:m:d');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                    </div>
                </div>
                <div class="hero-unit-1">
                    <ul class="nav  nav-pills nav-stacked">
                       <li class="nav-header">Links</li>
                        <li>
                            <a href="teacher_home_master.php"><i class="icon-home icon-large"></i>&nbsp;Home<i class="icon-double-angle-right icon-large"></i>Masters
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>

                        </li>
                        
                          <li>
                            <a href="reports_masters.php"><i class="icon-list-alt icon-large"></i>&nbsp;Exam reports
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>                
                        <li>
                        
						
                           <?php 
						   $ll=$_COOKIE['level'];
						   if($ll==1 or $ll==2){?> <a href="teacher_class.php"><?php }else{ ?> <a href="#" onClick="alert('ACCESS DENIED')"><?php  }?> <i class="icon-group icon-large"></i>&nbsp;Modify past results
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
                              <li class="active">
                            <a href="uploaded_masters.php"><i class="icon-upload-alt icon-large"></i>&nbsp;Upload grades
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
                              <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt icon-large"></i>&nbsp;Grades Entry
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>
                            <ul class="dropdown-menu" style="margin-left:103%; margin-top:-15%;">
                            <?php
							 if(mysqli_num_rows($subjects)==0){ echo "No subjects Yet";}
					        $id=$_COOKIE['id'];		
$user=mysqli_query($conn,"select * from teacher where  teacher_id='$id'") or die("here".mysqli_error($conn));
$us=mysqli_fetch_array($user);
                
							while($row = mysqli_fetch_array($subjects)){
							?>
							<li> <a href="grades_masters.php<?php echo '?id='.$row['subject_id']; ?>" > <?php echo $row['subject_title'];?></a></li>
                             <?php
					           }
							?>
                            <li><a href="teacher_home.php">Undergraduate</a></li>
                            </ul>
                            </li>
                            
                            <li><a href="teacher_subject_masters.php"><i class="icon-file-alt icon-large"></i>&nbsp;Subjects
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>

<li><a href="students_masters.php"><i class="icon-group icon-large"></i>&nbsp;Students
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
                                <li>
                            <a href="#a"  data-toggle="modal" ><i class="icon-group icon-large"></i>&nbsp;Update account 
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a> </li>
                            <!-- user delete modal -->
                                    <div id="a" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <form class="form-horizontal" method="post">
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Update password</div>
                                            
                                            
                                             
                                              Password:<input type="text" name="pass" id="inputEmail"  value="<?php echo $us['password'] ?>" required>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                            <button type="submit" name="go" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Update</button>
                                        </div>
                                    </div>
                                     </form>
                                    <!-- end delete modal --> 
                                     <?php include('update.php');  ?>
                                <li>
                               <?php 
							if(isset($_COOKIE['level'])){
							$l=$_COOKIE['level'];
							 if(($l==2)||($l==3) ||($l==1)){   ?>
                            <a href="admin/home.php"><i class="icon-group icon-large"></i>&nbsp;Administration
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <?php  }} ?>
                    


                    </ul>
                </div>

            </div>
            <div class="span9">
                <a href="reports_masters.php" class="btn btn-success"><i class="icon-list icon-large"></i>&nbsp;Results Reports</a>
                <a href="examuploadtemp_masters.xlsx" class="btn btn-success"><i class="icon-list icon-large"></i>&nbsp;Download Upload Template</a>
                <br><br>
                <div class="alert alert-info"> 
                    <strong>All Subjects&nbsp;</strong>
                </div>


                <div class="hero-unit-3">
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="icon-upload-alt icon-large"></i>&nbsp;Upload A File</strong>
                    </div>


                    <form class="form-horizontal" action=" " method="post" enctype="multipart/form-data" >
                        <div class="control-group">
                            <label class="control-label" for="inputEmail">File</label>
                            <div class="controls">
                               <input type="file" name="d" class="input-xlarge" required> 
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">

                                <button name="Upload" type="submit" value="Upload" class="btn" /><i class="icon-upload-alt"></i>&nbsp;Upload</button>
                                <br><br>
                                 <?php if(isset($msg)){?>
                
                    
                                    <div class="alert alert-info" style="margin-left:-120px;"><strong style="color:#FF0000" ><?php echo $msg; ?></strong>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                               
                                   <?php }?>
               
                            </div>
                        </div>
                    </form>
                    <!-- end slider -->
                </div>
            </div>

        </div>
        <?php include('footer.php'); ?>
    </div>
</div>
</div>






</body>
</html>


