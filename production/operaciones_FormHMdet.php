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



$query = "
SELECT
	ag.id_agendamiento_visita AS ID,
	ag.nombre_proyecto AS PROYECTO,
	ag.rut_empresa AS RUT,
	ag.razon_social AS CLIENTE,
	ag.id_laboratorista as IDLABORATORISTA,
	l.nombre_laboratorista AS LABORATORISTA,
	ag.fecha_agendamiento AS FECHA,
	ag.email_proyecto AS EMAIL,
	ag.contacto_proyecto AS CONTACTO,
	ag.direccion_proyecto AS DIRECCION,
	ag.telefono_proyecto AS TELEFONO,
	H.numero_solicitud AS SOLICITUD,
	H.correlativo_obra AS CORRELATIVO_OBRA,
	H.construye AS CONSTRUYE,
	H.hora_ini AS INICIO,
	H.hora_fin AS FIN,
	H.kilometraje AS KM,
	H.cantidad_muestras AS MUESTRAS,
	H.correlativo AS CORRELATIVO,
	H.hora_control AS HORACONTROL,
	H.cod_hormigon AS CODHORMIGON,
	H.fecha_muestra AS FECHAMUESTRA,
	D.hora_carga_planta AS HCARGA,
	D.hora_salida_planta AS HSALIDA,
	D.hora_llegada_planta AS HLLEGADA,
	D.hora_inicio AS HINICIO,
	D.hora_termino AS HTERMINO,
	D.curado_obra AS COBRA,
	D.lugar_extraccion AS EXTRACCION,
	D.camion AS CAMION,
	D.guia AS GUIA,
	D.m3 AS M3,
	D.cono AS CONO,
	D.temperatura_ambiente AS TAMBIENTE,
	D.temperatura_hormigon AS THORMIGON,
	D.elemento_hormigonado AS ELEMENTOH,
	D.aditivos AS ADITIVOS,
	D.observaciones AS OBS,
	D.termometro AS TERMOMETRO,
	D.equipo_cono AS ECONO,
	D.vibrador_sonda AS VIBRASONDA,
	D.regla_metrica AS REGLAMETRICA,
	D.FormHMAs_Id AS ASPECTO,
	D.otros AS OTROS,
	D.dosificacion_declarada AS DOSIFICACION,
	M.FormHMMarca_Nombre AS MARCA,
	R.FormHMRE_Id AS RESESPECIFICADAID,
	R.FormHMDetRE_Valor AS RESESPECIFICADAVAL,
	D.FormHMProb_Id AS TIPOPROBETA
FROM
	TBL_AgendaVisita ag, TBL_Laboratorista l, TBL_FormHM H, TBL_FormHMDet D, TBL_FormHMDetRE R, TBL_FormHMMarca M
WHERE
	ag.id_agendamiento_visita = '".$_GET['id']."' AND
	ag.id_laboratorista = l.id_laboratorista AND
	ag.id_agendamiento_visita = H.id_agendamiento_visita AND
	H.numero_solicitud = '".$_GET['folio']."' AND
  H.id_form_c_h_m = D.id_form_c_h_m AND
	D.FormHMDetRE_Id = R.FormHMDetRE_Id AND
	D.FormHMMarca_Id = M.FormHMMarca_Id
";


$sql = mysqli_query($link, $query) or die('Consulta de formulario fallida: '.mysqli_error($link));;

