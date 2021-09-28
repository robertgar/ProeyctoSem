<?php
include"conexion.php";
$v1 = '';
$re = '';

$query1 = "INSERT INTO medico (id_me, nom_me, tele_me, fk_es) VALUES ('".$_POST["v2"]."', '".$_POST["v3"]."', '".$_POST["v4"]."', '".$_POST["id"]."')";
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



