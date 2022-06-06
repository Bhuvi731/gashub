<html>
<head>
    <link rel="stylesheet"
          type="text/css"
          href="style.css" />
<style>
  #dashboard
  {
    display:none;
  }
</style>

<script>
function onSubmitForm() {
    var formDOMObj = document.imgfrm;
    if (formDOMObj.file.value == "")
        alert("Please press the browse button and pick a file.")
    else
        return true;
    return false;
}
</script>
</head>

<body>
<?php
include_once 'database/db.php';

if(isset($_POST['submit']))
{
  $fileName=$_FILES['file']['name'];
  $tmpName=$_FILES['file']['tmp_name'];
  $UploadDir='uploads/banners/';
  $filePath=$UploadDir.$fileName;
  $result = move_uploaded_file($tmpName, $filePath); 
  if($result){
  $sql="INSERT INTO banner_images(images) VALUES('".$fileName."')";
 $query=pg_query($db,$sql);
if($sql){
    $err="Uploaded Successfully";
  }else{
    $err="error";
  }
  
  }else{
    $err="Error";
  }
  }
?>
<br>
<br> 
<section class="content" id="content">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">Add Banner</h3>
</div>

<div class="card-body">
<table id="example2" class="table table-bordered table-hover">
<thead>

</thead>
<tbody>
 <center><div id="content">
 
        <form method="POST" action="" name="imgfrm" enctype="multipart/form-data">
            <input type="file" name="file" value="" />
    <div> 
                <button type="submit" name="submit" onClick="return onSubmitForm()">UPLOAD</button>
            </div>
        </form>
    </div></center>
</tbody>

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


  <script type="text/javascript">
var err='<?php echo $err; ?>';
if(err.length>0)
alert(err);
</script>
</body>
</html>