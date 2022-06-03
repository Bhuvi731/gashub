<?php
session_start();
if(isset($_POST["log"]) && isset($_POST["pwd"]))
{
	
    
    require('database/db.php');
	
	$username = $_POST["log"];
   
	$password = $_POST["pwd"];
	$msg = '';
	
	$rs=pg_query($db,"SELECT id,username,usertype FROM login WHERE username='" . pg_escape_string($db,$username) . 
						"' and password='" . pg_escape_string($db,$password) . "' LIMIT 1");
	if(pg_num_rows($rs) > 0)
	{
		if($rd=pg_fetch_array($rs))
		{
			$_SESSION['admin'] = $rd[1];
            $_SESSION['usertype'] = $rd[2];
			$_SESSION['timeout'] = time();
			$_SESSION['id'] = $rd[0];
			header("Location: index.php");
		}
		else
		{
			header("Location: login.php?failure=true");
		}
	}
	else
	{
		header("Location: login.php?failure=true");
	}
		
}
else
{
	header("Location: login.php?failure=true");
	
}
?>