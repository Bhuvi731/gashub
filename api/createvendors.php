<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
$businessname=$_POST['businessname'];
$status="1";
$createdby="1";
$createdat="1";
if(!empty($businessname) && !empty($status))
{
        $sql="INSERT INTO vendors(businessname,status,createdby,createdat)VALUES('$businessname','$status','$createdby','$createdat')";
        $query=pg_query($db,$sql);
        if($query)
        {         
            echo "success";
        }else
        {        
            echo "error";
        }
      }
     
     else{    
        echo "error please check";
       }
      ?>
      