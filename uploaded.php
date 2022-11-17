<?php
include('header.php');
include('admin/functions.php');
include ('session.php');
$grant=grant_access(); 
$grant_temp=grant_temp_access(); 
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
                <a href="reports.php" class="btn btn-success"><i class="icon-list icon-large"></i>&nbsp;Results Reports</a>
                <?php
                if($grant_temp==1)
                {?>
                <a href="grade_temp.php" class="btn btn-success"><i class="icon-upload icon-large"></i>&nbsp;Generate Grade Upload Template </a>
	             
                <br><br>
                <?php
                }
                ?>
                <div class="alert alert-danger" style="text-decoration:blink"> <i class="icon icon-exclamation-sign"></i>
                    <strong>Please make sure that you selected the correct file corresponding to selected subject before uploading&nbsp;</strong>
                </div>


                <div class="hero-unit-3">
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="icon-upload-alt icon-large"></i>&nbsp;Upload A File</strong>
                    </div>

<script src="js/jquery.min.js"></script>  
           <link rel="stylesheet" href="js/css/bootstrap.min.css" />  
           <script src="js/bootstrap.min.js"></script> 
                    <form class="form-horizontal"  id="export_excel" >
                        <div class="control-group">
                            <label class="control-label" for="inputEmail"></label>
                            <div class="controls">
                                <?php 	if(($grant==1)){ ?>
							<select name="sub"    required>
                                            <option value=""> Select subject </option>
                                            <?php
											//include'PIMS/connect.php';
											if($l==9) 
											    $query = mysqli_query($conn,"select * from subject order by subject_title asc");
											    else
                                            $query = mysqli_query($conn,"select * from subject where teacher_id='$session_id'");
											
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['subject_code'];?>"><?php echo $row['subject_title']; ?></option>
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
                                            <option value="2">July-Dec</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="1">Jan-June</option>
                                            
                                             <?php
                                            }
                                            ?>
                                              <option value="1">Jan-June</option>
                                               <option value="2">July-Dec</option>
                                            </select>
                                            
                                       <br />     
                              <input  type="file" name="excel_file" id="excel_file" class="form-control btn btn-success"> 
                               <?php 
                               
                               }
                               else
                               {
                               ?>
                               <div class="alert alert-warning" style="text-decoration:blink"> <i class="icon icon-exclamation-sign"></i>
                    <strong>Sorry for now you can not upload grades; please contact the admin&nbsp;</strong>
                </div>
                               <?php 
                               }
                               ?>
                            </div>
                        </div>
                 
                    </form>
					<br />  
                <br />  
				<div id="output"> </div>

<script> 
 $(document).ready(function(){  
      $('#excel_file').change(function(){  
           $('#export_excel').submit();  
      });  
      $('#export_excel').on('submit', function(event){  
           event.preventDefault(); 
		   $('#output').html('Please wait...');
           $.ajax({  
                url:"export.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                success:function(data){  
                     
                     					 
                     $('#excel_file').val(''); 
                     $('#output').html(data); 					 
                }  
           });  
      });  
 });   
 </script>				
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


