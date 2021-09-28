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
  <div class="wrapper"> 
  <div class="panel panel-success">
    <div class="panel-heading">Cobros A Pacientes</div>
    <div class="panel-body">

     <h1>Lista de Cobros</h1>
        <table class="table table-condensed">
    <thead>
      <tr>
        <th>Dpi</th>
        <th>Nombre Pac.</th>
        <th>Total</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT s.id_sol AS id,p.dpi_pa AS DPI, p.nom_pa AS nombre,  
       t.esta_cu AS estado, SUM(ex.precio_ex+me.precio_me)AS total
FROM tbl_serv as t 
INNER JOIN sol AS s ON t.fk_sol=s.id_sol
INNER JOIN detalle_ex AS de ON t.fkdetaex=de.iddetaex
INNER JOIN examenes AS ex ON de.fk_exa=ex.idexa
INNER JOIN detalle_me AS dm ON t.fkdetame=dm.iddeme
INNER JOIN medicina AS me ON dm.fkmed=me.idmed
INNER JOIN paciente  AS p ON s.fk_pac=p.id_pa
GROUP BY s.id_sol";
$query_so =  mysqli_query($conection,$sql);
 $result_sol= mysqli_num_rows($query_so);
 

if ($result_sol > 0) {
  // output data of each row
  while($row =  mysqli_fetch_array($query_so)) {
 

    ?>
                    <tr class="row<?php echo $row['id'];?>">
              <td><?php echo $row["DPI"];?></td>
           <td><?php echo $row["nombre"];?></td>
           <td><?php echo $row["total"];?></td>
            <td>
              <?php 
              if ($row["estado"]==1) {

                ?>
              <a class="btn btn-success">
          <span>Cancelado</span></a>
          <?php
              } else {
              ?>
              <a href="horarios.php?id=<?php echo $row["id_sol"];?>" class="btn btn-danger">
          <span class="glyphicon glyphicon-usd"></span></a>
          <?php
              }
              ?>
              </tr>
                 <?php
  }
} else {
  ?>
  
   <tr>
        <td>No</td>
        <td>hay</td>
        <td>datos</td>
        <td>disponible</td>
        <td></td>
      </tr>
      <?php
}

?>
     
      
    </tbody>
  </table>
    </div>
  </div>
  </div>
</div>
</body>
</html>
 <?php 
}
?>