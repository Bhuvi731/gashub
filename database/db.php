<?php
   $host        = "host =localhost";

$port        = "port = 5432";
   $dbname      = "dbname =gashub";
   $credentials = "user =gashubadmin password=123456";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
  } 
else {
       //echo "connected database successfully\n";
}
?>
