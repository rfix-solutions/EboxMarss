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
		  text-align: center;
		  padding: 2px 2px 2px 2px;
		  /* Alto de las celdas */
		  height: 10px;
		}
		table th {
		  border: 1px solid #EFEFEF;
		  text-align: center;
			padding: 2px 2px 2px 2px;
		  /* Alto de las celdas */
		  height: 10px;
			background-color: #EFEFEF;
		}
		#encabezado_azul{
			width: 100%; height:45px; background-color: blue;
			font-size: 16px; color: white; text-align: center; padding-top:10px; padding-button:10px;
		}
		#encabezado_verde{
			width: 100%; height:10px; background-color: green;
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
			<div class="clearfix"></div>
				<div class="row">
        	<div class="x_panel">
          	<div class="x_content" style="font-size:11px;  ">
								<!-- //////////////////////////////-->
								<div class="col-md-12 col-sm-12 col-xs-12" id="encabezado_verde">
								</div>

								<div class="col-md-12 col-sm-12 col-xs-12" id="encabezado_azul">
									<div class="col-md-2 col-sm-2 col-xs-2">
										<img src="images/Logo_marss-lab_255x100.jpg" style="height: 35px;  text-align:right;">
									</div>
									<div class="col-md-10 col-sm-10 col-xs-10">
										<p id="header" style="text-align:right; ">
											INFORME DE ENSAYO OFICIAL
										</p>
									</div>
								</div>
<!-- SECCION 1 -->
								<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
									<img src="images/logo_inn-424x100.png" style="height: 35px; text-align:left;">
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12" style="text-align:left; margin-top:5px;font-size: 14px; text-align: center; color: black; padding-top:10px; height:30px;">
								<p style="font-weight:bold;">LABORATORIO DE OBRAS CIVILES LH 84579 / 17</p>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
								</div>

