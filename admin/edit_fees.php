<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); ?>
<?php
$added_by=$_COOKIE['id'];
?>
<body onLoad="StartTimers();" onmousemove="ResetTimers();">

    <div class="row-fluid">
        <div class="span12">

            <?php include('navbar.php'); ?>

            <div class="container">

                <div class="row-fluid">
                    <div class="span2">
                        <!-- left nav -->
                        <ul class="nav nav-tabs nav-stacked">

                            <li class="active">
                                <a href="enterfees.php"><i class="icon-plus-sign-alt icon-large"></i>&nbsp;Add fees</a>
                                <a href="file.php"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a>
                            </li>


                        </ul>
                        <!-- right nav -->
                    </div>
                    <div class="span10">

					<div class="hero-unit-3">
                        <ul class="thumbnails">
                            <li class="span7">
                                <div class="thumbnail">
                                    <div class="alert alert-info"><i class="icon-plus-sign-alt icon-large"></i>&nbsp;Enter fees for:&nbsp;<b><?php if(isset($_GET['uid']))
$UID=$_GET['uid'];
$mode=$_GET['mode'];
$year=date('Y');
$sem=checksem();
$sel=mysqli_query($conn,"select * from student_fees where id='$UID' and year='$year' and sem='$sem'");
$row=mysqli_fetch_array($sel);
$student_sel=mysqli_query($conn,"select * from student where id='$UID'") or die("error ho".mysqli_error($conn));
$student_row=mysqli_fetch_array($student_sel);	
$se2=mysqli_query($conn,"select * from student_fee_amounts") or die("error ho".mysqli_error($conn));
$row2=mysqli_fetch_array($se2);	
$myauth=mysqli_query($conn,"select * from user where user_id='$added_by' and auth=1")or die(mysqli_error($conn));
if(mysqli_num_rows($myauth)==0){?>
<div class="alert alert-danger"><i class="icon-remove-sign"></i>&nbsp;Access Denied.Wrong account</div>
<?php } else 
        {?>
									
									<?php  echo $student_row['firstname']." ".$student_row['lastname']."(".$student_row['student_id'].")";?></b></div>

                                    <form class="form-horizontal" method="POST">
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Fees Amount:</label>
                                            <div class="controls">
                                                <input type="text" name="un" id="inputEmail" value="<?php echo $row['total_amount'] ?>" required>
                                                <input type="hidden" name="id"  value="<?php echo $UID;?>" >
                                                 <input type="hidden" name="remove"  value="<?php echo $_GET['amount'];?>" >
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <div class="controls">

                                                <button type="submit" name="save" class="btn btn-info"><i class="icon-save icon-large"></i>&nbsp;Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="alert alert-info"></i>&nbsp;Edit the balance below</div>
                                   <form class="form-horizontal" method="POST" action="">
                                        <div class="control-group">
                                            <label class="control-label" for="inputEmail">Fees Amount:</label>
                                            <div class="controls">
                                                <input type="text" name="b" id="inputEmail" value="<?php echo $row['fee_balance'] ?>" required>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <div class="controls">

                                                <button type="submit" name="save2" class="btn btn-info"><i class="icon-save icon-large"></i>&nbsp;Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['save'])) {
                                        $amount = $_POST['un'];
                                        $id = $_POST['id'];
										 $remove = $_POST['remove'];
                                        $Today = date('y:m:d');
                                        $new = date('l, F d, Y', strtotime($Today));                                         
                                        $sem=checksem();
										$year= date('Y');                                  
										 if($remove==''){
										 $msg="there is no amount to edit click add sign to add new fees";
										 }
										 else
										 {
									   if($mode==1) $fee=$row2['fulltime']+$row['interest'];
									    if($mode==2) $fee=$row2['distance']+$row['interest'];
										if($mode==3) $fee=$row2['biu']+$row['interest'];
										if($mode==4) $fee=$row2['nobiu']+$row['interest'];
									  
									  if($amount>$fee){
									  $msg="invalid fee amount";
									  }
									  else
									  {
									   $balace= $fee-$amount;
									   if($balace==0)$exam_no=GenKey();else $exam_no=" ";
									    mysqli_query($conn,"update student_fees set total_amount='$amount', fee_balance='$balace',amount_paid='$amount',user_id='$added_by',last_pay_date='$new',exam_no='$exam_no' where year='$year' and sem='$sem' and id='$id'")or die("here me".mysqli_error($conn));
									                               
										mysqli_query($conn,"update total_revenue set t_revenue=t_revenue-$remove where year='$year' and sem='$sem'") or die("here no".mysqli_error($conn));
										mysqli_query($conn,"update total_revenue set t_revenue=t_revenue+$amount where year='$year' and sem='$sem'") or die("herego".mysqli_error($conn));
                                        $msg="Fees info updated. Click back to go back.";
										}
										}
										}
									if(isset($msg)){ ?>
									<div class="alert alert-info"></i>&nbsp;<?php echo $msg; ?></div>
                                    <?php
									}
									if(isset($_POST['save2'])){
									mysqli_query($conn,"update student_fees set fee_balance='$_POST[b]' where id='$UID'")or die("herego".mysqli_error($conn));
									 $msg2="Fees balance updated to MWK".$_POST['b']. "Click back to go back.";
									 
									}
                                   
                              if(isset($msg2)){ ?>
									<div class="alert alert-info"></i>&nbsp;<?php echo $msg2; ?></div>
                                    <?php }?>
		<?php }?>
                                </div>
                            </li>

                        </ul>
						</div>



                    </div>
                </div>

                <?php include('footer.php'); ?>
            </div>
        </div>
    </div>




</body>
</html>


