<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

$sql=pg_query($db,"SELECT ordermanagement.id,ordermanagement.userid,ordermanagement.deliveryaddressid,ordermanagement.vendorid,ordermanagement.productid,ordermanagement.quantity,ordermanagement.status,ordermanagement.createdby,ordermanagement.createdat,ordermanagement.updatedby,ordermanagement.updatedat,ordermanagement.refiltype,ordermanagement.deldate,ordermanagement.cylinderimg,users.firstname,useraddresses.addressline1,useraddresses.pincode,useraddresses.latitude,useraddresses.longitude,vendors.businessname,products.cylindertypeid,products.cylinderweightid,products.location,products.price,products.petroleumid,products.proimg FROM ordermanagement left join users on users.id=ordermanagement.userid left join useraddresses on useraddresses.id=ordermanagement.deliveryaddressid left join vendors on vendors.id=ordermanagement.vendorid left join products on products.id=ordermanagement.productid where ordermanagement.status=1");
$my=array();
 if($sql){
   //var_dump($sql); 
    while($sql2=pg_fetch_assoc($sql)){
 
             http_response_code(201);
                 $my[]=$sql2;
                 
             }      
                echo json_encode($my);
           }else{
          http_response_code(503);        
        echo json_encode(array("message" => "Error"));
             }
?> 