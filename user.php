<?php 
include_once 'db.php';

class User extends DB{
  private $clave;
  private $usuario;
  private $nombre;

  public function userExists($usuario, $clave){
    //$md5pass = md5($contraseña);
    $query = $this->connect()->prepare ('SELECT * FROM tab_usuarios WHERE usuario = :usuario AND contraseña = :contraseña');
    $query->execute(['usuario' => $usuario,'clave'=> $clave]);

    if($query->rowCount()){
      return true;
    }else{
      return false;
    }
  }
  public function setUser($usuario){
    $query = $this->connect()->prepare('SELECT * FROM tab_usuarios WHERE usuario =:usuario AND clave =:clave');
    $query->execute(['usuario'=>$usuario]);

    foreach ($query as $currentUser){
      $this->clave = $currentUser['clave'];
      $this->usuario = $currentUser['usuario'];
      $this->nombre = $currentUser['nombre'];
    }

  }
  
  public function getNombre(){
   return $this->nombre;
  }
}
?>
