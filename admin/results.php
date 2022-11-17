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
<body>
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
                 <?php include"side_nav.php"?>
                    <?php include"msg.php"?>
                    <div class="span12" style="border:1px; width:78%; margin-left:22%; margin-top:-460px;">
                    
                        <!--slider-->
                        <?php if(($l==1) or ($l==2) or ($l==9)) {?>
                  <div style=" margin-left:0%;height:20px; position:absolute; margin-top:-40px">
				  <form method="get" action="repo2.php" style="float:left; margin-left:0px; padding-right:15px">  
                  <?php if (isset($_GET['send'])) { ?>              
                <input type="hidden" value="<?php echo $_GET['sub'] ?>" name="sub" >
                <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
                <input type="hidden" value="<?php echo $_GET['cyear'] ?>" name="cyear" >
                <input type="hidden" value="<?php echo $_GET['sem'] ?>" name="sem" >
                <input type="hidden" value="<?php echo $_GET['sel'] ?>" name="sel" >
                 <?php }?>
              <button class="btn btn-success" type="submit" name="send"><i class="icon-plus-sign icon-large"></i>&nbsp;Export to PDF</button>
                </form>
               
                 <form method="get" action="repo.php" style="float:left">  
                  <?php if (isset($_GET['send'])) { ?>              
                <input type="hidden" value="<?php echo $_GET['sub'] ?>" name="sub" >
                <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
                <input type="hidden" value="<?php echo $_GET['cyear'] ?>" name="cyear" >
                <input type="hidden" value="<?php echo $_GET['sem'] ?>" name="sem" >
                <input type="hidden" value="<?php echo $_GET['sel'] ?>" name="sel" >
                 <?php }?>
              <button class="btn btn-success" type="submit" name="send"><i class="icon-plus-sign icon-large"></i>&nbsp;Export to MS Word</button>
                </form>
               &nbsp; <a  class="btn btn-success" href="exam_upload.php"><i class="icon icon-list"></i>&nbsp;Generate Course Upload templates</a>
               </div>
                
                <?php }?>
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
						   <table>
						   <tr><td>
                                                <label class="control-label" for="inputPassword">&nbsp;<input name="" type="checkbox" value="" id="m" onClick="disable()"> &nbsp;&nbsp;Individual results | </td><td>&nbsp;&nbsp;&nbsp;<a href="farchive.php">Results From archive </a></label>
												</td></tr></table>
												<br>
                                                
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
                                                <option value="5">All years </option>
                                            </select>
                                        
                                        <select  name="year"   id="x">
                                        <option value="">academic year</option>
                                        <?php $r=mysqli_query($conn,"select distinct year from results where year<>0") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>
                                            
                                       <select name="sem"  required id="x">
                                            <option value=""> Class Semester </option>
                                             <option value="1">Jan-June </option>
                                              <option value="2">July-Dec </option>
                                               
                                            </select>
											 <button type="submit" name="send" class="btn btn-success btn-lg display"  ><i class="icon icon-eye-open "></i> &nbsp;View</button>
											<span class="input-group">
                                            <input type="text" name="sel" id="sel"   style="visibility:hidden" placeholder="enter student ID" >
                                       
										</span>
                                       
                             
                  </form>
                  </div></div>
                 
          
            <form id="form1">
            <div id="dvContainer1">
          
          <table width="100%" border='0'>
                    
                                         
                                                
                                 <thead>
                                 
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                            
                            <?php
							$sell=mysqli_query($conn,"select * from allowmo") or die(mysqli_error($conn));
							$mo=mysqli_fetch_assoc($sell);
							$getid=$mo['uid'];
							if($getid==1 && $l==9)
							outputresults2();
						    else
								outputresults();
                             ?>   
                        </tbody>
                       
                        
                  </table>
                 
						</div>
                <input type="button" value="Print Results" id="btnPrint2" class="btn btn-success" />
                </form>
				
 <a href="#top">&larr;Back to top</a>
				</div>				
				
				  
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