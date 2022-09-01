<?php include 'database/db.php'; ?>

<?php
$vendorname = $_POST["vendorname"];
$result = pg_query($db, "SELECT * FROM cylinder where vendorid = $vendorname");
?>
<option value="">Select Vendor Name</option>
<?php
while ($row = pg_fetch_assoc($result)) {
?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["weight"]; ?></option>
<?php
}
?>