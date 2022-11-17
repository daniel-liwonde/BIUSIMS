 <?php
 $query = mysqli_query($conn,"select * from results where stud_year='$cyear'  and sem='$sem' and student_id='$sel' and prog='$prog'") or die(mysqli_error($conn));
	 $total=mysqli_num_rows($query);
	   
		 if($total>0){
		 ?>
         <div class="alert alert-info"><center>Showing  <?php echo $prog;  ?>&nbsp;<?php echo $year;  ?>&nbsp;Year&nbsp;<?php echo $cyear;  ?>&nbsp&nbsp;<?php if($sem==1)echo "Jan-June";else echo"July-Dec"  ?>&nbsp;Semester &nbsp;Results  &nbsp;</center><b><?php //echo $n['surname']  ?>&nbsp;&nbsp;<?php //echo $n['firstname']?></b> </div>
                                    
                                  <tr>
                                 <td colspan="4"> 
                                 <table style="width:100%;" >
                                 
                              
                             
							    <tr style="font-weight:bold;  text-align:center" class="alert alert-info">
                                 <td align="left">NO</td>
                             <td align="left">Course Code</td>
                             <td align="left">Course Name</td>
                              <td> CworkI</td>
                             <td>CworkII</td>
                             <td> Exam</td>
                             <th>EOS</td>
                              <th>Grade</th> 
                             </tr>
                             <?php
							
						  
							$status = mysqli_query($conn,"select distinct comment from results where stud_year='$cyear'  and sem='$sem' and student_id='$sel' and comment='F'");
							 if(mysqli_num_rows($status)==0){$pas="PASSED";}else {$pas="FAILED";}
							 $i=1;
						    while($student_row = mysqli_fetch_array($query)){
							$cod=$student_row ['course_code'];
                          $title= mysqli_query($conn,"select * from subject where subject_code='$cod' ");
						  $ccode=mysqli_fetch_array($title);
						   $name=$student_row['surname'];
						    $fname=$student_row['firstname'];
							 $iname=$student_row['student_id'];
							 
							 // if(mysqli_num_rows($status)==0){$pas="PASSED";}else {$pas="FAILED
							  							 
							 ?>
                            <tr align="center" id="disp" >
                            <td align="left"><?php echo $i;?></td>
							<td align="left"><?php echo $student_row['course_code']?></td>
                             <td width="210" align="left"><?php echo  $ccode['subject_title']?></td> 
                              <td><?php echo $student_row['assign_1'];?> </td>
                              <td><?php echo $student_row['assign_2']?> </td>
                              <td><?php echo $student_row['EOS']?> </td>
                              <td><?php echo $student_row['fgrade']?> </td>
                             <td><?php if($student_row['assign_1']==0 or $student_row['assign_2']==0 or $student_row['EOS']==0) echo "N/A"; else echo $student_row['comment']?> </td>
                              
                              
							   </tr>
                               
							<?php
							$i++;
							}
							
						?>
						</table></td></tr>
							<tr class="alert alert-danger"><td colspan="4"><b><font color="#666666"><?php echo $iname."&nbsp;&nbsp;". $name."&nbsp;&nbsp;". $fname."</font>";if(isset($pas)){echo "<font color='#FF0000'> &nbsp;".$pas;}?></font></b></td></tr>
                            <?php      
						 }
						 else
						 {
						 echo "no results for student in sem".$sem."Year:".$cyear;
						 } 
						
						
						
						?>  
                       