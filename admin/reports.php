<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('functions.php'); ?>
<style>
#x{width:120px;}
#y{width:120px;}

</style>
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
                    <div class="span12" style="border:1px; width:78%; margin-left:22%; margin-top:-410px; position: relative">
                    
                        <!--slider-->
                        <form method="get" action="repoexam.php">
                <button class="btn btn-success" type="submit" name="send"><i class="icon-plus-sign icon-large"></i>&nbsp;Export to Excel</button>
                <?php if(isset($_GET['sub'])){?>
				    <input type="hidden" value="<?php echo $_GET['sem'] ?>" name="sem" >
                <input type="hidden" value="<?php echo $_GET['sub'] ?>" name="sub" >
                <input type="hidden" value="<?php echo $_GET['year'] ?>" name="year" >
               
                <?php }?>
                &nbsp;|&nbsp;<a href="results.php"><button class="btn btn-success" type="button" ><i class="icon-list icon-large"></i>&nbsp;<font color="#FFFFFF">View departmental reports</font></button></a>
                </form> 
                <div class="hero-unit-3" >
                <?php if(isset($msg)){?>
							
							<div class="alert alert-danger"><i class="icon-save"></i>			
							<?php echo $msg;?></div>
                            <?php 
							}                           
                               ?>                           
                              <div class="alert alert-info" >
                        
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-user icon-large"></i>&nbsp;Exam subjects report</strong>                      </div> 
                           <div class="control-group">
                                                <label class="control-label" for="inputPassword">Enter Details Below</label>
                                                <div class="controls">
           <form action="" method="get">
                       
                                                     <select name="sub"  required>
                                            <option value=""> Select  Subject </option>
                                            <?php
                                            $query = mysqli_query($conn,"select * from subject order by subject_title ASC");
											
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?php echo $row['subject_code'];?>"><?php echo $row['subject_title']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                          <select  name="year"  required id="x">
                                        <option value="">Exam year</option>
                                        <?php $r=mysqli_query($conn,"select distinct year from results") or die(mysqli_error($conn));
										  while($a=mysqli_fetch_array($r)){
										  ?>
										  <option> <?php echo $a['year'];?> </option>
                                          <?php
										  }
										   ?>
                                           </select>
                                            
                                       <select name="sem"  required id="x">
                                            <option value="">Report Semester </option>
                                             <option value="1">Jan-June </option>
                                              <option value="2">July-Dec </option>
											  </select>
                                        <button type="submit" name="send" class="btn btn-success" ><i class="icon-list-alt icon-large"></i>Display</button>
                                       
                             
                  </form>
                  </div></div>
                 
                
          <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                    
                                         
                                                
                                 <thead>
                                 <tr>

                               <th>StudentID</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                                <th>Mode</th>
                                <th>Code</th>
                                  <th>Assg#1</th>
                                  <th>Assg#2</th>
                                   <th>EOS</th>
                                   <th colspan="2">Grade</th>
                                    <th>Year</th>                                 
                   </tr>
                    </thead>
                        <tbody>   
                           <!-- end script -->
                           <tr class="odd gradeX">
                           
                           <?php databaseOutput() ;  ?>    
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