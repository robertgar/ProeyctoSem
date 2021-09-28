<?php
include"conexion.php";
$v1 = '';
$re = '';

$query1 = "INSERT INTO enfermero(codigo_en, nom_en, tele_en, esta_en) VALUES ('".$_POST["id"]."', '".$_POST["v3"]."', '".$_POST["v4"]."', '0')";
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
