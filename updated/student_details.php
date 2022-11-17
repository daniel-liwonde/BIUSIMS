<?php
include('session.php');
include('header.php');
include ('admin/functions.php');          
$user_query = mysqli_query($conn,"select * from student where id='$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);
?>
<body>
    <?php include('navhead_student.php'); ?>
    <div class="container">
        <div class="row-fluid">

            <div class="span3">
                <div class="hero-unit-3">
                    <div class="alert-index alert-success">
                        <i class="icon-calendar icon-large"></i>
                        <?php
                        $Today = date('y:m:d');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                    </div>
                </div>
                <div class="hero-unit-1" >
                    <ul class="nav  nav-pills nav-stacked" >
                        <li class="nav-header">Links</li>
                        <li   class="active">
                            <a href="student_home.php"><i class="icon-home icon-large"></i>&nbsp;Home
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a>

                        </li>
                        <li>
                            <a href="student_details.php"><i class="icon-book icon-large"></i>&nbsp;My Details
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>     
           <li>
                            <a href="register.php?id=<?php echo $session_id; ?>""><i class="icon-pencil icon-large"></i>&nbsp;Register Courses
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
							<li>
                            <a href="carry.php"><i class="icon-repeat icon-large"></i>&nbsp;My Carryovers
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
							<li>
                            <a href="prev.php"><i class="icon-folder-open icon-large"></i>&nbsp;Previous Results
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
 <li>
                            <a href="notifications.php"><i class="icon-bell-alt icon-large"></i>&nbsp;Notifications
                                <div class="pull-right">
                                    <i class="icon-double-angle-right icon-large"></i>
                                </div>  
                            </a></li>
                    </ul>
                </div>

            </div>

            <div class="span9">
<div class="hero-unit-3">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php echo $student_row['firstname'];?></strong>&nbsp;Welcome. <span class="pull-right">Programme:<?php echo $_COOKIE['pro'];?> ,Current year:<?php echo $_COOKIE['year'];?>, Semester:<?php echo $_COOKIE['ssem'];?></span>
                </div>
                <div class="slider-wrapper theme-default">
<div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Your Bio Data</strong><br>
                    If some information is missing please update with the Registrar's office
                </div>
                                 <?php 
								 $query = mysqli_query($conn,"select * from student where id='$session_id'");
                                    $row = mysqli_fetch_array($query);
									?>
								
									
									<table class="table-striped" width="100%" >
                                        <tr> <td>Phone number:</td><td><?php echo $row['stud_pnone']?> </td><td>Email:</td><td><?php  $row['stud_email']?></td></tr>
										 <tr><td>Student address:</td> <td><?php echo $row['stud_address']?></td><td>Birth date:</td><td><?php echo$row['birth_date']?></td></tr>
										   <tr><td>Adimission year:</td><td><?php  echo$row['addm_year']?></td><td>Program:</td><td><?php echo$row['cys']?></td></tr>
										   <tr><td>Semester</td><td><?php echo $row['sem']?></td><td>Entry qualification:</td><td><?php echo   $row['qualif'] ?></td></tr>
										   <tr><td>Study mode:</td><td><?php if($row['mode']==1)echo "Full time";else echo "Distance"?></td><td>tudy year:</td><td><?php echo $row['stud_current_year']?></td></tr>
										    <tr><td>Sponsor:</td><td><?php echo $row['sponsor'] ?></td><td>Sponsor address:</td><td><?php echo  $row['sp_address']?></td></tr>
											<tr><td>Sponsor Email:</td><td> <?php echo $row['spo_email']?></td><td>Sponsor phone:</td><td><?php echo  $row['spo_phone']?></td></tr>
											<tr></td>Sponsor relation:</td><td><?php echo  $row['sp_relation']?></td></tr>
																				 </table>
																				</div>
				</div>
                <!-- end slider -->
            </div>

        </div>
        <?php include('footer.php'); ?>
    </div>
</div>
</div>
</body>
</html>