while($fila = mysqli_fetch_assoc($sql)){
	$if_proyecto = $fila['PROYECTO'];
	$if_rut = $fila['RUT'];
	$if_cliente = $fila['CLIENTE'];
	$if_laboratorista = $fila['LABORATORISTA'];
	$if_idlaboratorista = $fila['IDLABORATORISTA'];
	$if_construye = $fila['CONSTRUYE'];
	$if_fecha = $fila['FECHA'];
	$if_email = $fila['EMAIL'];
	$if_contacto = $fila['CONTACTO'];
	$if_direccion = $fila['DIRECCION'];
	$if_telefono = $fila['TELEFONO'];
	$if_solicitud = $fila['SOLICITUD'];
	$if_correlativo_obra = $fila['CORRELATIVO_OBRA'];
	$if_inicio = $fila['INICIO'];
	$if_fin = $fila['FIN'];
	$if_km = $fila['KM'];
	$if_muestras = $fila['MUESTRAS'];
	$if_construye = $fila['CONSTRUYE'];
	$if_correlativo = $fila['CORRELATIVO'];
	$if_codhormigon = $fila['CODHORMIGON'];
	$if_horacontrol = $fila['HORACONTROL'];
	$if_hcarga = $fila['HCARGA'];
	$if_hsalida = $fila['HSALIDA'];
	$if_hllegada = $fila['HLLEGADA'];
	$if_hinicio = $fila['HINICIO'];
	$if_termino = $fila['HTERMINO'];
	$if_fechamuestra = $fila['FECHAMUESTRA'];
	$if_cobra =  $fila['COBRA'];
	$if_extraccion = $fila['EXTRACCION'];
	$if_camion = $fila['CAMION'];
	$if_guia = $fila['GUIA'];
	$if_m3 = $fila['M3'];
	$if_cono = $fila['CONO'];
	$if_tempambiente = $fila['TAMBIENTE'];
	$if_temphormigon = $fila['THORMIGON'];
	$if_elementoh = $fila['ELEMENTOH'];
	$if_aditivos = $fila['ADITIVOS'];
	$if_obs = $fila['OBS'];
	$if_marca = $fila['MARCA'];
	$if_aspecto = $fila['ASPECTO'];
	$if_termometro = $fila['TERMOMETRO'];
	$if_equipocono = $fila['ECONO'];
	$if_vibrasonda = $fila['VIBRASONDA'];
	$if_reglametrica = $fila['REGLAMETRICA'];
	$if_otros = $fila['OTROS'];
	$if_dosificacion = $fila['DOSIFICACION'];
	$if_resespecificadaval = $fila['RESESPECIFICADAVAL'];
	$if_resespecificadaid = $fila['RESESPECIFICADAID'];
	$if_tipoprobeta = $fila['TIPOPROBETA'];
}

switch ($if_tipoprobeta) {
	case '1':
		// 1 = 20x20x20 COMPRESION CUBO HORMIGÓN
		$disabled1 = "readonly";
		$checked1 = "checked";
	break;
	case '2':
		// 2 = 15x15x15 COMPRESION CUBO HORMIGÓN
		$disabled2 = "readonly";
		$checked2 = "checked";
	break;
	case '3':
		// 3 = 15x15x30 CILINDRO
		$disabled3 = "readonly";
		$checked3 = "checked";
	break;
	case '4':
		// 4 = 15x15x53 FLEXO TRACCIÓN
		$disabled4 = "readonly";
		$checked4 = "checked";
	break;
	case '5':
		// 5 = 4x4x16   RILEN
		$disabled5 = "readonly";
		$checked5 = "checked";
	break;
}


switch ($if_aspecto) {
	case '1':
		// 1 = PLASTICO
		$disabled1 = "readonly";
		$checked1 = "checked";
	break;
	case '2':
		// 2 = SECO
		$disabled2 = "readonly";
		$checked2 = "checked";
	break;
	case '3':
		// 3 = FLUIDO
		$disabled3 = "readonly";
		$checked3 = "checked";
	break;
}




$DosificacionArray = explode("-", $if_dosificacion);
$DosificacionTxt = " ".$DosificacionArray[0]."(".$DosificacionArray[1].")".$DosificacionArray[2]."/".$DosificacionArray[3];

$DesMoldes_Qry = "
	SELECT
		D.DesigMoldeUtil AS DESMOLDES
	FROM
		TBL_FormHMDet D, TBL_FormHM H
	WHERE
		H.numero_solicitud = '".$_GET['folio']."' AND
		H.id_form_c_h_m = D.id_form_c_h_m
";
$DesMoldes_Sql = mysqli_query($link, $DesMoldes_Qry) or die ("Error en DesMoldes:" . mysqli_error($link));;
while($DesMoldes_Dat = mysqli_fetch_assoc($DesMoldes_Sql)){
	$DesMoldesArray[] = $DesMoldes_Dat['DESMOLDES'];
}


$TipoCompresion_Qry = "
	SELECT
		D.FormHMComp_Id AS TIPOCOMPRESION
	FROM
		TBL_FormHMDet D, TBL_FormHM H
	WHERE
		H.numero_solicitud = '".$_GET['folio']."' AND
		H.id_form_c_h_m = D.id_form_c_h_m
";
$TipoCompresion_Sql = mysqli_query($link, $TipoCompresion_Qry) or die ("Error en TipoCompresion:" . mysqli_error($link));;
while($TipoCompresion_Dat = mysqli_fetch_assoc($TipoCompresion_Sql)){
	$TipoCompresionArray[] = $TipoCompresion_Dat['TIPOCOMPRESION'];
}
if($TipoCompresionArray[0]==1){
	$TipoCompresionChecked1 = "checked";

}else{
	$TipoCompresionChecked2 = "checked";
}



