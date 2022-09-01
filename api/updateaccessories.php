<?php
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
    $vendorid = $_GET['vendorid'];
    $accessoriesname = $_GET['accessoriesname'];
    $price = $_GET['price'];
    $status = "1";
    $updatedby = "1";
    $updatedat = date("d-m-y");
    if (isset($id) && isset($petroleumid) && isset($vendorid) && isset($status)) {
        $sql = "UPDATE accessories SET accessoriesname='$accessoriesname',petroleumid='$petroleumid',vendorid='$vendorid',status='$status',price='$price',updatedby='$updatedby',updatedat='$updatedat' WHERE id='$id'";
        $query = pg_query($db, $sql);
        if ($query) {


            echo  "success";
        } else {

            echo "Error";
        }
    }
} else {

    echo "Error Please Check";
}
