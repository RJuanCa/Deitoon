<?php
include_once 'db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login-Deitoon</title>
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/cabecera.css">
        <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <form class="text-center bg-dark" action="validar.php"  method="POST">
            <?php
            if(isset($errorLogin)){
                echo $errorLogin;
            }
            ?>
            <h1>DEITOON - Login</h1>
            <i class="fas fa-user"></i>
            <label class="form-label blank">Usuario </label>
            <input type="text" id="usuario" name="usuario" autofocus ><br><br>
            <i class="fa-solid fa-unlock"></i>
            <label class="form-label blank">Contraseña</label>
            <input type="password" id="clave" name="clave" >
            <input  type="submit" id="btn-submit" value="Entrar">
       
        </form>
        
    </body>
</html>