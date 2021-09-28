<?php
include"conexion.php";
$v11 = '';
$v1 = '';
$v2 = '';
$re = '';


$query = "SELECT `id`,`fk_sol` FROM `tbl_serv` WHERE `fkdetame` IS NULL AND `fk_sol`=5";
$result = mysqli_query($conection, $query);
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
$v11 = $row["id"];
$v2 = $row["fk_sol"];
$re=$v1;
}

$query1 = "UPDATE `tbl_serv` SET `fkdetame`='".$v1."' WHERE `id`=".$_POST["v4"];
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

}
?>