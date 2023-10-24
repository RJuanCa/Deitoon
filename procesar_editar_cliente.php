<?php

include_once 'clientes_editar.php';
session_start();

$nombre = $_POST["txtNom"];
$apellido = $_POST["txtApe"];
$telefono = $_POST["txtTel"];
$cuit = $_POST["txtCui"];
$direccion = $_POST["txtDir"];
$email = $_POST["txtCor"];

mysqli_query($conexion,"UPDATE `tab_clientes` SET `nombres`='$nombre', `apellido`='$apellido', `telefono`='$telefono', `cuil/cuit`='$cuit',  `direccion`='$direccion', `e-mail`='$email'  WHERE `tab_clientes`.`nombres`='$nombre'") or die("error al Actualizar");

mysqli_close($conexion);
header("location:clientes_reporte.php");
?>