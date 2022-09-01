<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if(isset($_GET['id']))
{

$id = $_GET['id'];
$availablestock=$_GET['availablestock'];
$status="1";    
$createdby="1";                                                                                                                                                                                    
 if(!empty($id) && !empty($availablestock) && !empty($status)){


 //echo"UPDATE feedbacks SET vendorbranch='$vendorbranch',rating='$rating',review='$review',status='$status' WHERE id='$id'";
    $sql = "UPDATE inventory SET availablestock='$availablestock',status='$status' WHERE id='$id'";
 $query=pg_query($db,$sql);
    if($query)
    {
      
        http_response_code(201);         
        echo  "successfull";
    }else
    {
        http_response_code(503);        
        echo "Error";
    }
}

else
{
    http_response_code(400);    
    echo json_encode(array("message" => "Error Please Check."));
}
}
?>