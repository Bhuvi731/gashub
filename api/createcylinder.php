<?php
include_once '../database/db.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if (isset($_POST['petroleumid'])) {
    $petroleumid = $_POST['petroleumid'];
    $weight = $_POST['weight'];
    $status = "1";
    $createdby = "1";
    $createdat = "1";
    if (!empty($petroleumid) && !empty($weight) && !empty($status)) {
        $sql = "SELECT id FROM cylinder WHERE weight='$weight'AND petroleumid='$petroleumid'";
        $res = pg_query($db, $sql);
        if (pg_num_rows($res) > 0) {
            if ($sql3 = pg_fetch_array($res)) {

                echo "weight_already_existed";
            }
        } else {
            $sql = "INSERT INTO cylinder(petroleumid,weight,status,createdby,createdat)VALUES('$petroleumid','$weight','$status','$createdby','$createdat')";
            $query = pg_query($db, $sql);
            if ($query) {
                if ($sql) {

                    echo "success";
                } else {
                    echo "error";
                }
            } else {
                echo "error";
            }
        }
    } else {
        echo "Error Please Check.";
    }
}
