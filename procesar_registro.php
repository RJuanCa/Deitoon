<?php
ini_set('display errors',1);
error_reporting(E_ALL);

include('db.php');

$usuario = $_POST["usuario"];
$email = $_POST["email_usu"];
$contraseña = $_POST["contraseña"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];

$consulta = "INSERT INTO `tab_usuarios` ( `usuario`, `email_usu`, `contraseña`, `nombre`, `apellido`, `hash_`, `id_cargo`, `activo`) VALUES ('$usuario', '$email', '$contraseña', '$nombre ', '$apellido', '', '2', '0');";
$resultado = mysqli_query($conexion, $consulta) or die ('error de registro');

echo "Registro exitoso";
mysqli_close($conexion);
?>