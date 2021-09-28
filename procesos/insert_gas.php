<?php
include"conexion.php";

$re = '';

$query1 = "INSERT INTO `detalle_gasto`(`monto`, `fecha_pago`, `mes`, `fk_tgasto`) VALUES(".$_POST["v2"].",'".$_POST["v11"]."',".$_POST["v3"].",".$_POST["id"].")";
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