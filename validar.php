<?php
include_once 'db.php';
session_start();

if (isset($_GET['cerrar_sesion'])) {
    session_unset();
    session_destroy();
}
if(isset($_SESSION['rol'])){
    switch($_SESSION['rol']){
        case 1:
            header('location: admin.php');
            break;
        case '2':
            header('location:indice.php');
            break;
            
            default:

    }
}
if(isset($_POST['usuario']) && isset($_POST['contraseña'])){
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

   
    $sql = "SELECT * FROM tab_usuarios ";
    $result= mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($result);
    if($row==true){
        //valida cargo
        $cargo = $row[7];
        $_SESSION['rol']=$cargo;

        switch($_SESSION['rol']){
            case 1:
                header('location: admin.php');
                break;
            case 2:
                header('location:indice.php');
                break;
                
                default:
    
        }
    }else{
        //no existe el usuario
        echo "El Usuario o Contraseña no existen";
    }

}
?>