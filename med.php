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
    <div class="panel-heading">Medicos</div>
    <div class="panel-body">
 <a href="medin.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-plus"></span> Nuevo 
        </a>
     <h1>Lista de Medicos</h1>
        <table class="table table-condensed">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Especialidad</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT id_me, nom_me, tele_me, esp FROM medico INNER JOIN especialidad ON fk_es =id";
$query_so =  mysqli_query($conection,$sql);
 $result_sol= mysqli_num_rows($query_so);
if ($result_sol > 0) {
  // output data of each row
  while($row =  mysqli_fetch_array($query_so)) {
    ?>
                    <tr class="row<?php echo $row['id_me'];?>">
              <td><?php echo $row["id_me"];?></td>
           <td><?php echo $row["nom_me"];?></td>
           <td><?php echo $row["tele_me"];?></td>
           <td><?php echo $row["esp"];?></td>
            <td>
              <button type="button" class="btn btn-danger" onclick="myFunction(<?php echo $row['id_me'];?>)">  <span class="glyphicon glyphicon-trash"></span></button>
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