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
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
    <link href="../../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../../vendors/starrr/dist/starrr.css" rel="stylesheet">
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
		#encabezado{
			width: 100%; height:35px; background-color: green;
			font-size: 16px; color: white; text-align: center; padding-top:10px; padding-button:10px;
		}
		#observaciones{
			width: 100%; height:40px; text-align: center; margin-top: 15px; font-size: 10px;
		}
		#firma{
			width: 100%; height:40px; text-align: center; padding: 2px; font-size: 14px;
		}
		#formato_pag{
			display: flex; justify-content: center; align-items: center;
		}
		#ancho_pag{
			width:70%;
		}

	  </style>
  </head>

<body class="nav-md" role="main">
	<div class="container body" id="formato_pag">
		<div class="main_container" id="ancho_pag">
			<div class="clearfix"></div>
				<div class="row">
        	<div class="x_panel">
          	<div class="x_content" style="font-size:11px;  ">
								<!-- //////////////////////////////-->
								<div class="col-md-12 col-sm-12 col-xs-12" id="encabezado">
									Informe Ensayo Oficial
								</div>
<!-- SECCION 1 -->
								<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
									<img src="../images/logo_inn-424x100.png" style="height: 35px; text-align:left;">
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12" style="text-align:left; margin-top:5px;font-size: 14px; text-align: center; color: black; padding-top:10px; height:30px;">
									Laboratorio de Obras Civiles LH 84579 / 17
								</div>


								<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
									<img src="../images/Logo_marss-lab_255x100.jpg" style="height: 35px;  text-align:right;">
								</div>

<!-- SECCION 2 -->
								<div class="x_content">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
										<table >
		                	<tbody>
		                  <tr>
		                  	<th scope="row" style="width:20%">Solicitante</th>
		                    <td colspan="4"></td>
		                  </tr>
		                  <tr>
		                  	<th scope="row">Direccion Cliente</th>
		                    <td  style="width:30%"></td>
		                    <th scope="row" style="width:20%">Atencion Sr.</th>
		                    <td></td>
		                  </tr>
											<tr>
		                  	<th scope="row">Obra</th>
		                    <td></td>
		                    <th scope="row">Ciudad</th>
		                    <td></td>
		                  </tr>
											<tr>
		                  	<th scope="row">Material</th>
		                    <td></td>
		                    <th scope="row">Correlativo N°</th>
		                    <td></td>
		                  </tr>
											<tr>
		                   	<th scope="row">Procedencia</th>
		                    <td></td>
		                    <th scope="row">N° Solicitud</th>
		                    <td></td>
		                  </tr>
											<tr>
		                  	<th scope="row">Ubicaci&oacute;n</th>
		                  	<td></td>
		                  	<th scope="row">Fecha Muestreo</th>
		                  	<td></td>
		                 	</tr>
											<tr>
		                  	<th scope="row">Ensayo Realizado en</th>
		                    <td></td>
		                    <th scope="row">Muestra tomada por</th>
		                    <td></td>
		                  </tr>
		                  </tbody>
										</table>
									</div>
								</div>

