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
    <div class="panel-heading">Pacientes</div>
    <div class="panel-body">
       <br>
      <div class="row">
                <div class="col-xs-6 form-group">
                  
          <label>DPI</label>
          <input class="form-control" type="number" onKeyPress="if(this.value.length==13) return false;" id="dpi_pp" />
              </div>
        <div class="col-xs-6 form-group">
          <label>Nombre</label>
          <input class="form-control" type="text" readonly id="nom_pp"/>
        </div>
        <div class="col-xs-6 form-group">
          <label>Fecha Nacimiento</label>
          <input class="form-control" type="date" readonly id="fn_pp"/>
        </div>
          <div class="col-xs-6 form-group">
          <label>Direccion</label>
          <input class="form-control" type="text" readonly id="dire_pp"/>
        </div>
         <div class="col-xs-6 form-group">
          <label>Telefono</label>
          <input class="form-control" type="number" onKeyPress="if(this.value.length==8) return false;" readonly id="tel_pp"/>
        </div>
         <div class="col-xs-6 form-group">
          <label>Sexo</label>
          <select  class="form-control" readonly id="sex_pp">
           <option value="M">Masculino</option>
            <option value="F">Femenino</option>
      </select>
        </div>



      </div>
    
    </div>
  </div>
  </div>

  <div class="panel panel-primary">
      <div class="panel-heading">Cita</div>
      <div class="panel-body">
       <br>
      <div class="row">
        <div class="col-xs-6 form-group">
          <label>Motivo Visita</label>
          <textarea class="form-control" id="mot_pc">
  
  </textarea>
        </div>
                    
        <div class="col-xs-6 form-group">
          <label>Fecha solcitud</label>
          <input class="form-control" type="date" id="fs_pc" />
        </div>
         
 </div>
    </div>
</div>

<div class="panel panel-primary">
      <div class="panel-heading">Enfermero</div>
      <div class="panel-body">
      <div class="col-xs-6 form-group">
         <?php 
              
            $query_enf = mysqli_query($conection,"SELECT id_en, nom_en FROM enfermero Where  `esta_en`=0 ");
            $result_enf= mysqli_num_rows($query_enf);
           
            ?>
          <label>Enfermero</label>
          <select  class="form-control" id="enf_penf">
              <?php
                 if ($result_enf > 0) {
                    while ($enf = mysqli_fetch_array($query_enf)) {
                        ?>
                         <option value="<?php echo $enf ['id_en'];?>"><?php echo $enf['nom_en']; ?></option>

                       
                        
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
        </div>
    </div>
    <button class="btn btn-primary btn-lg" id="guar">Guardar</button>
</div>




</body>
</html>

<script>

$( "#dpi_pp" ).keypress(function( event ) {
var keycode = (event.keyCode ? event.keyCode : event.which);
var val1 = $("#dpi_pp").val();
    if(keycode == '13'){
$("#nom_pp").val("");
        $("#fn_pp").val("");
        $("#dire_pp").val("");
        $("#tel_pp").val("");
        $("#sex_pp").val("");
      $.ajax({
    url : 'procesos/busc.php',
    data : { id :val1 },
    type : 'POST',
    dataType : 'json',
    success : function(json) {
     
if(json[0].v1==""){
const v1 = document.querySelector('#nom_pp');
        const v2 = document.querySelector('#fn_pp');
        const v3 = document.querySelector('#dire_pp');
        const v4 = document.querySelector('#tel_pp');
        const v5 = document.querySelector('#sex_pp');
        v1.removeAttribute("readonly");
        v2.removeAttribute("readonly");
        v3.removeAttribute("readonly");
        v4.removeAttribute("readonly");
        v5.removeAttribute("readonly");
      }else{
        $("#nom_pp").val(json[0].v2);
        $("#fn_pp").val(json[0].v3);
        $("#dire_pp").val(json[0].v4);
        $("#tel_pp").val(json[0].v5);
        $("#sex_pp").val(json[0].v6);
      }
    },
    error : function(xhr, status) {
        alert('Disculpe, existió un problema');
    }
});
        
    }
});
 


 $( "#guar" ).click(function( event ) {
var v1=$("#enf_penf option:selected").val();

var v77=$("#sex_pp option:selected").val();
if($("#dpi_pp").val()=='' ||
  $("#nom_pp").val()=='' ||
  $("#fn_pp").val()=='' ||
  $("#dire_pp").val()=='' ||
  $("#tel_pp").val()=='' ||
  $("#mot_pc").val()=='' ||
  $("#fs_pc").val()=='' ||
  v1=='0'){
alert("Campos vacios");
}else{
var v22=$("#dpi_pp").val();
var v33=$("#nom_pp").val();
var v44=$("#fn_pp").val();
var v55=$("#dire_pp").val();
var v66=$("#tel_pp").val();
var v88=$("#mot_pc").val();
var v100=$("#fs_pc").val();


      $.ajax({
    url : 'procesos/inset_sol.php',
    data : { id :v1, 
     v2 :v22,
     v3 :v33, 
     v4 :v44,
     v5 :v55,
     v6 :v66,
     v7 :v77,
     v8 :v88,
     v10 :v100 },
    type : 'POST',
    dataType : 'json',
    success : function(json) {
console.log(json);
   
if(json[0].v1=="true"){
  alert("Insertado correctamente");
        var url = "solic.php";    
$(location).attr('href',url);

      }else{
        alert(json);
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