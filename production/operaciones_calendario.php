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



$query_laboratoristas = "
SELECT id_laboratorista as ID_LAB, nombre_laboratorista as NOMBRE_LAB
FROM TBL_Laboratorista
WHERE id_laboratorista != '15' AND LaboratoristaEstado = '1'
ORDER BY ID_LAB
";

$sql_laboratoristas = mysqli_query($link, $query_laboratoristas);

$sql_agendamientos = mysqli_query($link, "
SELECT
	AV.id_agendamiento_visita AS ID_AG,
	AV.id_laboratorista AS ID_LAB,
	AV.nombre_proyecto AS PROYECTO,
	AV.razon_social AS CLIENTE,
	AV.contacto_proyecto AS CONTACTO,
	AV.telefono_proyecto AS TELEFONO,
	AV.id_form_aceptacion AS ID_FA,
	AV.fecha_agendamiento AS FECHA_AGENDA,
	AV.hora_ini_agendamiento AS HINIAG,
	AV.hora_fin_agendamiento AS HFINAG,
	AV.rut_empresa AS RUT,
	L.nombre_laboratorista as LABORATORISTA
FROM
	TBL_AgendaVisita AV, TBL_Laboratorista L
WHERE
L.id_laboratorista = AV.id_laboratorista

");


$sql_total_laboratoristas = mysqli_query($link, "SELECT MAX(id_laboratorista) as MAYOR FROM TBL_Laboratorista")or die('Consulta laboratorista fallida: '.mysql_error());;

while($result = mysqli_fetch_assoc($sql_total_laboratoristas)){ $total_laboratoristas = $result['MAYOR']; }



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo $Title.$Company;?></title>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- Nuevo Calendario -->
	<link href="../calendario/scheduler.min.css" rel="stylesheet">

	<!-- FullCalendar -->
    <link href="../vendors/fullcalendar2/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendors/fullcalendar2/dist/fullcalendar.print.css" rel="stylesheet" media="print">

  	<!-- Datatables -->
	<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

	<!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

	  <style type="text/css">
	  #calendar {
    	width: 100%;
    	margin: 5px auto;
		  font-size: 12px;
  	}

	  </style>


  </head>

<body class="nav-md">
	<div class="container body">
  	<div class="main_container">
    	<div class="col-md-3 left_col">
      	<div class="left_col scroll-view">
        	<div class="navbar nav_title" style="border: 0;">
          	<a href="#" class="site_title">
					  	<p style="text-align:center;">
								<img src="images/logo_marss.png" alt="logo" />
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
      	<div class="">
        	<div class="page-title">
          	<div class="title_left">
            	<h3>Calendario Operaciones</h3>
            </div>
          </div>
  				<div class="clearfix"></div>
  					<div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
              	<div class="x_panel">
                	<div class="x_content">
										<a style="width:150px; text-align: center;" href="Javascript:history.back()" class="btn  btn-xs color bg-green	">Volver</a>
										<div class="col-md-12 col-sm-12 col-xs-12" id='calendar'></div>
                	</div>
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

