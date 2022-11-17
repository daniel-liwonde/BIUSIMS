<?php
include('functions.php');
$s=checksem();
$y=date('Y');
$id=$_GET['myid'];
$myauth=mysqli_query($conn,"select * from allowmo where uid='$id' and year ='$y' and sem ='$s'")or die(mysqli_error($conn));
if(mysqli_num_rows($myauth)>0){
	$find=mysqli_fetch_assoc($myauth);
	$d=$find['allow'];
	if($d==1){
		mysqli_query($conn,"update allowmo set allow=0 where uid='$id'");
	 echo json_encode(array("err"=> "More grades disabled"));
	}
	 else
	 {
		mysqli_query($conn,"update allowmo set allow=1 where uid='$id'");
	 echo json_encode(array("err"=> "More course enabled"));
	}
}
	mysqli_query($conn,"insert into allowmo(uid,year,sem,allow) values('$id','$y','$s','1')");
 echo json_encode(array("err"=> "More courses set"));


?>