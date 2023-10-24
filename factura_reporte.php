<?php
include_once 'db.php';
session_start();

/*
Nota:
echo $_SESSION['productos2'][1]['id_producto'];
exit();
*/


if (isset($_GET['nro_remito'])) {

  $nro_remito = $_GET['nro_remito'];
  $fecha_rem = $_GET['fecha_rem'];
  $total = $_GET['total'];

  $_SESSION['nro_remito_rep'] = $nro_remito;
  $_SESSION['fecha_rem_rep'] = $fecha_rem;
  $_SESSION['total'] = $total;

  $sql = "SELECT  `remitos_descrip`.id_remito,  `remitos_descrip`.nro_remito,
  $sql .=  `remitos_descrip`.id_producto,`remitos_descrip`.cantidad,  `remitos_descrip`.precio_unitario,  
  $sql .= FROM remitos_descripcion AND 
  $sql .= tab_artículos.producto, tab_artículos.descripcion FROM tab_artículos 
  $sql .= INNER JOIN  `remitos_descrip` ON (tab_artículos.id_artículo =  `remitos_descrip`.id_producto) 
  $sql .= WHERE ( `remitos_descrip`.nro_remito = '. $nro_remito .'),
  $sql .= ORDER BY  `remitos_descrip`.nro_remito";

  $row = $mysqli->query($sql);
  $fila = $row->fetch_assoc();

  $total_renglones = $row->num_rows;
  $_SESSION['total_renglones_rep'] = $total_renglones;

  //$fila['precio_unitario']

  if ($total_renglones != 0) {

    $i = 0;
    while ($fila = $row->fetch_assoc()) {

      $i++;
      $_SESSION['productos2'][$i] = array(

        "cantidad" => $fila['cantidad'],
        "producto" => $fila['producto'],
        "descripcion" => $fila['descripcion'],
        "precio" => $fila['precio_unitario'],
        "orden"  => $i

      );
    } // for($i=0;$i<$_SESSION['total_productos'];$i++)

  } else { // if($total_renglones1=0)

    echo "Factura no tiene productos";
    exit();
  } // if($total_renglones1=0)

} // if(isset($_GET['nro_remito']))

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
      <a href="admin.php">
        <div class="option">
          <i class="fas fa-home" title="inicio"></i>
          <h4>Inicio</h4>
        </div>
      </a>

      <a href="remitos.php" class="selected">
        <div class="option">
          <i class="fas fa-file" title="Remitos"></i>
          <h4>Remitos</h4>
        </div>
      </a>

      <a href="usuario.php">
        <div class="option">
          <i class="fas fa-users" title="usuarios"></i>
          <h4>Usuarios</h4>
        </div>
      </a>

      <a href="productos.php">
        <div class="option">
          <i class="fas fa-wine-bottle" title="artículos"></i>
          <h4>Artículos</h4>
        </div>
      </a>

      <a href="index.php">
        <div class="option">
          <i class="fas fa-right-to-bracket" title="salir"></i>
          <h4>Salir</h4>
        </div>
      </a>
    </div>
  </div>


  <main>


    <div class="conteiner">
      <div>
        <div>
          <div>
            <h3 style="color: white;">REMITOS</h3>

            <br />

            <div class="espacio-tabla">
              <table class="table table-dark table-striped">
                <thead>
                  <tr>
                    <th scope="col">REMITO Nro.</th>
                    <th scope="col">FECHA REMITO</th>
                    <th scope="col">CLIENTE</th>
                    <th scope="col">CUIL/CUIT</th>
                    <th scope="col">DIRECCION</th>
                    <th scope="col">CORREO</th>
                    <th scope="col">CANTIDAD PROD.</th>
                    <th scope="col">MOVIMIENTOS</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $sql = "SELECT `tab_remito`.*, `remitos_descrip`.*, `tab_usuarios`.`id_usuario` FROM `tab_remito` LEFT JOIN `remitos_descrip` ON `remitos_descrip`.`nro_remito` = `tab_remito`.`nro_remito`, `tab_usuarios`";
                  $result = mysqli_query($conexion, $sql);
                  while ($mostrar = mysqli_fetch_array($result)) {

                  ?>
                    <tr>
                      <td><?php echo $mostrar['nro_remito'] ?></th>
                      <td><?php echo $mostrar['fecha_rem'] ?></th>
                      <td><?php echo $mostrar['apellido'] ?></th>
                      <td><?php echo $mostrar['cuil/cuit'] ?></th>
                      <td><?php echo $mostrar['direccion'] ?></th>
                      <td><?php echo $mostrar['e-mail'] ?></th>
                      <td><?php echo $mostrar['cantidad'] ?></th>
                      <td><?php echo $mostrar['movimientos'] ?></th>
                      <td>
                        <a class="btn btn-success" href="remito_editar.php?id=<?php echo $mostrar['nro_remito'] ?>">Editar</a>

                        <form action="remito_eliminar.php" method="post">
                          <input type="hidden" value="<?php echo $mostrar['nro_remito'] ?>" name="txtNro" readonly>
                      <td><input class="btn btn-danger" type="submit" value="Eliminar" name="btnEliminar"></td>
                      </form>

                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="js/script.js"></script>

  </main>
</body>

</html>