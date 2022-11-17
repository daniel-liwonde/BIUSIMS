<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT");
include "connect.php";
/*$data = json_decode(file_get_contents("php://input"));
$name=$data->name;
$age= $data->age;
$phone=$data->phone;
$id= $data->id;
if($name !="" || $age !="" || $phone !="")
{
$stm ="UPDATE users SET name='$name',age='$age',phone='$phone' WHERE id='$id'";
mysqli_query($conn,$stm) or die(mysqli_error($conn));
}*/
?>