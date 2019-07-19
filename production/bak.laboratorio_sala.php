<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
}
else
{?>
	<script type="text/javascript">
		alert("Esta pagina es solo para usuarios registrados.")
		location.href="https://www.ebox.cl/login/index.php?url=<?php echo $_SERVER["PHP_SELF"];?>";
	</script>
<?php
		exit;
}
include '_qry/db_connect_local.php';


$sql_tab1 = "
	SELECT
		s.id_form_solicitud_servicio AS ID_SOLICITUD,
		DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
		e.nombre_tipo_ensayo AS TIPO_ENSAYO,
		s.numero_solicitud AS N_SOLICITUD,
		s.material1 AS MATERIAL,
		s.procedencia1 AS PROCEDENCIA,
		s.ubicacion1 AS UBICACION,
		a.razon_social AS CLIENTE,
		a.nombre_proyecto AS PROYECTO
	FROM
		TBL_FormSS s, TBL_AgendaVisita a, TBL_EnsayoTipo e
	WHERE
		(
			s.id_tipo_ensayo = '3' OR
			s.id_tipo_ensayo = '4' OR
			s.id_tipo_ensayo = '5' OR
			s.id_tipo_ensayo = '7' OR
			s.id_tipo_ensayo = '8'
		) AND
		s.id_agendamiento_visita = a.id_agendamiento_visita AND
		s.id_tipo_ensayo = e.id_tipo_ensayo
";


$sql_tab2 = "
	SELECT
		s.id_form_c_h_m AS ID_SOLICITUD,
		DATE_FORMAT(s.fecha_muestra, '%Y-%m-%d') AS FECHA_SOLICITUD,
		s.numero_solicitud AS N_SOLICITUD,
		a.razon_social AS CLIENTE,
		a.nombre_proyecto AS PROYECTO,
		e.nombre_tipo_ensayo AS TIPO_ENSAYO,
		s.edad AS EDAD,
		s.resistencia_especifica AS RESISTENCIA_ESPECIFICA
	FROM tbl_form_c_h_m s,
		tbl_agendamiento_visita a,
		tbl_tipo_ensayo e
WHERE
	(s.id_tipo_ensayo = '1' OR s.id_tipo_ensayo = '6') AND
	s.id_agendamiento_visita = a.id_agendamiento_visita AND
	s.id_tipo_ensayo = e.id_tipo_ensayo
";

$sql_tab3 = "
	SELECT
		s.id_form_solicitud_servicio AS ID_SOLICITUD,
		DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
		s.id_agendamiento_visita AS ID_AGENDAMIENTO,
		e.nombre_tipo_ensayo AS TIPO_ENSAYO,
		s.numero_solicitud AS N_SOLICITUD,
		s.material1 AS MATERIAL,
		s.procedencia1 AS PROCEDENCIA,
		s.ubicacion1 AS UBICACION,
		a.razon_social AS CLIENTE,
		a.nombre_proyecto AS PROYECTO
	FROM
		tbl_form_solicitud_servicio s, tbl_agendamiento_visita a, tbl_tipo_ensayo e
	WHERE
		s.id_tipo_ensayo = '2' AND
		s.id_agendamiento_visita = a.id_agendamiento_visita AND
		s.id_tipo_ensayo = e.id_tipo_ensayo
