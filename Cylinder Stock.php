<?php
session_start();
$session_value = '';
if (isset($_SESSION['id'])) {
    $session_value .= $_SESSION['id'];
}
// echo  $session_value;
?>
<link rel="stylesheet" href="assets/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="assets/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<style>
    #dashboard {
        display: none;
    }
</style>
<script>
    function onSubmitForm() {
        var formDOMObj = document.imgfrm;
        if (formDOMObj.file.value == "")
            alert("Please press the browse button and pick a file.")
        else
            return true;
        return false;
    }
</script>

<body>
    <?php
    include_once 'database/db.php';
    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $fileName = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];
        $cylinderimg = $_GET['cylinderimg'];
        $UploadDir = 'uploads/cylinderimage/';
        $filePath = $UploadDir . $fileName;
        $status = '1';
        $result = move_uploaded_file($tmpName, $filePath);
        if ($result) {
            //$sql = "INSERT INTO cylinderstock(cylinderimg,status) VALUES('$fileName','$status')";//
            $sql = "UPDATE cylinderstock SET cylinderimg='$cylinderimg' WHERE id='$id'";
            // UPDATE cylinderstock SET petroleumid='$petroleumid',weight='$weight', price='$price',quantity='$quantity',status='$status',updatedby='$updatedby',updatedat='$updatedat' WHERE id='$id'";//
            $query = pg_query($db, $sql);
            if ($query) {
                $err = "Uploaded Successfully";
            } else {
                $err = "error";
            }
        } else {
            $err = "Error";
        }
    }
    ?>
    <br>
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                </div>
                <div class="col-4">
                    <div class="card-footer clearfix" style="background-color:rgb(244 246 249) !important">
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Add cylinderstock</button>
                    </div>
                </div>

                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add cylinder Stock</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="container-fluid">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Brands</label>
                                                        <select class="form-control" id="products" name="products">
                                                            <option>Select Your Brands</option>
                                                            <?php
                                                            $vendor0 = pg_query($db, "SELECT * FROM petroleum WHERE status=1");
                                                            while ($row0 = pg_fetch_assoc($vendor0)) {
                                                            ?>

                                                                <option value="<?php echo $row0['id']; ?>"><?php echo $row0['petroleum_name'] ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Vendor</label>
                                                        <select class="form-control" id="vendorname" name="vendorname">
                                                            <option value="">Select vendor Name</option>
                                                            <?php
                                                            $vendor0 = pg_query($db, "SELECT * FROM vendors WHERE status=1");
                                                            while ($row0 = pg_fetch_assoc($vendor0)) {
                                                            ?>

                                                                <option value="<?php echo $row0['id']; ?>"><?php echo $row0['businessname'] ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Weight</label>
                                                        <select class="form-control" id="weight" name="weight">
                                                            <option value="">Select Vendor Name first</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Price</label>
                                                        <input type="text" class="form-control" id="price" placeholder="Enter Price" name="price">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Available Stock</label>
                                                        <input type="text" class="form-control" id="quantity" placeholder="Enter Available stock" name="quantity">
                                                    </div>
                                                </div>
                                                <input type="hidden" id="loginid" name="loginid" value=<?php echo  $session_value; ?>>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="exampleSelectBorder">Status</label>
                                                        <select class="custom-select" id="status" name="status">
                                                            <option>Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">InActive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" name="submit" onclick="save()">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <section class="content" id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cylinder Stock Details</h3>
                        </div>

                        <div class="card-body">
                            <section>
                                <div style="margin:auto;">
                                    <label style="color: #0054A8;" for="">SEARCH :</label>
                                    <input id="myInput" type="text" placeholder="Search..">
                                </div>
                            </section>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SI.No</th>
                                        <th>Brand Name</th>
                                        <th>Vendor Name</th>
                                        <th>Weight</th>
                                        <th>Price</th>
                                        <th>Availablestock</th>
                                        <th>Cylinder Image</th>
                                        <!-- <th>Images</th> -->
                                        <th>status</th>
                                        <th>createdby</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    $vendor = pg_query($db, "SELECT cylinderstock.id,petroleum.petroleum_name,cylinderstock.petroleumid,cylinderstock.vendorid,vendors.businessname,cylinderstock.weight,cylinderstock.price,cylinderstock.quantity,cylinderstock.status,cylinderstock.createdby,cylinderimg FROM cylinderstock left join petroleum on petroleum.id=cylinderstock.petroleumid left join vendors on vendors.id=cylinderstock.vendorid  WHERE cylinderstock.status=1");
                                    $i = 1;
                                    while ($row = pg_fetch_assoc($vendor)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row['petroleum_name'] ?></td>
                                            <td><?php echo $row['businessname'] ?></td>
                                            <td><?php echo $row['weight'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td><?php echo $row['quantity'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['cylinderimg'] == "") {
                                                ?>

                                                    <div id="content">
                                                        <form method="POST" action="" name="imgfrm" enctype="multipart/form-data">
                                                            <input type="file" name="file" value="" />
                                                            <div>
                                                                <button type="submit" name="submit" onClick="return onSubmitForm()">UPLOAD</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <?php echo $row['cylinderimg'] ?>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <!-- <td><?php echo '<a href="uploads/cylinderimage/' . $image . '"><img src="uploads/cylinderimage/' . $image . '"/></a>'; ?></td> -->
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo "Active";
                                                } else {
                                                    echo "InActive";
                                                }
                                                ?></td>
                                            <td><?php
                                                if ($row['createdby'] == 1) {
                                                    echo "Admin";
                                                } ?></td>

                                            <td><a style="margin-right: 10px;cursor:pointer" data-toggle="modal" data-target="#viewmodal-default<?php echo $row['id']; ?>"><i class="nav-icon fas fa-eye"></i></a>
                                                <a style="margin-right: 10px;cursor:pointer" data-toggle="modal" data-target="#editmodal-default<?php echo $row['id']; ?>"><i class="nav-icon fas fa-edit"></i></a>
                                                <a style="cursor:pointer" data-toggle="modal" data-target="#deletemodal-sm<?php echo $row['id']; ?>"><i class="nav-icon fas fa-trash"></i></a>
                                            </td>
                                            <!-- Delete Start -->
                                            <div class="modal fade" id="deletemodal-sm<?php echo $row['id']; ?>">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Cylinder</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" onclick="deleterecord(<?php echo $row['id']; ?>)">Yes</button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <!-- edit start -->
                                            <div class="modal fade" id="editmodal-default<?php echo $row['id']; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Cylinders</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="card-body">

                                                                    <div class="form-group">
                                                                        <label for="exampleSelectBorder">Brand name</label>
                                                                        <select class="custom-select" id="petroleum_name<?php echo $row['id']; ?>" name="petroleum_name">
                                                                            <!-- <option>Select Your petroleum Name</option> -->
                                                                            <?php
                                                                            $vendor1 = pg_query($db, "SELECT * FROM petroleum WHERE status=1");
                                                                            while ($row1 = pg_fetch_assoc($vendor1)) {
                                                                            ?>
                                                                                <option value="<?php echo $row1['id']; ?>" <?php if ($row1['id'] == $row['petroleumid']) echo "Selected"; ?>><?php echo $row1['petroleum_name']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleSelectBorder">Vendor Name</label>
                                                                        <select class="custom-select" id="vendorname<?php echo $row['id']; ?>" name="vendorname">
                                                                            <!-- <option>Select Your petroleum Name</option> -->
                                                                            <?php
                                                                            $vendor1 = pg_query($db, "SELECT * FROM vendors WHERE status=1");
                                                                            while ($row1 = pg_fetch_assoc($vendor1)) {
                                                                            ?>
                                                                                <option value="<?php echo $row1['id']; ?>" <?php if ($row1['id'] == $row['vendorid']) echo "Selected"; ?>><?php echo $row1['businessname']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Weight</label>
                                                                        <input type="text" class="form-control" id="weight<?php echo $row['id']; ?>" placeholder="Enter weight" name="weight" value="<?php echo $row['weight']; ?>">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Price</label>
                                                                        <input type="text" class="form-control" id="price<?php echo $row['id']; ?>" placeholder="Enter Price" name="price" value="<?php echo $row['price']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Available Stock</label>
                                                                        <input type="text" class="form-control" id="quantity<?php echo $row['id']; ?>" placeholder="Enter Stock" name="quantity" value="<?php echo $row['quantity']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleSelectBorder">Status</label>
                                                                        <select class="custom-select" id="status<?php echo $row['id']; ?>" name="status">
                                                                            <option>Status</option>
                                                                            <option value="1" <?php if ($row['status'] == "1") echo "Selected"; ?>>Active</option>
                                                                            <option value="2" <?php if ($row['status'] == "2") echo "Selected"; ?>>InActive</option>
                                                                        </select>
                                                                    </div>

                                                                </div>

                                                            </form>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" name="submit" onclick="editsave(<?php echo $row['id']; ?>)">Save changes</button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- view start -->
                                            <div class="modal fade" id="viewmodal-default<?php echo $row['id']; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Details</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <div class="row">

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Brands</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="form-group">
                                                                            <p class="text-sm"><?php echo $row['petroleum_name']; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Vendor Name</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-8">
                                                                        <div class="form-group">
                                                                            <p class="text-sm"><?php echo $row['businessname']; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">weight</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-8">
                                                                        <div class="form-group">
                                                                            <p class="text-sm"><?php echo $row['weight']; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">price</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-8">
                                                                        <div class="form-group">
                                                                            <p class="text-sm"><?php echo $row['price']; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Available Stock</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-8">
                                                                        <div class="form-group">
                                                                            <p class="text-sm"><?php echo $row['quantity']; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Status</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="form-group">
                                                                            <p class="text-sm"><?php echo 'Active'; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </form>
                                                        </div>

                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <!-- 5 -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                        </div>
                        </tr>
                    <?php
                                        $i++;
                                    }

                    ?>



                    </table>
                    </div>
                </div>

            </div>



        </div>

        </div>

        </div>

    </section>
    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>

    <script src="plugins/toastr/toastr.min.js"></script>
    <script>
        $(function() {

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script type="text/javascript">
        function save() {
            var petroleumid = $("#products").val();
            var vendorid = $("#vendorname").val();
            var weight = $("#weight").val();
            var quantity = $("#quantity").val();
            var price = $("#price").val();
            var loginid = $("#loginid").val();
            var status = $("#status").val();

            if (petroleumid == "") {
                alert("brands must be filled out");
                return false;
            }
            if (vendorid == "") {
                alert("vendorname must be filled out");
                return false;
            } else if (weight == "") {
                alert("weight must be filled out");
                return false;
            } else if (quantity == "") {
                alert("quantity must be filled out");
                return false;
            } else if (price == "") {
                alert("price must be filled out");
                return false;
            } else if (status == "") {
                alert("status must be filled out");
                return false;
            } else if (petroleumid !== "" && vendorid !== "" && price !== "" && status !== "") {

                $.ajax({

                    url: "api/createcylinderstock.php",
                    method: "POST",
                    dataType: "text",
                    data: {
                        "petroleumid": petroleumid,
                        "vendorid": vendorid,
                        "weight": weight,
                        "quantity": quantity,
                        "price": price,
                        "loginid": loginid,
                        "status": status,
                    },
                    success: function(msg) {

                        console.log(msg);
                        var message = msg;
                        if (message == "success") {

                            success();

                        } else if (message == "cylinder_already_existed") {

                            cylinder_existed()


                        } else {
                            error();
                        }
                    }
                })

            }
        }

        function success() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            Toast.fire({
                icon: 'success',
                title: 'Cylinderstock Added Successfully.'
            })
            setTimeout(function() {

                location.reload(true);
            }, 1000);

        }

        function error() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            Toast.fire({
                icon: 'error',
                title: 'Please Check.'
            })
            // setTimeout(function() {

            //     location.reload(true);
            // }, 1000);

        }

        function cylinder_existed() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            Toast.fire({
                icon: 'info',
                title: 'cylinder already existed.'
            })
            setTimeout(function() {
                //alert('Reloading Page');
                location.reload(true);
            }, 1000);
            //window.location.reload();
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#vendorname').on('change', function() {
                var vendorname = this.value;
                $.ajax({
                    url: "get_vendoradd_drop.php",
                    type: "POST",
                    data: {
                        vendorname: vendorname
                    },
                    cache: false,
                    success: function(result) {

                        $("#weight").html(result);
                    }
                });
            });

        });
    </script>
    <script type="text/javascript">
        function editsave(id) {
            var id = id;
            var petroleumid = $("#petroleum_name" + id).val();
            var vendorid = $("#vendorname" + id).val();
            var weight = $("#weight" + id).val();
            var price = $("#price" + id).val();
            var quantity = $("#quantity" + id).val();
            var status = $("#status" + id).val();
            if (petroleumid == "") {
                alert("petroleumid must be filled out");
                return false;
            }
            if (vendorid == "") {
                alert("Vendor Name must be filled out");
                return false;
            }
            if (weight == "") {
                alert("weight must be filled out");
                return false;
            }
            if (price == "") {
                alert("price must be filled out");
                return false;
            }
            if (quantity == "") {
                alert("quantity must be filled out");
                return false;
            }
            if (status == "") {
                alert("status must be filled out");
                return false;
            } else if (petroleumid !== "" && vendorid !== "" && weight !== "" && price !== "" && status !== "") {
                $.ajax({
                    type: "GET",
                    url: "api/updatecylinderstock.php",
                    dataType: "text",
                    data: {
                        "id": id,
                        "petroleumid": petroleumid,
                        "vendorid": vendorid,
                        "weight": weight,
                        "price": price,
                        "quantity": quantity,
                        "status": status,
                    },
                    success: function(msg) {
                        console.log(msg);
                        var message = msg;
                        if (message == "success") {
                            editsuccess();
                        } else {
                            error();
                        }
                    }
                })
            }
        }

        function editsuccess() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            Toast.fire({
                icon: 'success',
                title: 'cylinderstock Edit Successfully.'
            })
            setTimeout(function() {

                location.reload(true);
            }, 1000);

        }


        function deleterecord(id) {

            var deleteid = id;
            $.ajax({
                type: "POST",
                url: "api/deletecylinderstock.php",
                data: {

                    "deleteid": deleteid,

                },
                success: function(msg) {
                    console.log(msg);
                    var message = msg['message'];
                    if (message) {

                        deletesuccess();


                    } else {
                        error();
                    }
                }
            })
        }

        function deletesuccess() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            Toast.fire({
                icon: 'success',
                title: 'Deleted Successfully.'
            })
            setTimeout(function() {

                location.reload(true);
            }, 1000);

        }
    </script>
    <script type="text/javascript">
        var err = '<?php echo $err; ?>';
        if (err.length > 0)
            alert(err);
    </script>
</body>