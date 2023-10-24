<?php 
include ("db.php");

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
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  </head>
   
<body id="body">

  <header>
    <div class="icon_menu">

      <i class="fas fa-bars " id="btn_open"></i>
      
    </div>
  </header>
  
  <div class="menu_side" id="menu_side">
    <div class="name_page">
    <i class="fas fa-square-d"></i>
    
    </div>

    <div class="option_menu">
      <a href="#" >
        <div class="option">
          <i class="fas fa-home" title="inicio"></i>
          <h4>Inicio</h4>
        </div>
      </a>

      <a href="factura_reporte.php">
        <div class="option">
          <i class="fas fa-file" title="Remitos"></i>
          <h4>Remitos</h4>
        </div>
      </a>

      <a href="usuario.php"class="selected">
        <div class="option">
          <i class="fas fa-users" title="usuarios"></i>
          <h4>Usuarios</h4>
        </div>
      </a>

      <a href="productos.php">
        <div class="option">
          <i class="fas fa-wine-bottle" title="artículos"></i>
          <h4>Artículos</h4>
        </div>
      </a>
      
      <a href="index.html">
        <div class="option">
          <i class="fas fa-right-to-bracket" title="salir"></i>
          <h4>Salir</h4>
        </div>
      </a>
    </div>
  </div>

    <h1 style="color: white;">EDITAR CLIENTE</h1>
<main>
  <div class="espacio-tabla">
    <table class="table table-dark table-striped">
  <thead>

  </thead>
  <tbody>
    <?php
      $id = $_GET["id"];

      $sql1="SELECT * FROM tab_clientes ";
      $result= mysqli_query($conexion, $sql1);
      while($mostrar=mysqli_fetch_array($result)){

    ?>
    <form action="procesar_editar_cliente.php" method="POST">
        <p style="color: white;">NOMBRE</p>
        <input type="text" value="<?php echo $mostrar['nombres'] ?>" name="txtNom"><br>
        <p style="color: white;">APELLIDO</p>
        <input type="text" value="<?php echo $mostrar['apellido'] ?>" name="txtApe"><br>
        <p style="color: white;">TELEFONO</p>
        <input type="text" value="<?php echo $mostrar['telefono'] ?>" name="txtTel"><br>
        <p style="color: white;">CUIT/CUIL</p>
        <input type="text" value="<?php echo $mostrar['cuil/cuit'] ?>" name="txtCui"><br>
        <p style="color: white;">DIRECCION</p>
        <input type="text" value="<?php echo $mostrar['direccion'] ?>" name="txtDir"><br>
        <p style="color: white;">CORREO</p>
        <input type="text" value="<?php echo $mostrar['e-mail'] ?>" name="txtCor">
        <br><br>

    
    <?php
    }
    ?>
    <input class="btn btn-success" type="submit" value="Actualizar">
    </form>
  </tbody>
</table>
        </div>        	
    <script  src="js/script.js"></script>
</main>
</body>
</html>