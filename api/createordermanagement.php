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
  $userid=$_POST['id'];
  $deliveryaddressid=$_POST['deliveryaddressid'];
  $vendorid=$_POST['vendorid'];
  $accessoriesid=$_POST['accessoriesid'];
  $cylinderid=$_POST['cylinderid'];
  $deliverydate=$_POST['deldate'];
  $refiltype=$_POST['refiltype'];
  $addresstype=$_POST['addresstype'];
  $businessimg=$_POST['businessimg'];
  $expdate=$_POST['expdate'];
  $quantity=$_POST['quantity'];
  $cylinderimg=$_POST['cylinderimg'];
  $createdby="1";
  $createdat = date("y-m-d");
  $status=$_POST['status'];

if(!empty($userid) &&!empty($deliveryaddressid) &&!empty($accessoriesid)&&!empty($cylinderid) &&!empty($vendorid) && !empty($refiltype) && !empty($quantity) &&  
  !empty($addresstype)){

  if($addresstype==1){
     $sql=pg_query($db,"INSERT INTO ordermanagement(userid,deliveryaddressid,vendorid,accessoriesid,cylinderid,deldate,quantity,status,cylinderimg,createdby,createdat,refiltype,addresstype,businessimg,expdate)VALUES('$userid','$deliveryaddressid','$vendorid','$accessoriesid','$cylinderid','$deliverydate','$quantity','$status','$cylinderimg','$createdby','$createdat','$refiltype','$addresstype','$businessimg','$expdate')");
     if($sql){
       
        http_response_code(201);         
        echo json_encode(array("message" => "Successfull"));
   }else{
        http_response_code(503);        
        echo json_encode(array("message" => "Error"));
    }

  }else{

     $sql=pg_query($db,"INSERT INTO ordermanagement(userid,deliveryaddressid,vendorid,accessoriesid,cylinderid,deldate,quantity,status,cylinderimg,createdby,createdat,refiltype,addresstype)VALUES('$userid','$deliveryaddressid','$vendorid','$accessoriesid','$cylinderid','$deliverydate','$quantity','$status','$cylinderimg','$createdby','$createdat','$refiltype','$addresstype')");

    if($sql){
       
        http_response_code(201);         
        echo json_encode(array("message" => "Successfull"));
      
    }else{
        http_response_code(503);        
        echo json_encode(array("message" => "Error"));
    }

}}}else{
    http_response_code(400);    
    echo json_encode(array("message" => "Error Please Check."));
}

?>