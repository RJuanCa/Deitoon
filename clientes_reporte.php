<?php
//seguridad de sesion paginacion
include_once 'db.php';
session_start();
if(!isset($_SESSION['rol'])){
  header('location:login.php');
}else{
  if($_SESSION['rol']!=1){
    header('location:login.php');
  }
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
      
      <a href="index.php">
        <div class="option">
          <i class="fas fa-right-to-bracket" title="salir"></i>
          <h4>Salir</h4>
        </div>
      </a>
    </div>
  </div>

    <h1 style="color: white;">CLIENTES</h1>
    <main>
        <div class="espacio-tabla">
        <table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">CLIENTE Nro.</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">APELLIDO</th>
      <th scope="col">TELEFONO</th>
      <th scope="col">CUIL/CUIT</th>
      <th scope="col">DIRECCION</th>
      <th scope="col">CORREO</th>
      <th scope="col">MOVIMIENTOS</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $sql="SELECT * FROM tab_clientes";
      $result= mysqli_query($conexion, $sql);
      while($mostrar=mysqli_fetch_array($result)){

    ?>
    <tr>
      <td><?php echo $mostrar['id_usuario'] ?></th>
      <td><?php echo $mostrar['nombres'] ?></th>
      <td><?php echo $mostrar['apellido'] ?></th>
      <td><?php echo $mostrar['telefono'] ?></th>
      <td><?php echo $mostrar['cuil/cuit'] ?></th>
      <td><?php echo $mostrar['direccion'] ?></th>
      <td><?php echo $mostrar['e-mail'] ?></th>
      <td><?php echo $mostrar['movimientos'] ?></th>
      <td>
      <a class="btn btn-success" href="clientes_editar.php?id=<?php echo $mostrar['id_usuario'] ?>">Editar</a>

        <form action="cliente_eliminar.php" method="post">
          <input type="hidden" value="<?php echo $mostrar['id_usuario'] ?>" name="txtID" readonly>
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