<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'user.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/estilo.css">
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
                <li><a href="index.php"><i class="fa fa-user" title="usuarios"></i> Usuario </a></li>
                <li><a href="mostrarCarrito.php"><i class="fa-solid fa-cart-shopping"></i> carrito (<?php
                        echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                    ?>)</a></li>
                <li><a href="#"><i class="fa-brands fa-whatsapp"></i> Contacto</a></li>
                <li><a href="logout.php"><i class="nav-menu-list fa-solid fa-person-from-portal"></i> Cerrar</a></li>
            </ul><br>
        </nav><br><br>
        <div class="contenedor">
            <i class="letra fa-solid fa-d fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-e fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-i fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-t fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-o fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-o fa-beat fa-2xl" style="color: #fcfcfc;"></i>
            <i class="letra fa-solid fa-n fa-beat fa-2xl" style="color: #fcfcfc;"></i>
        </div>
    </header>
    <h1 style="text-align-last: center; color: white;">TODAS TUS BEBIDAS EN UN SOLO LUGAR</h1>
    
    <div class="carrousel">
        <div class="conteCarrousel">
            <div class="itemCarrousel" id="itemCarrousel-1">
                <div class="itemCarrouselTarjeta"> <img src="img/carrusel/promo4.jpg" alt=""></div>
                <div class="itemCarrouselArrows">
                    <a href="#itemCarrousel-3"> 
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#itemCarrousel-2">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
            <div class="itemCarrousel" id="itemCarrousel-2">
                <div class="itemCarrouselTarjeta"><img src="img/carrusel/promo2.jpg" alt=""></div>
                <div class="itemCarrouselArrows">
                    <a href="#itemCarrousel-1">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#itemCarrousel-3">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
            <div class="itemCarrousel" id="itemCarrousel-3">
                <div class="itemCarrouselTarjeta"><img src="img/carrusel/promo3.png" alt=""></div>
                <div class="itemCarrouselArrows">
                    <a href="#itemCarrousel-2">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#itemCarrousel-1">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="conteCarrouselController">
            <a href="#itemCarrousel-1">•</a>
            <a href="#itemCarrousel-2">•</a>
            <a href="#itemCarrousel-3">•</a> 
       </div> 
    </div>
<main>
    <section class="contenedor" style="align-items: center;">
    
        <!--Contenedor de los productos de bebidas-->
        <?php 
                $sentencia=$pdo->prepare ("SELECT * FROM `tab_artículos`");
                $sentencia->execute();
                $lista=$sentencia->fetchAll(PDO::FETCH_ASSOC);
                //print_r($lista);
            ?><br>
            <div class="contenedor">
        <div class="row" style="align-items: center;">   
        <?php foreach ($lista as $art) {?>
                <div class="col-3">
                    <div class="card">
                        <img  
                        title=""
                        class="card-img-top" 
                        src="<?php echo $art['imagen']; ?>" 
                        data-content="<?php echo $art['descripcion']; ?>"
                        height="317px";>
                        <div class="card-body">
                            <span style="color: black;"><?php echo $art['producto'];?></span>
                            <h5 class="card-title" style="color: black;"> $<?php echo $art['precio'];?></h5>
                            <p class="card-text" style="color: black;"><?php echo $art['descripcion']; ?></p>
                            <form action="" method="post">
                                <input type="hidden" name="id_artículo" id="id_artículo" value="<?php echo openssl_encrypt($art['id_artículo'],COD,KEY) ; ?>">
                                <input type="hidden" name="cod_articulo" id="cod_articulo" value="<?php echo openssl_encrypt($art['cod_articulo'],COD,KEY) ; ?>">
                                <input type="hidden" name="producto" id="producto" value="<?php echo openssl_encrypt($art['producto'],COD,KEY) ; ?>">
                                <input type="hidden" name="descripcion" id="descripcion" value="<?php echo openssl_encrypt($art['descripcion'],COD,KEY) ; ?>">
                                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($art['precio'],COD,KEY) ; ?>">
                                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt('1',COD,KEY) ; ?>">
                                <button class="btn btn-success" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                            </form>
                        <br>
                        </div>
                    </div>
                </div><br><br>
            <?php }?>
        </div>
        </div>
        <!-- carro -->
        <div class="carrito" id="carrito">
            <div class="header-carrito">
                <h2>Tu Compra</h2>
            </div>

            <div class="carrito-items">
            
            </div>
            <div class="carrito-total">
                <div class="fila">
                    <strong>Total</strong>
                    <span class="carrito-precio-total"> </span>
                </div>
                <button class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i> </button>
            </div>
        </div>
    </section>
</main>
</body>
</html>