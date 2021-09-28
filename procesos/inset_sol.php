<?php
include"conexion.php";
 /* $data[] = array( 
  	'v1' => $_POST["id"], 
  	'v2' => $_POST["v2"],
  	'v3' => $_POST["v3"], 
  	'v4' => $_POST["v4"],
  	'v5' => $_POST["v5"], 
  	'v6' => $_POST["v6"],
  	'v7' => $_POST["v7"], 
  	'v8' => $_POST["v8"],
  	'v9' => $_POST["v9"], 
  	'v10' => $_POST["v10"] );  
echo json_encode($data);*/




  



$v1 = '';
$re = '';
$query = "SELECT id_pa FROM paciente WHERE dpi_pa=".$_POST["v2"];
$result = mysqli_query($conection, $query);
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
$v1 = $row["id_pa"];
$re=$v1;
}
}else{
 $query3 = "INSERT INTO paciente(dpi_pa, nom_pa, fecna_pa, dire_pa, tele_pa, sexo_pa) VALUES (".$_POST["v2"].",'".$_POST["v3"]."','".$_POST["v4"]."','".$_POST["v5"]."',".$_POST["v6"].",'".$_POST["v7"]."')";

if(mysqli_query($conection, $query3)){
   $v1=mysqli_insert_id($conection);
  $re=$v1;
} else{
    $re= "ERROR";
}
}


$query1 = "UPDATE enfermero SET esta_en=1 WHERE id_en=".$_POST["id"];
$result1 = mysqli_query($conection, $query1);
if ($result1 === TRUE) {
   $re = "true";
} else {
  $re ="Error";
}


$query2 = "INSERT INTO sol(fk_pac, fk_enf, fecha, motivo_sol,est_sol) VALUES (".$v1.",".$_POST["id"].",'".$_POST["v10"]."','".$_POST["v8"]."',1)";
$result2 = mysqli_query($conection, $query2);
if ($result2 === TRUE) {
   $re ="true";
} else {
  $re ="Error".mysqli_error($conection);
}
$data[] = array( 
    'v1' => $re);  
echo json_encode($data); 

?>