$TipoMovimiento_Qry = "
	SELECT
		D.FormHMMov_Id AS TIPOMOVIMIENTO
	FROM
		TBL_FormHMDet D, TBL_FormHM H
	WHERE
		H.numero_solicitud = '".$_GET['folio']."' AND
		H.id_form_c_h_m = D.id_form_c_h_m
";
$TipoMovimiento_Sql = mysqli_query($link, $TipoMovimiento_Qry) or die ("Error en TipoMovimiento:" . mysqli_error($link));;
while($TipoMovimiento_Dat = mysqli_fetch_assoc($TipoMovimiento_Sql)){
	$TipoMovimientoArray[] = $TipoMovimiento_Dat['TIPOMOVIMIENTO'];
}
if($$TipoMovimientoArray[0]==1){
	$TipoMovimientoChecked1 = "checked";

}else{
	$TipoMovimientoChecked2 = "checked";
}





$TipoCurado_Qry = "
	SELECT
		D.FormHMTipoCurado_Id AS TIPOCURADO
	FROM
		TBL_FormHMDet D, TBL_FormHM H
	WHERE
		H.numero_solicitud = '".$_GET['folio']."' AND
		H.id_form_c_h_m = D.id_form_c_h_m
";
$TipoCurado_Sql = mysqli_query($link, $TipoCurado_Qry) or die ("Error en TipoCurado:" . mysqli_error($link));;
while($TipoCurado_Dat = mysqli_fetch_assoc($TipoCurado_Sql)){
	$TipoCuradoArray[] = $TipoCurado_Dat['TIPOMOVIMIENTO'];
}
if($TipoCuradoArray[0]==1){
	$TipoCuradoChecked1 = "checked";

}else{
	$TipoCuradoChecked2 = "checked";
}





$Procedencia_Qry = "
	SELECT
		D.FormHMTipoCurado_Id AS PROCEDENCIA
	FROM
		TBL_FormHMDet D, TBL_FormHM H
	WHERE
		H.numero_solicitud = '".$_GET['folio']."' AND
		H.id_form_c_h_m = D.id_form_c_h_m
";
$Procedencia_Sql = mysqli_query($link, $Procedencia_Qry) or die ("Error en Procedencia:" . mysqli_error($link));;
while($Procedencia_Dat = mysqli_fetch_assoc($Procedencia_Sql)){
	$ProcedenciaArray[] = $Procedencia_Dat['TIPOMOVIMIENTO'];
}
if($ProcedenciaArray[0]==1){
	$ProcedenciaChecked1 = "checked";

}else{
	$ProcedenciaChecked2 = "checked";
}



$EdadMuestras_Qry = "
	SELECT
		D.edad AS EDAD
	FROM
		TBL_FormHMDet D, TBL_FormHM H
	WHERE
		H.id_agendamiento_visita = '".$_GET['id']."' AND
		H.numero_solicitud = '".$_GET['folio']."' AND
		H.id_form_c_h_m = D.id_form_c_h_m
";

$EdadMuestras_Sql = mysqli_query($link, $EdadMuestras_Qry) or die ("Error en QRY Edad Muestras " . mysqli_error($link));
while($EdadMuestras_Dat = mysqli_fetch_assoc($EdadMuestras_Sql)){
	$EdadMuestrasArray[] = $EdadMuestras_Dat['EDAD'];
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
		<title><?php echo $Title?></title>


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
	  <style type="text/css">
		html,body{
			height:297mm;
			/*width:210mm;*/
			text-align: center;
			background-color: #F7F7F7;
			font-family: arial;
			font-size: 12px;
			/*
		  padding-left: 20px; padding-right: 20px;
		  margin-left: 12%;
			*/
		}
		  #item-checkbox{
			  font-size: 9px;
			  text-align: left;
		  }
			#formato_pag{
				display: flex; justify-content: center; align-items: center;
			}
			#ancho_pag{
				width:60%;
			}
			#encabezado_azul{
				width: 100%; height:45px; background-color: blue;
				font-size: 16px; color: white; text-align: center; padding-top:10px; padding-button:10px;
			}
			#encabezado_verde{
				width: 100%; height:10px; background-color: green;
				font-size: 16px; color: white; text-align: center; padding-top:10px; padding-button:10px;
			}
			#header{
				font-size: 18px;
				font-family: sans-serif;
				font-weight: bold;
			}

	  </style>

  </head>

