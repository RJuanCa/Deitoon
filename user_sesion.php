<?php 
class UserSesion{
    public function __construct(){
     
    }
    
     public function setCurrentUser($usuario){
        $_SESSION['usuario']= $usuario;
     }

     public function getCurrentUser(){
        return $_SESSION['usuario'];
     }

     public function closeSesion(){
        session_unset();
        session_destroy();
     }
    
}
?>