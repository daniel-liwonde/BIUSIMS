<?php
include('session.php');
include('header.php');
include ('admin/functions.php');          
$user_query = mysqli_query($conn,"select * from student where id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
if(isset($_POST['remove']))
						   { 
						   $uid= $_POST['uid'];
						    $s= $_POST['sem'];
							 $y= $_POST['year'];
							  $subid= $_POST['subid'];
						   mysqli_query($conn,"delete from teacher_student where subject_id='$subid' and uid='$uid' and year='$y' and semester='$s'" );
						   }
?>
<body>
    <?php include('navhead_student.php'); ?>
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
                <div class="hero-unit-1" >
                    <ul class="nav  nav-pills nav-stacked" >
                        <li class="nav-header">Links</li>
                        <li   class="active">
                            <a href="student_home.php"><i class="icon-home icon-large"></i>&nbsp;Home
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>

                        </li>
                        <li>
                            <a href="student_details.php"><i class="icon-book icon-large"></i>&nbsp;My Details
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>     
          <?php if(check_publication()==1 ){
               if(checkPayment($session_id)==1){
                            ?>
                                <li>
                            <a href="register.php?id=<?php echo $session_id; ?>"><i class="icon-pencil icon-large"></i>&nbsp;Register Courses
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <?php
                             }
                             else
                             {
                            ?>
                            <li>
                            <a href="#myModal2" role="button"  data-toggle="modal"><i class="icon-pencil icon-large"></i>&nbsp;Register Courses
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <?php
                             }
                            ?>
                            
							<li>
							
                            <a href="carry.php"><i class="icon-repeat icon-large"></i>&nbsp;My Carryovers
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <?php }?>
 <li>
                            <a href="notifications.php"><i class="icon-bell-alt icon-large"></i>&nbsp;Notifications
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                    </ul>
                </div>

            </div>

            <div class="span9">
<div class="hero-unit-3">
<?php
$student=$_GET['id'];
updyearandsem($student);
?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php echo $student_row['firstname'];?></strong>&nbsp;Welcome. <span class="pull-right">Programme:<?php echo $_COOKIE['pro'];?> ,Current year:<?php echo $_COOKIE['year'];?>, Semester:<?php echo $_COOKIE['ssem'];?></span>
                </div>
                <div class="slider-wrapper theme-default">

 <table  width="100%" class="table-striped">
  <?php display_carry_overs($student);?>
  </table>
 
				<?php
                   
                            $student = $_GET['id'];
							 $sem= checksem();
							 $year       = date('Y');
                             $student_subject = mysqli_query($conn,"select * from teacher_student where uid='$student' and year='$year' and semester='$sem'");
							if(mysqli_num_rows($student_subject)>0){ ?>
 <div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 Course List list
    
 <table width="100%"class="table-striped">
 
 <tr bgcolor="#999999">
                          <th>No</th>  <th>Code</th><th>subject title</th><th>Teacher</th> <th>Status</th><th>Action</th></tr>
                            <?php
							$i=1;
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
                            <td><?php echo  $i ?></td><td><?php echo  $subcode ?></td><td><?php  echo $subtitle ?></td><td><?php echo $teacher_details['lastname'] ?></td><td><?php if($repeated==0) echo"<font color='green'>New</>"; else echo "Carryover" ?>                             </td><td width="40">
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
							$i++;
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
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                   <i class="icon icon-remove-sign"></i>&nbsp;Sorry! you have reached maxmum number of courses per semester
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
                </div>
				</div>
                <!-- end slider -->
            </div>

        </div>
		</div>
       
    </div>
	 
</div>
</div>

</body>
</html>


