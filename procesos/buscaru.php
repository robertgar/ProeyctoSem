<?php
include"conexion.php";
session_start();


$query = "SELECT `user`, `pass`,fk_medico FROM `login` WHERE `user`='".$_POST["id"]."'";

$result = mysqli_query($conection, $query);

$data = array();
$v1 = '';
$v3 = '';
$v2 = 'ERROR';

if(mysqli_num_rows($result) > 0)
{

 while($row = mysqli_fetch_assoc($result))
 {
$v1 = $row["pass"];

if ($row["pass"]==$_POST["id1"]) {
	$v2 = $row["user"];
	$v3 = $row["fk_medico"];
	$_SESSION['username'] = $v2;
	$_SESSION['userid'] = $v3;
} else {
$v2="ERROR";
}



  $data[] = array(  
  	'v2' => $v2,
  	'v3' => $v3);
 
  	}
 echo json_encode($data);
}else{
$data[] = array(  
  	'v2' => $v2,
  	'v3' => $v3);	
echo json_encode($data);	

}
?>