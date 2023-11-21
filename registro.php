
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login-Deitoon</title>
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/cabecera.css">
    </head>
    <body>
        <form class="text-center bg-dark" action="registro.php" method="POST">
            <h1>DEITOON - Login</h1>
            <label class="form-label blanco">Nombre <input type="text" placeholder="Ingrese su nombre" name="nombre"></label>
            <label class="form-label blanco">e-mail<input type="text" placeholder="Ingrese su e-mail" name="e-mail"></label>
            <label class="form-label blanco">Usuario <input type="text" placeholder="Ingrese su usuario" name="usuario"></label>
            <label class="form-label blanco">Contraseña<input type="password" placeholder="Ingrese su Contraseña" name="contraseña"></label>
            <label class="form-label blanco">Apellido <input type="text"placeholder="Ingrese su Apellido" name="apellido"></label>
            <input type="submit" value="Ingresar">
            
        </form>

    </body>
</html>
<?php
ini_set('display errors',1);
error_reporting(E_ALL);

include('db.php');

$usuario = $_POST['usuario'];
$email = $_POST['e-mail'];
$contraseña = $_POST['contraseña'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

$consulta = "INSERT INTO `tab_usuarios` ( `usuario`, `email_usu`, `contraseña`, `nombre`, `apellido`, `hash_`, `id_cargo`, `activo`) 
VALUES ('$usuario', '$email', '$contraseña', '$nombre ', '$apellido', '', '2', '0')";
$resultado = mysqli_query($conexion, $consulta) or die ('error de registro');
echo "Registro exitoso";
mysqli_close($conexion);
?>