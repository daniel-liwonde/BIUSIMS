<?php
$year= date('Y');
$sem= checksem();
?>

<?php

$sel=mysqli_query($conn,"select * from  budget_line where year='$year'  and sem='$sem' group by id ASC ") or die("here".mysqli_error($conn));
while($row=mysqli_fetch_array($sel)){//open loop
$idz=$row['id'];
$d=mysqli_query($conn,"select * from  budget_items where id ='$idz'") or die("here".mysqli_error($conn));
$detail=mysqli_fetch_array($d);
?>
<tr class="odd gradeX" align="center">                                 
                                       <td align="left"><?php echo $row['id']?> </td>
                                       <td><?php echo $detail['item'] ?></td>
 										<td><?php echo  number_format($row['amount']) ?></td>
                                        <td><?php echo number_format($row['exp']) ?></td>
                                        <td> <?php if($detail['description']=='') echo'-' ;?></td>
                                        <td><a href="del_bline.php?id=<?php echo $row['id']?>"> delete</a></td>
                                                                               
                                        
 </tr>
<?php
}//close loop
?>