<body class="nav-md" role="main">
	<div class="container body" id="formato_pag">
		<div class="main_container" id="ancho_pag">
			<div class="">
		        <div class="clearfix"></div>
			    <div class="row">
              		<div class="col-md-12 col-sm-12 col-xs-12">
            	    	<div class="x_panel">
											<div class="x_content">
												<div class="form-group col-md-9 col-sm-8 col-xs-12">
													<div class="col-md-12 col-sm-12 col-xs-12" id="encabezado_verde"></div>
													<div class="col-md-12 col-sm-12 col-xs-12" id="encabezado_azul">
														<p id="header" style="text-align:right; ">CONTROL DE HORMIGONES Y MORTEROS</p>
													</div>
												</div>
												<div class="form-group col-md-3 col-sm-4 col-xs-2">
													<img src="images/Logo_marss-lab_255x100.jpg" style="width: 100%;">
												</div>
												<div class="form-group col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
													<img src="images/logo_inn-424x100.png" style="width: 15%;">
												</div>
											</div>



<form name="form_ch"class="form-horizontal form-label-left" action="form_control_hormigones_morteros_res.php" method="get">
	<input type="hidden" name="te" value="<?php echo $_GET['te'];?>">
	<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

<!-- /////////////////////////// SECCION 1 ///////////////////////////////////////// -->
	<div class="x_title">
	   	<div class="clearfix"></div>
	</div>

	<div class="form-group row">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">N° Solicitud</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" name="numero_solicitud" class="form-control" required readonly value="<?php echo $if_solicitud; ?>">
			</div>
	</div>


	<div class="form-group row">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Fecha</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="input-group date" >
					<input type="text" name="fecha_solicitud" id="fecha_solicitud" class="form-control" required value="<?php echo $if_fecha; ?>" readonly>
					<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Correlativo Obra</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" class="form-control" name="correlativo_obra" value="<?php echo $if_correlativo_obra; ?>" readonly>
			</div>
	</div>

	<div class="form-group row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Obra</label>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<input type="text" class="form-control" name="obra" placeholder="Obra"  required value="<?php echo $if_proyecto; ?>" readonly>
		</div>
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Construye</label>
    	<div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="construye" placeholder="Construye"  value="<?php echo $if_construye?>" readonly>
			</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3 col-xs-12">Cliente</label>
		<div class="col-md-4 col-sm-9 col-xs-12">
			<input type="text" class="form-control"   readonly required name="cliente" value="<?php echo $if_cliente?>">
		</div>
    <label class="control-label col-md-2 col-sm-3 col-xs-12">Atención Señor</label>
    <div class="col-md-4 col-sm-9 col-xs-12">
    	<input type="text" class="form-control"  readonly required name="atencion_sr" value="<?php echo $if_contacto; ?>">
		</div>
	</div>
	<div class="form-group row">
    	<label class="control-label col-md-2 col-sm-2 col-xs-12">Direccion Obra</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="direccion_obra"  readonly  name="direccion_obra" required value="<?php echo $if_direccion; ?>">
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Fono Cliente</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="fono_cliente" readonly  required name="fono_cliente" value="<?php echo $if_telefono; ?>">
			</div>
	</div>



	<div class="form-group row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Servicio</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Inicio:</label>
			</br>
			<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_inicio">
					<input type="text" class="form-control" name="hora_ini" value="<?php echo $if_inicio; ?>" readonly>

			</div>
		</div>

    <div class="col-md-3 col-sm-3 col-xs-12">
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Fin:</label>
			</br>
			<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_fin">
				<input type="text" class="form-control" required name="hora_fin" value="<?php echo $if_fin; ?>" readonly>
				</span>
			</div>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-12">
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Kilometraje</label>
      <input type="number" class="form-control" name="kilometraje" value="<?php echo $if_km; ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-form-label col-md-2 col-sm-2 col-xs-12"></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
			<label class="col-form-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Realizado por</label>

			<?php
			$query = "SELECT * FROM TBL_Laboratorista WHERE id_laboratorista!='15'";
			$sql4 = mysqli_query($link, $query) or die('Consulta fallida: '.mysql_error());;
			?>
			<select class="form-control" required="required" id="realizado_por" name="realizado_por" readonly>
				<option value="">-- Seleccione --</option>
				<?php
				while($filas = mysqli_fetch_assoc($sql4))
				{
					if($filas['id_laboratorista'] == $if_idlaboratorista){
						$selected = "selected";
					}
					else{
						$selected = "";
					}
				?>

					<option <?php echo $selected;?> value="<?php echo $filas['id_laboratorista'];?>"><?php echo $filas['nombre_laboratorista']?></option>
				<?php
				}
				?>
			</select>


		</div>

    <div class="col-md-4 col-sm-4 col-xs-12">
			<label class="col-form-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;"> Cantidad de Muestras</label>
				<input type="number" class="form-control" name="cantidad_muestras" value="<?php echo $if_muestras; ?>" readonly>
		</div>
	</div>


