<?php
include"conexion.php";


$query = "SELECT * FROM `paciente` WHERE `dpi_pa`=".$_POST["id"];

$result = mysqli_query($conection, $query);

$data = array();
$v1 = '';
$v2 = '';
$v3 = '';
$v4 = '';
$v5 = '';
$v6 = '';
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
$v1 = $row["dpi_pa"];
$v2 = $row["nom_pa"];
$v3 = $row["fecna_pa"];
$v4 = $row["dire_pa"];
$v5 = $row["tele_pa"];
$v6 = $row["sexo_pa"];

  $data[] = array( 
  	'v1' => $v1, 
  	'v2' => $v2,
  	'v3' => $v3, 
  	'v4' => $v4,
  	'v5' => $v5, 
  	'v6' => $v6 );
  	}
 echo json_encode($data);
}else{
$data[] = array( 
  	'v1' => $v1, 
  	'v2' => $v2,
  	'v3' => $v3, 
  	'v4' => $v4,
  	'v5' => $v5, 
  	'v6' => $v6 );	
echo json_encode($data);	
}

?>