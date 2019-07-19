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
		location.href="../../../login/index.php?url=<?php echo $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];?>";
	</script>
<?php
		exit;
}

$HM1_Qry= "
SELECT
	S.id_form_solicitud_servicio AS IDFORMSS,
	A.empresa_solicitante AS SOLICITANTEEMPRESA,
	A.nombre_obra AS OBRANOMBRE,
	A.direccion_obra AS OBRADIRECCION,
	C.comuna_nombre AS OBRACOMUNA,
	A.nombre_solicitante AS ATSENOR,
	S.cantidad_muestras AS QMUESTRAS,
	S.numero_solicitud AS NSOLICITUD,
	DATE_FORMAT(S.fecha_operacion, '%d-%m-%Y') FECHAOPERACION,
	DATE_FORMAT(S.fecha_solicitud, '%d-%m-%Y') FECHASOLICITUD,
	L.nombre_laboratorista AS REALIZADOPOR
FROM
	TBL_FormSS S, TBL_FormAC A, TBL_Informe I, TBL_AgendaVisita G, TBL_Laboratorista L, TBL_Comuna C
WHERE
	I.Informe_Id = '".$InformeId."' AND
	I.Informe_IdFormSS = S.id_form_solicitud_servicio AND
	S.id_agendamiento_visita = G.id_agendamiento_visita AND
	G.id_form_aceptacion = A.id_form_aceptacion AND
	S.realizado_por = L.id_laboratorista AND
	A.comuna_obra = C.comuna_id


";
$HM1_Sql = mysqli_query($link, $HM1_Qry) or die ("Error QryHM1: ". mysqli_error($link));;

while($HM1_Dat = mysqli_fetch_assoc($HM1_Sql)){
	$IDFormSS 	= $HM1_Dat['IDFORMSS'];
	$NSolicitud 	= $HM1_Dat['NSOLICITUD'];
	$RealizadoPor = $HM1_Dat['REALIZADOPOR'];
	$CantidadMuestras = $HM1_Dat['QMUESTRAS'];
	$Solicitante = $HM1_Dat['SOLICITANTEEMPRESA'];
	$ObraDireccion = $HM1_Dat['OBRADIRECCION'];
	$ObraComuna  = $HM1_Dat['OBRACOMUNA'];
	$ObraNombre   = $HM1_Dat['OBRANOMBRE'];
	$AtSenor = $HM1_Dat['ATSENOR'];
	$FechaOperacion = $HM1_Dat['FECHAOPERACION'];
	$FechaSolicitud = $HM1_Dat['FECHASOLICITUD'];
}
$FechaFabricacion = date("d-m-Y");


$DetalleEnsayos_Qry = "
	SELECT
		EnsayoDetalleItem_IdEnsayoItem AS ID,
		EnsayoDetalleItem_ValorEnsayoItem AS VALUE
	FROM
		TBL_EnsayoDetalleItem
	WHERE
		EnsayoDetalleItem_IdSolicitudSS = '".$IDFormSS."'
";

$DetalleEnsayos_Sql = mysqli_query($link, $DetalleEnsayos_Qry) or die ("Error en Detalle Ensayos : ". mysqli_error($link));;

