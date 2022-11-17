<?php
$getresults=mysqli_query($conn,"select * from results where uid=$sname and stud_year='1' and studsem='1' and category='1'") or die(mysqli_error($conn));
$i=1;
$year1;
$x1=0;
$p1=mysqli_num_rows($getresults);
while($row=mysqli_fetch_array($getresults))
{//open while sem1
$subcode=$row['course_code'];
$subjecttitle=mysqli_query($conn,"select * from subject where subject_code='$subcode' and category='1'")or die(mysqli_error($conn));
$sub=mysqli_fetch_array($subjecttitle);
$year1=$row['year'];

?>
<tr align="center">
<td align="left"><?php echo $i; ?></td><td align="left"><?php echo $subcode ?></td><td align="left"><?php echo $sub['subject_title'] ?></td></td><td>03.00</td><td><?php echo $row['fgrade'] ?></td><td ><?php echo $row['comment'] ?></td>
</td>
<tr>
<?php
if($row['comment']!='F'){
$y1sem1=$y1sem1+$row['fgrade'];
$a++;
}
$x1=$x1+$row['fgrade'];
 $i++;
}//close while sem1
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php $aa= $x1/$p1; echo round($aa,1); ?></th><th><?php echo rateEOSmasters($aa); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $p1*03.00 ?>.00</th></tr>
<?php
$y1semll=mysqli_query($conn,"select distinct year,sem,studsem from results where uid=$sname and stud_year='1' and studsem='2' and category='1'") or die(mysqli_error($conn));
$y12=mysqli_fetch_array($y1semll);
$y1sec=$y12['year'];
 if($y12['sem']==1) $tag12="Jan-Jun";else $tag12="July-Dec";
?>
<tr><th colspan="4" align="left">&nbsp;   </th><th colspan="2">&nbsp;</th><th></th></tr>
<tr><th colspan="4" align="left">Second Semester&nbsp;(<?php echo $tag12. "&nbsp;".$y1sec; ?>)  </th><th colspan="2"></th><th></th></tr>
<tr align="center"><th align="left">No</th><th align="left" width="100" >Course code</td><th align="left">Course Name</td><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr>
<?PHP
$year2;
$sem2=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='1' and studsem='2' and category='1'") or die(mysqli_error($conn));
$x=1;
$x2=0;
$p2=mysqli_num_rows($sem2);
while($row2=mysqli_fetch_array($sem2))
{//open while sem2
$year2=$row2['year'];
$subcode2=$row2['course_code'];
$subjecttitle2=mysqli_query($conn,"select * from subject where subject_code='$subcode2' and category='1'")or die(mysqli_error($conn));
$sub2=mysqli_fetch_array($subjecttitle2);
?>
<tr align="center">
<td align="left"><?php echo $x; ?></td><td><?php echo $subcode2 ?></td><td align="left"><?php echo $sub2['subject_title'] ?></td><td>03.00</td><td><?php echo $row2['fgrade'] ?></td><td><?php echo $row2['comment']?></td>
<tr>
<?php
if($row2['comment']!='F'){
$y1sem2=$y1sem2+$row2['fgrade'];
$b++;
}
$x2=$x2+$row2['fgrade'];
$x++;
}//close while sem2 year1
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($p2==0)$aa2=0;else $aa2= $x2/$p2; echo round($aa2,1);?></th><th><?php echo rateEOSmasters($aa2); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $p2*03.00 ?>.00</th></tr>