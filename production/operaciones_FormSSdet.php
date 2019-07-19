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


$QryFormSS = "
SELECT
		S.id_form_solicitud_servicio AS IDFORMSS,
		S.id_tipo_ensayo AS TIPO_ENSAYO,
		S.correlativo_obra AS CORRELATIVO,
		S.fecha_solicitud AS FSOLICITUD,
		S.inicio_servicio AS INICIOS,
		S.fin_servicio AS FINS,
		S.kilometraje AS KM,
		S.muestra AS QMUESTRAS,
		S.observaciones AS OBS,
		S.cliente_nombre_firma AS CLIENTEFIRMA,
		S.cliente_rut_firma AS CLIENTERUT,
		C.empresa_constructora AS CONSTRUCTORA,
		C.nombre_obra AS OBRA,
		S.material AS MATERIAL,
		S.ubicacion AS UBICACION,
		S.procedencia AS PROCEDENCIA,
		S.fecha_operacion AS FECHAOP,
		S.numero_solicitud AS FOLIO,
		E.nombre_ensayo ENSAYONOMBRE,
    D.Ensayo_IdEnsayo IDENSAYO,
    L.nombre_laboratorista AS REALIZADOPOR,
		A.razon_social AS CLIENTERS,
    A.telefono_proyecto AS CLIENTEFONO,
		A.direccion_proyecto AS OBRADIRECCION,
		A.contacto_proyecto AS ATSR
	FROM
		TBL_FormSS S, TBL_Ensayo E, TBL_FormSSDetalle D, TBL_Laboratorista L, TBL_AgendaVisita A, TBL_FormAC C
	WHERE
		S.id_agendamiento_visita='".$_GET['id']."' AND
		S.numero_solicitud='".$_GET['folio']."' AND
    S.id_form_solicitud_servicio = D.FormSS_Id AND
		D.Ensayo_IdEnsayo = E.id_ensayo AND
    S.realizado_por = L.id_laboratorista AND
    S.id_agendamiento_visita = A.id_agendamiento_visita AND
		A.id_form_aceptacion = C.id_form_aceptacion
	";

$SQLFormSS = mysqli_query($link, $QryFormSS) or die('ERROR EN QRYFORMSS: '.mysqli_error($link));;

while($fila = mysqli_fetch_assoc($SQLFormSS)){
	$SS_IDFORMSS = $fila['IDFORMSS'];
	$SS_TIPO_ENSAYO = $fila['TIPO_ENSAYO'];
	$SS_CORRELATIVO = $fila['CORRELATIVO'];
	$SS_FSOLICITUD = $fila['FSOLICITUD'];
	$SS_INICIOS = $fila['INICIOS'];
	$SS_FINS = $fila['FINS'];
	$SS_KM = $fila['KM'];
	$SS_REALIZADOPOR = $fila['REALIZADOPOR'];
	$SS_QMUESTRAS = $fila['QMUESTRAS'];
	$SS_OBS = $fila['OBS'];
	$SS_CLIENTEFIRMA = $fila['CLIENTEFIRMA'];
	$SS_CLIENTERUT = $fila['CLIENTERUT'];
	$SS_MATERIAL = $fila['MATERIAL'];
	$SS_UBICACION = $fila['UBICACION'];
	$SS_PROCEDENCIA = $fila['PROCEDENCIA'];
	$SS_FOLIO = $fila['FOLIO'];
	$SS_ID = $_GET['id'];
	$SS_CLIENTERS = $fila['CLIENTERS'];
	$SS_OBRANOMBRE = $fila['OBRA'];
	$SS_OBRADIRECCION = $fila['OBRADIRECCION'];
	$SS_ATSR = $fila['ATSR'];
	$SS_CLIENTEFONO = $fila['CLIENTEFONO'];
	$SS_CONSTRUYE = $fila['CONSTRUCTORA'];
	$SS_ENSAYOID =  $fila['IDENSAYO'];
}

$QryFormSSDet = "
	SELECT D.Ensayo_IdEnsayo AS ENSAYO, D.Muestra AS MUESTRA
	FROM TBL_FormSSDetalle D, TBL_FormSS S
	WHERE
		S.id_agendamiento_visita='".$_GET['id']."' AND
		S.numero_solicitud='".$_GET['folio']."' AND
		S.id_form_solicitud_servicio = D.FormSS_Id
