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
    if($sql){
      echo $id;
        $sql2=pg_query($db,"SELECT id,userid from ordermanagement where id='$id'");

          if($sql3=pg_fetch_array($sql2)){

                                 $orderid=$sql3[0];
                                 $userid=$sql3[1];
                                 $orderstatus="order confrimed.";
                                 $status='1';
                                 $createdby='1';
                                 $createdat=date('y-m-d');
                                 if(isset($orderid) && isset($userid)){

                                    $odrstatus=pg_query($db,"INSERT INTO orderstatus(userid,orderid,orderstatus,status,createdby,createdat)VALUES('$userid','$orderid','$orderstatus','$status','$createdby','$createdat')RETURNING id");
                                         if($odrstatus){

                                             $insert_row = pg_fetch_row($odrstatus);
                                              $insert_id = $insert_row[0];

                                                      $sql4=pg_query($db,"SELECT * from orderstatus where id='$insert_id'");
                                                      
                                                      if($sql5=pg_fetch_array($sql4)){

                                                        http_response_code(201);        
                                                         echo json_encode($sql5);
                                                           }}}else{

                                                                 http_response_code(400);        
                                                                 echo json_encode(array("message" => "error"));

                                                                   }

                                    }}}else{

                                       http_response_code(503);        
                                       echo json_encode(array("message" => "Error"));

                                             }
?>