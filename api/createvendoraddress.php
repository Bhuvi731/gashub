<?php
include_once '../database/db.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if(isset($_POST['vendorid']))
{
$vendorid=$_POST['vendorid'];
$addressline1=$_POST['addressline1'];
$pincode=$_POST['pincode'];
$status="1";
$createdby="1";
$createdat=date('d-m-y');
if(!empty($vendorid) && !empty($addressline1) && !empty($pincode)  &&
!empty($status))
{
        $sql=pg_query($db,"INSERT INTO vendoraddresses(vendorid,addressline1,pincode,status,createdby,createdat)VALUES('$vendorid','$addressline1','$pincode','$status','$createdby','$createdat')");
        
        if($sql)
    {
       
        http_response_code(201);         
        echo json_encode(array("message" => "Successfull"));
      
    }else
    {
        http_response_code(400);        
        echo json_encode(array("message" => "Error"));
    }
}
   
else
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