";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>.: EBOX PLATFORM - LOGIN :. </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Datatables -->
    		<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    		<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    		<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    		<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    		<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
						<?php
					  include 'menu_sidebar.php';
						include 'menu_footer.php';
						?>
          </div>
				</div>
				<?php
       	include 'menu_top.php';
        ?>
        <div class="right_col" role="main">
					<div class="page-title">
          	<div class="title_left">
            	<h3>Bit&aacute;cora de Ensayos</h3>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
              	<div class="x_content">
									<div class="" role="tabpanel" data-example-id="togglable-tabs">
                  	<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    	<li role="presentation" class="active"><a href="#tab_content1" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">SUELOS</a></li>
                      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">HORMIGÓN - ELEMENTOS</a></li>
											<li role="presentation" class=""><a href="#tab_content3" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">ASF-DOS-ARIDOS-AGUAS</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
											<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
													<!-- SUELOS -->
												<table id="suelos" class="table table-striped table-bordered">
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Material</th>
															<th>Procedencia</th>
															<th>Ubicación</th>
															<th>Ciudad</th>
															<th>Fecha Entrega</th>
															<th>Editar</th>
															<th>GR</br>2"</th>
															<th>GR</br>N° 4</th>
															<th>GR</br>N° 10</th>
															<th>GR</br>N° 200</th>
															<th>LIM</br>IP</th>
															<th>CLA</br>USCS</th>
															<th>PM</br>DMCS</th>
															<th>PM</br>% OPT</th>
															<th>CBR AL 95%</th>
															<th>DR</br>DMAX</th>
															<th>DR</br>DMIN</th>
															<th>DLA</th>
															<th>CUB</th>
															<th>DPS</th>
															<th>EA</th>
															<th>CH</th>
															<th>SS</th>
															<th>CS</th>
															<th>IO</th>
															<th>DES</th>
															<th>DREAL</th>
															<th>DA</th>
															<th>PE</th>
															<th>DE</th>
														</tr>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Material</th>
															<th>Procedencia</th>
															<th>Ubicación</th>
															<th>Ciudad</th>
															<th>Fecha Entrega</th>
															<th>Editar</th>
															<th>GR</br>2"</th>
															<th>GR</br>N° 4</th>
															<th>GR</br>N° 10</th>
															<th>GR</br>N° 200</th>
															<th>LIM</br>IP</th>
															<th>CLA</br>USCS</th>
															<th>PM</br>DMCS</th>
															<th>PM</br>% OPT</th>
															<th>CBR AL 95%</th>
															<th>DR</br>DMAX</th>
															<th>DR</br>DMIN</th>
															<th>DLA</th>
															<th>CUB</th>
															<th>DPS</th>
															<th>EA</th>
															<th>CH</th>
															<th>SS</th>
															<th>CS</th>
															<th>IO</th>
															<th>DES</th>
															<th>DREAL</th>
															<th>DA</th>
															<th>PE</th>
															<th>DE</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$query_tab3 = mysqli_query($link, $sql_tab3);
														$i=1;
														$hoy = date("Y-m-d");
														while ($datos_tab3 = mysqli_fetch_assoc($query_tab3)) {
														?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo $datos_tab3['FECHA_SOLICITUD'];?></td>
															<td style="text-align: center;" >
																<a type="button" href="form_solicitud_servicio.php?id=<?php echo $datos_tab3['ID_AGENDAMIENTO'];?>" class="btn btn-default btn-xs"><?php echo $datos_tab3['N_SOLICITUD'];?></a>
															</td>
															<td><?php echo $datos_tab3['CLIENTE'];?></td>
															<td><?php echo $datos_tab3['PROYECTO'];?></td>
															<td><?php echo $datos_tab3['MATERIAL'];?></td>
															<td><?php echo $datos_tab3['PROCEDENCIA'];?></td>
															<td><?php echo $datos_tab3['UBICACION'];?></td>
															<td>Ciudad</td>
															<td><?php echo $datos_tab3['FECHA_SOLICITUD'];?></td>
															<td><button type="button" data-toggle="modal" data-target="#modal_suelos" class="btn btn-success btn-xs">OK</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
															<td><button type="button" class="btn btn-warning btn-xs">------</button></td>
														</tr>
														<?php
														$i++;
														}
														?>
													</tbody>
												</table>
                      </div>
                      <div role="tabpanel" class="tab-pane fade active out" id="tab_content2" aria-labelledby="profile-tab">
												<!-- HORMIGÓN - ELEMENTOS -->
												<table id="hormigon" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
													<thead>
				                       <tr>
				                         <th>#</th>
				                         <th>Fecha Ensayo</th>
				                         <th>SS N°</th>
				                         <th>Cliente</th>
				                         <th>Proyecto</th>
				                         <th>Tipo de Ensayo</th>
				                         <th>Fecha Muestra</th>
				                         <th>Edad</th>
																 <th>Resistencia Especificada</th>
				                         <th>Resistencia Ensayo</th>
																 <th>Opcion</th>
															 </tr>
															 <tr>
				                       <th>#</th>
				                       	<th>Fecha Ensayo</th>
				                        <th>SS N°</th>
				                        <th>Cliente</th>
				                        <th>Proyecto</th>
				                        <th>Tipo de Ensayo</th>
				                        <th>Fecha Muestra</th>
				                        <th>Edad</th>
																<th>Resistencia Especificada</th>
				                        <th>Resistencia Ensayo</th>
																<th>Opcion</th>
															</tr>
														</thead>
				                   <tbody>
													<?php
													$query_tab2 = mysqli_query($link, $sql_tab2);
													$i=1;
													$hoy = date("Y-m-d");
													while ($datos_tab2 = mysqli_fetch_assoc($query_tab2)) {
													?>
														<tr>
				                   		<td><?php echo $i; ?></td>
				                       <td><?php echo $datos_tab2['FECHA_SOLICITUD'];?></td>
															<td style="text-align: center;" >
																<a type="button" onclick="#" class="btn btn-default btn-xs"><?php echo $datos_tab2['N_SOLICITUD'];?></a>
															</td>
				                       <td><?php echo $datos_tab2['CLIENTE'];?></td>
															<td><?php echo $datos_tab2['PROYECTO'];?></td>
				                       <td><?php echo $datos_tab2['TIPO_ENSAYO'];?></td>
				                       <td><?php echo $datos_tab2['FECHA_SOLICITUD'];?></td>
				                       <td><?php echo $datos_tab2['EDAD'];?></td>
				                       <td><?php echo $datos_tab2['RESISTENCIA_ESPECIFICA'];?></td>
															 <td></td>
															 <td style="text-align: center;" >
																<button type="button" name="id_solicitud" id="id_solicitud" onclick="asigna(this.value, <?php  echo $datos_tab2['TIPO_ENSAYO'];?>)" value="<?php echo $datos_tab2['ID_SOLICITUD'];?>"  data-toggle="modal" data-target="#modal-hormigon" class="btn btn-default btn-xs">Ingresar</button>
 															</td>
														</tr>
														<?php
														$i++;
														}
														?>
													</tbody>
												</table>
											</div>

											<div role="tabpanel" class="tab-pane fade active out" id="tab_content3" aria-labelledby="profile-tab2">
												<!-- ASF-DOS-ARIDOS-AGUAS -->
												<table id="aridos" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Material</th>
															<th>Procedencia</th>
															<th>Ubicacion</th>
															<th>Fecha Entrega</th>
															<th>ASFALTO</BR>GR Y CONT ASF</th>
															<th>ASFALTO</BR>ESPESOR</th>
															<th>ASFALTO</BR>DREAL</th>
															<th>ASFALTO</BR>CONT ASF (T)</th>
															<th>DOSIFICACION</BR>HORMIGÓN</th>
															<th>DOSIFICACION</BR>MORTERO</th>
															<th>DOSIFICACION</BR>SUELO CEMENTO</th>
															<th>DOSIFICACION</BR>SUELOS</th>
															<th>&Aacute;ridos</th>
															<th>Aguas</th>
														</tr>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Material</th>
															<th>Procedencia</th>
															<th>Ubicacion</th>
															<th>Fecha Entrega</th>
															<th>ASFALTO</BR>GR Y CONT ASF</th>
															<th>ASFALTO</BR>ESPESOR</th>
															<th>ASFALTO</BR>DREAL</th>
															<th>ASFALTO</BR>CONT ASF (T)</th>
															<th>DOSIFICACION</BR>HORMIGÓN</th>
															<th>DOSIFICACION</BR>MORTERO</th>
															<th>DOSIFICACION</BR>SUELO CEMENTO</th>
															<th>DOSIFICACION</BR>SUELOS</th>
															<th>&Aacute;ridos</th>
															<th>Aguas</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$query_tab1 = mysqli_query($link, $sql_tab1);
														$i=1;
														$hoy = date("Y-m-d");
														while($datos_tab1 = mysqli_fetch_assoc($query_tab1)){?>
															<tr>
																<td><?php echo $i; ?></td>
																<td><?php echo $datos_tab1['FECHA_SOLICITUD'];?></td>
																<td style="text-align: center;" >
																	<a type="button" onclick="#" class="btn btn-default btn-xs"><?php echo $datos_tab1['N_SOLICITUD'];?></a>
																</td>
																<td><?php echo $datos_tab1['CLIENTE'];?></td>
																<td><?php echo $datos_tab1['PROYECTO'];?></td>
																<td><?php echo $datos_tab1['MATERIAL'];?></td>
																<td><?php echo $datos_tab1['PROCEDENCIA'];?></td>
																<td><?php echo $datos_tab1['UBICACION'];?></td>
																<td>Fecha Entrega</td>
																<td><button type="button" data-toggle="modal" data-target="#granulometria" class="btn btn-success btn-xs">OK</button></td>
																<td><button type="button" data-toggle="modal" data-target="#espesor_asfalto" class="btn btn-success btn-xs">OK</button></td>
																<td><button type="button" data-toggle="modal" data-target="#densidad_real" class="btn btn-success btn-xs">OK</button></td>
																<td><button type="button" data-toggle="modal" data-target="#cont_asf" class="btn btn-success btn-xs">OK</button></td>
																<td><button type="button" data-toggle="modal" data-target="#fecha_hormigon" class="btn btn-success btn-xs">OK</button></td>
																<td><button type="button" data-toggle="modal" data-target="#fecha_mortero" class="btn btn-success btn-xs">OK</button></td>
																<td><button type="button" data-toggle="modal" data-target="#fecha_suelo_cemento" class="btn btn-success btn-xs">OK</button></td>
																<td><button type="button" data-toggle="modal" data-target="#fecha_suelos" class="btn btn-success btn-xs">OK</button></td>
																<td><button type="button" data-toggle="modal" data-target="#fecha_aridos" class="btn btn-success btn-xs">OK</button></td>
																<td><button type="button" data-toggle="modal" data-target="#fecha_aguas" class="btn btn-success btn-xs">22/08/2018</button></td>
															</tr>
															<?php
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>

				</div>
				<?php
				include 'footer.php';
        ?>
				</div>
			</div>










<!-- =============================== &&&&& MODALS &&&&&  =============================== -->

							<!-- =============================== HORMIGON - ELEMENTOS  =============================== -->
													<div class="modal fade bs-example-modal-lg" id="modal-hormigon" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="modal-titulo_hormigon">Testigos Hormigón</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/hormigon/ensayo_hormigon.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>



<!-- =============================== &&&&& MODALS &&&&&  =============================== -->















													<div class="modal fade bs-example-modal-lg" id="granulometria" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
																	<h4 class="modal-title" id="titulo_granulometria">Granulometria</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/ensayo_granulometria.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="submit" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>


													<div class="modal fade bs-example-modal-lg" id="espesor_asfalto" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="titulo_espesor">Espesor Asfalto</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/ensayo_espesor_asfalto.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>

													<div class="modal fade bs-example-modal-lg" id="densidad_real" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="titulo_densidad_real">Densidad Real</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/ensayo_densidad_real.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>

													<div class="modal fade bs-example-modal-lg" id="cont_asf" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="titulo_densidad_real">CONT ASF</h4>
																</div>
																<div class="modal-body">
																	CONT ASF Pendiente. (En Desarrollo)
																	<?php
																	// include("laboratorio-ensayos/ensayo_densidad_real.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>

													<div class="modal fade bs-example-modal-sm" id="fecha_hormigon" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-sm">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="titulo_fecha_hormigon">Dosificación Hormigón</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/ensayo_fecha_hormigon.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>

													<div class="modal fade bs-example-modal-sm" id="fecha_mortero" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-sm">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="titulo_fecha_mortero">Dosificación Mortero</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/ensayo_fecha_mortero.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>

													<div class="modal fade bs-example-modal-sm" id="fecha_suelo_cemento" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-sm">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="titulo_fecha_suelo_cemento">Dosificación Suelo-Cemento</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/ensayo_fecha_suelo_cemento.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>

													<div class="modal fade bs-example-modal-sm" id="fecha_suelos" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-sm">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="titulo_fecha_suelos">Dosificación Suelos</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/ensayo_fecha_suelos.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>

													<div class="modal fade bs-example-modal-md" id="fecha_aridos" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-md">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="titulo_fecha_aridos">Aridos</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/ensayo_fecha_aridos.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>

													<div class="modal fade bs-example-modal-md" id="fecha_aguas" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-md">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="titulo_fecha_aguas">Aguas</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/ensayo_fecha_aguas.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>


		<!-- ///////////////////////////////////////////////////// SUELOS ///////////////////////////////////////////////////// -->
													<div class="modal fade bs-example-modal-lg" id="modal_suelos" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-lg">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="modal_titulo_suelos">Aguas</h4>
																</div>
																<div class="modal-body">
																	<?php
																	include("laboratorio-ensayos/suelos/ensayo_suelos.php");
																	?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														</div>
													</div>

		<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->
		<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->
		<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->
		<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->
													<div class="modal fade bs-example-modal-sm" id="MODAL_CONFIRMAR" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-sm">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
																	</button>
																	<h4 class="modal-title" id="MODAL_TITULO_CONFIRMAR">Confirmación</h4>
																</div>
																<div class="modal-body">
																	¿Esta seguro de continuar?
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="button" id="confirmar" value="" class="btn btn-success" onclick="envia_form(this.value)">Aceptar</button>
																</div>
															</div>
														</div>
													</div>
<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->


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
     <!-- Datatables -->

     <!--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		 <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>-->
		 <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>

     <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
     <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
     <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
     <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
     <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
     <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
     <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
     <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
     <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
     <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
     <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
     <script src="../vendors/jszip/dist/jszip.min.js"></script>
     <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
     <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

     <!-- Custom Theme Scripts -->
     <script src="../build/js/custom.min.js"></script>

		 <script>

		 function asigna(valor, tipo){
			 document.getElementById("id_form").value = valor;
			 document.getElementById("connfirmar").value = tipo;

		 }
		 function envia_form(tipo){
			 if(tipo>=0)
			 	alert("Tipo: "+tipo);
		 }

			 $('#suelos').DataTable( {
			 "bordered": true,
			 "ordering": false,
			 "responsive": false,
			 	initComplete: function () {
			 			this.api().columns().every( function () {
			 					var column = this;
			 					var select = $('<select><option value=""></option></select>')
			 							.appendTo( $(column.header()).empty() )
			 							.on( 'change', function () {
			 									var val = $.fn.dataTable.util.escapeRegex(
			 											$(this).val()
			 									);

			 									column
			 											.search( val ? '^'+val+'$' : '', true, false )
			 											.draw();
			 							} );

			 					column.data().unique().sort().each( function ( d, j ) {
			 							//select.append( '<option value="'+d+'">'+d+'</option>' )
										select.append( "<option value='"+d+"'>"+d+"</option>" )
			 					} );
			 			} );
			 	}
			 } );

			 $('#hormigon').DataTable( {
			 "bordered": true,
			 "ordering": false,
			 "responsive": false,
			 	initComplete: function () {
			 			this.api().columns().every( function () {
			 					var column = this;
			 					var select = $('<select><option value=""></option></select>')
			 							.appendTo( $(column.header()).empty() )
			 							.on( 'change', function () {
			 									var val = $.fn.dataTable.util.escapeRegex(
			 											$(this).val()
			 									);

			 									column
			 											.search( val ? '^'+val+'$' : '', true, false )
			 											.draw();
			 							} );

			 					column.data().unique().sort().each( function ( d, j ) {
			 							//select.append( '<option value="'+d+'">'+d+'</option>' )
										select.append( "<option value='"+d+"'>"+d+"</option>" )
			 					} );
			 			} );
			 	}
			 } );


			 $('#aridos').DataTable( {
			 "bordered": true,
			 "ordering": false,
			 "responsive": false,
			 	initComplete: function () {
			 			this.api().columns().every( function () {
			 					var column = this;
			 					var select = $('<select><option value=""></option></select>')
			 							.appendTo( $(column.header()).empty() )
			 							.on( 'change', function () {
			 									var val = $.fn.dataTable.util.escapeRegex(
			 											$(this).val()
			 									);

			 									column
			 											.search( val ? '^'+val+'$' : '', true, false )
			 											.draw();
			 							} );

			 					column.data().unique().sort().each( function ( d, j ) {
			 							//select.append( '<option value="'+d+'">'+d+'</option>' )
										select.append( "<option value='"+d+"'>"+d+"</option>" )
			 					} );
			 			} );
			 	}
			 } );

		 </script>


  </body>
</html>
