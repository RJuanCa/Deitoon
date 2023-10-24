<?php
//seguridad de sesion paginacion
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
      <a href="#" class="selected">
        <div class="option">
          <i class="fas fa-home" title="inicio"></i>
          <h4>Inicio</h4>
        </div>
      </a>

      <a href="remitos.php">
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
      
      <a href="login.php">
        <div class="option">
          <i class="fas fa-right-to-bracket" title="salir"></i>
          <h4>Salir</h4>
        </div>
      </a>
    </div>
  </div>
<main>
<i class="fa-solid fa-d fa-beat fa-2xl" style="color: #fcfcfc;"></i>
<i class="fa-solid fa-e fa-beat fa-2xl" style="color: #fcfcfc;"></i>
<i class="fa-solid fa-i fa-beat fa-2xl" style="color: #fcfcfc;"></i>
<i class="fa-solid fa-t fa-beat fa-2xl" style="color: #fcfcfc;"></i>
<i class="fa-solid fa-o fa-beat fa-2xl" style="color: #fcfcfc;"></i>
<i class="fa-solid fa-o fa-beat fa-2xl" style="color: #fcfcfc;"></i>
<i class="fa-solid fa-n fa-beat fa-2xl" style="color: #fcfcfc;"></i><br><br>
  <h2 style="color: #ffffff;">Todas tus bebidas en un solo lugar</h2>
  <br><br><br>
  <h1><i class="fa-brands fa-facebook fa-spin fa-2xl" style="color: #ffffff;"></i></h1>
  <br>
  <a href="https://es-la.facebook.com/">Fecebook</a>
  <br><br><br>
  <h1><i class="fa-brands fa-whatsapp fa-spin fa-2xl" style="color: #ffffff;"></i></h1>
  <br>
  <a href="https://web.whatsapp.com/">Whatsapp</a>
</main>

<script src="js/script.js"></script>

</body>

</html>