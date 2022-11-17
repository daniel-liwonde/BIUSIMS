<?php
if(isset($_GET['send']))
{// if send
$sub= $_GET['subject'];
$year= $_GET['year'];
$sem=$_GET['sem'];
$i=1;
$sel=mysqli_query($conn,"select * from teacher_student,student where teacher_student.semester='$sem' and teacher_student.year='$year' and teacher_student.subject_id='$sub' and teacher_student.uid=student.id") or die("here".mysqli_error($conn));
while($row=mysqli_fetch_assoc($sel)){

?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";if($row['mode']==2) echo "D";if(($row['mode']==3) or( $row['mode']==4)) echo "Masters"?> </td>
                                          
                                        
 </tr>
<?php
$i++;
}//close loop
//}//close else
}//close if fees=1

?>
