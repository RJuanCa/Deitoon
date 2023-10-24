<?php

require("db.php");
session_start();

// Si se cerro la sesión por otro lado
$definido = isset($_SESSION['usuario']);
// No está definido la variable
if ($definido == false) {

  header("Location:home.php");

  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deitoon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/cabecera.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  </head>
   
<body id="body">

  <main>
        <div class="espacio-tabla">
        <table class="table  table-striped">
  <thead>

    <h2 style="color: white;">BIENVENIDO CLIENTE!!</h2>

  </thead>
  <tbody>
  <?php
  // Tabla usuarios
  
  $sql="SELECT * FROM `tab_usuarios` ";
  $query = mysqli_query($conexion, $sql);
  $mostrar = mysqli_fetch_array($query)

  ?>

    <form action="procesar_cliente.php" method="POST" lass="text-center">
        <input type="hidden" value="<?php echo $mostrar['id_usuario'] ?>" name="txtUsu">
        <p style="color: white;">Nombre</p>
        <input type="text" value="<?php echo $mostrar['nombre'] ?>"  name="txtNom">
        <p style="color: white;">apellido</p>
        <input type="text" value="<?php echo $mostrar['apellido'] ?>" name="txtApe">
        <p style="color: white;">E-Mail</p>
        <input type="text" value="<?php echo $mostrar['email_usu'] ?>"  name="txtCor">
        <p style="color: white;">Telefono</p>
        <input type="text"placeholder="Ingrese su Número de Tel" name="txtTel">
        <p style="color: white;">Cuil/Cuit</p>
        <input type="text"placeholder="Ingrese su Número de Cuil o Cuit" name="txtCui">
        <p style="color: white;">Dirección</p>
        <input type="text"placeholder="Ingrese su Dirección" name="txtDir">
          
    <br><br>
    <input class="btn btn-success" type="submit" value="Actualizar">
    </form>
  
  </tbody>
</table>
        </div>        	
    <script  src="js/script.js"></script>
    </main>
   
    </body>
</html>