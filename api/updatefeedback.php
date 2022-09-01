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
    $firstname = $_GET['firstname'];
    $vendorName = $_GET['businessname'];
    $brandname = $_GET['petroleum_name'];
    $rating = $_GET['rating'];
    $title = $_GET['title'];
    $review = $_GET['review'];
    $status = "1";
    $vendorid = $_GET['vendorid'];
    $createdby = "1";
    if (
        !empty($id)  && !empty($rating) && !empty($review) &&
        !empty($status)
    ) {
        $sql = "UPDATE feedbacks SET rating='$rating',review='$review',status='$status' WHERE id='$id'AND vendorid='$vendorid'";
        $query = pg_query($db, $sql);
        $query = pg_query($db, $sql);
        if ($query) {

            echo "success";
        } else {
            echo "Error ";
        }
    } else {
        echo "Error Please Check";
    }
}
