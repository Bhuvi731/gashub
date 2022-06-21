<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if(!empty($_GET['id']))
{
$id = $_GET['id'];
$addressline1=$_GET['addressline1'];
$pincode=$_GET['pincode'];
 $latitude=$_GET['latitude'];
 $longitude=$_GET['longitude'];
$status=$_GET['status'];
$createdby="1";                                                                                                                                                                   
 if(isset($id) && isset($addressline1)
 && isset($pincode) && isset($status)){
 $sql1="UPDATE useraddresses SET addressline1='$addressline1',pincode='$pincode',latitude='$latitude',longitude='$longitude',status='$status' WHERE id='$id'";
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