while($DetalleEnsayos_Dat = mysqli_fetch_assoc($DetalleEnsayos_Sql)){
	switch ($DetalleEnsayos_Dat['ID']) {
		case '78':
			$InformeExtraccion = $DetalleEnsayos_Dat['VALUE'];
			break;

		case '79':
			$ProcedimientoAserrado = $DetalleEnsayos_Dat['VALUE'];
			break;

		case '80':
			$CondicionesConservacion = $DetalleEnsayos_Dat['VALUE'];
			break;
	}
}
/*
*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $Title.$Company;?></title>
		<!-- Bootstrap -->
		<link href="../../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="../../../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
		<link href="../../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="../../../build/css/custom.min.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
		<link href="../../../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
		<!-- Select2 -->
		<link href="../../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
		<!-- Switchery -->
		<link href="../../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
		<!-- starrr -->
		<link href="../../../vendors/starrr/dist/starrr.css" rel="stylesheet">
		<!-- bootstrap-daterangepicker -->
		<link href="../../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<style>
			html,body{
				height:297mm;
				text-align: center;
				background-color: #9b9b9b;
				font-family: arial;
				color: black;
				font-size: 12px;
			}
			#item-checkbox{
				font-size: 9px;
				text-align: left;
			}
			#formato_pag{
				display: flex; justify-content: center; align-items: center;
			}
			#ancho_pag{
				width:70%;
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
			#pagina{
				padding: 20px 35px 20px 35px; /* _Arriba _derecha _Abajo _Izquierda*/
				background-color: white;
				text-align: justify;
			}
			#footer{
				font-size: 13px;
				text-align: center;
				padding-top: 10px;
				padding-bottom: 10px;
				color: #171695;
				background-color: #FFFFFF;
				width: 100%;
				text-decoration-style: double;
			}
			#footer_borde{
				background-color: #171695;
				height: 10px;
			}
			#logo{
				height: 70%
			}
			#servicios{
				align-content: center;
				font-size: 12px;
			}
			#firma{
				width: 100%; height:40px; text-align: center; padding: 2px; font-size: 14px;
			}
			#firma_imagenes{
				width: 100%; text-align: center;
			}
			#titulo{
				text-align:center;
				margin-top:5px;
				font-size: 16px;
				text-align:center;
				color: black;
				font-weight: bold;
				padding-top:10px;
				height:30px;
			}
			#observaciones{
				margin-top: 10px;
				text-align:center;
			}
			table{
				width: 100%; border-collapse: collapse;
			}
			table, th,td{
				border: 2px solid #EDEDED;
			}

		</style>
</head>
<body class="nav-md" role="main">
	<div class="container body" id="formato_pag" >
		<div class="main_container" id="ancho_pag">
			<img src="../../images/banner-informe-ensayo-oficial.jpg" style="width:100%; text-align: center;">
			<div id="pagina" class="col-sm-12 col-md-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
						<img src="../../images/logo_inn-424x100.png" style="height: 35px; text-align:left;">
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12" id="titulo">
						Laboratorio de Obras Civiles <?php echo $InformeFolio;?>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left;">
						RESOLUCIÓN MINVU N° 4410 DEL 11/07/2018
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
						<?php echo date("d-m-Y");?>
					</div>
				</div>
				<!-- ///////////////////////////////////////////////////////////////////-->
				<div class="x_content">
					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
						<table>
              <tr>
              	<th style="width:15%;" scope="row">Solicitante</th>
                <td colspan="3" ><?php echo $Solicitante;?></td>
              </tr>
              <tr>
              	<th style="width:15%;" scope="row">Direccion Cliente</th>
                <td><?php echo $ObraDireccion;?></td>
								<th style="width:15%;" scope="row">Atencion Sr.</th>
                <td><?php echo $AtSenor;?></td>
              </tr>
							<tr>
              	<th style="width:15%;" scope="row">Obra</th>
                <td ><?php echo $ObraNombre;?></td>
								<th style="width:15%;" scope="row" >Correlativo N°</th>
								<td ><?php echo $Correlativo;?></td>
              </tr>
							<tr>
              	<th style="width:15%;" scope="row">Ciudad</th>
                <td ><?php echo $ObraComuna;?></td>
								<th style="width:15%;" scope="row">N° Solicitud</th>
                <td><a target="_blank" href="../../operaciones_FormSSdet.php?id=<?php echo $_GET['ida']?>&folio=<?php echo $NSolicitud;?>"><?php echo $NSolicitud;?></a></td>
              </tr>
							<tr>
								<th style="width:15%;" scope="row">Fecha Fabricaci&oacute;n</th>
								<td ><?php echo $FechaFabricacion;?></td>
								<th style="width:15%;" scope="row">Fecha muestreo</th>
								<td><?php echo $FechaOperacion;?></td>
							</tr>
							<tr>
                <th style="width:15%;" scope="row">Cantidad</th>
                <td ><?php echo $CantidadMuestras;?></td>
								<th scope="row">Muestra tomada por</th>
                <td><?php echo $RealizadoPor;?></td>
              </tr>
							<tr>
								<th scope="row">Material Controlado</th>
								<td colspan="3"><?php echo $MaterialControlado;?></td>
							</tr>
						</table>
					</div>
				</div>

