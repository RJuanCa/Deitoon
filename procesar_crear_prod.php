<?php
include("db.php");

$cod_artículo = $_POST["txtArt"];
$producto = $_POST["txtProduc"];
$descripcion = $_POST["txtDesc"];
$precio = $_POST["txtPrecio"];
$cant_existencia = $_POST["txtCant"];

$consulta="INSERT INTO `tab_artículos` (`cod_articulo`, `producto`, `descripcion`, `precio`, `cant_existencia`) VALUES ('$cod_artículo', '$producto', '$descripcion', '$precio', '$cant_existencia');";
$resultado = mysqli_query($conexion, $consulta) or die ('error de registro');
echo "Registro exitoso";
mysqli_close($conexion);
header("location:productos.php");
?>
