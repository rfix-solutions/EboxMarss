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

$hoy = date("Y-m-d H:i:s");
$TipoEnsayo = $_GET['te'];

$FirmaNombre = $_GET['firma_cliente_nombre'];
if($FirmaNombre == null || $FirmaNombre == ""){
	$FirmaNombre = "N/A";
}

$FirmaRut = $_GET['firma_cliente_rut'];
if($FirmaRut == null || $FirmaRut == ""){
	$FirmaRut = "11111111-1";
}

$Observaciones = $_GET['observaciones'];
if($Observaciones == null || $Observaciones == ""){
	$Observaciones = "Sin Observaciones";
}

$Kilometraje = $_GET['kilometraje'];
if($Kilometraje == null || $Kilometraje == ""){
	$Kilometraje = 0;
}


for($i=1; $i<= $_GET['cantidad_muestras']; $i++){
	$MuestraNombre = "t".$TipoEnsayo."_muestra_";

	$material_txt = "material".$i;
	$material = $_GET[$material_txt];

	$ubicacion_txt = "ubicacion".$i;
	$ubicacion = $_GET[$ubicacion_txt];

	$procedencia_txt = "procedencia".$i;
	$procedencia = $_GET[$procedencia_txt];


	$numero_sol = $_GET['numero_solicitud'];

	$query_insert = "
	INSERT INTO TBL_FormSS
	  (
	  id_agendamiento_visita,
	  id_tipo_ensayo,
		correlativo_obra,
	  fecha_solicitud,
		numero_solicitud,
	  inicio_servicio,
	  fin_servicio,
	  kilometraje,
	  realizado_por,
	  muestra,
	  observaciones,
	  cliente_nombre_firma,
	  cliente_rut_firma,
		material,
		ubicacion,
		procedencia,
		fecha_operacion
	  )
	VALUES
	  (
	  '".$_GET['id']."',
	  '".$_GET['te']."',
		'".$_GET['correlativo_obra']."',
	  '".$_GET['fecha_solicitud']."',
		'".$numero_sol."',
	  '".$_GET['hora_ini'].":00',
	  '".$_GET['hora_fin'].":00',
	  '".$Kilometraje."',
	  '".$_GET['realizado_por']."',
	  '".$i."',
	  '".$Observaciones."',
	  '".$FirmaNombre."',
	  '".$FirmaRut."',
		'".$material."',
		'".$ubicacion."',
		'".$procedencia."',
		'".$hoy."'
	  )
		";


		$sql_insert = mysqli_query($link, $query_insert) or die("Error en SQL de INSERT SOLICITUD SERVICIO".mysqli_error());;
		$sql_max_id = mysqli_query($link, "SELECT MAX(id_form_solicitud_servicio) AS MAYOR FROM TBL_FormSS")  or die("Error en SQL de ID MAYOR SOLICITUD SERVICIO".mysqli_error());;
		while($datos_ = mysqli_fetch_assoc($sql_max_id)){
			$id_form = $datos_['MAYOR'];
		}

		$query_informe ="
			INSERT INTO TBL_Informe
				(
					Informe_IdFormSS,
					Informe_IdFormCH,
					Informe_Tipo,
					Informe_FechaCreacion,
					Informe_Estado
				)
			VALUES
				(
					'".$id_form."',
					'0',
					'".$_GET['te']."',
					'".date("Y-m-d H:i:s")."',
					'1'
				)
		";

		$sql_informe = mysqli_query($link, $query_informe) or die("Error en SQL de INSERT INFORME".mysqli_error());;
		$error=0;
		for($j=1;$j<=8;$j++){
			$Muestra = $MuestraNombre.$j;
			if(isset($_GET[$Muestra])){
				foreach($_GET[$Muestra] as $IdEnsayo){
					//echo "Muestra".$i." : ".$ValorMuestra."</br>";
					$QRY_FormSSDet = "
						INSERT INTO TBL_FormSSDetalle
						(FormSS_Id, Muestra, Ensayo_IdEnsayo, FechaOperacion)
						VALUES
						('".$id_form."', '".$j."', '".$IdEnsayo."', '".date('Y-m-d H:i:s')."')
					";
					$SQL_FormSSDet = mysqli_query($link, $QRY_FormSSDet) or die ("Error en Insert Foreach".mysqli_error());;
				}
			}
		}
}
print("</pre>");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>.: EBOX PLATFORM :. </title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
	</head>
<body class="nav-md" role="main">
	<?php
	if($sql_insert && $sql_informe && $error==0){
	  ?>
	  <script>
	    alert("El registro ha sido realizado con éxito")
	    location.href="operaciones_ingreso_formulario_reg.php?id=<?php echo $_GET['id']?>"
	  </script>
	  <?php
	}
	else {

	  ?>
	  <script>
	    alert("Existen errores en el registro:\n<?php echo $error;?>")
			location.href="operaciones_ingreso_formulario_reg.php?id=<?php echo $_GET['id']?>"
	  </script>
	  <?php
	}
	?>
</body>
</html>

<?php ?>
