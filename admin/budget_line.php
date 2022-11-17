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
                            <i class="icon-plus-sign-alt icon-large"></i>&nbsp;Create budget for <?php  echo date('Y'); if(checksem()==1) echo "&nbsp;Jan-Dec";else echo "&nbsp;July-Dec"?>&nbsp;Semester</div>
                            
                                     
                                        <form class="form-horizontal" method="POST" action="">

                                            <div class="control-group">
                                                <label class="control-label" for="inputPassword">Budget item</label>
                                                <div class="controls">
                                                    <select name="item"  required>
                                                    <option value="">Select item</option>
                                                    <?php 
													$y=date('Y');
                                                    $s=checksem();
                                                        $query=mysqli_query($conn,"select * from budget_items");
														if(mysqli_num_rows($query)==0)
														echo"<option value=''>No items found</option>";
                                                        while($row=mysqli_fetch_array($query)){
                                                            ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['item']; ?></option>
                                                        <?php
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
                                                <div class="controls">

                                                    <button type="submit" name="save" class="btn btn-info"><i class="icon-save icon-large"></i>&nbsp;Add Item</button>
                                                </div>
                                            </div>
                                        </form>

                                        <?php
                                        if (isset($_POST['save'])) {


                                            $item= $_POST['item'];
                                            
											 $amount = $_POST['amount'];
											 $xamount = $amount/6;
                                            $sem = checksem();
										      $year=date('Y');
											
											$sel=mysqli_query($conn,"select * from  budget_line where id='$item' and sem='$sem' and year='$year'") or die(mysqli_error($conn));
											if(mysqli_num_rows($sel)>0){
											mysqli_query($conn,"update budget_line set amount='$amount',remander='$amount',exp='$xamount' where year='$year' and sem='$sem' and id='$item'") or die(mysqli_error($conn));
											?>
                                            <div class="alert alert-danger">&nbsp;Details aready existed and are updated </div>
                                          
                                           <?php
										   }
									       else
										   {
                                            mysqli_query($conn,"insert into budget_line (id,amount,year,sem,exp,remander) values ('$item',' $amount','$year','$sem','$xamount','$amount')") or die(mysqli_error($conn));
											
											?>
                                            <div class="alert alert-info">&nbsp;Item details added </div>
                                          
                                           <?php
										   }
                                         }
										
                                        ?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                    
                                         
                                                
                                 <thead>
                                 <tr>

                               <th> ID</th>
                              <th>Item</th>
                              <th>Amount</th>
                              <th>Expected Amount/month</th>
                              <th>Description</th>
                                <th>Action</th>
                                                                 
                   </tr>
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                           
                           
                          <!-- user delete modal -->
                           <?php include('bline.php'); ?>
                          
                          
                          
                            
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


