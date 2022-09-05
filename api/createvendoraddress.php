<?php
include_once '../database/db.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if (isset($_POST['vendorid'])) {
    $vendorid = $_POST['vendorid'];
    $addressline1 = $_POST['addressline1'];
    $pincode = $_POST['pincode'];
    $status = "1";
    $createdby = "1";
    $createdat = date('d-m-y');
    if (
        !empty($vendorid) && !empty($addressline1) && !empty($pincode)  &&
        !empty($status)
    ) {
        $sql = "SELECT id FROM vendoraddresses WHERE vendorid='$vendorid'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "vendor_already_existed";
            }
        } else {
            $sql = pg_query($db, "INSERT INTO vendoraddresses(vendorid,addressline1,pincode,status,createdby,createdat)VALUES('$vendorid','$addressline1','$pincode','$status','$createdby','$createdat')");

            if ($query) {

                echo "Successfull";
            } else {
                echo "Error";
            }
        }
    } else {
        echo "Error please check.";
    }
}
