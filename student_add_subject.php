<?php
include('header.php');
include('session.php');
include('functions.php');
if(isset($_POST['remove']))
						   { 
						   $uid= $_POST['uid'];
						    $s= $_POST['sem'];
							 $y= $_POST['year'];
							  $subid= $_POST['subid'];
						   mysqli_query($conn,"delete from teacher_student where subject_id='$subid' and uid='$uid' and year='$y' and semester='$s'" );
						   }
				
?>
<body onLoad="StartTimers();" onmousemove="ResetTimers();">

    <?php include('navbar.php'); ?>

    <div class="container">
        <div class="row-fluid">
            <div class="span3" style="width:11%;visibility:hidden;" >
                <div class="hero-unit-3" >
                 
                </div>
                </div>
                             <div class="span9" style="width:98%; margin-top:-50px;">
                             <a href="student.php" class="btn btn-success"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a>
                             <p>
                <div class="hero-unit-3">
                
                <?php     
				
				
				           if(isset( $_GET['id'])){
						      $cyear=date('Y');
							 $student = $_GET['id'];
							 $ss=checksem();
							 //$g=false;
							 $m = mysqli_query($conn,"select * from student where id='$student'");
							 $r=mysqli_fetch_array($m);
							 $entry_sem=$r['sem'];
							// $current_sem=$r['current_sem'];
							 $system_sem=$r['system_sem'];
							 $studcurrentyear=$r['stud_current_year'];
							 $sy= $studcurrentyear;
							 $updated_year=$r['update_year'];
							 $program=$r['cys'];
							 $current_ss=$r['current_sem'];
							if(($ss==$system_sem) &&  ($updated_year!=$cyear)){ 
							//if(($ss==1)&&  ($updated_year!=$cyear)){
							 $studcurrentyear=$studcurrentyear+1;
							  if(($program=='BLW')&& ($studcurrentyear>5))$studcurrentyear=5; 
							 if(($studcurrentyear>4)&& ($program!='BLW'))$studcurrentyear=4;
							 mysqli_query($conn,"update student set stud_current_year='$studcurrentyear', update_year='$cyear' where id='$student'");
							 } //}
							
							/* if(($system_sem==2) && ($updated_year!=$cyear)){ 
							 if($ss==2){
							 $studcurrentyear=$studcurrentyear+1;
							 if(($program=='BLW')&& ($studcurrentyear>5)){$studcurrentyear=5;}
							 if(($studcurrentyear>4)&& ($program!='BLW')){$studcurrentyear=4;}
							  mysqli_query($conn,"update student set stud_current_year='$studcurrentyear', update_year='$cyear' where id='$student'");
							 }}*/
							 
						     if($entry_sem == $system_sem)
							   $current_sem=checksem();
							   else{
							  if(checksem()==2)
							  $current_sem=1;
							 else
							 $current_sem=2;
							 }
							 if((($sy==4)&&($current_ss==2) && ($program!='BLW'))|| (($sy==5)&&($current_ss==2) && ( $program=='BLW')))
							  $current_sem=2;
							 mysqli_query($conn,"update student set current_sem='$current_sem' where id='$student'");
							 }
							  $cv= mysqli_query($conn,"select * from results where uid='$student' and comment='F' and repeated='0'");
							  $get=mysqli_fetch_array($cv);
							  if($get['sem']!=checksem()){
                             $repeat_courses = mysqli_query($conn,"select * from results where uid='$student' and comment='F' and repeated='0'");
							if(mysqli_num_rows($repeat_courses)>0){
                         
						    ?>
 <div class="alert alert-danger">
  
 It shows that you are repeating the following subjects and                        will be added to your course list for this semester
 <table border="1" width="90%">
                            <tr bgcolor="#999999">
                            <th>Subject code</th><th>subject title</th><th> Failed in</th> <th>semester</th></tr>
                            <?php
							$sem= checksem();
							$year       = date('Y');
                           while($courses = mysqli_fetch_array($repeat_courses)){
						   $co_code=$courses['course_code'];
						   $subjects = mysqli_query($conn,"select * from subject where subject_code= '$co_code'");
						   $subject=mysqli_fetch_array($subjects);
						   $subid= $subject['subject_id'];
						   $teacher=$subject['teacher_id'];
						   $id=$courses['uid'];
						   $y=$courses['year'];
						   $s=$courses['sem'];
						   mysqli_query($conn,"insert into teacher_student(teacher_id,uid,year,semester,subject_id,being_repeated) values('$teacher','$id','$year','$sem','$subid','1')") or die(mysql_error($conn));
						  
							mysqli_query($conn,"update results set repeated='1' where uid='$id' and sem='$s' and year='$y' and course_code='$co_code'");
						
						
							?>
                            
                            <tr>
                            <td><?php echo $co_code ?></td><td><?php  echo $subject['subject_title']; ?></td><td><?php echo $y; ?></td><td><?php echo $s; ?></td>
                            </tr>
                            <?php
                            }
                           ?> 
                           </table>
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <br>
                           </div>  
                           </td></tr>
                           <?php
						     }
							  }
                            $student = $_GET['id'];
							 $sem= checksem();
							 $year       = date('Y');
                             $student_subject = mysqli_query($conn,"select * from teacher_student where uid='$student' and year='$year' and semester='$sem'");
							if(mysqli_num_rows($student_subject)>0){ ?>
 <div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 Subject list
    
 <table border="1" width="100%">
 
 <tr bgcolor="#999999">
                            <th>Subject code</th><th>subject title</th><th>Teacher</th> <th>Department</th><th>Action</th></tr>
                            <?php
                           while($subject_details = mysqli_fetch_array($student_subject)){
						   $teacher_id=$subject_details['teacher_id'];
						   $subject_id=$subject_details['subject_id'];
						    $repeated=$subject_details['being_repeated'];
						   $uid= $subject_details['uid'];
						  
						   $subect_teacher = mysqli_query($conn,"select * from teacher where teacher_id= $teacher_id");
						   $teacher_details=mysqli_fetch_array($subect_teacher);
						   $subjects = mysqli_query($conn,"select * from subject where subject_id=$subject_id");
						   $subject_details=mysqli_fetch_array($subjects);
						   $dep= $subject_details['Dept'];
						  $depart = mysqli_query($conn,"select * from department where dep_id= '$dep'");
						  $depts=mysqli_fetch_array($depart);
						   $subcode=  $subject_details['subject_code'];
						   $subtitle= $subject_details['subject_title'];						
							?>
                            <tr>
                            <td><?php echo  $subcode ?></td><td><?php  echo $subtitle ?></td><td><?php echo $teacher_details['lastname'] ?></td><td><?php echo $depts['department'] ?>                             </td><td width="40">
                          <?php  if($repeated==0){?>
                          <form method="post" action="">
                            <input type="hidden" value="<?php  echo  $uid ?>" name="uid" >
                             <input type="hidden" value="<?php  echo  $sem ?>" name="sem" >
                              <input type="hidden" value="<?php  echo  $year ?>" name="year" >
                              <input type="hidden" value="<?php  echo  $subject_id ?>" name="subid" >
                            <button type="submit" name="remove" class="btn btn-danger" title="Remove"><i class="icon-trash icon-large"></i></button>
                             </form>
                            <?php }?>
                            </td></tr>
                            <?php
                            }
                           ?> 
                           </table>
                          
                         
                           </div>
                           <?php
						   }
						    $did=$_GET['id'];
						   $se=mysqli_query($conn,"select * from student where id='$did'");
						   $n=mysqli_fetch_array( $se);
                            ?>                        
               
                
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Add subjects  &nbsp <span style="text-decoration:blink"><?php echo $n['firstname']."&nbsp;".$n['lastname'] ?>&nbsp;&nbsp; Year:<?php echo $n['stud_current_year']?>&nbsp;&nbsp; Sem:<?php echo $n['current_sem']?></span>
                        </div>
                        <thead>
                            <tr>

                                <th width="100" >Subject code</th>
                                <th>Subject title</th>
                                <th>Current teacher</th>
                                 <th>Department</th>
                                  <th>Offered Year</th>
                                   <th>Offered Sem</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							 $id = $_GET['id'];
							$coursno = mysqli_query($conn,"select * from maxcourse_no");
                            $no = mysqli_fetch_array($coursno);
							$max=$no['max_No'];
                            $query = mysqli_query($conn,"select * from subject");
                            while ($row = mysqli_fetch_array($query)) {
                                $subject_id = $row['subject_id'];
								$dept=$row['Dept'];
								$teacher=$row['teacher_id'];
						        $query_dept = mysqli_query($conn,"select * from department where dep_id='$dept'");
                                $dep = mysqli_fetch_array($query_dept);
								$query_teacher = mysqli_query($conn,"select * from teacher where teacher_id='$teacher'");
                                $current_teacher = mysqli_fetch_array($query_teacher);
								$disp = mysqli_query($conn,"select * from teacher_student where uid='$id' and subject_id='$subject_id'");
                                ?>

                                   <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                
                                            $('#a<?php echo $subject_id; ?>').tooltip('show')
                                            $('#a<?php echo $subject_id; ?>').tooltip('hide')
                                        });
                                    </script>
                                    <!-- end script -->

                                 <?php if(mysqli_num_rows($disp)==0){?>
                                <tr class="odd gradeX" id="x">
                                    <td width="50"><?php echo $row['subject_code']; ?></td>
                                    <td><?php echo $row['subject_title'] ?></td> 
                                     <td><?php echo $current_teacher['lastname']." ".$current_teacher['firstname']; ?></td>
                                     <td><?php echo $dep['department']; ?></td>
                                       <td><?php echo $row['offered_year']; ?></td>
                                        <td><?php echo $row['offered_sem']; ?></td>
                                    <td>
                                   
                 <a rel="tooltip" title="Add subject" id="a<?php echo $subject_id; ?>" href="#subject_id<?php echo $subject_id; ?>" role="button"  data-toggle="modal" class="btn btn-info"><i class="icon-plus-sign-alt icon-large"></i></a>
                           <?php } ?>
                                    </td>
                                    <!-- user delete modal -->
                            <div id="subject_id<?php echo $subject_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-info">Are you Sure you Want to <strong>Add</strong>&nbsp;<?php echo $row['subject_title']; ?>?</div>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="">
                                      <input type="hidden" name="teacher_id" value="<?php echo $teacher; ?>">
                                      
                                        <input type="hidden" name="sub" value="<?php echo $row['subject_title'];?>">
                                        <input type="hidden" name="sub_id" value="<?php echo $row['subject_id'];?>">
                                       <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                        <button name="save1"  class="btn btn-info"><i class="icon-plus icon-large"></i>&nbsp;Add</button>
                                    </form>
                                </div>
                            </div>
                            <!-- end delete modal -->

                            </tr>
                        <?php } ?>
                        <?php
                        if (isset($_POST['save1'])) {
                            $teacher_id = $_POST['teacher_id'];
                            $student = $_GET['id'];
                     		$year       = date('Y');
							$sub        = $_POST['sub'];
							$subject=   $_POST['sub_id'];
							$sem= checksem();
                            $sel=mysqli_query($conn,"select* from subject where subject_id='$subject'");
$fetc=mysqli_fetch_array($sel);


                            $number_query = mysqli_query($conn,"select * from teacher_student where uid='$student' and semester='$sem' and year='$year'");
                            $total = mysqli_fetch_array($number_query);
                            $count = mysqli_num_rows($number_query);
                            if ($count >= $max) {
                                ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    Student has reached maxmum number of subjects per semester
                                </div>
                                <?php
                            } else {
							
							$subj = mysqli_query($conn,"select * from teacher_student where uid='$student' and  subject_id='$subject'");
                                 $total = mysqli_num_rows($subj);
								  if ($total > 0) {
                                ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <font color="green"><?php echo $fetc['subject_title'] ;?></font> &nbsp;already assigned
                                </div>
                                <?php
                            } else {
							
                                mysqli_query($conn,"insert into teacher_student(teacher_id,uid,year,semester,subject_id) values('$teacher_id','$student','$year','$sem','$subject')") or die(mysqli_error($conn));
								
                                ?>
                               <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                     <font color="green"><?php echo $fetc['subject_title'] ;?></font> &nbsp;assigned
                                </div>
                                <?php
								
								
							  //header('location:student.php');
                            }
                        }
						}
                        ?>


                        </tbody>
                    </table>
                </div>




            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
</div>
</div>
</body>
</html>


