<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if (isset($_POST['confirmid'])) {
    $id = $_POST['confirmid'];
    $sql = pg_query($db, "SELECT * from ordermanagement where id='$id'");
    if ($sql1 = pg_fetch_array($sql)) {
        $orderid = $sql1['id'];
        $vendorid = $sql1['vendorid'];
        $accessoriesid = $sql1['accessoriesid'];
        $cylinderid = $sql1['cylinderid'];
        $quantity = $sql1['quantity'];
        if (!empty($vendorid)) {
            if (!empty($cylinderid)) {
                $sql3 = pg_query($db, "SELECT * from cylinderstock where id='$cylinderid' AND vendorid='$vendorid' AND quantity>=$quantity");
                $sql4 = pg_num_rows($sql3);

                if ($sql4 > 0) {
                    $sql5 = pg_fetch_array($sql3);
                    $cid = $sql5['id'];
                    $orgquantity = $sql5['quantity'];
                    $quantity = $sql1['quantity'];
                    $minusquantity = $orgquantity - $quantity;
                    $changequantity = pg_query($db, "update cylinderstock set quantity='$minusquantity' where id='$cid'");
                    $changequantityrow = pg_num_rows($changequantity);
                    if ($changequantityrow = 1) {
                        $orderid = $sql1['id'];
                        $sql6 = pg_query($db, "UPDATE ordermanagement SET status='2' WHERE id='$orderid'");
                        $orderrow = pg_num_rows($sql6);
                        if ($orderrow = 1) {
                            $sql7 = pg_query($db, "SELECT id,userid from ordermanagement where id='$id'");

                            if ($sql8 = pg_fetch_array($sql7)) {

                                $orderid1 = $sql8[0];
                                $userid = $sql8[1];
                                $orderstatus = "order confirmed.";
                                $status = '1';
                                $createdby = '1';
                                $createdat = date('y-m-d');
                                if (isset($orderid) && isset($userid)) {

                                    $odrstatus = pg_query($db, "INSERT INTO orderstatus(userid,orderid,orderstatus,status,createdby,createdat)VALUES('$userid','$orderid','$orderstatus','$status','$createdby','$createdat')RETURNING id");
                                    if ($odrstatus) {

                                        $insert_row = pg_fetch_row($odrstatus);
                                        $insert_id = $insert_row[0];

                                        $sql9 = pg_query($db, "SELECT * from orderstatus where id='$insert_id'");

                                        if ($sql10 = pg_fetch_array($sql9)) {

                                            http_response_code(201);
                                            echo json_encode($sql10);
                                        }
                                    }
                                } else {

                                    http_response_code(400);
                                    echo json_encode(array("message" => "error"));
                                }
                            }
                        }
                    }
                } else {
                    echo "stockerror";
                }
            } else {
                $sql3 = pg_query($db, "SELECT * from accessoriesstock where id='$accessoriesid' AND vendorid='$vendorid' AND quantity>=$quantity");
                $sql4 = pg_num_rows($sql3);
                if ($sql4 > 0) {
                    $sql5 = pg_fetch_array($sql3);
                    $cid = $sql5['id'];
                    $orgquantity = $sql5['quantity'];
                    $quantity = $sql1['quantity'];
                    $minusquantity = $orgquantity - $quantity;
                    $changequantity = pg_query($db, "update accessoriesstock set quantity='$minusquantity' where id='$cid'");
                    $changequantityrow = pg_num_rows($changequantity);
                    if ($changequantityrow = 1) {
                        $orderid = $sql1['id'];
                        $sql6 = pg_query($db, "UPDATE ordermanagement SET status='2' WHERE id='$orderid'");
                        $orderrow = pg_num_rows($sql6);
                        if ($orderrow = 1) {
                            $sql7 = pg_query($db, "SELECT id,userid from ordermanagement where id='$id'");

                            if ($sql8 = pg_fetch_array($sql7)) {

                                $orderid1 = $sql8[0];
                                $userid = $sql8[1];
                                $orderstatus = "order confirmed.";
                                $status = '1';
                                $createdby = '1';
                                $createdat = date('y-m-d');
                                if (isset($orderid) && isset($userid)) {

                                    $odrstatus = pg_query($db, "INSERT INTO orderstatus(userid,orderid,orderstatus,status,createdby,createdat)VALUES('$userid','$orderid','$orderstatus','$status','$createdby','$createdat')RETURNING id");
                                    if ($odrstatus) {

                                        $insert_row = pg_fetch_row($odrstatus);
                                        $insert_id = $insert_row[0];

                                        $sql9 = pg_query($db, "SELECT * from orderstatus where id='$insert_id'");

                                        if ($sql10 = pg_fetch_array($sql9)) {

                                            http_response_code(201);
                                            echo json_encode($sql10);
                                        }
                                    }
                                } else {

                                    http_response_code(400);
                                    echo json_encode(array("message" => "error"));
                                }
                            }
                        }
                    }
                } else {
                    echo "stockerror";
                }
            }
        }
    }
}
