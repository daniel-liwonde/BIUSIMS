<?php
$name=mysqli_fetch_array($results);
$fname=$name['firstname'];$lname=$name['surname'];$reg=$name['student_id'];
$st=mysqli_query($conn,"select * from student where id='$sname'")or die(mysqli_error($conn));
$sdetail=mysqli_fetch_array($st);
$program=mysqli_query($conn,"select * from course where course_id='$sdetail[cys]'")or die(mysqli_error($conn));
$pro=mysqli_fetch_array($program);
?>
<tr><td colspan="8"  style="font-weight:bold; font-size:19px;"><div style="margin-left:9%">BLANTYRE INTERNATIONAL UNIVERSITY</div></td></tr>
<tr><td colspan="8" >   
<table border="0" width="90%" style="text-align:right; font-family:Times New Roman; font-size:10pt" cellpadding="0" cellspacing="0">
<tr><td rowspan="5"  align="left"><img src="images/logo.png" alt="BIU LOGO" height="40" width="70" /></td><td> Private Bag 98, Blantyre, Malawi</td></tr>
<tr ><td ><b>Telephone:</b> +265 1 637515</td></tr>
<tr ><td ><b>Fax:</b> +265 1 637 525 </td></tr>
<tr ><td ><b>Email:</b> info@biu.ac.mw</td></tr>
<tr ><td ><b>Website:</b> www.biu.ac.mw</td></tr>
</table>
</td></tr>
<tr><td colspan="8" align="center" ><div style="font-weight:bold; margin-left:-16%; font-size:15px">CONFIDENTIAL</div></td></tr>
<tr><td colspan="8" align="center" ><div style="font-weight:bold; margin-left:-16%; font-size:15px; height:10px;"></div></td></tr>
<tr><td colspan="8" align="center" ><div style="font-weight:bold; margin-left:-16%; font-size:15px;height:30px;">PARTIAL ACADEMIC TRANSCRIPT</div></td></tr>
<tr><td colspan="8" align="center" ><div style="font-weight:bold; margin-left:-1px; font-size:15px;height:25px; border-bottom:2px solid #CCCCCC; border-top:2px solid #CCCCCC; width:100%;"><span style="margin-left:-15%; padding-top:10px;"><?php echo $lname."&nbsp;". $sdetail['middle_name']."&nbsp;". $fname ?></span></div></td></tr>
<tr><td colspan="8" >
<table border="0" width="100%"  style="text-align:left">
<tr><th width="21%">Surname:</th>
<td width="46%"><?php echo $lname ?></td>
<th width="18%">Gender:</th>
<td width="14%"><?php echo $sdetail['gender'] ?></td>
</tr>
<tr><th>Firstname:</th><td><?php echo $fname ?></td><th>Date of birth:</th>
<td><?php echo $sdetail['birth_date'] ?></td>
</tr>
<tr>
<th>Programme:</th>
<td><?php echo $pro['cys'] ?></td>
<th>Nationality:</th>
<td><?php echo $sdetail['nation'] ?></td>
</tr>
<tr>
<th>Registration No:</th>
<td><?php echo $reg ?></td>
<th>Tel</th>
<td><?php echo $sdetail['stud_pnone'] ?></td>
</tr>
<tr><th >Basis of admission:</th>
<td  valign="top"><?php echo $sdetail['qualif'] ?></td>
<th>Email:</th>
<td><?php echo $sdetail['stud_email'] ?></td>
</tr>
      <tr>
      <th>Exemption:</th>
      <th><?php if($sdetail['joined_in']==1) echo"None"; if($sdetail['joined_in']==2) echo "One Year";if($sdetail['joined_in']==3) echo "Two Years"; ?></th><th><strong>Home  address:</strong></th>
      <td rowspan="2" valign="top"><?php echo $sdetail['stud_address'] ?></td>
      </tr>
	  <tr><td colspan="8" align="center" ><div style="font-weight:bold; margin-left:1px; font-size:15px; border-top:2px solid #CCCCCC;"></div></td></tr>
 <tr><td colspan="8" align="center" >  
<br> 
<?php
$y3sem1=0;$y3sem2=0;$y4sem1=0;$y4sem2=0; $y5sem1=0;$y5sem2=0;
$a=0;$b =0;$c=0;$d=0; $e=0; $f5=0;
$y=mysqli_query($conn,"select distinct year,sem,studsem from results where uid=$sname and stud_year='1' and studsem='1'") or die(mysqli_error($conn));
$y21=mysqli_fetch_array($y);
$y2s=$y21['year'];
 if($y21['sem']==1) $y1sem="Jan-Jun";else $y1sem="July-Dec";
include('year1.php');
$y2=mysqli_query($conn,"select distinct year,sem from results where uid=$sname and stud_year='2' and studsem='1'") or die(mysqli_error($conn));
$y21=mysqli_fetch_array($y2);
$y22=$y21['year'];
if($y21['sem']==1){ $y2s1="Jan-Jun"; $se21="July-Dec";}else{ $y2s1="July-Dec";$se21="Jan-Jun";} 
?>


<?PHP
include('year2.php');
include('year3.php');
?>

<?php
$y4semf=mysqli_query($conn,"select distinct year,sem from results where uid=$sname and stud_year='4' and studsem='1'") or die(mysqli_error($conn));
$y41=mysqli_fetch_array($y4semf);
$y4f=$y41['year'];
if($y41['sem']==1) $tag41="Jan-Jun";else $tag41="July-Dec";
include("year4.php");
$check=mysqli_query($conn,"select distinct year,sem from results where uid=$sname and stud_year='5' and studsem='1'") or die(mysqli_error($conn));
if(mysqli_num_rows($check)!=0){
include("year5.php");
}
$totalmark= $y3sem1+ $y3sem2+ $y4sem1 + $y4sem2+ $y5sem1 + $y5sem2;
$count=$a+$b+$c+$d+$e+$f5;
if(isset($totalmark)&& ($totalmark!=0)){
$class=$totalmark/$count;
$dc=mysqli_query($conn,"select * from transcript_class where frm<='$class' and t>='$class'") or die(mysqli_error($conn));
if(mysqli_num_rows($dc)==0)
$dclas="NO CLASS";
else
{
$cl=mysqli_fetch_array($dc);
$dclas=$cl['class'];
}

?>

<div style="font-weight:bold; margin-left:1px; font-size:15px; border-top:2px solid #CCCCCC;border-bottom:2px solid #CCCCCC;">
Cummulative Average:&nbsp;&nbsp;&nbsp;<?php echo round($class ,1); ?><br />Degree Classification:&nbsp;&nbsp;&nbsp;<?php echo $dclas ;?>
</div>
<br>
<table border="0" align="center" width="90%">

<tr><th colspan="2" align="left"> Grading Scale</th></tr>
<tr><th align="left" width="160"> Mark(100%)</th><th align="left">Designation</th></tr>
<?php
$s=mysqli_query($conn,"select * from transcript_class order by frm DESC");
while($rows=mysqli_fetch_array($s))
{
?>
<tr><td align="left"><?php echo $rows['frm'] ; ?>-<?php echo $rows['t'] ; ?></td><td align="left"><?php echo $rows['class'] ; ?></td><th></th></tr>
<?php } ?>
<tr><th align="left"  colspan="5">Registrar's Signature:___________________________________________</th><th>Date:<?php  $Today = date('y:m:d');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new; ?></th></tr>
                        </table>
                     <?php }?>
                     </td></tr>  
</table>					 