<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

$location=$_POST['location'];
$price=$_POST['price'];
$status=$_POST['status'];
$createdby="1";
 
if(!empty($location) && !empty($price) &&
!empty($status))
{ 

    $vendorrow= pg_query($db,"select * from vendors order by id desc");
    $vendorarray=pg_fetch_array($vendorrow);
    $vendor_id=$vendorarray['id'];
    // echo "$vendor_id";
    
    
    $cylindertyrow= pg_query($db,"select * from cylindertype order by id desc");
    $cylindertyarray=pg_fetch_array($cylindertyrow);
    $cylindertype_id=$cylindertyarray['id'];

    $weightrow= pg_query($db,"select * from cylinderweight order by id desc");
    $weightarray=pg_fetch_array($weightrow);
    $weight_id=$weightarray['id'];
 
     $sql=pg_query($db,"INSERT INTO products(vendorid,cylindertypeid,cylinderweightid,location,price,status,createdby)VALUES( '$vendor_id', '$cylindertype_id','$weight_id','$location','$price','$status','$createdby')");
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