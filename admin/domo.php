<?php include('header.php'); ?>
<?php include('session.php'); 

if(isset($_POST['remove'])){
                              $uid= $_POST['uid'];
							 $code= $_POST['ccode'];
							 $y = $_POST['year'];
							  $subid= $_POST['subid'];
							  $s=$_POST['sem'];
							 /* $k= mysqli_query($conn,"select *  from results where course_code='$code' and uid='$uid' and year=$y and sem=$s " )or die(mysqli_error($conn));
							 $h=mysqli_fetch_array($k);
							 
							 if($h['fgrade']==0){ */
						   mysqli_query($conn,"delete from teacher_student where subject_id='$subid' and uid=$uid and year='$y' and semester='$s'" )or die(mysqli_error($conn));
						   mysqli_query($conn,"delete from results where course_code='$code' and uid='$uid' and year=$y and sem=$s" ) or die(mysqli_error($conn));

                      $_COOKIE['u']="DELETED";
							 }
?>
<style>
 #g{ width:40px}
</style>
<body onLoad="StartTimers(;" onmousemove="ResetTimers(;">

    <div class="row-fluid">
        <div class="span12">

            <?php include('navbar.php'); ?>

            <div class="container">

                <div class="row-fluid">

                    <div class="span12">
                      
                       <p>
                        <div class="hero-unit-3" style="width:105%">
                           <?php if(isset($_COOKIE['ERR'])&& ($_COOKIE['ERR']!='')){?>
                             <div class="alert alert-danger"><i class="icon-remove-sign"></i>&nbsp;<?php echo $_COOKIE['ERR'];$_COOKIE['ERR']=''; ?></div>
                            <?php  }
							
						
						    $did=$_GET['id'];
						   $se=mysqli_query($conn,"select * from student where id='$did'");
						   $n=mysqli_fetch_array( $se);
                            ?>  
<div id="msg"> <?php if(isset($_COOKIE['u'])) echo $_COOKIE['u'];$_COOKIE['u']='';?> </div>							
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;&nbsp;Subject history for &nbsp <span style="text-decoration:blink"><font color="green"><?php echo $n['firstname']."&nbsp;".$n['lastname']?></font>&nbsp;&nbsp; Year:<?php echo $n['stud_current_year']?>&nbsp;&nbsp; Sem:<?php echo $n['current_sem'];?> |  <a href="student.php">Back</a></span>
                                </div>
                                 <div>
                                <form method="post" action="">
                                <select name="year"  required>
                                            <option value="">Select year </option>
                                             <?php
                                            $query = mysqli_query($conn,"select distinct year  from teacher_student order by year desc");
											
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['year'];?>"><?php echo $row['year']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
										<select name="sem"  required>
										 <option value="">Select semester </option>
                                            <option value="1">Jan-June </option>
											<option value="2">July-Dec</option>
                                        </select>
										
                                        <input type="submit" value="Display" class="btn btn-success" style="margin-top:-10px" name="do">&nbsp;&nbsp;&nbsp;&nbsp;
										  </form>
			
                               
                                </div>
                                <thead>
                                    <tr>
 <th>No</th>
                                        <th>Course Code</th>
                                        <th>Course Title</th>
                                        <th>Academic Year</th>
                                        <th>Semester</th>
                                        <th>Status</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									if(isset($_POST['do'])){
								$i=1;
									$sem=$_POST['sem'];
										$y=$_POST['year'];
                                    $query = mysqli_query($conn,"select * from teacher_student where uid='$did' and semester='$sem' and year='$y' ") or die(mysqli_error($conn));
                                    while ($row = mysqli_fetch_array($query)) {
                                       
										$year=$row['year'];
										$semester=$row['semester'];
										$sub=$row['subject_id'];
									
										$query2 = mysqli_query($conn,"select * from subject where subject_id='$sub'") or die(mysqli_error($conn));
										$pro=mysqli_fetch_array($query2);
                                        ?>



                                    <tr class="odd gradeX">
									<td><?php echo $i ?></td>
                                        <td><?php echo $pro['subject_code']; ?></td>
									
                                        <td><?php echo $pro['subject_title'] ; ?> </a></td> 
                                        <td><?php echo $y ; ?></td> 
                                          <td><?php if($semester==1) echo "Jan-June"; else echo "July-Dec"?></td>
                                          <td><?php if($row['being_repeated']==1) echo "<font color='red'>Carryover</font>"; else echo "<font color='green'>Fresh</font>" ?></td> 
										  <td width="40">
                        
						  <form action='' method='post'>
                        <input type="hidden" value="<?php  echo $year ?>" name="year">
						 <input type="hidden" value="<?php  echo $semester ?>" name="sem">
						<input type="hidden" value="<?php  echo $pro['subject_code'] ?>" name="ccode">
						   <input type="hidden" value="<?php  echo $sub ?>" name="subid">
                           <input type="hidden" value="<?php  echo $did ?>" name="uid">
                             
                            <button type="submit" name="remove" class="btn btn-danger" title="Remove">
							
							

							
							<i class="icon-trash icon-large"></i></button>
                          
                          </form>
                            </td>
                                          
                                    </tr>
									<?php $i++;}}?>
                                </tbody>
                            </table>
                        </div>
<div id="msg"></div>
                    </div>
                </div>
                <?php include('footer.php'); ?>
            </div>
        </div>
    </div>





</body>
</html>


