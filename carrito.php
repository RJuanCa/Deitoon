<?php
session_start();
$mensaje="";

if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){
        case 'Agregar':
            if (is_numeric(openssl_decrypt( $_POST['id_artículo'],COD,KEY))) {
                $id_artículo=openssl_decrypt( $_POST['id_artículo'],COD,KEY);
                $mensaje.="OK id_artículo Correcto".$id_artículo;
            }else{
                $mensaje.="UPSS.... id_artículo Incorrecto".$id_artículo;
            }
            if (is_numeric(openssl_decrypt( $_POST['cod_articulo'],COD,KEY))) {
                $cod_articulo=openssl_decrypt( $_POST['cod_articulo'],COD,KEY);
                $mensaje.="OK cod_articulo Correcto".$cod_articulo;
            }else{
                $mensaje.="UPSS.... cod_articulo Incorrecto".$cod_articulo;
                break;
            }
            if (is_string(openssl_decrypt( $_POST['producto'],COD,KEY))) {
                $producto=openssl_decrypt( $_POST['producto'],COD,KEY);
                $mensaje.="OK producto Correcta".$producto;
            }else{
                $mensaje.="UPSS.... producto Incorrecta";
                break;
            }
            if (is_string(openssl_decrypt( $_POST['descripcion'],COD,KEY))) {
                $descripcion=openssl_decrypt( $_POST['descripcion'],COD,KEY);
                $mensaje.="OK descripcion Correcta".$descripcion;
            }else{
                $mensaje.="UPSS.... descripcion Incorrecta";
                break;
            }
            
            if (is_numeric(openssl_decrypt( $_POST['precio'],COD,KEY))) {
                $precio=openssl_decrypt($_POST['precio'],COD,KEY);
                $mensaje.="OK Precio Correcto".$precio;
            }else{
                $mensaje.="UPSS.... Precio Incorrecto";
                break;
            }
            if (is_numeric(openssl_decrypt( $_POST['cantidad'],COD,KEY))) {
                $cantidad=openssl_decrypt($_POST['cantidad'],COD,KEY);
                $mensaje.="OK cantidad Correcto".$cantidad;
            }else{
                $mensaje.="UPSS.... cantidad Incorrecto".$cantidad;
                break;
            }
            
        if (!isset($_SESSION['CARRITO'])) {
            $art=array(
                'id_artículo'=>$id_artículo,
                'cod_articulo'=>$cod_articulo,
                'producto'=>$producto,
                'descripcion'=>$descripcion,
                'precio'=>$precio,
                'cantidad'=>$cantidad,
                
            );
            $_SESSION['CARRITO'][0]=$art;
        }else{
            $NumeroProduc=count($_SESSION['CARRITO']);
            $art=array(
                'id_artículo'=>$id_artículo,
                'cod_articulo'=>$cod_articulo,
                'producto'=>$producto,
                'descripcion'=>$descripcion,
                'precio'=>$precio,
                'cantidad'=>$cantidad,
                
            );
            $_SESSION['CARRITO'][$NumeroProduc]=$art;
        }
        $mensaje=print_r($_SESSION,true);

        break;
        case "Eliminar":
            if (is_numeric(openssl_decrypt( $_POST['id_artículo'],COD,KEY))) {
                $id_artículo=openssl_decrypt( $_POST['id_artículo'],COD,KEY);
               foreach($_SESSION['CARRITO'] as $indice=>$art){
                    if ($art['id_artículo']==$id_artículo) {
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento Borrado');</script>";
                    }
               }
            }else{
                $mensaje.="UPSS.... id_artículo Incorrecto".$id_artículo;
            }
        break;
    }
}
?>