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
    <div class="panel-heading">Donaciones</div>
    <div class="panel-body">

       <br><br>


      <div class="row">
      
        <div class="col-xs-6 form-group">
          <label>Fecha</label>
          <input class="form-control" type="date" id="fec_pp" />
        </div>
        <div class="col-xs-6 form-group">
          <label>Monto</label>
          <input class="form-control" type="number" id="nomt_pp"/>
        </div>
        
         <div class="col-xs-6 form-group">
          <label>Tipo Donate:</label>
          <select  class="form-control" id="tdona_pp" onchange="myFunction()">
           <option value="1">E. Internacional</option>
            <option value="2">E. Nacional</option>
            <option value="3">P. Particular</option>
      </select>
        </div>
        <div class="col-xs-6 form-group" id="dpi_mpp">
          <label id="dpi_md">Codigo:</label>
          <input class="form-control" type="number" onKeyPress="if(this.value.length==13) return false;" id="dpi_pp"/>
        </div>
         <div class="col-xs-6 form-group">
          <label>Nombre:</label>
          <input class="form-control" type="text" id="nom_pp" readonly/>
        </div>
        <div class="col-xs-6 form-group">
          <label>Direccion:</label>
          <input class="form-control" type="text" id="dire_pp" readonly/>
        </div>
        <div class="col-xs-6 form-group">
          <label>Telefono:</label>
          <input class="form-control" onKeyPress="if(this.value.length==8) return false;"  id="tel_pp" type="number" readonly/>
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
  function myFunction() {
  var x = document.getElementById("tdona_pp").value;
  if (x=="3") {
document.getElementById("dpi_md").innerHTML = "DPI:";
  }else {
      document.getElementById("dpi_md").innerHTML = "Codigo:";
    }
}

$( "#dpi_pp" ).keypress(function( event ) {
var keycode = (event.keyCode ? event.keyCode : event.which);
var val1 = $("#dpi_pp").val();
    if(keycode == '13'){
        $("#nom_pp").val("");
        $("#dire_pp").val("");
        $("#tel_pp").val("");
      $.ajax({
    url : 'procesos/b_per.php',
    data : { id :val1 },
    type : 'POST',
    dataType : 'json',
    success : function(json) {
if(json[0].v1==""){
        const v1 = document.querySelector('#nom_pp');
        const v2 = document.querySelector('#dire_pp');
        const v3 = document.querySelector('#tel_pp');
        v1.removeAttribute("readonly");
        v2.removeAttribute("readonly");
        v3.removeAttribute("readonly");
      }else{
        $("#nom_pp").val(json[0].v2);
        $("#dire_pp").val(json[0].v3);
        $("#tel_pp").val(json[0].v4);

      }
    },
    error : function(xhr, status) {
        alert('Disculpe, existió un problema');
    }
});
        
    }
});



$( "#guar" ).click(function( event ) {
var v1=$("#tdona_pp option:selected").val();

if($("#fec_pp").val()=='' ||
  $("#dpi_pp").val()=='' ||
  $("#nomt_pp").val()=='' ||
  $("#nom_pp").val()=='' ||
  $("#dire_pp").val()=='' ||
  $("#tel_pp").val()==''){
alert("Campos vacios");
}else{

  var v111=$("#fec_pp").val();
  var v22=$("#nomt_pp").val();
  var v33=$("#dpi_pp").val();
var v44=$("#nom_pp").val();
var v55=$("#dire_pp").val();
var v66=$("#tel_pp").val();
      $.ajax({
    url : 'procesos/inset_dona.php',
    data : { id :v1,
     v11 :v111, 
     v2 :v22,
     v3 :v33,
     v4 :v44,
     v5 :v55,
     v6 :v66 },
    type : 'POST',
    dataType : 'json',
    success : function(json) { 

if(json[0].v1=="true"){
  alert("Insertado correctamente");
        var url = "donaciones.php";    
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