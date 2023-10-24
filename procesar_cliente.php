<?php
ini_set('display errors',1);
error_reporting(E_ALL);

include('db.php');

$usuario = $_POST["txtUsu"];
$email = $_POST["txtCor"];
$direccion = $_POST["txtDir"];
$nombre = $_POST["txtNom"];
$apellido = $_POST["txtApe"];
$telefono = $_POST["txtTel"];
$cuit = $_POST["txtCui"];

$consulta = "INSERT INTO `tab_clientes` ( `id_usuario`, `nombres`, `apellido`, `telefono`, `cuil/cuit`, `direccion`, `e-mail`, `movimientos`) 
VALUES ( '$usuario', '$nombre', '$apellido', '$telefono', '$cuit', '$direccion', '$email', '');";
$resultado = mysqli_query($conexion, $consulta) or die ('error de registro');

echo "Registro exitoso";
mysqli_close($conexion);
header("location:home.php");
?>