<!-- SECCION 3-->
				<div class="x_content">
					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
						<table>
							<tbody>
								<tr>
									<th style="background: #EDEDED;">RESULTADOS</th>
								</tr>
								<tr>
									<th>INFORME DE EXTRACCI&Oacute;N:</th>
								</tr>
								<tr>
									<td><?php echo $InformeExtraccion; ?></td>
								</tr>
								<tr>
									<th>PROCEDIMIENTO DE ASERRADO Y REFRENADO:</th>
								</tr>
								<tr>
									<td><?php echo $ProcedimientoAserrado; ?></td>
								</tr>
								<tr>
									<th>CONDICIONES DE CONSERVACI&Oacute;N:</th>
								</tr>
								<tr>

									<td><?php echo $CondicionesConservacion; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="x_content">
					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
						<table>
								<tr>
									<th colspan="8" style="background: #EDEDED;text-align:center;">EXTRACCIÓN Y DETERMINACIÓN DE ESPESOR EN TESTIGOS DE HORMIGÓN</br>NCh 1171 Of 2012</th>
								</tr>
								<tr>
									<th colspan="2">TESTIGO NUMERO</th>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
									<th>5</th>
									<th>6</th>
								</tr>
								<tr>
									<th colspan="2">FECHA DE ENSAYO	</th>
									<th><?php echo $FechaSolicitud;?></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
<?php
$DetalleEnsayos_QRY1 = "SELECT id_ensayo_item AS ID, nombre_ensayo_item AS NOMBRE, unidad_medida_item AS UM FROM TBL_EnsayoItem WHERE id_ensayo = '5' AND id_ensayo_item = '67'";
$DetalleEnsayos_SQL1 = mysqli_query($link, $DetalleEnsayos_QRY1) or die ("Error en QRY Detalle" . mysqli_error($link));;

while($DetalleEnsayos_DAT1 = mysqli_fetch_assoc($DetalleEnsayos_SQL1)){?>
	<tr>
		<th style="width:35%;"><?php echo $DetalleEnsayos_DAT1['NOMBRE']?></th>
		<th style="width:5%;"><?php echo $DetalleEnsayos_DAT1['UM']?></th>
		<td style="width:10%;"></td>
		<td style="width:10%;"></td>
		<td style="width:10%;"></td>
		<td style="width:10%;"></td>
		<td style="width:10%;"></td>
		<td style="width:10%;"></td>
	</tr>
<?php
}
?>
								<tr>
									<th colspan="8" style="background: #EDEDED; text-align:center">ENSAYO DE COMPRESIÓN EN TESTIGOS DE HORMIGÓN</br>NCh 1172 Of 2010 NCh 1037 Of 2009	</th>
								</tr>
								<tr>
									<th colspan="2">FECHA DE ENSAYO</th>
									<td><?php echo $FechaSolicitud;?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
<?php
$DetalleEnsayos_QRY2 = "SELECT id_ensayo_item AS ID, nombre_ensayo_item AS NOMBRE, unidad_medida_item AS UM FROM TBL_EnsayoItem WHERE id_ensayo = '5' AND id_ensayo_item != '67'";
$DetalleEnsayos_SQL2 = mysqli_query($link, $DetalleEnsayos_QRY2) or die ("Error en QRY Detalle" . mysqli_error($link));;

