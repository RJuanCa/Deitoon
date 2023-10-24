<?php

require_once 'db.php';

session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

	header("Location:#");
	exit();
         
}

//echo "Funciona ...";
//echo $_SESSION['cantidad3'][2];
//echo $_SESSION['orden3'];
//exit();

// Chequea si hay un valor vacio
for($i=1;$i<=$_SESSION['total_productos'];$i++){

	if(empty($_SESSION['carrito'][$i]['cantidad'])){

		$_SESSION['nro_reglon_nulo']=$i;
		$_SESSION['cantidad_nulo']="si";

		//echo "<p style='font-family: Arial; font-size: 11pt; color: red'>Debes introducir la cantidad en el reglon nro.".$_SESSION['carrito'][$i]['orden']."</p>";

		echo "<script>location.href = 'crear_remito.php'</script>";
		exit();

	}
	
} // for($i=0;$i<$_SESSION['total_productos'];$i++)

// Chequea si hay existencia
for($i=1;$i<=$_SESSION['total_productos'];$i++){

	$id_producto_b=$_SESSION['carrito'][$i]['id_artículo'];

	// Buscar id_producto
	$sql3="SELECT id_artículo, cant_existencia, FROM tab_artícilos WHERE (id_artículo = ".$id_producto_b.")";
	$query3=$mysqli->query($sql3);
	$row3=$query3->fetch_assoc();

	if($query3->num_rows==0){

    	$existencia_b=0;

	}else{

		$existencia_b=$row3["cantidad_existencia"];

	}	

	//echo $_SESSION['carrito'][$i]['orden'];
	//exit();

	if($_SESSION['carrito'][$i]['cantidad']>$existencia_b){

		$_SESSION['hay_existencia_b']="no";
		$_SESSION['orden_b']=$_SESSION['carrito'][$i]['orden'];
				
		echo "<script>location.href = 'crear_remito.php'</script>";
		exit();

	}else{

		$existencia_bd=$existencia_b-$_SESSION['carrito'][$i]['cantidad'];
		$nor_ventas_bd=$nor_ventas_b+$_SESSION['carrito'][$i]['cantidad'];

		// Guarda datos 
		$sql="UPDATE tab_artículos SET cant_existencia = '".$existencia_bd."'";
		$sql.="WHERE (tab_artículos.id_artículo = ".$id_producto_b.")";

		$query = $mysqli->query($sql);

	}
	
} // for($i=0;$i<$_SESSION['total_productos'];$i++)

$total_productos=0;
// Chequea totales
for($i=1;$i<=$_SESSION['total_productos'];$i++){

	$total_productos=$total_productos+$_SESSION['carrito'][$i]['cantidad']*$_SESSION['carrito'][$i]['precio'];
	
} // for($i=0;$i<$_SESSION['total_productos'];$i++)

if($total_productos!=$_SESSION['totalprice']){

	echo "<p style='font-family: Arial; font-size: 11pt; color: red'>Totales no coinciden</p>";
	exit();

}

/*

$_SESSION['carrito'][$i]['precio']
$_SESSION['carrito'][$i]['cantidad']

$_SESSION['id_cliente']
$_SESSION["id_usuario"]
$_SESSION['fecha']

*/

$id_cliente=$_SESSION['id_cliente'];
$id_usuario=$_SESSION["id_usuario"];
$total_precio=$_SESSION['totalprice'];

$valores_fecha_act = explode('-', $_SESSION['fecha']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];

$hora_actual=$_SESSION['hora_actual'];

// Guarda datos en tab_remito
$sql2="INSERT INTO tab_remito (nro_remito,fecha_rem,id_cliente)";
$sql2.="VALUES ('$nro_remito_nuevo','$fecha_act','$id_cliente','$total_precio','$id_usuario')";
$query2=$mysqli->query($sql2);

// Buscar id_remito
$sql3="SELECT nro_remito FROM tab_remito WHERE (nro_remito = ".$nro_remito_nuevo.")";
$query3=$mysqli->query($sql3);
$row3=$query3->fetch_assoc();

//Guarda datos en tab_remito_descrip
for($i=1;$i<=$_SESSION['total_productos'];$i++){

	$id_orden=$_SESSION['carrito'][$i]['orden'];
	$id_producto=$_SESSION['carrito'][$i]['id_producto'];
	$cantidad=$_SESSION['carrito'][$i]['cantidad'];
	$precio_unitario=$_SESSION['carrito'][$i]['precio_unitario'];
	$precio_total=$_SESSION['carrito'][$i]['cantidad']*$_SESSION['carrito'][$i]['precio_unitario'];

	$sql4="SELECT precio "; 
  	$sql4.="FROM tab_artículos WHERE (id_artículo = $id_producto)";

  	$query4 = $mysqli->query($sql4);
  	$row4=$query4->fetch_assoc();
  	$precio_costo=$row4['precio'];

	$sql4="INSERT INTO tab_remito_descrip (id_remito,nro_remito,id_producto,cantidad,precio_unitario,) ";
	$sql4.="VALUES ('$id_remito','$id_orden','$id_producto','$cantidad','$precio_unitario')";
	$query4=$mysqli->query($sql4);

} // for($i=1;$i<=$_SESSION['total_productos'];$i++)

// Chequea si el cliente tiene movimientos
$sql8="SELECT movimientos FROM tab_clientes WHERE (id_cliente = $id_cliente)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimientos'];

if($movimiento8=='no'){

	$sql9="UPDATE tab_clientes SET movimientos = 'si' ";
	$sql9.="WHERE (tab_clientes.id_cliente = ".$id_cliente.")"; 

	$query9 = $mysqli->query($sql9);

}

$id_usuario_cp=$_SESSION["id_usuario"];

unset($_SESSION['carrito']);
unset($_SESSION['total_productos']);
unset($_SESSION['descuento']);

// echo "<script>alert('remito registrada exitosamente.')</script>";

$_SESSION['remito_guardada']="si";
//echo "<script>location.href = 'crear_remito.php?id_cliente=".$id_cliente."'</script>";

?>