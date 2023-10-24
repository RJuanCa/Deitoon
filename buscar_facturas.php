<?php
session_start();
define("NRO_REGISTROS", 10);
include_once 'db.php';

// Si se cerro la sesión por otro lado
$definido = isset($_SESSION['usuario']);
// No está definido la variable
if (!$definido == false) {

  header("Location:admin.php");

  exit();
}

if (isset($_GET['id_cliente'])) {

  $id_cliente = $_GET['id_cliente'];

  $sql2 = "SELECT * FROM `tab_clientes` WHERE (id_cliente = '$id_cliente')";

  $query2 = $pdo_conn->prepare($sql2);
  $query2->execute();
  $results = $query2->fetchAll(PDO::FETCH_OBJ);

  if ($query2->rowCount() > 0) {

    foreach ($results as $result) {

      $cliente = $result->nombres . " " . $result->apellido;
      $_SESSION['id_cliente'] = $id_cliente;
      $_SESSION['cliente'] = $cliente;
      $_SESSION['cuil/cuit'] = $result->cuil;
      $_SESSION['telefono'] = $result->telefono;
    } // foreach($results as $result)

  } // if($query2 -> rowCount() > 0)

} // if(isset($_GET['id_cliente']))	

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

<body class="body1">
  <div class="container">
    <p class="usuario3">
      <br />
      <br />
      <b style="color: white;">Cliente:</b> <?php echo $_SESSION['cliente']; ?>
      <br />
      <b style="color: white;">Cuil/Cuit:</b> <?php echo $_SESSION['cuil/cuit']; ?>
      <br />
      <b style="color: white;">Teléfono:</b> <?php echo $_SESSION['telefono']; ?>
      <br />


    </p>
    <div class="row">
      <div class="col-md-12">
        <h2 style="color: white;">Cliente - Comprobantes - Lista</h2>
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
          $sql = 'SELECT * FROM tab_remito WHERE (nro_remito LIKE :keyword OR fecha_rem LIKE :keyword OR total_artic LIKE :keyword  AND (id_cliente = ' . $_SESSION['id_cliente'] . ') ORDER BY nro_remito DESC';

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

            <div class="table-responsive">

              <p><span class="encab"><a href="crear_factura.php">Generar
                    Comprobante
                  </a></span></p>
              <table class="table table-bordered table-hover">
                <thead>
                  <tr class='th_color'>

                    <th class='table-header' width='12%'>Nro. Cpmprobante</th>
                    <th class='table-header' width='10%'>Fecha</th>
                    <th class='table-header' width='10%'>Anulado</th>
                    <th class='table-header' width='20%'>Enlace</th>

                  </tr>
                </thead>
                <tbody id='table-body'>
                  <?php
                  if (!empty($resultados)) {
                    foreach ($resultados as $row) {

                      /*
			$valores[0], año
			$valores[1], mes
			$valores[2], dia
			*/

                      $valores_fecha_reg = explode('-', $row['fecha_reg']);
                      $fecha_reg = $valores_fecha_reg[2] . "-" . $valores_fecha_reg[1] . "-" . $valores_fecha_reg[0];

                  ?>
                      <tr class='table-row'>

                        <td><?php echo $row['nro_remito']; ?></td>
                        <td><?php echo $fecha_reg; ?></td>
                        <td><?php echo $row['anulado']; ?></td>
                        <td>
                          <a href="factura_reporte.php?nro_remito=<?php echo $row['nro_remito'] ?>&fecha_reg=<?php echo $fecha_reg ?>&total=<?php echo $row['total_artic'] ?>">Ver Comprobante</a>
                          <?php

                          if ($row['anulado'] == 'no') {

                            $nro_remito_anular = $row['nro_remito'];
                            $id_cliente_a = $_SESSION['id_cliente'];

                            echo "<a href='#' onclick='Validar4($nro_remito_anular, $id_cliente_a)'>Anular</a>";
                          } else {

                            echo "";
                          }

                          ?>
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
    // Anular factura
    function Validar4(nro_remito, id_cliente) {

      $.confirm({
        title: 'Mensaje',
        content: '¿Confirma en anular <br/> el remito nro. ' + nro_remito + '?',
        animation: 'scale',
        closeAnimation: 'zoom',
        buttons: {
          confirm: {
            text: 'Si',
            btnClass: 'btn-orange',

            action: function() {

              window.location.href = "anular_factura_validar.php?nro_remito=" + nro_remito + "&id_cliente=" + id_cliente;

            } // action: function(){

          }, // confirm: {

          cancelar: function() {

          } // cancelar: function()

        } // buttons

      }); // $.confirm

    }
  </script>

  <?php

  if (isset($_SESSION['factura_guardada']) && $_SESSION['factura_guardada'] == "si") {

    unset($_SESSION['factura_guardada']);
    unset($_SESSION['descuento']);

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

  ?>

  <?php

  if (isset($_SESSION['factura_anulada']) && $_SESSION['factura_anulada'] == "si") {

    unset($_SESSION['factura_anulada']);

    echo "<script>

		$.confirm({
    	title: 'Mensaje',
    	content: '<span style=color:green>Factura anulado con éxito.</span>',
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