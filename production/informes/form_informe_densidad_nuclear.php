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
		.resultado_titulo{
			text-align: left;
			font-style: italic;
			font-weight: bold;
		}
		.resultado_texto{
			text-align: left;
			margin-bottom: 20px;
		}
		.contenedor{
			border: 1px solid #efefef;
		}

	  </style>
  </head>

<body class="nav-md" role="main">
	<div class="container body formato_pag">
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
									LABORATORIO DE OBRAS CIVILES LD 83579 / 17
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
		                    <th scope="row">Correlativo N°</th>
		                    <td></td>
		                  </tr>
											<tr>
		                   	<th scope="row">Ciudad</th>
		                    <td></td>
		                    <th scope="row">N° Solicitud</th>
		                    <td></td>
		                  </tr>
											<tr>
		                  	<th scope="row">Material Controlado</th>
		                    <td></td>
		                    <th scope="row">Procedencia</th>
		                    <td></td>
		                  </tr>
											<tr>
												<th scope="row">Metodo utilizado</th>
												<td ></td>
												<th scope="row">Muestra tomada por</th>
		                    <td ></td>
		                  </tr>
		                  </tbody>
										</table>
									</div>
								</div>

<!-- SECCION 3-->
							<div class="x_content">
								<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
									<p style="text-align:left; font-weight: bold;">Referencias:</p>
									<table>
										<thead>
											<tr>
												<th style="width:20%;">Controles referidos a informe</th>
												<td></td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th>Densimetro Marca</th>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

								<div class="x_content">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
										<p style="text-align:left; font-weight: bold;">Resultados:</p>

										<table style="margin-bottom:10px;">
											<thead>
											<tr>
												<th colspan="9" style="text-align:center;">
													DENSIDAD (METODO NUCLEAR)</br>
													Método nuclear para determinar in situ la densidad de suelos (medición superficial)</br>
													MC Vol 8 - 8.502.1- MC Vol 8 - 8.502.2
												</th>
											</tr>
											</thead>
											<tbody>
												<tr>
													<td>Fecha Control</td>
													<td colspan="8"></td>
												</tr>
											<tr >
												<td style="width:20%" >Control N&uacute;mero </td>
												<td style="text-align: center;">1</td>
												<td style="text-align: center;">2</td>
												<td style="text-align: center;">3</td>
												<td style="text-align: center;">4</td>
												<td style="text-align: center;">5</td>
												<td style="text-align: center;">6</td>
												<td style="text-align: center;">7</td>
												<td style="text-align: center;">8</td>
											</tr>
											<tr >
												<td >Profundidad Color (cm)</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr >
												<td >D.C.H. (kg/m3)</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr >
												<td >D.C.S. (kg/m3)</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr >
												<td >D.M.C.S. (kg/m3)</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr >
												<td >Humedad (%)</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr >
												<td >Compactación (%)</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											</tbody>
										</table>


										<table style="margin-bottom:10px;">
											<thead>
											<tr>
												<th colspan="7" style="text-align:center;">
													Ubicación	</th>
											</tr>
											</thead>
											<tbody>
												<tr >
													<td style="width:20%; text-align: center;" >1 </td>
													<td style="text-align: center;">1</td>
												</tr>
											<tr>
												<td style="text-align: center;">2</td>
												<td></td>
											</tr>
											<tr>
												<td style="text-align: center;">3</td>
												<td></td>
											</tr>
											<tr>
												<td style="text-align: center;">4</td>
												<td></td>
											</tr>
											<tr>
												<td style="text-align: center;">5</td>
												<td></td>
											</tr>
											<tr>
												<td style="text-align: center;">6</td>
												<td></td>
											</tr>
											<tr>
												<td style="text-align: center;">7</td>
												<td></td>
											</tr>
											<tr>
												<td style="text-align: center;">8</td>
												<td></td>
											</tr>
											</tbody>
										</table>
									</div>
<!-- SECCION 2 -->
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
