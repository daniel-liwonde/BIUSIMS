<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include "connect.php";
$sql="SELECT * FROM user";
$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$output="";
while($row=mysqli_fetch_array($result))
{
    if($output !="") {$output.=",";}
    $output.= '{"firstname": "'.$row["firstname"] .'" ,';
        $output.= '"lastname": "'.$row["lastname"] .'" ,';
         $output.= '"email": "'.$row["email"] .'" ,';
        $output.= '"id": "'.$row["user_id"] .'" ,';
        $output.= '"phone": "'.$row["pno"] .'" }';

}
$output='{"records":['.$output.']}';
echo ($output);
?>