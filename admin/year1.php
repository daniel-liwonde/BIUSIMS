<?php
$getresults=mysqli_query($conn,"select * from results where uid=$sname and stud_year='1' and studsem='1'") or die(mysqli_error($conn));
$i=1;
$year1;
$x1=0;
$p1=mysqli_num_rows($getresults);
if($p1!=0)
   {
	?>
	
<table border="1" align="center" width="100%">


<tr><th colspan="4" align="left">First Semester&nbsp;(<?php echo $y1sem ."&nbsp;".$y2s; ?>) </th><th colspan="2">Year One</th></tr>
<tr align="center"><th align="left">No</th><th align="left" width="100" >Course code</td><th align="left">Course Name</td><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr>
<?php
while($row=mysqli_fetch_array($getresults))
{//open while sem1
$subcode=$row['course_code'];
$subjecttitle=mysqli_query($conn,"select * from subject where subject_code='$subcode'")or die(mysqli_error($conn));
$sub=mysqli_fetch_array($subjecttitle);
$year1=$row['year'];

?>
<tr align="center">
<td align="left"><?php echo $i; ?></td><td align="left"><?php echo $subcode ?></td><td align="left"><?php echo $sub['subject_title'] ?></td></td><td>03.00</td><td><?php echo $row['fgrade'] ?></td><td ><?php echo $row['comment'] ?></td>
<tr>
<?php
$x1=$x1+$row['fgrade'];
 $i++;
}//close while sem1
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($p1==0)$aa=0;else  $aa= $x1/$p1; echo round($aa,1); ?></th><th><?php echo rateEOS($aa); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $p1*03.00 ?>.00</th></tr>
</table>
<br>
<?php
}
$y1sem2=mysqli_query($conn,"select distinct year,sem from results where uid=$sname and stud_year='1' and studsem='2'") or die(mysqli_error($conn));
$y12=mysqli_fetch_array($y1sem2);
$y1sec=$y12['year'];
 if($y12['sem']==1) $tag12="Jan-Jun";else $tag12="July-Dec";
 if(mysqli_num_rows($y1sem2)>0)
  {
?>
<table border="1" align="center" width="100%">

<tr><th colspan="4" align="left">Second Semester&nbsp;(<?php echo $tag12. "&nbsp;".$y1sec; ?>)  </th><th colspan="2"></th></tr>
<tr align="center"><th align="left">No</th><th align="left" width="100" >Course code</td><th align="left">Course Name</td><th>CreditHrs</th><th>Mark</th><th>Grade</th></tr>
<?PHP
$year2;
$sem2=mysqli_query($conn,"select * from results where uid='$sname' and stud_year='1' and studsem='2'") or die(mysqli_error($conn));
$x=1;
$x2=0;
$p2=mysqli_num_rows($sem2);
while($row2=mysqli_fetch_array($sem2))
{//open while sem2
$year2=$row2['year'];
$subcode2=$row2['course_code'];
$subjecttitle2=mysqli_query($conn,"select * from subject where subject_code='$subcode2'")or die(mysqli_error($conn));
$sub2=mysqli_fetch_array($subjecttitle2);
?>
<tr align="center">
<td align="left"><?php echo $x; ?></td><td><?php echo $subcode2 ?></td><td align="left"><?php echo $sub2['subject_title'] ?></td><td>03.00</td><td><?php echo $row2['fgrade'] ?></td><td><?php echo $row2['comment']?></td>
<tr>
<?php
$x2=$x2+$row2['fgrade'];
$x++;
}//close while sem2 year1
?>
<tr><th colspan="4" align="left">Semester Average</th><th><?php if($p2==0)$aa2=0;else $aa2= $x2/$p2; echo round($aa2,1);?></th><th><?php echo rateEOS($aa2); ?></th></tr>
<tr><th align="left"  colspan="3">Total Credit Hours Per Week</th><th align="center"><?php echo $p2*03.00 ?>.00</th></tr>
</table>
<br>
<?php }?>