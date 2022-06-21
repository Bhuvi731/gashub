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
  $status=$_POST['status'];
  if($status==1){
$sql=pg_query($db,"SELECT ordermanagement.id,ordermanagement.userid,ordermanagement.deliveryaddressid,ordermanagement.vendorid,ordermanagement.productid,ordermanagement.quantity,ordermanagement.status,ordermanagement.createdby,ordermanagement.createdat,ordermanagement.updatedby,ordermanagement.updatedat,ordermanagement.refiltype,ordermanagement.deldate,ordermanagement.cylinderimg,users.firstname,useraddresses.addressline1,useraddresses.pincode,useraddresses.latitude,useraddresses.longitude,vendors.businessname,products.cylindertypeid,products.cylinderweightid,products.location,products.price,products.petroleumid,products.proimg FROM ordermanagement left join users on users.id=ordermanagement.userid left join useraddresses on useraddresses.id=ordermanagement.deliveryaddressid left join vendors on vendors.id=ordermanagement.vendorid left join products on products.id=ordermanagement.productid where ordermanagement.status=1 AND ordermanagement.userid='$userid'");
}elseif($status==2){

  $sql=pg_query($db,"SELECT ordermanagement.id,ordermanagement.userid,ordermanagement.deliveryaddressid,ordermanagement.vendorid,ordermanagement.productid,ordermanagement.quantity,ordermanagement.status,ordermanagement.createdby,ordermanagement.createdat,ordermanagement.updatedby,ordermanagement.updatedat,ordermanagement.refiltype,ordermanagement.deldate,ordermanagement.cylinderimg,users.firstname,useraddresses.addressline1,useraddresses.pincode,useraddresses.latitude,useraddresses.longitude,vendors.businessname,products.cylindertypeid,products.cylinderweightid,products.location,products.price,products.petroleumid,products.proimg FROM ordermanagement left join users on users.id=ordermanagement.userid left join useraddresses on useraddresses.id=ordermanagement.deliveryaddressid left join vendors on vendors.id=ordermanagement.vendorid left join products on products.id=ordermanagement.productid where ordermanagement.status=2 AND ordermanagement.userid='$userid'");
}else{

$sql=pg_query($db,"SELECT ordermanagement.id,ordermanagement.userid,ordermanagement.deliveryaddressid,ordermanagement.vendorid,ordermanagement.productid,ordermanagement.quantity,ordermanagement.status,ordermanagement.createdby,ordermanagement.createdat,ordermanagement.updatedby,ordermanagement.updatedat,ordermanagement.refiltype,ordermanagement.deldate,ordermanagement.cylinderimg,users.firstname,useraddresses.addressline1,useraddresses.pincode,useraddresses.latitude,useraddresses.longitude,vendors.businessname,products.cylindertypeid,products.cylinderweightid,products.location,products.price,products.petroleumid,products.proimg FROM ordermanagement left join users on users.id=ordermanagement.userid left join useraddresses on useraddresses.id=ordermanagement.deliveryaddressid left join vendors on vendors.id=ordermanagement.vendorid left join products on products.id=ordermanagement.productid where ordermanagement.status=0 AND ordermanagement.userid='$userid'");
}
$my=array();
 if($sql){
    while($sql2=pg_fetch_assoc($sql)){
 
             http_response_code(201);
                 $my[]=$sql2;
                 
             }      
                echo json_encode($my);
           }else{
          http_response_code(400);        
        echo json_encode(array("message" => "Error"));
             }
           }else{
          http_response_code(503);        
        echo json_encode(array("message" => "Error please check."));
             }
?> 