<!-- /////////////////////////// SECCION 2 ///////////////////////////////////////// -->



	<div class="x_title">
		<h2 style="padding-top: 30px;">Muestra</h2>
    <div class="clearfix"></div>
	</div>

	<div class="form-group">
  	<label class="control-label col-md-2 col-sm-2 col-xs-12">N°</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="number" class="form-control" name="correlativo" value="<?php echo $if_correlativo;?>" readonly>
		</div>
  	<label class="control-label col-md-2 col-sm-2 col-xs-12">Cod. Hormigon</label>
    <div class="input-group col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control"  name="cod_hormigon" value="<?php echo $if_codhormigon;?>" readonly>
		</div>
	</div>

  <div class="form-group">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Fecha</label>
		<div class="col-md-4 col-sm-3 col-xs-12">
			<div class="input-group date" id="fecha_muestra">
				<input type="text" name="fecha_muestra" class="form-control" value="<?php echo $if_fecha;?>" readonly>
				<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>


		<label class="control-label col-md-2 col-sm-2 col-xs-12">Hora</label>
		<div class="input-group col-md-4 col-sm-4 col-xs-12 date" id="hora_control">
			<input type="text" class="form-control" name="hora_control" value="<?php echo $if_horacontrol;?>" readonly>

		</div>



	</div>



<!-- /////////////////////////// SECCION 2 ///////////////////////////////////////// -->
	<div class="x_title">
  	<h2 style="padding-top: 30px;">Probeta</h2>
    <div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-md-1 col-sm-3 col-xs-12" >
		</div>

		<div class="col-md-2 col-sm-3 col-xs-12" >

			<div class="row" style="text-align: left;">
				<input type="radio" name="probeta" <?php echo $disabled1." ".$checked1; ?> value="1">
				<label>20x20x20</label>
			</div>

			<div class="row" style="text-align: left;">
				<input type="radio" name="probeta" <?php echo $disabled2." ".$checked2; ?> value="2">
				<label >15x15x15</label>
			</div>

			<div class="row" style="text-align: left;">
				<input type="radio" name="probeta" <?php echo $disabled3." ".$checked3; ?> value="3">
				<label>15x15x30</label>
			</div>

			<div class="row" style="text-align: left;">
				<input type="radio" name="probeta" <?php echo $disabled4." ".$checked4; ?> value="4">
				<label>15x15x53</label>
			</div>

			<div class="row" style="text-align: left;">
				<input type="radio" name="probeta" <?php echo $disabled5." ".$checked5; ?> value="5">
				<label>4x4x16</label>
			</div>
		</div>




		<div class="col-md-9 col-sm-10 col-xs-12" >
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Designación de</br> Moldes utilizadas</label>
				<div class="col-md-8 col-sm-8 col-xs-12">

				<?php
				for($i=1; $i<=6; $i++){
					$j=$i-1;

					?>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<?php echo $i;?></br><input type="text" class="form-control" maxlength="4" readonly value="<?php echo $DesMoldesArray[$j]; ?>" name="DMU<?php echo $i;?>" id="DMU<?php echo $i;?>"><br>
					</div>
				<?php
				}?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 col-sm-2 col-xs-12">
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<!-- ///////////// compresion: 1=apisonado; 2=Inmersion /////////////-->

					<div class="row" style="text-align: left;">
						<input type="radio" name="compresion" <?php echo $TipoCompresionChecked1;?> value="apisonado">
						<label >Apisonado</label>
					</div>
					<div class="row" style="text-align: left;">
						<input type="radio" name="compresion" <?php echo $TipoCompresionChecked2;?> value="vibrado">
						<label >Vibrado</label>
					</div>

				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<!-- ///////////// movimiento: 1=enviado; 2=Retirado /////////////-->

					<div class="row" style="text-align: left;">
						<input type="radio" name="movimiento" <?php echo $TipoMovimientoChecked1; ?> value="1">
						<label >Enviado</label>
					</div>
					<div class="row" style="text-align: left;">
						<input type="radio" name="movimiento" <?php echo $TipoMovimientoChecked2; ?> value="2">
						<label >Retirado</label>
					</div>
				</div>

			</div>


		</div>
	</div>




	<!-- /////////////////////////// SECCION 3 ///////////////////////////////////////// -->
	<div class="x_title">
    	<h2 style="padding-top: 30px;">Tipo Curado</h2>
        <div class="clearfix"></div>
	</div>
