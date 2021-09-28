<?php
include"conexion.php";
$v1 = '';
$re = '';



$query2 ="UPDATE `sol` SET `est_sol`=3 WHERE `id_sol`=".$_POST["v2"];

if(mysqli_query($conection, $query2)){
   $v1="true";
  $re=$v1;
} else{
    $re= "ERROR";
}


$query ="INSERT INTO detalle_ex(fk_exa) VALUES(".$_POST["id"].")";
 

if(mysqli_query($conection, $query)){
   $v1=mysqli_insert_id($conection);
  $re=$v1;
} else{
    $re= "ERROR";
}


$query1 = "INSERT INTO tbl_serv(fk_sol, fkdetaex) VALUES('".$_POST["v2"]."','".$v1."')";
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
