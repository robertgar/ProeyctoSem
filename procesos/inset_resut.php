<?php
include"conexion.php";
$v1 = '';
$re = '';

$query1 = "UPDATE `detalle_ex` SET `resultado_ex`='".$_POST["id"]."' WHERE `iddetaex`=".$_POST["v2"];
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