<!-- ///////////// curado: 1=humeda; 2=Inmersion /////////////-->
	<div class="form-group">
		<div class="col-md-1 col-sm-4 col-xs-12" >
		</div>
		<div class="col-md-3 col-sm-4 col-xs-12" >
			<div class="row" style="text-align: left;">
				<label>
					C&aacute;mara H&uacute;meda
				</label>
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" <?php echo $TipoCuradoChecked1; ?> name="curado" value="1">
			</div>

			<div class="row" style="text-align: left;">
				<label>
					Inmersi&oacute;n
				</label>
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="curado" <?php echo $TipoCuradoChecked2; ?> value="2">
			</div>

		</div>
		<div class="col-md-8 col-sm-6 col-xs-12" >
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora de Carga en Planta</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_carga_planta">
							<input type="text" class="form-control" name="hora_carga_planta" value="<?php echo $if_hcarga;?>" readonly>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>
				</div>
			</div>
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora Salida Planta</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_salida_planta">
							<input type="text" class="form-control" name="hora_salida_planta" value="<?php echo $if_hsalida;?>" readonly>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>

				</div>
			</div>
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora Llegada Planta</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_llegada_planta">
							<input type="text" class="form-control" name="hora_llegada_planta" value="<?php echo $if_hllegada;?>" readonly>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>
				</div>
			</div>
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora Inicio Descarga</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_inicio_descarga">
							<input type="text" class="form-control" name="hora_inicio_descarga" value="<?php echo $if_hinicio;?>" readonly>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>
				</div>
			</div>
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora T&eacute;rmino Descarga</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_termino_descarga">
							<input type="text" class="form-control" name="hora_termino_descarga" value="<?php echo $if_htermino;?>" readonly>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- /////////////////////////// SECCION 3 ///////////////////////////////////////// -->
	<div class="x_title">

        <div class="clearfix"></div>
	</div>

	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Curado obra</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control"  name="curado_obra" value="<?php echo $if_cobra;?>" readonly>
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Muestreo efectuado por</label>
        <div class="col-md-9 col-sm-9 col-xs-12">

					<?php
					$query = "SELECT * FROM TBL_Laboratorista WHERE id_laboratorista!='15'";
					$sql4 = mysqli_query($link, $query) or die('Consulta fallida: '.mysql_error());;
					?>
					<select class="form-control" required="required" id="responsable_muestreo" name="responsable_muestreo" readonly>
						<option value="">-- Seleccione --</option>
						<?php
						while($filas = mysqli_fetch_assoc($sql4))
						{
							if($filas['id_laboratorista'] == $if_idlaboratorista){
								$selected = "selected";
							}
							else{
								$selected = "";
							}
						?>

							<option <?php echo $selected;?> value="<?php echo $filas['id_laboratorista'];?>"><?php echo $filas['nombre_laboratorista']?></option>
						<?php
						}
						?>
						<option value="20">Mandante</option>
					</select>
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Lugar de Extracción</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control" name="lugar_extraccion" value="<?php echo $if_extraccion;?>" readonly>
		</div>
	</div>


