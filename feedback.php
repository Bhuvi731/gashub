<?php
require('database/db.php');
?>
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

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
      </div>
      <section class="content" id="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Feedback Details</h3>
                </div>

                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>SI.No</th>
                        <th>Users</th>
                        <th>Brands</th>
                        <th>Vendors</th>
                        <th>Rating</th>
                        <th>Title</th>
                        <th>Review</th>
                        <th>status</th>
                        <th>createdby</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      <?php
                      $vendor = pg_query($db, "SELECT feedbacks.id,feedbacks.vendorid,feedbacks.userid,feedbacks.rating,feedbacks.review,feedbacks.createdby,users.firstname,vendors.businessname,petroleum.petroleum_name,vendors.id,feedbacks.title,feedbacks.status FROM feedbacks LEFT JOIN useraddresses ON useraddresses.id=feedbacks.vendorid  LEFT JOIN vendors ON vendors.id=feedbacks.vendorid  LEFT JOIN petroleum ON petroleum.vendorid=feedbacks.id LEFT JOIN users ON users.id=feedbacks.userid  WHERE feedbacks.status=1");
                      $i = 1;
                      while ($row = pg_fetch_assoc($vendor)) {
                      ?>
                        <tr>
                          <td><?php echo $i ?></td>
                          <td><?php echo $row['firstname'] ?></td>
                          <td><?php echo $row['businessname'] ?></td>
                          <td><?php echo $row['petroleum_name'] ?></td>
                          <td><?php echo $row['rating'] ?></td>
                          <td><?php echo $row['title'] ?></td>
                          <td><?php echo $row['review'] ?></td>
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
                                  <h4 class="modal-title">Delete feedback</h4>
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
                                  <h4 class="modal-title">Edit Feedbacks</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form>
                                    <!-- <div class="card-body"> -->
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">User Name</label>
                                      <input type="text" class="form-control" id="firstname<?php echo $row['id']; ?>" placeholder="Enter User Name" name="name" value="<?php echo $row['firstname']; ?>">
                                    </div>
                                    <input type="hidden" id="loginid" name="loginid" value=<?php echo  $session_value; ?>>
                                    <!-- <div class="card-body"> -->
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Vendor Name</label>
                                      <input type="text" class="form-control" id="businessname<?php echo $row['id']; ?>" placeholder="Enter vendor Name" name="businessname" value="<?php echo $row['businessname']; ?>">
                                    </div>
                                    <!-- <div class="card-body"> -->
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Brand Name</label>
                                      <input type="text" class="form-control" id="petroleum_name<?php echo $row['id']; ?>" placeholder="Enter Brand Name" name="petroleum_name" value="<?php echo $row['petroleum_name']; ?>">
                                    </div>


                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Rating</label>
                                      <input type="text" class="form-control" id="rating<?php echo $row['id']; ?>" placeholder="Enter Rating" name="rating" value="<?php echo $row['rating']; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Title</label>
                                      <input type="text" class="form-control" id="title<?php echo $row['id']; ?>" placeholder="Enter Title" name="title" value="<?php echo $row['title']; ?>">
                                    </div>


                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Review</label>
                                      <input type="text" class="form-control" id="review<?php echo $row['id']; ?>" placeholder="Enter Review" name="review" value="<?php echo $row['review']; ?>">
                                    </div>


                                    <div class="form-group">
                                      <label for="exampleSelectBorder">Status</label>
                                      <select class="custom-select" id="status<?php echo $row['id']; ?>" name="status">
                                        <option value="">Status</option>
                                        <option value="1" <?php if ($row['status'] == "1") echo "Selected" ?>>Active</option>
                                        <option value="-1" <?php if ($row['status'] == "-1") echo "Selected" ?>>InActive</option>
                                      </select>
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

                </div>
                <!-- < view start -->
                <div class="modal fade" id="viewmodal-default<?php echo $row['id']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Feedback Details</h4>
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
                                    <label for="exampleInputEmail1">user Name</label>
                                  </div>
                                </div>
                                <div class="col-sm-8">
                                  <div class="form-group">
                                    <p class="text-sm"><?php echo $row['firstname']; ?>
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
                                    <label for="exampleInputEmail1">Brand name</label>
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
                                    <label for="exampleInputEmail1">Rating</label>
                                  </div>
                                </div>
                                <div class="col-sm-8">
                                  <div class="form-group">
                                    <p class="text-sm"><?php echo $row['rating']; ?>
                                    </p>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                  </div>
                                </div>
                                <div class="col-sm-8">
                                  <div class="form-group">
                                    <p class="text-sm"><?php echo $row['title']; ?>
                                    </p>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Review</label>
                                  </div>
                                </div>
                                <div class="col-sm-8">
                                  <div class="form-group">
                                    <p class="text-sm"><?php echo $row['review']; ?>
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
<script>
  // function save() {
  //   var vendorbranch = $("#vendorbranch").val();
  //   var rating = $("#rating").val();
  //   var review = $("#review").val();
  //   var status = $("#status").val();
  //   if (vendorbranch == "") {
  //     alert("vendorbranch must be filled out");
  //     return false;
  //   } else if (rating == "") {
  //     alert("rating must be filled out");
  //     return false;
  //   } else if (review == "") {
  //     alert("review must be filled out");
  //     return false;
  //   } else if (status == "") {
  //     alert("Status must be filled out");
  //     return false;
  //   } else if (vendorbranch !== "" && rating !== "" && review !== "" && status !== "") {

  //     $.ajax({
  //       url: "api/createfeedback.php",
  //       method: "POST",
  //       dataType: "text",
  //       data: {

  //         "vendorbranch": vendorbranch,
  //         "rating": rating,
  //         "review": review,
  //         "status": status,
  //       },
  //       success: function(msg) {
  //         console.log(msg);
  //         var message = msg['message'];
  //         if (message == "Successfull") {

  //           success();
  //         } else {
  //           error();
  //         }
  //       }
  //     })
  //   }


  // }

  function RefreshTable() {

    $("#content").load("index.php?pageid=9 #content");
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
    setTimeout(function() {

      location.reload(true);
    }, 1000);

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
      title: 'Feedback Added Successfully.'
    })
    setTimeout(function() {

      location.reload(true);
    }, 1000);

  }

  function editsave(id) {
    var firstname = $("#firstname" + id).val();
    var vendorname = $("#businessname" + id).val();
    var brandname = $("#petroleum_name" + id).val();
    var rating = $("#rating" + id).val();
    var title = $("#title" + id).val();
    var review = $("#review" + id).val();
    var loginid = $("#loginid").val();
    var status = $("#status" + id).val();
    if (firstname == "") {
      alert("firstname must be filled out");
      return false;
    } else if (vendorname == "") {
      alert("vendorname must be filled out");
      return false;
    } else if (brandname == "") {
      alert("brandname must be filled out");
      return false;
    } else if (rating == "") {
      alert("rating must be filled out");
      return false;
    } else if (title == "") {
      alert("title must be filled out");
      return false;
    } else if (review == "") {
      alert("review must be filled out");
      return false;
    } else if (status == "") {
      alert("Status must be filled out");
      return false;
    } else if (id !== "" && firstname !== "" && vendorname !== "" && brandname !== "" && status !== "" && rating !== "" && review !== "") {
      $.ajax({
        type: "GET",
        url: "api/updatefeedback.php",
        dataType: "text",
        data: {
          "id": id,
          "firstname": firstname,
          "vendorname": businessname,
          "brandname": petroleum_name,
          "status": status,
          "rating": rating,
          "title": title,
          "loginid": loginid,
          "review": review,
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
      title: 'Feedback Edit  Successfully.'
    })
    setTimeout(function() {

      location.reload(true);
    }, 1000);

  }

  function deleterecord(id) {
    var deleteid = id;
    alert(deleteid);
    $.ajax({
      type: "GET",
      url: "api/deletefeedback.php",
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