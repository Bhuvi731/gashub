<!-- <?php
// $db = pg_connect("host=localhost port=5432 dbname=gashub user=postgres password=postgres");
?> -->
<?php
require('database/db.php');
?>
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
<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Add Users</button>
</div>
</div>

<div class="modal fade" id="modal-default">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">New Registration</h4>
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
<label for="exampleSelectBorder">First Name</label>
<input type="text" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleInput">Last Name</label>
<input type="text" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastname">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleInput">Phone</label>
<input type="number" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone" pattern="[1-9]{1}[0-9]{9}" maxlength="10">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleInput">Email</label>
<input type="text" class="form-control" id="email" placeholder="Enter Email" name="email">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleInput">password</label>
<input type="text" class="form-control" id="password" placeholder="Enter Password" name="password">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleSelectBorder">Gender</label>
<select class="custom-select" id="gender" name="gender">
<option>Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleInputEmail1">DateofBirth</label>
<input type="date" class="form-control" id="dateofbirth" placeholder="Enter Date of Birth" name="dob">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="exampleSelectBorder">Status</label>
<select class="custom-select" id="status<?php echo $row['id'];?>" name="status">
<option value="">Status</option>
<option value="1" <?php if($row['status']=="1") echo "Selected"?>>Active</option>
<option value="-1" <?php if($row['status']=="-1") echo "Selected"?>>InActive</option>
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
<h3 class="card-title">User Details</h3>
</div>

<div class="card-body">
<section>
<div style="margin-left:auto;">
   <label style="color: #0054A8;" for="">SEARCH :</label>
<input id="myInput" type="text" placeholder="Search..">
</div>
</section>
<table id="example2" class="table table-bordered table-hover">
<thead>
<tr>
<th>SI.No</th>
<th>firstname</th>
<th>lastname</th>
<th>phone</th>
<th>email</th>
<th>password</th>
<th>gender</th>
<th>dateofbirth</th>
<th>status</th>
<th>createdby</th>
<th>Action</th>
</tr>
</thead>
<tbody id="myTable">
<?php

$user=pg_query($db,"SELECT id,firstname,lastname,phone,email,gender,dateofbirth,status,createdby,createdat,updatedat,updatedby,password FROM users WHERE status=1");
$i=1;
while($row=pg_fetch_assoc($user))
{
	?>
<tr>
<td><?php echo $i?></td>
<td><?php echo $row['firstname'] ?></td>
<td><?php echo $row['lastname'] ?></td>
<td><?php echo $row['phone'] ?></td>
<td><?php echo $row['email'] ?></td>
<td><?php echo $row['password']; ?></td>
<td><?php echo $row['gender'] ?></td>
<td><?php echo $row['dateofbirth']; ?></td>
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
<h4 class="modal-title">Delete Users</h4>
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
<!-- Edit start -->
<div class="modal fade" id="editmodal-default<?php echo $row['id'];?>">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit User</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form>
<div class="card-body">

<div class="form-group">
<label for="exampleInputEmail1">First Name</label>
<input type="text" class="form-control" id="firstname<?php echo $row['id'];?>" placeholder="Enter First Name" name="firstname" value="<?php echo $row['firstname'];?>">
</div>
<div class="form-group">
<label for="exampleInputEmail1">Last Name</label>
<input type="text" class="form-control" id="lastname<?php echo $row['id'];?>" placeholder="Enter Last Name" name="lastname" value="<?php echo $row['lastname'];?>">
</div>
<div class="form-group">
<label for="exampleInputEmail1">Gender</label>
<select class="custom-select" id="gender<?php echo $row['id'];?>" name="gender">
<option>Gender</option>
<option value="Male" <?php if($row['gender']=="Male") echo "Selected"?>>Male</option>
<option value="Female" <?php if($row['gender']=="Female") echo "Selected"?>>Female</option>
</select>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Date of Birth</label>
<input type="text" class="form-control" id="dateofbirth<?php echo $row['id'];?>" placeholder="Enter Date of Birth" name="nationality" value="<?php echo $row['dateofbirth'];?>">
</div>
<div class="form-group">
<label for="exampleInputEmail1">Phone</label>
<input type="number" class="form-control" id="phone<?php echo $row['id'];?>" placeholder="Enter Phone" name="phone" value="<?php echo $row['phone'];?>">

</div>
<div class="form-group">
<label for="exampleInputEmail1">Email</label>
<input type="email" class="form-control" id="email<?php echo $row['id'];?>" placeholder="Enter Email" name="email" value="<?php echo $row['email'];?>">

</div>
<div class="form-group">
<label for="exampleInputEmail1">Password</label>
<input type="email" class="form-control" id="password<?php echo $row['id'];?>" placeholder="Enter Password" name="password" value="<?php echo $row['password'];?>">

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
<label for="exampleInputEmail1">First Name</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['firstname'];?>
</p>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="exampleInputEmail1">Last Name</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['lastname'];?>
</p>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="exampleInputEmail1">Phone</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['phone'];?>
</p>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="exampleInputEmail1">email</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['email'];?>
</p>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="exampleInputEmail1">password</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['password'];?>
</p>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="exampleInputEmail1">Gender</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['gender'];?>
</p>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label for="exampleInputEmail1">Date Of Birth</label>
</div>
</div>
<div class="col-sm-8">
<div class="form-group">
<p class="text-sm"><?php echo $row['dateofbirth'];?>
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
      // "responsive": true,
      "scroolX":true,
    });
  });