<!-- /////////////////////////// SECCION 3 ///////////////////////////////////////// -->
	<div class="x_title">
    	<h2 style="padding-top: 30px;">Hormig&oacute;n</h2>
        <div class="clearfix"></div>
	</div>

	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Dosificaci&oacute;n declarada</label>
			<div class="col-md-3 col-sm-3 col-xs-12">
      	<input type="text" class="form-control" readonly  id="dosificacion_declarada" name="dosificacion_declarada" value="<?php echo $DosificacionTxt;?>">
			</div>


	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Resistencia especificada</label>
        <div class="col-md-3 col-sm-2 col-xs-12">
        	<input type="number" class="form-control" id="resistencia_especificada" name="resistencia_especificada" value="<?php echo $if_resespecificadaval; ?>" readonly>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left">
			<!-- ///////////////// Resistencia: 1=MPa; 2=Kgf/cm2 /////////////////-->

			<?php
			if($if_resespecificadaid == 1){
				//1 = MPa, 2 = Kgf/cm2
				?>
				<div class="radio col-md-6 col-sm-6 col-xs-12">
					<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="resistencia" checked readonly value="1">
					<label>MPa</label>
				</div>
				<div class="radio col-md-6 col-sm-6 col-xs-12">
					<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="resistencia" readonly value="2">
					<label>Kgf/cm2</label>
				</div>
			<?php
			}
			else{
				?>
				<div class="radio col-md-6 col-sm-6 col-xs-12">
					<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="resistencia" readonly value="1">
					<label>MPa</label>
				</div>
				<div class="radio col-md-6 col-sm-6 col-xs-12">
					<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="resistencia" checked readonly value="2">
					<label>Kgf/cm2</label>
				</div>
				<?php
			}
			?>


		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 col-sm-3 col-xs-12 control-label">Procedencia Obra</label>
		<div class="radio col-md-3 col-sm-3 col-xs-12" style="text-align: left;">
			<!-- //////////////////// Procedencia: 1 = Maquina; 2 = Pala  //////////////////// -->
			<label>
				<input type="radio" class="flat" name="procedencia" <?php echo $ProcedenciaChecked1; ?> value="1"> M&aacute;quina
				<br><br><br>
				<input type="radio" class="flat" name="procedencia" <?php echo $ProcedenciaChecked2; ?> value="2"> Pala
			</label>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
    		<label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: left;">Premezclado</label>

				<div class="col-md-9 col-sm-9 col-xs-12" >
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Marca</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="marca" value="<?php echo $if_marca; ?>" readonly>
					</div>
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Cami&oacute;n</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="camion" value="<?php echo $if_camion; ?>" readonly>
					</div>
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Gu&iacute;a</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" class="form-control" name="guia" value="<?php echo $if_guia; ?>" readonly>
					</div>
					<label class="control-label col-md-3 col-sm-3 col-xs-12">M3</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="number"  class="form-control" name="M3" value="<?php echo $if_m3; ?>" readonly>
					</div>
				</div>
			</label>
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Cono</label>
        <div class="col-md-3 col-sm-2 col-xs-12">
        	<input type="number" class="form-control" name="cono" value="<?php echo $if_cono; ?>" readonly>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left">
			<!--////////////////////////// Cono: 1=cms; 2= mms //////////////////////////-->
			<div class="radio col-md-6 col-sm-6 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="cono" value="1">
				<label>
					cms
				</label>
			</div>
			<div class="radio col-md-6 col-sm-6 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="cono" value="2">
				<label>
					mms
				</label>
			</div>

		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Aspecto</label>
<!-- ////////////////////////// Aspecto: 1 = seco; 2 = plastico; 3 = fluido-->
		<div class="col-md-9 col-sm-9 col-xs-12" style="text-align: left">
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="aspecto" value="1">
				<label>
					Seco
				</label>
			</div>
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="aspecto" value="2">
				<label>
					Pl&aacute;stico
				</label>
			</div>
      <div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="aspecto" value="3">
				<label>
					Fluido
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Textura</label>
<!-- ////////////////////////// Textura: 1 = normal; 2 = ripiosa; 3 = arenosa //////////////////////////-->
		<div class="col-md-9 col-sm-9 col-xs-12" style="text-align: left">
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="col-md-3 col-sm-3 col-xs-12" name="textura" value="1">
				<label>
					 Normal
				</label>
			</div>
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="textura" value="2">
				<label>
					Ripiosa
				</label>
			</div>
      <div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="textura" value="3">
				<label>
					Arenosa
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-3 col-sm-3 col-xs-12 control-label">Temperatura de Hormig&oacute;n (°C)</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input type="number" value="<?php echo $if_temphormigon; ?>" class="form-control" placeholder="Escriba" name="TempHormigon" readonly>
		</div>
		<label class="col-md-3 col-sm-3 col-xs-12 control-label">Temperatura de Ambiente (°C)</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input type="number" value="<?php echo $if_tempambiente; ?>" class="form-control" placeholder="Escriba" name="TempAmbiente" readonly>
		</div>
	</div>

	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Elemento Hormigonado</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control" name="elemento_hormigonado" value="<?php echo $if_elementoh; ?>" readonly>
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Aditivos</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control" name="aditivos" value="<?php echo $if_aditivos; ?>" readonly>
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control" name="observaciones" value="<?php echo $if_obs; ?>" readonly>
		</div>
	</div>


