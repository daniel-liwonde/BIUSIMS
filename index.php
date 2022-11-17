<?php
include('admin/functions.php');
if (isset($_POST['login'])) {// start
                                    $username = clean($conn,$_POST['username']);
                                    $password = md5(clean($conn,$_POST['password']));
									$stud_pass = clean($conn,$_POST['password']);
                                    $query = mysqli_query($conn,"select * from user where username='$username' and password='$password'") ;
                                    $count = mysqli_num_rows($query);
                                    $row = mysqli_fetch_array($query);
                                    if ($count>0) {//user found
										setcookie('level',$row['user_level'],0,'/',"biu-edu.com");
                                        //$_COOKIE['id'] = $row['user_id'];
										setcookie("id",$row['user_id'] ,0, "/","biu-edu.com");
										
                                        header('location:admin/home.php');
                                        session_write_close();
                                        exit();
                                    }//end found user
									 else {//check teacher or student
                                        session_write_close();
              $query = mysqli_query($conn,"select * from teacher where username='$username' and password='$password'") ;
                $count = mysqli_num_rows($query);
                $row = mysqli_fetch_array($query);
                if ($count>0) {//found teacher
                    ////session_start();
                    //session_regenerate_id();
                    setcookie("id",$row['teacher_id'] ,0, "/","biu-edu.com");
                    //$_COOKIE['id'] = $row['teacher_id'];
                   // $_COOKIE['level']=$row['user_level'];
                    setcookie("level",$row['user_level'] ,0, "/","biu-edu.com");
                    header('location:teacher_home.php');
                    session_write_close();
                    exit();
                }//end found teacher
				 else {//check student
					session_write_close();
              $query = mysqli_query($conn,"select * from student where student_id='$username'") or die(mysqli_error($conn));
                $count = mysqli_num_rows($query);
                $row = mysqli_fetch_array($query);
                if ($count>0) {//found student
				 $uid=$row['id'];
				 $cyear=date('Y');
				  $csem=checksem();
				  if(($csem)==1){ $exam_sem_num =2; $exam_num_year = $cyear-1;}else{$exam_sem_num =1; $exam_num_year = $cyear;}
				$exam_no_qry = mysqli_query($conn,"select * from student_fees where id='$uid' and exam_no='$stud_pass' and sem='$exam_sem_num' and year='$exam_num_year'") or die(mysqli_error($conn));
				      if(mysqli_num_rows($exam_no_qry)>0){//open student page
					  $stud=mysqli_fetch_array($exam_no_qry);
                    //session_start();
                    //session_regenerate_id();
                    
					setcookie("id",$row['id'] ,0, "/","biu-edu.com");
					 setcookie('year', $row['stud_current_year'] ,0, "/","biu-edu.com");
					 setcookie('ssem',$row['current_sem'] ,0, "/","biu-edu.com");
					setcookie('pro',$row['cys'] ,0, "/","biu-edu.com");
					setcookie('ADM_YEAR',$row['addm_year'] ,0, "/","biu-edu.com");
                    header('location:student_home.php');
                    //session_write_close();
                    exit();
					  }//close open student page
					  else
					  {
						if(($exam_sem_num)==1) $s='Jan-June'; else $s= 'July-Dec'; 
                        $message=" Wrong exam number Please use exam number for:". $exam_num_year .$s;
                        //setcookie("denied",$message,0,"/","biu-edu.com");
                         
					  }
                }//end found student
					else {//not found
                    //session_write_close();
                                      $message=" Access Denied";
                                      //setcookie("denied",$message,0);
                                      //echo $_COOKIE["denied"];
					                    }//end not found
                                        }//end check student
                                }//end check teacher or student
								}//end start

include('header.php');
?>
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
                                    <img src="admin/images/head.png">
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
           
                        <div class="alert alert-info"><strong>Welcome</strong> Please Enter Login Details Below</div>
                        <!-- login -->
                        <form class="form-horizontal" method="post" autocomplete="off">
                            <div class="control-group">
                                <label class="control-label" for="inputEmail">Username</label>
                                <div class="controls">
                                    <input type="text" name="username" id="inputEmail" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Password</label>
                                <div class="controls">
                                    <input type="password" name="password" id="inputPassword" placeholder="Password" required><br>
                                    <a href="javascript:void(0);" onclick='$("#edit").show("slow");'>Forgot password</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" name="login" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Sign in</button>
                                </div><br>
                              <?php if(isset($message)) {?> 
                        <div class="alert alert-danger" style="margin-bottom:-7px"><i class="icon-remove-sign"></i>&nbsp;<?php echo $message; $message=''; ?></div>
                       <?php }?>
                            </div>
                    </form>
                    <div style="display:none;font: normal 12px arial; padding:10px; background: #e6f3f9; color: #0099FF;" id="edit">
                                      Enter your email address below and check your  email
                                       <form class="form-horizontal" method="post">
                            <div class="control-group">
                                <label class="control-label" for="inputEmail"></label>
                                <div class="controls">
                                    <input type="email" name="usermail" id="inputEmail" placeholder="Enter your email here" required>
                                </div>
                            </div>
                             <div class="control-group">
                                <div class="controls">
                                    <button type="submit" name="send" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Send email</button>
                                </div>
                                </div>
                                </form>
                                     <a title="close" href="javascript:void(0);" onclick='$("#edit").hide("slow");' style=" text-decoration:none; margin-left:100%">&times;</a>
                                    </div>
<br>
<?php  
	if (isset($_POST['send'])) {
				
                                    $mail= clean($conn,$_POST['usermail']);
                                  
                                $msg=  recoverPass($mail);
                                echo $msg;
				}
							
				
				?>
                    </div>
                </div>
                  
            </div>
       <?php  //include('footer.php');?>
	   
        </div>
    </div>
</div>






</body>
</html>


