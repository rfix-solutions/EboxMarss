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
	<!-- bootstrap-daterangepicker -->
	<link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<!-- bootstrap-datetimepicker -->
	<link href="../../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
	<!-- Ion.RangeSlider -->
	<link href="../../vendors/normalize-css/normalize.css" rel="stylesheet">
	<link href="../../vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
	<link href="../../vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
	<!-- Bootstrap Colorpicker -->
	<link href="../../vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

	<link href="../../vendors/cropper/dist/cropper.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="../../build/css/custom.min.css" rel="stylesheet">
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
			width: 100%; height:40px; text-align: center; margin-top: 15px;
		}
		.firma{
			width: 100%; height:40px; text-align: center; padding: 2px; font-size: 14px;
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
										<p id="header" style="text-align:right; ">INFORME DE ENSAYO OFICIAL</p>
									</div>
								</div>
								<div class="form-group col-md-3 col-sm-4 col-xs-2">
									<img src="../images/Logo_marss-lab_255x100.jpg" style="width: 100%;">
								</div>
							</div>
							<div class="x_content">
								<div class="form-group col-md-3 col-sm-3 col-xs-12" style="text-align:center;">
									<img src="../images/logo_inn-424x100.png" style="width: 80%;">
								</div>
								<div class="col-md-6 col-sm-3 col-xs-12">
									<p style="text-align:center; font-weight: bold; font-size:16px;"> LABORATORIO DE OBRAS CIVILES LH 83579 / 17</p>
								</div>
								<div class="form-group col-md-3 col-sm-3 col-xs-12" style="text-align:center;">
									<img src="../images/logo_inn-424x100.png" style="width: 80%;">
								</div>
							</div>

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
											<th scope="row">Fecha Fabricacion</th>
											<td ></td>
											<th scope="row">Fecha Muestreo</th>
											<td ></td>
										</tr>
										<tr>
											<th scope="row">Ensayo realizado en</th>
											<td ></td>
											<th scope="row">Muestra tomada por</th>
											<td ></td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="x_content">
								<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
									<table class="table table-bordered" style=" width:100%">
										<thead>
											<tr>
										  	<th>Resultados</th>
										  </tr>
										</thead>
										<tbody>
											<tr>
												<td>Informe de Extracción</td>
											</tr>
											<tr>
												<td><input class="form-control" type="text"></td>
											</tr>
											<tr>
												<td>Procedimiento de aserrado y Refrenado</td>
											</tr>
											<tr>
												<td><input class="form-control" type="text"></td>
											</tr>
											<tr>
												<td>Condiciones de Conservación </td>
											</tr>
												<td><input class="form-control" type="text"></td>
											</tr>
										</tbody>
									</table>

									<table class="table table-bordered" style=" width:100%;" >
										<thead>
											<tr>
										  	<th colspan="2">EXTRACCIÓN Y DETERMINACIÓN DE ESPESOR EN TESTIGOS DE HORMIGÓN</th>
										    <th >NCh 1171 Of 2012</th>
										  </tr>
										</thead>
										<tbody>
											<tr>
										  	<td colspan="2">TESTIGO NUMERO</td>
										   	<td >1</td>
										  </tr>
											<tr>
										  	<td colspan="2">Fecha Ensayo</td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
										  </tr>
										  <tr>
										  	<td>Altura Inicial</td>
										    <td>cm</td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
										  </tr>
										</tbody>
									</table>

									<table class="table table-bordered" style=" width:100%;" >
										<thead>
											<tr>
										  	<th colspan="2">ENSAYO DE COMPRESIÓN EN TESTIGOS DE HORMIGÓN</th>
										    <th >NCh 1171 Of 2012</th>
										  </tr>
										</thead>
										<tbody>
											<tr>
										  	<td colspan="2">FECHA ENSAYO</td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
										  </tr>
										  <tr>
										  	<td colspan="2">ESBELTEZ</td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
										  </tr>
										  <tr>
										  	<td>DIÁMETRO</td>
										    <td>cm</td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
										  </tr>
										  <tr>
										  	<td>ALTURA DE CORTE</td>
										    <td>cm</td>
										   	<td><input style="width:100%;" class="form-control" type="text"></td>
											</tr>
										  <tr>
										  	<td>DENSIDAD </br>Método volumétrico</td>
										    <td>kg/m3</td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
											</tr>
										  <tr>
										  	<td>ALTURA DE ENSAYO </td>
										    <td>cm</td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
											</tr>
										  <tr>
										  	<td>CARGA DE ROTURA  </td>
										    <td>kN </td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
											</tr>
										  <tr>
										  	<td>RESISTENCIA DEL TESTIGO</td>
										    <td>MPa </td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
											</tr>
										  <tr>
										  	<td>RESISTENCIA CILÍNDRICA </td>
										    <td>MPa </td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
											</tr>
										  <tr>
										  	<td>RESISTENCIA CUBICA NCh 170 of 85</td>
										    <td>MPa </td>
										    <td><input style="width:100%;" class="form-control" type="text"></td>
											</tr>
										</tbody>
									</table>

									<table class="table table-bordered" style=" width:100%;" >
										<tr>
											<td>IDENTIFICACIÓN DE LOS TESTIGOS:</td>
										</tr>
										<tr>
											<td><input class="form-control" type="text"></td>
										</tr>
									</table>

									<table class="table table-bordered" style=" width:100%;" >
										<tr>
											<th>OBSERVACIONES</th>
										</tr>
										<tr>
											<td><textarea class="form-control"></textarea></td>
										</tr>
									</table>
								</div>
							</div>


						<div class="x_content">
							<div class="col-sm-12 col-md-12 col-xs-12">
								<div>
									<img src="../images/firma_avargas.png">
									<img src="../images/timbre-informe-marss.png">
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
						</div>
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
