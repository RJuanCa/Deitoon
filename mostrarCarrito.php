<?php
include 'global/config.php';
include 'carrito.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/estilo.css">
    <script src="js/operacion de carrito.js" async></script>
    <link rel="stylesheet" href="css/carrusel.css">
    <script src="https://kit.fontawesome.com/887a835504.js" crossorigin="anonymous"></script>
    <title>| DEITOON | </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>
<body class="body1">
    <header style="align-items: center;" class="header" >

        <nav class="navbar">
            
            <input class="checkbox" type="checkbox">
            <i class="icons fa-solid fa-bars"></i>
            <i class="icons fa-solid fa-xmark"></i>
        
            <ul class="menu">
                <li><a href="index.php"><i class="fa fa-user" title="usuarios"></i> Usuario</a></li>
                <li><a href="mostrarCarrito.php"><i class="fa-solid fa-cart-shopping"></i> carrito</a></li>
                <li><a href="#"><i class="fa-brands fa-whatsapp"></i> Contacto</a></li>
                <li><a href="indice.php"><i class="nav-menu-list fa-solid fa-person-from-portal"></i> Volver</a></li>
            </ul>
        </nav><br>
            <i class="letra fa-solid fa-d fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-e fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-i fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-t fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-o fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-o fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-n fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            
    </header>
    

<main>
<div class="container">
<p class="usuario3">
<?php

$sql="SELECT * FROM tab_clientes";
$result= mysqli_query($conexion, $sql);
while($mostrar=mysqli_fetch_array($result)) {?>

  <span class="encab">
    <br />
    <b style="color: white;">Cliente: <?php echo $mostrar['nombres']; echo $mostrar['apellido'] ?></b>
    <br />
    <b style="color: white;">Cuil/Cuit: <?php echo $mostrar['cuil/cuit']; ?></b>
    <br />
    <b style="color: white;">Teléfono: <?php echo $mostrar['telefono']; ?></b>
    <br />
  </span>
  
<?php
}
?>
</p>

    <?php if (!empty($_SESSION['CARRITO'])) { ?>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col" width="40%"style="text-align-last: center;">Descripcion</th>
                    <th scope="col" width="15%"style="text-align-last: center;">Cantidad</th>
                    <th scope="col" width="20%"style="text-align-last: center;">Precio</th>
                    <th scope="col" width="20%"style="text-align-last: center;">Total</th>
                    <th scope="col" width="5%"style="text-align-last: center;">--</th>
                </tr>
           </thead>
           <tbody>
            <?php $total=0; ?>
            <?php foreach($_SESSION['CARRITO'] as $indice=>$art) {?>
                <tr>
                    <td width="40%" style="text-align-last: center;"><?php echo $art['descripcion'] ?></td>
                    <td width="15%" style="text-align-last: center;"><?php echo $art['cantidad'] ?></td>
                    <td width="20%" style="text-align-last: center;"><?php echo $art['precio'] ?></td>
                    <td width="20%" style="text-align-last: center;"><?php echo number_format($art['precio']*$art['cantidad'],2)  ?></td>
                    <td width="5%">
                        <form action="" method="post">
                           <input type="hidden" name="id_artículo" id="id_artículo" value="<?php echo openssl_encrypt($art['id_artículo'],COD,KEY) ; ?>">
                           <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button></td>
                        </form>
                </tr>
        <?php $total=$total+($art['precio']*$art['cantidad']); ?>
        <?php }?>
        
        <tr>
            <td colspan="3" align= "right"><h3>Total</h3></td>
            <td align="right"><h3>$<?php echo number_format($total,2) ?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">

                <form action="remito.php" method="POST">
                    <div class="alert alert-success" role="alert">
                        <div class="form-group">
                        <label for="my-input">Confirme su pedido</label>
                        <input id="cliente" name="cliente" class="form-control" type="text" placeholder="Ingrese su nombre para poder identificar su pedido" require>
                        </div>
                        <small id="Help" class="form-text text-muted" >Los productos se encuentran en proceso de preparación....</small>
                    </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnAccion" value="Proceder">Confirmar Pedido >> </button>
                
                </form>
            </td>
        </tr>
    </tbody>
</table>
</div>
<?PHP }else{ ?>
    <div class="alert alert-success" role="alert">
        No hay productos en el carrito
    </div>
<?PHP }?>
</main>
<h1 style="text-align-last: center; color: white;">TODAS TUS BEBIDAS EN UN SOLO LUGAR</h1>
</body>
</html>
