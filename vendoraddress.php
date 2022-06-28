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
 
  table {
   
    display: block;  
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
<form>
<div class="card-body">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="exampleSelectBorder">Vendor name</label>
<select class="custom-select" id="businessname" name="businessname">
<option>Select Your Vendor Name</option>
<?php
$vendor1=pg_query($db,"SELECT * FROM vendors WHERE status=1");
while($row1=pg_fetch_assoc($vendor1))
{
	?>
<option value="<?php echo $row1['id'];?>"><?php echo $row1[businessname]?></option>
<?php
}
?>
</select>

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
<label for="exampleSelectBorder">Pincode</label>
<input type="text" class="form-control" id="pincode" placeholder="Enter Pincode" name="pincode">
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

<!-- <div class="row">
<div class="col-sm-2" style=text> </div>  
<div class="col-sm-2" style=text> </div>  
<div class="col-sm-2" style=text>
<button type="button" class="btn btn-default" data-dismiss="modal">   Close   </button></div>
<div class="col-sm-6" style=text>   
<button type="button" class="btn btn-primary" name="submit" onclick="save()">Save changes</button></div>
</div>
</div> -->


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
<h3 class="card-title">Vendors  Details </h3>
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
<th>vendor Name</th>
<th>Address Line 1</th>
<th>Pincode</th>
<th>status</th>
<th>created by</th>
<th>Action</th>
</tr>
</thead>
<tbody id="myTable">
<?php
//echo"SELECT vendors.id, vendoraddresses.name,vendoraddresses.addressline1,vendoraddresses.addressline2,vendoraddresses.city,vendoraddresses.landmark,vendoraddresses.district,vendoraddresses.state,vendoraddresses.country,vendoraddresses.pincode,vendoraddresses.latitude,vendoraddresses.longitude,vendoraddresses.status,vendoraddresses.createdby,vendoraddresses.createdat,vendoraddresses.updatedat,vendoraddresses.updatedby,vendors.businessname FROM vendoraddresses LEFT JOIN vendors ON vendors.id = vendoraddresses.vendorid WHERE vendoraddresses.status=1";//
$vendor=pg_query($db,"SELECT * from vendoraddresses LEFT JOIN vendors ON vendors.id=vendoraddresses.vendorid WHERE vendoraddresses.status=1");
$i=1;
while($row=pg_fetch_assoc($vendor))
{
	?>
<tr>
<td><?php echo $i?></td>
<td><?php echo $row['businessname'] ?></td>
<td><?php echo $row['addressline1'] ?></td>
<td><?php echo $row['pincode'] ?></td>                                                                                                                                                           
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
<button type="button" class="btn btn-primary" onclick = "deleterecord(<?php echo $row['id'];?>)" >Yes</button>
</div>
</div>

</div>

</div>
<!-- edit start -->
<div class="modal fade" id="editmodal-default<?php echo $row['id'];?>">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit vendor Address</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form>
<div class="card-body">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="exampleSelectBorder">business name</label>
<select class="custom-select" id="businessname<?php echo $row['id'];?>" name="businessname">
<option>Select Your BusinessName</option>
<?php
$vendor1=pg_query($db,"SELECT * FROM vendors WHERE status=1");
while($row1=pg_fetch_assoc($vendor1))
{
	?>
<option value="<?php echo $row1['id'];?>"><?php echo $row1[businessname]?></option>
<?php
}
?>
</select>

</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleSelectBorder">Address Line1</label>
<input type="text" class="form-control" id="addressline1<?php echo $row['id'];?>" placeholder="Enter Address Line 1" name="addressline1" value="<?php echo $row['addressline1'];?>">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleSelectBorder">Pincode</label>
<input type="text" class="form-control" id="pincode<?php echo $row['id'];?>" placeholder="Enter Pincode" name="pincode" value="<?php echo $row['pincode'];?>">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleSelectBorder">Status</label>
<select class="custom-select" id="status<?php echo $row['id'];?>" name="status">
<option>Status</option>
<option value="1" <?php if($row['status']=="1") echo "Selected"?>>Active</option>
<option value="2" <?php if($row['status']=="2") echo "Selected"?>>InActive</option>
</select>
</div>
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
<div class="modal fade" id="viewmodal-default<?php echo $row['id'];?>">
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
<label for="exampleInputEmail1">Type</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['type'];?>
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
       "autoWidth": true,
      //"responsive": true,
      "scroolX":true,
    });
  });
