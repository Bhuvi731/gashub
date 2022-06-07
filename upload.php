<?php
include_once 'database/db.php';


$statusmsg='';
$backlink='<a href="./">Go back</a>';
$tagetDir='http://gashub.amicodevelopment.net/uploads/banners/';

$fileName=basename($_FILES['file']['name']);
 echo $targetfilePath=$tagetDir .$fileName;
 $filetype= pathinfo($targetfilePath,PATHINFO_EXTENSION);

if(isset($_POST['submit']) && !empty($_FILES['file']['name']))
{
  $allowtype=array('jpg','png','jpeg','gif','pdf');
if(!file_exists($targetfilePath)){
  if(in_array($filetype,$allowtype)){
    $string=move_uploaded_file($_FILES['file']['tmp_name'], $targetfilePath);
    echo $string;
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfilePath)){

      $sql="INSERT INTO banner_images(images) VALUES('".$fileName."')";
 $insert=pg_query($db,$sql);
if($insert){
       
  $statusmsg="The file <b>".$fileName."</b>has been Successfully Uploaded".$backlink;
       
}else{
   $statusmsg=' file upload failed, please try again.'.$backlink;
}

    }else{
      $statusmsg='sorry,there is an error uploading your file.'.$backlink;
    }
  }else{
    $statusmsg='sorry,only JPG,JPEG,GIF and PDF files are allowed to upload.'.$backlink;
  }
}else{
  $statusmsg="The file <b>".$fileName."</b>is already exist".$backlink;
}
}else{
  $statusmsg='please select a file to upload.'.$backlink;
}

echo $statusmsg;


?>