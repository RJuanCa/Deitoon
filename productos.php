<?php
session_start();
define("NRO_REGISTROS", 20);
include_once 'db.php';

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
      <a href="admin.php" >
        <div class="option">
          <i class="fas fa-home" title="inicio"></i>
          <h4>Inicio</h4>
        </div>
      </a>

      <a href="remitos.php">
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

      <a href="productos.php"class="selected">
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
    <div class="row">
      
        <h3 style="color: white;">Articulos - Lista</h3>
      

    <div class="row">
        <div style="color: white;" class="panel-body">
          <?php
          $search_keyword = '';
          if (!empty($_POST['search']['keyword'])) {
            $search_keyword = $_POST['search']['keyword'];
          }
          $sql = 'SELECT * FROM `tab_artículos` WHERE (cod_articulo LIKE :keyword OR producto LIKE :keyword OR descripcion LIKE :keyword) ORDER BY producto ASC ';

          /* Pagination Code starts */
          $per_page_html = '';
          $page = 1;
          $start = 0;
          if (!empty($_POST["page"])) {
            $page = $_POST["page"];
            $start = ($page - 1) * NRO_REGISTROS;
            $nro = $start;
          }
          
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

          ?>
          <form name='frmSearch' action='' method='post'>

              <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                  <div class="input-group">
                    <input width='20%' type="text" class="form-control" placeholder="Buscar..." name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='50'>
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
              </div><!-- /.row -->

            <div class="table-responsive">
            <div class="reporte">
              <a class="btn btn-success" href="productos_crear.html">Agregar Producto</a>
            </div>

            <br>
              <table class="table table-dark table-striped">
                <thead>
                  <tr class='th_color'>
                    <th scope="col" width='10%'>Cód. Articulo </th>
                    <th scope="col" width='10%'>Producto</th>
                    <th scope="col" width='20%'>Descripción</th>
                    <th scope="col" width='10%'>Precio</th>
                    <th scope="col" width='10%'>Existencia</th>
                    <th scope="col" width='20%'>Acción</th>
                  </tr>
                </thead>
                <tbody id='table-body'>
                  
    <?php

$sql="SELECT * FROM `tab_artículos`";
$result= mysqli_query($conexion, $sql);
while($mostrar=mysqli_fetch_array($result)){

?>
<tr>
<td scope="col" width='10%'><?php echo $mostrar['cod_articulo'] ?></th>
<td scope="col" width='10%'><?php echo $mostrar['producto'] ?></th>
<td scope="col" width='20%'><?php echo $mostrar['descripcion'] ?></th>
<td scope="col" width='10%'><?php echo $mostrar['precio'] ?></th>
<td scope="col" width='10%'><?php echo $mostrar['cant_existencia'] ?></th>
<td scope="col" width='10%'>
  <a class="btn btn-success" href="productos_editar.php?id=<?php echo $mostrar['id_artículo'] ?>">Editar</a>
  
  <form action="productos_eliminar.php" method="post">
    <input type="hidden" value="<?php echo $mostrar['id_artículo'] ?>" name="txtId">
    <td><input class="btn btn-danger" type="submit" value="Eliminar" name="btnEliminar"></td>
  </form>
  
</td>
</tr>
<?php
}
?>
</tbody>
</table>
<div class="reporte">
  <a class="btn btn-warning" href="reporte.php">Imprimir Reporte</a>
</div>
</div><!--table-responsive-->
<?php echo $per_page_html; ?>
</form>
Página <?php echo $page; ?>

      </div><!--panel-body-->
  </div><!--row-->
  <script  src="js/script.js"></script>
    </main>
</body>

</html>