<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if(isset($_REQUEST['deleteid']))
 { 
    $id=$_REQUEST['deleteid'];
	$sql=pg_query($db,"UPDATE vendors SET status='-1' WHERE id=$id");
    
	if($sql)
	{    
        http_response_code(201);
        echo json_encode(array("message"=>"Successfull"));
	}else
    {
        
        http_response_code(201);
        echo json_encode(array("message"=>"Error"));
    }
 }
 else{
    http_response_code(201);
    echo json_encode(array("message"=>"Error please check"));
     }
?>