<?php
include_once 'db.php';
include_once 'user.php';
include_once 'user_sesion.php';
include_once 'validar.php';
include_once 'login.php';


$userSesion = new UserSesion();
$usuario= new User();

if(isset($_SESSION['usuario'])){
    //echo "Hay sesion";
    $usuario->setUser($userSesion->getCurrentUser());
    include_once '.indice.php';
}else if(isset($_POST['usuario']) && isset($_POST['clave'])){
    //echo "Validacion de Login";
    $userForm = $_POST['usuario'];
    $passForm = $_POST['clave'];

    if($usuario->userExists($userForm, $passForm)){
        //echo "Usuario Validado";
        $userSession->setCurrentUser($userForm);
        $usuario->setUser($userForm);
        include_once 'indice.php';
    }else{
        //echo"Nombre de usuario y/o contraseña incorrecto";
        $errorLogin = "Nombre de usuario y/o contraseña incorrecto";
        include_once '.login.php';
    }
}else{
    //echo"login.php";
    include_once 'login.php';
}
?>