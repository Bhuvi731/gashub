

<?php
if ($pageid == 1) {
	include("registration.php");
} else if ($pageid == 3) {
	include("vendors.php");
} else if ($pageid == 5) {
	include("useradress.php");
} else if ($pageid == 7) {
	include("inventory.php");
} else if ($pageid == 8) {
	include("ordermanagement.php");
} else if ($pageid == 9) {
	include("feedback.php");
} else if ($pageid == 10) {
	include("userlogin.php");
} else if ($pageid == 12) {
	include("brands.php");
} else if ($pageid == 15) {
	include("Cylinder Stock.php");
} else if ($pageid == 16) {
	include("Accessories Stock.php");
} else if ($pageid == 19) {
	include("brandsvendor.php");
} else if ($pageid == 20) {
	include("accessoriesvendor.php");
}  else if ($pageid == 22) {
	include("cylindervendorstock.php");
} else if ($pageid == 23) {
	include("accessoriesvendorstock.php");
} else if ($pageid == 24) {
	include("carosel.php");
} else if ($pageid == 25) {
	include("feedbackvendor.php");
} else if ($pageid == 26) {
	include("ordermanagementvendor.php");
} else if ($pageid == 50) {
	$rootp = realpath('dbback/');

	$rootp = str_replace("\\", "/", $rootp);

	$rs = mysqli_query($conn, "show tables");

	$tb = array();

	while ($rd = mysqli_fetch_array($rs, MYSQLI_NUM))

		array_push($tb, $rd[0]);

	$fp = fopen("dbback/tables.txt", "wb");

	foreach ($tb as $tbn) {

		$rs = mysqli_query($conn, "show create table $tbn");

		if ($rd = mysqli_fetch_array($rs, MYSQLI_NUM))

			fwrite($fp, $rd[1] . ";");

		mysqli_query($conn, "SELECT * INTO OUTFILE '$rootp/" . $tbn . "' FROM $tbn");
	}

	fwrite($fp, " ");

	fclose($fp);

	//echo "<h4 style=\"color:#000;\">Database backup processess successfully completed</h4>";	

	include("backup.php");
} else
	include("bioDetails.php");
