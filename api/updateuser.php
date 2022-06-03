<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

if(isset($_POST['id']))
{

$id = $_POST['id'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$gender=$_POST['gender'];
$dateofbirth=$_POST['dateofbirth'];
$status=$_POST['status'];
$createdby="1";                                                                                                                                                                                           
if(!empty($firstname) && !empty($phone) && !empty($email) &&
!empty($gender) && !empty($dateofbirth) &&
!empty($status)){ 
 
    $sql = "UPDATE users SET firstname='$firstname',lastname='$lastname',gender='$gender',phone='$phone',email='$email',dateofbirth='$dateofbirth',status='$status' WHERE id='$id'";
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
?>