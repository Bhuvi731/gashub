
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
<div style="margin:auto;">
   <label style="color: #0054A8;" for="">SEARCH :</label>
<input id="myInput" type="text" placeholder="Search..">
</div>
</section>
<table id="example2" class="table table-bordered table-hover">
<thead>
<tr>
<th>SI.No</th>
<th>User Name</th>
<th>Successfull Login</th>
<th>Failed Login</th>
<th>Invalid Login Attempt</th>
</tr>
</thead>
<tbody id="myTable">
<?php

$user=pg_query($db,"SELECT users.email,userlogins.successfullogin,userlogins.failedlogin,userlogins.invalidloginattempt FROM userlogins LEFT JOIN users ON users.id =userlogins.userid");
$i=1;
while($row=pg_fetch_assoc($user))
{
	?>
<tr>
<td><?php echo $i?></td>
<td><?php echo $row['email'] ?></td>
 <td><?php echo $row['successfulllogin'] ?></td>
<td><?php echo $row['failedlogin'] ?></td>
<td><?php echo $row['invalidloginattempt'] ?></td>
</tr>
	<?php
  $i++;
}
?>

</tbody>

</table>
</div>

</div>



</div>

</div>

</div>

</section>

<!-- <script src="plugins/jquery/jquery.min.js"></script>
 -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> -->
 <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="plugins/toastr/toastr.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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