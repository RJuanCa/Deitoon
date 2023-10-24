<?php
include ("db.php");

$id = $_POST['txtId'];
$cod_artículo = $_POST['txtArt'];
$producto = $_POST['txtProduc'];
$descripcion = $_POST['txtDesc'];
$precio = $_POST['txtPrecio'];
$cant_existencia = $_POST['txtCant'];

mysqli_query($conexion, "UPDATE `tab_artículos` SET `id_artículo`='$id', `cod_articulo` = '$cod_artículo', `producto` = '$producto', `descripcion` = '$descripcion', `precio` = '$precio', `cant_existencia` = '$cant_existencia' WHERE `tab_artículos`.`id_artículo` = '$id'") or die ("error al Actualizar");

mysqli_close($conexion);
header("location:productos.php");
?>
