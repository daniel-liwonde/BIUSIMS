<?php
include('session.php');
include('header.php');
include ('admin/functions.php');   
$start=$_COOKIE['ADM_YEAR'];       
$user_query = mysqli_query($conn,"select * from student where id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
?>
<body>
    <?php include('navhead_student.php'); ?>
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
                            <a href="student_home.php"><i class="icon-home icon-large"></i>&nbsp;Home
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>

                        </li>
                        <li>
                            <a href="student_details.php"><i class="icon-book icon-large"></i>&nbsp;My Details
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>     
           <li>
                            <a href="register.php?id=<?php echo $session_id; ?>""><i class="icon-pencil icon-large"></i>&nbsp;Register Courses
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
							<li>
                            <a href="carry.php"><i class="icon-repeat icon-large"></i>&nbsp;My Carryovers
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
							<li>
                            <a href="prev.php"><i class="icon-folder-open icon-large"></i>&nbsp;Previous Results
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
 <li>
                            <a href="notifications.php"><i class="icon-bell-alt icon-large"></i>&nbsp;Notifications
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                    </ul>
                </div>

            </div>

            <div class="span9">
<div class="hero-unit-3">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php echo $student_row['firstname'];?></strong>&nbsp;Welcome. <span class="pull-right">Programme:<?php echo $_COOKIE['pro'];?> ,Current year:<?php echo $_COOKIE['year'];?>, Semester:<?php echo $_COOKIE['ssem'];?></span>
                </div>
                <div class="slider-wrapper theme-default">

                                 <form action="" method="POST">                                      
                                        <select  name="year" >
                                        <option value="">academic year</option>
                                        <?php 
										$r=mysqli_query($conn,"select distinct year from results WHERE year>='$start' and year <= $start+4 and uid='$session_id'");
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option value="<?php echo $a['year'];?>"> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>
                                            
                                       <select name="sem"  required>
                                            <option value=""> Class Semester </option>
                                             <option value="1">Jan-June </option>
                                              <option value="2">July-Dec </option>
                                               
                                            </select>
                                                   
                                        <button type="submit" name="send" class="btn btn-success" style="margin-top:-1%" ></i>Show</button>
                  </form>
      <?php 
	  if(isset($_POST['send']))
	  {
		$exam_num_year=$_POST['year'];  
		$exam_sem_num=$_POST['sem']; 

$student3 = mysqli_query($conn,"select * from student_fees where id='$session_id' and year='$exam_num_year' and sem='$exam_sem_num' and fee_balance >0") or die("here".mysqli_error($conn));
                                                             if(mysqli_num_rows($student3)>0) {
                                                             echo "<span class=' alert alert-danger'>Please consult the accounts office</span>";
															}
                                                              else
                                                               {//open no balance		
$query = mysqli_query($conn,"select * from results where year='$exam_num_year'  and sem='$exam_sem_num' and uid ='$session_id'")or die(mysqli_error($conn));
	 $total=mysqli_num_rows($query);
		 if($total>0){
			 $query2 = mysqli_query($conn,"select * from results where year='$exam_num_year'  and sem='$exam_sem_num' and uid ='$session_id'")or die(mysqli_error($conn));
			 $preqry=mysqli_fetch_array($query2);
		 ?>
         <div class="alert alert-info">Results For:&nbsp;Year&nbsp;<?php echo $preqry['stud_year'];  ?>&nbsp;, Semester:<?php echo $preqry['studsem']   ?>&nbsp;<b><?php if(($exam_sem_num)==1)echo "Jan-June"; else echo"July-Dec"; ?>&nbsp;&nbsp;<?php  echo $exam_num_year?></b> </div>
                                    
                                  
                                        <table style="width:100%;" class="table-striped table-hover" >
							    <tr style="font-weight:bold;  text-align:center" class="alert alert-info">
                                <td align="left">NO</th>
                             <th align="left" width="120">Course Code</th>
                             <th align="left" width="220">Course Name</th>
                      <td>CW1</td>
                             <td>CW2</td>
                             <td> Exam</td>
                             <th>EOS</td>
                              <th>Grade</th> 
                             </tr>
                             <?php
							//$status = mysqli_query($conn,"select distinct comment from results where year='$cyear'  and sem='$csem'  and uid ='$uid'where comment='F'");
							 //if(mysqli_num_rows($status)==0){$pas="PASSED";}else {$pas="FAILED";}
							 $i=1;
						    while($student_row = mysqli_fetch_array($query)){
							$cod=$student_row ['course_code'];
                          $title= mysqli_query($conn,"select * from subject where subject_code='$cod'") or die(mysqli_error($conn));;
						  $ccode=mysqli_fetch_array($title);
						   $name=$student_row['surname'];
						    $fname=$student_row['firstname'];
							 $iname=$student_row['student_id'];
							 
							 // if(mysqli_num_rows($status)==0){$pas="PASSED";}else {$pas="FAILED
							  	if($i<7){							 
							 ?>
                            <tr align="center" id="disp" >
                            <td align="left"><?php echo $i;?></td>
							<td align="left"><?php echo $student_row['course_code']?></td>
                             <td width="210" align="left"><?php echo  $ccode['subject_title']?></td> 
                              <td><?php echo $student_row['assign_1'];?> </td>
                              <td><?php echo $student_row['assign_2']?> </td>
                              <td><?php echo $student_row['EOS']?> </td>
                              <td><?php echo $student_row['fgrade']?> </td>
                              <td><?php if(($student_row['assign_1']==0) or ($student_row['assign_2']==0) or ($student_row['EOS']==0)) echo 'N/A'; else echo $student_row['comment']?> </td>
                              
							   </tr>
                               
							<?php
								}
							$i++;
							}
									   $student4 = mysqli_query($conn,"select * from results where uid='$session_id' and year='$exam_num_year' and sem='$exam_sem_num' and comment='F' ") or die(mysqli_error($conn)); 
                         if(mysqli_num_rows($student4)==0)
                          {$well="Pass and Proceed"; $v=1;}
					  elseif(mysqli_num_rows($student4)>=3){$well="Repeat Semester";$v=2;}else {$well="Proceed CARRY:"; $v=3;}
							   ?>
							  

								<tr height="20"> <td colspan="8" align="left"></td></tr>					
							  <tr> <td colspan="8" align="left"><b> Remarks:</b> &nbsp; &nbsp; &nbsp;      <?php echo $well;?>
                                    <?php   
									if($v==3)
									{
										echo'<ol>'	;
									while($rs=mysqli_fetch_array($student4))
									{
									$cc=$rs['course_code'];	
									$title= mysqli_query($conn,"select * from subject where subject_code='$cc' ");
                                     $su=mysqli_fetch_array($title)	;
									 $sname= $su['subject_title'];
                                     echo'<li>'. $sname .'</li>';
								 
									}
                                    echo'</ol>'	;								
									}
									
									?>

							   </td></tr>
						</table>
                        <?php    
						 }
						 else
						 {
						 echo "no results for student in sem".$exam_sem_num."Year:".$exam_num_year;
						 } 
						   }//close no balance
		 }
						?>  					  
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


