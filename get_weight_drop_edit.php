<?php include 'database/db.php'; ?>
<?php
$vendorbranch = $_POST["vendorbranch"];
$result = pg_query($db, "SELECT * FROM cylinder where vendoraddid = $vendorbranch");
?>
<option value="">Select Weight</option>
<?php
while ($row = pg_fetch_assoc($result)) {
?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["weight"]; ?></option>
<?php
}
?>