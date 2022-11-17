<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); ?>
<style>
#y,#z,#x{width:120px;}
</style>
<script language="JavaScript">
function disable()
{
if(document.getElementById("m").checked)
{
document.getElementById("sel").style.visibility="visible";
document.getElementById("x").style.visibility="hidden";
}
else
{
document.getElementById("sel").style.visibility="hidden";
document.getElementById("x").style.visibility="visible";
}
}
</script>
<body onLoad="StartTimers();" onmousemove="ResetTimers();">
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
                      <ul class="nav  nav-pills nav-stacked">
                        <li class="nav-header">Links</li>
                        <li>
                            <a href="home.php"><i class="icon-home icon-large"></i>&nbsp;Home
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>

                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt icon-large"></i>&nbsp;Reports
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
                              <li>
                            <a href="settings.php"><i class="icon-group icon-large"></i>&nbsp;Settings
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <li class="active">
                            <a href="results.php"><i class="icon-group icon-large"></i>&nbsp;Student results
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
                            <a href="transcript.php"><i class="icon-book icon-large"></i></i>&nbsp;Genarate Transcripts
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <li>
                            <?php 
							if(isset($_COOKIE['level'])){
							$l=$_COOKIE['level'];
							 if(($l==4)||($l==3) ||($l==2)||($l==1)){   ?>
                            <a href="../teacher_home.php"><i class="icon-group icon-large"></i>&nbsp;Enter Grades
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                            <?php  }} ?>
                    </ul>

                    </div>
                    <?php include"msg.php"?>
                    <div class="span12" style="border:1px; width:78%; margin-left:22%; margin-top:-410px;">
                    
                        <!--slider-->
                  <form method="post" action="repo.php">  
                  <?php if (isset($_GET['send'])) { ?>              
                <input type="hidden" value="<?php echo $_GET['sub'] ?>" name="sub" >
                <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
                <input type="hidden" value="<?php echo $_GET['cyear'] ?>" name="cyear" >
                <input type="hidden" value="<?php echo $_GET['sem'] ?>" name="sem" >
                 <?php }?>
              <button class="btn btn-success" type="submit" name="submit_docs"><i class="icon-plus-sign icon-large"></i>&nbsp;Export to word</button>
                </form>
                <div class="hero-unit-3">
                <?php if(isset($msg)){?>
							
							<div class="alert alert-danger"><i class="icon-save"></i>			
							<?php echo $msg;?></div>
                            <?php 
							}                           
                               ?>   
                                <form action="" method="get">                        
                              <div class="alert alert-info">
                        
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Student results table</strong>                      </div> 
                           <div class="control-group">
                                                <label class="control-label" for="inputPassword">&nbsp;<input name="" type="checkbox" value="" id="m" onClick="disable()"> &nbsp;&nbsp;Individual results | &nbsp;<a href="results.php">Present Results</a></label>
                                                <div class="controls">
           <form action="" method="get">
                         
                                                     <select name="sub"  required>
                                            <option value=""> select Programme </option>
                                            <?php
                                            $query = mysqli_query($conn,"select * from course");
											
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['course_id'];?>"><?php echo $row['cys']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        
                                        <select name="cyear"  required id="y">
                                            <option value=""> Class Year  </option>
                                             <option value="1">First year </option>
                                              <option value="2"> Second year  </option>
                                               <option value="3">Third year  </option>
                                                <option value="4"> Fourth year </option>
                                            </select>
                                        
                                        <select  name="year"   id="x">
                                        <option value="">academic year</option>
                                        <?php $r=mysqli_query($conn,"select distinct year from archive") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>
                                            
                                       <select name="sem"  required id="x">
                                            <option value=""> Class Semester </option>
                                             <option value="1">Jan-June</option>
                                              <option value="2">July- Dec  </option>
                                               
                                            </select>
                                            <input type="text" name="sel" id="sel"   style="visibility:hidden" placeholder="enter student ID" >
                                                   
                                        <button type="submit" name="send" class="btn btn-success" ></i>Show</button>
                                       
                             
                  </form>
                  </div></div>
                 
                
          <table cellpadding="0" cellspacing="0"  width="100%" >
                    
                                         
                                                
                                 <thead>
                                 
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                            
                            <?php
							include('arc.php');
                             ?>   
                        </tbody>
                       
                        
                  </table>
                   <?php   
				   
				   ?>
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