<?php

$host='localhost';
$user='root';
$password='';
$db='clinica';
$conection=@mysqli_connect($host,$user,$password,$db);
//mysqli_close($conection);
if (!$conection) {
	echo "Error en la conexion";
}

?>