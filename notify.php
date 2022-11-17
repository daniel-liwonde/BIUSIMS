<?php
include('header.php');
include ('session.php');
						
include('admin/functions.php');
$user_query = mysqli_query($conn,"select * from teacher where teacher_id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
$subjects = mysqli_query($conn,"select * from subject where teacher_id='$session_id' and category='0'") or die(mysqli_error($conn));
?>
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
                        <li   class="active">
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
                            <?php
                            $subjects2 = mysqli_query($conn,"select * from subject where teacher_id='$session_id'  and category='1'") or die(mysqli_error($conn));
							if(mysqli_num_rows($subjects2)>0){
							?>
                            <a href="teacher_home_master.php"> Masters</a></li>
                            <?php  }?>
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
						}
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
                 <div class="hero-unit-3">
                 
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong style="text-decoration:blink"><?php echo $teacher_row['lastname']."   ".$teacher_row['firstname'] ?></strong>,&nbsp; Here you can send notifications to students<br>
                    
                </div>
                <div class="slider-wrapper theme-default" style="border:1px">
				<?php
if(isset($_POST['send']))
				{
				$target=clean($conn,$_POST['target']);	
				$subject=clean($conn,$_POST['subject']);	
				$message=clean($conn,$_POST['message']);	
				mysqli_query($conn,"insert into notifications(sender_id,subject,target_group,message,posted_date) VALUES('$session_id','$subject','$target','$message','$new')") or die(mysqli_error($conn));
				?>
				<div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong style="text-decoration:blink">&nbsp; Notification sent<br>
                </div>
				<?php	
				}
				?>

                     <form action="" method="post">
                         
                                                     <select name="target"  required>
													
                                            <option value=""> select target </option>
                                            <?php
											if(($l==1) or ($l==2)or ($l==9)){
												?>
											<option value="0">All students</option>
											<?php
											}
                                            $query = mysqli_query($conn,"select * from subject where teacher_id='$session_id'");
											
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['subject_id'];?>"><?php echo $row['subject_title']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select><br>
										<div class="form-group">
										<label>Subject</label>
                                        <input type="text" name="subject" class="form-controls">
										</div>
                                        <textarea name ="message" cols="100" rows="6" class="form-controls" style="width:50%" required>
										
										
										</textarea><br>
											 <button type="submit" name="send" class="btn btn-success btn-lg" style="margin-top:-1%" ><i class="icon icon-signin icon-large"></i> &nbsp;Send</button>
											
                                       
                             
                  </form>
                  
                </div>
                <!-- end slider -->
            </div>
</div>
        </div>
        <?php include('footer.php'); ?>
    </div>
</div>
</div>
<?php }?>
<!--  
 -->


</body>
</html>


