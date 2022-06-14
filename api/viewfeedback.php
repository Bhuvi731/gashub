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
}
$sql=pg_query($db,"SELECT feedbacks.id,feedbacks.orderid,feedbacks.userid,feedbacks.vendorid,feedbacks.vendorbranch,feedbacks.review,feedbacks.rating,feedbacks.createdat,feedbacks.petroleum_id,petroleum.petroleum_name,vendors.businessname from feedbacks LEFT JOIN petroleum ON feedbacks.petroleum_id=petroleum.id LEFT JOIN vendors ON vendors.id=feedbacks.vendorid where feedbacks.status=1 and feedbacks.userid= $id");
// SELECT review.feedbacks,rating.feedbacks,createdat.feedbacks from feedbacks LEFT JOIN petroleum ON feedbacks.petroleum_id=petroleum.id where feedbacks.status=1
$my=array();
 if($sql){ 
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