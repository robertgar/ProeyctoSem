<?php
   
   session_start();
   if(isset($_SESSION['username'])){
    header('Location: inicio.php');
    exit;
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/favicon.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Nueva Vida</title>



  <link href="css/style.css" rel="stylesheet">

</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form">
      <div class="login-wrap">
     
      <div class="form-group">
    <label >Usuario:</label>
    <input type="text" class="form-control" id="Usuario">
  </div>
  <div class="form-group">
    <label>Password:</label>
    <input type="password" class="form-control" id="pwd" name="password" autocomplete="on">
  </div>
 
  <button type="button" class="btn btn-success" id="buscar">LOGIN</button>
  
      </div>
    </form>

  </div>


</body>

</html>

<script type="text/javascript">
  $( "#buscar" ).click(function( event ) {

    if($("#Usuario").val()=='' ||
      $("#pwd").val()==''){
alert('Campos Vacios');
    }else{
 var v1=$("#Usuario").val();
 var v2=$("#pwd").val();

   $.ajax({
        type: 'POST',
        url: 'procesos/buscaru.php',
        data: { id :v1, id1 :v2 },
        dataType: 'json',
        success : function(json) {
console.log(json);
            if(json[0].v2!="ERROR"){
              if(json[0].v2=='Admin'){
                var url = "inicio.php";    
                $(location).attr('href',url);

              }else{
                var url = "Mepac.php";    
                $(location).attr('href',url);
                }

      }else{
       alert("Error en las credenciales");
      }
        }   
    })
 }
});
</script>