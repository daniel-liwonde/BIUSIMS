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
                       <img src="admin/images/log.png" height="10" width="40" /> <font color="#666666"><b>BIU SIMS</b></font>
                        <div class="pull-right">
                            <form class="navbar-search pull-left">
                                
                                <i class="icon-search icon-large" id="color_white"></i>
                                <input type="text" class="search-query" placeholder="Search">
                            </form>
                        </div>

                        <!-- end collapse -->
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
                                    <!--- login button -->							
                                  <?php 
								  //$ur=  $_COOKIE['USER'];
								 $L= $_COOKIE["level"];
                                    $student_query=mysqli_query($conn,"select * from teacher where teacher_id='$session_id' and user_level='$L'")or die(mysqli_error($conn));
									if(mysqli_num_rows($student_query)==0)
									{
										 $student_query=mysqli_query($conn,"select * from user where user_id='$session_id' and user_level='$L'")or die(mysqli_error($conn));
									}
                                    $teacher_row=  mysqli_fetch_array($student_query);
                                    ?>
                                    
                                     
                                    <div class="btn-group">
                                       
                                        <button class="btn btn-success"><i class="icon-user icon-large"></i>&nbsp; <?php echo $teacher_row['firstname']  ." " . $teacher_row['lastname']; ?></button>
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#logout" role="button"  data-toggle="modal"><i class="icon-signout icon-large"></i>&nbsp;Logout</a></li>
                                        </ul>

                                    </div>

                                    <?php include('logout_modal.php') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>