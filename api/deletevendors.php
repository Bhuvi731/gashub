<?php
include_once '../database/db.php';
if (isset($_POST['deleteid'])) {
    $id = $_POST['deleteid'];
    $sql = pg_query($db, "UPDATE vendors SET status='-1' WHERE id=$id");

    if ($sql) {

        echo "success";
    } else {

        echo "error";
    }
} else {
    echo "Error please check";
}
