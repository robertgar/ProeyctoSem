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
    <div class="panel-heading">Resultados de Pacientes</div>
    <div class="panel-body">

     <h1>Resultados de Pacientes</h1>
        <table class="table table-condensed">
    <thead>
      <tr>
        <th>Dpi</th>
        <th>Nombre Pac.</th>
        <th>Nombre Enf.</th>
        <th>Tipo Examen</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT t.id AS id,p.dpi_pa AS dpi_pa, p.nom_pa AS nom_pa, en.nom_en AS nom_en, ex.nombre AS nombre_ex, t.fkdetaex AS fkdetaex,
      de.resultado_ex AS resultado_ex
FROM tbl_serv as t 
INNER JOIN sol AS s ON t.fk_sol=s.id_sol
INNER JOIN medico AS m ON s.fkmedico =m.id_me
INNER JOIN detalle_ex AS de ON t.fkdetaex=de.iddetaex
INNER JOIN examenes AS ex ON de.fk_exa=ex.idexa
INNER JOIN paciente  AS p ON s.fk_pac=p.id_pa
INNER JOIN enfermero AS en ON s.fk_enf=en.id_en";
$query_so =  mysqli_query($conection,$sql);
 $result_sol= mysqli_num_rows($query_so);
if ($result_sol > 0) {
  // output data of each row
  while($row =  mysqli_fetch_array($query_so)) {
 

    ?>
                    <tr class="row<?php echo $row['id'];?>">
              <td><?php echo $row["dpi_pa"];?></td>
           <td><?php echo $row["nom_pa"];?></td>
           <td><?php echo $row["nom_en"];?></td>
           <td><?php echo $row["nombre_ex"];?></td>
            <td>
              <?php 
              if ($row["resultado_ex"]=="") {
                ?>
                <a href="Revlab.php?id=<?php echo $row["fkdetaex"];?>" class="btn btn-info">
          <span class="glyphicon glyphicon-eye-open"></span></a>
          <?php
              } else {
                # code...
              }
              ?>
        </td>
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