<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

if(isset($_POST['id']))
{
$user_id=$_POST['id'];
$name=$_POST['name'];
$addressline1=$_POST['addressline1'];
$addressline2=$_POST['addressline2'];
$city=$_POST['city'];
$landmark=$_POST['landmark'];
$district=$_POST['district'];
$state=$_POST['state'];
$country=$_POST['country'];
$pincode=$_POST['pincode'];
$status="1";
$createdby="1";

if(!empty($name) && !empty($addressline1) && 
!empty($city) && !empty($district) &&  !empty($state) &&  !empty($country) && !empty($pincode) && 
!empty($status)){

        $sql=pg_query($db,"INSERT INTO useraddresses(userid,name,addressline1,addressline2,city,landmark,district,state,country,pincode,latitude,longitude,status,createdby)VALUES('$user_id','$name','$addressline1','$addressline2','$city','$landmark','$district','$state','$country','$pincode','$latitude','$longitude','$status','$createdby')");
        
         http_response_code(201);  
         echo json_encode(array("message" => "Successfull"));
         }else{
         http_response_code(400);        
         echo json_encode(array("message" => "Error"));
               }
          }else{
         http_response_code(503);    
         echo json_encode(array("message" => "Error Please Check."));
                } 
  
?>
