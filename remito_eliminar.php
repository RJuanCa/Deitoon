<?php
include('db.php');

$ID = $_POST['txtNro'];
mysqli_query($conexion, "DELETE FROM tab_remito where nro_remito = '$ID'") or die ("error al eliminar");

mysqli_close($conexion);
header("location:remitos.php");

?>