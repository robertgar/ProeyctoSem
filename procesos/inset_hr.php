<?php
include"conexion.php";
$v1 = '';
$re = '';

$query1 = "UPDATE `sol` SET fecha_c='".$_POST["v2"]."',fkmedico = '".$_POST["id"]."', fkhora=".$_POST["v3"].", est_sol=2 WHERE id_sol=".$_POST["v4"];
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