</script>
<script>
  
  
  
  function save()
  {
    var firstname=$("#firstname").val();
    var lastname=$("#lastname").val();
    var phone=$("#phone").val();
    var email=$("#email").val();
    var password=$("#password").val();
    var gender=$("#gender").val();
    var dateofbirth=$("#dateofbirth").val();
    var status=$("#status").val();

    if (firstname == "") {
      alert("Name must be filled out");
      return false;
    }
    if (phone == "") {
      alert("Phone Number must be filled out");
      return false;
    }
    if (email == "") {
      alert("Email must be filled out");
      return false;
    }
    if(password =="")
    {
      alert("password must be filled out");
      return false;
    }
    if (gender == "Gender") {
      alert("Gender must be filled out");
      return false;
    }
    if (dateofbirth == "") {
      alert("DOB be filled out");
      return false;
    }
    else if(status == "")
    {
      alert("Status must be filled out");
      return false;

    }else if(firstname != "" && status !="" && phone !=="" && email !=="" && password !=="" && gender !=="" && dateofbirth !=="")
    {
      
    $.ajax({
      url:"api/createuser.php",
      method:"POST",
      dataType:"json",
      data: {
        
        "firstname":firstname,
        "lastname":lastname,
        "phone":phone,
        "email":email,
        "password":password,
        "gender":gender,
        "dateofbirth":dateofbirth,
        "status":status,
      },
      success:function(msg)
      {    
        console.log(msg);
        var message=msg['message'];
        alert(message);
        if(message=="Success")
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
        title: 'Registration Successfully.'
      })
          setTimeout(function () {
       
        location.reload(true);
      }, 1000);
          
  }
 

  function editsave(id)
  {
    var firstname=$("#firstname"+id).val();
    var lastname=$("#lastname"+id).val();
    var phone=$("#phone"+id).val();
    var email=$("#email"+id).val();
    var gender=$("#gender"+id).val();
    var dateofbirth=$("#dateofbirth"+id).val();
    var password=$("#password"+id).val();
    var status=$("#status"+id).val();
    if (firstname == "") {
      alert("Name must be filled out");
      return false;
    }
    if (phone == "") {
      alert("Phone Number must be filled out");
      return false;
    }
    if (email == "") {
      alert("Email must be filled out");
      return false;
    }
    if (gender == "Gender") {
      alert("Gender must be filled out");
      return false;
    }
    if (dateofbirth == "") {
      alert("DOB be filled out");
      return false;
    }
    else if(status == "Status")
    {
      alert("Status must be filled out");
      return false;
    }else if(firstname != "" && status !="" && phone !=="" && email !=="" && gender !=="" && dateofbirth !=="")
    {
      alert(id);
      $.ajax({
      type:"GET",
      url:"api/updateuser.php",
      data:
      {
        "id":id,
        "firstname":firstname,
        "lastname":lastname,
        "phone":phone,
        "email":email,
        "gender":gender,
        "dateofbirth":dateofbirth,
        "status":status,
        "password":password
      },
      success:function(msg)
      {
        console.log(msg);
        var message=msg['message'];
        alert(message);
        if(message=="success")
        {
           editsuccess();  
        }
       
        else{
          error();
        }
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
            title: 'User Edit Successfully.'
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
      url:"api/deleteuser.php",
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