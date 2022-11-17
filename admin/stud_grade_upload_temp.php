<?php
if(isset($_GET['send']))
{// if send
$year= $_GET['year'];
$sub= $_GET['subject'];
$sem=$_GET['sem'];
$i=1;
$cel=4;
$sel=mysqli_query($conn,"select * from teacher_student,student where teacher_student.semester='$sem' and teacher_student.year='$year' and teacher_student.subject_id='$sub' and teacher_student.uid=student.id") or die("here".mysqli_error($conn));
while($row=mysqli_fetch_assoc($sel)){
if($i%2==0) $olor="#F5F5F5"; else $olor="white";
?>
<tr class="odd gradeX" align="left" bgcolor="<?php echo $olor ?>" >                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td> </td>
                                           <td> </td>
                                           <td> </td>
                                           <td><?php echo"=(((D" .$cel ."+E".$cel.")/200)*40)+((F".$cel."/100)*60)" ?>  </td>
                                           
                                          
                                        
 </tr>
<?php
$cel++;
$i++;
}//close loop
//}//close else
}//close if fees=1

?>