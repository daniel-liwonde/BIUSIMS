<?php
include('header.php');
include ('session.php');
include ('admin/functions.php');
$user_query = mysqli_query($conn,"select * from teacher where teacher_id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
if(isset($_GET['id']))
$sub=$_GET['id'];
$subjects = mysqli_query($conn,"select * from subject where teacher_id='$session_id' and category='0'") or die(mysqli_error($conn));
?>
<body>

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
                            <a href="teacher_home.php"><i class="icon-home icon-large"></i>&nbsp;Home<i class="icon-double-angle-right icon-large"></i>Undergraduate
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
                        <?php
						if(isset($_COOKIE['level'])){
                        $l=$_COOKIE['level'];
							 if(($l==2)||($l==1)||($l==9)){   ?>
                            <a href="teacher_class.php"><?php }else{?><a href="#" onClick="alert('ACCESS DENIED')"><?php }}?> <i class="icon-group icon-large"></i>&nbsp;Modify past results
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
							<li> <a href="grades.php<?php echo '?id='.$row['subject_id']; ?>" > <?php echo $row['subject_title'];?></a></li>
                             <?php
					           }
							?>
                            <li>
                            <a href="teacher_home_master.php"> Masters</a></li>
                            </ul>
                            </li>
                            
                            <li><a href="teacher_subject.php"><i class="icon-file-alt icon-large"></i>&nbsp;Subjects
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>

<li class="active"><a href="students.php"><i class="icon-group icon-large"></i>&nbsp;Students
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



               
                

                <div class="hero-unit-3">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Students Table</strong>
                        </div>
                        <thead>
                            <tr>
                                 <th>Student ID</th>
                                <th>Student Names</th>
                                <th>Programme</th>
                                <th>Phone</th>
                                 <th>Email</th>
                                  <th>Study mode</th>
                                  <th>Year</th>
                                   <th>Sem</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$year= date('Y');
							$sem=checksem();
                            $query = mysqli_query($conn,"select distinct uid from teacher_student where teacher_id = '$session_id' and year='$year' and semester='$sem'") or die(mysqli_error($conn));
                            while ($row = mysqli_fetch_array($query)) {
                                $student_id = $row['uid'];
								
								
								$t=mysqli_query($conn,"select distinct semester from teacher_student where uid='$student_id'") or die(mysqli_error($conn));
								$s=mysqli_fetch_array($t);
                                $student_query = mysqli_query($conn,"select * from student where id='$student_id'") or die(mysqli_error($conn));
                                $student_row = mysqli_fetch_array($student_query);
								$id=$student_row['id'];
								
                                ?>



                                <tr class="odd gradeX">                         
                             <td><?php echo $student_row['student_id']?> </td> 
                            <td><?php echo $student_row['firstname'] . " " . $student_row['middle_name'] . " " . $student_row['lastname']; ?></td>
                            <td><?php echo  $student_row['cys']; ?></td>
                            <td><?php echo  $student_row['stud_pnone']; ?></td>
                              <td><?php echo  $student_row['stud_email']; ?></td>
                            <td><?php if($student_row['mode']==1)echo "F" ;if($student_row['mode']==2) echo "D"; ?></td>
                             <td><?php echo  $student_row['stud_current_year']; ?></td>
                            <td> <?php echo  $student_row['current_sem']; ?></td>
                            
                            

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <a href="mail2.php">send email</a>
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


