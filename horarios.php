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
  <?php 
$sql = "SELECT nom_pa,fecha,motivo_sol FROM sol inner join paciente on sol.fk_pac=paciente.id_pa Where id_sol=".$_GET["id"];
$query_pa =  mysqli_query($conection,$sql);
 while($row1 =  mysqli_fetch_array($query_pa)) {
?>
 <h1>Paciente: <?php echo $row1 ['nom_pa'];?></h1>
 <h3>Motivo: <?php echo $row1 ['motivo_sol'];?></h3>
 <h3>Fecha solicitud: <?php echo $row1 ['fecha'];?></h3>
<?php
}
?>
  <div class="wrapper"> 
    
        
    
    <div class="panel panel-success">
    <div class="panel-heading">Medico</div>
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-6 form-group">
         <label>Especialidad</label>
          <select  class="form-control" id="esp_pc">
           <option value="1">Cirugia</option>
            <option value="2">Radiologia</option>
            <option value="3">Medicina fisica y rehabilitacion</option>
            <option value="4">Infectologia</option>
      </select>
    </div>
         <div class="col-xs-6 form-group">
  
          <label>Medicos</label>
          <select class="form-control" id="me_pp">
      </select>
      </div>
        </div>
    </div>
  </div>

    <div class="panel panel-success">
    <div class="panel-heading">Horarios</div>
    <div class="panel-body">
      <div class="row">
      <div class="col-xs-6 form-group">
          <label>Fecha</label>
          <input class="form-control" type="date" id="fc_pp" />
        </div>
         <div class="col-xs-6 form-group">
          <label>Horario</label>
          <select  class="form-control" id="hr_pp">
      </select>
      </div>
        </div>
    </div>
  </div>
  </div>

  <button class="btn btn-primary btn-lg" id="guar">Guardar</button>
</div>
</body>
</html>

<script>
  $('#esp_pc').on('change', function() {
 var v1=$("#esp_pc").val();

   $.ajax({
        type: 'POST',
        url: 'procesos/buscaM.php',
        data: { id :v1},
        dataType: 'json',
        success : function(json) {

            var option; 
            for(let i = 0; i < json.length; i++){
              option += '<option value ='+json[i].v1+'>'+json[i].v2+'</option>';
            }
            $('#me_pp').html(option).show();
        }   
    })
});

 $('#fc_pp').on('change', function() {
 var v1=$("#fc_pp").val();
 var v2=$("#me_pp").val();
   $.ajax({
        type: 'POST',
        url: 'procesos/buscah.php',
        data: { id :v1, id1 :v2 },
        dataType: 'json',
        success : function(json) {
            var option; 
            for(let i = 0; i < json.length; i++){
              option += '<option value ='+json[i].v1+'>'+json[i].v2+'</option>';
            }
            $('#hr_pp').html(option).show();
        }   
    })
});
$( "#guar" ).click(function( event ) {
var v1=$("#hr_pp option:selected").val();
var v99=$("#me_pp option:selected").val();
if($("#fc_pp").val()=='' ||
  v99=='' ||
  v1=='0'){
alert("Campos vacios");
}else{
var v22=$("#fc_pp").val();


      $.ajax({
    url : 'procesos/inset_hr.php',
    data : { id :v99, 
     v2 :v22,
     v3 :v1,
     v4 :"<?php echo $_GET["id"]; ?>" },
    type : 'POST',
    dataType : 'json',
    success : function(json) {

   
if(json[0].v1=="true"){
  alert("Insertado correctamente");
        var url = "solic.php";    
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