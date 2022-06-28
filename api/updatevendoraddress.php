<?php
// header("Access-Control-Allow-Origin: *");
// header('Content-Type: text/plain');
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods:GET");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if(isset($_GET['id']))
{
$id = $_GET['id'];
$vendorid = $_GET['vendorid'];
$addressline1 = $_GET['addressline1'];
$pincode = $_GET['pincode'];
$status = $_GET['status']; 
$updatedby = "1";
$updatedat = date("d-m-y");                                                                                                                                                                                 
 if(isset($id) && isset($vendorid) && isset($addressline1) && isset($pincode) && isset($status)){
  $sql = "UPDATE vendoraddresses SET vendorid='$vendorid',addressline1='$addressline1',pincode='$pincode', status='$status',updatedby='$updatedby',updatedat='$updatedat' WHERE id='$id'";
  $query=pg_query($db,$sql);
    if($query)
    {
      
        echo "success";
    }else
    {
       echo "Error ";
    }
}

else
{
  echo "Error Please Check";
 }
}

?>