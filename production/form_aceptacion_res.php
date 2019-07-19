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
print("<pre>");


$hoy = date("Y-m-d h:i:s");
$query_comuna_obra = mysqli_query($link, "SELECT comuna_id FROM TBL_Comuna WHERE comuna_nombre = '".$_GET['comuna_obra']."'");
while ($fila = mysqli_fetch_assoc($query_comuna_obra)) {
	$comuna_obra = $fila['comuna_id'];
}
$query_comuna_facturacion = mysqli_query($link, "SELECT comuna_id FROM TBL_Comuna WHERE comuna_nombre = '".$_GET['ciudad_facturacion']."'");
while ($fila = mysqli_fetch_assoc($query_comuna_facturacion)) {
	$comuna_facturacion = $fila['comuna_id'];
}

$query = "
UPDATE TBL_FormAC
SET
		empresa_solicitante = '".$_GET['empresa_solicitante']."',
		fecha_aceptacion = '".$hoy."',
		nombre_solicitante = '".$_GET['nombre_solicitante']."',
		email_solicitante = '".$_GET['email_solicitante']."',
		empresa_constructora = '".$_GET['empresa_constructora']."',
		nombre_obra = '".$_GET['nombre_obra']."',
		codigo_obra = '".$_GET['codigo_obra']."',
		direccion_obra = '".$_GET['direccion_obra']."',
		comuna_obra = '".$comuna_obra."',
		fono_obra = '".$_GET['fono_obra']."',
		encargado_terreno = '".$_GET['encargado_terreno']."',
		email_encargado = '".$_GET['email_encargado']."',
		telefono_encargado = '".$_GET['telefono_encargado']."',
		id_entidad_fiscal = '".$_GET['entidad_fiscal']."',
		empresa_encargada = '".$_GET['empresa_encargada']."',
		profesional_acargo = '".$_GET['profesional_acargo']."',
		razon_social = '".$_GET['razon_social']."',
		rut_empresa_factura = '".$_GET['rut_empresa_factura']."',
		giro_empresa = '".$_GET['giro_empresa']."',
		direccion_factura = '".$_GET['direccion_factura']."',
		nombre_ciudad = '".$comuna_facturacion."',
		id_periodo_facturacion = '".$_GET['periodo_facturacion']."',
		id_forma_pago = '".$_GET['forma_pago']."',
		Referencia_Id = '".$_GET['referencia']."',
		telefono_facturacion = '".$_GET['telefono_facturacion']."',
		email_facturacion = '".$_GET['email_facturacion']."',
		nombre_aceptante = '".$_GET['nombre_aceptante']."',
		estado_formulario = '1'
WHERE
		id_cotizacion = '".$_GET['cot_id']."'
";

$QRYObra = "
INSERT INTO TBL_Obra
	(
		Obra_Nombre,
		Obra_Direccion,
		Obra_Codigo,
		Obra_ComunaId,
		Obra_EncargadoNombre,
		Obra_EncargadoEmail,
		Obra_EncargadoTel,
		Obra_Telefono,
		Obra_ClienteId
	)
VALUES
	(
		'".$_GET['nombre_obra']."',
		'".$_GET['direccion_obra']."',
		'".$_GET['codigo_obra']."',
		'".$comuna_obra."',
		'".$_GET['encargado_terreno']."',
		'".$_GET['email_encargado']."',
		'".$_GET['telefono_encargado']."',
		'".$_GET['fono_obra']."',
		'".$_GET['cli_id']."'
	)
";
$SQLObra = mysqli_query($link, $QRYObra) or die ("Error en SQL OBRA:".mysqli_error($link));;

$sql = mysqli_query($link, $query)or die('Error En Registrar la Aceptación: '.mysqli_error($link));;




if($sql){
	$QRY_Insert = "
		INSERT INTO TBL_CotizacionGestion
		(id_cotizacion, detalle_historial_cotizacion, fecha_historial_cotizacion, id_usuario)
		VALUES
		('".$_GET['cot_id']."', 'Cotizacion aceptada por el cliente', '".date("Y-m-d H:i:s")."', '".$_SESSION['id_user']."')
	";

	$SQL_Insert = mysqli_query($link, $QRY_Insert) or die ("Error en QRY INSERT:" . mysqli_error($link));;

	$QRY_Update = "
		UPDATE TBL_Cotizacion SET id_estado_cotizacion = '3' WHERE id_cotizacion = '".$_GET['cot_id']."'
	";
	$SQL_Update = mysqli_query($link, $QRY_Update) or die ("Error en QRY UPDATE:" . mysqli_error($link));;

	?>
	<script>
		alert("La Aceptación ha sido registrada con éxito");
		location.href="dashboard_comercial.php";
	</script>
<?php
}
print("</pre>");
?>
