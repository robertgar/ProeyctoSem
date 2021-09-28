<?php

$host='MYSQL5031.site4now.net';
$user='a54053_clinica';
$password='Lamchay2021';
$db='db_a54053_clinica';
$conection=@mysqli_connect($host,$user,$password,$db);
//mysqli_close($conection);
if (!$conection) {
	echo "Error en la conexion";
}

?>