<!-- /////////////////////////// SECCION 4 ///////////////////////////////////////// -->
	<div class="x_title">
    	<h2 style="padding-top: 30px;">Equipos utilizados</h2>
        <div class="clearfix"></div>
	</div>
  <div class="form-group">
  	<label class="control-label col-md-2 col-sm-2 col-xs-12">Term&oacute;metro</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control" name="termometro" value="<?php echo $if_termometro; ?>" readonly>
		</div>

		<label class="control-label col-md-2 col-sm-2 col-xs-12">Equipo cono</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control"  name="equipo_cono" value="<?php echo $if_equipocono; ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
  	<label class="control-label col-md-2 col-sm-2 col-xs-12">Vibrador + Sonda</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control"  name="vibrador_sonda" value="<?php echo $if_vibrasonda; ?>" readonly>
		</div>
	 	<label class="control-label col-md-2 col-sm-2 col-xs-12">Regla met&aacute;lica</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control"  name="regla_metrica" value="<?php echo $if_reglametrica; ?>" readonly>
		</div>
	</div>

	<div class="form-group row">
		<label class="control-label col-md-2 col-sm-3 col-xs-12">Otros</label>
    <div class="col-md-10 col-sm-9 col-xs-12">
    	<input type="text" class="form-control"  name="otros" value="<?php echo $if_otros; ?>" readonly>
		</div>
	</div>



	<div class="x_title">
    	<h2 style="padding-top: 30px;">Edades</h2>
        <div class="clearfix"></div>
	</div>
	<div class="form-group">
		<?php
		for($i=1; $i<=6; $i++){
			$j = $i-1;?>

	  	<div class="col-md-2 col-sm-4 col-xs-12">
				<label class="control-label">Muestra <?php echo $i;?></label>
	      <input type="number" min='0' max='100' class="form-control" name="EM<?php echo $i;?>" id="EM<?php echo $i;?>" value="<?php echo $EdadMuestrasArray[$j];?>" readonly>
			</div>
		<?php
		}
		for($i=1; $i<=6; $i++){
			$j = $i-1;

			if($i<=$if_muestras){
				$FechaFinalMuestra = $if_fechamuestra;
				$DiasMuestra = "+".$EdadMuestrasArray[$j]." day";

				$FechaFinalMuestra = date("Y-m-d H:i:s", strtotime($FechaFinalMuestra));
				$FechaFinalMuestra = strtotime ( $DiasMuestra , strtotime ( $FechaFinalMuestra ) ) ;
				$FechaFinalMuestra = date ( 'Y-m-j' , $FechaFinalMuestra );


			}
			else {
				$FechaFinalMuestra = "";
			}
			?>
			<div class="col-md-2 col-sm-4 col-xs-12">
				<label class="control-label">Fecha final <?php echo $i;?></label>
	      <input type="text" class="form-control" name="fecha_EM<?php echo $i;?>" id="fecha_EM<?php echo $i;?>"  readonly value="<?php echo $FechaFinalMuestra;?>">
			</div>
		<?php
		}?>
	</div>



	<div class="ln_solid"></div>
	<div class="form-group row">
  	<div class="col-md-12 col-sm-12 col-xs-12">
    	<button type="button" onclick="Javascript:window.close();" class="btn btn-success">Volver</button>
		</div>
	</div>
	<!-- Modal -->
</form>




                		</div>
              		</div>
            	</div>
          	</div>
      	</div>
    </div>
		<!-- jQuery -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="../vendors/fastclick/lib/fastclick.js"></script>
		<!-- NProgress -->
		<script src="../vendors/nprogress/nprogress.js"></script>
		<!-- bootstrap-daterangepicker -->
		<script src="../vendors/moment/min/moment.min.js"></script>
		<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
		<!-- bootstrap-datetimepicker -->
		<script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<!-- Ion.RangeSlider -->
		<script src="../vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
		<!-- Bootstrap Colorpicker -->
		<script src="../vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<!-- jquery.inputmask -->
		<script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
		<!-- jQuery Knob -->
		<script src="../vendors/jquery-knob/dist/jquery.knob.min.js"></script>
		<!-- Cropper -->
		<script src="../vendors/cropper/dist/cropper.min.js"></script>

		<!-- Custom Theme Scripts -->
		<script src="../build/js/custom.min.js"></script>

		<!-- Initialize datetimepicker -->
		</body>
		</html>
