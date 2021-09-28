<?php

include"conexion.php";



$v1 = '';
$re = '';
$query = "SELECT * FROM persona WHERE id_pers='".$_POST["v3"]."'";
$result = mysqli_query($conection, $query);
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
$v1 = $row["id"];
$re=$v1;
}
}else{
 $query3 = "INSERT INTO `persona`(`id_pers`, `nom_pers`, `dire_pers`, `tel_pers`,`t_persona`) VALUES ('".$_POST["v3"]."','".$_POST["v4"]."','".$_POST["v5"]."',".$_POST["v6"].",".$_POST["id"].")";

if(mysqli_query($conection, $query3)){
   $v1=mysqli_insert_id($conection);
  $re=$v1;
} else{
    $re= "ERROR";
}
}



$query2 = "INSERT INTO `ingreso`(`fecha`, `monto`, `fk_tipoingreso`, `fk_donante`) VALUES ('".$_POST["v11"]."',".$_POST["v2"].",2,".$v1.")";
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