<?php
include('header.php');
include ('session.php');
include ('admin/functions.php');
if(isset($_POST['adds']))
{
$y= $_POST['year'];
$s=$_POST['sem'];
$subj=$_POST['sub'];
$user=$_POST['user'];

    

$x=mysqli_query($conn,"select * from teacher_student where uid='$user' and subject_id='$subj' and year='$y' and semester='$s'") or die(mysqli_error($conn));
if(mysqli_num_rows($x)>0)
$msq="student already registered on this subject";
else
{
 /* $number_query = mysqli_query($conn,"select * from teacher_student where uid='$user' and semester='$s' and year='$y'") or die(mysqli_error($conn));
$count = mysqli_num_rows($number_query);
if($count >=$max)
{
$msq="Sorry the student has reached maxmum number of subjects per semester(".$max.")";
}
else
{ */

$td = mysqli_query($conn,"select * from subject where subject_id='$subj'") or die(mysqli_error($conn));	
$find=mysqli_fetch_assoc($td);
$ccode=$find['subject_code'];
$subt=$find['teacher_id'];
$td1 = mysqli_query($conn,"select distinct stud_year,studsem from results where uid='$user' and year='$y' and sem='$s' ") or die(mysqli_error($conn));
$thensem=mysqli_fetch_assoc($td1);
$yoursem=$thensem['studsem'];
$tyear=$thensem['stud_year'];
$td2 = mysqli_query($conn,"select * from student where id='$user'") or die(mysqli_error($conn));	
$find2=mysqli_fetch_assoc($td2);
$fn=$find2['firstname'];
$ln=$find2['lastname'];
$sid=$find2['student_id'];
$csm=$find2['current_sem'];
$prog=$find2['cys'];
$mode=$find2['mode'];
$dept=$find2['dept'];
$yy=$find2['stud_current_year'];
if($yoursem==0) $subsem=$csm;else  $subsem=$yoursem;
if($tyear==0) $cyear=$yy-1;else  $cyear=$tyear;
mysqli_query($conn,"insert into teacher_student(teacher_id,year,semester,subject_id,uid) values('$subt','$y','$s','$subj','$user')") or die(mysqli_error($conn));
mysqli_query($conn,"insert into results(mode,prog,stud_year,dept,studsem,student_id,firstname,surname,sem,year,course_code,uid) values('$mode','$prog','$cyear','$dept','$subsem','$sid','$fn','$ln','$s','$y','$ccode','$user')") or die(mysqli_error($conn));
$msq="Action Succeeded";
}
}
//}
$subjects = mysqli_query($conn,"select * from subject where teacher_id='$session_id' and category='0'") or die(mysqli_error($conn));
?>
<body onLoad="StartTimers(;" onmousemove="ResetTimers(;">

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
                
							while($row3 = mysqli_fetch_array($subjects)){
							?>
							<li> <a href="grades.php<?php echo '?id='.$row3['subject_id']; ?>" > <?php echo $row3['subject_title'];?></a></li>
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
                                <?php }

                                        ?>                                 



							
								
                               
                               
                                 <form action="" method="post">
								 
								  <div class="search-boxs" style="float:left; margin-left:10px">
        <input name="sub" type="text" autocomplete="off" placeholder="Search subject by name..." />
        <div class="results"></div>
    </div>
								 
								 
								   <div class="search-box2" style="float:left; margin-left:10px">
        <input id="ls_query" name="user" type="text" autocomplete="off" placeholder="Search student by surname..." />
        <div class="result2"></div>
    </div>
                         
                                              
                                        
                                        
                                        
                                        <select  name="year"  style="width:140px">
                                        <option value="">academic year</option>
                                        <?php $r=mysqli_query($conn,"select distinct year from results where year<>0") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>
                                            
                                       <select name="sem"  required style="width:140px">
                                            <option value="">Semester </option>
                                             <option value="1">Jan-June </option>
                                              <option value="2">July-Dec </option>
                                               
                                            </select>
										
                                      
                                            
                                            <button type="submit" class="btn btn-success" name="adds" style="margin-top:-12px"><li class="icon-plus icon-large"></li>&nbsp;Add</button>
                                           
                                       
										 </form>
                </div>

            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
</div>
</div>






</body>
</html>


