<?php
include_once 'db.php';
session_start();
/*
Nota: 
echo $_SESSION['carrito'][1]['id_artículo'];
exit();
*/

if (isset($_GET['cant_existencia'])) {

  $existencia = $_GET['cant_existencia'];

  if ($existencia != 0) {

    $hayexistencia = "si";
  } else {

    $hayexistencia = "no";
    $producto_e = $_GET['producto'];
  }
}

// Eliminar producto 
if (isset($_GET['orden'])) {

  $orden = $_GET['orden'];

  if ($_SESSION['total_productos'] == 1) {

    if (isset($_SESSION['carrito'][1]['orden'])) {

      $_SESSION['total_productos']--;
      unset($_SESSION['carrito']);
    }
  }

  if ($_SESSION['total_productos'] != 1) {

    if (isset($_SESSION['carrito'][$_SESSION['total_productos']]['orden'])) {

      if ($orden == $_SESSION['carrito'][$_SESSION['total_productos']]['orden']) {

        $_SESSION['total_productos']--;
        unset($_SESSION['carrito'][$orden]);
      } else { // if($orden==$_SESSION['carrito'][$_SESSION['total_productos']]['orden'])

        for ($i = $orden; $i <= $_SESSION['total_productos']; $i++) {

          if ($_SESSION['total_productos'] != $i) {

            $_SESSION['carrito'][$i]['id_artículo']  = $_SESSION['carrito'][$i + 1]['id_artículo'];
            $_SESSION['carrito'][$i]['cantidad']  = $_SESSION['carrito'][$i + 1]['cantidad'];
            $_SESSION['carrito'][$i]['producto']  = $_SESSION['carrito'][$i + 1]['producto'];
            $_SESSION['carrito'][$i]['descripcion']  = $_SESSION['carrito'][$i + 1]['descripcion'];
            $_SESSION['carrito'][$i]['precio']  = $_SESSION['carrito'][$i + 1]['precio'];
            $_SESSION['carrito'][$i]['orden']  = $_SESSION['carrito'][$i]['orden'];
          } else { // if($_SESSION['total_productos']!=$i)

            $_SESSION['total_productos']--;
            unset($_SESSION['carrito'][$i]);
          } // if($_SESSION['total_productos']!=$i)	

        } // for($i=$orden;$i<=$_SESSION['total_productos'];$i++)

      } // if($orden==$_SESSION['carrito'][$_SESSION['total_productos']]['orden'])

    } // if(isset($_SESSION['carrito'][$_SESSION['total_productos']]['orden']))

  } // if($_SESSION['total_productos']!=1)

} // if(isset($_GET['orden']))

$producto_agregado = 'no';
$producto_mensaje = 'no';

// agregar producto
if (isset($_GET['id_artículo'])) {

  // id del producto
  $id_artículo = $_GET['id_artículo'];
  $producto = $_GET['producto'];
  $descripcion = $_GET['descripcion'];
  $precio = $_GET['precio'];

  if ($hayexistencia == "si") {

    if (isset($_SESSION['carrito'])) {

      for ($i = 1; $i <= $_SESSION['total_productos']; $i++) {

        if ($_SESSION['carrito'][$i]['id_artículo'] == $id_artículo) {

          $ii = $i;
          //echo "<script>alert('Producto ya agregado en reglon nro.:".$i."')</script>";
          $producto_agregado = 'si';
          $producto_mensaje = 'si';
        }
      }  //for($i=1;$i<=$_SESSION['total_productos'];$i++);

    } //if(isset($_SESSION['carrito']));

  }

  if ($producto_agregado == 'no' && $hayexistencia == "si") {

    $_SESSION['total_productos']++;

    $_SESSION['carrito'][$_SESSION['total_productos']] = array(

      "id_artículo" => $id_artículo,
      "cantidad" => "",
      "producto" => $producto,
      "descripcion" => $descripcion,
      "precio" => $precio_final,
      "orden"  => $_SESSION['total_productos']

    );
  }  if($producto_agregado=='no');

}  isset($_GET['id_artículo']);

