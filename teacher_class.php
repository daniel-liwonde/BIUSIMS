<?php
include('header.php');
include ('session.php');
include('admin/functions.php');
$user_query = mysqli_query($conn,"select * from teacher where teacher_id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
//$sub=$_GET['id'];
$subjects = mysqli_query($conn,"select * from subject where teacher_id='$session_id' and category='0'") or die(mysqli_error($conn));
?>

<style>
 .g{ width:40px}
.myass{ width:90px}
#msg{float:left;color:red;text-decoration:position:absolute;position:fixed;  margin-left:24%;margin-top:7px;}
</style>

<body onLoad="StartTimers();" onmousemove="ResetTimers();">

    <?php include('navhead_user.php'); ?>

    <div class="container">
        <div class="row-fluid">

            <div class="span3">
                <div class="hero-unit-3" >
                    <div class="alert-index alert-success" >
                        <i class="icon-calendar icon-large" ></i>
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
                        <li class="active">
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

                            <li><a href="teacher_subject.php"><i class="icon-file-alt icon-large"></i>&nbsp;Courses
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                            </a></li>
<li>
                            <a href="notify.php"><i class="icon-bell-alt icon-large"></i>&nbsp;Notifications
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
<li><a href="students.php"><i class="icon-group icon-large"></i>&nbsp;Students
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
                           
 <?php 
							
							 if(($l==2)||($l==9) ||($l==1)){   ?>
                            <a href="admin/home.php"><i class="icon-group icon-large"></i>&nbsp;Administration
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <?php  } ?>
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


                 <div class="hero-unit-3" style="width:120%;">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>

                            <?php
//$sub=$_GET['id'];
//$sp = mysqli_query($conn,"select * from subject where subject_id='$sub'") or die(mysqli_error($conn));
//$rowsub=mysqli_fetch_array($sp);
//$subj_id=$rowsub['subject_id'];
							?>


                            <strong><li class="icon-user icon-large"></li>&nbsp;<a onclick='$("#msg").html("Ready for grade entry"),$.getJSON("x2.php");'>Modify Past Results |&nbsp;&nbsp;<a href="teacher_add_student2.php" >Add student</a></strong></div>


 

                            <div class="control-group">
                                                <label class="control-label" for="inputPassword"> Please enter Details Below</label>
                                                <div class="controls">
           <form action="" method="get">

                                                      <div class="search-box" style="float:left; margin-left:10px">
        <input name="sub" type="text" autocomplete="off" placeholder="Search subject..." />
        <div class="result"></div>
    </div>
                                        <select  name="year"  required style="width:120px" >
                                        <option value="">Exam year</option>
                                        <?php $r=mysqli_query($conn,"select distinct year from results where year<>0") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>

                                       <select name="sem"  required  style="width:120px">
                                            <option value=""> Semester </option>
                                             <option value="1">Jan-June </option>
                                              <option value="2">July-Dec  </option>

                                            </select>


                                        <button type="submit" name="send" class="btn btn-success"  style=" margin-top:-10px"><i class="icon-list-alt icon-large"></i>Display</button>


                  </form>
				 
                  </div>
                        <div id="msg"></div>

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
							if(isset($_GET['send'])){
							$sub=$_GET['sub'];
							$year=$_GET['year'];
							$sem=$_GET['sem'];
							$query1 = mysqli_query($conn,"select * from subject where subject_title='$sub'");
							$rowc=mysqli_fetch_assoc($query1);
							$subcode=$rowc['subject_code'];
     $query = mysqli_query($conn,"select * from results where course_code='$subcode' and year='$year' and sem='$sem'") or die(mysqli_error($conn));
						 
                           while($row = mysqli_fetch_array( $query)){
                           $id=$row['uid'];
                           $myid=$row['student_id'];
						    $teacher_students = mysqli_query($conn,"select * from student where id='$id'") or die(mysqli_error($conn));
                           $student_row = mysqli_fetch_array($teacher_students);
                            $myid=$student_row['student_id'];
						   
                               ?>
                                <script>
$(document).ready(function(){
$("#doSave<?php echo $id ?>").click(function(){
$("#msg").html("Please wait...");
});
});
</script>
                                <tr class="odd gradeX">

                                    <td><?php echo $myid ?></td>
                                    <td> <?php echo   $student_row ['lastname']; ?></td>
                                    <td><?php echo    $student_row ['firstname']; ?></td>
                                    <td><span id="ass1<?php echo $id; ?>"><?php  echo $row['assign_1'] ;?></span></td>
                                    <td><span id="ass2<?php echo $id; ?>"><?php echo $row['assign_2'] ; ?></span></td>
                                    <td><span id="exam<?php echo $id; ?>"><?php echo $row['EOS'] ; ?></span></td>
                                    <td><span id="fgrade<?php echo $id; ?>"><?php echo $row['fgrade'] ;?></span></td>
                                    <td><span id="rm<?php echo $id; ?>"><?php if($row['assign_1']==0 ||$row['assign_2'] ==0 ||$row['EOS'] ==0) echo 'N/A'; else echo $row['comment'] ;?></span></td>
                                    <td>

        <input type="radio" name="ass_no"  id="no" value="1">1&nbsp;
                                <input type="radio" name="ass_no" id="no" value="2">2&nbsp;
                                 <input type="radio" name="ass_no" id="no" value="3">&nbsp;Exam
    </td>
                                    <td>

                    <input type="number" id="grade<?php echo $id; ?>" class="g" placeholder="mark" >
                    <input type="hidden" id="uid<?php echo $id; ?>"  value="<?php echo $id; ?>">
                    <input type="hidden" id="year<?php echo $id; ?>"  value="<?php echo $year;?>">
                    <input type="hidden" id="sem<?php echo $id; ?>"  value="<?php echo $sem;?>">
                     <input type="hidden" id="ccode<?php echo $id; ?>"  value="<?php echo $subcode;?>">
                   </td><td>
<button class="btn btn-success" id="doSave<?php echo $id ?>" onclick='$.getJSON("do2.php",{
grade:$("input#grade<?php echo $id; ?>").val(),
uid:$("input#uid<?php echo $id; ?>").val(),
ccode:$("input#ccode<?php echo $id; ?>").val(),
year: $("input#year<?php echo $id; ?>").val(),

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
                            </tr>
                        <?php } }?>
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

</body>
</html>


