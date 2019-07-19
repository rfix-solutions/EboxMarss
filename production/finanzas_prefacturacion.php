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
//include '_qry/indicadores_economicos.php';



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
	 	<!-- Datatables -->
	 	<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	 	<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet">

	 	<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	 	<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	 	<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	 	<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	</head>
	<body class="nav-md ">
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
        <!-- page content -->
        <div class="right_col" role="main">
					<div class="page-title">
            <div class="title_left">
              <h3>Prefacturaci&oacute;n</h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
									<form name="facturables" id="form_facturables" method="get" action="finanzas_prefacturacion_detalle.php">
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#PDF" ><i class="fa fa-file-pdf-o"></i> PDF</button>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#XLS" ><i class="fa fa-file-excel-o"></i> XLS</button>
									<button type="button" class="btn btn-success btn-xs" onclick="prefacturar();" ><i class="fa fa-file-text-o"></i> Prefacturar</button>
<!--
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#UF"><i class="fa fa-usd"></i> $UF</button>
-->

									<div class="modal fade" id="PDF" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
													<h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n de Aceptaci&oacute;n</h4>
												</div>
												<div class="modal-body" style="text-align:center;">
													<h4>Exportando a PDF...</h4>
													<p>¿Desea Continuar?</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<a type="button" target="_blank" href="export/finanzas_prefacturacion_pdf.php" class="btn btn-success">Aceptar</a>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade" id="XLS" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
													<h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n de Aceptaci&oacute;n</h4>
												</div>
												<div class="modal-body" style="text-align:center;">
													<h4>Exportando a EXCEL...</h4>
													<p>¿Desea Continuar?</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="button" class="btn btn-success" onclick="#">Aceptar</button>
												</div>
											</div>
										</div>
									</div>


									<div class="modal fade" id="UF" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
													<h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n de Aceptaci&oacute;n</h4>
												</div>
												<div class="modal-body" style="text-align:center;">
													<h4>Ingrese el valor de la UF</h4>
													<p><input type="text" name="uf" value="<?php echo $_SESSION['currency'];?>" minvalue="1"></p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="submit" onclick="#" class="btn btn-success">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade" id="ERROR" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
													<h4 class="modal-title" id="myModalLabel2">Alerta</h4>
												</div>
												<div class="modal-body" style="text-align:center;">
													<h4>Debe seleccionar un item para prefacturar. Intente nuevamente</h4>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-success" data-dismiss="modal">Aceptar</button>
												</div>
											</div>
										</div>
									</div>
									<script>
									function toggle(source) {
										checkboxes = document.getElementsByName('SOLICITUD[]');

										for(var i=0, n=checkboxes.length;i<n;i++) {
											checkboxes[i].checked = source.checked;
										}

									}
									</script>

										<table id="facturables" class="table table-striped table-bordered" >
											<thead>
												<th><input type="checkbox" onClick="toggle(this)" /></th>
												<th>N° Solicitud</th>
												<th>Fecha</th>
												<th>Cliente</th>
												<th>Proyecto</th>
												<th>Servicio</th>
												<th>Solicitante</th>
												<th>Total Neto</th>
											</tr>
										</thead>
										<tbody>

										<?php
										$QRY_Facturables ="
											SELECT
												HM.numero_solicitud AS N_SOLICITUD,
												DATE_FORMAT(HM.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
												A.razon_social AS CLIENTE,
												A.nombre_proyecto AS PROYECTO,
												T.nombre_tipo_ensayo AS SERVICIO,
												AC.empresa_solicitante AS SOLICITANTE,
												A.id_agendamiento_visita AS ID,
												HM.id_form_c_h_m AS ID_SOLICITUD,
												E.nombre_ensayo AS ENSAYO,
												E.precio AS PRECIO,
												'HM' AS TABLA
											FROM
												TBL_FormHM HM, TBL_AgendaVisita A, TBL_EnsayoTipo T, TBL_FormAC AC, TBL_Ensayo E
											WHERE
												HM.id_agendamiento_visita = A.id_agendamiento_visita AND
												HM.id_tipo_ensayo = E.id_ensayo AND
												E.id_tipo_ensayo = T.id_tipo_ensayo AND
												A.id_form_aceptacion = AC.id_form_aceptacion AND
												HM.prefactura_estado = '0'
											GROUP BY
												HM.numero_solicitud

											UNION

											SELECT
												SS.numero_solicitud AS N_SOLICITUD,
												DATE_FORMAT(SS.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
												A.razon_social AS CLIENTE,
												A.nombre_proyecto AS PROYECTO,
												T.nombre_tipo_ensayo AS SERVICIO,
												AC.empresa_solicitante AS SOLICITANTE,
												A.id_agendamiento_visita AS ID,
												SS.id_form_solicitud_servicio AS ID_SOLICITUD,
												E.nombre_ensayo AS ENSAYO,
												E.precio AS PRECIO,
												'SS' AS TABLA
											FROM
												TBL_FormSS SS, TBL_AgendaVisita A, TBL_EnsayoTipo T, TBL_FormAC AC, TBL_Ensayo E, TBL_FormSSDetalle D
											WHERE
												SS.id_agendamiento_visita = A.id_agendamiento_visita AND
												SS.id_form_solicitud_servicio = D.FormSS_Id AND
												D.Ensayo_IdEnsayo = E.id_ensayo AND
												SS.id_agendamiento_visita = A.id_agendamiento_visita AND
												E.id_tipo_ensayo = T.id_tipo_ensayo AND
												A.id_form_aceptacion = AC.id_form_aceptacion AND
												SS.prefactura_estado = '0'
											GROUP BY
												SS.numero_solicitud
											";


											$SQL_Facturables = mysqli_query($link, $QRY_Facturables) or die ("Error en QRY Union:".mysqli_error());;
											while($facturables = mysqli_fetch_assoc($SQL_Facturables)){
												switch ($facturables['TABLA']) {
													case 'HM':
														$form = "operaciones_FormHMdet";
														$QryPrecioHM = "
															SELECT
															HM.numero_solicitud AS N_SOLICITUD,
															T.nombre_tipo_ensayo AS SERVICIO,
															E.nombre_ensayo AS ENSAYO,
															E.precio AS PRECIO,
															(SELECT COUNT(HM.numero_solicitud)) AS CANTIDAD
															FROM
															TBL_FormHM HM, TBL_EnsayoTipo T, TBL_Ensayo E
															WHERE
															HM.numero_solicitud = '".$facturables['N_SOLICITUD']."' AND
															HM.id_tipo_ensayo = E.id_ensayo AND
															E.id_tipo_ensayo = T.id_tipo_ensayo
														";
														$SqlPrecio = mysqli_query($link, $QryPrecioHM) or die ("Error en Qry PrecioHM");;
													break;

													case 'SS':
														$form = "operaciones_FormSSdet";
														$QryPrecioSS = "
															SELECT
															SS.numero_solicitud AS N_SOLICITUD,
															T.nombre_tipo_ensayo AS SERVICIO,
															E.nombre_ensayo AS ENSAYO,
															E.precio AS PRECIO,
															(SELECT COUNT(SS.numero_solicitud)) AS CANTIDAD
															FROM
															TBL_FormSS SS, TBL_EnsayoTipo T, TBL_Ensayo E
															WHERE
															SS.numero_solicitud = '".$facturables['N_SOLICITUD']."' AND
															SS.id_tipo_ensayo = E.id_ensayo AND
															E.id_tipo_ensayo = T.id_tipo_ensayo
														";
														$SqlPrecio = mysqli_query($link, $QryPrecioSS) or die ("Error en Qry PrecioSS");;
													break;

													default:
														$form = "#";
													break;
												}
												?>

												<tr>
													<td>
						 								<input type="checkbox" name="SOLICITUD[]" value="<?php echo $facturables['N_SOLICITUD'];?>"  >
													</td>
													<td style="text-align: center">
														<a target="_blank" type="button" href="<?php echo $form; ?>.php?id=<?php echo $facturables['ID'];?>&folio=<?php echo $facturables['N_SOLICITUD'];?>" class="btn btn-default btn-xs"><?php echo $facturables['N_SOLICITUD'];?></a>
													</td>
													<td><?php echo $facturables['FECHA_SOLICITUD'];?></td>
													<td><?php $Cliente = utf8_encode($facturables['CLIENTE']); echo ucwords(utf8_decode($Cliente));?></td>
													<td><?php $Proyecto = utf8_encode($facturables['PROYECTO']); echo ucwords(utf8_decode($Proyecto));?></td>
													<td><?php $Servicio = utf8_encode($facturables['SERVICIO']); echo ucwords(utf8_decode($Servicio));?></td>
													<td><?php $Solicitante = utf8_encode(strtolower($facturables['SOLICITANTE'])); echo ucwords(utf8_decode($Solicitante));?></td>

													<?php
													while($Rows=mysqli_fetch_assoc($SqlPrecio)){
															$TotalNetoUF = 0;
															$TotalNetoCLP = 0;

															$TotalUnitUF = $Rows['PRECIO']*$Rows['CANTIDAD'];
															$TotalNetoUF = $TotalNetoUF + $TotalUnitUF;

															$TotalUnitCLP = $_SESSION['currency']*($Rows['PRECIO']*$Rows['CANTIDAD']);
															$TotalNetoCLP = $TotalNetoCLP + $TotalUnitCLP;
													}

													?>

													<td style="text-align: right;">$ <?php echo number_format($TotalNetoCLP, 0, ',', '.');?></td>
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
      <?php
			include 'footer.php';
      ?>
		</div>
	</div>

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
	<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
	<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
	<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
	<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>
	<script>

		function prefacturar(){
			var campo = document.getElementsByName('SOLICITUD[]');
			var isValid = "0";
			var i;
			for (i = 0; i < campo.length; i ++) {
				if (campo[i].checked) {
					isValid = "1";
				}
			}
			if(isValid==0){
					$('#ERROR').modal('toggle')
			}
			else{
				$('#UF').modal('toggle')
			}
		}

		function enviar(){document.getElementById("form_facturables").submit();}

		$('#facturables').dataTable( {
			lengthMenu: [[10, 20, 25, 50, -1], [10, 20, 25, 50, "Todos"]],
	    paging: true,
	    searching: true
		} );
		</script>
  </body>
</html>
