<?php
include"conexion.php";
$v11 = '';
$v12 = '';
$v1 = '';
$re = '';


$query ="INSERT INTO `detalle_me`( `fkmed`, `tiem`, `cant`) VALUES ('".$_POST["id"]."','".$_POST["v3"]."','".$_POST["v2"]."')";
 

if(mysqli_query($conection, $query)){
   $v1=mysqli_insert_id($conection);
  $re=$v1;
} else{
    $re= "ERROR";
}


$query2 = "SELECT `id`,`fkdetaex` FROM `tbl_serv` WHERE `fkdetame` IS NULL AND `fk_sol`=".$_POST["v4"];
$result2 = mysqli_query($conection, $query2);
if(mysqli_num_rows($result2) > 0)
{
 while($row2 = mysqli_fetch_assoc($result2))
 {
$v11 = $row2["id"];
$v12 = $row2["fkdetaex"];
$re=$v11;
}
 
$query1 = "UPDATE `tbl_serv` SET `fkdetame`='".$v1."' WHERE `id`=".$v11;
$result1 = mysqli_query($conection, $query1);
if ($result1 === TRUE) {
   $re = "true";
} else {
  $re ="Error".mysqli_error($conection);
}
$data[] = array( 
    'v1' => $re);  
echo json_encode($data);


}else{
$data[] = array( 
    'v1' => $re);  
echo json_encode($data); 
}
?>
