<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <title>Students</title>
    <?php 
 include('connect.php');
  function databaseOutput() {
  if(isset($_POST['sub'])){
                            $su_id=$_POST['sub'];
							$year=$_POST['year'];
							$sem=$_POST['sem'];

    $query = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem'") or die(mysqli_error($conn));
	 $total=mysqli_num_rows($query);
	  $f = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='F' and mode='1'") or die(mysqli_error($conn));
	  $fail=mysqli_num_rows( $f);
	  $d = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and mode='1'") or die(mysqli_error($conn));
	     $ds=mysqli_num_rows($d);
		 $ft = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and mode='1'") or die(mysqli_error($conn));
	     $ftt=mysqli_num_rows($ft);
	   $p = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='P' and mode='1'") or die(mysqli_error($conn));
	    $pass=mysqli_num_rows($p);
	    $cp = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='CP' and mode='1'") or die(mysqli_error($conn));
	     $cpz=mysqli_num_rows($cp);
		  $mp = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='MP' and mode='1'") or die(mysqli_error($conn));
	     $mpz=mysqli_num_rows( $mp);
		 $d = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='D' and mode='1'") or die(mysqli_error($conn));
	     $dz=mysqli_num_rows($d);
		  $fd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='F' and mode='2'") or die(mysqli_error($conn));
	  $faild=mysqli_num_rows( $fd);
	   $pd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='P' and mode='2'") or die(mysqli_error($conn));
	    $passd=mysqli_num_rows($pd);
	    $cpd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='CP' and mode='2'") or die(mysqli_error($conn));
	     $cps=mysqli_num_rows($cpd);
		  $mpd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='MP' and mode='2'") or die(mysqli_error($conn));
	     $mps=mysqli_num_rows( $mpd);
		 $dd = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='D' and mode='2'") or die(mysqli_error($conn));
		 $dzd=mysqli_num_rows($dd);
		
		  $masF = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='F' and category='1'") or die(mysqli_error($conn));
	  $msF=mysqli_num_rows($masF);
	   $masP = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='P' and category='1'") or die(mysqli_error($conn));
	    $msP=mysqli_num_rows($masP);
	    $masCP = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='CP' and category='1'") or die(mysqli_error($conn));
	     $msCP=mysqli_num_rows($masCP);
		  $masMP = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='MP' and category='1'") or die(mysqli_error($conn));
	     $msMP=mysqli_num_rows($masMP);
		 $masD = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and comment='D' and category='1'") or die(mysqli_error($conn));
		 $msD=mysqli_num_rows($masD);
		  $Tmas = mysqli_query($conn,"select * from results where course_code='$su_id' and year='$year' and sem='$sem' and category='1'") or die(mysqli_error($conn));
	  $Tms=mysqli_num_rows($Tmas);
		
	     
		 $i=1;
		  while ($row = mysqli_fetch_array($query)) {
                           $student_id = $row['student_id'];
						   $results = mysqli_query($conn,"select * from subject where subject_code='$su_id'") or die(mysqli_error($conn));            
						   $results_row = mysqli_fetch_array($results);
?>                         
                            <tr>
                            <td><?php echo $i?></td>
						    <td><?php echo $row['student_id']?></td>
                             <td><?php echo $row['firstname']?></td> 
                             <td><?php echo $row['surname']?> </td>
                             <td> <?php echo $row ['course_code']?></td>  
                              <td><?php echo $row['assign_1']?> </td> 
                              <td> <?php echo $row['assign_2'] ?></td> 
                              <td><?php echo $row['EOS'] ?></td>
                              <td><?php echo $row['fgrade'] ?></td>
                              <td><?php echo $row['comment'] ?></td>
                               <td colspan="2" width="50"><?php echo $row['year']; ?></td>
                               </tr>
<?php    
   $i++;
  }

  ?>
  <tr> <td colspan="12" align="left">
  <div class="alert alert-info"><strong style="color:#FF0000; text-transform:uppercase;"><center><?php echo $results_row['subject_title']."&nbsp;&nbsp;".$year. "&nbsp;";if($sem==1)echo "Jan-June";else echo "July-Dec"?>&nbsp; Semester &nbsp;SUMMARY</strong></center><br>
  <?php if ( $results_row['category']!=1){?>
                        <div class="alert alert-danger"><strong>DISTANCE STUDENTS</strong><br />
                        <?php echo "<b>F:</b>" .$faild."&nbsp;&nbsp;&nbsp;&nbsp;<b>P:</b>" .$passd."&nbsp;&nbsp;&nbsp;&nbsp;<b>CP:</b>" .$cps ."&nbsp;&nbsp;&nbsp;&nbsp;<b>MP:</b>" .$mps."&nbsp;&nbsp;&nbsp;&nbsp;<b>D:</b>" .$dzd; ?>&nbsp;&nbsp; <b>Total Passes:</b><?php $ss= ($passd+$cps+$mps+$dzd); echo $ss;?><b> Total Fails:</b> <?php echo $faild ?>&nbsp;&nbsp;<b>Total distance:</b><?php echo $ds  ?>&nbsp;&nbsp;<b>Pass Rate:</b> <?php if($ds==0){$ds=1;} $s= (($ss/$ds)*100); echo round($s,1)."%" ?>
                        </div>
                        <div class="alert alert-danger"><strong >FULLTIME STUDENTS</strong><br />
                        <?php echo "<b>F:</b>" .$fail."&nbsp;&nbsp;&nbsp;&nbsp;<b>P:</b>" .$pass."&nbsp;&nbsp;&nbsp;&nbsp;<b>CP:</b>" .$cpz ."&nbsp;&nbsp;&nbsp;&nbsp;<b>MP:</b>" .$mpz."&nbsp;&nbsp;&nbsp;&nbsp;<b>D:</b>" .$dz; ?> &nbsp;&nbsp; <b>Total Passes:</b><?php  echo $pass+$cpz+$mpz+$dz;?> <b>Total Fails:</b> <?php echo $fail ?>&nbsp;&nbsp;<b>Total Fulltime:</b><?php echo $ftt  ?>&nbsp;&nbsp;<b>Pass Rate:</b> <?php if($ftt==0){$ftt=1;} $v=((($pass+$cpz+$mpz+$dz)/$ftt)*100); echo round($v,1)."%" ?>
                        </div>
                       
                       <div class="alert alert-danger"><strong>TOTAL CLASS STATICTICS</strong><br />
                        <?php echo "<b>F:</b>" .($faild+$fail)."&nbsp;&nbsp;&nbsp;&nbsp;<b>P:</b>" .($passd+$pass) ."&nbsp;&nbsp;&nbsp;&nbsp;<b>CP:</b>" .($cps+$cpz) ."&nbsp;&nbsp;&nbsp;&nbsp;<b>MP:</b>" .($mps+$mpz)."&nbsp;&nbsp;&nbsp;&nbsp;<b>D:</b>" .($dzd+$dz); ?> &nbsp;&nbsp; <b>Total Passes:</b><?php  $ps= (($pass+$cpz+$mpz+$dz)+($ss)); echo $ps;?> <b>Total Fails:</b> <?php echo $faild+$fail ?>&nbsp;&nbsp;<b>Total Class:</b><?php echo $total  ?>&nbsp;&nbsp;<b> Class Pass Rate:</b> <?php  if($total==0){$total=1;}$pp=(($ps/$total)*100); echo round($pp,1)."%" ?>
                        </div>
                         <?php }
						 
						 else
						 {
						 ?>
						 <div class="alert alert-danger"><strong>CLASS STATICTICS</strong><br />
                        <?php echo "<b>F:</b>" .($msF) ."&nbsp;&nbsp;&nbsp;&nbsp;<b>MP:</b>" .($msMP) ."&nbsp;&nbsp;&nbsp;&nbsp;<b>P:</b>" .($msP) ."&nbsp;&nbsp;&nbsp;&nbsp;<b>CP:</b>" .($msCP)."&nbsp;&nbsp;&nbsp;&nbsp;<b>D:</b>" .($msD); ?> &nbsp;&nbsp; <b>Total Passes:</b><?php  $pss= ($msP+$msMP+$msCP+$msD); echo $pss;?> <b>Total Fails:</b> <?php echo $msF ?>&nbsp;&nbsp;<b>Total Class:</b><?php echo $Tms  ?>&nbsp;&nbsp;<b> Class Pass Rate:</b> <?php  if($Tms==0){$Tms=1;}$pp=(($pss/$Tms)*100); echo round($pp,1)."%" ?>
                        </div>
						<?php 
						 }
						 ?>
                    
                         </div>
                         </tr>
<?php
} 
}// end of function databaseOutput()

