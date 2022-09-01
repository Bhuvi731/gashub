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
$loginid = $_POST['loginid'];
$price = $_POST['price'];
$weight = $_POST['weight'];
$quantity = $_POST['quantity'];
$status = "1";
$createdby = "1";
$createdat = date("d-m-y");
if (!empty($price) && !empty($status)) {
    $vendor1 = pg_query($db, "SELECT * FROM login WHERE id=$loginid");
    $sqlven = pg_fetch_array($vendor1);
    $vendorid1 = $sqlven['vendorid'];
    if (!empty($vendorid1)) {
        $sql = "SELECT * FROM cylinderstock WHERE weight='$weight' AND vendorid=' $vendorid1'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "cylinder_already_existed";
            }
        } else {
            $sql = "INSERT INTO cylinderstock(petroleumid,status,createdby,createdat,price,quantity,vendorid,weight)VALUES('$petroleumid','$status','$createdby','$createdat','$price','$quantity','$vendorid1','$weight')";
            $query = pg_query($db, $sql);
            if ($query) {

                echo "success";
            } else {
                echo "error";
            }
        }
    } else {
        $vendorid = $_POST['vendorid'];
        $sql = "SELECT * FROM cylinderstock WHERE weight='$weight' AND vendorid=' $vendorid'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "cylinder_already_existed";
            }
        } else {
            $sql = "INSERT INTO cylinderstock(petroleumid,status,createdby,createdat,price,quantity,vendorid,weight)VALUES('$petroleumid','$status','$createdby','$createdat','$price','$quantity','$vendorid','$weight')";
            $query = pg_query($db, $sql);
            if ($query) {
                echo "success";
            } else {
                echo "error";
            }
        }
    }
} else {
    echo "Error Please Check.";
}
