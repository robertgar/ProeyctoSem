<?php
include"conexion.php";
session_start();

if($_POST["id"]=='Admin'){
$data[] = array(  
  	'v2' => '$v2' );	
echo json_encode($data);
}else{
$query = "SELECT `user`, `pass` FROM `lon` WHERE `user`='".$_POST["id"]."'";

$result = mysqli_query($conection, $query);

$data = array();
$v1 = '';
$v2 = 'ERROR';

if(mysqli_num_rows($result) > 0)
{

 while($row = mysqli_fetch_assoc($result))
 {
$v1 = $row["pass"];

if ($row["pass"]==$_POST["id1"]) {
	$v2 = $row["user"];
	$_SESSION['username'] = $v2;
} else {
$v2="ERROR";
}
  $data[] = array(  
  	'v2' => $v2);
 
  	}
 echo json_encode($data);
}else{
$data[] = array(  
  	'v2' => $v2 );	
echo json_encode($data);	

}
}
?>