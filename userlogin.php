<style>
	#dashboard
	{
		display:none;
	}
</style>
<section class="content" id="content">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">User Details</h3>
</div>

<div class="card-body">
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
<tbody>
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