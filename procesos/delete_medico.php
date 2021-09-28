<?php
include"conexion.php";
$v1 = '';
$re = '';

$query1 = "DELETE FROM `medico` WHERE `id_me`=".$_POST["id"];
$result1 = mysqli_query($conection, $query1);
if ($result1 === TRUE) {
   $re = "true";
} else {
  $re ="Error".mysqli_error($conection);
}

$data[] = array( 
    'v1' => $re);  
echo json_encode($data); 

?>