// Boton guardar
if (isset($_POST['submit2'])) {

  $_SESSION['guardar'] = "si";

  $k8['entro'][0] = 0;
  $kk8 = 0;
  foreach ($_POST['cantidad'] as $key => $val) {

    $kk8 = $kk8 + 1;
    $k8['entro'][$kk8] = 0;

    if ($val == 0) {

      $val = "";
    }

    if ($val < 0) {

      $val = "";
    }

    if (is_numeric($val)) {

      $_SESSION['cantidad3'][$key] = $val;

      if ($val != $_SESSION['carrito'][$key]['cantidad']) {

        $_SESSION['carrito'][$key]['cantidad'] = "";
        $_SESSION['nro_reglon3'] = $key;

        $k8['entro'][$kk8] = 1;
      }
    } else {

      $_SESSION['carrito'][$key]['cantidad'] = "";
      $_SESSION['nro_reglon3'] = $key;

      $k8['entro'][$kk8] = 1;
    }
  }

  $entro = 0;
  foreach ($k8['entro'] as $kkey => $vval) {

    if ($vval == 1) {

      if ($entro == 0) {
        $entro = $vval;
        $indicee = $kkey;
      }
    }
  }

  if ($entro != 0) {

    $_SESSION['reglon_actualizado'] = "no";
    $_SESSION['mensaje_no_actualizado'] = "El reglon nro. $indicee no se actualizó la Cantidad";
  }

  // echo $_SESSION['cantidad3'][2];

}

// Lo direcciona el boton guardar al presinar si
if (isset($_GET['guardar2'])) {

  echo "<script>location.href = 'crear_remito_validar.php'</script>";
}

// Boton totalizar productos
if (isset($_POST['submit'])) {

  foreach ($_POST['cantidad'] as $key => $val) {

    if ($val == 0) {

      $val = "";
    }

    if ($val < 0) {

      $val = "";
    }

    if (is_numeric($val)) {

      $val = intval($val);

      $id_artículo_b = $_SESSION['carrito'][$key]['id_artículo'];

      // Buscar id_artículo
      $sql3 = "SELECT id_artículo, cant_existencia FROM `tab_artículos` WHERE (id_artículo = " . $id_artículo_b . ")";
      $query3 = $mysqli->query($sql3);
      $row3 = $query3->fetch_assoc();

      if ($query3->num_rows == 0) {

        $existencia_b = 0;
      } else {

        $existencia_b = $row3["cant_existencia"];
      }

      if ($existencia_b < $val) {

        $_SESSION['carrito'][$key]['cantidad'] = "";
        $hayexistencia_cant = "no";
        $producto_e = $_SESSION['carrito'][$key]['producto'];
        //$reglon_b=$_SESSION['carrito'][$key]['orden'];

      } else {

        $_SESSION['carrito'][$key]['cantidad'] = $val;
      }
    } else { // if (is_numeric($val))

      $_SESSION['carrito'][$key]['cantidad'] = "";
    } // if (is_numeric($val))

  } // foreach($_POST['cantidad'] as $key => $val)	

  if (is_numeric($_POST['descuento'])) {

    if ($_POST['descuento'] < 0) {

      $_SESSION['descuento'] = 0;
    } else {

      $_SESSION['descuento'] = $_POST['descuento'];
    }
  } else {

    $_SESSION['descuento'] = 0;
  }
} // isset($_POST['submit'])

// Boton vista moneda
if (isset($_POST['submit3'])) {

  $k8['entro'][0] = 0;
  $kk8 = 0;
  foreach ($_POST['cantidad'] as $key => $val) {

    $kk8 = $kk8 + 1;

    if ($val == 0) {

      $val = "";
    }

    if ($val < 0) {

      $val = "";
    }

    if (is_numeric($val)) {

      //$_SESSION['orden3'][$key]=$key;		
      $_SESSION['cantidad3'][$key] = $val;

      if ($val != $_SESSION['carrito'][$key]['cantidad']) {

        $_SESSION['reglon_actualizado'] = "no";
        $_SESSION['carrito'][$key]['cantidad'] = "";
        $_SESSION['nro_reglon3'] = $key;

        $_SESSION['mensaje_no_actualizado'] = "El reglon nro. $key no se actualizó la cantidad";
        $_SESSION['mensaje_vista_moneda'] = "no";
        $_SESSION['guardar'] = "si";
        $k8['entro'][$kk8] = 1;
      } else {

        $k8['entro'][$kk8] = 0;
      }
    } else {

      $_SESSION['reglon_actualizado'] = "no";
      $_SESSION['carrito'][$key]['cantidad'] = "";
      $_SESSION['nro_reglon3'] = $key;

      $_SESSION['mensaje_no_actualizado'] = "El reglon nro. $key no se actualizó la Cantidad";
      $_SESSION['mensaje_vista_moneda'] = "no";
      $_SESSION['guardar'] = "si";

      $k8['entro'][$kk8] = 1;
    }
  }

  $entro = 0;
  foreach ($k8['entro'] as $kkey => $vval) {

    if ($vval == 1) {

      $entro = $vval;
    }
  }

  if ($entro == 0) {

    $_SESSION['mensaje_vista_moneda'] = "si";
  } else {

    $_SESSION['mensaje_vista_moneda'] = "no";
  }

  if ($_POST['descuento'] != $_SESSION['descuento']) {

    $_SESSION['descuento'] = 0;

    $_SESSION['reglon_actualizado'] = "no";
    $_SESSION['mensaje_no_actualizado'] = "No se actualizó el porcentaje de Descuento";
    $_SESSION['mensaje_vista_moneda'] = "no";
    $_SESSION['guardar'] = "si";
  }

  if ($_SESSION['mensaje_vista_moneda'] == "si") {

    if ($_POST['pass'] == "Seleccione") {

      $_SESSION['selecciono_moneda'] = "no";
      $_SESSION['cont_mensaje_vista_moneda'] = "No seleccionó la moneda.";
    } else {

      $_SESSION['selecciono_moneda'] = "si";
      $_SESSION['moneda'] = $_POST['pass'];
    }
  }
}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deitoon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  </head>
   