<!-- SECCION 3-->
								<div class="x_content">
									<div class="col-md-5 col-sm-6 col-xs-12" style="margin-top:10px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
												<table>
			                  	<thead>
			                    	<tr>
			                      	<th>Granulometr&iacute;a</th>
			                      	<th>MC Vol 8 - 8.202.2</br>MC Vol 8 - 8.102.1	</th>
														</tr>
													</thead>
			                    <tbody>
			                    	<tr>
			                      	<td style="width:60%" >Tamiz</td>
			                        <td>% Acumulado que pasa</td>
			                      </tr>
													<tr>
			                    	<td>SOBRETAMAÑO</td>
			                      <td></td>
			                    </tr>
													<tr>
			                    	<td>3”</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      <td>2 ½”</td>
			                      <td></td>
			                    </tr>
													<tr>
			                    	<td>2”</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      	<td>1 1/2"</td>
			                        <td></td>
			                    </tr>
													<tr>
			                    	<td>1”</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      <td>3/4"</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      <td>1/2"</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      <td>3/8”</td>
			                     	<td></td>
			                    </tr>
													<tr>
			                      <td>N° 4</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      <td>N° 8</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      <td>Nº 16</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      <td>Nº 30</td>
			                     	<td></td>
			                    </tr>
													<tr>
			                      <td>N° 50</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      <td>N° 100</td>
			                      <td></td>
			                   	</tr>
													<tr>
			                      <td>N° 200</td>
			                      <td></td>
			                    </tr>
													<tr>
			                      <td>MODULO DE FINURA</td>
			                     	<td></td>
			                    </tr>
													<tr>
			                    	<td>T.M.A.</td>
			                      <td></td>
			                   	</tr>
													<tr>
			                      <td>PORCENTAJE DE HUECOS (%)</td>
			                      <td></td>
			                    </tr>
													<tr>
			                     	<td> FECHA DE ENSAYO</td>
			                      <td></td>
			                    </tr>
		                    </tbody>
											</table>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<table>
												<thead>
												<tr>
													<th colspan="3" style="text-align:center;">LIMITES DE ATTERBERG NCh 1517/1 Of 79 - NCh 1517/2 Of 79	</th>
												</tr>
												</thead>
												<tbody>
													<tr>
														<td style="text-align:left; width:60%">LÍMITE LÍQUIDO</td>
														<td></td>
													</tr>
													<tr>
														<td style="text-align:left;">TIPO DE ACANALADOR</td>
														<td></td>
													</tr>
													<tr>
														<td style="text-align:left;">MÉTODO DE ENSAYO</td>
														<td></td>
													</tr>
													<tr>
														<td style="text-align:left;">LÍMITE PLÁSTICO</td>
														<td></td>
													</tr>
													<tr>
														<td style="text-align:left;">ÍNDICE DE PLASTICIDAD</td>
														<td></td>
													</tr>
													<tr>
														<td style="text-align:left;">FECHA DE ENSAYO</td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">
											<table >
												<thead>
												<tr>
													<th colspan="3" style="text-align:center;">CLASIFICACIÓN DE SUELOS (No acreditable)</th>
												</tr>
												</thead>
												<tbody>
													<tr>
														<td style="text-align:left; width:60%">SISTEMA USCS</td>
														<td>SM</td>
													</tr>
													<tr>
														<td style="text-align:left; width:60%">SISTEMA AASHTO</td>
														<td>A - 1 - b (0)</td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">
											<table>
												<thead>
												<tr>
													<th colspan="3" style="text-align:center;">CUBICIDAD DE PARTÍCULAS MC Vol 8 - 8.202.6</th>
												</tr>
												</thead>
												<tbody>
													<tr>
														<td style="text-align:left; width:60%">CHANCADO TOTAL</td>
														<td></td>
														<td style="width:10%">%</td>
													</tr>
													<tr>
														<td style="text-align:left;">RODADURA TOTAL</td>
														<td></td>
														<td>%</td>
													</tr>
													<tr>
														<td style="text-align:left;">LAJA TOTAL</td>
														<td></td>
														<td>%</td>
													</tr>
													<tr>
														<td style="text-align:left;">FECHA DE ENSAYO</td>
														<td colspan="2"></td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">
											<table >
												<thead>
												<tr>
													<th colspan="3" style="text-align:center;">DENSIDAD DE PARTÍCULAS SOLIDAS TOTALES NCh 1532 Of 80</th>
												</tr>
												</thead>
												<tbody>
													<tr>
														<td style="text-align:left; width:60%">D.P.S. TOTAL </td>
														<td></td>
														<td style="width:10%">g/cm3</td>
													</tr>
													<tr>
														<td style="text-align:left;">FECHA DE ENSAYO</td>
														<td colspan="2"></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
