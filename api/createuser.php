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
$createdat=date("d-m-y");                                                                                                                          
if(!empty($email) && !empty($status)){ 
    $sql = "SELECT id FROM users WHERE email='$email'";
    $res = pg_query($db, $sql);
    if(pg_num_rows($res) > 0){
      $res2=pg_fetch_array($res);
        http_response_code(201);         
        echo json_encode($res2);
      }else{
        
    $sql = "INSERT INTO users(firstname,lastname,phone,email,gender,dateofbirth,status,createdby,createdat,password)VALUES('$firstname','$lastname','$phone','$email','$gender','$dateofbirth','$status','$createdby','$createdat','$password')RETURNING id";
    
    $query=pg_query($db,$sql);
    if($query)
    {
       $insert_row = pg_fetch_row($query);
        $insert_id = $insert_row[0];
        $sql=pg_query($db,"INSERT INTO userlogins(userid)VALUES('$insert_id')");
        if($sql){
        $sql2=pg_query($db,"SELECT id from users where id='$insert_id'");
          if($sql3=pg_fetch_array($sql2)){

                                 http_response_code(201);        
                                echo json_encode($sql3);
                                          }
        

               }else{

                 http_response_code(503);        
                 echo json_encode(array("message" => "Error"));
                    }
}}}else
{
    http_response_code(400);    
    echo json_encode(array("message" => "Error Please Check."));
}
?>