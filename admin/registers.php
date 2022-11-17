<?php
if(isset($_GET['sub'])){
$id=$_GET['sub'];
$sem=checksem();
$year=date('Y');
$i=1;$m='#FFFFFF';
$sel=mysqli_query($conn,"select distinct uid from teacher_student where subject_id='$id' and year='$year' and semester='$sem'") or die("here".mysqli_error($conn));
while($row=mysqli_fetch_assoc($sel)){
$uid=$row['uid'];
$sel2=mysqli_query($conn,"select * from student_fees where id='$uid' and year='$year' and sem='$sem' and fee_balance='0'")or die("here".mysqli_error($conn));
$exam_row=mysqli_fetch_assoc($sel2);
$exam=$exam_row['exam_no'];
$theid=$exam_row['id'];
$sel3=mysqli_query($conn,"select * from student where id='$theid'")or die(mysqli_error($conn));
$student_row=mysqli_fetch_array($sel3);
if($i%2==0)$m='#F5F5F5';else $m='#FFFFFF';
if($exam!=''){
?>
<tr bgcolor="<?php echo $m ?>" >
<td><?php  echo $i  ?></td>
<td align="left"><?php echo $student_row['student_id']?></td>
<td><?php echo $student_row['lastname']?></td>
<td><?php echo $student_row['firstname']?></td>
<td><?php echo $exam;?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<?php  $i++;}}}?>

