<?php
// header("Access-Control-Allow-Origin: *");
// header('Content-Type: text/plain');
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if (isset($_GET[' deleteid'])) {
    $id = $_GET[' deleteid'];
    $sql = pg_query($db, "UPDATE feedbacks SET status='-1' WHERE id= $id");

    if ($sql) {

        echo "success";
    } else {

        echo "Error";
    }
} else {
    echo "Error please check";
}
