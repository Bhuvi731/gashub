<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if (!isset($_SESSION)) {
    session_start();
}
include_once '../database/db.php';
$petroleumid = $_POST['petroleumid'];
$weight = $_POST['weight'];
$price = $_POST['price'];
$status = $_POST['status'];
$createdby = "1";
$createdat = date("d-m-Y");
if (!empty($petroleumid) && !empty($weight) && !empty($price) && !empty($status)) {
    $loginid = $_POST['loginid'];
    $vendor1 = pg_query($db, "SELECT * FROM login WHERE id=$loginid");
    $sqlven = pg_fetch_array($vendor1);
    $vendorid1 = $sqlven['vendorid'];
    if (!empty($vendorid1)) {
        $sql = "SELECT id FROM cylinder WHERE weight='$weight'AND vendorid=' $vendorid1'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "cylinder_already_existed";
            }
        } else {
            $sql = "INSERT INTO cylinder(petroleumid,weight,status,createdby,createdat,vendorid,price)VALUES('$petroleumid','$weight','$status','$createdby','$createdat','$vendorid1','$price')";
            $query = pg_query($db, $sql);
            if ($query) {

                echo "success";
            } else {
                echo "Error";
            }
        }
    } else {
        $vendorid = $_POST['vendorid'];
        $sql = "SELECT id FROM cylinder WHERE weight='$weight'AND petroleumid='$petroleumid'AND vendorid='$vendorid'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "cylinder_already_existed";
            }
        } else {
            $sql = "INSERT INTO cylinder(petroleumid,weight,status,createdby,createdat,vendorid,price)VALUES('$petroleumid','$weight','$status','$createdby','$createdat','$vendorid','$price')";
            $query = pg_query($db, $sql);
            if ($query) {

                echo "success";
            } else {
                echo "Error";
            }
        }
    }
} else {
    echo "Error please check.";

}
