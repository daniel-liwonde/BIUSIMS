<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT");
include "connect.php";
$sql="SELECT * FROM users WHERE id='". $_GET['id']."'";
$result=mysqli_query($conn,$sql);
$output="";
while($row=mysqli_fetch_array($result))
{
    if($output !="") {$output.=",";}
    $output.= '{"name": "'.$row["name"] .'" ,';
        $output.= '"age": "'.$row["age"] .'" ,';
        $output.= '"id": "'.$row["id"] .'" ,';
        $output.= '"phone": "'.$row["phone"] .'" }';

}
echo $output;
?>