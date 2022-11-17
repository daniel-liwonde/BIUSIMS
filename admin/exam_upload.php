<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); ?>
<body onLoad="StartTimers();" onmousemove="ResetTimers();">
    <div class="row-fluid">
        <div class="span12">

            <?php include 'navbar.php'; ?>
            <div class="container">
            
                <div class="row-fluid">
                <div class="hero-unit-3" style="width:18.5%; ">
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
                    <div class="span12" style="border:1px; width:88%; margin-left:22%;margin-top:-470px;">
                    
                        <!--slider-->
                        <form method="get" action="grade_template.php">
                
                <?php if(isset($_GET['send'])){?>
                <input type="hidden" value="<?php echo $_GET['subject'] ?>" name="subject" >
                 <input type="hidden" value="<?php echo $_GET['sem'] ?>" name="sem" >
                  <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
                 
                <?php }?>
               <button class="btn btn-success" type="submit" name="send"><i class="icon-download icon-large"></i>&nbsp;Download Template</button> 
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
                            <strong><i class="icon-user icon-large"></i>&nbsp;Course Exam Upload Templates</strong>                      </div> 
                           <div class="control-group">
                           <form action="" method="get" name="frm">
                                               
                                                <div class="controls">
           
                       
                                                     <select name="subject"  required>
                                           <option value="">Please select subject</option>
                                           <?php
                                         $sel=mysqli_query($conn,"select * from subject order by subject_title asc");
                                          while($row=mysqli_fetch_assoc($sel))
                                        {
?>
                               <option value="<?php echo $row['subject_id']  ?>"><?php echo $row['subject_title']  ?></option>
                                   <?php
                                         }

?>
                                        </select>
                                        <select  name="year" id="year"  style="width:120px"  required>
                                            <option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
                                        <?php $r=mysqli_query($conn,"select distinct year from results where year >1 order by year desc") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option value="<?php echo $a['year'];?>"> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>
                                        
                                       <select name="sem"  id="sem" style="width:120px" required>
                                           <?php   if( checksem()==1){?>
                                            <option value=" 1">Jan-June</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                             <option value="2">July-Dec</option>
                                             <?php
                                            }
                                            ?>
                                              <option value="1">Jan-June</option>
                                               <option value="2">July-Dec</option>
                                            </select>
                                        <button type="submit" style="margin-top:-7px;" name="send" class="btn btn-success"><i class="icon-list-alt icon-large"></i>Generate Template</button>
                                       
                             
                  </form>
                  </div></div>
                 <?Php
                  if(isset($_GET['send']))
{
$thisub=$_GET['subject'];
$thisYear=$_GET['year'];
$thisSem=$_GET['sem'];
$sh=mysqli_query($conn,"select * from subject where subject_id='$thisub'");
$subn=mysqli_fetch_assoc($sh);
{?>
<div class="alert alert-info">
                        
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Template for students doing <font color="green" >&nbsp; <?php echo $subn['subject_title'] ?>&nbsp;</font><?php if($thisSem==1) echo "Jan-June"; else echo "July-Dec" ?>&nbsp;, &nbsp;<?php  echo $thisYear ?></strong>                      </div> 
                           <?php }} ?>
                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                    
                                         
                                                
                                 <thead>
                                 <tr>
                                <th>No</th>
                               <th>StudentID</th>
<th>Lastname</th>
                              <th>Firstname</th>
                              
                                <th>Mode</th>
                                 
                                                                  
                   </tr>
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                            <?php include('stud_course_temp.php'); ?>
                           
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