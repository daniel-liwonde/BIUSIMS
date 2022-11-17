<?php
//include('functions.php');
function allprog_bothmode_bothgender($year,$sem)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$year' and sem='$sem'  ") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                           <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}//close if fees=1
function prog_bothmode_bothgender($year,$sem,$p)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$year' and sem='$sem' and cys='$p'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                           <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender'] ?></td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}//close if fees=1
function allprog_bothmode_female($year,$sem)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$year' and sem='$sem' and gender='female'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                           <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}//close if fees=1
function allprog_bothmode_male($year,$sem)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$year' and sem='$sem' and gender='male'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}//close if fees=1
function allprog_bothmode_female_distance($y,$sem)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem' and gender='female' and mode=2") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}//close if fees=1
function allprog_bothmode_male_distance($y,$sem)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem' and gender='male' and mode=2") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                           <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}//close if fees=1
function allprog_bothmode_male_full($y,$sem)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem' and gender='male' and mode=1") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                           <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}//close if fees=1
function allprog_bothmode_female_full($y,$sem)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem' and gender='female' and mode=1") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}//close if fees=1

function allprog_distance_all($y,$sem)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem'  and mode=2") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}
function allprog_full_all($y,$sem)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem'  and mode=1") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                           <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}//close if fees=1
function prog_distance_all($y,$sem,$pro)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem'  and mode=2 and cys='$pro'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                           <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}
function prog_full_all($y,$sem,$pro)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem'  and mode=1 and cys='$pro'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}
function prog_distance_female($y,$sem,$pro)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem'  and mode=2 and cys='$pro' and gender='female'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                           <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}
function prog_full_female($y,$sem,$pro)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem'  and mode=1 and cys='$pro' and gender='female'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}
function prog_full_male($y,$sem,$pro)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem'  and mode=1 and cys='$pro' and gender='male'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                           <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}
function prog_distance_male($y,$sem,$pro)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem'  and mode=2 and cys='$pro' and gender='male'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}
 function prog_bothmode_male($y,$sem,$pro)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem'   and cys='$pro' and gender='Male'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}
function prog_bothmode_female($y,$sem,$pro)
{
$sel=mysqli_query($conn,"select * from student where   addm_year='$y' and sem='$sem' and gender='female'  and cys='$pro'") or die(mysqli_error($conn));
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">  <td><?php echo $i;?> </td>                               
                                       <td align="left"><?php echo $row['student_id']?> </td>
 										<td><?php echo $row['lastname']?> </td>
                                          <td><?php echo $row['firstname']?> </td>
                                           <td><?php if($row['mode']==1) echo "F";else echo "D";?> </td>
                                          <td><?php echo $row['cys']?> </td>
                                          <td><?php echo $row['stud_current_year']?> </td>
                                          <td><?php echo $row['current_sem']?> </td>
                                          <td><?php echo $row['addm_year']?> </td>
                                          <td><?php if ($row['sem']==1)echo "Jan-June"; else echo "July-Dec"; ?> </td>
                                          <td><?php echo $row['gender']?> </td>
                                        
 </tr>
<?php
$i++;
//}//close loop
}//close else
}
if(isset($_GET['send']))

{// if send
//$year= $_GET['addmyear'];
$sems=$_GET['s'];
$y=$_GET['year'];
//$sem= $_GET['sem'];
//$cyear= $_GET['year'];
$mode= $_GET['mode'];
$prog= $_GET['prog'];
$gender= $_GET['gender'];
if($prog=="xx1"){
if($gender==3 and $mode==3)
allprog_bothmode_bothgender($y,$sems);	
if($gender==2 && $mode==3)
allprog_bothmode_female($y,$sems);
if( $gender==1 && $mode==3)
allprog_bothmode_male($y,$sems);
if($gender==2 && $mode==2)
allprog_bothmode_female_distance($y,$sems);
if($gender==2 && $mode==1)
allprog_bothmode_female_full($y,$sems);
if($gender==1 && $mode==1)
allprog_bothmode_male_full($y,$sems);
if($gender==1 && $mode==2)
allprog_bothmode_male_distance($y,$sems);
if($gender==3 && $mode==2)
allprog_distance_all($y,$sems);
if($gender==3 && $mode==1)
allprog_full_all($y,$sems);
}

else
{
if($gender==3 && $mode==2)	
prog_distance_all($y,$sems,$prog);
if($gender==3 && $mode==1)	
prog_full_all($y,$sems,$prog);
if($gender==1 && $mode==1)		
prog_full_male($y,$sems,$prog);	
if($gender==2 && $mode==1)
prog_full_female($y,$sems,$prog)	;
if($gender==2 && $mode==2)
prog_distance_female($y,$sems,$prog);
if($gender==1 && $mode==2)
prog_distance_male($y,$sems,$prog);
if($gender==3 && $mode==3)
prog_bothmode_bothgender($y,$sems,$prog);
if($gender==1 && $mode==3)
prog_bothmode_male($y,$sems,$prog);
if($gender==2 && $mode==3)
prog_bothmode_female($y,$sems,$prog);
}

}
?>
