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
		location.href="../../login/index.php?url=<?php echo $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];?>";
	</script>
<?php
		exit;
}
include '../_qry/db_connect_local.php';

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
	<!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
		table {
  		border: 1px solid;
			margin-bottom: 10px;
			width: 100%;
			border-collapse: collapse;

		}
		table td {
		  border: 1px solid #EFEFEF;
		  text-align: left;
		  padding: 2px 2px 2px 2px;
		  /* Alto de las celdas */
		  height: 10px;
		}
		table th {
		  border: 1px solid #EFEFEF;
		  text-align: left;
			padding: 2px 2px 2px 2px;
		  /* Alto de las celdas */
		  height: 10px;
			background-color: #EFEFEF;
		}
		.encabezado{
			width: 100%; height:35px; background-color: green;
			font-size: 16px; color: white; text-align: center; padding-top:10px; padding-button:10px;
		}
		.observaciones{
			width: 100%; height:40px; text-align: center; margin-top: 15px; font-size: 10px;
		}
		.firma{
			width: 100%; height:40px; text-align: center; padding: 2px; font-size: 14px;
		}
		.formato_pag{
			display: flex; justify-content: center; align-items: center;
		}
		.ancho_pag{
			width:70%;
		}

	  </style>
  </head>

<body class="nav-md" role="main">
	<div class="container body formato_pag" >
		<div class="main_container ancho_pag">
			<div class="clearfix"></div>
				<div class="row">
        	<div class="x_panel">
          	<div class="x_content" style="font-size:11px;  ">
								<!-- //////////////////////////////-->
								<div class="col-md-12 col-sm-12 col-xs-12 encabezado">
									Informe Ensayo Oficial
								</div>
<!-- SECCION 1 -->
								<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
									<img src="images/logo_inn-424x100.png" style="height: 35px; text-align:left;">
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12" style="text-align:left; margin-top:5px;font-size: 14px; text-align: center; color: black; padding-top:10px; height:30px;">
									Laboratorio de Obras Civiles LH 84579 / 17
								</div>


								<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
									<img src="images/Logo_marss-lab_255x100.jpg" style="height: 35px;  text-align:right;">
								</div>

