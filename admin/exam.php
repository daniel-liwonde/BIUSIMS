<?php
if(isset($_GET['send'])){
							$su_id=$_GET['sub'];
							$year=$_GET['year'];
							$sem=checksem();
							
     $query = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' ") or die(mysqli_error($conn));
	 $total=mysqli_num_rows($query);
	  $f = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'   and comment='F' and mode='1'and sem='$sem' ") or die(mysqli_error($conn));
	  $fail=mysqli_num_rows($f);
	  $d = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'  and mode='2' and sem='$sem' ") or die(mysqli_error($conn));
	     $ds=mysqli_num_rows($d);
		 $ft = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'  and mode='1' and sem='$sem' ") or die(mysqli_error($conn));
	     $ftt=mysqli_num_rows($ft);
	   $p = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'   and comment='P' and mode='1' and sem='$sem' ") or die(mysqli_error($conn));
	    $pass=mysqli_num_rows($p);
	    $cp = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'   and comment='CP' and mode='1' and sem='$sem' ") or die(mysqli_error($conn));
	     $cpz=mysqli_num_rows($cp);
		  $mp = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'  and comment='MP' and mode='1' and sem='$sem' ") or die(mysqli_error($conn));
	     $mpz=mysqli_num_rows( $mp);
		 $d = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'  and comment='D' and mode='1' and sem='$sem' ") or die(mysqli_error($conn));
	     $dz=mysqli_num_rows($d);
		  $fd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' 
		   and comment='F' and mode='2'") or die(mysqli_error($conn));
	  $faild=mysqli_num_rows( $fd);
	   $pd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'  and comment='P' and mode='2' and sem='$sem' ") or die(mysqli_error($conn));
	    $passd=mysqli_num_rows($pd);
	    $cpd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'  and comment='CP' and mode='2' and sem='$sem' ") or die(mysqli_error($conn));
	     $cps=mysqli_num_rows($cpd);
		  $mpd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and comment='MP' and mode='2' and sem='$sem' ") or die(mysqli_error($conn));
	     $mps=mysqli_num_rows( $mpd);
		 $dd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year'  and comment='D' and mode='2' and sem='$sem' ") or die(mysqli_error($conn));
	     $dzd=mysqli_num_rows($dd);
		 if($total>0){
		 
		  while ($row = mysqli_fetch_array($query)) {
                           $student_id = $row['student_id'];
						   $results = mysqli_query($conn,"select * from subject where subject_code='$su_id'") or die(mysqli_error($conn));            
						   $results_row = mysqli_fetch_array($results);
						   $sem= $results_row['offered_sem'];
													   ?>
                          
						   <td><?php echo $row['student_id']?></td>
                             <td><?php echo $row['firstname']?></td> 
                             <td><?php echo $row['surname']?> </td>
                              <td><?php if ($row['mode']==1) echo 'F';  if ($row['mode']==2) echo 'D';?></td> 
                             <td> <?php echo $row ['course_code']?></td>  
                              <td><?php echo $row['assign_1']?> </td> 
                              <td> <?php echo $row['assign_2'] ?></td> 
                    <td><?php echo $row['EOS'] ?></td>
                    <td><?php echo $row['fgrade'] ?></td>
                              <td><?php echo $row['comment'] ?></td>
                                 <td><?php echo $row['year']; ?></td>
                                 </tr>
                        <?php } 
						
						
						?>
                        
						<div class="alert alert-info"><strong style="color:#FF0000; text-transform:uppercase;"><center><?php echo $results_row['subject_title']."&nbsp;&nbsp;".$year. "&nbsp;&nbsp;"; if(checksem()==1) echo "Jan-June";else echo "July-dec"."&nbsp;&nbsp;Semester"?>  &nbsp;SUMMARY</strong></center><br>
                        <div class="alert alert-danger"><center><strong>DISTANCE STUDENTS</strong></center><br />
                        <?php echo "<b>F:</b>" .$faild."&nbsp;&nbsp;&nbsp;&nbsp;<b>P:</b>" .$passd."&nbsp;&nbsp;&nbsp;&nbsp;<b>CP:</b>" .$cps ."&nbsp;&nbsp;&nbsp;&nbsp;<b>MP:</b>" .$mps."&nbsp;&nbsp;&nbsp;&nbsp;<b>D:</b>" .$dzd; ?>&nbsp;&nbsp; <b>Total Passes:</b><?php $ss= ($passd+$cps+$mps+$dzd); echo $ss;?><b> Total Fails:</b> <?php echo $faild ?>&nbsp;&nbsp;<b>Total distance:</b><?php echo $ds  ?>&nbsp;&nbsp;<b>Pass Rate:</b> <?php if($ds==0){$ds=1;} $s= (($ss/$ds)*100); echo round($s,1)."%" ?>
                        </div>
                        <div class="alert alert-danger"><center><strong >FULLTIME STUDENTS</strong></center><br />
                        <?php echo "<b>F:</b>" .$fail."&nbsp;&nbsp;&nbsp;&nbsp;<b>P:</b>" .$pass."&nbsp;&nbsp;&nbsp;&nbsp;<b>CP:</b>" .$cpz ."&nbsp;&nbsp;&nbsp;&nbsp;<b>MP:</b>" .$mpz."&nbsp;&nbsp;&nbsp;&nbsp;<b>D:</b>" .$dz; ?> &nbsp;&nbsp; <b>Total Passes:</b><?php  echo $pass+$cpz+$mpz+$dz;?> <b>Total Fails:</b> <?php echo $fail ?>&nbsp;&nbsp;<b>Total Fulltime:</b><?php echo $ftt  ?>&nbsp;&nbsp;<b>Pass Rate:</b> <?php if($ftt==0){$ftt=1;} $v=((($pass+$cpz+$mpz+$dz)/$ftt)*100); echo round($v,1)."%" ?>
                        </div>
                       <div class="alert alert-danger"><center><strong>TOTAL CLASS STATICTICS</strong></center><br />
                        <?php echo "<b>F:</b>" .($faild+$fail)."&nbsp;&nbsp;&nbsp;&nbsp;<b>P:</b>" .($passd+$pass) ."&nbsp;&nbsp;&nbsp;&nbsp;<b>CP:</b>" .($cps+$cpz) ."&nbsp;&nbsp;&nbsp;&nbsp;<b>MP:</b>" .($mps+$mpz)."&nbsp;&nbsp;&nbsp;&nbsp;<b>D:</b>" .($dzd+$dz); ?> &nbsp;&nbsp; <b>Total Passes:</b><?php  $ps= (($pass+$cpz+$mpz+$dz)+($ss)); echo $ps;?> <b>Total Fails:</b> <?php echo $faild+$fail ?>&nbsp;&nbsp;<b>Total Class:</b><?php echo $total  ?>&nbsp;&nbsp;<b> Class Pass Rate:</b> <?php  if($total==0){$total=1;}$pp=(($ps/$total)*100); echo round($pp,1)."%" ?>
                        </div>
                                    <button title="close" type="button" class="close" data-dismiss="alert">&times;</button>
                                    <br />
                                    </div>
                                    <?PHP 
									}
									else{ 
									
									 echo"<div class='alert alert-danger'><i class='icon-remove-sign'></i>&nbsp;No results found</div>";
									}
									}
								?>
								