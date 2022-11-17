<?php
$sel=mysqli_query($conn,"select * from expenses where year='$year' and exp_sem='$sem' and approved='0'") or die("here".mysqli_error($conn));
while($row=mysqli_fetch_array($sel)){//open loop
$id=$row['source'];
$un=$row['exp_id'];
$sel2=mysqli_query($conn,"select * from  budget_items where  id='$id'")or die("here".mysqli_error($conn));
$t=mysqli_fetch_array($sel2);
$amount=$row['amount'];
?>
<tr class="odd gradeX" >                                 
                                       <td align="left"><?php echo $t['item']?> </td>
 										<td><?php echo  number_format($row['amount'])?> </td>
                                          <td><?php echo $row['exp_desc']?> </td>
                                           <td><?php echo $row['exp_date'];?> </td>
                                          <td><?php echo $row['year']?> </td>
                                          <td><?php if($row['exp_sem']==1) echo "Jan-June"; else echo "July-Dec"?> </td>
                                        <td>  <?php if($row['approved']==1) echo "<font color='green'>Aproved</font>"; else{?>
                                        <a    href="approved.php?id=<?php echo $id; ?>&amount=<?php echo $amount; ?>" class="btn btn-success">Approve</a><?php } ?></td>
                                           <td> 
                                           <a href="#view<?php echo $id; ?>" role="button"  data-toggle="modal" class="btn btn-danger">Decline</a></td>
                                                                                
                                        
 </tr>

<!-- user delete modal -->
                                    <div id="view<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger" >Enter reason for declining</div>
                                            <form action="approved.php" method="post" >
                                            Reason for declining<textarea cols="15" rows="5" name="ref" required>
                                            </textarea>
                                            <input type="hidden" name="rid" value="<?php echo $un; ?>" />
                                            <input type="hidden" name="am" value="<?php echo $row['amount']; ?>" />
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                           <button  class="btn btn-danger" type="submit" name="re">&nbsp;Send</button>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- end delete modal -->
                                    <?php
}//close loop
?>