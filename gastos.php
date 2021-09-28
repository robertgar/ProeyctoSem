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

       <br><br>


      <div class="row">
         <div class="col-xs-6 form-group">
           <?php 
              
            $query_enf = mysqli_query($conection,"SELECT * FROM tipogasto ");
            $result_enf= mysqli_num_rows($query_enf);
           
            ?>
          <label>Enfermero</label>
          <select  class="form-control" id="tip_pp">
              <?php
                 if ($result_enf > 0) {
                    while ($enf = mysqli_fetch_array($query_enf)) {
                        ?>
                         <option value="<?php echo $enf ['id'];?>"><?php echo $enf['nom_tipo']; ?></option>

                       
                        
                     <?php  

                    }
                 }else{
                  ?>
                   <option value="0">No Disponible</option>
                   <?php
                 }
                ?>
      </select>
        </div>
        <div class="col-xs-6 form-group">
          <label>Mes:</label>
           <select id="month"  class="form-control" /> 
          <option value="01">Enero</option> 
          <option value="02">Febrero</option> 
          <option value="03">Marzo</option> 
          <option value="04">Abril</option> 
          <option value="05">Mayo</option> 
          <option value="06">Junio</option> 
          <option value="07">Julio</option> 
          <option value="08">Agosto</option> 
          <option value="09">Septiembre</option> 
          <option value="10">Octubre</option> 
          <option value="11">Noviembre</option> 
          <option value="12">Diciembre</option> 
        </select>
        </div>
        <div class="col-xs-6 form-group">
          <label>Fecha de Pago</label>
          <input class="form-control" type="date" id="fec_pp" />
        </div>
        <div class="col-xs-6 form-group">
          <label>Monto</label>
          <input class="form-control" type="number" id="nomt_pp"/>
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
var v1=$("#tip_pp option:selected").val();

if($("#fec_pp").val()=='' ||
  $("#nomt_pp").val()==''){
alert("Campos vacios");
}else{

  var v111=$("#fec_pp").val();
  var v22=$("#nomt_pp").val();
  var v33=$("#month").val();

      $.ajax({
    url : 'procesos/insert_gas.php',
    data : { id :v1,
     v11 :v111, 
     v2 :v22,
     v3 :v33 },
    type : 'POST',
    dataType : 'json',
    success : function(json) { 

if(json[0].v1=="true"){
  alert("Insertado correctamente");
        var url = "gastoG.php";    
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