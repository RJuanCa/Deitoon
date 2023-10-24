<?php
include_once 'sesion_usuario.php';
$userSession = new UserSesion();
$userSession->closeSesion();
header('location:login.php');
?>