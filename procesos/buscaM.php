<?php
include"conexion.php";


$query = "SELECT `id_me`,`nom_me` FROM `medico` WHERE `fk_es`=".$_POST["id"];

$result = mysqli_query($conection, $query);

$data = array();
$v1 = '';
$v2 = '';

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
$v1 = $row["id_me"];
$v2 = $row["nom_me"];


  $data[] = array( 
  	'v1' => $v1, 
  	'v2' => $v2);
 
  	}
 echo json_encode($data);
}else{
$data[] = array( 
  	'v1' => $v1, 
  	'v2' => $v2 );	
echo json_encode($data);	
}

?>