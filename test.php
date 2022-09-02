<?php
$cn= pg_connect("host=localhost port=5432 dbname=gashub user=postgres password=Alo@13121996");
if($cn)
{
    echo"connected";

}
?>