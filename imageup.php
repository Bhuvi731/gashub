 <?php
 include_once 'database/db.php';
$uploaddir = '/uploads/banner/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);
$name = $_POST['name'];

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile))
{    echo "File is valid, and was successfully uploaded.\n";
}
else   {   echo "File size greater than 300kb!\n\n";   }

echo "'$name'\n";

$query = "INSERT INTO products(proimg)VALUES('$uploadfile')";
$result = pg_query($db,$query);

if($result)
{
    echo "File is valid, and was successfully uploaded.\n";
    unlink($uploadfile);
}
else
{
    echo "Filename already exists. Use another filename. Enter all the values.";
    unlink($uploadfile);
}
pg_close($db);
?>