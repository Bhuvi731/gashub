<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
$businessname=$_GET['businessname'];
$addressline1=$_GET['addressline1'];
$pincode=$_GET['pincode'];
$status=$_GET['status'];
if(businessname !== "" && addressline1 !== "" && pincode !== "" && status !=="")
{
$sql=pg_query($db,"INSERT INTO vendors(businessname,addressline1,pincode,status)VALUES( '$businessname','$addressline1','$pincode','$status')");
if($sql)
{
echo "success";
}
else
{
    echo "error";
}
}

?>
