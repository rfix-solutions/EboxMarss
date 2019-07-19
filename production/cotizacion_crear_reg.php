<?php
if(!isset($_SESSION))
{
		session_start();
}
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
}
else
{?>
	<script type="text/javascript">
		alert("Esta pagina es solo para usuarios registrados.")
		location.href="../login/index.php?url=<?php echo $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];?>";
	</script>
<?php
		exit;
}
include '_qry/db_connect_local.php';

//printf("<pre>");

$rut_cliente = $_GET['rut_cliente'];
$nombre_cliente = strtoupper($_GET['nombre_cliente']);
$nombre_proyecto = strtoupper($_GET['nombre_proyecto']);
$localidad = strtoupper($_GET['localidad']);
$email = strtoupper($_GET['email']);
$contacto = strtoupper($_GET['contacto']);
$telefono = $_GET['telefono'];
$origen = $_GET['origen'];
$ensayos = $_GET['ensayos'];
$destinos = $_GET['destinos'];
$tipo_descuento = $_GET['tipo_descuento'];
$valor_descuento = $_GET['valor_descuento'];
$autoriza = $_GET['autoriza'];
$fecha = date("Y-m-d H:i:s");


//print("<pre>");


$Qry_Sucursal = "
	SELECT s.codigo_sucursal as SUCURSAL
	FROM TBL_Usuario u, TBL_Sucursal s
	WHERE
		u.id_usuario = '".$_SESSION['id_user']."' AND
		u.id_sucursal = s.id_sucursal
";
$Sql_Sucursal = mysqli_query($link, $Qry_Sucursal)or die('Consulta 1 fallida: '.mysqli_error($link));;

while($rows = mysqli_fetch_assoc($Sql_Sucursal)){	$sucursal = $rows['SUCURSAL']; }

$Qry_Correlativo = "
	SELECT MAX(id_correlativo_cotizacion) as CORRELATIVO, id_correlativo_cotizacion AS ID_COT FROM TBL_CotizacionCorr
";
$Sql_Correlativo = mysqli_query($link, $Qry_Correlativo)or die('Consulta 2 fallida: '.mysqli_error($link));;

while($rows = mysqli_fetch_assoc($Sql_Correlativo)){
	$correlativo = $rows['CORRELATIVO'];
	if($correlativo==null){ $correlativo = 0; }
	$correlativo++;
}

$n_cotizacion = $sucursal."-".$correlativo."-".date("Y");

$Qry_Insert_Correlativo = "
	INSERT INTO TBL_CotizacionCorr
	(codigo_sucursal, ano, id_estado_correlativo)
	VALUES
	('".$sucursal."', '".date("Y")."', '1')
";
$Sql_Insert_Correlativo = mysqli_query($link, $Qry_Insert_Correlativo)or die('Consulta 3 fallida: '.mysqli_error($link));;


foreach ($ensayos as $id_ensayo){
	$Qry_Ensayo = "
		SELECT
			id_ensayo as ID, nombre_ensayo as NOMBRE_ENSAYO, precio as PRECIO
		FROM
			TBL_Ensayo
		WHERE
			id_ensayo = '".$id_ensayo."'
	";
	$Sql_Ensayo = mysqli_query($link, $Qry_Ensayo)or die('Consulta 4 fallida: '.mysqli_error($link));;

	$numero_cotizacion = $sucursal."-".$correlativo."-".date('Y');

	while($row = mysqli_fetch_assoc($Sql_Ensayo)){
		$ensayo_id = $row['ID'];
		$ensayo_nombre = $row['NOMBRE_ENSAYO'];
		$ensayo_precio = $row['PRECIO'];

		$Qry_TBL_CotizacionDetalleEnsayos = "
			INSERT INTO TBL_CotizacionDetalleEnsayos
			(id_correlativo_cotizacion, numero_cotizacion, version_cotizacion, id_ensayo, valor_ensayo, id_estado_ensayo)
			VALUES
			('".$correlativo."', '".$numero_cotizacion."', '1', '".$ensayo_id."', '".$ensayo_precio."', '1')
		";
		$Sql_TBL_CotizacionDetalleEnsayos = mysqli_query($link, $Qry_TBL_CotizacionDetalleEnsayos )or die('Consulta 5 fallida: '.mysqli_error($link));;
	}
}

foreach ($destinos as $id_destino){
	$Qry_Destino = "
		SELECT
			id_destino as ID, nombre_destino as NOMBRE, precio as PRECIO
		FROM
			TBL_Destino
		WHERE
			id_destino = '".$id_destino."'
	";
	$Sql_Destino = mysqli_query($link, $Qry_Destino)or die('Consulta 6 fallida: '.mysqli_error($link));;

	while($row2 = mysqli_fetch_assoc($Sql_Destino)){
		$destino_nombre = $row2['NOMBRE'];
		$destino_id = $row2['ID'];
		$destino_precio = $row2['PRECIO'];

		$Qry_TBL_CotizacionDetalleDestino = "
			INSERT INTO TBL_CotizacionDetalleDestino
			(id_correlativo_cotizacion, numero_cotizacion, version_cotizacion, id_destino, precio_destino)
			VALUES
			('".$correlativo."', '".$n_cotizacion."', '1', '".$destino_id."', '".$destino_precio."')
		";
		$Sql_TBL_CotizacionDetalleDestino = mysqli_query($link, $Qry_TBL_CotizacionDetalleDestino)or die('Consulta 7 fallida: '.mysqli_error($link));;
	}
}


