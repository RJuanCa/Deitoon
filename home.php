<?php
//seguridad de sesion paginacion
session_start();
if(!isset($_SESSION['rol'])){
  header('location:login.php');
}else{
  if($_SESSION['rol']!=2){
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
      <div class="option">
      <a href="login.php">
        <i class="fas fa-right-to-bracket" title="salir"></i>
        <h4>Salir</h4>
      </a>
      </div>
      <div class="option">
        <a href="crear_remito.php">
        <i class="fa-solid fa-cart-shopping"></i>
        <h4>Comprar</h4>
        </a>
      </div>
  </div>
  </div>
<main>
  <i class="fa-solid fa-d fa-beat fa-2xl" style="color: #fcfcfc;"></i>
  <i class="fa-solid fa-e fa-beat fa-2xl" style="color: #fcfcfc;"></i>
  <i class="fa-solid fa-i fa-beat fa-2xl" style="color: #fcfcfc;"></i>
  <i class="fa-solid fa-t fa-beat fa-2xl" style="color: #fcfcfc;"></i>
  <i class="fa-solid fa-o fa-beat fa-2xl" style="color: #fcfcfc;"></i>
  <i class="fa-solid fa-o fa-beat fa-2xl" style="color: #fcfcfc;"></i>
  <i class="fa-solid fa-n fa-beat fa-2xl" style="color: #fcfcfc;"></i>
</main>
  
<script src="js/script.js"></script>  

</body>
</html>