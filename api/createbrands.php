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
$brandname = $_POST['brandname'];
$loginid = $_POST['loginid'];
$status = "1";
$createdby = "1";
$createdat=date("d-m-y");
if (!empty($brandname) && !empty($status)) {
    $vendor1 = pg_query($db, "SELECT * FROM login WHERE id=$loginid");
    $sqlven = pg_fetch_array($vendor1);
    $vendorid1 = $sqlven['vendorid'];
    if (!empty($vendorid1)) {
        $sql = "SELECT * FROM petroleum WHERE petroleum_name='$brandname' AND vendorid=' $vendorid1'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "brandname_already_existed";
            }
        } else {
            $sql = "INSERT INTO petroleum(petroleum_name,status,createdby,createdat,vendorid)VALUES('$brandname','$status','$createdby','$createdat','$vendorid1')";
            $query = pg_query($db, $sql);
            if ($query) {
                http_response_code(201);
                echo "Success";
            } else {
                http_response_code(503);
                echo "Error";
            }
        }
    } else {
        $vendorid = $_POST['vendorid'];

        $sql = "SELECT * FROM petroleum WHERE petroleum_name='$brandname' AND vendorid=' $vendorid'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "brandname_already_existed";
            }
        } else {
            $sql = "INSERT INTO petroleum(petroleum_name,status,createdby,createdat,vendorid)VALUES('$brandname','$status','$createdby','$createdat','$vendorid')";
            $query = pg_query($db, $sql);
            if ($query) {
                http_response_code(201);
                echo "Success";
            } else {
                http_response_code(503);
                echo "Error";
            }
        }
    }
} else {
    http_response_code(400);
    echo "Error Please Check.";
}
