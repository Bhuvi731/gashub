<?php
include_once '../database/db.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$businessname=$_POST['businessname'];
$name=$_POST['name'];
$addressline1=$_POST['addressline1'];
$addressline2=$_POST['addressline2'];
$city=$_POST['city'];
$landmark=$_POST['landmark'];
$district=$_POST['district'];
$state=$_POST['state'];
$country=$_POST['country'];
$pincode=$_POST['pincode'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
$status=$_POST['status'];
$createdby="1";
if(!empty($businessname) && !empty($name) && !empty($addressline1) &&  !empty($addressline2) && 
!empty($city) && !empty($landmark) && !empty($district) &&  !empty($state) &&  !empty($country) && !empty($pincode) && !empty($latitude) && !empty($longitude) &&
!empty($status)){ 

    $sql="INSERT INTO vendors(businessname,status,createdby)VALUES('$businessname','1','$createdby')";
    $query=pg_query($db,$sql);
    
    if($query){

        $vendorrow= pg_query($db,"select * from vendors order by id desc");
        $vendorarray=pg_fetch_array($vendorrow);
        $vendor_id=$vendorarray['id'];
        
        
        $sql=pg_query($db,"INSERT INTO vendoraddresses(vendorid,name,addressline1,addressline2,city,landmark,district,state,country,pincode,latitude,longitude,status,createdby)VALUES('$vendor_id','$name','$addressline1','$addressline2','$city','$landmark','$district','$state','$country','$pincode','$latitude','$longitude','$status','$createdby')");
        
        http_response_code(201);  
        echo json_encode(array("message" => "Successfull"));
               }
        
    else{
        http_response_code(503);        
        echo json_encode(array("message" => "Error"));
       }
       }
     
    else
       {
         http_response_code(400);    
         echo json_encode(array("message" => "Error Please Check."));
       } 
  
?>