<?php
$y2sem1=mysqli_query($conn,"select distinct year,sem from results where uid=$sname and stud_year='2' and studsem='1'") or die(mysqli_error($conn));
$y21=mysqli_fetch_array($y2sem1);
$y2f=$y21['year'];
 if($y21['sem']==1) $tag21="Jan-Jun";else $tag21="July-Dec";
 if(mysqli_num_rows($y2sem1)>0)
 {
?>
<table border="1" align="center" width="100%">
<tr><th colspan="4" align="left">First Semester&nbsp;(<?php echo $tag21 ."&nbsp;". $y2f; ?>)  </th><th colspan="2">Year Two</th></tr>
<tr align="center"><th align="left">No</th><th align="left" width="100" >Course code</th><th align="left">Course Name</th><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr>
<?php
$y=1;
$yy2=0;
$getsemy2=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='2' and studsem='1'") or die(mysqli_error($conn));
$q=mysqli_num_rows($getsemy2);
while($rowy2=mysqli_fetch_array($getsemy2))
{//open while sem1 year2
$subcodey2=$rowy2['course_code'];
$subjecttitley2=mysqli_query($conn,"select * from subject where subject_code='$subcodey2'")or die(mysqli_error($conn));
$suby2=mysqli_fetch_array($subjecttitley2);
$year3=$rowy2['year'];
?>
<tr align="center">
<td align="left"><?php echo $y; ?></td><td><?php echo $subcodey2 ?></td><td align="left"><?php echo $suby2['subject_title'] ?></td><td>03.00</td><td><?php echo $rowy2['fgrade'] ?></td><td><?php echo $rowy2['comment'];?></td>
</tr>
<?php
$yy2=$yy2+$rowy2['fgrade'];
$y++;
}//close while year2 sem1
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($q==0)$bb=0;else $bb= $yy2/$q; echo round($bb,1);?></th><th><?php echo rateEOS($bb); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $q*03.00 ?>.00</th></tr>
</table>
<br>
<?php
 }
$y22=mysqli_query($conn,"select distinct year,sem from results where uid=$sname and stud_year='2' and studsem='2'") or die(mysqli_error($conn));
$y2s=mysqli_fetch_array($y22);
$y2ss=$y2s['year']; 
if($y2s['sem']==1) $tag22="Jan-Jun"; else $tag22="July-Dec"; 
 if(mysqli_num_rows($y22)>0)
 {
?>
<table border="1" align="center" width="100%">

<tr><th colspan="4" align="left">Second Semester&nbsp;(<?php echo $tag22."&nbsp;". $y2ss; ?>)  </th><th colspan="2"></th></tr>
<tr align="center"><th align="left">No</th><th align="left" width="100" >Course code</th><th align="left">Course Name</th><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr>
<?PHP
$z=1;
$yy22=0;
$get=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='2' and studsem='2'") or die(mysqli_error($conn));
$q2=mysqli_num_rows($get);
while($r=mysqli_fetch_array($get))
{//open while sem1 year2
$sub=$r['course_code'];
$subj=mysqli_query($conn,"select * from subject where subject_code='$sub'")or die(mysqli_error($conn));
$sub2=mysqli_fetch_array($subj);
?>
<tr align="center">
<td align="left"><?php echo $z; ?></td><td align="left"><?php echo $sub ?></td><td align="left"><?php echo $sub2['subject_title'] ?></td><td>03.00</td><td><?php echo $r['fgrade'] ?></td><td><?php echo $r['comment']?></td>
</tr>
<?php
$yy22=$yy22+$r['fgrade'];
$z++;
}//close while year2 sem1 
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($q2==0)$bb2=0;else $bb2= $yy22/$q2; echo round($bb2,1);?></th><th><?php echo rateEOS($bb2); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $q2*03.00 ?>.00</th></tr>
</table>
<br>
 <?php }?>