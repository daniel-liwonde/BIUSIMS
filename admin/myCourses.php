<?php
if(isset($_GET['sub'])){//open if sset
$prog=$_GET['sub'];
$sem=checksem();
$year=date('Y');
$i=1;$m='#FFFFFF';
?>

<?php
$sel=mysqli_query($conn,"select distinct uid from teacher_student where year='$year' and semester='$sem'") or die("here".mysqli_error($conn));
while($row=mysqli_fetch_assoc($sel)){//open first while
$uid=$row['uid'];
$sel2=mysqli_query($conn,"select firstname, lastname, middle_name,student_id, cys, id  from student where id='$uid' and cys='$prog'")or die("here".mysqli_error($conn));
$student_row=mysqli_fetch_assoc($sel2);
$first=$student_row['firstname'];
$last=$student_row['lastname'];
$middle=$student_row['middle_name'];
$program=$student_row['cys'];
if($student_row['student_id']!="")
{//open if not empty
?>
<tr align="center" bgcolor="<?php echo $m ?>" >
<td><?php  echo $i  ?></td>
<td align="left">
    <p>
studentname  :&nbsp;<?php echo $last ."  " .$first?><br />
StudentID   &nbsp;&nbsp;&nbsp; :&nbsp;<?php echo $student_row['student_id']?><br />
Programme&nbsp;&nbsp;:&nbsp;<?php echo $program?><br />
</p>
   <ol>
    <?php
   $sel3=mysqli_query($conn,"select * from teacher_student where   uid='$uid'and  year='$year' and semester='$sem'") or die("here".mysqli_error($conn));
   while($subs= mysqli_fetch_assoc($sel3))
   {//open second loop
      $subj= $subs['subject_id'];
       $sel2=mysqli_query($conn,"select * from subject where  subject_id='$subj'")or die("here".mysqli_error($conn));
       $sub= mysqli_fetch_assoc($sel2);
       ?>
    
   <li> <?php echo $sub['subject_code']?>
    <?php echo $sub['subject_title']?></li>
    
    
    <?php
   }//close second loop
?>
</ol>
</td>
</tr>
<?php  
$i++;
}//close not empty
}//close first while
?>
<label class="alert alert-info"> List of Courses for  <?php echo $prog ."  ". $year; if($sem==2) echo",  July-Dec"; else echo"Jan-June "?>  Semester  Students </label>
<?Php
}//close ifset
?>

