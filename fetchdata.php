<?php

include'../database/db.php';

$searchTerm = $_POST['term'];

echo"SELECT * FROM cylindertype WHERE type  LIKE '%".$searchTerm."%'  ORDER BY id ASC";
// Get matched data from skills table
$query = pg_query($db,"SELECT * FROM cylindertype WHERE type  LIKE '%".$searchTerm."%'  ORDER BY id ASC");

// Generate skills data array
$skillData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_array()){
    	
        $data['id'] =$row['id'];
        $data['value'] =$row['type'];
        array_push($skillData,$data);
    }
}

// Return results as json encoded array
echo json_encode($skillData);

?>