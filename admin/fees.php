<?php
if(isset($_GET['send']))
{// if send
if($_GET['fees']==1)
{// open if fees=1
$year= $_GET['year'];
$sem= $_GET['sem'];
$cyear= $_GET['syear'];
$csem= $_GET['ssem'];
$sel=mysqli_query($conn,"select * from student_fees where year='$year' and sem='$sem' and fee_balance='0' and interest='0'") or die(mysqli_error($conn));
if(mysqli_num_rows($sel)==0)
{//open
$msg="No reports for the selection";
}//close
else
{ //open else
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
$id=$row['id'];
$uid=$row['user_id'];
$stud=mysqli_query($conn,"select * from student where id='$id' and stud_current_year='$cyear' and current_sem='$csem'") or die(mysqli_error($conn));
$st=mysqli_fetch_array($stud);
$user=mysqli_query($conn,"select * from user where user_id='$uid'") or die("error here".mysqli_error($conn));
$username=mysqli_fetch_array($user);
if($st['stud_current_year']==$cyear and $st['current_sem']==$csem){
?>
<tr class="odd gradeX">                    <td><?php echo $i ?> </td>             
                                       <td><?php echo $st['student_id']?> </td>
 					<td><?php echo $st['lastname']?> </td>
                                          <td><?php echo $st['firstname']?> </td>
                                           <td><?php if($st['mode']==1) echo "F";if($st['mode']==2)echo "D";if($st['category']==1)  echo "Masters";?> </td>
                                          <td><?php echo number_format( $row['total_amount'])?> </td>
                                          <td><?php echo number_format($row['fee_balance']+$row['interest'])?> </td>
                                          <td><?php echo $row['exam_no']?> </td>
                                          <td><?php echo $row['last_pay_date']?> </td>
                                          <td><?php echo $username['lastname']?> </td>
										   <td><?php echo $st['stud_current_year']?> </td>
										    <td><?php echo $st['current_sem']?> </td>
 </tr>
<?php
}
$i++;
}//close loop
}//close else
}//close if fees=1
if($_GET['fees']==2)
{// open if fees=2
$year= $_GET['year'];
$sem= $_GET['sem'];
$cyear= $_GET['syear'];
$csem= $_GET['ssem'];
$sel=mysqli_query($conn,"select * from student_fees where year='$year' and sem='$sem' and fee_balance>0 and user_id=5") or die(mysqli_error($conn));
if(mysqli_num_rows($sel)==0)
{//open
$msg="No reports for the selection";
}//close
else
{ //open else
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
$id=$row['id'];
$uid=$row['user_id'];
$stud=mysqli_query($conn,"select * from student where id='$id' and  stud_current_year='$cyear' and current_sem='$csem'") or die(mysqli_error($conn));
$st=mysqli_fetch_array($stud);
$user=mysqli_query($conn,"select * from user where user_id='$uid'") or die(mysqli_error($conn));
$username=mysqli_fetch_array($user);
if($st['stud_current_year']==$cyear and $st['current_sem']==$csem){
?>
<tr class="odd gradeX">                                       <td><?php echo $i ?> </td>  
                                      <td><?php echo $st['student_id']?> </td>
 						<td><?php echo $st['lastname']?> </td>
                                          <td><?php echo $st['firstname']?> </td>
                                          <td><?php if($st['mode']==1) echo "F";if($st['mode']==2) echo "D";if(($st['mode']==3)or ($st['mode']==4)) echo "Masters";?> </td>
                                          <td><?php echo number_format($row['total_amount'])?> </td>
                                          <td><?php echo number_format($row['fee_balance']+$row['interest'])?> </td>
                                          <td><?php echo $row['exam_no']?> </td>
                                          <td><?php echo $row['last_pay_date']?> </td>
                                          <td><?php echo $username['lastname']?> </td>
										  <td><?php echo $st['stud_current_year']?> </td>
										    <td><?php echo $st['current_sem']?> </td>
 </tr>
<?php

$i ++;
}
}//close loop
}//close else
}//close if fees=2
if($_GET['fees']==4)
{// open if fees=4
$year= $_GET['year'];
$sem= $_GET['sem'];
//$cyear= $_GET['syear'];
//$csem= $_GET['ssem'];

$sel=mysqli_query($conn,"select * from student_fees where year='$year' and sem='$sem' and total_amount<>0") or die(mysqli_error($conn));
if(mysqli_num_rows($sel)==0)
{//open
$msg="No reports for the selection";
}//close
else
{ //open else
$i=1;
$sum=0;
while($row=mysqli_fetch_array($sel)){//open loop
$id=$row['id'];
$sum = $sum  +  $row['total_amount'];
$uid=$row['user_id'];
$stud=mysqli_query($conn,"select * from student where id='$id' ") or die(mysqli_error($conn));
$st=mysqli_fetch_array($stud);
$user=mysqli_query($conn,"select * from user where user_id='$uid'") or die("error here".mysqli_error($conn));
$username=mysqli_fetch_array($user);
//if($st['stud_current_year']==$cyear and $st['current_sem']==$csem){
?>
<tr>                    
                                         <td><?php echo $i ?> </td>             
                                         <td><?php echo $st['student_id']?> </td>
 					                     <td><?php echo $st['lastname']?> </td>
                                          <td><?php echo $st['firstname']?> </td>
                                          <td><?php if($st['mode']==1) echo "F";if($st['mode']==2)echo "D";if($st['category']==1)  echo "Masters";?> </td>
                                          <td><?php echo number_format($row['total_amount'])?> </td>
                                          <td><?php echo number_format($row['fee_balance']+$row['interest'])?> </td>
                                          <td><?php echo $row['exam_no']?> </td>
                                          <td><?php echo $row['last_pay_date']?> </td>
                                          <td><?php echo $username['lastname']?> </td>
										  <td> </td>
										  <td>  </td>
 </tr>
<?php
//}
$i++;
}//close loop
?>
<label class="alert alert-info">TOTAL REVENUE COLLECTED IN THE SEMESTER: MWK <?php echo number_format($sum); ?></label>
<?php
}//close  
}//close if fees=4
if($_GET['fees']==3)
{// open if fees=2
$year= $_GET['year'];
$sem= $_GET['sem'];
$cyear= $_GET['syear'];
$csem= $_GET['ssem'];
$sel=mysqli_query($conn,"select * from student where  id NOT IN(select id from student_fees where year=$year and sem=$sem)") or die(mysqli_error($conn));
if(mysqli_num_rows($sel)==0)
{//open
$msg="No reports for the selection";
}//close
else
{ //open else
$i=1;
while($row=mysqli_fetch_array($sel)){//open loop
$id=$row['id'];
$stud=mysqli_query($conn,"select * from student where id='$id' and stud_current_year='$cyear' and current_sem='$csem'") or die(mysqli_error($conn));
$st=mysqli_fetch_array($stud);
//$user=mysqli_query($conn,"select * from user where user_id='$uid'") or die(mysqli_error($conn));
//$username=mysqli_fetch_array($user);
if($st['stud_current_year']==$cyear and $st['current_sem']==$csem){
?>
<tr>                                     <td><?php echo $i ?> </td>  
                                       <td><?php echo $st['student_id']?> </td>
 										<td><?php echo $st['lastname']?> </td>
                                          <td><?php echo $st['firstname']?> </td>
                                           <td><?php if($st['mode']==1) echo "F";if($st['mode']==2) echo "D";if(($st['mode']==3)or ($st['mode']==4)) echo "Masters";?> </td>
                                          <td><?php // echo $st['dept']?> </td>
                                          <td><?php //echo $st['sem']?> </td>
                                          <td><?php  //echo $st['stud_current_year']?> </td>
                                          <td><?php //echo $row['last_pay_date']?> </td>
                                          <td><?php  // echo $username['lastname']?> </td>
										  <td><?php echo $st['stud_current_year']?> </td>
										    <td><?php echo $st['current_sem']?> </td>
 </tr>
<?php
$i++;
}
}//close loop
}//close else
}//close if fees=2
}//close if send

?>
