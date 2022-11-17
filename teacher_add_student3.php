<?php
include('header.php');
include ('session.php');
include ('admin/functions.php');
$coursno = mysqli_query($conn,"select * from maxcourse_no") or die(mysqli_error($conn));
$no = mysqli_fetch_array($coursno);
$max=$no['max_No'];
$user_query = mysqli_query($conn,"select * from teacher where teacher_id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
$subjects = mysqli_query($conn,"select * from subject where teacher_id='$session_id'") or die(mysqli_error($conn));
if(isset($_POST['adds']))
{
	
$y= date('Y');
$s=checksem();
$subj=$_POST['subj'];
$user=$_POST['student'];
updyearandsem($user);
repeat($user);
$x=mysqli_query($conn,"select * from teacher_student where uid='$user' and subject_id='$subj' and year='$y' and semester='$s'") or die(mysqli_error($conn));
if(mysqli_num_rows($x)>0)
$msq="student already registered on this subject";
else
{
 $number_query = mysqli_query($conn,"select * from teacher_student where uid='$user' and semester='$s' and year='$y'") or die(mysqli_error($conn));
$count = mysqli_num_rows($number_query);


mysqli_query($conn,"insert into teacher_student(teacher_id,year,semester,subject_id,uid) values('$session_id','$y','$s','$subj','$user')") or die(mysqli_error($conn));
$msq="Action Succeeded";

}
}

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
                            <a href="teacher_home.php"><i class="icon-home icon-large"></i>&nbsp;Home
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>

                        </li>
                        
                          <li>
                            <a href="reports.php"><i class="icon-list-alt icon-large"></i>&nbsp;Exam reports
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>                
                        <li>
                            <a href="teacher_class.php"><i class="icon-group icon-large"></i>&nbsp;Modify past results
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
                              <li>
                            <a href="uploaded.php"><i class="icon-upload-alt icon-large"></i>&nbsp;Upload grades
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
                              <li class="dropdown active" >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt icon-large"></i>&nbsp;Grades Entry
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>
                            <ul class="dropdown-menu" style="margin-left:103%; margin-top:-15%;">
                            <?php
							$q=mysqli_query($conn,"select * from subject where subject_id ='$_GET[subid]'") or die(mysqli_error($conn));
							$subi=mysqli_fetch_assoc($q);
							  if(mysqli_num_rows($subjects)==0){ echo "No subjects Yet";}
					        $id=$_COOKIE['id'];		
$user=mysqli_query($conn,"select * from teacher where  teacher_id='$id'") or die("here".mysqli_error($conn));
$us=mysqli_fetch_array($user);
                
							while($row = mysqli_fetch_array($subjects)){
							?>
							<li> <a href="grades.php<?php echo '?id='.$row['subject_id']; ?>" > <?php echo $row['subject_title'];?></a></li>
                           
                             <?php
					           }
							?>
                            </ul>
                            </li>
                            
                            <li><a href="teacher_subject.php"><i class="icon-file-alt icon-large"></i>&nbsp;Subjects
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>

<li><a href="students.php"><i class="icon-group icon-large"></i>&nbsp;Students
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
								<li>
                            <a href="x.php"><i class="icon-upload-alt icon-large"></i>&nbsp;Setting
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
                <div class="hero-unit-3" >
                  
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Add Students to <font color="green"><?php echo $subi['subject_title'] ?></font>&nbsp;Subject</strong>
                                </div>
                                <?php if(isset($msq)){?>
                                 <div class="alert alert-info" >
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-plus icon-large"></i>&nbsp;<font color="red"><?php echo $msq?></font>&nbsp;</strong>
                                </div>
                                <?php } ?>
                                 <div>
                               
                                 
                                </div>
                               
                               
                                 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" style="font-size:10pt">
                                <thead>
                                    <tr>

                                        <th>StudentID</th>
                                        <th>Lastname</th>
                                        <th>Firstname</th>
                                        <th>Phone</th>
                                        
                                        <th>Gender</th>
                                        <th>Program</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									//if(isset($_POST['users'])){
									//$q=$_POST['users'];
//if($q=='1x'){$query = mysqli_query($conn,"select * from student") or die(mysqli_error($conn));} else{
                                    $query = mysqli_query($conn,"select * from student where category='0'") or die(mysqli_error($conn));
//}
									 //repeat($q);
                                    while ($row = mysqli_fetch_array($query)) {
                                        $student_id = $row['student_id'];
										$id=$row['id'];
										$p=$row['cys'];
										$query2 = mysqli_query($conn,"select * from course where course_id='$p'") or die(mysqli_error($conn));
										$pro=mysqli_fetch_array($query2);
                                        ?>                                 
                                   
                                     <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                
                                            $('#a<?php echo $id; ?>').tooltip('show')
                                            $('#a<?php echo $id; ?>').tooltip('hide')
											
                                        });
                                    </script>
                                    <!-- end script -->
                                     <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                
                                            $('#m<?php echo $id; ?>').tooltip('show')
                                            $('#m<?php echo $id; ?>').tooltip('hide')
											
                                        });
                                    </script>
                                    <!-- end script -->

                                    <tr class="odd gradeX">
                                        <td><?php echo $row['student_id']; ?></td>
                                        <td><?php echo $row['lastname'] ; ?></td> 
                                        <td><?php echo $row['firstname'] ; ?></td> 
                                          <td><?php echo $row['stud_pnone'] ?></td>
                                      
                                          <td><?php echo $row['gender']; ?></td> 
                                       
                                        <td><?php echo $p; ?></td> 
                     
                                        <td >
                                            
                                            
                                           
                                           <a rel="tooltip"  title="Add courses" id="a<?php echo $id; ?>" href="#add<?php echo $id; ?>" class="btn btn-success" role="button"  data-toggle="modal" ><i class="icon-large"></i><i class="icon-plus-sign-alt icon-large"></i></a>
                                           
                                        </td>
                                             
                                        <!-- user delete modal -->
                                    <div id="add<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Are you Sure you Want to <strong>Add</strong>&nbsp; <font color="green"><?php echo  $row['lastname']."&nbsp;".$row['firstname'] ?></font>&nbsp;To &nbsp;<font color="#333333"><?php echo $subi['subject_title']  ?></font>?</div>
                                        </div>
                                        <div class="modal-footer">
                                            
                                            <form action="" method="post">
                                            <input type="hidden" value="<?php echo $id  ?>" name="student">
                                             <input type="hidden" value="<?php echo $_GET['subid'];  ?>" name="subj">
                                             <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                            <button type="submit" class="btn btn-success" name="adds"><li class="icon-plus icon-large"></li>&nbsp;Add</button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    </tr>
                                <?php } //}?>
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