<!-- SECCION 4 -->
									<div class="col-md-7 col-sm-6 col-xs-12" style="margin-top:10px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<table>
			                <thead>
			                	<tr>
			                  	<th colspan="3" style="text-align:center;">RELACIÓN HUMEDAD/DENSIDAD PROCTOR MODIFICADO NCh 1534/2 Of 79	</th>
			                  </tr>
			                </thead>
			                <tbody>
			                	<tr>
			                  	<td style="text-align:left; width:60%">MÉTODO EMPLEADO (MODIFICADO)</td>
			                    <td colspan="2"></td>
			                  </tr>
												<tr>
				                  <td style="text-align:left;">MATERIAL RETENIDO EN 20 mm (que pasa por 2'')</td>
			                    <td></td>
													<td style="width:10%">%</td>
			                  </tr>
												<tr>
			                  	<td style="text-align:left;">REEMPLAZO O DESCARTE DEL MAT. RETENIDO</td>
			                    <td colspan="2"></td>
			                  </tr>
												<tr>
			                  	<td style="text-align:left;">D.M.C.H</td>
			                    <td></td>
													<td>g/cm3</td>
			                  </tr>
												<tr>
			                  	<td style="text-align:left;">HUMEDAD OPTIMA</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
													<td style="text-align:left;">D.M.C.S.</td>
													<td></td>
													<td>g/cm3</td>
												</tr>
												<tr>
													<td style="text-align:left;">FECHA DE ENSAYO</td>
													<td colspan="2"></td>
												</tr>
			                </tbody>
											</table>
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">
											<table >
			                <thead>
			                	<tr>
			                  	<th colspan="3" style="text-align:center;">
														DETERMINACIÓN DE LA RAZÓN DE SOPORTE C.B.R	NCh 1852 Of 81</br>
														DETERMINACIÓN DE LAS HUMEDADES DE LA MUESTRA	NCh 1515 Of 79
													</th>
			                  </tr>
			                	</thead>
			                	<tbody>
			                	<tr>
			                  	<td style="text-align:left; width:60%">MÉTODO DE COMPACTACIÓN</td>
			                    <td colspan="2"></td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">DENSIDAD SECA ANTES DE LA INMERSIÓN</td>
			                    <td></td>
													<td style="width:10%">g/cm3</td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">ACONDICIONAMIENTO DE LA MUESTRA</td>
			                    <td colspan="2"></td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">DENSIDAD SECA DESPUES DE LA INMERSIÓN</td>
			                    <td></td>
													<td>g/cm3</td>
			                  </tr>
												<tr>
				                  <td style="text-align:left;">FECHA DE ENSAYO</td>
			                    <td colspan="2"></td>
			                 	</tr>


												<tr>
			                    <td style="text-align:left;">ANTES DE LA COMPACTACIÓN</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">DESPUÉS DE LA COMPACTACIÓN</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">CAPA SUP. DE 25 mm DESPUÉS DE INMERSIÓN</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">PROMEDIO DESPUÉS DE LA INMERSIÓN</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">C.B.R. a 0,1” de Penetración</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">C.B.R. a 0,2” de Penetración</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">C.B.R. a 0,3” de Penetración</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
			                    <td style="text-align:left;">EXPANSIÓN (% DE LA ALTURA INICIAL)</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
													<td style="text-align:left;">SOBRECARGA</td>
													<td></td>
													<td>Kg</td>
												</tr>
												<tr>
			                    <td style="text-align:left;">C.B.R al 95% de la D.M.C.S a 0,2" de penetración </br> (Fuera del alcance de la acreditación)</td>
			                    <td></td>
													<td>%</td>
			                  </tr>
												<tr>
				                  <td style="text-align:left;">FECHA DE ENSAYO</td>
			                    <td colspan="2"></td>
			                 	</tr>
			                  </tbody>
											</table>
										</div>

												<div class="col-md-12 col-sm-12 col-xs-12">
														<table >
			                      <thead>
			                        <tr>
			                          <th colspan="3" style="text-align:center;">DETERMINACIÓN DEL EQUIVALENTE DE ARENA	NCh 1325 Of 10</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <td style="text-align:left; width:60%">AGITACIÓN MECÁNICA</td>
																<td colspan="2">ASTM D 2419	</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">EQUIVALENTE DE ARENA (E.A.)</td>
			                          <td colspan="2"></td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">TIEMPO SEDIMENTACIÓN</td>
			                          <td ></td>
																<td style="width:10%">Minutos</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">FECHA DE ENSAYO</td>
			                          <td></td>
																<td></td>
			                        </tr>
			                      </tbody>
													</table>
												</div>


												<div class="col-md-12 col-sm-12 col-xs-12">
														<table >
			                      <thead>
			                        <tr>
			                          <th colspan="3" style="text-align:center;">DESGASTE POR MÉTODO DE LOS ÁNGELES	NCh 1369 Of 10</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <td style="text-align:left; width:60%">PERDIDA DE MASA</td>
			                          <td></td>
																<td style="width:10%">%</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">GRADO DE ENSAYO</td>
			                          <td></td>
																<td>%</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">FECHA DE ENSAYO</td>
			                          <td colspan="2"></td>
			                        </tr>
			                      </tbody>
													</table>
												</div>






												<div class="col-sm-12 col-md-12 col-xs-12">
													<table >
													<thead>
														<tr>
															<th style="text-align:center;">Observaciones</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td style="text-align:left;">Texto de prueba para observaciones</td>
														</tr>
													</tbody>
													</table>


												</div>



										</div>
										</div>


										<div class="x_content">
											<div class="col-sm-12 col-md-12 col-xs-12">
												<div>
													<img src="../images/firma_avargas.png">
													<img src="../images/timbre-informe-marss.png">
												</div>
												<div id="firma">
													ALEJANDRO VARGAS CARRASCO</br>JEFE ÁREA HORMIGÓN
												</div>
												<div id="observaciones">
													EL PRESENTE INFORME DE ENSAYO NO DEBE SER REPRODUCIDO EXCEPTO EN SU TOTALIDAD SIN LA AUTORIZACIÓN DE MARSS LABORATORIOS</br>
													LOS RESULTADOS PRESENTADOS CORRESPONDEN SOLO A LA MUESTRA ENSAYADA Y NO A UN TOTAL DEL LOTE
												</div>
											</div>
										</div>
										<div class="x_content">
											<div class="col-md-12 col-sm-12 col-xs-12" id="encabezado">
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
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
	 <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../../vendors/starrr/dist/starrr.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
</body>
</html>
