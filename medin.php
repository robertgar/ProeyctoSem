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

       <br><br>


      <div class="row">
      
        <div class="col-xs-6 form-group">
          <label>Codigo</label>
          <input class="form-control" type="text" id="cod_pp" />
        </div>
        <div class="col-xs-6 form-group">
          <label>Nombre</label>
          <input class="form-control" type="text" id="nom_pp"/>
        </div>
        
         
         <div class="col-xs-6 form-group">
          <label>Telefono</label>
          <input class="form-control" type="text" id="tel_pp"/>
        </div>
         <div class="col-xs-6 form-group">
          <label>Especialidad</label>
          <select  class="form-control" id="esp_pp">
           <option value="1">Cirugia</option>
            <option value="2">Radiologia</option>
            <option value="3">Medicina fisica y rehabilitacion</option>
            <option value="4">Infectologia</option>
      </select>
        </div>
<br><br>
      </div>
      <div class="col-xs-6 form-group">
          <button class="btn btn-lg btn-primary" id="guar">Registrar</button>
        </div>
    </div>
  </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
$( "#guar" ).click(function( event ) {
var v1=$("#esp_pp option:selected").val();

if($("#fc_pp").val()=='' ||
  $("#cod_pp").val()=='' ||
  $("#tel_pp").val()==''){
alert("Campos vacios");
}else{
var v22=$("#cod_pp").val();
var v33=$("#nom_pp").val();
var v44=$("#tel_pp").val();
      $.ajax({
    url : 'procesos/inset_Medico.php',
    data : { id :v1, 
     v2 :v22,
     v3 :v33,
     v4 :v44 },
    type : 'POST',
    dataType : 'json',
    success : function(json) { 
console.log(json);
if(json[0].v1=="true"){
  alert("Insertado correctamente");
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
});
</script>
 <?php 
}
?>