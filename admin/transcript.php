<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); ?>
<style>
#x{width:120px;}
#y{width:120px;}
#{font-family:Cambria; font-size:11pt}
</style> 
<?php 
if(isset($_GET['send'])){?>
<script language="javascript">
function activate(){
document.getElementById("arc").style.visibility="visible";
}
</script>
<?php  }?>
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
                             <li><?php if(($l==1)or ($l==2)or($l==9) or ($l==3)) {?><a href="reports.php">Exam</a>   </li>
<?php  } else {?>
 <li><a href="#" onClick="alert('ACCESS DENIED')">Exam</a>   </li>
                            <?php }?>
 <li><?php if(($l==1)or ($l==2)or($l==9) or ($l==3)) {?><a href="ts.php">Teacher-subjects</a>   </li>
<?php  } else {?>
 <li><a href="#" onClick="alert('ACCESS DENIED')">Teacher-subjects</a>   </li>
                            <?php }?>
                             <li><?php if(($l==1)or ($l==2)or($l==9)){?><a href="financials.php">Financial</a></li>
<?php  } else {?>
 <li><a href="#" onClick="alert('ACCESS DENIED')">Financials</a>   </li>
                            <?php }?>
                              <li><a href="studentrepo.php">Students</a></li>
                              <li><?php if(($l==1)or ($l==2)or($l==9)) {?><a href="exp.php">Expenditure</a></li>
                               <?php  } else {?>
 <li><a href="#" onClick="alert('ACCESS DENIED')">Expenditure</a>   </li>
                            <?php }?>
                               <li><?php if(($l==1)or ($l==2)or($l==9) or($l==8)or ($l==10)or ($l==7) or($l==6)){?><a href="feez.php">Fees</a></li>
<?php  } else {?>
 <li><a href="#" onClick="alert('ACCESS DENIED')">Fees</a></li>
                            <?php }?>
                            </ul>
                            
                            </li>                                                      
                              <li>
                              <?php if(($l==1)or($l==2) or($l==9))  {?>
                            <a href="settings.php"><i class="icon-group icon-large"></i>&nbsp;Settings
                            <?php } else{?>
                            <a href="#" onClick="alert('ACCESS DENIED')"><i class="icon-group icon-large"></i>&nbsp;Settings
                            <?php }?>
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
<li class="dropdown">
                        <?php if(($l==1) or ($l==2)or ($l==6)or ($l==9)or ($l==7)) {?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-envelope-alt icon-large"></i>&nbsp;Email Results
                             <?php } else{?>
                            <a href="#" onClick="alert('ACCESS DENIED')"><i class="icon-envelope-alt icon-large"></i>&nbsp;Email Results
                            <?php }?>
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>
                            <ul class="dropdown-menu" style="margin-left:103%; margin-top:-15%;">
                            <?php     
							while($row=mysqli_fetch_array($subs)){ ?>
							<li><a href="sendmail.php?pid=<?php echo  $row['course_id']   ?>"><?php echo $row['cys']  ?></a></li>
							
							 <?php   }?>
                             
                            </ul>
                            
                            </li>     
                            <li>
                             <?php if(($l==1) or ($l==2) or ($l==9)) {?>
                            <a href="results.php"><i class="icon-group icon-large"></i>&nbsp;Student results
                             <?php } else{?>
                            <a href="#" onClick="alert('ACCESS DENIED')"><i class="icon-group icon-large"></i>&nbsp;Student results
                            <?php }?>
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
 <li>
                              <?php if(($l==9)or($l==10) or($l==1)or($l==2))  {?>
                            <a href="backup/index.php"><i class="icon-group icon-large"></i>&nbsp;Backup
                          <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div> 
                            <?php }?>
                                 
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
                                       <li class="dropdown active">
                        <?php if(($l==1) or ($l==2)or ($l==6)or ($l==9)or ($l==7)) {?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-book icon-large"></i>&nbsp;Genarate Transcripts
                             <?php } else{?>
                            <a href="#" onClick="alert('ACCESS DENIED')"><i class="icon-book icon-large"></i>&nbsp;Genarate Transcripts
                            <?php }?>
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>
                            <ul class="dropdown-menu" style="margin-left:103%; margin-top:-15%;">
                            
							<li><a href="transcript.php">Undergraduate</a></li>
                            <li><a href="transcript_masters.php">Masters</a></li>
							
							 
                             
                            </ul>
                            
                            </li>                
                           <li>
							<?php if(($l==1)  or ($l==3)or ($l==4) or ($l==9)) {?>
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
                    <?php include"msg.php"?>
                    <div class="span12" style="border:1px; width:78%; margin-left:22%; margin-top:-410px;">
                    <?php if(($l==1) or ($l==2) or ($l==9)){?>
                        <!--slider-->
                  <form method="get" action="transrepo.php">  
                  <?php if (isset($_GET['send'])) { ?>              
                <input type="hidden" value="<?php echo $_GET['sname'] ?>" name="sname" >
                 <?php }?>
              <button class="btn btn-success" type="submit" name="send" ><i class="icon-plus-sign icon-large"></i>&nbsp;Export to word</button>
              &nbsp;&nbsp;<a href="#v"  data-toggle="modal" ><button class="btn btn-success" type="button"  id="arc" ><i class="icon-plus-sign icon-large"></i>&nbsp;<font color="#FFFFFF">Archive transcript</font></button></a>
                </form>
                <?php  }?>
                <?php if (isset($_COOKIE['ERR'])) echo"<div class='alert alert-danger'> &nbsp;$_COOKIE[ERR]</div>"; unset($_COOKIE['ERR']);?>
                <!-- user delete modal -->
                                    <div id="v" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                        </div>
                                       <form method="post" action="archive.php">
                                        <div class="modal-body">
                                            <div class="alert alert-danger">Confirm archive</div>
                                            
                                            
                                             <?php if(isset($_GET['sname'] )){?>
                                              Are you sure you want to add results to archive?
											<?php  }
											else
											echo "Display the transcript first";
											?>
                                              <input type="hidden" value="<?php if(isset($_GET['sname'] )) echo $_GET['sname']  ?>" name="arcid">
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Cancel</button>
                                            <button type="submit" name="go" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Archive</button>
                                        </div>
                                    </div>
                                    </form>
                                    <!-- end delete modal --> 
                <div class="hero-unit-3">
                <?php if(isset($msg)){?>
							
							<div class="alert alert-danger"><i class="icon-save"></i>			
							<?php echo $msg;?></div>
                            <?php 
							}                           
                               ?>                           
                              <div class="alert alert-info">
                        
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Student Transcript</strong>                      </div> 
                           <div class="control-group">
                                                <label class="control-label" for="inputPassword">Select Details student details below</label>
                                                <div class="controls">
           <form action="" method="get">
                         <div class="search-box" style="float:left; margin-left:10px">
        <input name="sname" type="text" autocomplete="off" placeholder="surname..." />
        <div class="result"></div>
    </div>
                                                    
                                        
                                        <button type="submit" name="send" class="btn btn-success"></i>Generate</button>
                                       
                             
                  </form>
                  </div></div>
                 
     <form id="form1">
    <div id="dvContainer">
    
 <table cellpadding="0"  border="0"cellspacing="0"  width="100%" id="d"  style="font-size:11pt; font-family:'Times New Roman';" cellpadding="0"  cellspacing="0" align="center" >
                    
                                         
                                                
                                 
                           
                       
                          
                            
                            <?php
							include('transgen.php');
                             ?> 
                              
                    </table>
                    <br>
                    <br>
                    </div> 
                <input type="button" value="Print Transcript" id="btnPrint" class="btn btn-success" />
                </form>                  
                   </div> 
                </div>
            </div>
                        
                             
                
              
            </div>

        </div>
    </div>


 


</body>

</html>