<?php
session_start();
   include"procesos/conexion.php";

   if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit;
} else {
  ?>


<!DOCTYPE html>
<html>
<head>
<title>Nueva Vida</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="estil.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include"menu.php";
?>

<div class="content">
<br><br>

<div class="container">
     <br><br>
  <div class="row">
    <div class="col-sm-4" >
      <div class="panel panel-primary">
      <div class="panel-heading">Solicitud Pacientes</div>
      <div class="panel-body"><span class="glyphicon glyphicon-user"style="font-size:62px">
        <?php 
$sql = "SELECT COUNT(`fk_pac`) AS numero FROM `sol` WHERE `est_sol`=1";
$query_pa =  mysqli_query($conection,$sql);
 while($row1 =  mysqli_fetch_array($query_pa)) {
 echo $row1 ['numero'];
}
?>
</span>

      </div>
    </div>
    </div>
    <div class="col-sm-4" >
     <div class="panel panel-primary">
      <div class="panel-heading">Medicos</div>
      <div class="panel-body"><span class="glyphicon glyphicon-user"style="font-size:62px">
          <?php 
$sql = "SELECT COUNT(`id_me`) AS numero  FROM `medico` ";
$query_pa =  mysqli_query($conection,$sql);
 while($row1 =  mysqli_fetch_array($query_pa)) {
 echo $row1 ['numero'];
}
?>
      </span></div>
    </div>    
    </div>
  </div>
      <br><br>
  <div class="row">
    <div class="col-sm-4" >
      <div class="panel panel-primary">
      <div class="panel-heading">Enfermeros</div>
      <div class="panel-body"><span class="glyphicon glyphicon-user"style="font-size:62px">
          <?php 
$sql = "SELECT COUNT(`id_en`) AS numero  FROM `enfermero` ";
$query_pa =  mysqli_query($conection,$sql);
 while($row1 =  mysqli_fetch_array($query_pa)) {
 echo $row1 ['numero'];
}
?>
      </span></div>
    </div>
    </div>
  
  </div>

</div>
</div>
</body>
</html>
  <?php 
}
?>