<?php include('header.php'); 
 include('session.php'); 
 include('functions.php'); 
$year=date('Y');
$sem=checksem();
?>
<?php
if (isset($_POST['send'])) {
  header("Content-Type:application/msexcel");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("content-disposition: attachment;filename=report.xlx");

?>

<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered" id="example">
                               
                                <thead>
                                    <tr>
                                              

                                       
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Department</th> 
                                         <th>Phone number</th> 
                                         <th>Email</th> 
                                                                      
                                        <th width="227" >Subjects</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($conn,"select * from teacher") or die(mysqli_error($conn));
                                    while ($row = mysqli_fetch_array($query)) {
                                        $teacher_id = $row['teacher_id'];
                                        ?>
                                        <tr class="odd gradeX">

                                            
                                   
                                    <td><?php echo $row['firstname']; ?></td> 
                                    <td><?php echo $row['lastname']; ?></td> 
                                    <td><?php echo $row['department']; ?></td> 
                                      <td><?php echo $row['pno'] ; ?></td> 
                                        <td><?php echo $row['email'] ; ?></td> 
                                        
                                     <td>
<ol>
<?php
$su=mysqli_query($conn,"select * from subject where teacher_id='$teacher_id'")or die(mysqli_error($conn));
 while($my=mysqli_fetch_assoc($su))
{
$cc=$my['subject_code'];

$mark=mysqli_query($conn,"select * from results where course_code='$cc' and year='$year' and sem='$sem'");
if(mysqli_num_rows($mark)==0)
$w="";
else
$w="Entered";


echo "<li>".$my['subject_title']."[<font color='red'><font size='1'>".$w. "</font></font>]"."</li>";
}
?>
</ol>
</td>   
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
<?php

  exit; // end of word output

}
?>
