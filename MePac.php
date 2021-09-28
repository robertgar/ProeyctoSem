<?php
session_start();
   include"procesos/conexion.php";
 $idus=$_SESSION['userid'];
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
include"menu2.php";
?>

<div class="content">
 <br><br>
  <div class="wrapper"> 
  <div class="panel panel-success">
    <div class="panel-heading">Pacientes</div>
    <div class="panel-body">

     <h1>Lista de Pacientes</h1>
        <table class="table table-condensed">
    <thead>
      <tr>
        <th>Dpi</th>
        <th>Nombre Pac.</th>
        <th>Nombre Enf.</th>
        <th>Motivo</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT s.id_sol AS id_sol,p.dpi_pa AS dpi_pa,p.nom_pa AS nom_pa, e.nom_en AS nom_en,s.fecha_c AS fecha_c,s.motivo_sol AS motivo_sol,h.hora AS hora,s.est_sol AS est_sol FROM sol AS s
INNER JOIN medico AS m ON s.fkmedico= m.id_me
INNER JOIN horario AS h ON s.fkhora=h.idhora
INNER JOIN paciente AS p ON s.fk_pac=p.id_pa
INNER JOIN enfermero AS e ON s.fk_enf=e.id_en
 WHERE m.id_me=".$idus;
 
$query_so =  mysqli_query($conection,$sql);
 $result_sol= mysqli_num_rows($query_so);
if ($result_sol > 0) {
  // output data of each row
  while($row =  mysqli_fetch_array($query_so)) {
 

    ?>
                    <tr class="row<?php echo $row['id_sol'];?>">
              <td><?php echo $row["dpi_pa"];?></td>
           <td><?php echo $row["nom_pa"];?></td>
           <td><?php echo $row["nom_en"];?></td>
           <td><?php echo $row["motivo_sol"];?></td>
           <td><?php echo $row["fecha_c"];?></td>
           <td><?php echo $row["hora"];?></td>
            <td><?php
            if ($row["est_sol"]==3) {
              ?>
              <a class="btn btn-primary">Atendio</a></td>
              <?php
            } else {
              ?>
              <a href="verpac.php?id=<?php echo $row["id_sol"];?>" class="btn btn-info">
          <span class="glyphicon glyphicon-eye-open"></span></a></td>
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