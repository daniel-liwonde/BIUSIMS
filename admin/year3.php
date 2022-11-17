<?php
$y3semf=mysqli_query($conn,"select distinct year,sem,studsem from results where uid=$sname and stud_year='3' and studsem='1'") or die(mysqli_error($conn));
$y31=mysqli_fetch_array($y3semf);
$y3f=$y31['year'];
 if($y31['studsem']==1) $tag31="First Semester";else $tag31="Second Semester";
  if(mysqli_num_rows($y3semf)>0)
  {
?>
<table border="1" align="center" width="100%">
<tr><th colspan="4" align="left"><?php echo $tag31; ?>(Jan-June&nbsp;<?php echo $y3f; ?>) </th><th colspan="2">Year Three</th></tr>
<tr align="center"><th align="left">No</th><th align="left" width="100" >Course code</td><th align="left">Course Name</td><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr>
<?php
$u=1;
$vv=0;
$gety3=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='3' and studsem='1'") or die(mysqli_error($conn));
$t=mysqli_num_rows($gety3);
while($rowy3=mysqli_fetch_array($gety3))
{//open while year3 sem1
$subcodey3=$rowy3['course_code'];
$subjecttitley3=mysqli_query($conn,"select * from subject where subject_code='$subcodey3'")or die(mysqli_error($conn));
$suby3=mysqli_fetch_array($subjecttitley3);
$valid=$suby3['offered_year'];
?>
<tr align="center">
<td align="left"><?php echo $u; ?></td><td align="left"><?php echo $subcodey3  ?></td><td align="left"><?php echo $suby3['subject_title'] ?></td><td>03.00</td><td><?php echo $rowy3['fgrade'] ?></td><td><?php echo $rowy3['comment']?></td>
<tr>
<?php
if(($rowy3['comment']!='F') && $a<7 && $valid>=3){
$y3sem1=$y3sem1+$rowy3['fgrade'];
$a++;
}
$vv=$vv+ $rowy3['fgrade'];
$u++;
}//close while year3 sem2
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($t==0)$cc=0;else $cc= $vv/$t; echo round($cc,1);?></th><th><?php echo rateEOS($cc); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $t*03.00 ?>.00</th></tr>
</table>
<br>
<?php
}
$y3sems=mysqli_query($conn,"select distinct studsem,year,sem from results where uid=$sname and stud_year='3' and studsem='2'") or die(mysqli_error($conn));
$y32=mysqli_fetch_array($y3sems);
$y3s=$y32['year'];
 if($y32['studsem']==1) $tag32="First semester";else $tag32="Second Semester";
  if(mysqli_num_rows($y3sems)>0)
  {
?>
<table border="1" align="center" width="100%">

<tr><th colspan="4" align="left"><?php echo $tag32; ?>(July-Dec&nbsp;<?php echo  $y3s; ?>)  </th><th colspan="2">Year Three</th></tr>
<tr align="center"><th align="left">No</th><th align="left" width="100" >Course code</td><th align="left">Course Name</td><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr>
<?PHP
$v=1;
$vv2=0;
$getsem3=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='3' and studsem='2'") or die(mysqli_error($conn));
$t2=mysqli_num_rows($getsem3);
while($row3=mysqli_fetch_array($getsem3))
{//open while year 3 sem2
$subcode3=$row3['course_code'];
$subjecttitle3=mysqli_query($conn,"select * from subject where subject_code='$subcode3'")or die(mysqli_error($conn));
$sub3=mysqli_fetch_array($subjecttitle3);
$valid=$sub3['offered_year'];
?>
<tr align="center">
<td align="left"><?php echo $v; ?></td><td align="left"><?php echo $subcode3 ?></td><td align="left"><?php echo $sub3['subject_title'] ?></td><td>03.00</td><td><?php echo $row3['fgrade'] ?></td><td><?php echo $row3['comment']; ?></td>
<tr>
<?php
if(($row3['comment']!='F') && $b<7 && $valid>=3){
$y3sem2=$y3sem2+$row3['fgrade'];
$b++;
}
$vv2=$vv2+ $row3['fgrade'];
$v++;
}//close while year 3 sem2 
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($t2==0)$cc2=0;else $cc2= $vv2/$t2; echo round($cc2,1);?></th><th><?php echo rateEOS($cc2); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $t2*03.00 ?>.00</th></tr>
<?php
}
?>
</table>
<br>