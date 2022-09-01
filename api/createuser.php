<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$password=$_POST['password'];
$gender=$_POST['gender'];
$dateofbirth=$_POST['dateofbirth'];
$status="1";
$createdby="1";                                                                                                                                                                                         
if(!empty($firstname) && !empty($phone) && !empty($email) &&
!empty($gender) && !empty($dateofbirth) &&
!empty($status) && !empty($password))
{ 
  $sql = "SELECT * FROM users WHERE email='$email'";
    $res = pg_query($db, $sql);
    if(pg_num_rows($res) > 0){
        http_response_code(201);         
        echo"email_existed";
      }else{
    $sql = "INSERT INTO users(firstname,lastname,phone,email,gender,dateofbirth,status,createdby,password)VALUES('$firstname','$lastname','$phone','$email','$gender','$dateofbirth','$status','$createdby','$password')RETURNING id";
    $query=pg_query($db,$sql);
    if($query)
    {
        http_response_code(201);         
        echo "Success";
    }else
    {
        http_response_code(503);        
        echo"Error";
    }
  }
 }
 else{
    http_response_code(400);    
    echo "Error Please Check.";
   }