if (isset($_POST['submit_docs'])) { // word output
 $su_id=$_POST['sub'];
 $results = mysqli_query($conn,"select * from subject where subject_code='$su_id'") or die(mysqli_error($conn));            
$results_row = mysqli_fetch_array($results);
$doc=$results_row['subject_title'];
  header("Content-Type:application/msExcel");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("content-disposition: attachment;filename=report.xls");

?>
<html>
  <body>
     
     <h3><center><font color="#0066FF">BLANTYRE INTERNATIONAL UNIVERSITY</font></center>
    <center><h3><?php echo $doc ."&nbsp;&nbsp; ".$_POST['year']."&nbsp;&nbsp;";if($_POST['sem']==1) echo "Jan-June";else echo "July-Dec"?>&nbsp;Semester &nbsp;Results</h3></center>
    <table  width="70%" align="center" border='1'>
      <tr  bgcolor="#DDDDDD">
  <th>No</th><th>StudentID</th><th>Firstname</th><th>Surname</th><th>Subject Code</th><th>Ass1</th><th>Ass2</th><th>EOS</th><th>Grade</th><th>Remarks</th><th colspan="2">Year</th>
      </tr>
      <?php databaseOutput(); ?>
    </table>
  </body>
</html>
<?php

  exit; // end of word output

}
?>
  </body>
</html>