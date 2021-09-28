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
    <div class="panel-heading">Examenes Medicos por pacientes</div>
    <div class="panel-body">
 
     <h1>Lista de Examenes Medicos por pacientes</h1>
        <table class="table table-condensed">
    <thead>
      <tr>
        <th>DPI PACIENTE</th>
        <th>NOMBRE PACIENTE</th>
        <th>FECHA</th>
        <th>ACCION</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT s.id_sol AS sid,p.dpi_pa AS dpi_pa, p.nom_pa AS nom_pa,s.fecha_c AS fecha FROM tbl_serv as t 
      INNER JOIN sol AS s ON t.fk_sol=s.id_sol 
      INNER JOIN detalle_ex AS de ON t.fkdetaex=de.iddetaex 
      INNER JOIN examenes AS ex ON de.fk_exa=ex.idexa 
      INNER JOIN paciente AS p ON s.fk_pac=p.id_pa
      GROUP BY s.id_sol";
$query_so =  mysqli_query($conection,$sql);
 $result_sol= mysqli_num_rows($query_so);
if ($result_sol > 0) {
  // output data of each row
  while($row =  mysqli_fetch_array($query_so)) {
    ?>
                    <tr class="row<?php echo $row['sid'];?>">
              <td><?php echo $row["dpi_pa"];?></td>
           <td><?php echo $row["nom_pa"];?></td>
           <td><?php echo $row["fecha"];?></td>
           <td><a href="reportes/repexpac.php?id=<?php echo $row["sid"];?>" class="btn btn-info btn-lg" target="_blank">
          <span class="fa fa-file-pdf-o"></span> Generar PDF 
        </a></td>
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