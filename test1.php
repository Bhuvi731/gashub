<?php
    $cn = pg_connect("host=localhost port=5432 dbname=gashub user=postgres password=queen");
    if($cn)
    { 
        echo "connected ";
    }
    
?>