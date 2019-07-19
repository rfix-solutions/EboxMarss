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




$sql_tab1 = "
	SELECT
		s.id_form_solicitud_servicio AS ID_SOLICITUD,
		DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
		a.id_agendamiento_visita AS ID_AGENDAMIENTO,
		e.nombre_tipo_ensayo AS TIPO_ENSAYO,
		s.numero_solicitud AS N_SOLICITUD,
		s.material AS MATERIAL,
		s.procedencia AS PROCEDENCIA,
		s.ubicacion AS UBICACION,
		a.razon_social AS CLIENTE,
		a.nombre_proyecto AS PROYECTO
	FROM
		TBL_FormSS s, TBL_AgendaVisita a, TBL_EnsayoTipo e
	WHERE
		s.id_tipo_ensayo = '7' AND
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
            	<h3>Bit&aacute;cora de Ensayos - Dosificacion (Densidad)</h3>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_content">
									<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_sala_PDF.php?OP=DO"><i class="fa fa-file-pdf-o"></i> PDF</a>
									<table id="dosificacion" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Opcion</th>
												<th>Fecha Solicitud</th>
												<th>SS N°</th>
												<th>Cliente</th>
												<th>Proyecto</th>
												<th>Tipo Ensayo</th>
											</tr>
											<tr>
												<th>#</th>
												<th>Opcion</th>
												<th>Fecha Solicitud</th>
												<th>SS N°</th>
												<th>Cliente</th>
												<th>Proyecto</th>
												<th>Tipo Ensayo</th>
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
													<td>
														<button type="button" data-toggle="modal" data-target="#modal_dosificacion" onclick="SetVal('<?php echo $datos_tab1['ID_SOLICITUD'];?>')" class="btn btn-default btn-xs">Ensayar</button>
													</td>
													<td><?php echo $datos_tab1['FECHA_SOLICITUD'];?></td>
													<td style="text-align: center;" >
														<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $datos_tab1['ID_AGENDAMIENTO'];?>&folio=<?php echo $datos_tab1['N_SOLICITUD'];?>" class="btn btn-default btn-xs"><?php echo $datos_tab1['N_SOLICITUD'];?></a>
													</td>
													<td><?php echo $datos_tab1['CLIENTE'];?></td>
													<td><?php echo $datos_tab1['PROYECTO'];?></td>
													<td>Tipo Ensayo</td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>

									<!-- =============================== &&&&& MODALS &&&&&  =============================== -->

									<div class="modal fade bs-example-modal-lg" id="modal_dosificacion" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="modal_dosificacion_titulo">Aguas</h4>
												</div>
												<div class="modal-body">
													<?php
													include("laboratorio-ensayos/suelos/ensayo_dosificacion.php");
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
									<div class="modal fade bs-example-modal-sm" id="MODAL_CONFIRMAR" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
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
     <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
     <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
     <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
     <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

     <!-- Custom Theme Scripts -->
     <script src="../build/js/custom.min.js"></script>

		 <script>

		 function asigna(valor, tipo){
			 document.getElementById("id_form").value = valor;
			 document.getElementById("confirmar").value = tipo;

		 }
		 function envia_form(tipo){
			 if(tipo>=0)
			 	alert("Tipo: "+tipo);
		 }

			 $('#dosificacion').DataTable( {
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
