<?php
include('admin/functions.php');
//if($_GET['cmd']=='send2'){
if(empty($_GET['ass_no'])){
echo json_encode(array("err"=>"Please select assignment No"));
}
elseif($_GET['grade']==''){
echo json_encode(array("err"=>"Please enter grade"));
}
			   elseif(($_GET['grade']>100) || ($_GET['grade']<0) ||(is_numeric($_GET['grade'])==false)){//inalid grade
			 echo json_encode(array("err"=> "Invalid grade"));
			 }
			  else
			  {//open valid inputs
			       $grade = clean($conn,$_GET['grade']);
			       $code=  $_GET['ccode'];
                   $stud=  $_GET['uid'];
			       $ass_no=$_GET['ass_no'];
				   $year=$_GET['year'];
                   $sem2 = $_GET['sem'];
				if ($ass_no==1){//start ass==1
$sel=	mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
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
 echo json_encode(array("err"=>"Grade Updated","as1"=>$ax1,"as2"=>$ax2,"exa"=>$exa,"fg"=>$fg,"com"=>$WAT));			  
				  } //end ass==1
				  else if($ass_no==2){//start ass==2
				 $sel=	mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
				$row=mysqli_fetch_array($sel);
				$ass1=$row['assign_1'];	
				$exam=$row['EOS'];
				$es=	calculateEOSmasters($ass1,$grade,$exam);
				$rate=rateEOSmasters($es);			  				  
				mysqli_query($conn,"update results set assign_2='$grade',fgrade='$es',comment='$rate' where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
$up=mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'");
$myupp=mysqli_fetch_assoc($up);
$ax1=$myupp['assign_1'];
$ax2=$myupp['assign_2'];
$exa=$myupp['EOS'];
$fg=$myupp['fgrade'];
$com=$myupp['comment'];
if($ax1==0 or $ax2==0 or $exa==0) $WAT="N/A"; else $WAT=$com;              	
 echo json_encode(array("err"=>"Grade Updated","as1"=>$ax1,"as2"=>$ax2,"exa"=>$exa,"fg"=>$fg,"com"=>$WAT));		 
				  }//end ass==2
				  else
				  { //start ass==3
				   $sel3=	mysqli_query($conn,"select * from results where uid='$stud' and course_code='$code' and year='$year' and sem='$sem2'") or die(mysqli_error($conn));
				$row=mysqli_fetch_array($sel3);
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
 echo json_encode(array("err"=>"Grade Updated","as1"=>$ax1,"as2"=>$ax2,"exa"=>$exa,"fg"=>$fg,"com"=>$WAT));				
				}//endass==3
				}//end valid inputs
				//}
?>