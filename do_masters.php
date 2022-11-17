<?php
include('admin/functions.php');
//$asz=$_GET['ass_no'];
if(empty($_GET['ass_no'])){
echo json_encode(array("err"=>"Please select assignment No"));
}
else
{
if($_GET['grade']==''){
echo json_encode(array("err"=>"Please enter grade"));

			 	   }
			   else
			   { //start assno			   
			    $year= date('Y');
			   $day=getdate();
			   $d= $day['yday'];
			   $sem2=checksem();
			   $as1=mysqli_query($conn,"select * from closing_dates where id='1' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
			   $ss1=mysqli_fetch_array($as1);
			   $s1=$ss1['day'];
			   $as2=mysqli_query($conn,"select * from closing_dates where id='2' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
			   $ss2=mysqli_fetch_array($as2);
			   $s2=$ss2['day'];
			   
			   $es=mysqli_query($conn,"select * from closing_dates where id='3' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
			   $es1=mysqli_fetch_array($es);
			   $sem3=$es1['day'];
			 $code=  $_GET['ccode'];
             $stud=  $_GET['stud_id'];
			   $ass_no=$_GET['ass_no'];
			  $fn=clean($conn,$_GET['fn']);
			   $ln=clean($conn,$_GET['ln']);
			    $cy=$_GET['cyear'];
				 $prog=$_GET['prog'];
				  $mode=$_GET['mode'];
				  $dept=$_GET['dept'];
				  $my=$_GET['myid'];
                                   $sem = $_GET['sem'];
			       
				 
				  
			 if ((($ass_no==1) &&(($d>$s1)&&($s1!=0)))|| (($ass_no==2) &&(($d>$s2)&&($s2!=0)))||(($ass_no==3) &&(($d>$sem3)&&($sem3!=0)))){//due date over
			  echo json_encode(array("err"=>"Sorry closing date for assignment1 grade entry is over"));
			  if($ass_no==2)  echo json_encode(array("err"=> "Sorry closing date for assignment2 grade entry is over"));
			  if($ass_no==3)  echo json_encode(array("err"=>"Sorry closing date for EOS grade entry is over"));
			 } 
			 else
			{//open not due date	 
              $grade = clean($conn,$_GET['grade']);
			   if(($grade>100) || ($grade<0) ||(is_numeric($grade)==false)){//inalid grade
			 echo json_encode(array("err"=> "Invalid grade"));
			  }
			  else{//start valid
$query = mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2' ") or die(mysqli_error($conn));
$get=mysqli_fetch_array($query);
                $count = mysqli_num_rows($query);
                    if ($count == 0) { //start count=0
					if ($ass_no==1){ //start ass==1
				$es=	calculateEOSmasters($grade,0,0);
				$rate=rateEOSmasters($es);
				mysqli_query($conn,"insert into results(uid,student_id,firstname,surname,course_code,assign_1,year,sem, fgrade,comment,prog,mode,stud_year,dept,studsem,category)values('$stud','$my','$fn','$ln','$code','$grade','$year','$sem2','$es','$rate','$prog','$mode','$cy','$dept','$sem','1')") or die(mysqli_error($conn));
$up=mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'");
$myupp=mysqli_fetch_assoc($up);
$ax1=$myupp['assign_1'];
$ax2=$myupp['assign_2'];
$exa=$myupp['EOS'];
$fg=$myupp['fgrade'];
$com=$myupp['comment'];
if($ax1==0 or $ax2==0 or $exa==0) $WAT="N/A"; else $WAT=$com;              	
 echo json_encode(array("err"=>"grade added","as1"=>$ax1,"as2"=>$ax2,"exa"=>$exa,"fg"=>$fg,"com"=>$WAT));					
			}//end ass==1
				if($ass_no==2){//start ass==2
				$es=	calculateEOSmasters( 0,$grade,0);
				$rate=rateEOSmasters($es);
			    mysqli_query($conn,"insert into results(uid,student_id,firstname,surname,course_code,assign_2,year,sem,fgrade,comment,prog,mode,stud_year,dept,studsem,category) 
				values('$stud','$my','$fn','$ln','$code','$grade','$year','$sem2','$es','$rate','$prog','$mode','$cy','$dept','$sem','1')") or die(mysqli_error($conn));
$up=mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'");
$myupp=mysqli_fetch_assoc($up);
$ax1=$myupp['assign_1'];
$ax2=$myupp['assign_2'];
$exa=$myupp['EOS'];
$fg=$myupp['fgrade'];
$com=$myupp['comment'];
if($ax1==0 or $ax2==0 or $exa==0) $WAT="N/A"; else $WAT=$com;              	
 echo json_encode(array("err"=>"grade added","as1"=>$ax1,"as2"=>$ax2,"exa"=>$exa,"fg"=>$fg,"com"=>$WAT));				
				}//end ass==2
				if($ass_no==3){//start ass==3
				$es=	calculateEOSmasters( 0,0,$grade);
				$rate=rateEOSmasters($es);
				mysqli_query($conn,"insert into results(uid,student_id,firstname,surname,course_code,EOS,year,sem,fgrade,comment,prog,mode,stud_year,dept,studsem,category) values('$stud','$my','$fn','$ln','$code','$grade','$year','$sem2','$es','$rate','$prog','$mode','$cy','$dept','$sem','1')") or die(mysqli_error($conn));
$up=mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'");
$myupp=mysqli_fetch_assoc($up);
$ax1=$myupp['assign_1'];
$ax2=$myupp['assign_2'];
$exa=$myupp['EOS'];
$fg=$myupp['fgrade'];
$com=$myupp['comment'];
if($ax1==0 or $ax2==0 or $exa==0) $WAT="N/A"; else $WAT=$com;              	
 echo json_encode(array("err"=>"grade added","as1"=>$ax1,"as2"=>$ax2,"exa"=>$exa,"fg"=>$fg,"com"=>$WAT));				
			 //sendresults($stud,$code);
				}//end ass==3
				}//end count=0
				if($count==1)
				{ //start count==1
				if ($ass_no==1){//start ass==1
				
				$sel=	mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2' ") or die(mysqli_error($conn));
				$row=mysqli_fetch_array($sel);
				$ass2=$row['assign_2'];	
				$exam=$row['EOS'];
				 $es=	calculateEOSmasters($grade,$ass2,$exam);
				$rate=rateEOSmasters($es);
				  mysqli_query($conn,"update results set assign_1='$grade',fgrade='$es',comment='$rate'  where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
$up=mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'");
$myupp=mysqli_fetch_assoc($up);
$ax1=$myupp['assign_1'];
$ax2=$myupp['assign_2'];
$exa=$myupp['EOS'];
$fg=$myupp['fgrade'];
$com=$myupp['comment'];
if($ax1==0 or $ax2==0 or $exa==0) $WAT="N/A"; else $WAT=$com;              	
 echo json_encode(array("err"=>"grade added","as1"=>$ax1,"as2"=>$ax2,"exa"=>$exa,"fg"=>$fg,"com"=>$WAT));			  
				  } //end ass==1
				  else if($ass_no==2){//start ass==2
				 $sel=	mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
				$row=mysqli_fetch_array($sel);
				$ass1=$row['assign_1'];	
				$exam=$row['EOS'];
				$es=	calculateEOSmasters($ass1,$grade,$exam);
				$rate=rateEOSmasters($es);			  				  
				mysqli_query($conn,"update results set  assign_2='$grade',fgrade='$es',comment='$rate' where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
$up=mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'");
$myupp=mysqli_fetch_assoc($up);
$ax1=$myupp['assign_1'];
$ax2=$myupp['assign_2'];
$exa=$myupp['EOS'];
$fg=$myupp['fgrade'];
$com=$myupp['comment'];
if($ax1==0 or $ax2==0 or $exa==0) $WAT="N/A"; else $WAT=$com;              	
 echo json_encode(array("err"=>"grade added","as1"=>$ax1,"as2"=>$ax2,"exa"=>$exa,"fg"=>$fg,"com"=>$WAT));		 
				  }//end ass==2
				  else
				  { //start ass==3
				   $sel=	mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2' and firstname='$fn' and surname='$ln'") or die(mysqli_error($conn));
				$row=mysqli_fetch_array($sel);
				$ass1=$row['assign_1'];	
				$ass2=$row['assign_2'];
				
				$es=	calculateEOSmasters($ass1,$ass2,$grade);
				$rate=rateEOSmasters($es);	
				   mysqli_query($conn,"update results set EOS='$grade',fgrade='$es',comment='$rate' where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
$up=mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'");
$myupp=mysqli_fetch_assoc($up);
$ax1=$myupp['assign_1'];
$ax2=$myupp['assign_2'];
$exa=$myupp['EOS'];
$fg=$myupp['fgrade'];
$com=$myupp['comment'];
if($ax1==0 or $ax2==0 or $exa==0) $WAT="N/A"; else $WAT=$com;              	
 echo json_encode(array("err"=>"grade added","as1"=>$ax1,"as2"=>$ax2,"exa"=>$exa,"fg"=>$fg,"com"=>$WAT));				
				}//endass==3
				}//end count=1
				}//end valid
				}//end  due date not over
				}//end isset assno
				}//end isset save
?>