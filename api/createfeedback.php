<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

$vendorbranch=$_POST['vendorbranch'];
$rating=$_POST['rating'];
$review=$_POST['review'];
$status=$_POST['status'];
$createdby="1";
if(!empty($vendorbranch) && !empty($rating) && !empty($review) &&
!empty($status)){ 

    $vendorrow= pg_query($db,"select * from ordermanagement order by id desc");
    $vendorarray=pg_fetch_array($vendorrow);
    $orderid=$vendorarray['id'];

    $cylindertyrow= pg_query($db,"select * from users order by id desc");
    $cylindertyarray=pg_fetch_array($cylindertyrow);
    $userid=$cylindertyarray['id'];

    $weightrow= pg_query($db,"select * from vendors order by id desc");
    $weightarray=pg_fetch_array($weightrow);
    $vendorid=$weightarray['id'];
 
    $sql=pg_query($db,"INSERT INTO feedbacks(orderid,userid,vendorid,vendorbranch,rating,review,status,createdby)VALUES( '$orderid', '$userid','$vendorid','$vendorbranch','$rating','$review','$status','$createdby')");
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