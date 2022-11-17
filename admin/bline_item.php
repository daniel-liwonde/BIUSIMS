<?php
$year= date('Y');
$sem= checksem();
?>

<?php

$sel=mysqli_query($conn,"select * from  budget_items group by id ASC ") or die("here".mysqli_error($conn));
while($row=mysqli_fetch_array($sel)){//open loop
?>
<tr class="odd gradeX" align="center">                                 
                                       <td align="left"><?php echo $row['id']?> </td>
                                       <td><?php echo $row['item'] ?></td>
                                        <td><center><?php if($row['description']=='') echo '-'; ?></center></td>
                                        <td><a href="#id<?php echo $row['id']; ?>" role="button"  data-toggle="modal"> delete</a></td>
                                                                               
                                        
 </tr>
  <!-- user delete modal -->
                                    <div id="id<?php echo $row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">This operation will alter your system <strong>Expenditure Reports</strong>&nbsp;Continue?</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                            <a href="del_item.php?id=<?php echo $row['id']?>" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Delete</a>
                                        </div>
                                    </div>
                                     
                                    <!-- end delete modal -->
<?php
}//close loop
?>
