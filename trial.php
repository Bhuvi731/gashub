<?php include("database/db.php");?>
<link rel="stylesheet" href="assets/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="assets/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<style>
	#dashboard
	{
		display:none;
	}
</style>

<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-8">
</div>
<div class="col-4">
<div class="card-footer clearfix" style="background-color:rgb(244 246 249) !important">
<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Add Products</button>
</div>
</div>

<div class="modal fade" id="modal-default">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Products</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form>
<div class="container-fluid">
<div class="card-body">
<div class="row">
<div class="col-sm-12">
<div class="form-group">
<label for="exampleSelectBorder">Location</label>
<input type="text" class="form-control" id="location" placeholder="Enter Location" name="location">
</div>
</div>
</div> 
<div class="row">
<div class="col-sm-12">
<div class="form-group">
<label for="exampleSelectBorder">Price</label>
<input type="text" class="form-control" id="price" placeholder="Enter Price" name="price">
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
<script src="plugins/jquery/jquery.min.js"></script>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> 
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
function save()
  {
     alert();
 var location=$("#location").val();
alert(location);
 var price=$("#price").val();
 alert(price);
  var status=$("#status").val();
  alert(status);
 if ( location == "") {
     alert("location must be filled out");
      return false;
     }
 if ( price == "") {
        alert("price must be filled out");
      return false;
    }
    else if(status == "")
    {  
         alert("Status must be filled out");
       return false;
     }else if(location !== "" && price !== "" && status !== "" )
      {
     $.ajax({
       url:"api/createtrail.php",
       method:"GET",
       dataType:"json",
       data: {
        
        location:location,
        price:price,
        status:status,
      },
      success:function(msg){
      console.log(msg);
      // alert(success);
      }
    })
     }
   }
  
  </script>