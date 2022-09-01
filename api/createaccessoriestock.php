<?php
// header("Access-Control-Allow-Origin: *");
// header('Content-Type: text/plain');
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if (!isset($_SESSION)) {
    session_start();
}
include_once '../database/db.php';
$petroleumid = $_POST['petroleumid'];
$accessoriesname = $_POST['accessoriesname'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$loginid = $_POST['loginid'];
$status = "1";
$createdby = "1";
$createdat = date("d-m-y");
if (!empty($accessoriesname)  && !empty($price) && !empty($status)) {
    $vendor1 = pg_query($db, "SELECT * FROM login WHERE id=$loginid");
    $sqlven = pg_fetch_array($vendor1);
    $vendorid1 = $sqlven['vendorid'];
    if (!empty($vendorid1)) {
        $sql = "SELECT * FROM accessoriesstock WHERE accessoriesname='$accessoriesname' AND petroleumid='$petroleumid' AND vendorid='$vendorid1'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "accessories_already_existed";
            }
        } else {
            $sql = "INSERT INTO accessoriesstock(petroleumid,accessoriesname,status,createdby,createdat,vendorid,price,quantity)VALUES('$petroleumid','$accessoriesname','$status','$createdby','$createdat','$vendorid1','$price','$quantity')";
            $query = pg_query($db, $sql);
            if ($query) {

                echo "success";
            } else {
                echo "error1";
            }
        }
    } else {
        $vendorid = $_POST['vendorid'];
        $sql = "SELECT * FROM accessoriesstock WHERE accessoriesname='$accessoriesname' AND petroleumid='$petroleumid' AND vendorid='$vendorid'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "accessories_already_existed";
            }
        } else {
            $sql = "INSERT INTO accessoriesstock(petroleumid,accessoriesname,status,createdby,createdat,vendorid,price,quantity)VALUES('$petroleumid','$accessoriesname','$status','$createdby','$createdat','$vendorid','$price','$quantity')";
            $query = pg_query($db, $sql);
            if ($query) {

                echo "success";
            } else {
                echo "error1";
            }
        }
    }
} else {
    echo "Error Please Check.";
}
