
<?php
$h=1;
$mav=0;
$getresults4=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='4' and studsem='1'") or die(mysqli_error($conn));
$nu1=mysqli_num_rows($getresults4);
if($nu1>0){
?>
<table border="1" align="center" width="100%" bgcolor="green">

<tr><th colspan="4" align="left">First Semester&nbsp;(<?php echo $tag41 ."&nbsp;" .$y4f; ?>)  </th><th colspan="2">Year Four</th></tr>
<tr align="center"><th align="left" width="30">No</th><th align="left" width="100" >Course code</td><th align="left">Course Name</td><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr>
<?php
while($row4=mysqli_fetch_array($getresults4))
{//open while sem1
$subcode4=$row4['course_code'];
$subjecttitle4=mysqli_query($conn,"select * from subject where subject_code='$subcode4'")or die(mysqli_error($conn));
$sub4=mysqli_fetch_array($subjecttitle4);
$valid=$sub4['offered_year'];
?>
<tr align="center">
<td align="left"><?php echo $h; ?></td><td align="left"><?php echo $subcode4 ?></td><td align="left"><?php echo $sub4['subject_title'] ?></td><td>03.00</td><td><?php echo $row4['fgrade'] ?></td><td><?php echo $row4['comment'];?></td>
</tr>
<?php
if(($row4['comment']!='F') && $c<7 && $valid>=3){
$y4sem1=$y4sem1+$row4['fgrade'];
$c++;
}
$mav=$mav+$row4['fgrade'];
$h++;
}//close while sem1
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($nu1==0)$ov=0;else $ov= $mav/$nu1; echo round($ov,0); ?></th><th><?php echo rateEOS($ov); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $nu1*03.00?>.00</th></tr>
</table>
<br>
<?php
}
$y4sems=mysqli_query($conn,"select distinct year,sem from results where uid=$sname and stud_year='4' and studsem='2'") or die(mysqli_error($conn));
$y42=mysqli_fetch_array($y4sems);
$y4s=$y42['year'];
if($y42['sem']==1) $tag42="Jan-Jun";else $tag42="July-Dec";
if(mysqli_num_rows($y4sems)>0)
{
?>
<table border="1" align="center" width="100%">

<tr><th colspan="4" align="left">Second Semester&nbsp;(<?php echo $tag42 ."&nbsp;" .$y4s;  ?>)  </th><th colspan="2">Year Four</th></tr>
<tr align="center"><th align="left">No</th><th align="left">Course code</td><th align="left">Course Name</td><th>CreditHrs</th><th width="120">Mark</th><th>Grade</th></tr>
<?PHP
$w=1;
$mav2=0;
$getsem42=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='4' and studsem='2'") or die(mysqli_error($conn));
$nu=mysqli_num_rows($getsem42);
while($row42=mysqli_fetch_array($getsem42))
{//open while year 4 sem2
$subcode42=$row42['course_code'];
$subjecttitle42=mysqli_query($conn,"select * from subject where subject_code='$subcode42'")or die(mysqli_error($conn));
$sub42=mysqli_fetch_array($subjecttitle42);
$valid=$sub42['offered_year'];
?>
<tr align="center">
<td align="left"><?php echo $w; ?></td><td align="left"><?php echo $subcode42 ?></td><td align="left"><?php echo $sub42['subject_title'] ?></td><td>03.00</td><td><?php echo $row42['fgrade'] ?></td><td><?php echo $row42['comment'];?></td>
<tr>
<?php
if(($row42['comment']!='F') && $d<7 && $valid>=3){
$y4sem2=$y4sem2+$row42['fgrade'];
$d++;
}
$mav2=$mav2+$row42['fgrade'];
$w++;
}//close while year 4 sem2 year1
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($nu==0)$ov2=0; else $ov2= $mav2/$nu; echo round($ov2,1); ?></th><th><?php echo rateEOS($ov2); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $nu*03.00 ?>.00</th></tr>
</table>
<br>
<?php }?>