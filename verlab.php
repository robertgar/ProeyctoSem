<?php
session_start();
$v1;
$s1;
$ex1;
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
<style type="text/css">
  .re {
  border-radius: 50px;
}
</style>
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
$sql1 = "SELECT p.dpi_pa AS dpi_pa, fk_sol
FROM tbl_serv as t 
INNER JOIN sol AS s ON t.fk_sol=s.id_sol
INNER JOIN paciente AS p ON s.fk_pac=p.id_pa where t.id=".$_GET["id"];
$query_pa1 =  mysqli_query($conection,$sql1);
$result_sol1= mysqli_num_rows($query_pa1);
if ($result_sol1 > 0) {
  while($row2 =  mysqli_fetch_array($query_pa1)) {
    $v1=$row2 ['dpi_pa'];
    $s1=$row2 ['fk_sol'];
  }
}else{

}
?>
<div class="content">
 <br>
  <div class="wrapper"> 
         <?php 
$sql = "SELECT s.fecha AS fecha, s.motivo_sol AS Motivo, m.nom_me AS NombreM, m.tele_me AS Tel, e.esp AS especialidad, ex.nombre AS exnom, de.resultado_ex AS exresul, de.fecha_ex AS exfec, me.nom_med AS NombreMe, dm.tiem AS Tiemp, dm.cant AS canti FROM tbl_serv as t 
INNER JOIN sol AS s ON t.fk_sol=s.id_sol 
INNER JOIN medico AS m ON s.fkmedico =m.id_me 
INNER JOIN especialidad AS e ON m.fk_es =e.id 
INNER JOIN detalle_ex AS de ON t.fkdetaex=de.iddetaex 
INNER JOIN examenes AS ex ON de.fk_exa=ex.idexa 
INNER JOIN detalle_me AS dm ON t.fkdetame=dm.iddeme
INNER JOIN paciente AS p ON s.fk_pac=p.id_pa 
INNER JOIN medicina AS me ON dm.fkmed=me.idmed Where de.resultado_ex !='' AND dm.tiem !='' AND p.dpi_pa=".$v1;
$query_pa =  mysqli_query($conection,$sql);
$result_sol= mysqli_num_rows($query_pa);
if ($result_sol > 0) {
 while($row1 =  mysqli_fetch_array($query_pa)) {
?>
    <div class="panel panel-success">
    <div class="panel-heading">Ficha</div>
    <div class="panel-body">
   
     <div class="container"> 
 <h4>Fecha de visita: <?php echo $row1 ['fecha'];?></h4>
 <h4>Motivo de visita: <?php echo $row1 ['Motivo'];?></h4>
  <div class="row">
    <div class="col-sm-5">
  <fieldset >
  <legend>Datos Medico:</legend>
  <label >Nombre:</label>
  <h4><?php echo $row1 ['NombreM'];?></h4>
  <label>Telefono:</label>
  <h4><?php echo $row1 ['Tel'];?></h4>
  <label>Especialidad:</label>
  <h4><?php echo $row1 ['especialidad'];?></h4>
 </fieldset>
    </div>
    <div class="col-sm-5" >
   <fieldset >
  <legend>Examenes realizados:</legend>
  <label >Nombre:</label>
  <h4><?php echo $row1 ['exnom'];?></h4>
  <label>Resultado:</label>
  <h4><?php echo $row1 ['exresul'];?></h4>
  <label>Fecha:</label>
  <h4><?php echo $row1 ['exfec'];?></h4>
 </fieldset>  
    </div>
    <div class="col-sm-5">
  <fieldset>
  <legend>Medicamentos Aplicados:</legend>
  <label >Nombre:</label>
  <h4><?php echo $row1 ['NombreMe'];?></h4>
  <label>Tiempo Aplicado:</label>
  <h4><?php echo $row1 ['Tiemp'];?></h4>
  <label>Cantidad:</label>
  <h4><?php echo $row1 ['canti'];?></h4>
 </fieldset>
      </div>
  </div>
</div>

    </div>
  </div>
 <?php
}
}else{
?>
<div class="panel panel-primary">
      <div class="panel-heading">Ficha</div>
      <div class="panel-body"><h1>No hay datos</h1></div>
    </div>

<?php
}

