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

$sql = mysqli_query($link, "
SELECT
	c.id_cotizacion AS ID,
	DATE_FORMAT(c.fecha_creacion, '%d/%m/%Y') as FECHA,
	TIME_FORMAT(c.fecha_creacion, '%H:%I') as HORA,
	c.numero_cotizacion as COTIZACION,
	c.id_estado_cotizacion AS ID_ESTADO,
	c.nombre_proyecto as PROYECTO,
	u.sigla_usuario as RESPONSABLE,
	u.nombre_usuario as USER_NAME,
	u.apellido_paterno as USER_APEL,
	s.nombre_sucursal as SUCURSAL,
	cl.razon_social as CLIENTE,
	c.email_contacto as EMAIL,
	e.nombre_estado_cotizacion as ESTADO

FROM
	TBL_Cotizacion c, TBL_Usuario u, TBL_Cliente cl, TBL_Sucursal s, TBL_CotizacionEstado e
WHERE
	c.id_cotizacion = '".$_GET['id']."' AND
	c.id_cliente = cl.id_cliente AND
	c.id_usuario = u.id_usuario AND
	c.id_estado_cotizacion = e.id_estado_cotizacion AND
	u.id_sucursal = s.id_sucursal
") or die('Consulta fallida: '.mysql_error());;
while($fila = mysqli_fetch_assoc($sql)){
	$cot_fecha = $fila['FECHA'];
	$cot_hora = $fila['HORA'];
	$cot_numero = $fila['COTIZACION'];
	$cot_proyecto = $fila['PROYECTO'];
	$cot_responsable = $fila['RESPONSABLE'];
	$cot_sucursal = $fila['SUCURSAL'];
	$cot_cliente = $fila['CLIENTE'];
	$cot_estado = $fila['ESTADO'];
	$cot_estado_id = $fila['ID_ESTADO'];
	$cot_email = $fila['EMAIL'];
	$cot_usuario = "".$fila['USER_NAME']." ".$fila['USER_APEL']."";

}

switch ($cot_estado_id) {
	case '1':
		// Creada...
		$class = "btn btn-default btn-xs";
	break;
	case '2':
		// Enviada...
		$class = "btn btn-warning btn-xs";
	break;
	case '3':
		// Aceptada...
		$class = "btn btn-success btn-xs";
	break;
	case '4':
		// Agendada...
		$class = "btn btn-primary btn-xs";
	break;
	case '5':
		// Rechazada...
		$class = "btn btn-danger btn-xs";
	break;
	case '6':
		// Nula...
		$class = "btn btn-danger btn-xs";
	break;

	default:
		$class = "btn btn-default btn-xs";
		break;
}



$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

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
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="#" class="site_title">
							<p style="text-align:center;">
								<img src="images/logo_marss.png" />
							</p>
						</a>
					</div>
					<div class="clearfix"></div>
					<br />
					<?php include 'menu_sidebar.php'; ?>
					<?php include 'menu_footer.php'; ?>
				</div>
			</div>
			<?php include 'menu_top.php'; ?>
			<div class="right_col" role="main">
				<div class="page-title">
					<div class="title_left">
						<a style="width:50px; text-align: center;" href="dashboard_comercial.php" class="btn btn-default btn-xs">
						Volver</a>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_content">
								<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
									<h3><?php echo $cot_numero;?></h3>
									<a style="width:100%; text-align: center;" href="#" class="<?php echo $class;?>">
										<?php echo $cot_estado;?>
									</a>
									<h3><?php echo $cot_cliente;?></h3>
									<h4><?php echo $cot_proyecto;?></h4>
									</br>
									<ul class="list-unstyled user_data">
										<li><i class="fa fa-calendar user-profile-icon"></i> <?php echo $cot_fecha." a las ".$cot_hora;?></li>
										<li><i class="fa fa-building user-profile-icon"></i> <?php echo $cot_sucursal;?></li>
										<li><i class="fa fa-map-marker user-profile-icon"></i> Los Andes</li>
										<li><i class="fa fa-user user-profile-icon"></i> <?php echo $cot_usuario?></li>
										<li class="m-top-xs">
											<i class="fa fa-at user-profile-icon"></i>
											<a href="mailto:<?php echo strtolower($cot_email); ?>" target="_blank"><?php echo strtolower($cot_email);?></a>
										</li>
										<li style="text-align:center;"><button style="width:100%;" class="btn btn-default" onclick="location.href='crear_cotizacion_res.php?id=<?php echo $_GET['id'];?>'">Reenviar Cotizacion</button></li>
										<li style="text-align:center;"><button style="width:100%;" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-md">Agregar actividad</button></li>
									</ul>
									<br />
								</div>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<div class="" role="tabpanel" data-example-id="togglable-tabs">
										<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
											<li role="presentation" class="active"><a href="#comerciales" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Comerciales</a>
											</li>
											<li role="presentation" class=""><a href="#operaciones" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Operaciones</a>
											</li>
											<li role="presentation" class=""><a href="#laboratorio" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Laboratorio</a>
											</li>
											<li role="presentation" class=""><a href="#finanzas" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Finanzas</a>
											</li>
										</ul>
										<div id="myTabContent" class="tab-content">
											<!-- COMERCIALES  -->
											<div role="tabpanel" class="tab-pane fade active in" id="comerciales" aria-labelledby="home-tab">
												<table class="data table table-striped no-margin" >
													<thead>
														<tr >
															<th>#</th>
															<th>N° Documento</th>
															<th>Version</th>
															<th>Tipo documento</th>
															<th>Fecha Operaci&oacute;n</th>
															<th>Descargar</th>
														</tr>
													</thead>
													<tbody>
													<?php
													$sql2 = mysqli_query($link, "
														SELECT numero_cotizacion, version_cotizacion, fecha_creacion
														FROM TBL_Cotizacion
														WHERE id_cotizacion = '".$_GET['id']."'
														");
													$i=1;
													while($rows=mysqli_fetch_assoc($sql2)){?>
														<tr>
														  	<td><?php echo $i;?></td>
														  	<td>
																	<a style="width:100px; text-align: center;" target="_blank" href="document.php?id=<?php echo $_GET['id']?>" class="btn btn-default btn-xs">
																		<?php echo $rows['numero_cotizacion'];?>
																	</a>
																</td>
																<td><?php echo $rows['version_cotizacion'];?></td>
														  	<td>Cotizacion</td>
														  	<td><?php echo $rows['fecha_creacion'];?></td>
														  	<td style="text-align: center;">
																	<a style="width:50px; text-align: center;" target="_blank"  href="cotizacionPDF.php?id=<?php echo $_GET['id']?>" class="btn btn-default btn-xs">
																		<i class="fa fa-file-pdf-o"></i>
																	</a>
														  	</td>
														</tr>
													<?php
														$i++;
													}
													?>
													<tr>
														<td>2</td>
														<td>
															<a style="width:100px; text-align: center;" target="_blank" href="form_aceptacion.php?id=<?php echo $_GET['id']?>" class="btn btn-default btn-xs">
																<?php echo $_GET['id'];?>
															</a>
														</td>
														<td>1</td>
														<td>Formulario Aceptacion</td>
														<td><?php echo date("Y-m-d H:i:s");?></td>
														<td style="text-align: center;">
															<a style="width:50px; text-align: center;" target="_blank" href="aceptacionPDF.php?id=<?php echo $_GET['id']?>" class="btn btn-default btn-xs">
																<i class="fa fa-file-pdf-o"></i>
															</a>
														</td>
												</tr>
													</tbody>
												</table>
											</div>
											<!-- //////////////////////////// OPERACIONES  ////////////////////////////-->
											<div role="tabpanel" class="tab-pane fade" id="operaciones" aria-labelledby="profile-tab">
												<table class="data table table-striped no-margin" >
													<thead>
													<tr>
														<th>#</th>
														<th>N° Folio</th>
														<th>Tipo Servicio</th>
														<th>Laboratorista</th>
														<th>Fecha Operaci&oacute;n</th>
														<th>Descargar</th>
													</tr>
													</thead>
													<tbody>
													<?php
													$QRY_Op = "
														SELECT
															S.id_tipo_ensayo AS ID_ENSAYO,
															T.nombre_tipo_ensayo AS ENSAYO,
															S.fecha_operacion AS FECHA_OP,
															L.nombre_laboratorista AS LABORATORISTA,
															S.id_form_solicitud_servicio AS ID_SS
														FROM
															TBL_FormSS S, TBL_AgendaVisita A, TBL_EnsayoTipo T, TBL_Laboratorista L, TBL_FormSSDetalle D, TBL_Ensayo E
														WHERE
															A.id_cotizacion = '1' AND
															A.id_agendamiento_visita = S.id_agendamiento_visita AND
															S.id_tipo_ensayo = T.id_tipo_ensayo AND
															S.realizado_por = L.id_laboratorista AND
															S.id_form_solicitud_servicio = D.FormSS_Id
													";
													$SQL_Op = mysqli_query($link, $QRY_Op) or die ("Error en QRYOp".mysqli_query($link));;

													$i=1;
													while($DAT_Op = mysqli_fetch_assoc($SQL_Op)){
													?>
													<tr>
													  <td><?php echo $i;?></td>
														<td>
															<a style="width:100px; text-align: center;" target="_blank" href="form_solicitud_servicio_det.php?id=<?php echo $DAT_Op['ID_SS']?>" class="btn btn-default btn-xs">
																<?php echo $DAT_Op['ID_SS']?>
															</a>
														</td>
														<td><?php echo $DAT_Op['ENSAYO']?></td>
														<td><?php echo $DAT_Op['LABORATORISTA']?></td>
														<td><?php echo $DAT_Op['FECHA_OP']?></td>
														<td style="text-align: center;">
															<a style="width:50px; text-align: center;" target="_blank" href="#form_solicitud_servicio.php?id=<?php echo $DAT_Op['ID_SS']?>" class="btn btn-default btn-xs">
																<i class="fa fa-file-pdf-o"></i>
															</a>
														</td>
													</tr>
													<?php
													$i++;
													}
													?>
													</tbody>
												</table>
											</div>
											<!-- //////////////////////////// LABORATORIO  ////////////////////////////-->

											<div role="tabpanel" class="tab-pane fade" id="laboratorio" aria-labelledby="profile-tab">
												<table class="data table table-striped no-margin">
													<thead>
														<tr>
															<th>#</th>
															<th>N° Correlativo</th>
															<th>N° Folio</th>
															<th>N° Informe</th>
															<th>Tipo de Servicio</th>
															<th>Fecha Operaci&oacute;n</th>
															<th>Estado</th>
															<th>Descargar</th>
														</tr>
													</thead>
													<tbody>
														<?php
														for($k=1;$k<=5;$k++){ ?>
														<tr>
															<td><?php echo $k;?></td>
															<td>
																<a style="width:100px; text-align: center;" target="_blank" href="#" class="btn btn-default btn-xs">
																	5664
																</a>
															</td>
															<td>
																<a style="width:100px; text-align: center;" target="_blank" href="#" class="btn btn-default btn-xs">
																	3576
																</a>
															</td>
															<td>
																<a style="width:100px; text-align: center;" target="_blank" href="#" class="btn btn-default btn-xs">
																	7298
																</a>
															</td>
															<td>Hormig&oacute;n</td>
															<td>20-02-2018</td>
															<!--
															Estado de ENSAYOS DE MUESTRAS (SALA):
															Solicitado
															No solicitado
															Ensayado

															Estado de ENSAYOS DE MUESTRAS (OFICINA TECNICA)
															Ingresado
															Ensayado
															-->
															<td>
																<button type="button" class="btn btn-info btn-xs">Ensayado</button>
															</td>

															<td style="text-align: center;">
																<a style="width:50px; text-align: center;" target="_blank" href="#" class="btn btn-default btn-xs">
																	<i class="fa fa-file-pdf-o"></i>
																</a>
															</td>
														</tr>
														<?php
														}
														?>
													</tbody>
												</table>
											</div>

											<!-- //////////////////////////// FINANZAS  ////////////////////////////-->
											<div role="tabpanel" class="tab-pane fade" id="finanzas" aria-labelledby="profile-tab">
												<table class="data table table-striped no-margin" >
													<thead>
														<tr>
															<th>#</th>
															<th>N° Factura</th>
															<th>Monto</th>
															<th>Fecha Emisi&oacute;n</th>
															<th>Estado</th>
															<th>Descargar</th>
														</tr>
													</thead>
													<tbody>
														<?php
														for($k=1;$k<=5;$k++){
														?>
														<tr>
															<td><?php echo $k;?></td>
															<td>
																<a style="width:100px; text-align: center;" target="_blank" href="#" class="btn btn-default btn-xs">
																	2347
																</a>
															</td>
															<td>$ 713.241</td>
															<td>20-02-2018</td>
															<!--
															Estados Facturacion:
															 Pendiente, Pagado, Factue
															-->
															<td>
																<button type="button" class="btn btn-info btn-xs">Pendiente</button>
															</td>

															<td style="text-align: center;">
																<a style="width:50px; text-align: center;" target="_blank" href="#" class="btn btn-default btn-xs">
																	<i class="fa fa-file-pdf-o"></i>
																</a>
															</td>
														</tr>
														<?php
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
                  </div>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
	                    <h2>Actividades</h2>
											<ul class="messages">
	                    	<?php
	                      $query_tbl_historial_cotizacion = "
	                      SELECT
	                      	h.detalle_historial_cotizacion as DETALLE,
	                          YEAR(h.fecha_historial_cotizacion) AS ANO,
	                          MONTH(h.fecha_historial_cotizacion) AS MES,
	                          DAY(h.fecha_historial_cotizacion) AS DIA,
	                          TIME(h.fecha_historial_cotizacion) AS HORA,
	                          u.nombre_usuario AS NOMBRE,
	                          u.apellido_paterno AS APELLIDO
	                      FROM
	                      	TBL_CotizacionGestion h, TBL_Cotizacion c, TBL_Usuario u
	                      WHERE
	                      		h.id_cotizacion = '".$_GET['id']."' AND
	                          h.id_cotizacion = c.id_cotizacion AND
	                          h.id_usuario = u.id_usuario
	                      ORDER BY
	                          h.fecha_historial_cotizacion DESC
	                      ";
	                      $select_tbl_historial_cotizacion = mysqli_query($link, $query_tbl_historial_cotizacion) or die ("Errores en historia: ".mysqli_error($link));
												if(mysqli_num_rows($select_tbl_historial_cotizacion)<=0){?>
													<div class="alert alert-info alert-dismissible fade in" role="alert">
				                    </button>
				                    <strong>Ups!</strong> No existen actividades registradas para este proyecto.
				                  </div>
													<?php
												}
												else{
		                      function nombremes($mes){
		                        setlocale(LC_TIME, 'spanish');
		                        $nombre_mes=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
		                        return $nombre_mes;
		                      }
		                      while ($result = mysqli_fetch_assoc($select_tbl_historial_cotizacion)) {
		                        $mes=nombremes($result['MES']);?>
		                        <li>
		                          <img src="images/img.jpg" class="avatar" alt="Avatar">
		                          <div class="message_date">
		                            <h3 class="date text-info">
		                              <?php
		                              echo $result['DIA'];
		                              ?>
		                            </h3>
		                            <p class="month" style="text-align:right;">
		                              <?php
		                              echo ucwords(strtolower($mes))." ".$result['ANO'];
		                              ?>
		                              </br>
		                              <?php echo $result['HORA']?>
		                            </p>
		                          </div>
		                          <div class="message_wrapper">
		                            <strong><h5 class="heading"><?php echo $result['NOMBRE'];?> <?php echo $result['APELLIDO'];?></h5></strong>
		                            <blockquote class="message">
		                              <?php echo $result['DETALLE'];?>
		                            </blockquote>
		                            <br />
		                          </div>
		                        </li>
		                      <?php
		                      }
												}
	                      ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<form method="get" action="comercial_registro_actividad.php">
								<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
									<div class="modal-dialog modal-md">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
												<h4 class="modal-title" id="myModalLabel">Agregar actividad</h4>
											</div>
											<div class="modal-body">
												<textarea name="detalle_actividad_cotizacion" id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="El texto es demasiado corto..." data-parsley-validation-threshold="10"></textarea>
												<input type="hidden" name="id_cotizacion" value="<?php echo $_GET['id'];?>">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
												<button type="submit" class="btn btn-success">Guardar</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php

			include 'footer.php';

		?>


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
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>  </body>
</html>