<body id="body">
  <header>
    <div class="icon_menu">

      <i class="fas fa-bars " id="btn_open"></i>
            
    </div>    
  </header>
  
  <div class="menu_side" id="menu_side">
    <div class="name_page">
      <i class="fas fa-square-d"></i>
    </div>
    
    <div class="option_menu">
      <div class="option">
      <a href="login.php">
        <i class="fas fa-right-to-bracket" title="salir"></i>
        <h4>Salir</h4>
      </a>
      </div>
  </div>
  </div>
  <main>

  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">

        <p class="navbar-brand"><span style="color: white;">DEITOON</span></p>
        <p class="navbar-brand"><span><a href="home.php;">Menu</a></span></p>
      
      </div>

      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>

  <div class="container">

    <p class="usuario3">
    <?php

$sql="SELECT * FROM tab_clientes";
$result= mysqli_query($conexion, $sql);
while($mostrar=mysqli_fetch_array($result)){

?>



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

    <h3 style="color: white;">Crear Pedido Cliente</h3>

    <div class="table-responsive">

      <p><a href="buscar_productos.php"><span style="color: white;" class="encab">Agregar Productos</span></a></p>

      <?php if (isset($_SESSION['carrito'])) { ?>

        <form id="formulario_renglones" method="post" action="crear_remito.php">

          <div class="table-responsive">

          <table class="table table-dark table-striped">

              <thead>
                <tr>

                  <th class='table-header' width='15%'>Cod. Articulo</th>
                  <th class='table-header' width='30%'>Articulo</th>
                  <th class='table-header' width='35%'>Descripción</th>
                  <th class='table-header' width='10%'>Cantidad</th>
                  <th class='table-header' width='6%'>Enlace</th>

                </tr>
              </thead>

              <tbody>

                <?php

                $totalprice = 0;
                $nro_reng2 = 0;
                $cantidad2 = 0;

                for ($i = 0; $i < $_SESSION['total_productos']; $i++) {

                  $nro_reng2++;
                  $nro_reglon = $nro_reng2;

                  $subtotal = $_SESSION['carrito'][$nro_reglon]['cantidad'] * $_SESSION['carrito'][$nro_reglon]['precio'];
                  $totalprice += $subtotal;

                  $cantidad2 += $_SESSION['carrito'][$nro_reglon]['cantidad'];

                ?>

                  <tr class='table-row'>

                    <td><?php echo $_SESSION['carrito'][$nro_reglon]['orden'] ?></td>
                    <td><?php echo $_SESSION['carrito'][$nro_reglon]['producto'] ?></td>
                    <td><?php echo $_SESSION['carrito'][$nro_reglon]['descripcion'] ?></td>
                    <td style="center"><input class="form-control" id="cantidad" type="text" name="cantidad[<?php echo $nro_reglon ?>]" size="6" maxlength="6" value="<?php echo $_SESSION['carrito'][$nro_reglon]['cantidad'] ?>" /></td>

                    <td><a href="#" onclick="Validar3(<?php echo $_SESSION['carrito'][$nro_reglon]['orden'] ?>)">Eliminar</a></td>

                  </tr>

                <?php

                } // for($i=0;$i<$_SESSION['total_productos'];$i++)

                $_SESSION['totalprice'] = $totalprice;
            
                ?>

              </tbody>
            </table>

          </div>

          <div class="total_factura">

            <table style="right">

              <tr>
                <td>
                  <div style="right">
                    <b>Sub-Total: </b>
                  </div>
                </td>
                <td>
                  <div style="right">
                    <?php echo number_format($totalprice, 2, ',', '.'); ?>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div style="right">
                    <button class="btn btn-xs btn-success" type="submit" name="submit"><b>Total:</b></button>
                  </div>
                </td>
                <td>
                  <div>
                    <?php echo number_format($_SESSION['total_desc'], 2, ',', '.'); ?>
                  </div>
                </td>
              </tr>

            </table>

            <br /><br /><br /><br />
            <div style="right">
              <b>Cant. de Productos: </b> <?php echo number_format($cantidad2, 0, ',', '.'); ?>
            </div>

          </div>

          <button class="btn btn-xs btn-success" type="submit" name="submit2" ><b>Guardar</b></button>
          <br />
          <br />

          <button class="btn btn-xs btn-success" type="submit" name="submit3" ><b>Ver</b></button></p>

        </form>




      <?php

      } // if(isset($_SESSION['carrito']))

      ?>

      <div id="resultado"></div>
      <br />

      <script>
        // Eliminar producto
        function Validar3(pass) {

          // Nro. de reglon
          var pass2 = pass;

          // confirmation
          $.confirm({
            title: 'Mensaje',
            content: '¿Confirma en eliminar el reglon nro.' + pass2 + '?',
            animation: 'scale',
            closeAnimation: 'zoom',
            buttons: {
              confirm: {
                text: 'Si',
                btnClass: 'btn-orange',

                action: function() {

                  window.location.href = "crear_remito.php?orden=" + pass2;

                } // action: function(){

              }, // confirm: {

              cancelar: function() {

              } // cancelar: function()

            } // buttons

          }); // $.confirm

        }
      </script>

    </div> <?php // class="table-responsive" 
            ?>

  </div>

  <?php

  if ($producto_mensaje == "si") {

    $producto_mensaje = 'no';
    echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>Producto ya agregado en reglon nro.:$ii.</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";
  }

  if (isset($_SESSION['cantidad_nulo']) && $_SESSION['cantidad_nulo'] == "si") {

    $nro_reglon_nulo = $_SESSION['nro_reglon_nulo'];
    unset($_SESSION['cantidad_nulo']);
    unset($_SESSION['nro_reglon_nulo']);

    echo "<script>
    		
    		$.alert({

            	title: 'Mensaje',
            	content: '<span style=color:red>Debes introducir la cantidad <br/> en el reglon nro.: $nro_reglon_nulo.</span>',
            	animation: 'scale',
            	closeAnimation: 'scale',
            	buttons: {
            		okay: {
               			text: 'Cerrar',
               			btnClass: 'btn-warning'
            		}
            	}
       		});	

    	</script>";
  }

  if (isset($hayexistencia) && $hayexistencia == "no") {

    echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>$producto_e no tiene existencia</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";
  }

  if (isset($hayexistencia_cant) && $hayexistencia_cant == "no") {

    echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>$producto_e no tiene existencia para esa cantida</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";
  }

  if (isset($_SESSION['hay_existencia_b']) && $_SESSION['hay_existencia_b'] == "no") {

    unset($_SESSION['hay_existencia_b']);
    $orden_b = $_SESSION['orden_b'];

    echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>Producto del reglon nro. $orden_b <br/> no tiene existencia</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";
  }

  // Boton Guardar
  if (isset($_SESSION['guardar']) && $_SESSION['guardar'] == "si") {

    unset($_SESSION['guardar']);

    if (isset($_SESSION['reglon_actualizado']) && $_SESSION['reglon_actualizado'] = "no") {

      unset($_SESSION['reglon_actualizado']);
      $nro_reglon3 = $_SESSION['nro_reglon3'];
      $mensaje_no_actualizado = $_SESSION['mensaje_no_actualizado'];

      echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>$mensaje_no_actualizado</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";
    } else {

      // confirmation para guardar
      echo "<script> 

				$.confirm({
					title: 'Mensaje',
					content: '¿Confirma en guardar?',
					animation: 'scale',
					closeAnimation: 'zoom',
					buttons: {
    					confirm: {
        				text: 'Si',
        				btnClass: 'btn-orange',
           				action: function(){

	          					location.href = 'crear_remito.php?guardar2=1';

       					} // action: function(){

				}, // confirm: {

					cancelar: function(){
              
  						} // cancelar: function()
    
					} // buttons
  
				}); // $.confirm

			</script>";
    }
  }

  
  ?>
  </main>
</body>
</html>
</html>