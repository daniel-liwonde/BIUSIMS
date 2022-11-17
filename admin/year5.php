<?php
$y5semf=mysqli_query($conn,"select distinct year,sem from results where uid=$sname and stud_year='5' and studsem='1'") or die(mysqli_error($conn));
$y51=mysqli_fetch_array($y5semf);
$y5f=$y51['year'];
 if($y51['sem']==1) $tag51="Jan-Jun";else $tag51="July-Dec";
?>
<tr><th colspan="4" align="left">First Semester&nbsp;(<?php echo $tag51 ."&nbsp;". $y5f; ?>)  </th><th colspan="2">Year Five</th><th></th></tr>
<tr align="center"><th align="left">No</th><th align="left" width="100" >Course code</td><th align="left">Course Name</td><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr>
<?php
$f=1;
$vv3=0;
$getsemy5=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='5' and studsem='1'") or die(mysqli_error($conn));
$t4=mysqli_num_rows($getsemy5);
while($rowy5=mysqli_fetch_array($getsemy5))
{//open while sem1 year2
$subcodey5=$rowy5['course_code'];
$subjecttitley5=mysqli_query($conn,"select * from subject where subject_code='$subcodey5'")or die(mysqli_error($conn));
$suby5=mysqli_fetch_array($subjecttitley5);
$year5=$rowy5['year'];
$valid=$suby5['offered_year'];
?>
<tr align="center">
<td align="left"><?php echo $f; ?></td><td><?php echo $subcodey5 ?></td><td align="left"><?php echo $suby5['subject_title'] ?></td><td>03.00</td><td><?php echo $rowy5['fgrade'] ?></td><td align="left"><?php echo $rowy5['comment']?></td>
<tr>
<?php
if(($rowy5['comment']!='F') && $e<7 && $valid>=3){
$y5sem1=$y5sem1+$rowy5['fgrade'];
$e++;
}
$vv3=$vv3+$rowy5['fgrade'];
$f++;
}//close while year5 sem1
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($t4==0)$cc4=0;else $cc4= $vv3/$t4; echo round($cc4,1);?></th><th><?php echo rateEOS($cc4); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $t4*03.00 ?></th></tr>
<?php
$y22=mysqli_query($conn,"select distinct year,sem from results where uid=$sname and stud_year='5' and studsem='2'") or die(mysqli_error($conn));
$y2s=mysqli_fetch_array($y22);
$y2ss=$y2s['year']; 
if($y2s['sem']==1) $tag22="Jan-Jun"; else $tag22="July-Dec"; 
?>
<tr><th colspan="4" align="left">&nbsp;   </th><th colspan="2">&nbsp;</th><th></th></tr>
<tr><th colspan="4" align="left">Second Semester&nbsp;(<?php echo $tag22."&nbsp;". $y2ss; ?>)  </th><th colspan="2"></th><th></th></tr>
<tr align="center"><th align="left">No</th><th align="left" width="100" >Course code</td><th align="left">Course Name</td><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr><?PHP
$z=1;
$vx=0;
$get5=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='5' and studsem='2'") or die(mysqli_error($conn));
$t5=mysqli_num_rows($get5);
while($r5=mysqli_fetch_array($get5))
{//open while sem1 year2
$sub5=$r5['course_code'];

$subj5=mysqli_query($conn,"select * from subject where subject_code='$sub5'")or die(mysqli_error($conn));
$sub25=mysqli_fetch_array($subj5);
$valid=$sub25['offered_year'];
?>
<tr align="center">
<td align="left"><?php echo $z; ?></td><td align="left"><?php echo $sub5 ?></td><td align="left"><?php echo $sub25['subject_title'] ?></td><td>03.00</td><th><?php echo $r5['fgrade'] ?></td><td align="left"><?php echo $r5['comment']; ?></td>
<tr>
<?php
if(($r5['comment']!='F') && $f5<7 && $valid>=3){
$y5sem2=$y5sem2+$r5['fgrade'];
$f5++;
}
$vx=$vx+$r5['fgrade'];
$z++;
}//close while year2 sem1 
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($t5==0)$cc5=0;else $cc5= $vx/$t5; echo round($cc5,1);?></th><th><?php echo rateEOS($cc5); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $t5*03.00 ?></th></tr>