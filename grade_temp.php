<?php
include('header.php');
include('admin/functions.php');
include ('session.php');
$grant=grant_access(); 
$user_query = mysqli_query($conn,"select * from teacher where teacher_id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
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
               <div class="hero-unit-1" >
                    <ul class="nav  nav-pills nav-stacked" >
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
                              <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt icon-large"></i>&nbsp;Grades Entry
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>
                            <ul class="dropdown-menu" style=" margin-top:-15%;">
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
                            $subjects2 = mysqli_query($conn,"select * from subject where teacher_id='$session_id' and category='1'") or die(mysqli_error($conn));
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
							 if($l==9){   ?>
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
                <form method="get" action="admin/grade_template.php">
                
                <?php if(isset($_GET['send'])){?>
                <input type="hidden" value="<?php echo $_GET['subject'] ?>" name="subject" >
                 <input type="hidden" value="<?php echo $_GET['sem'] ?>" name="sem" >
                  <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
                 
                <?php }?>
               <button class="btn btn-success" type="submit" name="send"><i class="icon-plus-sign icon-large"></i>&nbsp;Export to Excel</button> 
                </form> 
	
                <br>
                <div class="hero-unit-3">
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="icon-upload-alt icon-large"></i>&nbsp;Generate Grade Upload  File</strong>
                    </div>

<script src="js/jquery.min.js"></script>  
           <link rel="stylesheet" href="js/css/bootstrap.min.css" />  
           <script src="js/bootstrap.min.js"></script> <form id="export_excel">
                    <form class="form-horizontal" action="" method="get">
                        <div class="control-group">
                            <label class="control-label" for="inputEmail"></label>
                            <div class="controls">
							<select name="subject"    required>
                                            <option value=""> Select subject </option>
                                            <?php
											//include'PIMS/connect.php';
											if($l==9) 
											    $query = mysqli_query($conn,"select * from subject order by subject_title asc");
											    else
                                            $query = mysqli_query($conn,"select * from subject where teacher_id='$session_id'");
											
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['subject_id']  ?>"><?php echo $row['subject_title']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <select  name="year" id="year"  style="width:120px"  required>
                                            <option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
                                        <?php $r=mysqli_query($conn,"select distinct year from results where year >1 order by year desc") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option value="<?php echo $a['year'];?>"> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>
                                         <select name="sem"  id="sem" style="width:120px" required>
                                           <?php   if( checksem()==1){?>
                                            <option value=" 1">Jan-June</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                             <option value="2">July-Dec</option>
                                             <?php
                                            }
                                            ?>
                                              <option value="1">Jan-June</option>
                                               <option value="2">July-Dec</option>
                                            </select>
                                    
                              <button  type="sumit" name="send"  class="btn btn-info" style="margin-top:-10px"><i class="icon icon-gear"></i>&nbsp;Generate  </button>
                               
                            </div>
                        </div>
                 
                    </form>
					<br />  
  				<?Php
                  if(isset($_GET['send']))
{
//$thisub=$_GET['subject'];
$year= $_GET['year'];
$sub= $_GET['subject'];
$sem=$_GET['sem'];
$sh=mysqli_query($conn,"select * from subject where subject_id='$sub'");
$subn=mysqli_fetch_assoc($sh);
{?>
<div class="alert alert-info">
                        
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Showing  Students doing<font color="green" >&nbsp; <?php echo $subn['subject_title'] ?>&nbsp;</font><?php if(checksem()==1) echo "Jan-June"; else echo "July-Dec" ?>&nbsp; Semester &nbsp;<?php  echo $year?></strong>                      </div> 
                           <?php }} ?>
                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                    
                                         
                                                
                                 <thead>
                                 <tr>
                                <th>No</th>
                               <th>StudentID</th>
<th>Lastname</th>
                              <th>Firstname</th>
                              
                                <th>Mode</th>
                                 
                                                                  
                   </tr>
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                            <?php include('admin/stud_course_temp.php'); ?>
                           
                          <!-- user delete modal -->
                            
                        </tbody>
                  </table>
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


