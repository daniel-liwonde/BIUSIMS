<?php
if(isset($_GET['send']))
{// if send
//$year= $_GET['addmyear'];
$sem= $_GET['sem'];
$cyear= $_GET['year'];
$selec= $_GET['sel'];
$mode= $_GET['mode'];
if(($mode==1) or ($mode==2)){
if($selec=='')//open mode
$sel=mysqli_query($conn,"select * from student where current_sem='$sem' and stud_current_year='$cyear' and mode='$mode'") or die("here".mysqli_error($conn));
else
$sel=mysqli_query($conn,"select * from student where current_sem='$sem' and stud_current_year='$cyear' and cys='$selec' and mode='$mode'") or die("here".mysqli_error($conn));
}
if($mode==4){
if($selec=='')
$sel=mysqli_query($conn,"select * from student where current_sem='$sem' and stud_current_year='$cyear' and category='1'") or die("here".mysqli_error($conn));
else
$sel=mysqli_query($conn,"select * from student where current_sem='$sem' and stud_current_year='$cyear' and cys='$selec' and category='1'") or die("here".mysqli_error($conn));
}
if($mode==3)
{
if($selec=='')
$sel=mysqli_query($conn,"select * from student where current_sem='$sem' and stud_current_year='$cyear'") or die("here".mysqli_error($conn));
else
$sel=mysqli_query($conn,"select * from student where current_sem='$sem' and stud_current_year='$cyear' and cys='$selec'") or die("here".mysqli_error($conn));
}
if($cyear==5){
if(($mode==3)&&($selec==''))
$sel=mysqli_query($conn,"select * from student") or die("here".mysqli_error($conn));
else
$sel=mysqli_query($conn,"select * from student where cys='$selec'") or die("here".mysqli_error($conn));
if(($mode==4)&&($selec==''))
$sel=mysqli_query($conn,"select * from student where category='1'") or die("here".mysqli_error($conn));
else
$sel=mysqli_query($conn,"select * from student where category='1' and cys='$selec'") or die("here".mysqli_error($conn));
if(($mode==2)or($mode==1) && ($selec==''))
$sel=mysqli_query($conn,"select * from student where mode='$mode'") or die("here".mysqli_error($conn));
else
$sel=mysqli_query($conn,"select * from student where mode='$mode' and cys='$selec'") or die("here".mysqli_error($conn));
}
if(($cyear==5)&& ($mode==3))
$sel=mysqli_query($conn,"select * from student") or die("here".mysqli_error($conn));
if(mysqli_num_rows($sel)==0)
{//open
$msg="No reports for the selection";
}//close
else
{ //open else
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F"; if($row['mode']==2)echo "D"; if($row['mode']==3) echo "Masters"?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['stud_pnone']?> </td>
                                          <td><?php echo $row['stud_email']?> </td>
                                          
                                          <td><?php echo $row['gender']?> </td>
										  <td><?php echo $row['stud_address']?> </td>
										  <td><?php echo $row['addm_year']?> </td>
                                        
 </tr>
<?php
$i++;
}//close loop
}//close else
}//close if fees=1

?>
