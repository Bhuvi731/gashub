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
<option value="">Status</option>
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
<h3 class="card-title">Product Details</h3>
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
<th>Vendor Name</th>
<th>Location</th>
<th>Type</th>
<th>weight</th>
<th>Price</th>
<th>status</th>
<th>createdby</th>
<th>Action</th>
</tr>
</thead>
<tbody id="myTable">
<?php
$vendor=pg_query($db,"SELECT products.id,vendors.businessname,products.location,cylindertype.type,cylinderweight.weight,products.price,products.status,products.createdby from products LEFT JOIN vendors ON vendors.id=products.vendorid LEFT JOIN cylindertype ON cylindertype.id=products.cylindertypeid LEFT JOIN cylinderweight ON cylinderweight.id=products.cylinderweightid where products.status=1");
$i=1;
while($row=pg_fetch_assoc($vendor))
{
	?>
<tr>
<td><?php echo $i?></td>
<td><?php echo $row['businessname']?></td>
<td><?php echo $row['location'] ?></td>
<td><?php echo $row['type']?></td>
<td><?php echo $row['weight'] ?></td>
<td><?php echo $row['price'] ?></td>


<td>
<?php
if($row['status']==1)
{
  echo "Active";
}else{
  echo "InActive";
}
?></td>
<td><?php 
if($row['createdby']==1)
{
  echo "Admin";
}?></td>

<td><a style="margin-right: 10px;cursor:pointer" data-toggle="modal" data-target="#viewmodal-default<?php echo $row['id'];?>"><i class="nav-icon fas fa-eye"></i></a>
<a style="margin-right: 10px;cursor:pointer" data-toggle="modal" data-target="#editmodal-default<?php echo $row['id'];?>"><i class="nav-icon fas fa-edit"></i></a> 
<a style="cursor:pointer" data-toggle="modal" data-target="#deletemodal-sm<?php echo $row['id'];?>"><i class="nav-icon fas fa-trash"></i></a>
</td>
<!-- Delete Start -->
<div class="modal fade" id="deletemodal-sm<?php echo $row['id'];?>">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Delete Products</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
  <p>Are you sure you want to delete?</p>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
<button type="button" class="btn btn-primary" onclick="deleterecord(<?php echo $row['id'];?>)">Yes</button>
</div>
</div>

</div>

</div>
<!-- edit start -->
<div class="modal fade" id="editmodal-default<?php echo $row['id'];?>">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit Orders</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form>
<div class="card-body">

<div class="form-group">
<label for="exampleInputEmail1">Vendor Name</label>
<input type="text" class="form-control" id="businessname<?php echo $row['id'];?>" placeholder="Enter Vendor Name" name="businessname" value="<?php echo $row['businessname'];?>">
</div>
<div class="card-body">

<div class="form-group">
<label for="exampleInputEmail1">Location</label>
<input type="text" class="form-control" id="location<?php echo $row['id'];?>" placeholder="Enter location" name="location" value="<?php echo $row['location'];?>">
</div>
<div class="form-group">
<label for="exampleInputEmail1">price</label>
<input type="text" class="form-control" id="price<?php echo $row['id'];?>" placeholder="Enter price" name="price" value="<?php echo $row['price'];?>">
</div>
<div class="form-group">
<label for="exampleSelectBorder">Status</label>
<select class="custom-select" id="status<?php echo $row['id'];?>" name="status">
<option>Status</option>
<option value="1" <?php if($row['status']=="1") echo "Selected"?>>Active</option>
<option value="2" <?php if($row['status']=="2") echo "Selected"?>>InActive</option>
</select>
</div>

</div>

</form>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary" name="submit" onclick="editsave(<?php echo $row['id'];?>)">Save changes</button>
</div>
</div>

</div>

</div>
<!-- view start -->
<div class="modal fade" id="viewmodal-default">
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
<p class="text-sm"><?php echo $row['businessname'];?>
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
<p class="text-sm"><?php echo $row['businessname'];?>
</p>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="exampleInputEmail1">Location</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['location'];?>
</p>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="exampleInputEmail1">Price</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['price'];?>
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
<p class="text-sm"><?php echo 'Active';?>
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
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script>
  $(function () {
    
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
  function save()
  {
    
 var location=$("#location").val();
 var price=$("#price").val();
var status=$("#status").val();
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
       url:"api/createproduct.php",
       method:"POST",
       dataType:"json",
       data: {
        
        "location":location,
        "price":price,
        "status":status,
      },
      success:function(msg)
      {    
        console.log(msg);
        var message=msg['message'];
        // alert(message);
        if(message=="Successfull")
        {

           success();  
        }
        else{
          error();
        }
       }
    })
    }
  }
  
  

  function RefreshTable() {
  
       $( "#content" ).load( "index.php?pageid=1 #content" );
   }

   function error()
   {
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
          setTimeout(function () {
        
        location.reload(true);
      }, 1000);
          
   }
  function success()
  {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
        icon: 'success',
        title: 'Registration Successfully.'
      })
          setTimeout(function () {
       
        location.reload(true);
      }, 1000);
          
  }

  function editsave(id)
  {
    
    var location= $("#location"+id).val();
    var price = $("#price"+id).val();
    var status = $("#status"+id).val();
    if (location == "") {
      alert("location must be filled out");
      return false;
    }
    else if(status == "")
    {
      alert("Status must be filled out");
      return false;
    }
    if (price == "") {
      alert("price must be filled out");
      return false;
    }
    }else if(location != "" && status !="" && price !=="" )
    {
      $.ajax({
      type:"POST",
      url:"api/createproduct.php",
      data:
      {
        "id":courseid,
        "location":location,
        "price":price,
        "status":status,
      },
      success:function(msg)
      {
        console.log(msg);
        if(msg=="success")
        {
          
          editsuccess();
          
          
        }else{

        }
      }
    })
    }
  

  function editsuccess()
  {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
            icon: 'success',
            title: 'Course Edit Successfully.'
          })
          setTimeout(function () {
        
        location.reload(true);
      }, 1000);
          
  }

  function deleterecord(id)
  {
    
    var deleteid=id;
     alert(deleteid);
    $.ajax({
      type:"POST",
      url:""http://gashub.amicodevelopment.net/api/deleteproduct.php",
      data:
      {
        "deleteid":deleteid,
       
      },
      success:function(msg){
      console.log(msg);
      }
    })
  }

  function deletesuccess()
  {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
            icon: 'success',
            title: 'Program Delete Successfully.'
          })
          setTimeout(function () {
        
        location.reload(true);
      }, 1000);
  }
  
</script>



