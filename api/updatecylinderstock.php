<?php
// error_reporting(0);
// header("Access-Control-Allow-Origin: *");
// header('Content-Type: text/plain');
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods:GET");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $petroleumid = $_GET['petroleumid'];
    // $vendorid = $_GET['vendorid'];
    $weight = $_GET['weight'];
    $price = $_GET['price'];
    $quantity = $_GET['quantity'];
    $status = $_GET['status'];
    $updatedby = "1";
    $updatedat = date("d-m-Y");
    if (isset($id) && isset($petroleumid)   && isset($weight) && isset($price) && isset($status)) {
        $sql = "UPDATE cylinderstock SET petroleumid='$petroleumid',weight='$weight', price='$price',quantity='$quantity',status='$status',updatedby='$updatedby',updatedat='$updatedat' WHERE id='$id'";
        $query = pg_query($db, $sql);
        if ($query) {

            echo "success";
        } else {
            echo "Error ";
        }
    } else {
        echo "Error Please Check";
    }
}
