<?php
include"conexion.php";


$query = "SELECT * FROM persona WHERE id_pers='".$_POST["id"]."'";

$result = mysqli_query($conection, $query);

$data = array();
$v1 = '';
$v2 = '';
$v3 = '';
$v4 = '';


if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
$v1 = $row["nom_pers"];
$v2 = $row["dire_pers"];
$v3 = $row["tel_pers"];
  $data[] = array(
    'v1' => $v1, 
  	'v2' => $v1, 
  	'v3' => $v2,
  	'v4' => $v3 );
  	}
 echo json_encode($data);
}else{
$data[] = array( 
  	'v1' => $v1, 
  	'v2' => $v1, 
  	'v3' => $v2,
  	'v4' => $v3  );	
echo json_encode($data);	
}

?>