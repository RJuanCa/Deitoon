<?php
//session_start();
define("NRO_REGISTROS", 10);
require("LOGIN/db.php");

// Si se cerro la sesión por otro lado
$definido = isset($_SESSION['usuario']);
// No está definido la variable
if ($definido == false) {

  header("Location:LOGIN/index.html");

  exit();
}

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario-Deitoon</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  <style type="text/css">
    .pagina {
      padding: 8px 16px;
      border: 1px solid green;
      color: #000;
      font-weight: bold;
    }
    .usuario3 {

      color: #000;
      font-size: 16px;

    }
    .th_color {

      background: #66cc00;

    }
    /*pantalla Entrega*/
    .navbar {

      background: #66cc00;

    }
    .body1 {

      background: #66cc00;

    }
    .menu2 {

      font-size: 24px;
      color: #000;

    }

    .encab {

      font-size: 18px;

    }

    @media screen and (max-width:400px) {

      .menu2 {

        font-size: 19px;
        color: #000;

      }

    }
  </style>
</head>

<body class="body1">

  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <p class="navbar-brand"><span class="menu2">Entrega</span></p>
      <p class="navbar-brand"><span class="menu2"><a href="admin.html">Menú</a></span></p>

      </div>

      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>

  <div class="container">
    <p class="usuario3">

      <span class="encab">
        <span class="text-danger">
          Fecha : <?php echo $_SESSION['fecha']; ?>
          <br />
          Usuario: <?php echo $_SESSION['usuario']; ?>
        </span>
      </span>

    </p>
    <div class="row">
      <div class="col-md-12">
        <h2>Usuarios - Lista</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel-body">
          <?php
          function verfecha($vfecha)
          {
            $fch = explode("-", $vfecha);
            $tfecha = $fch[2] . "-" . $fch[1] . "-" . $fch[0];
            return $tfecha;
          }

          $search_keyword = '';
          if (!empty($_POST['search']['keyword'])) {
            $search_keyword = $_POST['search']['keyword'];
          }
          $sql = 'SELECT * FROM  `tab_usuarios` WHERE nombre LIKE :keyword OR apellido LIKE :keyword OR cedula LIKE :keyword ORDER BY nombre, apellido ';

          /* Pagination Code starts */
          $per_page_html = '';
          $page = 1;
          $start = 0;
          if (!empty($_POST["page"])) {
            $page = $_POST["page"];
            $start = ($page - 1) * NRO_REGISTROS;
          }
          $limit = " limit " . $start . "," . NRO_REGISTROS;
          $pagination_statement = $pdo_conn->prepare($sql);
          $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
          $pagination_statement->execute();

          $row_count = $pagination_statement->rowCount();
          if (!empty($row_count)) {
            $per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
            $page_count = ceil($row_count / NRO_REGISTROS);
            if ($page_count > 1) {
              for ($i = 1; $i <= $page_count; $i++) {
                if ($i == $page) {
                  $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
                } else {
                  $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
                }
              }
            }
            $per_page_html .= "</div>";
          }

          $query = $sql . $limit;
          $pdo_statement = $pdo_conn->prepare($query);
          $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
          $pdo_statement->execute();
          $resultados = $pdo_statement->fetchAll();
          ?>
          <form name='frmSearch' action='' method='post'>
            <div style='text-align:right;margin:20px 0px;'>

              <!--<input type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'>-->

              <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar..." name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='50'>
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
              </div><!-- /.row -->
            </div>
            <p><span class="encab"><a href="clientes_crear.php">Agregar Usuario</a></span></p>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr class='th_color'>

                    <th class='table-header' width='30%'>Usuario</th>
                    <th class='table-header' width='30%'>Mail</th>
                    <th class='table-header' width='14%'>Contraseña</th>
                    <th class='table-header' width='26%'>Nombre</th>
                    <th class='table-header' width='26%'>Apellido</th>
                    <th class='table-header' width='26%'>Cargo</th>

                  </tr>
                </thead>
                <tbody id='table-body'>
                  <?php
                  if (!empty($resultados)) {
                    foreach ($resultados as $row) {
                  ?>
                      <tr class='table-row'>

                        <td><?php echo $row['nombres']; ?></td>
                        <td><?php echo $row['apellidos']; ?></td>
                        <td><?php echo $row['cedula']; ?></td>
                        <td>

                          <a href="clientes_reporte.php?id_cliente=<?php echo $row['id_cliente'] ?>">Ver |</a>
                          <a href="clientes_editar.php" onclick="Validar3(<?php echo $row['id_cliente'] ?>, '<?php echo $row['nombres'] ?>')">Editar |</a>
                          <a href="clientes_eliminar_validar.php" onclick="Validar4(<?php echo $row['id_cliente'] ?>, '<?php echo $row['nombres'] ?>')">Eliminar |</a>
                          <a href="buscar_facturas.php?id_cliente=<?php echo $row['id_cliente'] ?>">Comprobantes |</a>

                        </td>

                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>

              </table>
            </div>
            <?php echo $per_page_html; ?>
          </form>

        </div>
      </div>
    </div>
  </div>
  <script>
    // Editar cliente
    function Validar3(id_cliente, nombres) {

      $.confirm({
        title: 'Mensaje',
        content: '¿Confirma en editar <br/> el cliente ' + nombres + '?',
        animation: 'scale',
        closeAnimation: 'zoom',
        buttons: {
          confirm: {
            text: 'Si',
            btnClass: 'btn-orange',

            action: function() {

              window.location.href = "clientes_editar.php?id_cliente=" + id_cliente;

            } // action: function(){

          }, // confirm: {

          cancelar: function() {

          } // cancelar: function()

        } // buttons

      }); // $.confirm

    }

    // Eliminar cliente
    function Validar4(id_cliente, nombres) {

      $.confirm({
        title: 'Mensaje',
        content: '¿Confirma en eliminar <br/> el cliente ' + nombres + '?',
        animation: 'scale',
        closeAnimation: 'zoom',
        buttons: {
          confirm: {
            text: 'Si',
            btnClass: 'btn-orange',

            action: function() {

              window.location.href = "clientes_eliminar_validar.php?id_cliente=" + id_cliente;

            } // action: function(){

          }, // confirm: {

          cancelar: function() {

          } // cancelar: function()

        } // buttons

      }); // $.confirm

    }
  </script>

  <?php

  // Cliente guardado
  if (isset($_SESSION['cliente_guardado']) && $_SESSION['cliente_guardado'] == "si") {

    unset($_SESSION['cliente_guardado']);

    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:green>Datos guardado con éxito.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";
  }

  if (isset($_SESSION['cliente_eliminado']) && $_SESSION['cliente_eliminado'] == "si") {

    unset($_SESSION['cliente_eliminado']);

    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:green>El Cliente se elimino con éxito.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";
  }

  if (isset($_SESSION['cliente_tiene_factura']) && $_SESSION['cliente_tiene_factura'] == "si") {

    unset($_SESSION['cliente_tiene_factura']);

    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:red>No se puede eliminar el cliente <br/>porque tiene remitos.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";
  }

  ?>

</body>

</html>