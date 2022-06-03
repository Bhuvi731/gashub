<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

$availablestock=$_POST['availablestock'];
$status=$_POST['status'];
$createdby="1";
if(!empty($availablestock) &&
!empty($status)){ 

    $vendorrow= pg_query($db,"select * from products order by id desc");
    $vendorarray=pg_fetch_array($vendorrow);
    $product_id=$vendorarray['id'];

    $sql=pg_query($db,"INSERT INTO inventory(productid,availablestock,status,createdby)VALUES( '$product_id','$availablestock','$status','$createdby')");
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