<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

	<!-- ============================ MODAL LISTADO DE COTIZACIONES ACEPTADAS ============================ -->
	<div id="fullCalModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 id="modalTitle" class="modal-title"></h4>
				</div>
				<div id="modalBody" class="modal-body">
					<form action="operaciones_form_agendamiento.php" name="formulario_aceptadas" method="get">
						<div class="form-group">
							<div class="col-sm-6 col-md-6 col-xs-12">
								<label class="control-label">Laboratorista</label>
								<input type="text" class="form-control" name="laboratorista" readonly id="Modal_lab_nombre">
							</div>
							<div class="col-sm-2 col-md-2 col-xs-12">
								<label class="control-label">Fecha</label>
								<input type="text" class="form-control" name="fecha_" id="Modal_lab_fecha">
							</div>
							<div class="col-sm-2 col-md-2 col-xs-6">
								<label class="control-label">Hora Inicio</label>
								<input type="text" class="form-control" name="desde_" id="Modal_lab_inicio">
							</div>
							<div class="col-sm-2 col-md-2 col-xs-6 ">
								<label class="control-label">Hora Fin</label>
								<input type="text" class="form-control" name="hasta_" id="Modal_lab_fin">
							</div>
						</div>
						<div class="form-group" style="font-size:11px;">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="ln_solid"></div>
								<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%" cellspacing="0">
									<thead>
										<tr>
											<th>#</th>
											<th></th>
											<th># Cotizacion</th>
											<th>Cliente</th>
											<th>Proyecto</th>
											<th>Fecha Aceptaci&oacute;n</th>
										</tr>
									</thead>
									<tbody>
										<?php

										$sql = mysqli_query($link, "
										SELECT
											C.numero_cotizacion AS COTIZACION,
											AC.id_form_aceptacion AS ID,
											AC.empresa_solicitante AS CLIENTE,
											AC.nombre_obra AS PROYECTO,
											AC.fecha_aceptacion AS FECHA
										FROM
											TBL_FormAC AC,
											TBL_Cotizacion C
										WHERE
											AC.estado_formulario = 1 AND
											AC.id_cotizacion = C.id_cotizacion
										ORDER BY FECHA DESC
										") or die('Consulta fallida: '.mysql_error());;

										$i=1;
										while($row = mysqli_fetch_assoc($sql)){
										?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="radio" name="id" value="<?php echo $row['ID'];?>"></td>
												<td><?php echo $row['COTIZACION'];?></td>
												<td><?php echo $row['CLIENTE'];?></td>
												<td><?php echo $row['PROYECTO'];?></td>
												<td><?php echo $row['FECHA'];?></td>
											</tr>
											<?php
											$i++;
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group" style="text-align: right">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="ln_solid"></div>
									<input type="hidden" name="lab_id" id="Modal_lab_id" value="">
<!--									<input type="hidden" name="agenda_id" id="Modal_lab_id_ag" value="">-->
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#pendiente_formulario" >Pendiente Formulario</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
									<input type="hidden" name="opt" value="3">
									<input type="submit" class="btn btn-success" value="Continuar" >
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>



		<!-- ============================ MODAL PENDIENTE FORMULARIO ============================ -->
		<div class="modal fade" id="pendiente_formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<form action="operaciones_form_agendamiento.php" name="formulario_creadas" method="get">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Cotizaciones Enviadas</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<table id="sinformulario" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%" cellspacing="0">
								<thead>
									<tr>
										<th></th>
										<th>#</th>
										<th>Cotizacion</th>
										<th>Cliente</th>
										<th>Proyecto</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$query_cotizaciones = "
									SELECT c.id_cotizacion AS ID, c.numero_cotizacion AS COTIZACION, cl.razon_social AS CLIENTE, c.nombre_proyecto AS PROYECTO
									FROM TBL_Cotizacion c, TBL_Cliente cl
									WHERE c.id_estado_cotizacion = 2 AND c.id_cliente = cl.id_cliente
								";
								$sql_cotizaciones = mysqli_query($link, $query_cotizaciones);
								while($datos = mysqli_fetch_assoc($sql_cotizaciones)){
								?>
									<tr>
										<td><input type="radio" name="id" value="<?php echo $datos['ID'];?>"></td>
										<td><?php echo $datos['ID']?></td>
										<td><?php echo $datos['COTIZACION']?></td>
										<td><?php echo $datos['CLIENTE']?></td>
										<td><?php echo $datos['PROYECTO']?></td>
									</tr>
								<?php
								}
								?>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="opt" value="2">
							<input type="hidden" value="" name="hasta_">
							<input type="hidden" value="" name="desde_" >
							<input type="hidden" value="" name="fecha_" >
							<input type="hidden" value="" name="laboratorista">
							<input type="hidden" name="agenda_id" id="Modal_lab_id_ag" value="">

							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							<button type="button" onclick="sinformulario();" class="btn btn-success">Aceptar</button>
						</div>
					</div>
				</div>
			</form>
		</div>






		<!-- ============================ MODAL EDITAR AGENDA ============================ -->
		<div id="EditarAgenda" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 id="EditarTitle" class="modal-title"></h4>
					</div>
					<div id="EditarBody" class="modal-body">
						<div class="form-group" style="font-size:11px;">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<p>¿Desea editar el siguiente agendamiento?</p>
							</div>
						</div>
						<form action="operaciones_form_agendamiento.php" name="formulario_editadas" method="get">
							<div class="form-group">
								<div class="col-sm-4 col-md-6 col-xs-12">
									<label class="control-label">Proyecto</label>
									<input type="text" readonly class="form-control" name="proyecto" id="Editar_nombre_proyecto">
								</div>
								<div class="col-sm-4 col-md-6 col-xs-12">
									<label class="control-label">Cliente</label>
									<input type="text" readonly class="form-control" name="cliente" id="Editar_nombre_cliente">
								</div>
								<div class="col-sm-4 col-md-6 col-xs-12">
									<label class="control-label">Laboratorista</label>
									<input type="text" readonly class="form-control" name="laboratorista"  id="Editar_nombre_lab">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4 col-md-2 col-xs-12">
									<label class="control-label">Fecha</label>
									<input type="text" readonly class="form-control" name="fecha_" id="Editar_lab_fecha">
								</div>
								<div class="col-sm-4 col-md-2 col-xs-6">
									<label class="control-label">Hora Inicio</label>
									<input type="text" readonly class="form-control" name="desde_" id="Editar_lab_inicio">
								</div>
								<div class="col-sm-4 col-md-2 col-xs-6 ">
									<label class="control-label">Hora Fin</label>
									<input type="text" readonly class="form-control" name="hasta_" id="Editar_lab_fin">
								</div>
							</div>
							<div class="form-group" style="text-align: right">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="ln_solid"></div>
									<input type="hidden" name="lab_id" id="Editar_lab_id" value="">
									<input type="hidden" name="agenda_id" id="Editar_lab_id_ag" value="">
									<input type="hidden" name="opt" value="1">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
									<input type="submit" class="btn btn-success" value="Continuar" >
								</div>
							</div>
						</form>
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
		<script src="../vendors/moment/min/moment.min.js"></script>


	<!-- Datatables -->
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
    <script src="../build/js/custom.js"></script>
	<!-- bootstrap-daterangepicker -->
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap-datetimepicker -->
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

	<!-- FullCalendar -->
    <script src="../vendors/fullcalendar2/dist/fullcalendar.js"></script>
	<script src="../calendario/scheduler.min.js"></script>
	<script src="../calendario/locale-all.js"></script>


	<script type="text/javascript">

	function sinformulario(){
		if($("[name='id']:checked").val()!=undefined){
    //alert('seleccionado:' + $("[name='id']:checked").val());
		document.formulario_creadas.desde_.value = document.formulario_aceptadas.desde_.value;
		document.formulario_creadas.hasta_.value = document.formulario_aceptadas.hasta_.value;
		document.formulario_creadas.fecha_.value = document.formulario_aceptadas.fecha_.value;
		document.formulario_creadas.laboratorista.value = document.formulario_aceptadas.laboratorista.value;
		document.formulario_creadas.submit();
		}else{
		    alert('Selecciona una cotización para continuar.');
		}

	}

	$('#sinformulario').dataTable( {
		"pageLength": 10,
		"lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
		"searching": true,
		"responsive": true,
		"fixedHeader": true,
		"autoWidth": true,
		//"dom": '<"top"i>rt<"bottom"flp><"clear">',
		"search": {
			"smart": false
		 }
	} );

		$('#datatable').dataTable( {
			"pageLength": 5,
			"lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
			"searching": true,
			"responsive": true,
			"fixedHeader": true,
			"autoWidth": true,
			//"dom": '<"top"i>rt<"bottom"flp><"clear">',
			"search": {
				"smart": false
			 }
		} );

		$('#datatable tbody').on( 'click', 'tr', function () {
			$(this).toggleClass('selected');
		} );



		$('#formulario_agenda').on('submit', function(e){
			$('#myModal').modal('show');
			e.preventDefault();
		});

		function  init_calendar() {
			$(function() { // document ready
				var initialLocaleCode = 'es';


				$('#calendar').fullCalendar({
					schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
					locale: initialLocaleCode,
					defaultView: 'agendaDay',
					defaultDate: '<?php echo date('Y-m-d')?>',
					navLinks: true, // can click day/week names to navigate views
					businessHours: {
					  // days of week. an array of zero-based day of week integers (0=Sunday)
					  dow: [ 1, 2, 3, 4, 5 ], // Monday - Thursday

					  start: '08:00', // a start time (10am in this example)
					  end: '19:00', // an end time (6pm in this example)
					},
					nowIndicator: true,
					revert: true,
					weekends: true,
					timeFormat: 'HH:mm',
					slotDuration: '00:30:00',
					minTime: "07:00:00",
        	maxTime: "20:00:00",
					editable: true,
					selectable: true,
					selectHelper: true,
					eventLimit: true, // allow "more" link when too many events
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'agendaDay,agendaTwoDay,listDay,month'
					},
					views: {
						agendaDay: {
							buttonText: 'Dia'
						},
						agendaTwoDay: {
							type: 'agenda',
							duration: { days: 2 },
							groupByResource: true,
							buttonText: '2 Dias'
						},
						listDay: {
							buttonText: 'Lista'
						},
					},


					resources: [
						<?php
						while($result = mysqli_fetch_assoc($sql_laboratoristas)){
							if($result['ID_LAB']<$total_laboratoristas){ $coma = ","; } else { $coma =""; }

							echo "{ id: '".$result['ID_LAB']."', title: '".$result['NOMBRE_LAB']."', eventColor: 'green' }".$coma."";

						}
						?>
					],
					events: [
						<?php
						$i=1;
						while($filas_ag = mysqli_fetch_assoc($sql_agendamientos)){


							?>
							{
								id: '<?php echo $filas_ag['ID_AG']?>',
								resourceId: '<?php echo  $filas_ag['ID_LAB'];?>',
								start: '<?php echo $filas_ag['FECHA_AGENDA'];?>T<?php echo $filas_ag['HINIAG']?>',
								end: '<?php echo $filas_ag['FECHA_AGENDA'];?>T<?php echo $filas_ag['HFINAG']?>',
								cliente: '<?php echo $filas_ag['CLIENTE']?>',
								telefono: '<?php echo $filas_ag['TELEFONO']?>',
								contacto: '<?php echo $filas_ag['CONTACTO']?>',
								title: '(<?php echo $filas_ag['LABORATORISTA']?>) <?php echo $filas_ag['RUT']?> - <?php echo strtoupper($filas_ag['CLIENTE'])?>\n<?php echo strtoupper($filas_ag['PROYECTO'])?>\n<?php echo strtoupper($filas_ag['CONTACTO'])?> - <?php echo strtoupper($filas_ag['TELEFONO'])?>',
								laboratorista: '<?php echo $filas_ag['LABORATORISTA']?>',
								proyecto: '<?php echo strtoupper($filas_ag['PROYECTO'])?>'
							},
						<?php
							$i++;
						}
						?>
					],
					select: function(start, end, event, view, resource) {
						var f_inicio = start.format('YYYY-MM-DD');
						var h_inicio = start.format('HH:mm');
						var f_fin = end.format('YYYY-MM-DD');
						var h_fin = end.format('HH:mm');
						$('#modalTitle').html("Agendamiento de Visita");
						$('#Modal_lab_nombre').attr('value',resource.title);
						$('#Modal_lab_fecha').attr('value',f_inicio);
						$('#Modal_lab_inicio').attr('value',h_inicio);
						$('#Modal_lab_fin').attr('value',h_fin);
						$('#Modal_lab_id').attr('value',resource.id);
						//$('#Modal_lab_id_ag').attr('value',callEvent.id);
						$('#Modal_lab_null').attr('href','operaciones_form_agendamiento.php?id=0&lab_id='+resource.id+'&fecha_='+f_inicio+'&desde_='+h_inicio+'&hasta_='+h_fin);
						$('#fullCalModal').modal();
					},
					eventClick:  function(calEvent, jsEvent, view) {
						var f_inicio = calEvent.start.format('YYYY-MM-DD');
						var h_inicio = calEvent.start.format('HH:mm');
						var f_fin = calEvent.end.format('YYYY-MM-DD');
						var h_fin = calEvent.end.format('HH:mm');

						$('#EditarTitle').html("Editar Agendamiento");

						$('#Editar_nombre_proyecto').attr('value',calEvent.proyecto);
						$('#Editar_nombre_cliente').attr('value',calEvent.cliente);
						$('#Editar_nombre_lab').attr('value',calEvent.laboratorista);

						$('#Editar_lab_fecha').attr('value',f_inicio);
						$('#Editar_lab_inicio').attr('value',h_inicio);
						$('#Editar_lab_fin').attr('value',h_fin);
						$('#Editar_lab_id_ag').attr('value',calEvent.id);
						$('#Editar_lab_id').attr('value',calEvent.resourceId);
						$('#EditarAgenda').modal();
					},
					dragRevertDuration: 5000,
					dragScroll: false,
					eventDragStop: function(event, oldEvent, view, calEvent, resource) {
						var f_inicio = event.start.format('YYYY-MM-DD');
						var h_inicio = event.start.format('HH:mm');
						var f_fin = event.end.format('YYYY-MM-DD');
						var h_fin = event.end.format('HH:mm');

						$('#EditarTitle').html("Editar Agendamiento");

						$('#Editar_nombre_proyecto').attr('value',oldEvent.proyecto);
						$('#Editar_nombre_cliente').attr('value',oldEvent.cliente);
						$('#Editar_nombre_lab').attr('value',event.laboratorista);

						$('#Editar_lab_fecha').attr('value',f_inicio);
						$('#Editar_lab_inicio').attr('value',h_inicio);
						$('#Editar_lab_fin').attr('value',h_fin);
						$('#Editar_lab_id_ag').attr('value',oldEvent.id);
						$('#Editar_lab_id').attr('value',event.resourceId);
						$('#EditarAgenda').modal();
					},
					eventMouseover: function(calEvent, domEvent) {
						var layer =	"<div data-toggle='tooltip' data-placement='top' title='Hola' data-original-title='Tooltip top'></div>";
						$(this).append(layer);
					}
					/*
					dayClick:  function(start, end, event, view, resource, jsEvent) {
						$('#modalTitle').html(event.title);
						$('#modalBody').html(event.description);
						$('#laboratorista').attr('value',event.id);
						$('#fullCalModal').modal();
					}
					*/
				});
			});
		}



</script>

  </body>
</html>
