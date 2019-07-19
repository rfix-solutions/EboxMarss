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

if(
!isset($_GET['aspecto']) ||
!isset($_GET['aditivos']) ||
!isset($_GET['cono']) ||
!isset($_GET['correlativo_obra']) ||
!isset($_GET['cantidad_muestras']) ||
!isset($_GET['construye']) ||
!isset($_GET['cod_hormigon']) ||
!isset($_GET['correlativo']) ||
!isset($_GET['compresion']) ||
!isset($_GET['curado_obra']) ||
!isset($_GET['curado']) ||
!isset($_GET['camion']) ||
!isset($_GET['elemento_hormigonado']) ||
!isset($_GET['equipo_cono']) ||
!isset($_GET['fecha_solicitud']) ||
!isset($_GET['fecha_muestra']) ||
!isset($_GET['guia']) ||
!isset($_GET['hora_control']) ||
!isset($_GET['hora_ini']) ||
!isset($_GET['hora_fin']) ||
!isset($_GET['hora_carga_planta']) ||
!isset($_GET['hora_salida_planta']) ||
!isset($_GET['hora_llegada_planta']) ||
!isset($_GET['hora_inicio_descarga']) ||
!isset($_GET['hora_termino_descarga']) ||
!isset($_GET['id']) ||
!isset($_GET['lugar_extraccion']) ||
!isset($_GET['movimiento']) ||
!isset($_GET['marca']) ||
!isset($_GET['M3']) ||
!isset($_GET['probeta']) ||
!isset($_GET['procedencia']) ||
!isset($_GET['observaciones']) ||
!isset($_GET['otros']) ||
!isset($_GET['resistencia_tipo']) ||
!isset($_GET['responsable_muestreo']) ||
!isset($_GET['regla_metrica']) ||
!isset($_GET['realizado_por']) ||
!isset($_GET['textura']) ||
!isset($_GET['termometro']) ||
!isset($_GET['te']) ||
!isset($_GET['TempHormigon']) ||
!isset($_GET['TempAmbiente']) ||
!isset($_GET['vibrador_sonda'])
){?>
	<script type="text/javascript">
		alert("No ha ingresado todos los datos del formulario. Por favor, intente nuevamente.")
		history.back();
	</script>
<?php
		exit;
}

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
		<!-- Bootstrap -->
		<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- bootstrap-daterangepicker -->
		<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<!-- bootstrap-datetimepicker -->
		<link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
		<!-- Ion.RangeSlider -->
		<link href="../vendors/normalize-css/normalize.css" rel="stylesheet">
		<link href="../vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
		<link href="../vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
		<!-- Bootstrap Colorpicker -->
		<link href="../vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
		<link href="../vendors/cropper/dist/cropper.min.css" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
	<body class="nav-md" role="main">


<?php


print("<pre>");

$error = 0;
$cantidad = $_GET['cantidad_muestras'];
$DosificacionDeclarada = $_GET['DOSD_tipo']."-".$_GET['DOSD_resistencia']."-".$_GET['DOSD_nivel']."-".$_GET['DOSD_tamano']."-".$_GET['DOSD_densidad'];
$Kilometraje = $_GET['kilometraje'];
if($Kilometraje == null || $Kilometraje == ""){
	$Kilometraje = 0;
}
$numero_sol = $_GET['numero_solicitud'];
$QRY_FormHM = "
	INSERT INTO	TBL_FormHM
	(
		id_agendamiento_visita,
		id_tipo_ensayo,
		numero_solicitud,
		correlativo_obra,
		fecha_solicitud,
		hora_ini,
		hora_fin,
		kilometraje,
		realizado_por,
		cantidad_muestras,
		construye,
		cod_hormigon,
		fecha_muestra,
		hora_control,
		correlativo
	)
	VALUES
	(
		'".$_GET['id']."',
		'".$_GET['te']."',
		'".$numero_sol."',
		'".$_GET['correlativo_obra']."',
		'".$_GET['fecha_solicitud']."',
		'".$_GET['hora_ini'].":00',
		'".$_GET['hora_fin'].":00',
		'".$Kilometraje."',
		'".$_GET['realizado_por']."',
		'".$_GET['cantidad_muestras']."',
		'".$_GET['construye']."',
		'".$_GET['cod_hormigon']."',
		'".$_GET['fecha_muestra']."',
		'".$_GET['hora_control']."',
		'".$_GET['correlativo']."'
	)
	";

$SQL_FormHM = mysqli_query($link, $QRY_FormHM) or die('Error en QRY FormHM: '.mysqli_error($link));;
if(!$SQL_FormHM){
	$error++;
}