<!-- SECCION 2 -->
								<div class="x_content">
									<div style="margin-top:20px;">
										<p class="col-md-6 col-sm-6 col-xs-6" style="text-align:left">RESOLUCIÓN MINVU N° 13901 DEL 04/12/2017</p>
										<p class="col-md-6 col-sm-6 col-xs-6" style="text-align:right">08/08/2018</p>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" >
										<table >
		                	<tbody>
												<tr>
			                  	<th scope="row" colspan="5" style="width:20%">IDENTIFICACIÓN DE LA OBRA</th>
			                  </tr>
		                  <tr>
		                  	<th scope="row" style="width:20%">SOLICITANTE</th>
		                    <td colspan="4"></td>
		                  </tr>
		                  <tr>
		                  	<th scope="row">DIRECCION CLIENTE</th>
		                    <td  style="width:30%"></td>
		                    <th scope="row" style="width:20%">ATENCION SR.</th>
		                    <td></td>
		                  </tr>
											<tr>
		                  	<th scope="row">OBRA</th>
		                    <td></td>
		                    <th scope="row">CIUDAD</th>
		                    <td></td>
		                  </tr>
											<tr>
		                  	<th scope="row">MATERIAL (CLASE DE ÁRIDO)</th>
		                    <td></td>
		                    <th scope="row">CORRELATIVO N°</th>
		                    <td></td>
		                  </tr>
											<tr>
		                   	<th scope="row">PROCEDENCIA</th>
		                    <td></td>
		                    <th scope="row">N° SOLICITUD</th>
		                    <td></td>
		                  </tr>
											<tr>
		                  	<th scope="row">UBICACION</th>
		                  	<td></td>
		                  	<th scope="row">FECHA MUESTREO</th>
		                  	<td></td>
		                 	</tr>
											<tr>
		                  	<th scope="row">ENSAYO REALIZADO EN</th>
		                    <td></td>
		                    <th scope="row">ENSAYO REALIZADO POR</th>
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
														<?php
														///////////////////// Granulometria////////////////

														$query_ensayo_nombre = "
														SELECT
															e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
														FROM
															tbl_ensayo e, tbl_norma_ensayo n
														WHERE
															e.id_ensayo = '32' AND
															e.id_norma_ensayo = n.id_norma_ensayo
														";

														$query_ensayo_items = "
														SELECT
															i.nombre_ensayo_item NOMBRE
														FROM
															tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
														WHERE
															e.id_ensayo = '32' AND
															e.id_norma_ensayo = n.id_norma_ensayo AND
															i.id_ensayo = e.id_ensayo
														";

														$result_ensayo_items = mysqli_query($link,$query_ensayo_items);
														$result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
														while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
															$nombre_ensayo = $fila['NOMBRE'];
															$norma_ensayo = $fila['NORMA'];
														}
														?>
			                    	<tr>
			                      	<th><?php echo strtoupper($nombre_ensayo); ?></th>
			                      	<th><?php echo strtoupper($norma_ensayo); ?></th>
														</tr>
													</thead>
			                    <tbody>
			                    	<tr>
			                      	<td >TAMIZ</td>
			                        <td>% ACUMULADO QUE PASA	</td>
			                      </tr>
														<?php
														while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
															<tr>
					                    	<td><?php echo strtoupper($filas['NOMBRE']);?></td>
					                      <td></td>
					                    </tr>
														<?php
														}?>
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
													<?php
													/////////////////////Material Fino////////////////

													$query_ensayo_nombre = "
													SELECT
														e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
													FROM
														tbl_ensayo e, tbl_norma_ensayo n
													WHERE
														e.id_ensayo = '34' AND
														e.id_norma_ensayo = n.id_norma_ensayo
													";

													$query_ensayo_items = "
													SELECT
														i.nombre_ensayo_item NOMBRE, i.unidad_medida_item as UM
													FROM
														tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
													WHERE
														e.id_ensayo = '34' AND
														e.id_norma_ensayo = n.id_norma_ensayo AND
														i.id_ensayo = e.id_ensayo
													";

													$result_ensayo_items = mysqli_query($link,$query_ensayo_items);
													$result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
													while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
														$nombre_ensayo = $fila['NOMBRE'];
														$norma_ensayo = $fila['NORMA'];
													}
													?>
													<tr>
														<th><?php echo strtoupper($nombre_ensayo); ?></th>
														<th colspan="2"><?php echo strtoupper($norma_ensayo); ?></th>
													</tr>
													<?php
													while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
														<tr>
															<td style="text-align:left;"><?php echo strtoupper($filas['NOMBRE']);?></td>
															<td></td>
															<td><?php echo strtoupper($filas['UM']);?></td>
														</tr>
													<?php
													}?>
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
													<?php
													/////////////////////Determinacion de Sales Solubles////////////////

													$query_ensayo_nombre = "
													SELECT
														e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
													FROM
														tbl_ensayo e, tbl_norma_ensayo n
													WHERE
														e.id_ensayo = '35' AND
														e.id_norma_ensayo = n.id_norma_ensayo
													";

													$query_ensayo_items = "
													SELECT
														i.nombre_ensayo_item NOMBRE, i.unidad_medida_item as UM
													FROM
														tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
													WHERE
														e.id_ensayo = '35' AND
														e.id_norma_ensayo = n.id_norma_ensayo AND
														i.id_ensayo = e.id_ensayo
													";

													$result_ensayo_items = mysqli_query($link,$query_ensayo_items);
													$result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
													while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
														$nombre_ensayo = $fila['NOMBRE'];
														$norma_ensayo = $fila['NORMA'];
													}
													?>
													<tr>
														<th><?php echo strtoupper($nombre_ensayo); ?></th>
														<th colspan="2"><?php echo strtoupper($norma_ensayo); ?></th>
													</tr>
													<?php
													while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
														<tr>
															<td style="text-align:left;"><?php echo strtoupper($filas['NOMBRE']);?></td>
															<td></td>
															<td><?php echo strtoupper($filas['UM']);?></td>
														</tr>
													<?php
													}?>
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
													<?php
													/////////////////////Determinacion de equivalente de arena////////////////

													$query_ensayo_nombre = "
													SELECT
														e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
													FROM
														tbl_ensayo e, tbl_norma_ensayo n
													WHERE
														e.id_ensayo = '36' AND
														e.id_norma_ensayo = n.id_norma_ensayo
													";

													$query_ensayo_items = "
													SELECT
														i.nombre_ensayo_item NOMBRE, i.unidad_medida_item as UM
													FROM
														tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
													WHERE
														e.id_ensayo = '36' AND
														e.id_norma_ensayo = n.id_norma_ensayo AND
														i.id_ensayo = e.id_ensayo
													";

													$result_ensayo_items = mysqli_query($link,$query_ensayo_items);
													$result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
													while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
														$nombre_ensayo = $fila['NOMBRE'];
														$norma_ensayo = $fila['NORMA'];
													}
													?>
													<tr>
														<th><?php echo strtoupper($nombre_ensayo); ?></th>
														<th colspan="2"><?php echo strtoupper($norma_ensayo); ?></th>
													</tr>
													<?php
													while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
														<tr>
															<td style="text-align:left;"><?php echo strtoupper($filas['NOMBRE']);?></td>
															<td></td>
															<td><?php echo strtoupper($filas['UM']);?></td>
														</tr>
													<?php
													}?>
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
													<?php
													/////////////////////Desgaste por método los Angeles////////////////

													$query_ensayo_nombre = "
													SELECT
														e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
													FROM
														tbl_ensayo e, tbl_norma_ensayo n
													WHERE
														e.id_ensayo = '19' AND
														e.id_norma_ensayo = n.id_norma_ensayo
													";

													$query_ensayo_items = "
													SELECT
														i.nombre_ensayo_item NOMBRE, i.unidad_medida_item as UM
													FROM
														tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
													WHERE
														e.id_ensayo = '19' AND
														e.id_norma_ensayo = n.id_norma_ensayo AND
														i.id_ensayo = e.id_ensayo
													";

													$result_ensayo_items = mysqli_query($link,$query_ensayo_items);
													$result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
													while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
														$nombre_ensayo = $fila['NOMBRE'];
														$norma_ensayo = $fila['NORMA'];
													}
													?>
													<tr>
														<th><?php echo strtoupper($nombre_ensayo); ?></th>
														<th colspan="2"><?php echo strtoupper($norma_ensayo); ?></th>
													</tr>
													<?php
													while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
														<tr>
															<td style="text-align:left;"><?php echo strtoupper($filas['NOMBRE']);?></td>
															<td></td>
															<td><?php echo strtoupper($filas['UM']);?></td>
														</tr>
													<?php
													}?>
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
			                  	<th colspan="3" style="text-align:center;">DENSIDAD REAL, NETA Y ABSORCIÓN DE AGUA	</th>
			                  </tr>
			                </thead>
			                <tbody>
			                	<tr>
			                  	<td style="text-align:left;">DENSIDAD REAL SSS</td>
			                    <td></td>
													<td>kg/cm3</td>
			                  </tr>
												<tr>
				                  <td style="text-align:left;">DENSIDAD REAL SECA</td>
			                    <td></td>
													<td>kg/cm3</td>
			                  </tr>
												<tr>
			                  	<td style="text-align:left;">DENSIDAD REAL NETA</td>
			                    <td></td>
													<td>kg/cm3</td>
			                  </tr>
												<tr>
			                  	<td style="text-align:left;">ABSORCIÓN DE GUA</td>
			                    <td></td>
													<td>%</td>
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
			                  	<th colspan="3" style="text-align:center;">DETERMINACIÓN DE CARBON Y LIGNITO</th>
			                  </tr>
			                </thead>
			                <tbody>
			                	<tr>
			                  	<td style="text-align:left;">MASA DE LA MUESTRA</td>
			                    <td></td>
													<td>gr</td>
			                  </tr>
												<tr>
			                          <td style="text-align:left;">TIPO Y GRAVEDAD ESPECIFICA DEL LIQUIDO</td>
			                          <td></td>
																<td></td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">CARBON Y LIGNITO</td>
			                          <td></td>
																<td>%</td>
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
			                          <th colspan="3" style="text-align:center;">CLORUROS Y SULFATOS</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <td style="text-align:left;">CONTENIDO DE CLORUROS</td>
			                          <td></td>
																<td>kg Cl - / kg de arido</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">CONTENIDO DE SULFATOS</td>
			                          <td></td>
																<td>kg SO4-2 / kg de arido</td>
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
			                          <th colspan="3" style="text-align:center;">DESINTEGRACIÓN MEDIANTE SALES DE SULFATO	</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <td style="text-align:left;">PERDIDA DE MASA (SODIO)</td>
			                          <td></td>
																<td>%</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">PERDIDA DE MASA (MAGNESIO)</td>
			                          <td></td>
																<td>%</td>
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
			                          <th colspan="3" style="text-align:center;">PARTICULAS DESMENUZABLES</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <td style="text-align:left;">PERDIDA DE MASA</td>
			                          <td></td>
																<td>%</td>
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
														<table>
			                      <thead>
			                        <tr>
			                          <th colspan="3" style="text-align:center;">CONTENIDO IMPUREZAS ORGÁNICAS NCh 166 Of 09	</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <td style="text-align:left;">COLORACIÓN MUESTRA</td>
			                          <td></td>
																<td></td>
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
			                          <th colspan="3" style="text-align:center;">DENSIDADES APARENTES COMPACTADAS Y SUELTAS NCh 1325 Of 10		</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <td style="text-align:left;">METODO DE ENSAYO (D.A.C.)</td>
			                          <td></td>
																<td>APISONADO	</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">PROMEDIO DENSIDAD APARENTE COMPACTADA</td>
			                          <td></td>
																<td>Kg/m3</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">METODO DE ENSAYO (D.A.S.)</td>
			                          <td></td>
																<td>POR SIMPLE VACIADO	</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">PROMEDIO DENSIDAD APARENTE SUELTA</td>
			                          <td></td>
																<td>Kg/m3</td>
			                        </tr>
															<tr>
			                          <td style="text-align:left;">FECHA DE ENSAYO</td>
			                          <td></td>
																<td></td>
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
															<td style="text-align:left;">METODO DE ENSAYO (D.A.C.)</td>
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
