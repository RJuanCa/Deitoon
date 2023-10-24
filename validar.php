<?php
include_once 'db.php';
session_start();

if(isset($_GET['cerrar_sesion'])){
    session_unset();
    session_destroy();
}
if(isset($_SESSION['rol'])){
    switch($_SESSION['rol']){
        case '1':
            header('location:admin.php');
            break;
        case '2':
            header('location:home.php');
            break;
            
            default:

    }
}
if(isset($_POST['usuario']) && isset($_POST['clave'])){
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $db= new DB();
    $query = $db->connect()->prepare('SELECT * FROM tab_usuarios WHERE usuario = :usuario AND clave = :clave');
    $query->execute(['usuario' => $usuario, 'clave' => $clave]);

    $row = $query->fetch(PDO::FETCH_NUM);
    if($row==true){
        //valida cargo
        $rol = $row[7];
        $_SESSION['rol']=$rol;

        switch($_SESSION['rol']){
            case 1:
                header('location:admin.php');
                break;
            case 2:
                header('location:home.php');
                break;
                
                default:
    
        }
    }else{
        //no existe el usuario
        echo "El Usuario o Contraseña no existen";
    }

}
?>