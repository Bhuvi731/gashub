<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';


if(isset($_POST['userid']))
 { 
    $id = $_POST['userid'];

    $sql=pg_query($db,"SELECT * from orderstatus where userid='$id'");
    $my=array();
 if($sql){
   //var_dump($sql); 
    while($sql2=pg_fetch_assoc($sql)){
 
             http_response_code(201);
                 $my[]=$sql2;
                 
             }      
                echo json_encode($my);
                                       
                                     }else{
                                      http_response_code(400);        
                                      echo json_encode(array("message" => "error"));

                                          }

                                    }else{

                                       http_response_code(503);        
                                       echo json_encode(array("message" => "Error"));

                                            }
?>