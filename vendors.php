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

    /* display: block; */
    width: 100%;
    overflow-x: scroll;
    white-space: nowrap;

  }
</style>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
      </div>
      <div class="col-4">
        <div class="card-footer clearfix" style="background-color:rgb(244 246 249) !important">
          <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Add Vendors</button>
        </div>
      </div>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Vendors</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form onkeyup="return validate()">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleSelectBorder">Vendor name</label>
                        <input type="text" class="form-control" id="businessname" placeholder="Enter vendorname" name="businessname" onchange="validate()">
                        <div id="div1"></div> <br>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleSelectBorder">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                        <div id="div1"></div> <br>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleSelectBorder">Address Line1</label>
                        <input type="text" class="form-control" id="addressline1" placeholder="Enter Address Line 1" name="addressline1">
                      </div>
                    </div>
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

</section>
<br>
<br>
<section class="content" id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Vendor Details </h3>
          </div>

          <div class="card-body ">
            <section>
              <div style="margin-left:auto;">
                <label style="color: #0054A8;" for="">SEARCH :</label>
                <input id="myInput" type="text" placeholder="Search..">
              </div>
            </section>
            <div class="container-fluid">
              <table id="example2" class="table table-bordered ">
                <thead>
                  <tr>
                    <th>SI.No</th>
                    <th>Vendor Name</th>
                    <th>Address Line 1</th>
                    <th>password</th>
                    <th>status</th>
                    <th>created by</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="myTable">
                  <?php
                  $vendor = pg_query($db, "SELECT vendors.id,vendors.businessname,vendors.status,vendors.createdby,vendors.createdat,vendors.updatedby,vendors.updatedat,vendors.addressline1,login.password,login.id from vendors LEFT JOIN login ON login.vendorid=vendors.id WHERE vendors.status=1");
                  $i = 1;
                  while ($row = pg_fetch_assoc($vendor)) {
                  ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['businessname'] ?></td>
                      <td><?php echo $row['addressline1'] ?></td>
                      <td><?php echo $row['password'] ?></td>
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
                              <h4 class="modal-title">Delete Vendors</h4>
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
                              <h4 class="modal-title">Edit vendors </h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleSelectBorder">vendor name</label>
                                    <input type="text" class="form-control" id="businessname<?php echo $row['id']; ?>" placeholder="Enter Vendor name" name="vendorname" value="<?php echo $row['businessname']; ?>">

                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleSelectBorder">password</label>
                                    <input type="text" class="form-control" id="password<?php echo $row['id']; ?>" placeholder="Enter password" name="password" value="<?php echo $row['password']; ?>">

                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleSelectBorder">Address Line1</label>
                                    <input type="text" class="form-control" id="addressline1<?php echo $row['id']; ?>" placeholder="Enter Address Line 1" name="addressline1" value="<?php echo $row['addressline1']; ?>">
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleSelectBorder">Status</label>
                                    <select class="custom-select" id="status<?php echo $row['id']; ?>" name="status">
                                      <option>Status</option>
                                      <option value="1" <?php if ($row['status'] == "1") echo "Selected"; ?>>Active</option>
                                      <option value="2" <?php if ($row['status'] == "2") echo "Selected"; ?>>InActive</option>
                                    </select>
                                  </div>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" name="submit" onclick="editsave(<?php echo $row['id']; ?>)">Save changes</button>
                            </div>
                          </div>

                        </div>

                      </div>
                      </form>
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
                                          <label for="exampleInputEmail1">Address</label>
                                        </div>
                                      </div>
                                      <div class="col-sm-8">
                                        <div class="form-group">
                                          <p class="text-sm"><?php echo $row['addressline1']; ?>
                                          </p>
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Password</label>
                                        </div>
                                      </div>
                                      <div class="col-sm-8">
                                        <div class="form-group">
                                          <p class="text-sm"><?php echo $row['password']; ?>
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
      "autoWidth": true,
      //"responsive": true,
      "scroolX": true,
    });
  });
</script>
<script>
  function save() {
    var businessname = $("#businessname").val();
    var addressline1 = $("#addressline1").val();
    var password = $("#password").val();
    var status = $("#status").val();
    if (businessname == "") {
      alert("businessname must be filled out");
      return false;
    } else if (addressline1 == "") {
      alert("addressline1 must be filled out");
      return false;
    } else if (status == "") {
      alert("status must be filled out");
      return false;
    } else if (password == "") {
      alert("password must be filled out");
      return false;
    } else if (businessname !== "" && password !== "" && addressline1 !== "" && status !== "") {
      $.ajax({
        url: "api/createvendors.php",
        method: "POST",
        dataType: "text",
        data: {
          "businessname": businessname,
          "addressline1": addressline1,
          "password": password,
          "status": status,
        },
        success: function(msg) {
          console.log(msg);
          var message = msg;
          if (message == "success") {
            success();
          } else if (message == "vendor_already_existed") {

            vendor_existed()
          } else {
            error();
          }
        }
      })
    }
  }
  // function RefreshTable() {

  //      $( "#content" ).load( "index.php?pageid=1 #content" );
  //  }
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

  function success() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
      icon: 'success',
      title: 'Vendors Added Successfully.'
    })
    setTimeout(function() {

      location.reload(true);
    }, 1000);

  }

  function vendor_existed() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
      icon: 'info',
      title: 'vendor_already_existed'
    })
    setTimeout(function() {
      //alert('Reloading Page');
      location.reload(true);
    }, 1000);
    //window.location.reload();
  }

  function editsave(id) {
    var id = id;
    var businessname = $("#businessname" + id).val();
    var password = $("#password" + id).val();
    var addressline1 = $("#addressline1" + id).val();
    var status = $("#status" + id).val();
    if (businessname == "") {
      alert("businessname must be filled out");
      return false;
    } else if (password == "") {
      alert("password must be filled out");
      return false;
    } else if (addressline1 == "") {
      alert("addressline1 must be filled out");
      return false;
    } else if (status == "") {
      alert("status must be filled out");
      return false;
    } else if (businessname !== "" && password !== "" && addressline1 !== "" && status !== "") {
      $.ajax({
        type: "GET",
        url: "api/updatevendors.php",
        datatype: "text",
        data: {
          "id": id,
          "businessname": businessname,
          "password": password,
          "addressline1": addressline1,
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
      title: 'Vendors Edit Successfully.'
    })
    setTimeout(function() {

      location.reload(true);
    }, 1000);

  }

  function deleterecord(id) {

    var deleteid = id;
    $.ajax({
      type: "POST",
      url: "api/deletevendors.php",
      data: {

        "deleteid": deleteid,

      },
      success: function(msg) {
        console.log(msg);
        var message = msg;

        if (message == "success") {

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
<script>
  function validate() {
    var businessname = document.getElementById("businessname").value;
    if (!/^[A-Za-z\s]+$/.test(businessname)) {
      document.getElementById("div1").innerHTML = "Enter the valid Name";
      document.getElementById("div1").style.color = "Red";

    } else {
      document.getElementById("div1").innerHTML = "";
    }
  }
</script>