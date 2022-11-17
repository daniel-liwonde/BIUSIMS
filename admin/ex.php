<?php
$year= date('Y');
$sem= checksem();
?>
<?php

$sel=mysqli_query($conn,"select * from  expenses where year='$year' and exp_sem='$sem' and approved='0' group by exp_id DESC ") or die("here".mysqli_error($conn));
while($row=mysqli_fetch_array($sel)){//open loop
$id=$row['source'];
$sel2=mysqli_query($conn,"select * from  budget_items where id='$id'") or die(mysqli_error($conn));
$row2=mysqli_fetch_array($sel2);
?>
<tr class="odd gradeX" align="center">                                 
                                       <td align="left"><?php echo $row2['item']?> </td>
 										<td><?php echo number_format($row['amount'])?></td>
                                        <td><?php echo  $row['exp_desc'] ?></td>
                                        <td><a href="del.php?id=<?php echo $row['exp_id']?>"> delete</a></td>
                                                                               
                                        
 </tr>
<?php
}//close loop
?>
