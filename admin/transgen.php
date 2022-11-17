<?php
if(isset($_GET['send']))
{
$sname=$_GET['sname'];
$balance = mysqli_query($conn,"select * from student_fees where id='$sname'and fee_balance>0 ") or die("here".mysqli_error($conn)); 
		 if(mysqli_num_rows($balance)>0)  {
		  

?>
<div class='alert alert-danger'><i class='icon-remove-sign'></i>&nbsp;<b>Cant generate transcript the students has fees balance should clear it first </b></div>

<table class="table-stripped table-bordered">
    <tr><th>Year</th><th>Semester</th><td>Explaination</th></tr>
<?php
$rowb=mysqli_fetch_array($balance);

    if($rowb['user_id']==5) $exp="Fees balance";
    ?>
    <tr>
 <td>   
<?php echo $rowb['year'] ?>
</td>
<td>
 <?php  echo   $rowb['sem'] ?> 
</td>
<td>
  <?php echo $exp; ?>
</td>
</tr>
</table>
<?php
}// close balance 
else		     
{		     
		     
		     
$results=mysqli_query($conn,"select * from results where uid='$sname' and category='0'") or die(mysqli_error($conn));
if(mysqli_num_rows($results)==0)
{//student results not found
echo "<div class='alert alert-danger'><i class='icon-remove-sign'></i> &nbsp;No results found for student!</div>";
}//close not fpound
else
{//student results found
$full=mysqli_query($conn,"select * from student where id='$sname'")or die(mysqli_error($conn));
$p=mysqli_fetch_array($full);
$pr=$p['cys'];
$joined=$p['joined_in'];

$belong=mysqli_query($conn,"select * from course where course_id='$pr'")or die(mysqli_error($conn));
$get=mysqli_fetch_array($belong);

if($joined==1){$nums=$get['first'];$yu="First year enlrolled students ";}elseif($joined==2){$nums=$get['second'];$yu="  students with 1 year excemption";}else{$nums=$get['third'];$yu="students with 2 years exemption";}
 
include('body_under.php');
$select=mysqli_query($conn,"select distinct uid, course_code,comment from results where uid='$sname' and comment<>'F' and category='0'")or die(mysqli_error($conn));
$dd=mysqli_num_rows($select);
if($dd<$nums)
{//less subjects done
?>
<div class='alert alert-danger'><i class='icon-remove-sign'></i>&nbsp;<b>Course Number check</b></div>
<div class='alert alert-danger'><i class='icon-remove-sign'></i>&nbsp;<b>Less number of Courses encountered! <?php echo $pr .$yu; ?> Must do a total of <?php echo $nums ?> subjects,student did <?php echo $dd ?> subjects.</div>
<?php
}//end less subjects

$fail=mysqli_query($conn,"select distinct  course_code,comment,stud_year,studsem,year from results where uid='$sname' and comment='F' and stud_year<>0 ")or die(mysqli_error($conn));
if(mysqli_num_rows($fail)>0){ //fail found
?>
<div class='alert alert-danger'><i class='icon-remove-sign'></i>&nbsp;<b>Failed Courses</b></div>
<table id="example" align="center" class="table table-striped table-bordered">
<tr class="alert-info"><td>Course Code</td><td>Course Name</td><td>Failed year</td><td>Semester</td><td>Year</td></tr>
<?php
while($avcode=mysqli_fetch_array($fail))
{
$ccode=$avcode['course_code'];
$search=mysqli_query($conn,"select  distinct uid,course_code,comment,category,year,stud_year from results where uid='$sname' and course_code='$ccode' and comment<>'F'")or die(mysqli_error($conn));
if(mysqli_num_rows($search)==0){//failed subject not repeated
$subject=mysqli_query($conn,"select distinct  subject_code,subject_title from subject where subject_code='$ccode' and category='0'")or die(mysqli_error($conn));
$failedsub=mysqli_fetch_array($subject);
?>
<tr><td><?php echo $ccode ?></td><td><?php echo $failedsub['subject_title'] ?></td><td><?php echo $avcode['stud_year'] ?></td><td><?php echo $avcode['studsem'] ?></td><td><?php echo $avcode['year'] ?></td></tr>
<?php
}//close fail found not repeated
}//close while
}//close fail found
else
{
echo "All failed subjects were repeated and passed";
}
}//close student results found
}

}//close if isset
?>
