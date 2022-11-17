<?php
include('header.php');
////session_start();
include ('session.php');
include('admin/functions.php');
$grant=grant_access();                                  
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
                       
                        <?php
						if(isset($_COOKIE['level']))
                        $l=$_COOKIE['level'];
						
							 if(($l==9) || ($grant ==1)){   ?>
							  <li>
                            <a href="teacher_class.php"> <i class="icon-group icon-large"></i>&nbsp;Modify past results
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>
                                </a>
                                </li>
                                <?php }?>
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
							
							 if($l==9){   ?>
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
                 
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong style="text-decoration:blink"><?php echo $teacher_row['lastname']."   ".$teacher_row['firstname'] ?></strong>&nbsp; welcome.<br> Here are simple instructions on how you can enter grades to have correct results<br>
                    <ol><li>To enter grades please select <b>grade entery</b> and select the subject you want to enter its grade for from the <b>left menu</b></li></li><li> Make sure that the system semester (displayed at the top of the grade entry page ie Jan-June or July-Dec) is correct before entering grades</li><li>Make sure that the subject name appearing to the left top conner(in green color)is really the one you intended to enter its grade for </li><li>To enter a grade select the assignment number for the grade first and then enter the grade and click the <b>save</b> button</li> <li>if you have made a mistake and wants to change a grade just select the assignment number and enter the new grade and click the <b>save</b> button and the  system is going to replace the old grade with the new entered grade
                    so make sure that you selected the correct assignment number before entering the grade otherwise you will replace a wrong grade</li></ol>
                    <?php echo $grant ?>
                </div>
                <div class="slider-wrapper theme-default">

                    <?php 

                    
					include('admin/msg.php') ?>
                  
                </div>
                <!-- end slider -->
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