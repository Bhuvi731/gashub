<?php
error_reporting(0);
if (!isset($_SESSION)) {
  session_start();
}
// set timeout period in seconds
$inactive = 7200;

include("checklogin.php");
if($loginfo==0)
	header("Location:login.php");
	
	if(isset($_GET["pageid"]))
{
	$pageid=$_GET["pageid"];
	if($pageid<100)	
    {
      
      $fname="firstprg.php";
    }
		
	
	else
	{
		$pageid=1;
		$fname="masterprg.php";
	}
}
else
{
	$pageid=1;
	$fname="masterprg.php";
}

require('database/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GASHUB</title>

<link rel="stylesheet" href="assets/css/css24b9.css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

<link rel="stylesheet" href="assets/css/all.min.css">

<link rel="stylesheet" href="assets/css/ionicons.min.css">

<link rel="stylesheet" href="assets/css/tempusdominus-bootstrap-4.min.css">

<link rel="stylesheet" href="assets/css/icheck-bootstrap.min.css">

<link rel="stylesheet" href="assets/css/jqvmap.min.css">

<link rel="stylesheet" href="assets/css/adminlte.min2167.css?v=3.2.0">

<link rel="stylesheet" href="assets/css/OverlayScrollbars.min.css">

<link rel="stylesheet" href="assets/css/daterangepicker.css">

<link rel="stylesheet" href="assets/css/summernote-bs4.min.css">
<script nonce="1b4a9356-0c6c-496f-90fd-2944240f52b2">(function(w,d){!function(a,e,t,r,z){a.zarazData=a.zarazData||{},a.zarazData.executed=[],a.zarazData.tracks=[],a.zaraz={deferred:[]};var s=e.getElementsByTagName("title")[0];s&&(a.zarazData.t=e.getElementsByTagName("title")[0].text),a.zarazData.w=a.screen.width,a.zarazData.h=a.screen.height,a.zarazData.j=a.innerHeight,a.zarazData.e=a.innerWidth,a.zarazData.l=a.location.href,a.zarazData.r=e.referrer,a.zarazData.k=a.screen.colorDepth,a.zarazData.n=e.characterSet,a.zarazData.o=(new Date).getTimezoneOffset(),a.dataLayer=a.dataLayer||[],a.zaraz.track=(e,t)=>{for(key in a.zarazData.tracks.push(e),t)a.zarazData["z_"+key]=t[key]},a.zaraz._preSet=[],a.zaraz.set=(e,t,r)=>{a.zarazData["z_"+e]=t,a.zaraz._preSet.push([e,t,r])},a.dataLayer.push({"zaraz.start":(new Date).getTime()}),a.addEventListener("DOMContentLoaded",(()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r);z.defer=!0,z.src="assets/js/sd0d9.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData))),t.parentNode.insertBefore(z,t)}))}(w,d,0,"script");})(window,document);</script></head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</li>
</ul>

<ul class="navbar-nav ml-auto">


<li class="nav-item dropdown">
<a class="nav-link" data-toggle="dropdown" href="#">
<i class="fa fa-user" aria-hidden="true"></i>
<span class="badge badge-warning navbar-badge"></span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
<div class="dropdown-divider"></div>
<a  class="dropdown-item" onclick="signout()" style="cursor: pointer;">
<i class="fas fa-sign-out-alt mr-2"></i>Sign Out
</a>


</li>
<li class="nav-item">
<a class="nav-link" data-widget="fullscreen" href="#" role="button">
<i class="fas fa-expand-arrows-alt"></i>
</a>
</li>

</ul>
</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="index.php" class="brand-link">
<img src="assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">GASHUB</span>
</a>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
<img src="assets/img/avatar.png" class="img-circle elevation-2" alt="User Image">
</div>
<?php
if($_SESSION['usertype']=="Admin")
{
?>
<div class="info">
 <a href="#" class="d-block">Admin</a>
</div>
<?php
}else if($_SESSION['usertype']=="User")
{
?>
<div class="info">
 <a href="#" class="d-block">UserManagement</a>
</div>
<?php
}else if($_SESSION['usertype']=="Vendor")
{
?>
<div class="info">
 <a href="#" class="d-block">Vendor</a>
</div>
<?php
}
?>

</div>

<div class="form-inline">
<div class="input-group" data-widget="sidebar-search">
<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
<div class="input-group-append">
<button class="btn btn-sidebar">
<i class="fas fa-search fa-fw"></i>
</button>
</div>
</div>
</div>
<?php
if($_SESSION['usertype']=="Admin")
{
  include("link.php");
  
}else if($_SESSION['usertype']=="User")
{
  include("link1.php");
  
}
else if($_SESSION['usertype']=="Vendor")
{
  include("link2.php");
  
}
?>


</div>

</aside>

<div class="content-wrapper">

<div class="content-header" id="dashboard">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Dashboard</h1>
</div>

</div>
</div>
</div>

<?php
if($_GET['pageid'])
{
	include($fname);
}else
{
	?>
<section class="content">
  <?php
  if($_SESSION['usertype']=="1")
  {
    ?>
    <div class="container-fluid">

<div class="row" id="dashboard">

<div class="col-lg-3 col-6">

</div>

<div class="col-lg-3 col-6">



<div class="col-lg-3 col-6">


</div>




<div class="row">

<section class="col-lg-7 connectedSortable">

<div class="card">


</div>


<div class="card direct-chat direct-chat-primary">


<div class="card-body">






</div>



</div>
    <?php
  }
  ?>





</section>
	<?php
}
?>






</div>



<aside class="control-sidebar control-sidebar-dark">

</aside>

</div>


<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="plugins/chart.js/Chart.min.js"></script>

<script src="plugins/sparklines/sparkline.js"></script>

<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<script src="plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>

<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="plugins/summernote/summernote-bs4.min.js"></script>

<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="assets/js/adminlte2167.js?v=3.2.0"></script>

<script src="assets/js/demo.js"></script>

<script src="assets/js/dashboard.js"></script>
<script>
      function signout()
      {
        var id=1;
        $.ajax({
            type:"POST",
            url:"logout.php",
            data:{
                id:id,
            },
            success:function(msg)
            {
                if(msg==1)
                {
                    window.location.href="login.php";
                }
            }
        })
      }
</script>
</body>

<!-- Mirrored from adminlte.io/themes/v3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Mar 2022 06:16:18 GMT -->
</html>
