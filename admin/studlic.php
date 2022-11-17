<?php
if(isset($_GET['send']))
{// if send
$year= date('Y');
$sub= $_GET['subject'];
$mode= $_GET['mode'];
$sem=checksem();
if($mode==1 or $mode==2)
$sel=mysqli_query($conn,"select * from teacher_student,student where teacher_student.semester='$sem' and teacher_student.year='$year' and teacher_student.subject_id='$sub' and student.mode='$mode' and teacher_student.uid=student.id") or die("here".mysqli_error($conn));
if($mode==4)
$sel=mysqli_query($conn,"select * from teacher_student,student where teacher_student.semester='$sem' and teacher_student.year='$year' and teacher_student.subject_id='$sub' and student.category='1' and teacher_student.uid=student.id") or die("here".mysqli_error($conn));
if($mode==3)
$sel=mysqli_query($conn,"select * from teacher_student,student where teacher_student.semester='$sem' and teacher_student.year='$year' and teacher_student.subject_id='$sub' and teacher_student.uid=student.id") or die("here".mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_assoc($sel)){

?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";if($row['mode']==2) echo "D";if(($row['mode']==3) or( $row['mode']==4)) echo "Masters"?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['stud_pnone']?> </td>
                                          <td><?php echo $row['stud_email']?> </td>
                                          
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
}//close loop
//}//close else
}//close if fees=1

?>
