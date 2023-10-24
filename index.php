<?php
include_once 'db.php';
include_once 'user.php';

//$userSesion = new $userSesion();
$usuario= new User();

if(isset($_SESSION['usuario'])){
    //echo "Hay sesion";
    $usuario->setUser($userSesion->getCurrentUser());
    include_once 'home.php';
}else if(isset($_POST['usuario']) && isset($_POST['contraseña'])){
    //echo "Validacion de Login";
    $userForm = $_POST['usuario'];
    $passForm = $_POST['contraseña'];

    if($usuario->userExists($userForm, $passForm)){
        //echo "Usuario Validado";
        $userSession->setCurrentUser($userForm);
        $usuario->setUser($userForm);
        include_once 'home.php';
    }else{
        //echo"Nombre de usuario y/o contraseña incorrecto";
        $errorLogin = "Nombre de usuario y/o contraseña incorrecto";
        include_once 'login.php';
    }
}else{
    //echo"login.php";
    include_once'login.php';
}
?>
