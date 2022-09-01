<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';

if(isset($_POST['id']))
{
$user_id=$_POST['id'];
$addressline1=$_POST['addressline1'];
$pincode=$_POST['pincode'];
$status="1";
$createdby="1";
$createdat=date("d-m-y");
if(!empty($user_id) &&!empty($status) &&!empty($addressline1) &&!empty($pincode)){

     $sql="SELECT id FROM useraddresses WHERE addressline1='$addressline1'AND userid='$user_id'";
    $res = pg_query($db, $sql);
    if(pg_num_rows($res)>0){
      if($sql3=pg_fetch_array($res)){

                                echo"address_already_existed";
                                          }
      }else{
        $sql2=pg_query($db,"INSERT INTO useraddresses(userid,addressline1,pincode,status,createdby,createdat)VALUES('$user_id','$addressline1','$pincode','$status','$createdby','$createdat')");
               if($sql2){

                 echo "success";

               }else{

                 echo "error";

               }
}}}else{
             
         echo "error Please Check.";
                } 
  
?>