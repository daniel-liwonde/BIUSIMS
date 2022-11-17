<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); 
$sem=checksem();
$year=date('Y');

?>
<style>
#fr a{ text-decoration: none;}
</style>
<body>

    <div class="row-fluid">
        <div class="span12">

            <?php include('navbar.php'); ?>

            <div class="container">

                <div class="row-fluid">
                    <div class="span2">
                        <!-- left nav -->
                        <div class="hero-unit-3" style="width:130%">
                    <div class="alert-index alert-success">
                        <i class="icon-calendar icon-large"></i>
                        <?php
                        $Today = date('y:m:d');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                    </div>
                </div>
                        <!-- right nav -->
                        <div class="hero-unit-1" style="width:140%">
                      <ul class="nav  nav-pills nav-stacked">
                        <li class="nav-header">Links</li>
                        <li >
                            <a href="home.php"><i class="icon-home icon-large"></i>&nbsp;Home
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>

                        </li>
                        <li class="dropdown">
                        <?php if(($l==1) or $l==2) {?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt icon-large"></i>&nbsp;Reports
                             <?php } else{?>
                            <a href="#" onClick="alert('ACCESS DENIED')"><i class="icon-list-alt icon-large"></i>&nbsp;Reports
                            <?php }?>
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>
                            <ul class="dropdown-menu" style="margin-left:103%; margin-top:-15%;">
                             <li> <a href="reports.php">Exam</a>   </li>
                             <li><a href="financials.php">Financial</a></li>
                              <li><a href="studentrepo.php">Students</a></li>
                              <li><a href="exp.php">Expenditure</a></li>
                               <li><a href="feez.php">Fees</a></li>
                            </ul>
                            
                            </li>                                                      
                              <li class="active">
                              <?php if(($l==1) or $l==2) {?>
                            <a href="settings.php"><i class="icon-group icon-large"></i>&nbsp;Settings
                            <?php } else{?>
                            <a href="#" onClick="alert('ACCESS DENIED')"><i class="icon-group icon-large"></i>&nbsp;Settings
                            <?php }?>
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <li>
                            <?php if(($l==1) or ($l==2) or ($l==6)) {?>
                            <a href="results.php"><i class="icon-group icon-large"></i>&nbsp;Student results
                             <?php } else{?>
                            <a href="#" onClick="alert('ACCESS DENIED')"><i class="icon-group icon-large"></i>&nbsp;Student results
                            <?php }?>
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            
 <li>
                            <a href="#a"  data-toggle="modal" ><i class="icon-group icon-large"></i>&nbsp;Update account 
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a> </li>
                            <!-- user delete modal -->
                                    <div id="a" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <form class="form-horizontal" method="post">
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Update password</div>
                                            
                                            
                                             
                                             <label> Password:<input type="text" name="pass" id="inputEmail"  value="<?php echo $us['password'] ?>" required></label>
                                             Confirm: &nbsp;&nbsp;<input type="text" name="pass2" id="inputEmail"  required>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                            <button type="submit" name="go" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Update</button>
                                        </div>
                                    </div>
                                     </form>
                                    <!-- end delete modal --> 
                                     <?php include('update.php');  ?>
                                      <li> 
                                       <?php if(($l==1) or ($l==2) or ($l==6)) {?>
                            <a href="transcript.php"><i class="icon-book icon-large"></i></i>&nbsp;Genarate Transcripts
                             <?php } else{?>
                            <a href="#" onClick="alert('ACCESS DENIED')"><i class="icon-group icon-large"></i>&nbsp;Genarate Transcripts
                            <?php }?>
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <li>
                           
							<?php if(($l==1) or ($l==2) or ($l==3)or ($l==4)) {?>
                            <a href="../teacher_home.php"><i class="icon-group icon-large"></i>&nbsp;Enter Grades
                               <?php } else{?>
                            <a href="#" onClick="alert('ACCESS DENIED')"><i class="icon-group icon-large"></i>&nbsp;Enter Grades
                            <?php }?>
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            
                    </ul>
                    </div>
                        
                        <!-- end nav-->
                    </div>
                    <div class="span10">
                        <div class="hero-unit-3" style="width:90%; margin-left:10%">
                            <div class="alert alert-info">
                            <i class="icon-plus-sign-alt icon-large"></i>&nbsp;Add Expenditure Request</div>
                            <?php
                            $sell=mysqli_query($conn,"select * from  expenses where year='$year' and exp_sem='$sem' and r_fresufal<>'' and status='0' and approved='2'" ) or die(mysqli_error($conn));
											if(mysqli_num_rows($sell)>0){
											?>
                                            <div class="alert alert-danger" > <a href="#fr" data-toggle="modal">You have some declined request. Click here to view them</a><br>
                                            
                                            </div>
                                            <?php }  ?>
                                            <!-- user delete modal -->
                                    <div id="fr" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Here are   <strong>Declined</strong>&nbsp; expenses</div>
                                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"  >
                                           
                                 <tr>
                                 <th>No</th>
                               <th>Expense ID</th>
                              <th>Amount</th>
                              <th>Date</th>
                              <th>Reason</th>
                              
                                                                 
                   </tr>
                   
                         
                                            <?php
											$i=1;
											while($row=mysqli_fetch_array($sell)){
											$id=$row['source'];
$sel2=mysqli_query($conn,"select * from  budget_items where id='$id'") or die(mysqli_error($conn));
$row2=mysqli_fetch_array($sel2);
											$exid=$row['exp_id'];
											?>
											<tr><td><?php echo $i?></td><td><?php echo $row2['item'] ?></td><td><?php echo $row['amount'] ?></td><td><?php echo  $row['exp_date']?></td><td><?php echo  $row['r_fresufal']?></td></tr>
                                            <?php
                                           
                                            mysqli_query($conn,"update expenses set status='1' where exp_id='$exid'") or die(mysqli_error($conn));
                                            $i++;
											}
											
											?>
                                                                                        </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
                                           
                                        </div>
                                    </div>
                                    <!-- end delete modal -->
                                        <form class="form-horizontal" method="POST">

                                            <div class="control-group">
                                                <label class="control-label" for="inputPassword">Source of funds</label>
                                                <div class="controls">
                                                    <select name="exp"  required>
                                                    <option value="">Select item</option>
                                                    <?php 
													$y=date('Y');
                                                    $s=Checksem();
                                                        $query=mysqli_query($conn,"select * from budget_line where year='$y' and sem='$s'");
														if(mysqli_num_rows($query)==0)
														echo"<option value=''>No budget found for this semester</option>";
														else{
                                                        while($row=mysqli_fetch_array($query)){
														
														$query2=mysqli_query($conn,"select * from budget_items where id='$row[id]'");
														$i=mysqli_fetch_array($query2);
                                                            ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $i['item']; ?></option>
                                                        <?php
                                                        }
														}
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputPassword">Amount</label>
                                                <div class="controls">
                                                    <input type="text" name="amount" id="inputPassword" placeholder="amount" required>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputPassword">Description:</label>
                                                <div class="controls">
                                                   <textarea cols="5" rows="5" required name="desc">
                                                   
                                                   </textarea>
                                                </div>
                                            </div>
                                            

                                            <div class="control-group">
                                                <div class="controls">

                                                    <button type="submit" name="save" class="btn btn-info"><i class="icon-save icon-large"></i>&nbsp;Add Expense </button>
                                                </div>
                                            </div>
                                        </form>

                                        <?php
                                        if (isset($_POST['save'])) {


                                            $exp = $_POST['exp'];
                                            $desc = $_POST['desc'];
											 $amount = $_POST['amount'];
                                            $sem = checksem();
										      $year=date('Y');
											$Today = date('y:m:d');
                                            $new = date('l, F d, Y', strtotime($Today));
											$by= $session_id;
											$day=date('d');
                                            $m=date('m');
											
											$sel2=mysqli_query($conn,"select * from  budget_line where id='$exp'") or die(mysqli_error($conn));
											$b=mysqli_fetch_array($sel2);
											$exam=$b['exp'];
											if($amount>$exam)
											{
											?>
                                            <div class="alert alert-danger"><li class="icon-remove-sign"></li>&nbsp;Item amount is greater than expected amount per month- MWK<?php echo number_format($exam)?> </div>
                                          
                                           <?php
											}
											else
											{
											if($amount>$b['amount'])
											{
											?>
         <div class="alert alert-danger"><li class="icon-remove-sign"></li>&nbsp;Item amount is greater than budget- MWK<?php echo number_format($b['amount'])?> </div>
                                          
                                           <?php
											}
											else
											{
                                            mysqli_query($conn,"insert into expenses (source,exp_desc,exp_date,year,exp_sem,exp_added_by,amount,approved) values ('$exp',' $desc','$new','$year','$sem','$by','$amount','0')") or die(mysqli_error($conn));
											
											?>
                                            <div class="alert alert-info">&nbsp;expense added waiting approval </div>
                                          
                                           <?php
										   }
                                         }
										 //}
										 }
                                        ?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                    
                                         
                                                
                                 <thead>
                                 <tr>

                               <th>Item</th>
                              <th>Amount</th>
                              <th>Description</th>
                                <th>Action</th>
                                                                 
                   </tr>
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                           
                           
                          <!-- user delete modal -->
                           <?php include('ex.php'); ?>
                          
                          
                          
                            
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


