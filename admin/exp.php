<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); ?>
<style>
#x,#y,#sel{width:120px;}

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

                      <?php  include('side_nav.php')  ?>
                    
                    <?php include"msg.php"?>
                    <div class="span12" style="border:1px; width:78%; margin-left:22%; margin-top:-410px;">
                    
                        <!--slider-->
                        <form method="get" action="exp_repo.php">
                <button class="btn btn-success" type="submit" name="send"><i class="icon-plus-sign icon-large"></i>&nbsp;Export to word</button>
                <?php if(isset($_GET['send'])){?>
               
                <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
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
                            <strong><i class="icon-user icon-large"></i>&nbsp;Expenditure Reports</strong>                      </div> 
                           <div class="control-group">
                                                <label class="control-label" for="inputPassword">Select Details Below </label>
                                                <div class="controls">
           <form action="" method="get" name="frm">
                       
                                        
                                          <select  name="year"  required id="x">
                                        <option value="">select year</option>
                                        <?php $r=mysqli_query($conn,"select distinct year from expenses") or die(mysqli_error($conn));
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
                                              <option value="2">July-Dec </option>
                                               
                                            </select>
              
                                                    
                                        <button type="submit" name="send" class="btn btn-success" ><i class="icon-list-alt icon-large"></i>Display</button>
                                       
                             
                  </form>
                  </div></div>
                 
                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                    
                                         
                                                
                                 <thead>
                                 <tr>

                               <th>Item</th>
                              <th>Budgeted(MWK)</th>
                              <th>Expenditure(MWK)</th>
                              <th colspan="2">Balance(MWK)</th>
                                 
                                 
                                 
                                 
                                                                  
                   </tr>
                    </thead>
                        <tbody>   
                           <!-- end script -->
                          
                            <?php include('exp_exe.php'); ?>
                           
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