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
      <a href="admin.php" >
        <div class="option">
          <i class="fas fa-home" title="inicio"></i>
          <h4>Inicio</h4>
        </div>
      </a>

      <a href="remitos.php"class="selected">
        <div class="option">
          <i class="fas fa-file" title="Remitos"></i>
          <h4>Remitos</h4>
        </div>
      </a>

      <a href="usuario.php">
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

    <h1 style="color: white;">REMITOS</h1>
    <main>
        <div class="espacio-tabla">
        <table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col" width='10%'>Nro. Remito</th>
      <th scope="col"width='20%'>Fecha</th>
      <th scope="col"width='10%'>Id Cliente</th>
      <th scope="col"width='10%'>Total Articulos</th>
      <th scope="col"width='20%'>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $sql="SELECT * FROM tab_remito";
      $result= mysqli_query($conexion, $sql);
      while($mostrar=mysqli_fetch_array($result)){

    ?>
    <tr>
      <td><?php echo $mostrar['nro_remito'] ?></th>
      <td><?php echo $mostrar['fecha_rem'] ?></th>
      <td><?php echo $mostrar['id_cliente'] ?></th>
      <td><?php echo $mostrar['total_artic'] ?></th>
      <td>
      <a class="btn btn-success" href="factura_reporte.php?id=<?php echo $mostrar['id_cliente'] ?>"> Ver </a>

        <form action="remito_eliminar.php" method="post">
          <input type="hidden" value="<?php echo $mostrar['nro_remito'] ?>" name="txtRem" readonly>
          <td><input class="btn btn-danger" type="submit" value="Eliminar" name="btnEliminar"></td>
        </form>
        
      </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
        </div>        	
    <script  src="js/script.js"></script>
    </main>
   </body>
</html>