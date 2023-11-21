<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';

  ?>

<?php 
if ($_POST) {
    $total=0;
    $SID=session_id();
    $cliente= $_POST['cliente'];
    
    foreach($_SESSION['CARRITO'] as $indice=>$art){
        $total=$total+($art['precio']* $art['cantidad']);
    }
        $sentencia=$pdo->prepare("INSERT INTO `tab_remito` (`nro_remito`, `fecha_rem`, `nom_cliente`, `total_vta`) VALUES ('', NOW(), :nom_cliente, :total_vta);");
        $sentencia->bindParam(":nom_cliente",$cliente);
        $sentencia->bindParam(":total_vta",$total);
        $sentencia->execute();
        $nro_remito=$pdo->lastInsertId('nro_remito');
        
    foreach($_SESSION['CARRITO'] as $indice=>$art){ 
        $sentencia=$pdo->prepare("INSERT INTO `remitos_descrip` (`id_remito`, `nro_remito`, `id_artículo`, `cantidad`, `precio_unitario`) VALUES ('', :nro_remito, :id_artículo, :cantidad, :precio_unitario);");
        $sentencia->bindParam(":nro_remito", $nro_remito);
        $sentencia->bindParam(":id_artículo", $art['id_artículo']);        
        $sentencia->bindParam(":cantidad",$art['cantidad']);
        $sentencia->bindParam(":precio_unitario",$art['precio']);
        $sentencia->execute();
    //echo "<H3>".$total."</H3>";
      }
}
?>
<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de Realizar un Pedido de: 
        <h4>$ <?php echo number_format($total,2) ?></h4>
    </p>
    
    <p>Los pruductos podran ser retirados una vez que se procese el pago en el local</p>
</div>
<div class="btn-group btn-group-toggle" align="center" data-toggle="buttons">
    <label class="btn btn-success">
        <input type="radio"> Realizar Pedido 
    </label>
</div>