while($DetalleEnsayos_DAT2 = mysqli_fetch_assoc($DetalleEnsayos_SQL2)){
	if($DetalleEnsayos_DAT2['ID'] != '78' && $DetalleEnsayos_DAT2['ID'] != '79' && $DetalleEnsayos_DAT2['ID'] != '80' && $DetalleEnsayos_DAT2['ID'] != '81'){
		?>
	<tr>
		<th style="width:35%;"><?php echo $DetalleEnsayos_DAT2['NOMBRE']?></th>
		<th style="width:5%;"><?php echo $DetalleEnsayos_DAT2['UM']?></th>
		<?php
		for($i=1; $i<=6; $i++){
		$Qry = "
			SELECT
				EnsayoDetalleItem_ValorEnsayoItem AS VALOR
			FROM
				TBL_EnsayoDetalleItem
			WHERE
				EnsayoDetalleItem_NMuestra = '".$i."' AND
				EnsayoDetalleItem_IdSolicitudSS = '".$IDFormSS."' AND
				EnsayoDetalleItem_IdEnsayoItem = '".$DetalleEnsayos_DAT2['ID']."'
		";
		$Sql = mysqli_query($link, $Qry) or die ("Error en Qry: " . mysqli_error($link));;
		while ($Dat = mysqli_fetch_assoc($Sql)) {
			if($Dat['VALOR']!= ""){
					$ValorEnsayo = $Dat['VALOR'];
			}
			else {
				$ValorEnsayo = "";
			}

		}
		?>
		<td style="width:10%;"><?php echo $ValorEnsayo;?></td>
		<?php
		$ValorEnsayo = "";
		}
		?>
	</tr>
	<?php
	}
}
?>
						</table>
					</div>
				</div>

				<div class="x_content">
					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
						<div>
							<table>
								<tr>
									<th colspan="2" style="background: #EDEDED;">IDENTIFICACIÓN DE LOS TESTIGOS:</th>
								</tr>
								<tr>
									<th>1</th>
									<td></td>
								</tr>
								<tr>
									<th>2</th>
									<td></td>
								</tr>
								<tr>
									<th>3</th>
									<td></td>
								</tr>
								<tr>
									<th>4</th>
									<td></td>
								</tr>
								<tr>
									<th>5</th>
									<td></td>
								</tr>
								<tr>
									<th>6</th>
									<td></td>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div class="x_content">
					<div id="firma_imagenes">
						<img src="../../images/firma_avargas.png">
						<img src="../../images/timbre-informe-marss.png">
					</div>
					<div id="firma">
						ALEJANDRO VARGAS CARRASCO</br>JEFE ÁREA HORMIGÓN
					</div>
					<div id="observaciones">
						EL PRESENTE INFORME DE ENSAYO NO DEBE SER REPRODUCIDO EXCEPTO EN SU TOTALIDAD SIN LA AUTORIZACIÓN DE MARSS LABORATORIOS</br>
						LOS RESULTADOS PRESENTADOS CORRESPONDEN SOLO A LA MUESTRA ENSAYADA Y NO A UN TOTAL DEL LOTE
					</div>
					<div id="footer_borde"></div>
					<div id="footer">
						Calle Décima Nº 493-494, Placilla, Valparaíso (32) 2138800 - Email: laboratorio@marsslab.cl - www.marsslab.cl
					</div>
					<div style="text-align: center;" >
						<button type="button" style="width:100%;" class="btn btn-success btn-md" data-toggle="modal" data-target="#Aprobar_informe">Aprobar Informe</button>
					</div>


					<div class="modal fade bs-example-modal-sm" id="Aprobar_informe" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								  <h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n</h4>
								</div>
								<div class="modal-body">
									<p>¿Realmente desea aprobar el informe <?php echo $InformeFolio;?>? </br>Esta operación incluirá la firma del documento y no se puede revertir</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
									<button type="button" class="btn btn-success" onclick="aprobar()">Aprobar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
    	</div>
		</div>
	</div>
	</div>

		<!-- jQuery -->
 	 <script src="../../../vendors/jquery/dist/jquery.min.js"></script>
 	 <!-- Bootstrap -->
 	 <script src="../../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
 	 <!-- FastClick -->
 	 <script src="../../../vendors/fastclick/lib/fastclick.js"></script>
 	 <!-- NProgress -->
 	 <script src="../../../vendors/nprogress/nprogress.js"></script>
 	 <!-- iCheck -->
 	 <script src="../../../vendors/iCheck/icheck.min.js"></script>
 	<!-- bootstrap-daterangepicker -->
 	 <script src="../../../vendors/moment/min/moment.min.js"></script>
 	 <script src="../../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
 	 <!-- bootstrap-wysiwyg -->
 	 <script src="../../../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
 	 <script src="../../../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
 	 <script src="../../../vendors/google-code-prettify/src/prettify.js"></script>
 	 <!-- jQuery Tags Input -->
 	 <script src="../../../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
 	 <!-- Switchery -->
 	 <script src="../../../vendors/switchery/dist/switchery.min.js"></script>
 	 <!-- Select2 -->
 	 <script src="../../../vendors/select2/dist/js/select2.full.min.js"></script>
 	 <!-- Parsley -->
 	 <script src="../../../vendors/parsleyjs/dist/parsley.min.js"></script>
 	 <!-- Autosize -->
 	 <script src="../../../vendors/autosize/dist/autosize.min.js"></script>
 	 <!-- jQuery autocomplete -->
 	 <script src="../../../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
 	 <!-- starrr -->
 	 <script src="../../../vendors/starrr/dist/starrr.js"></script>

 	 <!-- Custom Theme Scripts -->
 	 <script src="../../../build/js/custom.min.js"></script>
	 <script>
	 	function aprobar(){
			alert('Aprobado');
			location.href="InformeTH_PDF.php?idi=<?php echo $InformeId;?>&foi=<?php echo $InformeFolio;?>";
		}
	 </script>
</body>
</html>
