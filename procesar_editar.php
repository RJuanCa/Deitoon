<?php
include("db.php");

$usuario = $_POST["txtusuario"];
$email = $_POST["txtemail"];
$clave = $_POST["txtcontraseña"];
$nombre = $_POST["txtnombre"];
$apellido = $_POST["txtapellido"];
$cargo = $_POST["txtcargo"];

mysqli_query($conexion,"UPDATE `tab_usuarios` SET `usuario` = '$usuario',`email_usu` = '$email',`clave` = '$clave', `nombre` = '$nombre',`apellido` = '$apellido', `id_cargo` = '$cargo' WHERE `tab_usuarios`.`usuario` = '$usuario'") or die("error al Actualizar");

mysqli_close($conexion);
header("location:usuario.php");
?>