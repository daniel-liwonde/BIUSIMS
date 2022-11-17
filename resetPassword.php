<?php
include('admin/functions.php');
	
							
				
				?>
<!Doctype html>
<html>
<head>
    <link href="admin/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
        <style>
            #inputPassword,#inputPasswordConfirm{width:50%; height:30px; border-radius:5px;margin-bottom:15px;}
        </style>
    
    </head>

<body>
    <div class="row-fluid">
        <div class="span12">
            <div class="navbar navbar-fixed-top navbar-inverse">
                <div class="navbar-inner">
                    <div class="container">
                        <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <!-- Be sure to leave the brand out there if you want it shown -->
                        <!-- Everything you want hidden at 940px or less, place within here -->
                        <div class="nav-collapse collapse">
                            <!-- .nav, .navbar-search, .navbar-form, etc -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-unit-header">
                <div class="container">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span6">
                                  
                                </div>
                                <div class="span6">
                                    <div class="pull-right">
                                        <i class="icon-calendar icon-large"></i>
                                        <?php
                                        $Today = date('y:m:d');
                                        $new = date('l, F d, Y', strtotime($Today));
                                        echo $new;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row-fluid">
                    <div class="span6" style="margin-left:23%">
                    <div class="hero-unit-3" >
          
                        <div class="alert alert-info"><strong>Welcome</strong> Please Enter  Details Below</div>
                        <!-- login -->
                        
                        <form class="form-horizontal" method="post" autocomplete="off">
                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Password</label>
                                <div class="controls">
                                    <input type="text" name="pass" id="inputPassword" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPasswordConfirm">Confirm Password</label>
                                <div class="controls">
                                    <input type="text" name="cpassword" id="inputPasswordConfirm" placeholder="Confirm Password" required><br>
                            
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" name="reset" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Reset</button>
                                </div><br>
                              <?php
                        if (isset($_POST['reset'])) {
				
                                    $pass= clean($conn,$_POST['pass']);
                                  
                                 $passR= clean($conn,$_POST['cpassword']);
                                if($pass!=$passR){
                                ?>
                               <font color="red"> Password mismatch, please retry</font>
                                <?php
                                }
                                else
                                {
                                 $passR= md5($passR);
                                 $teacher_id=$_GET['id'];
                                 mysqli_query($conn,"update teacher set password='$passR' where teacher_id='$teacher_id'") or die(mysqli_error($conn));
                                 ?>
                                 <font color="green"> <b> Password reset successifully,please open a new browser window and type sims.biu-edu.com to login with new details</a></b></font>
                                <?php
                                 }
				}
				?>
                            </div>
                    </form>
                 
<br>

                    </div>
                </div>
                  
            </div>

        </div>
    </div>
</div>
</body>
</html>


