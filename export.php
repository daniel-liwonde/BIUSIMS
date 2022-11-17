<?php  
 //export.php
 include 'admin/connect.php';   
	     include 'admin/header.php';
         include 'admin/functions.php';
        include('session.php');
        $my_year= $_POST['year'];
         $sem= $_POST['sem'];
         $sub=$_POST['sub'];
         //$adm=$_POST['adm'];
         
  if(($my_year=="" )||($sub =="") || ($sem=="")){
        echo"please make sure you selected subject Year and  Semester you are uploading the grades for";
        }
        else
        {//o
 if(!empty($_FILES["excel_file"] ))  
 {//open if empty  
      
         //if( ($my_year=="") && ($my_sem=="")){
      // $year= date('Y');
     // $sem=checksem();
         //}
         //else
         //{
       //$year= $my_year;
       //$sem=$my_sem;   
        // }
        
       $file_array = explode(".", $_FILES["excel_file"]["name"]); 
       $fileExt =$file_array[1];
      if($fileExt != "xlsx" )  
      {  
    echo '<label class="alert alert-danger"><i class="icon icon-exclamation-sign"></i> &nbsp;Invalid File please save it as excel work book(xls)</label>'; 
	  } 
	  else
	  { //open valid file
              /* $day=getdate();
			   $d= $day['yday'];
			   $sem2=checksem();
			   $es=mysqli_query($conn,"select * from closing_dates where  year='$year' and sem='$sem2'") or die(mysqli_error($conn));
			   $es1=mysqli_fetch_array($es);
			   $dueeos=$es1['day'];
			   if(($d > $dueeos) && ($dueeos!=0) ){//due date over
			   echo "Sorry closing date for grade entry is over";
			   }
			   else
			   {//open due date not over*/
			   
           include 'PHPExcel/IOFactory.php';  
           $output = ''; 
$absent='<div class="alert alert-info">CAUTION: if you have any IDs appearing down here means their results were not uploaded because details were not found in the system, please verify if they are not mistyped</div>
<div class="panel panel-default">
<div class="panel-header">The following IDs were not found</div>
<div class="panel-body">' ;          
 $output .= "  
           <label class='text-success'>Data Inserted, please verify below</label>  
                <table class='table table-bordered'>  
                     <tr>  
                          <th>student ID</th>  
                          <th>Surname</th>  
                          <th>Firstname</th>  
                           
                          <th>CW1</th> 
                          <th>CW2</th>
<th>EXAM</th>
<th>EOS</th>
<th>GRADE</th>
						  
                     </tr>  
                     ";  
$filename = basename($_FILES['excel_file']['name']);
 //$filename = basename($_FILES['excel_file']['name']);
$newname = "exam/". $filename;
//if (file_exists($newname)) { //open
//echo "file already exist in the directory";
//}//closed
//else{ // open no file in direc
//Attempt to move the uploaded file to it's new place
if ((move_uploaded_file($_FILES['excel_file']['tmp_name'], $newname))) {//open if uploaded
$inputFileName = $newname;
try { //open
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
}//closed
catch(Exception $e) {//open
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}//closed
//$sub=$_POST['sub'];
$query1 = mysqli_query($conn,"select * from subject where subject_code='$sub'") or die(mysqli_error($conn));
$subs=mysqli_fetch_assoc($query1);
$code=$subs['subject_code'];
$title=$subs['subject_title'];
$subid=$subs['subject_id'];
$lecturer=$subs['teacher_id'];
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
$absent.='<ol>';
for($i=4;$i<=$arrayCount;$i++){ //open for
$id = trim($allDataInSheet[$i]["A"]);
$ass1 =  trim($allDataInSheet[$i]["D"]);
$ass2 =  trim($allDataInSheet[$i]["E"]);
$exam =  trim($allDataInSheet[$i]["F"]);
$fgrade =  trim($allDataInSheet[$i]["G"]);
$rate =  rateEOS($fgrade);
$fgrade=round($fgrade,0);
$f2=mysqli_query($conn,"select * from student where student_id='".$id."'") or die(mysqli_error($conn));
	if((mysqli_num_rows($f2)==0) && ($id!=''))
		$absent.='<li>'.$id.'</li>';
	else
	{
	    $real=false;
		$detail=mysqli_fetch_array($f2);
		$uid=$detail['id'];
		repeat($uid);
		updyearandsem($uid);
		clean($conn,$uid);
$f=mysqli_query($conn,"select * from results where uid='$uid' and course_code='$code' and year='$my_year' and sem='$sem'") or die(mysqli_error($conn));
if(mysqli_num_rows($f)>0)
	mysqli_query($conn,"update results set assign_1='".$ass1."',assign_2='".$ass2."',fgrade='".$fgrade."', EOS='".$exam."',comment='".$rate."', byw='$session_id'  where uid='$uid' and course_code='$code' and year='$my_year' and sem='$sem'") or die(mysqli_error($conn));

else
{
	//else
	//{
	
	$fn=clean($conn,$detail['firstname']);
	$ln=clean($conn,$detail['lastname']);
	$csem=clean($conn,$detail['current_sem']);
	$mode=clean($conn,$detail['mode']);
	$prog=clean($conn,$detail['cys']);
	$cy=clean($conn,$detail['stud_current_year']);
	$dept=clean($conn,$detail['dept']);
	if($id!=''){
mysqli_query($conn,"insert into results(uid,student_id,firstname,surname,course_code,assign_1,assign_2,
EOS,fgrade,year,sem, comment,prog,mode,stud_year,dept,studsem,byw)
values('$uid','".$id."','$fn','$ln','$code','".$ass1."',
'".$ass2."','".$exam."','".$fgrade."','$my_year','$sem','".$rate."',
'$prog','$mode','$cy','$dept','$csem','$session_id')") or die(mysqli_error($conn));
$subj = mysqli_query($conn,"select * from teacher_student where uid='$uid' and  subject_id='$subid' and year='$my_year' and semester='$sem'") or die(mysqli_error($conn));
  $total = mysqli_num_rows($subj);
if ($total == 0) 
{
  
       $lect_id=$session_id;
      
            
mysqli_query($conn,"insert into teacher_student(teacher_id,uid,year,semester,subject_id) 
values('$lect_id','$uid','$my_year','$sem','$subid')") or die(mysqli_error($conn));
}
	} 
	if($id !=''){
                     $output .= '  
                     <tr>  
                          <td>'.$id.'</td>  
                          <td>'.$fn.'</td>  
                          <td>'.$ln.'</td> 
					  
                          <td>'.$ass1.'</td>
 <td>'.$ass2.'</td>
 <td>'.$exam.'</td>
 <td>'.$fgrade.'</td> 
 <td>'.$rate.'</td> 
                     </tr>  
                     '; 
	}					 
	}
                }  // close for
	
}
           $output .= '</table>';
		   $output .='Results uploaded for: '.$title .'</font>';
		   $absent.='</ol>';
		   $absent.='</div></div>';
 $absent.='<br>';
 echo $absent;
           echo $output;
		   
      }//if uploaded
      //}//close if no file in directory
//}//close due date over
	  }	//close valid 
        }//close details selected
 } //close if empty 
 ?>

 