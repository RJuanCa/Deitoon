<?php 
include_once 'db.php';
class User extends DB{
  private $nombre;
  private $usuario;

  public function userExists($usuario, $clave){
    $md5pass = $clave;
    $query = $this->connect()->prepare('SELECT * FROM tab_usuarios WHERE usuario = :usuario AND clave = :clave');
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
      $this->nombre = $currentUser['nombre'];
      $this->usuario = $currentUser['usuario'];      
    }

  }
  
  public function getNombre(){
   return $this->nombre;
  }
}

?>
