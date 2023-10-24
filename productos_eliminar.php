<?php
include('db.php');

$ID = $_POST['txtArt'];
mysqli_query($conexion, "DELETE FROM `tab_artículos` where id_artículo = '$ID'") or die ("error al eliminar");

mysqli_close($conexion);
header("location:productos.php");

?>