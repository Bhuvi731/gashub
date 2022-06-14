<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if(isset($_POST['userid']) && isset($_POST['orderid'])&& isset($_POST['vendorid']) && isset($_POST['petroleum_id'])){

$userid=$_POST['userid'];
$orderid=$_POST['orderid'];
$vendorid=$_POST['vendorid'];
$petroleum_id=$_POST['petroleum_id'];
$vendorbranch=$_POST['vendorbranch'];
$rating=$_POST['rating'];
$title=$_POST['title'];
$review=$_POST['review'];
$status="1";
$createdby="1";
if(!empty($userid) && !empty($orderid) && !empty($vendorid) && !empty($petroleum_id)&& !empty($vendorbranch) && !empty($rating) && !empty($review) &&
!empty($status)){ 
 
    $sql=pg_query($db,"INSERT INTO feedbacks(userid,orderid,vendorid,petroleum_id,vendorbranch,rating,title,review,status,createdby)VALUES( '$userid','$orderid', '$vendorid','$petroleum_id','$vendorbranch','$rating','$title','$review','$status','$createdby')");
    if($sql)
    {
       
        http_response_code(201);         
        echo json_encode(array("message" => "Successfull"));
      
    }else
    {
        http_response_code(503);        
        echo json_encode(array("message" => "Error"));
    }
}}
else
{
    http_response_code(400);    
    echo json_encode(array("message" => "Error Please Check."));
}

?>