<!-- SECCION 2 -->
								<div class="x_content">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
										<table >
		                	<tbody>
											<tr>
			                 	<th scope="row" colspan="4" style="text-align:center;">IDENTIFICACIÓN DE LA OBRA</th>
												<th scope="row" colspan="2" style="text-align:center;">CARACTERISTICAS DE MUESTREO</th>
			                </tr>
		                  <tr>
		                  	<th style="width:15%;" scope="row" >Solicitante</th>
		                    <td colspan="3" ></td>
												<th style="width:15%;" scope="row" >Correlativo N°</th>
												<td ></td>
		                  </tr>
		                  <tr>
		                  	<th scope="row">Direccion Cliente</th>
		                    <td colspan="3"></td>
		                    <th scope="row" >N° Solicitud</th>
		                    <td></td>
		                  </tr>
											<tr>
		                  	<th scope="row">Obra</th>
		                    <td colspan="3"></td>
												<th scope="row">Fecha muestreo</th>
												<td></td>
		                  </tr>
											<tr>
		                  	<th scope="row">Construye</th>
		                    <td colspan="3"></td>
												<th scope="row">Hora Muestreo</th>
												<td></td>
		                  </tr>
											<tr>
		                   	<th scope="row">Atencion Sr.</th>
		                    <td></td>
		                    <th style="width:15%;" scope="row">Ubicacion Obra</th>
		                    <td></td>
												<th scope="row">Muestra tomada por</th>
		                    <td></td>
		                  </tr>
		                  </tbody>
											<tbody>
											<tr>
			                 	<th scope="row" colspan="4" style="text-align:center;">CARACTERISTICAS Y PROPIEDADES DEL HORMIGÓN FRESCO</th>
												<th scope="row" >Curado en obra</th>
												<td></td>
			                </tr>
										</tbody>
										<tr>
											<th scope="row">Asentamiento de Cono</th>
											<td></td>
											<th scope="row">Tipo de Transporte</th>
											<td></td>
											<th scope="row">Tipo de Muestra</th>
											<td></td>
										</tr>
										<tr>
											<th scope="row">Temperatura de Hormigón</th>
											<td></td>
											<th scope="row">Aspecto</th>
											<td></td>
											<th scope="row">Lugar de Extracción</th>
											<td></td>
										</tr>
										<tr>
											<th scope="row">Temperatura Ambiente</th>
											<td></td>
											<th scope="row">Textura</th>
											<td></td>
											<th scope="row">Tipo Compactación</th>
											<td></td>
										</tr>
										<tr>
											<th scope="row">Aditivos Utilizados</th>
											<td colspan="3"></td>
											<th scope="row">N° Guía de Despacho</th>
											<td></td>
										</tr>
										<tbody>
										<tr>
											<th scope="row" colspan="4" style="text-align:center;">ANTECEDENTES DEL HORMIGÓN				</th>
											<th scope="row" >Curado en Laboratorio</th>
											<td></td>
										</tr>
									</tbody>
									<tr>
										<th scope="row">Resistencia Característica</th>
										<td></td>
										<th scope="row">Nivel de confianza</th>
										<td></td>
										<th scope="row">Tipo de probeta</th>
										<td></td>
									</tr>
									<tr>
										<th scope="row">Dosificación</th>
										<td></td>
										<th scope="row">Codigo de Obra</th>
										<td></td>
										<th scope="row">Dimensiones</th>
										<td></td>
									</tr>
									<tr>
										<th scope="row">Características de Mezclado</th>
										<td></td>
										<th scope="row">Procedencia</th>
										<td></td>
										<th scope="row">Cantidad de probetas</th>
										<td></td>
									</tr>
									<tr>
										<th scope="row">Elemento Hormigonado</th>
										<td colspan="3"></td>
										<th scope="row">Volumen Muestreado</th>
										<td></td>
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
													<th>ENSAYOS SOLICITADOS Y </br>NORMAS DE REFERENCIA</th>
													<td>
														NCh 171.E Of 1975</br>
														NCh 1019 Of 2009</br>
														NCh 158 Of 1967</br>
														NCh 2261 Of 2009</br>
													</td>
													<td>
														Extracción de muestras de hormigón fresco.</br>
														Determinación de la docilidad del hormigón fresco. Método de asentamiento del cono de Abrams.	</br>
														Ensaye de flexión y compresión de morteros de cemento.</br>
														Determinación de la resistencia mecanica de probetas confeccionadas en obra</br>
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
													<th>Fecha de Ensayo</th>
													<th>Edad</br>(dias)</th>
													<th>Area</br>(mm2)</th>
													<th>Densidad Aparente </br>(kg/m3)</th>
													<th>Carga Máxima </br>(kN)</th>
													<th>Resistencia a </br> Compresion (MPa) </th>
													<th>Resistencia Cúbica </br>NCh 170 of 85(MPa) </th>
													<th>Tipo de rotura</th>
												</tr>
												</tbody>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
										</table>
									</div>
								</div>

								<div class="x_content">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
										<div>
											<table>
												<tr>
													<th>CONDICIÓN APARENTE DE HUMEDAD DE PROBETAS:</th>
												</tr>
												<tr>
													<td>SATURADA SUPERFICIALMENTE SECA.</td>
												</tr>
												<tr>
													<th>OBSERVACIONES RELATIVAS AL HORMIGON DESPUES DE LA ROTURA:</th>
												</tr>
												<tr>
													<td>Sin observaciones</td>
												</tr>
												<tr>
													<th>OBSERVACIONES</th>
												</tr>
												<tr>
													<td>Sin observaciones</td>
												</tr>
											</table>


										</div>
									</div>
								</div>

										<div class="x_content">
											<div class="col-sm-12 col-md-12 col-xs-12">
												<div>
													<img src="images/firma_avargas.png">
													<img src="images/timbre-informe-marss.png">
												</div>
												<div class="firma">
													ALEJANDRO VARGAS CARRASCO</br>JEFE ÁREA HORMIGÓN
												</div>
												<div class="observaciones">
													EL PRESENTE INFORME DE ENSAYO NO DEBE SER REPRODUCIDO EXCEPTO EN SU TOTALIDAD SIN LA AUTORIZACIÓN DE MARSS LABORATORIOS</br>
													LOS RESULTADOS PRESENTADOS CORRESPONDEN SOLO A LA MUESTRA ENSAYADA Y NO A UN TOTAL DEL LOTE
												</div>
											</div>
										</div>
										<div class="x_content">
											<div class="col-md-12 col-sm-12 col-xs-12 encabezado">
													Calle Decima 494 Placilla Valparaíso - (32) 2138800 - laboratorio@marsslab.cl - www.marsslaboratorios.cl
											</div>
										</div>
								<!-- //////////////////////////////-->
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
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
	 <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
</body>
</html>
