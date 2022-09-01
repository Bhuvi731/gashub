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
<label for="exampleSelectBorder">Business Name</label>
<input type="text" class="form-control" id="businessname<?php echo $row['id'];?>" placeholder="Enter Business Name" name="businessname" value="<?php echo $row['businessname'];?>">
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
<!-- <section class="content">
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
<label for="exampleSelectBorder">Business Name</label>
<input type="text" class="form-control" id="businessname" placeholder="Enter Business Name" name="businessname">
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
</div> -->
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
// function save()
//   {
//     alert();
//     var businessname=$("#businessname").val();
//     alert(businessname);
//     var addressline1=$("#addressline1").val();
//     alert(addressline1);
//     var pincode=$("#pincode").val();
//     alert(pincode);
//     var status=$("#status").val();
//     alert(status);
//     if(businessname == "")
//     {
//       alert("businessname must be filled out");
//       return false;
//     }
//     else if(addressline1 == "")
//     {
//       alert("addressline1 must be filled out");
//       return false;
//     }
//     else if(pincode == "")
//     {
//       alert("pincode must be filled out");
//       return false;
//     }
//     else if(status == "status")
//     {
//       alert("status must be filled out");
//       return false;
//     }
//     else if(businessname !== "" && addressline1 !== "" && pincode !== "" && status !== "" )
//     {
//       alert();
//       $.ajax({
//       type:"GET",
//       url:"api/createsample.php",
//       datatype:"json",
//       data:
//       {
//         "businessname":businessname,
//         "addressline1":addressline1,
//         "pincode":pincode,
//         "status":status,
//       },
//       success:function(msg)
//       {

//         console.log(msg);
//         if(msg=="success")
//         {
//           alert(success);
//           // editsuccess();
          
          
//         }else{

//         }
//       }
//     })
//     }
//   }
  function editsave(id)
  {
    alert(id);
    var id=id;
    var businessname=$("#businessname"+id).val();
    var addressline1=$("#addressline1"+id).val();
    var pincode=$("#pincode"+id).val();
    var status=$("#status"+id).val();
    if(businessname=="")
    {
      alert("Businessname must be filled out");
      return false;
    }
    else if (addressline1 == "") {
      alert("Addressline1 must be filled out");
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
    else if( businessname !== "" && addressline1 !== "" && pincode !== ""  && status !== "" )
    {
      alert();
      $.ajax({
      type:"GET",
      url:"api/updatevendoraddress.php",
      datatype:"json",
      data:
      {
        "id":id,
        "businessname":businessname,
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
</script>