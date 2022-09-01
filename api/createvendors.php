<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
$businessname = $_POST['businessname'];
$status = "1";
$addressline1 = $_POST['addressline1'];
$createdby = "1";
$createdat = date("d-m-Y");
$usertype = "Vendor";
$password = $_POST['password'];
if (!empty($businessname) && !empty($status)) {
    $sql = "SELECT id FROM vendors WHERE businessname='$businessname'";
    $res = pg_query($db, $sql);
    if (pg_num_rows($res) > 0) {
        if ($sql3 = pg_fetch_array($res)) {

            echo "vendor_already_existed";
        }
    } else {
        $sql = "INSERT INTO vendors(businessname,status,createdby,createdat,addressline1)VALUES('$businessname','$status','$createdby','$createdat','$addressline1')RETURNING *";
        $query = pg_query($db, $sql);
        $sql3 = pg_fetch_array($query);
        $vendorid = $sql3[0];

        if ($query) {
                $sql1 = "INSERT INTO login(username,password,usertype,vendorid)VALUES('$businessname','$password','$usertype','$vendorid')";
                $query2 = pg_query($db, $sql1);
                if ($query2) {
                    echo "success";
                }
            } else {

                echo "error";
            }
        }
    } else {
    echo "Error Please Check.";
}