?>
  </div>

   <div class="panel panel-primary" id="ex_pp">
      <div class="panel-heading">Examen</div>
      <div class="panel-body">
        <?php 
            $query_enf = mysqli_query($conection,"SELECT ex.nombre AS nombre, de.resultado_ex AS resultado
              FROM tbl_serv as t 
              INNER JOIN sol AS s ON t.fk_sol=s.id_sol
              INNER JOIN medico AS m ON s.fkmedico =m.id_me
              INNER JOIN detalle_ex AS de ON t.fkdetaex=de.iddetaex
              INNER JOIN examenes AS ex ON de.fk_exa=ex.idexa
              WHERE  m.id_me=".$idus);
            $result_enf= mysqli_num_rows($query_enf);
            
                 if ($result_enf > 0) {
                    while ($enf = mysqli_fetch_array($query_enf)) {
                        ?>
                         <fieldset >
  <legend>Datos Examen:</legend>
  <label >Nombre:</label>
  <h4><?php echo $enf ['nombre'];?></h4>
  <label>Resultado:</label>
  <h4><?php echo $enf ['resultado'];?></h4>
 </fieldset>
                     <?php  
                    }
                 }else{
                  ?>
                  <option value="0">No hay </option>
                  <?php
                 }
                ?>
      </div>
    </div>
<button class="btn btn-warning btn-lg redondeado" onclick="myFunction()"><span class="glyphicon glyphicon-plus"></span> Agregar Medicamento</button>
<br><br>
<div class="panel panel-primary" id="me_pp" style="display:none">
      <div class="panel-heading">Medicamento</div>
      <div class="panel-body">
        <?php 
            $query_enf = mysqli_query($conection,"SELECT `idmed`,`nom_med` FROM `medicina`");
            $result_enf= mysqli_num_rows($query_enf);
            ?>
          <label>Medicamento</label>
          <select class="re form-control " id="pme_pp">
              <?php
                 if ($result_enf > 0) {
                    while ($enf = mysqli_fetch_array($query_enf)) {
                        ?>
                         <option value="<?php echo $enf ['idmed'];?>"><?php echo $enf['nom_med']; ?></option>
                     <?php  
                    }
                 }else{
                  ?>
                  <option value="0">No hay </option>
                  <?php
                 }
                ?>
      </select>
      <label>Cantidad</label>
          <input class="form-control" type="number" id="mca_pp"/>
       <label>Tiempo</label>
          <textarea class="form-control" id="mt_pp">
  </textarea>
      <br><br>
      <button type="button" class="btn btn-success" id="guar"> Agregar</button>
      
      </div>
    </div>
</div>
</body>
</html>

<script>
function myFunction() {

  var x = document.getElementById("me_pp");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

$( "#guar" ).click(function( event ) {
var v1=$("#pme_pp option:selected").val();

if($("#mca_pp").val()=='' ||
  $("#mt_pp").val()==''){
alert("Campos vacios");
}else{
  var v22=$("#mca_pp").val();
var v33=$("#mt_pp").val();
      $.ajax({
    url : 'procesos/insert_me.php',
    data : { id :v1, 
      v2 :v22,
      v3 :v33,
     v4 :<?php echo $s1;?>,
     v5 :<?php echo $_GET["id"];?>, },
    type : 'POST',
    dataType : 'json',
    success : function(json) { 
      if(json[0].v1=="true"){
        var mensaje;
        var opcion = confirm("Insertado correctamente\nDesea agregar otro examen");
        if (opcion == true) {
          $("#mca_pp").val("");
          $("#mt_pp").val("");
        } else {
          var url = "lab.php";    
          $(location).attr('href',url);
        }
       }else{
        alert("Error");
        console.log(json);
      }
    },
    error : function(xhr, status) {
        alert('Disculpe, existie un problema');
    }
});
}
});
</script>
 <?php 
}
?>