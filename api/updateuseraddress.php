<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if(!empty($_REQUEST['id']))
{
$id = $_REQUEST['id'];
$addressline1=$_REQUEST['addressline1'];
$pincode=$_REQUEST['pincode'];
$latitude=$_REQUEST['latitude'];
$longitude=$_REQUEST['longitude'];
$status=$_REQUEST['status'];
$updatedby="1";
$updatedat=date('d-m-y');                                                                                                                                                                  
 if(isset($id) && isset($addressline1)
 && isset($pincode) && isset($status)){
 $sql1="UPDATE useraddresses SET addressline1='$addressline1',pincode='$pincode',latitude='$latitude',longitude='$longitude',status='$status',updatedby='$updatedby',updatedat='$updatedat' WHERE id='$id'";
 $sql=pg_query($db,$sql1);
 if($sql)
        {
          
            http_response_code(201);         
            echo json_encode(array("message" => "success"));
        }else
        {
            http_response_code(503);        
            echo json_encode(array("message" => "Error"));
        }
    }
}
    else
    {
        http_response_code(400);    
        echo json_encode(array("message" => "Error Please Check."));
    }



?>