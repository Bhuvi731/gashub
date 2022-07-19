<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/plain');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../database/db.php';
if(isset($_POST['longitude']) && ($_POST['latitude']))
{


 $latitudeFrom =$_POST['longitude'];
 $longitudeFrom =$_POST['latitude'];
$sql=pg_query($db,"SELECT * FROM vendoraddresses where vendoraddresses.status=1");

$my=array();
$my1=array();
$my2=array();
$my3=array();
 if($sql){
   //var_dump($sql); 
    while(($sql2=pg_fetch_assoc($sql))){

     $my[]=$sql2;
}
    $longlen=count($my);
    foreach($my as $i => $i_value) {

      $latitudeTo=$i_value['latitude'];
      $longitudeTo=$i_value['longitude'];


if($latitudeTo!=null && $longitudeTo!=null)
{


      $theta = $longitudeFrom - $longitudeTo;
$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
$dist = acos($dist);
 $dist = rad2deg($dist);
 $miles = $dist * 60 * 1.1515;
  $distance = ($miles * 1.609344);
 //echo"'<br/>'";

if($distance<=3){

    $fristaddid=$i_value['id'];

  $sql=pg_query($db,"SELECT * from cylinder LEFT JOIN petroleum ON petroleum.id=cylinder.petroleumid LEFT JOIN  vendors ON vendors.id=cylinder.vendorid LEFT JOIN vendoraddresses ON vendoraddresses.id=vendors.id WHERE cylinder.vendoraddid='$fristaddid' AND cylinder.status=1");

  if($sql){
    $sql2=pg_fetch_assoc($sql);

            
    $my1[] = $sql2;
  

}
}
elseif($distance>3 && $distance<=5){

$secondaddid=$i_value['id'];

  $sql1=pg_query($db,"SELECT * from cylinder LEFT JOIN petroleum ON petroleum.id=cylinder.petroleumid LEFT JOIN  vendors ON vendors.id=cylinder.vendorid LEFT JOIN vendoraddresses ON vendoraddresses.id=vendors.id WHERE cylinder.vendoraddid='$secondaddid' AND cylinder.status=1");

  if($sql1){
    $sql2=pg_fetch_assoc($sql1);
       $my2[]= $sql2;
            
    
}
}
}
}
}
// $my3[].array_push({"aa":$my1});
// $my3[]=$my2;
array_push($my3, (object)[
        'frist3km' => $my1,
        'upto5km' => $my2,
    
]);

echo json_encode($my3);
}else{
  echo"error";
}

?>