</script>
<script>
  
  
  
  function save()
  {
    var vendorid=$("#businessname").val();
    var addressline1=$("#addressline1").val();
    var pincode=$("#pincode").val();
    var status=$("#status").val();
    if(vendorid == "")
    {
      alert("businessname must be filled out");
      return false;
    }
    else if(addressline1 == "")
    {
      alert("addressline1 must be filled out");
      return false;
    }
    else if(pincode == "")
    {
      alert("pincode must be filled out");
      return false;
    }
    else if(status == "")
    {
      alert("status must be filled out");
      return false;
    }
    else if(vendorid !== "" && addressline1 !== "" && pincode !== "" && status !== "" )
    {
      $.ajax({
      url:"api/createvendoraddress.php",
      method:"POST",
      dataType: "text",
      data: {
        "vendorid":vendorid,
        "addressline1":addressline1,
        "pincode":pincode,
        "status":status,
      },
      success:function(msg)
      {
        console.log(msg);
        var message=msg['message'];
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
  // function RefreshTable() {
  
  //      $( "#content" ).load( "index.php?pageid=1 #content" );
  //  }

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
        title: 'Vendor Added Successfully.'
      })
          setTimeout(function () {
       
        location.reload(true);
      }, 1000);
          
  }
  function email_existed()                                       
  {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
            icon: 'info',
            title: 'Email already existed.'
          })
          setTimeout(function () {
        //alert('Reloading Page');
        location.reload(true);
      }, 1000);
          //window.location.reload();
  }


  function editsave(id)
  {
    var id=id;
    var vendorid=$("#businessname"+id).val();
    var addressline1=$("#addressline1"+id).val();
    var pincode=$("#pincode"+id).val();
    var status=$("#status"+id).val();
    if(vendorid=="")
    {
      alert("vendorid must be filled out");
      return false;
    }
    else if (addressline1 == "") {
      alert("addressline1 must be filled out");
      return false;
    }
    else if(pincode == "")
    {
      alert("pincode must be filled out");
      return false;
    }
    else if(status == "")
    {
      alert("status must be filled out");
      return false;
    }
    else if( vendorid !== "" && addressline1 !== "" && pincode !== ""  && status !== "" )
    {
      alert();
      $.ajax({
      type:"GET",
      url:"api/updatevendoraddress.php",
      datatype:"json",
      data:
      {
        "id":id,
        "vendorid":vendorid,
        "addressline1":addressline1,
        "pincode":pincode,
        "status":status,
      },
      success:function(msg)
      {

        console.log(msg);
        // if(msg=="success")
        // {
        //   alert(success);
        //   editsuccess();
          
          
        // }else{

        // }
      }
    })
    }
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
            title: 'vendor Edit Successfully.'
          })
          setTimeout(function () {
        
        location.reload(true);
      }, 1000);
          
  }
  function deleterecord(id)
  {
   
    var deleteid=id;
    $.ajax({
      type:"POST",
      url:"api/deletevenderadress.php",
      data:
      {
        
        "deleteid":deleteid,
       
      },
      success:function(msg)
      {
        console.log(msg);
        var message=msg['message'];
        
        if(message=="Successfull")
        {
           
          deletesuccess();
          
          
        }else{
          error();
        }
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
            title: 'Deleted Successfully.'
          })
          setTimeout(function () {
        
        location.reload(true);
      }, 1000);
          
  }
</script>



