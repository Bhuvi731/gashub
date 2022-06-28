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
$id=$_GET['id'];
$businessname=$_GET['businessname'];
$status="1";    
$updatedby="1";
$updatedat=date("d-m-y");                                                                                                                                                                                    
 if(!empty($id) && !empty($businessname) && !empty($status)){
    $sql = "UPDATE vendors SET businessname='$businessname',status='$status' WHERE id='$id'";
 $query=pg_query($db,$sql);
    if($query)
    {
      
        http_response_code(201);         
        echo  "success";
    }else
    {
        http_response_code(503);        
        echo "Error";
    }
}
}
else
{
    http_response_code(400);    
    echo "Error Please Check";
}
?>