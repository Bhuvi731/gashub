<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}
$sql=pg_query($db,"SELECT * from feedbacks LEFT JOIN petroleum ON feedbacks.petroleum_id=petroleum.petroleum_name where feedbacks.status=1");

//  $sql=pg_query($db,"SELECT * from feedbacks where feedbacks.status=1");
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