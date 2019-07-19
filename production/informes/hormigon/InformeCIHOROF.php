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
		F.id_form_c_h_m AS IDFORMHM,
		F.numero_solicitud AS NFORMHM,
		F.fecha_muestra AS FECHAMUESTREO,
		F.hora_control AS HORACONTROL,
		L.nombre_laboratorista AS REALIZADOPOR,
		C.FormHMTipoCurado_Nombre AS CURADO,
		D.lugar_extraccion AS LUGAREXTRACCION,
		K.FormHMComp_Nombre AS COMPRESION,
		M.FormHMMov_Nombre AS TRANSPORTE,
		A.FormHMAs_Nombre AS ASPECTO,
		D.guia AS GUIA,
		P.FormHMProb_Nombre AS PROBETA,
		D.m3 AS VOLUMEN,
		T.FormHMTex_Nombre AS TEXTURA,
		D.elemento_hormigonado AS ELEMENTOHORMIGONADO,
		O.FormHMPro_Nombre AS PROCEDENCIA,
		D.dosificacion_declarada AS DOSIFICACION,
		D.cono AS CONO,
		D.temperatura_ambiente AS TAMBIENTE,
		D.temperatura_hormigon AS THORMIGON,
		D.aditivos AS ADITIVOS,
		F.correlativo AS CORRELATIVO,
		F.cantidad_muestras AS CANTIDADMUESTRAS,
		Z.empresa_constructora AS CONSTRUYE,
		Z.empresa_solicitante AS SOLICITANTE,
		Z.direccion_obra AS DIRECCION,
		Z.nombre_solicitante AS ATSENOR,
		Z.nombre_obra AS OBRA,
		P.FormHMProb_Tipo AS TIPO
	FROM
		TBL_FormHMTipoCurado C, TBL_FormHM F, TBL_FormHMDet D, TBL_FormHMComp K, TBL_Laboratorista L, TBL_Informe I, TBL_FormHMProb P, TBL_FormHMMov M, TBL_FormHMAs A, TBL_FormHMTex T, TBL_FormHMProc O, TBL_AgendaVisita V, TBL_FormAC Z
	WHERE
		I.Informe_Id = '".$InformeId."' AND
		I.Informe_IdFormCH = F.id_form_c_h_m AND
		F.realizado_por = L.id_laboratorista AND
		F.id_form_c_h_m = D.id_form_c_h_m AND
		D.FormHMComp_Id = K.FormHMComp_Id AND
		D.FormHMProb_Id = P.FormHMProb_Id AND
		D.FormHMMov_Id = M.FormHMMov_Id AND
		D.FormHMAs_Id = A.FormHMAs_Id AND
		D.FormHMTex_Id = T.FormHMTex_Id AND
		D.FormHMPro_Id = O.FormHMPro_Id AND
		D.FormHMTipoCurado_Id = C.FormHMTipoCurado_Id AND
		F.id_agendamiento_visita = V.id_agendamiento_visita AND
		V.id_form_aceptacion = Z.id_form_aceptacion
";
$HM1_Sql = mysqli_query($link, $HM1_Qry) or die ("Error QryHM1: ". mysqli_error($link));;

