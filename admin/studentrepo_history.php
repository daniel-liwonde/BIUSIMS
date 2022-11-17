?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); ?>
<style>
#m,#x2,#x,#y,#sel{width:120px;}

</style>
<script language="JavaScript">
function disable()
{
if(document.getElementById("y").checked)
{
document.getElementById("sel").style.visibility="visible";
}
else
{
document.getElementById("sel").style.visibility="hidden";
}
}
</script>
<script language="javascript">
function alls()
{
var y=document.getElementById("x2").value;
if(y==5)
document.getElementById("m").style.visibility="hidden";
else
document.getElementById("m").style.visibility="visible";
}
</script>
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
                 <div class="hero-unit-1" style="width:20%">
                      <?php  include('side_nav.php')  ?>
                    </div>
                    <?php include"msg.php"?>
                    <div class="span12" style="border:1px; width:88%; margin-left:22%; margin-top:-410px;">
                    
                        <!--slider-->
                        <form method="get" action="studrepo.php">
                <button class="btn btn-success" type="submit" name="send"><i class="icon-plus-sign icon-large"></i>&nbsp;Export to Excel</button> 
                <a href="exam_nos.php" class="btn btn-success"><i class="icon-plus-sign icon-large"></i>&nbsp;Exam registers</a>&nbsp;&nbsp;<a href="studentrepo_new.php" class="btn btn-success"><i class="icon-list icon-large"></i>&nbsp;View Semester Enrollment Report</a>
                <a href="sublist.php" class="btn btn-success"><i class="icon-list icon-large"></i>&nbsp;Subject Student Report</a>
                <a href="studerepo_history.php" class="btn btn-success"><i class="icon icon-list"></i>&nbsp;Student History Report</a>
                <?php if(isset($_GET['send'])){?>
                <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
                <input type="hidden" value="<?php echo $_GET['sem'] ?>" name="sem" >
                <input type="hidden" value="<?php echo $_GET['sel'] ?>" name="sel" >
                <input type="hidden" value="<?php echo $_GET['mode'] ?>" name="mode" >
                 
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
                            <strong><i class="icon-user icon-large"></i>&nbsp;Student Reports</strong>                      </div> 
                           <div class="control-group">
                           <form action="" method="get" name="frm">
                                                <label class="control-label" for="inputPassword">
                                               <input type="checkbox" onClick="disable()"  id="y" name="ck" value="yes"/>Include Program</label>
                                                <div class="controls">
           
                       
                                                     <select name="year"  required id="x2" onChange="alls()">
                                            <option value="">Select year </option>
                                             <option value="1">First year </option>
                                              <option value="2">Second year</option>
                                               <option value="3">Third year</option>
                                               <option value="4">Forth year</option>
                                               <option value="5">All Students</option>
                                        </select>
                                         
                                            
                                       <select name="sem"   id="m">
                                            <option value="">Semester</option>
                                             <option value="1">First </option>
                                              <option value="2">Second  </option>
                                            </select>
                                            &nbsp;<select name="sel" id="sel"   style="visibility:hidden" >
                                                    <option  value="">Select programme</option>
                                                    
                                            <?php $r=mysqli_query($conn,"select *from  course") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option value="<?php echo $a['course_id'];?>"> <?php echo $a['cys'];?> </option>
                                          <?php
										  }
										   ?>
                                                   
                                           </select>  
                                           <select name="mode"   id="x">
                                            <option value="">Study Mode</option>
                                             <option value="1">Full time </option>
                                              <option value="2">Distance  </option>
                                              <option value="4">Masters</option>
                                              <option value="3">All Modes</option>
                                              
                                            </select>       
                                        <button type="submit" name="send" class="btn btn-success" ><i class="icon-list-alt icon-large"></i>Display</button>
                                       
                             
                  </form>
                  </div></div>
                 
                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                    
                                         
                                                
                                 <thead>
                                 <tr>
                                <th>No</th>
                               <th>StudentID</th>
                              <th>Lastname</th>
                              <th>Firstname</th>
                                <th>Mode</th>
                                  <th>Prog</th>
                                  <th>Year</th>
                                  <th>Sem</th>
                                  <th>Phone</th>
                                  <th>Email</th>
                                  <th>Gender</th>
								   <th>Address</th>
								<th>Admission Year</th>
                                                                  
                   </tr>
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                            <?php include('stud.php'); ?>
                           
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