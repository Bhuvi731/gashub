<?php
// header("Access-Control-Allow-Origin: *");
// header('Content-Type: text/plain');
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
$brandname = $_POST['brandname'];
$status = "1";
$createdby = "1";
$createdat = "1";
if (!empty($brandname) && !empty($status)) {
    $sql = "SELECT * FROM petroleum WHERE petroleum_name='$brandname'";
    $res = pg_query($db, $sql);
    if (pg_num_rows($res) > 0) {
        if ($sql3 = pg_fetch_array($res)) {

            echo "brandname_already_existed";
        }
    } else {

        $sql = "INSERT INTO petroleum(petroleum_name,status,createdby,createdat)VALUES('$brandname','$status','$createdby','$createdat')RETURNING id";
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
    http_response_code(400);
    echo "Error Please Check.";
}
