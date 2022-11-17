<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); ?>
<style>
#x,#y,#sel{width:120px;}

</style>
<body >
    <div class="row-fluid">
        <div class="span12">

            <?php include 'navbar.php'; ?>
            <div class="container">
            
                <div class="row-fluid">
                <div class="hero-unit-3" style="width:18.5%">
                    <div class="alert-index alert-success">
                        <i class="icon-calendar icon-large"></i>
                        <?php
                        $Today = date('y:m:d');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                    </div>
                </div>
                 
                       <?php  include('side_nav.php')  ?>
                    
                    <?php include"msg.php"?>
                    <div class="span12" style="border:1px; width:78%; margin-left:22%; margin-top:-410px;">
                    
                        <!--slider-->
                        <form method="get" action="feesrepo.php">
                <button class="btn btn-success" type="submit" name="send"><i class="icon-undo icon-large"></i>&nbsp;Export to Excel</button>
                <?php if(isset($_GET['send'])){?>
                <input type="hidden" value="<?php echo $_GET['fees'] ?>" name="fees" >
                <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
				 <input type="hidden" value="<?php echo $_GET['syear'] ?>" name="syear" >
				  <input type="hidden" value="<?php echo $_GET['ssem'] ?>" name="ssem" >
                <input type="hidden" value="<?php echo $_GET['sem'] ?>" name="sem" >
                
                 
                <?php }?>
               
                </form> 
                <div class="hero-unit-3">
                <?php if(isset($msg)){?>
							
							<div class="alert alert-danger"><i class="icon-save"></i>			
							<?php echo $msg;?></div>
                            <?php 
							}                           
                               ?>                           
                              <div class="alert alert-info">
                        
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Fees Reports</strong>                      </div> 
                           <div class="control-group">
                                                <label class="control-label" for="inputPassword">Select details below</label>
                                                <div class="controls">
           <form action="" method="get" name="frm">
                       
                                                     <select name="fees"  required id="x">
                                            <option value="">Select Fees Report</option>
                                             <option value="1">Students who Completed Fees </option>
                                              <option value="2">Students With Fees Balances</option>
                                               <option value="3">Students Who Did Not Pay Fees</option>
                                                <option value="4">General Fees Paid report</option>
                                               
                                        </select>
                                          <select  name="year"  required id="x">
                                        <option value="">select year</option>
                                        <?php $r=mysqli_query($conn,"select distinct year from student_fees order by year desc") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>
                                            
                                       <select name="sem"  required id="x">
                                            <option value="">Semester</option>
                                             <option value="1">Jan-June </option>
                                              <option value="2">July-Dec  </option>
                                            </select>
                                            <select name="syear"  required id="x">
                                            <option value="">Student year</option>
                                             <option value="1">First</option>
                                              <option value="2">Second  </option>
											   <option value="3">Third </option>
											    <option value="4">Fourth </option>
                                            </select>
                                                 <select name="ssem"  required id="x">
                                            <option value="">Student sem</option>
                                             <option value="1">First</option>
                                              <option value="2">Second  </option>
											  
                                            </select>     
                                        <button type="submit" name="send" class="btn btn-success display"  ><i class="icon-list-alt icon-large"></i>Display</button>
                                       
                             
                  </form>
                  </div></div>
                 
                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                    
                                         
                                                
                                 <thead>
                                 <tr>
                                 <th>No</th>
                              <th>StudentID</th>
                              <th>Surname</th>
                              <th>Firstname</th>
                                <th>Mode</th>
                                  <th>Amount</th>
                                  <th>Balance</th>
                                  <th width="80">Exam No  </th>
                                  <th width="80">Last pay</th>
                                   <th width="120">Entered by</th>   
								   <th>Year</th> 
								   <th>Sem</th> 
                                                                  
                   </tr>
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                            <?php include('fees.php'); ?>
                           
                          <!-- user delete modal -->
                            
                        </tbody>
                  </table>
                 
                    <!-- end slider -->
                </div>
            </div>
                        
                                 
                </div>
                
                <?php  include('footer.php'); ?>
            </div>

        </div>
    </div>





</body>
</html>