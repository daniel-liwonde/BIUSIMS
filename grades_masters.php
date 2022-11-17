<?php
include('header.php');
include ('session.php');
include('admin/functions.php');
$user_query = mysqli_query($conn,"select * from teacher where teacher_id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
//$sub=$_GET['id'];
$subjects = mysqli_query($conn,"select * from subject where teacher_id='$session_id' and category='1'") or die(mysqli_error($conn));
			
if(isset($_POST['del'])){	
$stid= $_POST['stud_id'];			
$st=mysqli_query($conn,"select * from student where id='$stid'") or die(mysqli_error($conn));
$ss=mysqli_fetch_array($st);
$sem=checksem();
$year=date('Y');
$stid= $_POST['stud_id'];
$code= $_POST['ccode'];
mysqli_query($conn,"delete from results where uid='$stid' and course_code='$code' and year='$year' and sem='$sem'")or die(mysqli_error($conn));
}
if(isset($_POST['del2'])){	
$stid= $_POST['stud_id'];			
$sem=checksem();
$year=date('Y');
$stid= $_POST['stud_id'];
$de= $_POST['subcode'];
$code= $_POST['ccode'];
mysqli_query($conn,"delete from teacher_student where uid='$stid' and subject_id='$de' and year='$year' and semester='$sem'")or die(mysqli_error($conn));
mysqli_query($conn,"delete from results where uid='$stid' and course_code='$code' and year='$year' and sem='$sem'")or die(mysqli_error($conn));
}
                           $subid=$_GET['id'];
						   $sem= checksem();
			               $year= date('Y');	
//repeat2();
?>
<style>
 .g{ width:40px}
.myass{ width:90px}
#msg{float:left;color:red;position:absolute;position:fixed;  margin-left:24%;margin-top:7px;}
</style>

<body onLoad="StartTimers();" onmousemove="ResetTimers();">

    <?php include('navhead_user.php'); ?>
<?php
$sels=mysqli_query($conn,"select * from agree");
$status=mysqli_fetch_array($sels);
if($status['x']==1 && $_COOKIE['id']!=5) {
 ?>
                                                                         
                                        <div class="alert alert-danger"><i class="icon-remove-sign"></i>&nbsp;ERR:7450XX  Please Consult the system admin</div>

                                        <?php
}
else
{
?>
    <div class="container">
        <div class="row-fluid">

            <div class="span3">
                <div class="hero-unit-3" style="margin-left:-70px; width:75%">
                    <div class="alert-index alert-success" >
                        <i class="icon-calendar icon-large" ></i>
                        <?php
                        $Today = date('y:m:d');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                    </div>
                </div>
                <div class="hero-unit-1" style="margin-left:-70px; width:84%">
                    <ul class="nav  nav-pills nav-stacked" >
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
						   if($ll==1 or $ll==2){?> <a href="teacher_class_masters.php"><?php }else{ ?> <a href="#" onClick="alert('ACCESS DENIED')"><?php }?> <i class="icon-group icon-large"></i>&nbsp;Modify past results
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
                              <li>
                            <a href="uploaded_masters.php"><i class="icon-upload-alt icon-large"></i>&nbsp;Upload grades
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
                              <li class="dropdown active">
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

                <?php if(isset($_COOKIE['ERR'])){?>
                
                    
                                    <div class="alert alert-info" style="margin-left:-120px;"><strong style="color:#FF0000" ><?php echo $_COOKIE['ERR']; unset($_COOKIE['ERR']); ?></strong>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    </div>
                               
                                   <?php }?>
               
                <div class="slider-wrapper theme-default">
                <div style="float:left">
                       <?php
					   $mys = mysqli_query($conn,"select * from teacher_student where teacher_id='$session_id' and subject_id='$subid' and year='$year' and semester='$sem'") or die(mysqli_error($conn));
					     if(mysqli_num_rows($mys)>0)
						 {
					   ?>   
					   
					   
					   
                   <a href="uploaded_masters.php" class="btn btn-success" style="margin-left:-120px;"><i class="icon-upload-alt icon-large"  ></i>&nbsp;Upload grades</a>&nbsp; 
                    
                
                </div>
                <div style=" margin-left:20%; margin-bottom:10px;">
                 <a href="teacher_add_student_masters.php?subid=<?php echo $_GET['id']; ?>" class="btn btn-success" style="margin-left:-120px;"><i class="icon-plus icon-large"  ></i>&nbsp;Add Student</a>         
                 <?php  } ?>
				</div>
						
                 <div class="hero-unit-3" style="width:120%; margin-left:-120px;">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            
                            <?php
$sub=$_GET['id'];
$sp = mysqli_query($conn,"select * from subject where subject_id='$sub'") or die(mysqli_error($conn));
$row=mysqli_fetch_array($sp);
$ccode=$row['subject_code'];	
$sp = mysqli_query($conn,"select * from subject where subject_id='$sub'") or die(mysqli_error($conn));
$rowsub=mysqli_fetch_array($sp);
$subj_id=$rowsub['subject_id'];
							?>
                            
                           
                            <strong><i class="icon-user icon-large"></i>&nbsp;&nbsp;<span style="text-decoration:blink; color:green"> <?php echo $rowsub['subject_title'];?></span>&nbsp;(<?php if(checksem()==1 )echo "Jan-June &nbsp;Sem&nbsp;". date('Y').")- Masters";else echo "July-Dec &nbsp;Sem&nbsp;". date('Y').")";  if((isset($sem3))||(isset($s1))|| (isset($s2)) || (isset($d))){ $a1=$s1-$d;$a2=$s2-$d;$a3=$sem3-$d; if($a1<1 )$a1=0;if($a2<1)$a2=0; if($a3<1)$a3=0;echo "&nbsp;&nbsp;Remaining days for grades entry Deadline&nbsp;&nbsp;<font color='red'>"; if($sem3==0) echo " ";else echo"EXAM:</font>". $a3."days&nbsp;";if($s1==0) echo " ";else echo"<font color='red'>ASSIGN#1:</font>".$a1."day(s)&nbsp;"; if($s2==0) echo " ";else echo"<font color='red'>ASSIGN#2:</font>".$a2."day(s)";}?></strong><div id="msg"></div>
                        <div id="msg"></div>
                        </div>
                        <thead>
                            <tr>

                                <th width="30">StudentID</th>
                                <th width="30">Firstname</th>
                                 <th width="30">Surname</th>
                                 <th  width="5">Ass1</th>
                                 <th width="10">Ass2</th>
                                 <th width="10">Exam</th>
                                 <th width="10">OAG</th>
                                  <th width="5">Grade</th>
                                 <th width="130">Assignment No</th>
                                 <th width="15">Mark</th>
                                  
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                         <tbody>
                        
                            <?php
						   
						   $sub=mysqli_query($conn,"select * from subject where subject_id='$subid'") or die(mysqli_error($conn));
						   $code=mysqli_fetch_array($sub);
						   $su= $code['subject_code'];
                           $subjects = mysqli_query($conn,"select * from teacher_student where teacher_id='$session_id'and subject_id='$subid' and year='$year' and semester='$sem'") or die(mysqli_error($conn));
                           while($row = mysqli_fetch_array($subjects)){
                           $students=$row['uid'];
                           $teacher_students = mysqli_query($conn,"select * from student where id='$students'") or die(mysqli_error($conn));
                           $student_row = mysqli_fetch_array($teacher_students);
                                   $id=$student_row['id'];
						   $results = mysqli_query($conn,"select * from results where uid='$id' and course_code='$su' and year='$year' and sem='$sem'") or die(mysqli_error($conn));
                           $result = mysqli_fetch_array($results);
						   $myid=  $student_row['student_id'];
						   $uid=$student_row['id'];
						    $cyear=$student_row['stud_current_year'];
							$dept=$student_row['dept'];
							$prog=$student_row['cys'];
							$mode=$student_row['mode'];
							$sems=$student_row['current_sem'];
                               ?>
                                <!-- script -->
                            <script type="text/javascript">
                                $(document).ready(function(){
                                
                                    $('#e<?php echo $id; ?>').tooltip('show')
                                    $('#e<?php echo $id; ?>').tooltip('hide')
                                });
                            </script>

                            <!-- end script -->
                              
                                <tr class="odd gradeX">

                                    <td><?php echo $myid; ?></td> 
                                    <td><a rel="tooltip" title ="Remove student" id="e<?php echo $student_row['id']; ?>" href="#del<?php echo $student_row['id'];  ?>" data-toggle="modal"> <?php echo $student_row['lastname']; ?></a></td> 
                                    <td><?php echo  $student_row['firstname']; ?></td> 
                                    <td><span id="ass1<?php echo $id; ?>"><?php  echo $result['assign_1'] ;?></span></td>
                                    <td><span id="ass2<?php echo $id; ?>"><?php echo $result['assign_2'] ; ?></span></td>
                                    <td><span id="exam<?php echo $id; ?>"><?php echo $result['EOS'] ; ?></span></td>
                                    <td><span id="fgrade<?php echo $id; ?>"><?php echo $result['fgrade'] ;?></span></td>
                                    <td><span id="rm<?php echo $id; ?>"><?php if($result['assign_1']==0 ||$result['assign_2'] ==0 ||$result['EOS'] ==0) echo 'N/A'; else echo $result['comment'] ;?></span></td>
                                    <td>
        <input type="radio" name="ass_no" id="no" value="1">1&nbsp;
                                <input type="radio" name="ass_no" id="inputEmail" value="2">2&nbsp;
                                 <input type="radio" name="ass_no" id="inputEmail" value="3">&nbsp;Exam                             
    </td>
                                    <td>
                                   
                    <input type="number" id="grade<?php echo $id; ?>" class="g" placeholder="mark" >
                    <input type="hidden" id="myid<?php echo $id; ?>"  value="<?php echo $myid; ?>">
                    <input type="hidden" id="ccode<?php echo $id; ?>"  value="<?php echo $ccode;?>">
                    <input type="hidden" id="prog<?php echo $id; ?>"  value="<?php echo $prog;?>">
                    <input type="hidden" id="mode<?php echo $id; ?>"  value="<?php echo $mode;?>">
                    <input type="hidden" id="dept<?php echo $id; ?>"  value="<?php echo $dept;?>">
                    <input type="hidden" id="cyear<?php echo $id; ?>"  value="<?php echo $cyear;?>">
                    <input type="hidden" id="stud_id<?php echo $id; ?>"  value="<?php echo $uid;?>">
                    <input type="hidden" id="fn<?php echo $id; ?>" value="<?php echo $student_row['firstname'];?>">
                    <input type="hidden" id="ln<?php echo $id; ?>" value="<?php echo $student_row['lastname'];?>">
                    <input type="hidden" id="sem<?php echo $id; ?>"  value="<?php echo $sems;?>">
                   </td><td>     
<button class="btn btn-success" id="doSave" onclick='$("#msg").html("Please wait..."),$.getJSON("do_masters.php",{
grade:$("input#grade<?php echo $id; ?>").val(),
myid:$("input#myid<?php echo $id; ?>").val(),
ccode:$("input#ccode<?php echo $id; ?>").val(),
prog: $("input#prog<?php echo $id; ?>").val(),
mode: $("input#mode<?php echo $id; ?>").val(),
dept: $("input#dept<?php echo $id; ?>").val(),
cyear: $("input#cyear<?php echo $id; ?>").val(),
stud_id: $("input#stud_id<?php echo $id; ?>").val(),
fn: $("input#fn<?php echo $id; ?>").val(),
ln: $("input#ln<?php echo $id; ?>").val(),
ass_no: $("input:checked").val(),
sem: $("input#sem<?php echo $id; ?>").val() } ,
function(data){
 $("#msg").html(data.err);
$("#ass1<?php echo $id; ?>").html(data.as1); 
$("#ass2<?php echo $id; ?>").html(data.as2); 
$("#exam<?php echo $id; ?>").html(data.exa); 
$("#fgrade<?php echo $id; ?>").html(data.fg); 
$("#rm<?php echo $id; ?>").html(data.com);  
});'> 
<li class="icon-save icon-large"></li>&nbsp;Save</button>  
                  
           
            </td>
            </td>
                          <!-- user delete modal -->
                                    <div id="student_id<?php echo $uid; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Are you Sure you Want to <strong>Delete</strong>&nbsp;grades for &nbsp;<?php echo $student_row['firstname'];?>?</div>
                                            <form method="post" action="">
                                            <input type="hidden" name="ccode" id="c" value="<?php echo $ccode;?>">
                                            <input type="hidden" name="stud_id" id="si" value="<?php echo $uid;?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                           <button type="submit" name="del"  class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</button>
                                           
                                           
                                        </div>
                                        </form>
                                    </div>
                                    <!-- end delete modal -->
                                    <!-- user delete modal -->
                                    <div id="del<?php echo  $student_row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Are you Sure you Want to <strong>Remove</strong>&nbsp; &nbsp;<?php echo $student_row['firstname'];?>&nbsp; From this subject?</div>
                                            <form method="post" action="">
                                            <input type="hidden" name="subcode" id="c" value="<?php echo $subid;?>">
                                            <input type="hidden" name="stud_id" id="si" value="<?php echo  $student_row['id']; ?>">
                                           <input type="hidden" name="ccode" id="c" value="<?php echo $ccode;?>">
                                             
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                           <button type="submit" name="del2"  class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</button>
                                           
                                            </form>
                                        </div>
                                       
                                    </div>
                                    <!-- end delete modal -->
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <!-- end slider -->
                   
                </div>
            </div>

                
                <!-- end slider -->
            </div>

        </div>
        <?php include('footer.php'); ?>
    </div>
</div>
</div>
<?php }?>
</body>
</html>


