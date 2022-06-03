<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
// Get image data from database 
$result =pg_query($db,"SELECT  * FROM banner_images ORDER BY id DESC LIMIT 3"); 
$my=array();
 if(pg_num_rows($result) > 0){
         while($row =pg_fetch_assoc($result)){
         	http_response_code(201);
             $my[]=$row;

         }
            echo json_encode($my);
 }else{ 
     
     http_response_code(503);        
        echo json_encode(array("message" => "Error"));
       } 
 ?>