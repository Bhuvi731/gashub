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
$sql=pg_query($db,"SELECT complaints.id,complaints.userid,complaints.petroleumid,complaints.orderid,complaints.vendorid,complaints.vendorbranch,complaints.title,complaints.complaints,complaints.status,complaints.createdby,complaints.createdat,complaints.com_img,petroleum.petroleum_name,vendors.businessname from complaints LEFT JOIN users  ON users.id=complaints.userid LEFT JOIN petroleum ON petroleum.id=complaints.petroleumid LEFT JOIN vendors ON vendors.id=complaints.vendorid left join ordermanagement on ordermanagement.id=complaints.orderid where complaints.status=1 and complaints.userid= $id");
$my=array();
 if($sql){ 
    while($sql2=pg_fetch_assoc($sql)){
 
             http_response_code(201);
                 $my[]=$sql2;
                 
             }      
                echo json_encode($my);
          }}else{
          http_response_code(503);        
        echo json_encode(array("message" => "Error"));
             }
            
?>