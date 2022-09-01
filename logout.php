<?php
include("database/db.php");
if(isset($_POST['id']))
{
    session_start();
    session_destroy();
    echo "1";
}
?>