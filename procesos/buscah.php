<?php
include"conexion.php";


$query = "SELECT * FROM `horario` WHERE `idhora` NOT IN (SELECT `fkhora` FROM `sol` WHERE `fecha_c`='".$_POST["id"]."' AND fkmedico=".$_POST["id1"] .")";

$result = mysqli_query($conection, $query);

$data = array();
$v1 = '';
$v2 = '';

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
$v1 = $row["idhora"];
$v2 = $row["hora"];


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