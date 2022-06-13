<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if(isset($_POST['userid']))
{
  $userid=$_POST['userid'];
  $deliveryaddressid=$_POST['deliveryaddressid'];
  $vendorid=$_POST['vendorid'];
  $productid=$_POST['productid'];
  $refiltype=$_POST['refiltype'];
  $quantity=$_POST['quantity'];
  $createdby="1";
  $createdat = date("d-m-Y");
  $status="1";

if(!empty($userid) &&!empty($deliveryaddressid) &&!empty($vendorid) &&!empty($productid) &&!empty($refiltype) && !empty($quantity) &&
!empty($status)){
 
    $sql=pg_query($db,"INSERT INTO ordermanagement(userid,deliveryaddressid,vendorid,productid,quantity,status,createdby,createdat,refiltype)VALUES('$userid','$deliveryaddressid','$vendorid','$productid','$quantity','$status','$createdby','$createdat','$refiltype')");
    if($sql){
       
        http_response_code(201);         
        echo json_encode(array("message" => "Successfull"));
      
    }else{
        http_response_code(503);        
        echo json_encode(array("message" => "Error"));
    }
  }}else{
    http_response_code(400);    
    echo json_encode(array("message" => "Error Please Check."));
}

?>