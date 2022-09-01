<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

$sql=pg_query($db,"SELECT products.id,products.cylindertypeid,products.cylinderweightid,products.location,products.price,products.status,products.vendorid,products.createdby,products.createdat,products.updatedby,products.updatedat,cylindertype.type,cylinderweight.weight,vendors.businessname,petroleum.petroleum_name FROM products LEFT JOIN  cylindertype on cylindertype.id = products.cylindertypeid left join cylinderweight on cylinderweight.id =products.cylinderweightid left join vendors on vendors.id = products.vendorid left join petroleum on petroleum.id = products.petroleumid where products.status=1");
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