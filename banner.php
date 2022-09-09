<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="assets/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">


    <style>
        #dashboard {
            display: none;
        }

        table {
            width: 100%;
            overflow-x: scroll;
            white-space: nowrap;

        }

        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

        img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
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
</head>

<body>
    <?php
    include_once 'database/db.php';

    if (isset($_POST['submit'])) {
         $fileName = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];
        $UploadDir = 'uploads/banners/';
        $filePath = $UploadDir . $fileName;
        $result = move_uploaded_file($tmpName, $filePath);
        $status = "1";
        if ($result) {
            $sql = "INSERT INTO banner_images(images,status) VALUES('" . $fileName . ",$status')";
            $query = pg_query($db, $sql);
            if ($sql) {
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
    <section class="content" id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Banner</h3>
                        </div>

                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                                </thead>
                                <tbody>
                                    <center>
                                        <div id="content">

                                            <form method="POST" action="" name="imgfrm" enctype="multipart/form-data">
                                                <input type="file" name="file" value="" />
                                                <div>
                                                    <button type="submit" name="submit" onClick="return onSubmitForm()">UPLOAD</button>
                                                </div>
                                            </form>
                                        </div>
                                    </center>
                                </tbody>

                            </table>
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
                            <h3 class="card-title">Brands Details </h3>
                        </div>

                        <div class="card-body ">
                            <section>
                                <div style="margin:auto;">
                                    <label style="color: #0054A8;" for="">SEARCH :</label>
                                    <input id="myInput" type="text" placeholder="Search..">
                                </div>
                            </section>
                            <table id="example2" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th>SI.No</th>
                                        <th>images</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    $sqlimage  = "SELECT * FROM banner_images where status='1'";
                                    $imageresult1 = pg_query($db, $sqlimage);
                                    $i = 1;
                                    while ($rows = pg_fetch_assoc($imageresult1)) {
                                        $image = $rows['images'];
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo '<a href="uploads/banners/' . $image . '"><img src="uploads/banners/' . $image . '"/></a>'; ?></td>
                                            <td>
                                                <a style="cursor:pointer" data-toggle="modal" data-target="#deletemodal-sm<?php echo $rows['id']; ?>"><i class="nav-icon fas fa-trash"></i></a>
                                            </td>
                                            <!-- Delete Start -->
                                            <div class="modal fade" id="deletemodal-sm<?php echo $rows['id']; ?>">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete Brands</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-primary" onclick="deleterecord(<?php echo $rows['id']; ?>)">Yes</button>
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

    </section>

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        $(function() {

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                //"responsive": true,
                "scroolX": true,
            });
        });
    </script>
    <script>
        function deleterecord(id) {

            var deleteimgid = id;
            $.ajax({
                type: "POST",
                url: "api/deleteimages.php",
                data: {

                    "deleteimgid": deleteimgid,

                },
                success: function(msg) {
                    console.log(msg);
                    var message = msg['message'];

                    if (message == "Successfull") {

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
            });

        }
    </script>
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


    <script type="text/javascript">
        var err = '<?php echo $err; ?>';
        if (err.length > 0)
            alert(err);
    </script>
</body>

</html>