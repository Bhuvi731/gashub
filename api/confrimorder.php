<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';


if(isset($_POST['confrimid']))
 { 
    $id = $_POST['confrimid'];

    $sql=pg_query($db,"UPDATE ordermanagement SET status='2' WHERE id='$id'");
    if($sql)
    {
        $sql2=pg_query($db,"SELECT id from ordermanagement where id='$id'");

          if($sql3=pg_fetch_array($sql2)){

                                 http_response_code(201);        
                                echo json_encode($sql3);
    }else
    {
        http_response_code(503);        
        echo json_encode(array("message" => "Error"));
    }
 }}else{
        echo json_encode(array("message" => "error"));
     }
?>