/*
$Qry_Insert_TBL_Cliente = "
	INSERT INTO TBL_Cliente
	(rut_cliente, razon_social, direccion_cliente, contacto_cliente, telefono_cliente, email_cliente, id_estado_cliente, id_forma_pago_cli, id_periodo_pago_cli)
	VALUES
	('".$rut_cliente."', '".$nombre_cliente."', '".$localidad."', '".$contacto."', '".$telefono."', '".$email."', '1', '1', '1')
";

$SQL_Insert_TBL_Cliente = mysqli_query($link, $Qry_Insert_TBL_Cliente)or die('Consulta 8 fallida: '.mysqli_error());;
*/

$Qry_Cliente = "
	SELECT id_cliente FROM TBL_Cliente WHERE rut_cliente ='".$rut_cliente."'
";

$Sql_Cliente = mysqli_query($link, $Qry_Cliente)or die('Consulta 9 fallida: '.mysqli_error($link));;
while($fila = mysqli_fetch_assoc($Sql_Cliente)){
	$id_cliente = $fila['id_cliente'];
}


$Qry_Insert_TBL_Cotizacion = "
	INSERT INTO TBL_Cotizacion
	(
		id_cliente,
		id_tipo_descuento,
		id_origen,
		numero_cotizacion,
		id_correlativo_cotizacion,
		version_cotizacion,
		nombre_proyecto,
		fecha_creacion,
		nombre_contacto,
		email_contacto,
		id_usuario,
		id_estado_cotizacion,
		id_estado_envio,
		id_lab_asignado
	)
	VALUES
	(
		'".$id_cliente."',
		'".$tipo_descuento."',
		'".$origen."',
		'".$n_cotizacion."',
		'".$correlativo."',
		'1',
		'".$nombre_proyecto."',
		'".$fecha."',
		'".$contacto."',
		'".$email."',
		'1',
		'1',
		'1',
		'15'
	)
";


$SQL_Insert_TBL_Cotizacion = mysqli_query($link, $Qry_Insert_TBL_Cotizacion )or die('Consulta 10 fallida: '.mysqli_error($link));;

$Qry_MaxCot = "
	SELECT MAX(id_cotizacion) AS MAYOR FROM TBL_Cotizacion
";

$Sql_MaxCot = mysqli_query($link, $Qry_MaxCot) or die ("Error en Cotizacion Mayor" . mysqli_error($link));
while($row = mysqli_fetch_assoc($Sql_MaxCot)){
	$mayor = $row['MAYOR'];
	if($mayor <= 0 || $mayor == "0" || $mayor == null){ $mayor = 1; }
}

$query_form_aceptacion = "
	INSERT INTO TBL_FormAC
	(
		empresa_solicitante,
		fecha_aceptacion,
		nombre_solicitante,
		email_solicitante,
		empresa_constructora,
		nombre_obra,
		codigo_obra,
		direccion_obra,
		comuna_obra,
		fono_obra,
		encargado_terreno,
		email_encargado,
		telefono_encargado,
		id_entidad_fiscal,
		empresa_encargada,
		profesional_acargo,
		razon_social,
		rut_empresa_factura,
		giro_empresa,
		direccion_factura,
		nombre_ciudad,
		id_periodo_facturacion,
		id_forma_pago,
		telefono_facturacion,
		email_facturacion,
		nombre_aceptante,
		id_cotizacion,
		estado_formulario
	)
	VALUES
	(
		'".$nombre_cliente."',
		'".date("Y-m-d H:i:s")."',
		'".$nombre_cliente."',
		'".$email."',
		'N/A',
		'".$nombre_proyecto."',
		'N/A',
		'".$localidad."',
		'0',
		'".$telefono."',
		'".$contacto."',
		'".$email."',
		'".$telefono."',
		'4',
		'".$nombre_cliente."',
		'".$contacto."',
		'".$nombre_cliente."',
		'".$rut_cliente."',
		'50',
		'".$localidad."',
		'50',
		'4',
		'7',
		'".$telefono."',
		'".$email."',
		'".$nombre_cliente."',
		'".$mayor."',
		'0'
	)
";

$insert_form_aceptacion = mysqli_query($link, $query_form_aceptacion)or die('Consulta 11 fallida: '.mysqli_error($link));;

$url = "cotizacion_crear_res.php?id=".$mayor."&ensayos_cot=".serialize($ensayos)."&destinos_cot=".serialize($destinos)."";
header("Location: ".$url."");

//print("</pre>");

?>
