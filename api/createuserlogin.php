<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

$email=$_POST['email'];
$password=$_POST['password'];
if(isset($email) && isset($password))
{ 
 
    $sql=pg_query($db,"SELECT id,email,password from users where email='$email' and password='$password'LIMIT 1");
    if(pg_num_rows($sql)>0)
    {
        if($sql2=pg_fetch_array($sql))
        {
            $_SESSION['id']=$sql2[0];
             http_response_code(201);         
             echo json_encode(array("message" => "Successfull"));
        } 

    }else{
        http_response_code(503);        
        echo json_encode(array("message" => "Error"));
         }
}else{
    http_response_code(400);    
    echo json_encode(array("message" => "Error Please Check."));
}
?>