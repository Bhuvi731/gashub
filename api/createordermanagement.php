<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

$quantity=$_POST['quantity'];
$status=$_POST['status'];
$createdby="1";
if(!empty($quantity) && 
!empty($status)){ 

    $vendorrow= pg_query($db,"select * from users order by id desc");
    $vendorarray=pg_fetch_array($vendorrow);
    $userid=$vendorarray['id'];

    $cylindertyrow= pg_query($db,"select * from useraddresses order by id desc");
    $cylindertyarray=pg_fetch_array($cylindertyrow);
    $deliveryaddressid=$cylindertyarray['id'];

    $cylinderweirow= pg_query($db,"select * from vendors order by id desc");
    $cylinderarray=pg_fetch_array($cylinderweirow);
    $vendorid=$cylinderarray['id'];

    $cylinderweightrow= pg_query($db,"select * from products order by id desc");
    $cylinderweightarray=pg_fetch_array($cylinderweightrow);
    $productid=$cylinderweightarray['id'];
 
    $sql=pg_query($db,"INSERT INTO ordermanagement(userid,deliveryaddressid,vendorid,productid,quantity,status,createdby)VALUES( '$userid', '$deliveryaddressid','$vendorid','$productid','$quantity','$status','$createdby')");
    if($sql)
    {
       
        http_response_code(201);         
        echo json_encode(array("message" => "Successfull"));
      
    }else
    {
        http_response_code(503);        
        echo json_encode(array("message" => "Error"));
    }
}
else
{
    http_response_code(400);    
    echo json_encode(array("message" => "Error Please Check."));
}

?>