while($HM1_Dat = mysqli_fetch_assoc($HM1_Sql)){
	$IDFormHM 	= $HM1_Dat['IDFORMHM'];
	$NFormHM 	= $HM1_Dat['NFORMHM'];
	$FechaMuestreo = $HM1_Dat['FECHAMUESTREO'];
	$HoraControl = $HM1_Dat['HORACONTROL'];
	$RealizadoPor = $HM1_Dat['REALIZADOPOR'];
	$Curado	= $HM1_Dat['CURADO'];
	$LugarExtraccion = $HM1_Dat['LUGAREXTRACCION'];
	$Compresion = $HM1_Dat['COMPRESION'];
	$Guia = $HM1_Dat['GUIA'];
	$Probeta = $HM1_Dat['PROBETA'];
	$Volumen = $HM1_Dat['VOLUMEN'];
	$Transporte = $HM1_Dat['TRANSPORTE'];
	$Aspecto = $HM1_Dat['ASPECTO'];
	$Textura = $HM1_Dat['TEXTURA'];
	$ElementoHormigonado = $HM1_Dat['ELEMENTOHORMIGONADO'];
	$Procedencia = $HM1_Dat['PROCEDENCIA'];
	$Dosificacion = $HM1_Dat['DOSIFICACION'];
	$Aditivos = $HM1_Dat['ADITIVOS'];
	$Cono = $HM1_Dat['CONO'];
	$TAmbiente = $HM1_Dat['TAMBIENTE'];
	$THormigon = $HM1_Dat['THORMIGON'];
	$Correlativo = $HM1_Dat['CORRELATIVO'];
	$CantidadMuestras = $HM1_Dat['CANTIDADMUESTRAS'];
	$Construye  = $HM1_Dat['CONSTRUYE'];
	$Solicitante = $HM1_Dat['SOLICITANTE'];
	$Direccion = $HM1_Dat['DIRECCION'];
	$Obra = $HM1_Dat['OBRA'];
	$AtSenor = $HM1_Dat['ATSENOR'];
	$Tipo  = $HM1_Dat['TIPO'];
}
$DosificacionArray = explode("-", $Dosificacion);
$DosificacionTxt = $DosificacionArray[0]." ".$DosificacionArray[1]."(".$DosificacionArray[2].")".$DosificacionArray[3]."/".$DosificacionArray[4];
$HM2_Qry = "
SELECT
	D.EnsayoDetalleItem_IdEnsayoItem AS ID,
	D.EnsayoDetalleItem_ValorEnsayoItem AS VALUE,
	E.nombre_ensayo_item AS NAME,
	D.EnsayoDetalleItem_FechaOperacion AS DATEOP,
	T.edad AS EDAD,
	T.observaciones AS OBS
FROM
	TBL_EnsayoDetalleItem D, TBL_EnsayoItem E, TBL_FormHMDet T
WHERE
	D.EnsayoDetalleItem_IdSolicitudHM = '".$IDFormHM."' AND D.EnsayoDetalleItem_IdEnsayoItem = E.id_ensayo_item AND T.id_form_c_h_m = '".$IDFormHM."'
";


$HM2_Sql = mysqli_query($link, $HM2_Qry) or die ("Error en HM2 Qry: ". mysqli_error($link));;

