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
$firstname=$_GET['firstname'];
$lastname=$_GET['lastname'];
$phone=$_GET['phone'];
$email=$_GET['email'];
$gender=$_GET['gender'];
$password=$_GET['password'];
$dateofbirth=$_GET['dateofbirth'];
$status=$_GET['status'];
$createdby="1";                                                                                                                                                                                           
if(!empty($firstname) && !empty($phone) && !empty($email) &&
!empty($gender) && !empty($dateofbirth) &&
!empty($status) && !empty($password)){ 
 
    $sql = "UPDATE users SET firstname='$firstname',lastname='$lastname',gender='$gender',phone='$phone',email='$email',dateofbirth='$dateofbirth',password='$password',status='$status' WHERE id='$id'";
 $query=pg_query($db,$sql);
    if($query)
    {
      
        http_response_code(201);         
        echo json_encode(array("message" => "success"));
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
}