$SQL_FormHM_MAX = mysqli_query($link, "SELECT MAX(id_form_c_h_m) AS MAYOR FROM TBL_FormHM")  or die("Error en SQL de ID MAYOR CONTROL HORMIGONES".mysqli_error());;
if(!$SQL_FormHM_MAX){
	$error++;
}
while($FormHM_Max = mysqli_fetch_assoc($SQL_FormHM_MAX)){
	$FormHM = $FormHM_Max['MAYOR'];
}


for($i=1; $i<=$cantidad; $i++){
	$em = "EM".$i;
	$dmu = "DMU".$i;

	$DesigMoldeUtil = $_GET[$dmu];
	$Edad = $_GET[$em];

	$QRY_FormHMDetRE = "
	INSERT INTO TBL_FormHMDetRE
		(FormHMDetRE_Valor, FormHMRE_Id)
	VALUES
		('".$_GET['resistencia_especificada']."', '".$_GET['resistencia_tipo']."')
	";

	$SQL_FormHMDetRE = mysqli_query($link, $QRY_FormHMDetRE) or die('Error en QRY FormHMDetRE: '.mysqli_error($link));;
	if(!$SQL_FormHMDetRE){
		$error++;
	}

	$QRY_FormHMDet = "
		INSERT INTO TBL_FormHMDet
		(
			FormHMProb_Id,
			id_form_c_h_m,
			FormHMComp_Id,
			FormHMMov_Id,
			FormHMTipoCurado_Id,
			FormHMDetRE_Id,
			FormHMPro_Id,
			FormHMMarca_Id,
			FormHMAs_Id,
			FormHMTex_Id,
			DesigMoldeUtil,
			hora_carga_planta,
			hora_salida_planta,
			hora_llegada_planta,
			hora_inicio,
			hora_termino,
			curado_obra,
			responsable_muestreo,
			lugar_extraccion,
			dosificacion_declarada,
			camion,
			guia,
			m3,
			cono,
			temperatura_ambiente,
			temperatura_hormigon,
			elemento_hormigonado,
			aditivos,
			observaciones,
			termometro,
			equipo_cono,
			vibrador_sonda,
			regla_metrica,
			otros,
			edad
		)
		VALUES
		(

			'".$_GET['probeta']."',
			'".$FormHM."',
			'".$_GET['compresion']."',
			'".$_GET['movimiento']."',
			'".$_GET['curado']."',
			'".$_GET['resistencia_tipo']."',
			'".$_GET['procedencia']."',
			'".$_GET['marca']."',
			'".$_GET['aspecto']."',
			'".$_GET['textura']."',
			'".$DesigMoldeUtil."',
			'".$_GET['hora_carga_planta']."',
			'".$_GET['hora_salida_planta']."',
			'".$_GET['hora_llegada_planta']."',
			'".$_GET['hora_inicio_descarga']."',
			'".$_GET['hora_termino_descarga']."',
			'".$_GET['curado_obra']."',
			'".$_GET['responsable_muestreo']."',
			'".$_GET['lugar_extraccion']."',
			'".$DosificacionDeclarada."',
			'".$_GET['camion']."',
			'".$_GET['guia']."',
			'".$_GET['M3']."',
			'".$_GET['cono']."',
			'".$_GET['TempAmbiente']."',
			'".$_GET['TempHormigon']."',
			'".$_GET['elemento_hormigonado']."',
			'".$_GET['aditivos']."',
			'".$_GET['observaciones']."',
			'".$_GET['termometro']."',
			'".$_GET['equipo_cono']."',
			'".$_GET['vibrador_sonda']."',
			'".$_GET['regla_metrica']."',
			'".$_GET['otros']."',
			'".$Edad."'
		)
		";
		$SQL_FormHMDet = mysqli_query($link, $QRY_FormHMDet) or die('Error en QRY FormHMDet: '.mysqli_error($link));;
		if(!$SQL_FormHMDet){
			$error++;
		}

}

$QRY_Informe ="
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
		'0',
		'".$FormHM."',
		'".$_GET['te']."',
		'".date("Y-m-d H:i:s")."',
		'1'
	)
";

$SQL_Informe = mysqli_query($link, $QRY_Informe) or die("Error en SQL de INSERT INFORME".mysqli_error());;
if(!$SQL_Informe){
	$error++;
}


print("</pre>");

if($error == 0){?>
  <script type="text/javascript">
    alert("El formulario ha sido registrado con éxito.")
    location.href="operaciones_ingreso_formulario_reg.php?id=<?php echo $_GET['id']; ?>";
  </script>
  <?php
  exit;
}

?>
	</body>
</html>
