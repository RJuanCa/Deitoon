<?php
include('db.php');

$ID = $_POST['txtID'];
mysqli_query($conexion, "DELETE FROM tab_usuarios where id_usuario = '$ID'") or die ("error al eliminar");

mysqli_close($conexion);
header("location:usuario.php");

?>