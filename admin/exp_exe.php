<?php
if(isset($_GET['send']))
{// if send
$year= $_GET['year'];
$sem= $_GET['sem'];
$total=0;
$sel=mysqli_query($conn,"select distinct source from  expenses where year='$year' and exp_sem='$sem' and approved='1'") or die("here".mysqli_error($conn));
if(mysqli_num_rows($sel)==0)
{//open
$msg="No reports for the selection";
}//close
else
{ //open else
$totalxp=0;
$totalbl=0;
$totalbg=0;
while($row=mysqli_fetch_array($sel)){//open loop
$idz=$row['source'];
$totalac=0;
$d=mysqli_query($conn,"select * from  budget_items where id ='$idz'") or die("here".mysqli_error($conn));
$detail=mysqli_fetch_array($d);//geting the item name
$items=mysqli_query($conn,"select * from  budget_line where id ='$idz' and sem='$sem' ") or die("here".mysqli_error($conn));
$itd=mysqli_fetch_array($items);//getting item values
$sel2=mysqli_query($conn,"select * from  expenses where year='$year' and exp_sem='$sem' and approved='1' and source='$idz'")or die("here".mysqli_error($conn));

?>
<tr class="odd gradeX" align="center">                                 
                                       <td align="left"><?php echo $detail['item']?> </td>
 										<td><?php echo number_format($itd['amount'])?> </td>
                                        <?php
                                        while($t=mysqli_fetch_array($sel2)){
                                       $totalac= $totalac+$t['amount'];
                                               }
											   ?>
                                          <td><?php echo number_format($totalac);?> </td>
                                           <td colspan="2"><?php echo  number_format($itd['remander']);?> </td>  
                                                                               
                                        
 </tr>
 
<?php
$totalbg=$totalbg+$itd['amount'];
$totalbl=$totalbl+$itd['remander'];
$totalxp=$totalxp+$totalac;
}//close loop
?>

<tr> <th><font color="#FF0000">Totals</font> </th><th><font color="#FF0000"> <?php echo  number_format($totalbg) ?></th><th><font color="#FF0000"><?php echo  number_format($totalxp) ?></font> </th><th colspan="2"><font color="#FF0000"><?php echo  number_format($totalbl); ?></font></font></th>
<?php
}//close else
}//close if send

?>
