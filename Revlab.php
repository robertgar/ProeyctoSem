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
    <div class="panel-heading">Resultado examen</div>
    <div class="panel-body">

       <br><br>


      <div class="row">
      
        <div class="col-xs-6 form-group">
          <label>Resultado</label>
           <textarea class="form-control" id="resul_pc"></textarea>
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

if($("#resul_pc").val()==''){
alert("Campos vacios");
}else{
var v22=$("#resul_pc").val();

      $.ajax({
    url : 'procesos/inset_resut.php',
    data : { id :v22, 
     v2 :<?php echo $_GET["id"];?>},
    type : 'POST',
    dataType : 'json',
    success : function(json) { 
console.log(json);
if(json[0].v1=="true"){
  alert("Insertado correctamente");
        var url = "Rvlab.php";    
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