<?php
// header("Access-Control-Allow-Origin: *");
// header('Content-Type: text/plain');
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods:POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if (!empty($_POST['id'])) {
   $id = $_POST['id'];
   $addressline1 = $_POST['addressline1'];
   $pincode = $_POST['pincode'];
   $status = $_POST['status'];
   $updatedby = "1";
   $updatedat = date('d-m-y');
   if (
      isset($id) && isset($addressline1)
      && isset($pincode) && isset($status)
   ) {
      $sql1 = "UPDATE useraddresses SET addressline1='$addressline1',pincode='$pincode',status='$status',updatedby='$updatedby',updatedat='$updatedat' WHERE id='$id'";
      $sql = pg_query($db, $sql1);
      if ($sql) {

         echo "success";
      } else {
         echo "Error ";
      }
   }
} else {
   echo "Error Please Check";
}
