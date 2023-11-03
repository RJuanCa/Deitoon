<?php 
include_once 'db.php';
class User extends DB{
  private $contraseña;
  private $usuario;

  public function userExists($usuario, $contraseña){
    //$md5pass = $contraseña;
    $query = $this->connect()->prepare ('SELECT * FROM tab_usuarios WHERE usuario = :usuario AND contraseña = :contraseña');
    $query->execute(['usuario' => $usuario,'contraseña'=> $contraseña]);

    if($query->rowCount()){
      return true;
    }else{
      return false;
    }
  }
  public function setUser($usuario){
    $query = $this->connect()->prepare('SELECT * FROM tab_usuarios WHERE usuario =:usuario AND contraseña =:contraseña');
    $query->execute(['usuario'=>$usuario]);

    foreach ($query as $currentUser){
      $this->contraseña = $currentUser['contraseña'];
      $this->usuario = $currentUser['usuario'];      
    }

  }
  
  public function getNombre(){
   return $this->usuario;
  }
}

?>
