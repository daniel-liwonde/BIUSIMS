<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); 
$sem=checksem();
$year=date('Y');
if($sem==1)$presem=2;else $presem=1;
$i=0; $i2=0;
if(isset($_POST['x'])){
//$query=mysqli_query($conn,"select * from student_fees where year='$year' and sem='$sem'") or die(mysqli_error($conn));
//if(mysqli_num_rows($query)==0)
//{
$ch=mysqli_query($conn,"select * from student_fees where year='$year' and sem='$sem'") or die("error ho".mysqli_error($conn));
if(mysqli_num_rows($ch)>0)
{
?>
<script language="JavaScript">

alert("Some fees are already entered. This operation shouldbe done before fees for semester is entered");
</script>
<?php
}
else
{
$bal=mysqli_query($conn,"select * from student_fees where fee_balance>0 and sem='$presem' and bpaid='0'") or die(mysqli_error($conn));
while($rows=mysqli_fetch_assoc($bal))
{
$sel=mysqli_query($conn,"select * from student where id='$rows[id]'") or die("error ho".mysqli_error($conn));
$row=mysqli_fetch_array($sel);
$se=mysqli_query($conn,"select * from student_fee_amounts") or die("error ho".mysqli_error($conn));
$row2=mysqli_fetch_array($se);
if($row['mode']==1){$total= $row2['fulltime']+ $rows['fee_balance']+$rows['interest'];}
if($row['mode']==3){$total= $row2['biu']+ $rows['fee_balance']+$rows['interest'];} 
if($row['mode']==4){$total= $row2['nobiu']+ $rows['fee_balance']+$rows['interest'];} 
if($row['mode']==2) $total=$row2['distance']+$rows['fee_balance']+$rows['interest'];
mysqli_query($conn,"update student_fees set bpaid='1' where id='$rows[id]' and sem='$presem'");
mysqli_query($conn,"insert into student_fees(id,fee_balance,sem,year) values('$rows[id]','$total','$sem','$year')") or die(mysqli_error($conn));
$i++;
//}
}
}
}

?>
<body onLoad="StartTimers();" onmousemove="ResetTimers();">

    <div class="row-fluid">
        <div class="span12">

            <?php include('navbar.php'); ?>

            <div class="container">

                <div class="row-fluid"><p>
 
 </p>
                    <div class="span12">
                        <div class="hero-unit-3">
                       <?php
                           $ss=mysqli_query($conn,"select*from interest") or die("mysq error".mysqli_error($conn));
									  $int=mysqli_fetch_array($ss);
									  $day=getdate();
									  $daz=$int['year_day'];
                                   $year_date= $day['yday'];
								   $new= $year_date-$daz;
								   ?>
                           
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                     <strong><i class="icon-user icon-large"></i>&nbsp;Student fees (Previous) &nbsp;</strong>
                                </div>
                                 <div style="float:left">
                                <form>
                                <select name="users"  required onChange="showUser2(this.value)">
                                            <option value="">select student </option>
                                            <?php
											 $ss=mysqli_query($conn,"select*from interest") or die("mysq error".mysqli_error($conn));
									  $int=mysqli_fetch_array($ss);
									  $status= $int['year_day'];
                                            $query = mysqli_query($conn,"select * from student order by lastname ASC ");
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['lastname']."&nbsp;".$row['firstname']."&nbsp; (".$row['student_id']; ?>)</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        
                                </form>
                                
                                </div>
                                <div >
                               
                                 <form method="post" action="" style="float:left">
                                Or Choose Programme&nbsp;<select name="prog"  required>
                                 
                                            <option value="">select program </option>
                                             <option value="1">All programmes</option>
                                            <?php
                                            $query = mysqli_query($conn,"select * from course");
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['course_id']; ?>"><?php echo $row['cys']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                       <input type="submit" value="Display" class="btn btn-success" style="margin-top:-9px">
                                </form>
               
                                
                               
                                </div>
                                 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                  <thead>
                                    <tr>


                                        <th width="69">StudentID</th>
                                      <th width="90" >Student Name</th>
                                      <th width="111">Amount Paid</th>
                                      <th width="60">Interest(<?php if($status==2) echo"<font color='red'>Inactive</font>"; else  echo"<font color='red'>Active</font>"; ?>)</th> 
                                      <th width="54">Balance</th>               
                                      <th width="130">Last Pay Date</th>
                                      <th width="96">Exam Number</th>
                                      <th width="66">Added By</th>
                                      <th width="100">Action</th>
                                    </tr>
                        
                                </thead>
                                <tbody>
                                    <?php 
									if(isset( $_POST['prog'])){ 
                                                                    
		                          $q = $_POST['prog'];
                                   if( $q==1)
{
   $student=mysqli_query($conn,"select * from student") or die(mysqli_error($conn));
}
else
{
                                   $student=mysqli_query($conn,"select * from student where cys='$q'") or die(mysqli_error($conn));
}
								   while($row=mysqli_fetch_array($student))
								   {
								   $ID=$row['id'];
								   $mode=$row['mode'];
								   $year=date('Y');
								   $sem=checksem();
								    $student_fees=mysqli_query($conn,"select * from student_fees where id=$ID and year='$year' and sem='$sem'") or die("error here" .mysqli_error($conn));
									$fee=mysqli_fetch_array($student_fees);
									 $fee_added_by=mysqli_query($conn,"select* from user where user_id='$fee[user_id]' ") or die("mysq error".mysqli_error($conn));
									 $found=mysqli_fetch_array($fee_added_by);
									 
									 
								   
                                        ?>
                                        


                                    <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                    
                                            $('#d<?php echo $student_ID; ?>').tooltip('show')
                                            $('#d<?php echo $student_ID; ?>').tooltip('hide')
                                        });
                                    </script>
                                    <!-- end script -->
                                     <!-- script -->
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                    
                                            $('#a<?php echo $ID; ?>').tooltip('show')
                                            $('#a<?php echo $ID; ?>').tooltip('hide')
                                        });
                                    </script>
                                    <!-- end script -->
                                    
                                    <td><?php echo  $row['student_id']; ?></td>
                                    <td><?php echo $row['lastname']." ".$row['firstname']; ?></td>
                                    <td><?php echo  number_format($fee['total_amount']); ?></td>
                                    <td><?php echo number_format(  $fee['interest']); ?></td>
                                    <td><?php echo  number_format($fee['fee_balance'],2); ?></td>
                                     <td><?php echo  $fee['last_pay_date']; ?></td>
                                    <td><?php echo  $fee['exam_no']; ?></td>
                                     
                                      <td><?php echo  $found['lastname']; ?></td>
                                    
                                    <td>
                                        <a rel="tooltip"  title="Enter fees" id="d<?php echo  $ID; ?>" href="enterfees2.php?uid=<?php echo  $ID; ?>" class="btn btn-success"><i class="icon-plus-sign icon-large"></i></a>
                                        <a rel="tooltip"  title="Edit fees info" id="a<?php echo  $ID ?>" role="button"  href="edit_fees.php?uid=<?php echo  $ID ?>&mode=<?php  echo  $mode ?>&amount=<?php  echo  $fee['total_amount'] ?>"class="btn btn-success"><i class="icon-edit icon-large"></i></a>
                                  
                                    </td>
                                   
                                    </tr>
                                <?php }} ?> 
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <?php include('footer.php'); ?>
            </div>
        </div>
    </div>





</body>
</html>


