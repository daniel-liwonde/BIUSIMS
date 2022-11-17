<?php
if(isset($_GET['send']))
{// if send
$year= $_GET['year'];
$sem= $_GET['sem'];
$total=0;
$total_exp=0;
$n=1;

$sel=mysqli_query($conn,"select * from  total_revenue where year='$year' and sem='$sem'") or die("here".mysqli_error($conn));
$xp=mysqli_query($conn,"select * from  expenses where year='$year' and exp_sem='$sem' and approved='1'") or die("here".mysqli_error($conn));
if(mysqli_num_rows($sel)==0)
{//open
$msg="No reports for the selection";
}//close
else
{ //open else
while($row=mysqli_fetch_array($sel)){//open loop
while($x=mysqli_fetch_array($xp)){
$total_exp=$total_exp+$x['amount'];
}
$total=$total+$row['t_revenue'];

?>
<tr class="odd gradeX" align="center">  
<td align="left"><?php echo $n?> </td>                               
                                       <td align="left"><?php echo number_format($total)?> </td>
 										<td><?php echo number_format($total_exp)?></td>
                                          <td><?php $b= $total-$total_exp; echo number_format($b);?></td> 
                                          <th><font color="#FF0000"><?php if($b>0) echo "Surplus" ;else echo "Deficit"?></font></th> 
                                                                               
                                        
 </tr>
<?php
$n++;
}//close loop
}//close else
}//close if send

?>
