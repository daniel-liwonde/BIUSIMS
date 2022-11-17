<?php
include('header.php');
include ('session.php');
include ('admin/functions.php');
$user_query = mysqli_query($conn,"select * from teacher where teacher_id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
if(isset($_GET['id']))
$sub=$_GET['id'];
$subjects = mysqli_query($conn,"select * from subject where teacher_id='$session_id' and category='1'") or die(mysqli_error($conn));
if(isset($_POST['save'])){
							$ass1=$_POST['ass1'];
							$ass2=$_POST['ass2'];
							$eos=$_POST['eos'];
							$id=$_POST['id'];
						$fgrade=	calculateEOS($ass1,$ass1,$eos);
						$rate=rateEOS($fgrade);
					$n=	mysqli_query($conn,"update results set assign_1='$ass1',assign_2='$ass2',EOS='$eos',fgrade='$fgrade',comment='$rate' where result_id='$id'") or die(mysqli_error($conn));
					if($n){
					$msg="updated";
					}}	
	            ?>
<style>	
#x{width:130px;}
</style>				
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
                            <a href="teacher_home_master.php"><i class="icon-home icon-large"></i>&nbsp;Home<i class="icon-double-angle-right icon-large"></i>Masters
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>

                        </li>
                        
                          <li class="active">
                            <a href="reports_masters.php"><i class="icon-list-alt icon-large"></i>&nbsp;Exam reports
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>                
                        <li>
                        
						
                           <?php 
						   $ll=$_COOKIE['level'];
						   if($ll==1 or $ll==2){?> <a href="teacher_class.php"><?php }else{ ?><a href="#" onClick="alert('ACCESS DENIED')"><?php }?> <i class="icon-group icon-large"></i>&nbsp;Modify past results
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
            <form method="post" action="repo.php">
                <button class="btn btn-success" type="submit" name="submit_docs"><i class="icon-plus-sign icon-large"></i>&nbsp;Export to Excel</button>
                <?php if(isset($_GET['sub'])){?>
                <input type="hidden" value="<?php echo $_GET['sub'] ?>" name="sub" >
                <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
                <input type="hidden" value="<?php echo $_GET['sem'] ?>" name="sem" >
                <?php }?>
                </form>
                <div class="hero-unit-3">
                <?php if(isset($msg)){?>
							
							<div class="alert alert-danger"><i class="icon-save"></i>			
							<?php echo $msg;?></div>
                            <?php 
							}                           
                               ?>                           
                              <div class="alert alert-info">
                        
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Reports table</strong>                      </div> 
                           <div class="control-group">
                                                <label class="control-label" for="inputPassword">Enter Details Below</label>
                                                <div class="controls">
           <form action="" method="get">
                         Subject:
                                                     <select name="sub"  required>
                                            <option value=""> Select subject </option>
                                            <?php
                                            $query = mysqli_query($conn,"select * from subject where teacher_id='$session_id' and category='1'");
											
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['subject_code'];?>"><?php echo $row['subject_title']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                       <select  name="year"  required id="x">
                                        <option value="">select year</option>
                                        <?php $r=mysqli_query($conn,"select distinct year from results") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>
                                            
                                       <select name="sem"  required id="x">
                                            <option value="">Report Semester </option>
                                             <option value="1">Jan-June </option>
                                              <option value="2">July-Dec </option>
                                             
                                               
                                            </select>
                                        <button type="submit" name="send" class="btn btn-success" ><i class="icon-list-alt icon-large"></i>Display</button>
                                       
                             
                  </form>
                  </div></div>
                 
                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                    
                                         
                                                
                                 <thead>
                                 <tr>

                               <th>StudentID</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                                <th>Mode</th>
                                <th>Code</th>
                                  <th>Assg#1</th>
                                  <th>Assg#2</th>
                                   <th>EOS</th>
                                   <th colspan="2">Grade</th>
                                    <th>Year</th>                                 
                   </tr>
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                            <tr class="odd gradeX">
                           <?php databaseOutput()  ?>    
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



