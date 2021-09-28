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
    <div class="panel-heading">Gasto</div>
    <div class="panel-body">
 <a href="gastos.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-plus"></span> Nuevo 
        </a>
     <h1>Lista de Gatos Realizados</h1>
        <table class="table table-condensed">
    <thead>
      <tr>
        <th>TIPO GASTO R</th>
        <th>MES</th>
        <th>FECHA PAGO</th>
        <th>MONTO</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT `id_de`,`nom_tipo`,`mes`,`fecha_pago`,`monto` FROM `detalle_gasto` INNER JOIN `tipogasto` ON `fk_tgasto`=`id`";
$query_so =  mysqli_query($conection,$sql);
 $result_sol= mysqli_num_rows($query_so);
if ($result_sol > 0) {
  // output data of each row
  while($row =  mysqli_fetch_array($query_so)) {
    ?>
                    <tr class="row<?php echo $row['id_de'];?>">
              <td><?php echo $row["nom_tipo"];?></td>
           <td><?php 
           if ($row["mes"]=='1') {
             echo 'Enero';
           } else if ($row["mes"]=='2') {
             echo 'Febrero';
            } else if ($row["mes"]=='3') {
             echo 'Marzo';
             } else if ($row["mes"]=='4') {
             echo 'Abril';
             } else if ($row["mes"]=='5') {
             echo 'Mayo';
             } else if ($row["mes"]=='6') {
             echo 'Junio';
             } else if ($row["mes"]=='7') {
             echo 'Julio';
             }else if ($row["mes"]=='8') {
             echo 'Agosto';
             } else if ($row["mes"]=='9') {
              echo 'Septiembre';
              }else if ($row["mes"]=='10') {
             echo 'Octubre';
             } else if ($row["mes"]=='11') {
              echo 'Noviembre';

           }else{
            echo 'Diciembre';
           }
           


           ?></td>
           <td><?php echo $row["fecha_pago"];?></td>
           <td><?php echo $row["monto"];?></td>
            <td>
              <button type="button" class="btn btn-danger" onclick="myFunction(<?php echo $row['id_de'];?>)">  <span class="glyphicon glyphicon-trash"></span></button>
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
<script type="text/javascript">
function myFunction(a) {


      $.ajax({
    url : 'procesos/delete_medico.php',
    data : { id :a},
    type : 'POST',
    dataType : 'json',
    success : function(json) { 

if(json[0].v1=="true"){
   alert("Eliminado");
       var url = "med.php";    
$(location).attr('href',url);
      }else{
        alert("Error");
       
      }
    },
    error : function(xhr, status) {

        alert('Disculpe, existie un problema');
    }
});
}
</script>
 <?php 
}
?>