";
$SqlFormSSDet = mysqli_query($link, $QryFormSSDet) or die('Error en SQLFORMSSDET'.mysqli_error());;
while($ItemFormSSDet = mysqli_fetch_assoc($SqlFormSSDet)){
	$Ensayo[] = $ItemFormSSDet['ENSAYO'];
	$Muestra[] = $ItemFormSSDet['MUESTRA'];
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
			width:75%;
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
		#add_fields_placeholderValue1{display:none; }

		#add_fields_placeholderValue2{display:none; }
		#add_fields_placeholderValue3{display:none; }
		#add_fields_placeholderValue4{display:none; }

		#add_fields_placeholderValue5{display:none; }
		#add_fields_placeholderValue6{display:none; }
	</style>
          <script type="text/javascript">
var nextinput = 0;
function AgregarCampos(){
nextinput++;
campo = 'Campo:<input type="text" name="<?php
while($cantidad > 0){
$name = "variable".$cantidad;
echo $name;
}
?>"size="20" id="campo' + nextinput + '"&nbsp; />';
$("#campos").append(campo);
}
</script>
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
										<p id="header" style="text-align:right; ">SOLICITUD DE SERVICIO</p>
									</div>
								</div>
								<div class="form-group col-md-3 col-sm-4 col-xs-2">
									<img src="images/Logo_marss-lab_255x100.jpg" style="width: 100%;">
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
									<img src="images/logo_inn-424x100.png" style="width: 15%;">
								</div>
							</div>



<form class="form-horizontal form-label-left" method="get" action="#">
<!-- /////////////////////////// SECCION 1 ///////////////////////////////////////// -->
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
<input type="hidden" name="te" value="<?php echo $_GET['te'];?>">

	<div class="x_title">
	   	<div class="clearfix"></div>
	</div>
	<div class="form-group row">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">N° Solicitud</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" name="numero_solicitud" class="form-control" readonly value="<?php echo $SS_FOLIO;?>">
			</div>
	</div>
	<div class="form-group row">
    	<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Fecha</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
				<div class="input-group date" id="fecha_solicitud">
        	<input type="text" name="fecha_solicitud" class="form-control" readonly value="<?php echo $SS_FSOLICITUD;?>">
          <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
			</div>

			<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Correlativo Obra</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="correlativo_obra" placeholder="Escriba" readonly value="<?php echo $SS_CORRELATIVO;?>">
			</div>
	</div>
	<div class="form-group row">
    	<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Obra</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control" name="nombre_obra"  placeholder="Escriba" readonly value="<?php echo $SS_OBRANOMBRE;?>">
			</div>
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Construye</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="construye" placeholder="Escriba" readonly value="<?php echo $SS_CONSTRUYE;?>">
			</div>
	</div>
	<div class="form-group row">
    	<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Cliente</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control"name="cliente" placeholder="Escriba" readonly value="<?php echo $SS_CLIENTERS;?>">
			</div>
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Atencion Sr.</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control" name="atencionsr" placeholder="Escriba" readonly value="<?php echo $SS_ATSR;?>">
			</div>
	</div>
	<div class="form-group row">
    	<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Direccion Obra</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control" name="direccion_obra" placeholder="Escriba" readonly value="<?php echo $SS_OBRADIRECCION;?>">
			</div>
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Fono Cliente</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control" name="fono_cliente" placeholder="Escriba" readonly value="<?php echo $SS_CLIENTEFONO;?>">
			</div>
	</div>

	<div class="form-group row">
		<label class="col-form-label col-md-2 col-sm-2 col-xs-12">Servicio</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12">Inicio:</label>
			</br>
			<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_inicio">
					<input type="text" class="form-control" name="hora_ini" readonly value="<?php echo $SS_INICIOS;?>">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
			</div>
		</div>

    <div class="col-md-3 col-sm-3 col-xs-12">
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12">Fin:</label>
			</br>
			<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_fin">
				<input type="text" class="form-control"  name="hora_fin" readonly value="<?php echo $SS_FINS;?>">
				<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-12">
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12">Kilometraje</label>
      <input type="number" class="form-control" name="kilometraje" min="0" placeholder="Escriba" readonly value="<?php echo $SS_KM;?>">
		</div>
	</div>

	<div class="form-group row">
		<label class="col-form-label col-md-2 col-sm-2 col-xs-12"></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
			<label class="col-form-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Realizado por</label>
			<input type="text" class="form-control"  name="realizadopor" readonly value="<?php echo $SS_REALIZADOPOR;?>">
		</div>

		<label class="col-form-label col-md-2 col-sm-2 col-xs-12"></label>
    <div class="col-md-4 col-sm-6 col-xs-12">
			<label class="col-form-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Cantidad Muestras</label>
			<input type="text" class="form-control"  name="qmuestras" readonly value="<?php echo $SS_QMUESTRAS;?>">
		</div>

	</div>

	<!-- /////////////////////////// SECCION 3 DETALLE DE ENSAYOS ///////////////////////////////////////// -->

<?php

//// Orden de formulario /////
$listado_tipo_ensayos_a[0] = 2;
$listado_tipo_ensayos_a[1] = 7;
$listado_tipo_ensayos_a[2] = 8;
$listado_tipo_ensayos_b[0] = 4;
$listado_tipo_ensayos_b[1] = 3;
$listado_tipo_ensayos_c[0] = 1;
$listado_tipo_ensayos_c[1] = 6;
$listado_tipo_ensayos_c[2] = 5;

$i=1;
?>

<div class="form-group row">
	<!-- ////////////// COLUMNA 1 ////////////// -->
	<div class="col-md-4 col-sm-4 col-xs-12">
		<?php
		foreach($listado_tipo_ensayos_a as $tipo){
			$query_tipo_ensayo =  "
			SELECT id_tipo_ensayo AS ID, nombre_tipo_ensayo AS NOMBRE FROM TBL_EnsayoTipo where id_tipo_ensayo = '".$tipo."'
			";
			$sql_tipo_ensayo = mysqli_query($link, $query_tipo_ensayo);
			while($filas = mysqli_fetch_assoc($sql_tipo_ensayo)){
					$sql_item_ensayo = "
					SELECT id_ensayo AS IDENSAYO, nombre_ensayo AS NENSAYO
					FROM TBL_Ensayo
					WHERE id_tipo_ensayo = '".$filas['ID']."' AND id_estado_ensayo = '1' ";
					$query_item_ensayo = mysqli_query($link, $sql_item_ensayo);
					?>
					<div class="x_title">
						<h5 style="padding-top: 30px; text-align: left"><?php echo $filas['NOMBRE']?></h5>
						<div class="clearfix"></div>
					</div>
					<?php





					$k=0;
					while($detalle = mysqli_fetch_assoc($query_item_ensayo)){
						?>

						<div class="col-md-12 col-sm-12 col-xs-12" id="item-checkbox" >

							<?php
							switch ($filas['ID']) {
								case '2': // MECANICA DE SUELOS
									for($i=1;$i<=8;$i++){
										if($detalle['IDENSAYO'] == $Ensayo[$k] && $i == $Muestra[$k]){
											$checked = "checked";
										}
										else{
											$checked = "";
										}
										if($SS_ENSAYOID == $detalle['IDENSAYO']){
											$checked = "checked";
										}else{
											$checked = "";
										}
										?>

										<input type="checkbox" disabled <?php echo $checked; ?> name="<?php echo $detalle['IDENSAYO']?>[]" value="1">
										<?php
									}
									echo $detalle['NENSAYO'];

								break;

								case '7': // DENSIDAD
									for($i=1;$i<=1;$i++){
										if($detalle['IDENSAYO'] == $Ensayo[$k] && $i == $Muestra[$k]){
											$checked = "checked";
										}
										else{
											$checked = "";
										}
										if($SS_ENSAYOID == $detalle['IDENSAYO']){
											$checked = "checked";
										}
										?>
										<input type="checkbox" disabled <?php echo $checked; ?> name="<?php echo $detalle['IDENSAYO']?>[]" value="1">
										<?php
									}
									echo $detalle['NENSAYO'];
								break;

								case '8': // OTROS
									for($i=1;$i<=1;$i++){
										if($detalle['IDENSAYO'] == $Ensayo[$k] && $i == $Muestra[$k]){
											$checked = "checked";
										}
										else{
											$checked = "";
										}
										if($SS_ENSAYOID == $detalle['IDENSAYO']){
											$checked = "checked";
										}
										?>
										<input type="checkbox" disabled <?php echo $checked; ?> name="<?php echo $detalle['IDENSAYO']?>[]" value="1">
										<?php
									}
									echo $detalle['NENSAYO'];
								break;

							}
							?>
						</div>
						<?php
						$k++;
					}
					?>
					<div class="clearfix"></div>
					<?php
					$i++;
			}
		}
		?>
		</div>

		<!-- ////////////// COLUMNA 2 ////////////// -->
		<div class="col-md-4 col-sm-4 col-xs-12">
			<?php
			foreach($listado_tipo_ensayos_b as $tipo){
				$query_tipo_ensayo =  "
				SELECT id_tipo_ensayo AS ID, nombre_tipo_ensayo AS NOMBRE FROM TBL_EnsayoTipo where id_tipo_ensayo = '".$tipo."'
				";
				$sql_tipo_ensayo = mysqli_query($link, $query_tipo_ensayo);
				while($filas = mysqli_fetch_assoc($sql_tipo_ensayo)){

						$sql_item_ensayo = "
						SELECT id_ensayo AS IDENSAYO, nombre_ensayo AS NENSAYO
						FROM TBL_Ensayo
						WHERE id_tipo_ensayo = '".$filas['ID']."' AND id_estado_ensayo = '1' ";
						$query_item_ensayo = mysqli_query($link, $sql_item_ensayo);
						?>
						<div class="x_title">
							<h5 style="padding-top: 30px; text-align: left"><?php echo $filas['NOMBRE']?></h5>
							<div class="clearfix"></div>
						</div>
						<?php
						$k=0;
						while($detalle = mysqli_fetch_assoc($query_item_ensayo)){?>

							<div class="col-md-12 col-sm-12 col-xs-12" id="item-checkbox" >

								<?php
								switch ($filas['ID']) {
									case '4': // ARIDOS
										for($i=1;$i<=8;$i++){
											if($detalle['IDENSAYO'] == $Ensayo[$k] && $i == $Muestra[$k]){
												$checked = "checked";
											}
											else{
												$checked = "";
											}
											if($SS_ENSAYOID == $detalle['IDENSAYO']){
												$checked = "checked";
											}
											?>
											<input type="checkbox" disabled <?php echo $checked; ?> name="<?php echo $detalle['IDENSAYO']?>[]" value="1">
											<?php
										}
										echo $detalle['NENSAYO'];

									break;

									case '3': // AGUAS

										for($i=1;$i<=1;$i++){
											$checked = "";
											if($detalle['IDENSAYO'] == $Ensayo[$k] && $i == $Muestra[$k]){
												$checked = "checked";
											}
											else{
												if($SS_ENSAYOID == $detalle['IDENSAYO']){
													$checked = "checked";
												}
												else{
													$checked = "";
												}
											}

											?>
											<input type="checkbox" disabled <?php echo $checked; ?>  name="<?php echo $detalle['IDENSAYO']?>[]" value="1">
											<?php
										}
										echo $detalle['NENSAYO'];
									break;

								}
								?>
							</div>
							<?php
						}
						?>
						<div class="clearfix"></div>
						<?php
						$i++;
				}
			}
			?>
		</div>

		<!-- ////////////// COLUMNA 3 ////////////// -->
		<div class="col-md-4 col-sm-4 col-xs-12">
			<?php
			foreach($listado_tipo_ensayos_c as $tipo){
				$query_tipo_ensayo =  "
				SELECT id_tipo_ensayo AS ID, nombre_tipo_ensayo AS NOMBRE FROM TBL_EnsayoTipo where id_tipo_ensayo = '".$tipo."'
				";
				$sql_tipo_ensayo = mysqli_query($link, $query_tipo_ensayo);
				while($filas = mysqli_fetch_assoc($sql_tipo_ensayo)){

						$sql_item_ensayo = "
						SELECT nombre_ensayo AS NENSAYO, id_ensayo AS IDENSAYO
						FROM TBL_Ensayo
						WHERE id_tipo_ensayo = '".$filas['ID']."' AND id_estado_ensayo = '1' ";
						$query_item_ensayo = mysqli_query($link, $sql_item_ensayo);
						?>
						<div class="x_title">
							<h5 style="padding-top: 30px; text-align: left"><?php echo $filas['NOMBRE']?></h5>
							<div class="clearfix"></div>
						</div>
						<?php
						$k=0;
						while($detalle = mysqli_fetch_assoc($query_item_ensayo)){?>

							<div class="col-md-12 col-sm-12 col-xs-12" id="item-checkbox" >

								<?php
								switch ($filas['ID']) {
									case '1': // HORMIGON
										for($i=1;$i<=1;$i++){
											if($detalle['IDENSAYO'] == $Ensayo[$k] && $i == $Muestra[$k]){
												$checked = "checked";
											}
											else{
												$checked = "";
											}
											if($SS_ENSAYOID == $detalle['IDENSAYO']){
												$checked = "checked";
											}
											?>
											<input type="checkbox" disabled <?php echo $checked; ?> name="<?php echo $detalle['IDENSAYO']?>[]" value="1">
											<?php
										}
										echo $detalle['NENSAYO'];

									break;

									case '6': // ELEMENTOS Y COMPONENTES
										for($i=1;$i<=1;$i++){
											if($detalle['IDENSAYO'] == $Ensayo[$k] && $i == $Muestra[$k]){
												$checked = "checked";
											}
											else{
												$checked = "";
											}
											?>
											<input type="checkbox" disabled <?php echo $checked; ?> name="<?php echo $detalle['IDENSAYO']?>[]" value="1">
											<?php
										}
										echo $detalle['NENSAYO'];
									break;
									case '5': // ASFALTO
										for($i=1;$i<=1;$i++){
											if($detalle['IDENSAYO'] == $Ensayo[$k] && $i == $Muestra[$k]){
												$checked = "checked";
											}
											else{
												$checked = "";
											}
											?>
											<input type="checkbox" disabled <?php echo $checked; ?> name="<?php echo $detalle['IDENSAYO']?>[]" value="1">
											<?php
										}
										echo $detalle['NENSAYO'];
									break;
								}
								?>
							</div>
							<?php
						}
						?>
						<div class="clearfix"></div>
						<?php
						$i++;
				}
			}
			?>

		</div>
	</div>
	<div class="ln_solid"></div>

	<?php
	if($SS_TIPO_ENSAYO == 2 || $SS_TIPO_ENSAYO == 4){
		$QRY_MUESTRAS = "
			SELECT
				material, procedencia, ubicacion
			FROM
				TBL_FormSS
			WHERE
				numero_solicitud = '".$_GET['folio']."'
		";
		$SQL_MUESTRAS = mysqli_query($link, $QRY_MUESTRAS) or die ("Error en QRY Muestras: " . mysqli_error($link));;
		while($RE_MUESTRAS = mysqli_fetch_assoc($SQL_MUESTRAS)){
			$MATERIAL[] 		= $RE_MUESTRAS['material'];
			$PROCEDENCIA[] 	= $RE_MUESTRAS['procedencia'];
			$UBICACION[] 		= $RE_MUESTRAS['ubicacion'];
		}

		?>
	<div class="form-group row">
		<table>
			<tr>
				<td style="width:8%"></td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
			</tr>
			<tr>
				<td style="text-align:left;">Material</td>
				<?php
				for($i=0; $i<=7; $i++){?>
					<td>
						<input type="text" class="form-control" required name="material<?php echo $i;?>" id="material<?php echo $i;?>" disabled value="<?php echo $MATERIAL[$i];?>">
					</td>
				<?php
				}?>
			</tr>
			<tr>
				<td style="text-align:left;">Procedencia</td>
				<?php
				for($i=0; $i<=7; $i++){?>
					<td>
						<input type="text" class="form-control" required name="procedencia<?php echo $i;?>" id="procedencia<?php echo $i;?>" disabled value="<?php echo $PROCEDENCIA[$i];?>">
					</td>
				<?php
				}?>
			</tr>
			<tr>
				<td style="text-align:left;">Ubicaci&oacute;n</td>
				<?php
				for($i=0; $i<=7; $i++){?>
					<td>
						<input type="text" class="form-control" required name="ubicacion<?php echo $i;?>" id="ubicacion<?php echo $i;?>" disabled value="<?php echo $UBICACION[$i];?>">
					</td>
				<?php
				}?>
			</tr>
		</table>
	</div>
	<div class="ln_solid"></div>
<?php }?>

	<div class="ln_solid"></div>

	<div class="form-group row">
		<div class="col-md-8 col-sm-8 col-xs-12">
			<label for="message">Observaciones:</label>
			<textarea id="message" required="required" class="form-control" readonly name="observaciones"><?php echo $SS_OBS;?></textarea>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<label for="message">Persona que firma por cliente</label>
			<input type="text" class="form-control" name="firma_cliente_rut"  readonly value="<?php echo $SS_CLIENTERUT;?>">
			<input type="text" class="form-control" name="firma_cliente_nombre" readonly value="<?php echo $SS_CLIENTEFIRMA;?>">
		</div>
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
<script>

		$('#fecha_solicitud').datetimepicker({
				format: 'YYYY-MM-DD'
		});

		$('#hora_inicio').datetimepicker({
				format: 'HH:mm'
		});
		$('#hora_fin').datetimepicker({
				format: 'HH:mm'
		});


</script>
</body>
</html>
