<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
$location=$_GET['location'];
$price=$_GET['price'];
$status=$_GET['status'];
if(location !== "" && price !== "" && status !== "")
{
$sql=pg_query($db,"INSERT INTO products(location,price,status)VALUES( '$location','$price','$status')");
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









