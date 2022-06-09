<?php
include_once '../database/db.php';


if(isset($_REQUEST['deleteid']))
 { 
    $id=$_REQUEST['deleteid'];
      echo $id;
      echo"UPDATE products SET status='-1' WHERE id=$id";
	$sql=pg_query($db,"UPDATE products SET status='-1' WHERE id=$id");
    
	if($sql)
	{    
        echo "Successfull";
	}else
    {
        
        echo "Error";
    }
 }
 else{
 	    echo "error";
     }
?>