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

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
      </div>
      <div class="col-4">
        <div class="card-footer clearfix" style="background-color:rgb(244 246 249) !important">
          <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Add Cylinders</button>
        </div>
      </div>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Cylinder</h4>
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
                          <label for="exampleSelectBorder">Brand name</label>
                          <select class="custom-select" id="petroleum_name" name="petroleum_name">
                            <option>Select Your Brand Name</option>
                            <?php
                            $vendor1 = pg_query($db, "SELECT * FROM petroleum WHERE status=1");
                            while ($row1 = pg_fetch_assoc($vendor1)) {
                            ?>
                              <option value="<?php echo $row1['id']; ?>"><?php echo $row1['petroleum_name'] ?></option>
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
                          <label for="exampleSelectBorder">vendor name</label>
                          <select class="custom-select" id="businessname" name="businessname">
                            <option>Select Your vendor Name</option>
                            <?php
                            $vendor1 = pg_query($db, "SELECT * FROM vendors WHERE status=1");
                            while ($row1 = pg_fetch_assoc($vendor1)) {
                            ?>
                              <option value="<?php echo $row1['id']; ?>"><?php echo $row1['businessname'] ?></option>
                            <?php
                            }
                            ?>
                          </select>

                        </div>
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="exampleSelectBorder">Weight</label>
                          <input type="text" class="form-control" id="weight" placeholder="Enter weight" name="weight">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
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
            <h3 class="card-title">Cylinder Details</h3>
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
                  <th>status</th>
                  <th>createdby</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="myTable">
                <?php
                $vendor = pg_query($db, "SELECT  cylinder.petroleumid,cylinder.vendorid,cylinder.weight,petroleum.petroleum_name,cylinder.createdby,cylinder.status,petroleum.id ,cylinder.id,vendors.businessname from cylinder LEFT JOIN petroleum ON petroleum.id=cylinder.petroleumid  LEFT JOIN  vendors ON vendors.id=cylinder.id WHERE cylinder.status=1");
                // SELECT cylindertype.id,cylindertype.type,cylinderweight.weight,cylinderweight.id,cylindertype.status,cylindertype.createdby FROM cylinderweight LEFT JOIN cylindertype ON cylindertype.id = cylinderweight.id =cylindertype.id WHERE cylindertype.status=1");
                $i = 1;
                while ($row = pg_fetch_assoc($vendor)) {
                ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['petroleum_name'] ?></td>
                    <td><?php echo $row['businessname'] ?></td>
                    <td><?php echo $row['weight'] ?></td>
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
                                  <label for="exampleInputEmail1">Weight</label>
                                  <input type="text" class="form-control" id="weight<?php echo $row['id']; ?>" placeholder="Enter weight" name="weight" value="<?php echo $row['weight']; ?>">
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
                              <div class="container-fluid">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Weight</label>
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
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <!-- 5 -->
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
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  function save() {
    var petroleumid = $("#petroleum_name").val();
    var vendorid = $("#businessname").val();
    var weight = $("#weight").val();
    var status = $("#status").val();
    if (petroleumid == "") {
      alert("petroleumid must be filled out");
      return false;
    }
    if (weight == "") {
      alert("weight must be filled out");
      return false;
    } else if (status == "") {
      alert("Status must be filled out");
      return false;
    } else if (petroleumid !== "" && weight !== "" && status !== "") {
      $.ajax({
        url: "api/createcylinder.php",
        method: "POST",
        dataType: "text",
        data: {
          "vendorid": vendorid,
          "petroleumid": petroleumid,
          "weight": weight,
          "status": status,
        },
        success: function(msg) {
          console.log(msg);
          var message = msg;
          if (message == "success") {
            success();
          } else if (message == "weight_already_existed") {
            email_existed();
          } else {
            error();
          }
        }
      })
    }
  }
  // function RefreshTable() {

  //   $("#content").load("index.php?pageid=1 #content");
  // }

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

    //   location.reload(true);
    // }, 1000);

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
      title: 'cylinder Added Successfully.'
    })
    setTimeout(function() {

      location.reload(true);
    }, 1000);

  }

  function email_existed() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
      icon: 'info',
      title: 'weight already existed.',
    })
    setTimeout(function() {
      //alert('Reloading Page');
      location.reload(true);
    }, 1000);
    //window.location.reload();
  }


  function editsave(id) {
    var id = id;
    var petroleumid = $("#petroleum_name" + id).val();
    var weight = $("#weight" + id).val();
    var status = $("#status" + id).val();
    if (petroleumid == "") {
      alert("petroleumid must be filled out");
      return false;
    }
    if (weight == "") {
      alert("weight must be filled out");
      return false;
    }
    if (status == "") {
      alert("status must be filled out");
      return false;
    } else if (petroleumid !== "" && weight !== "" && status !== "") {
      $.ajax({
        type: "GET",
        url: "api/updatecylinder.php",
        dataType: "text",
        data: {
          "id": id,
          "petroleumid": petroleumid,
          "weight": weight,
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
      title: 'cylinder Edit Successfully.'
    })
    setTimeout(function() {

      location.reload(true);
    }, 1000);

  }


  function deleterecord(id) {

    var deleteid = id;
    $.ajax({
      type: "POST",
      url: "api/deletecylinder.php",
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