while($HM2_Dat = mysqli_fetch_assoc($HM2_Sql)){
	switch ($HM2_Dat['ID']) {
		case '1':
			$Area = $HM2_Dat['VALUE'];
			break;

		case '2':
			$DensidadAparente = $HM2_Dat['VALUE'];
			break;
		case '3':
			$CargaMax  = $HM2_Dat['VALUE'];
			break;
		case '4':
			$ResistenciaComp  = $HM2_Dat['VALUE'];
			break;
		case '59':
			$Volumen = $HM2_Dat['VALUE'];
			break;
		case '60':
			$NCh170 = $HM2_Dat['VALUE'];
			break;

	}
	$FechaEnsayo = $HM2_Dat['DATEOP'];
	$Edad = $HM2_Dat['EDAD'];
	$Obs = $HM2_Dat['OBS'];
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


<!-- SECCION 2 -->
								<div class="x_content">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
										<table >
		                	<tbody>
											<thead style="background: #EDEDED;">
											<tr>
			                 	<th scope="row" colspan="4" style="text-align:center;">IDENTIFICACIÓN DE LA OBRA</th>
												<th scope="row" colspan="2" style="text-align:center;">CARACTERISTICAS DE MUESTREO</th>
			                </tr>
											</thead>
		                  <tr>
		                  	<th style="width:15%;" scope="row" >Solicitante</th>
		                    <td colspan="3" ><?php echo $Solicitante;?></td>
												<th style="width:15%;" scope="row" >Correlativo N°</th>
												<td ><?php echo $Correlativo;?></td>
		                  </tr>
		                  <tr>
		                  	<th scope="row">Direccion Cliente</th>
		                    <td colspan="3"><?php echo $Direccion;?></td>
		                    <th scope="row" >N° Solicitud</th>
		                    <td><a target="_blank" href="../../operaciones_FormHMdet.php?id=<?php echo $_GET['ida']?>&folio=<?php echo $NFormHM;?>"><?php echo $NFormHM;?></a></td>
		                  </tr>
											<tr>
		                  	<th scope="row">Obra</th>
		                    <td colspan="3"><?php echo $Obra;?></td>
												<th scope="row">Fecha muestreo</th>
												<td><?php echo $FechaMuestreo;?></td>
		                  </tr>
											<tr>
		                  	<th scope="row">Construye</th>
		                    <td colspan="3"><?php echo $Construye;?></td>
												<th scope="row">Hora Muestreo</th>
												<td><?php echo $HoraControl;?></td>
		                  </tr>
											<tr>
		                   	<th scope="row">Atencion Sr.</th>
		                    <td><?php echo $AtSenor;?></td>
		                    <th style="width:15%;" scope="row">Ubicacion Obra</th>
		                    <td>////DEFINIR DATO/////</td>
												<th scope="row">Muestra tomada por</th>
		                    <td><?php echo $RealizadoPor;?></td>
		                  </tr>
		                  </tbody>
											<tbody>

											<tr>
			                 	<th style="background: #EDEDED;" scope="row" colspan="4" style="text-align:center;">CARACTERISTICAS Y PROPIEDADES DEL HORMIGÓN FRESCO</th>
												<th scope="row" >Curado en obra</th>
												<td><?php echo $Curado;?></td>
			                </tr>
										</tbody>
										<tr>
											<th scope="row">Asentamiento de Cono</th>
											<td><?php echo $Cono;?></td>
											<th scope="row">Tipo de Transporte</th>
											<td><?php echo $Transporte;?></td>
											<th scope="row">Tipo de Muestra</th>
											<td>////DEFINIR DATO/////</td>
										</tr>
										<tr>
											<th scope="row">Temperatura de Hormigón</th>
											<td><?php echo $THormigon?></td>
											<th scope="row">Aspecto</th>
											<td><?php echo $Aspecto;?></td>
											<th scope="row">Lugar de Extracción</th>
											<td><?php echo $LugarExtraccion;?></td>
										</tr>
										<tr>
											<th scope="row">Temperatura Ambiente</th>
											<td><?php echo $TAmbiente?></td>
											<th scope="row">Textura</th>
											<td><?php echo $Textura;?></td>
											<th scope="row">Tipo Compactación</th>
											<td><?php echo $Compresion;?></td>
										</tr>
										<tr>
											<th scope="row">Aditivos Utilizados</th>
											<td colspan="3"><?php echo $Aditivos;?></td>
											<th scope="row">N° Guía de Despacho</th>
											<td><?php echo $Guia;?></td>
										</tr>
										<tbody>

										<tr>
											<th style="background: #EDEDED;" scope="row" colspan="4" style="text-align:center;">ANTECEDENTES DEL HORMIGÓN				</th>
											<th scope="row" >Curado en Laboratorio</th>
											<td>Inmersi&oacute;n</td>
										</tr>

									</tbody>
									<tr>
										<th scope="row">Resistencia Característica</th>
										<td><?php echo $DosificacionArray[1];?></td>
										<th scope="row">Nivel de confianza</th>
										<td><?php echo $DosificacionArray[2];?>%</td>
										<th scope="row">Tipo de probeta</th>
										<td><?php echo $Tipo; ?></td>
									</tr>
									<tr>
										<th scope="row">Dosificaci&oacute;n</th>
										<td><?php echo $DosificacionTxt;?></td>
										<th scope="row">Codigo de Obra</th>
										<td></td>
										<th scope="row">Dimensiones</th>
										<td><?php echo $Probeta?></td>
									</tr>
									<tr>
										<th scope="row">Características de Mezclado</th>
										<td>////DEFINIR DATO/////</td>
										<th scope="row">Procedencia</th>
										<td><?php echo $Procedencia; ?></td>
										<th scope="row">Cantidad de probetas</th>
										<td><?php echo $CantidadMuestras;?></td>
									</tr>
									<tr>
										<th scope="row">Elemento Hormigonado</th>
										<td colspan="3"><?php echo $ElementoHormigonado;?></td>
										<th scope="row">Volumen Muestreado</th>
										<td><?php echo $Volumen?></td>
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

													<th style="background: #EDEDED;">ENSAYOS SOLICITADOS Y </br>NORMAS DE REFERENCIA</th>
													<td>
															NCh 171 2008	</br>
															NCh 1017 2009	</br>
															NCh 1019 Of 2009	</br>
															NCh 1172 Of 2010	</br>
															NCh 1037 2009	</br>
													</td>
													<td>
														Extracción de muestras de hormigón fresco.			</br>
														Confección y curado en obra de probetas para ensayos de compresión y tracción.</br>
														Determinación de la docilidad del hormigón fresco. Método de asentamiento del cono de Abrams.			</br>
														Refrentado de probetas.			</br>
														Ensaye  de compresión de probetas cúbicas y cilíndricas.			</br>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="x_content">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
										<p style="text-align:left; font-style:bold;">Resultados</p>
										<table>
												<tbody>
												<tr>
													<th style="background: #EDEDED;">Fecha de Ensayo</th>
													<th style="background: #EDEDED;">Edad</br>(dias)</th>
													<th style="background: #EDEDED;">Area</br>(mm2)</th>
													<th style="background: #EDEDED;">Densidad Aparente </br>(kg/m3)</th>
													<th style="background: #EDEDED;">Carga Máxima </br>(kN)</th>
													<th style="background: #EDEDED;">Resistencia a </br> Compresion (MPa) </th>
													<th style="background: #EDEDED;">RESISTENCIA CUBICA NCh 170 of 85	</br> Compresion (MPa) </th>
												</tr>

												</tbody>
												<tr>
													<td><?php echo $FechaEnsayo;?></td>
													<td><?php echo $Edad;?></td>
													<td><?php echo $Area;?></td>
													<td><?php echo $DensidadAparente;?></td>
													<td><?php echo $CargaMax;?></td>
													<td><?php echo $ResistenciaComp; ?></td>
													<td>////DEFINIR DATO/////<?php //echo $TipoRotura; ?></td>
												</tr>
										</table>
									</div>
								</div>

								<div class="x_content">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
										<div>
											<table>
												<tr>
													<th>RESISTENCIA CUBICA NCH 170 OF 85 FUERA DEL ALCANCE DE LA ACREDITACIÓN</th>
												</tr>
												<tr>
													<th>CONDICIÓN APARENTE DE HUMEDAD DE PROBETAS:</th>
												</tr>
												<tr>
													<td>///DEFINIR DATO////</td>
												</tr>
												<tr>
													<th>OBSERVACIONES RELATIVAS AL HORMIGON DESPUES DE LA ROTURA:</th>
												</tr>
												<tr>
													<td><?php echo $Obs; ?></td>
												</tr>
												<tr>
													<th>OBSERVACIONES</th>
												</tr>
												<tr>
													<td>///DEFINIR DATO////</td>
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
								<!-- //////////////////////////////-->
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
			location.href="InformeCIHOROF_PDF.php?idi=<?php echo $InformeId;?>&foi=<?php echo $InformeFolio;?>";
		}
	 </script>
</body>
</html>
