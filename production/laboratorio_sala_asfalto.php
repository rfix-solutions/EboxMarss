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

$QrySala = "
	SELECT
		s.id_form_solicitud_servicio AS ID_SOLICITUD,
		DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
		e.nombre_tipo_ensayo AS TIPO_ENSAYO,
		s.numero_solicitud AS N_SOLICITUD,
		a.id_agendamiento_visita AS ID_AGENDAMIENTO,
		a.razon_social AS CLIENTE,
		a.nombre_proyecto AS PROYECTO,
		s.estadoSS AS ESTADO
	FROM
		TBL_FormSS s, TBL_AgendaVisita a, TBL_EnsayoTipo e
	WHERE
		s.id_tipo_ensayo = '5' AND
		s.id_agendamiento_visita = a.id_agendamiento_visita AND
		s.id_tipo_ensayo = e.id_tipo_ensayo
";

$QrySala2 = $QrySala;
?>

<!DOCTYPE html>
<html lang="es">
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
            	<h3>Bit&aacute;cora de Ensayos - Asfalto</h3>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
								<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_sala_PDF.php?OP=AG"><i class="fa fa-file-pdf-o"></i> PDF</a>
								<table id="Tabla_Asfalto" class="table table-striped table-bordered nowrap" cellspacing="0" style="width:100%">
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
											$QryEnsayo = mysqli_query($link, $QrySala) or die ("Error en Qry Ensayo " . mysqli_error($link));;
											$QryModal = mysqli_query($link, $QrySala2) or die ("Error en Qry Modal " . mysqli_error($link));;
											$i=1;
											$hoy = date("Y-m-d");
											while($DatEnsayo = mysqli_fetch_assoc($QryEnsayo)){

												switch ($DatEnsayo['ESTADO']) {
												 case '0':
													 $ButtonName = "Ensayar";
													 $ButtonClass = "btn btn-default btn-xs";
													 $modal_div = "modal_aridos".$DatEnsayo['ID_SOLICITUD']."";
													 break;

												 case '1':
													 $ButtonName = "Ensayado";
													 $ButtonClass = "btn btn-success btn-xs";
													 $modal_div = "ModalEnsayado";
													 break;
												}
												?>
												<tr>
													<td><?php echo $i; ?></td>
													<td>
														<button type="button" data-toggle="modal" data-target="#<?php echo $modal_div;?>" class="<?php echo $ButtonClass; ?>"><?php echo $ButtonName;?></button>
													</td>
													<td><?php echo $DatEnsayo['FECHA_SOLICITUD'];?></td>
													<td style="text-align: center;" >
														<a type="button" target="_blank" href="operaciones_FormSSdet.php?id=<?php echo $DatEnsayo['ID_AGENDAMIENTO'];?>&folio=<?php echo $DatEnsayo['N_SOLICITUD'];?>" class="btn btn-default btn-xs"><?php echo $DatEnsayo['N_SOLICITUD'];?></a>
													</td>
													<td><?php echo $DatEnsayo['CLIENTE'];?></td>
													<td><?php echo $DatEnsayo['PROYECTO'];?></td>
													<td>Tipo Ensayo</td>
												</tr>
												<?php
												$i++;
											}
											?>
										</tbody>
									</table>


									<?php
									while($DatModal = mysqli_fetch_assoc($QryModal)){
										$QryItemModal = "
											SELECT
												D.Ensayo_IdEnsayo as ID_ENSAYO, E.nombre_ensayo AS NOMBRE_ENSAYO, N.nombre_norma_ensayo AS NOMBRE_NORMA
											FROM
												TBL_FormSSDetalle D, TBL_Ensayo E, TBL_EnsayoNorma N
											WHERE
												D.FormSS_Id = '".$DatModal['ID_SOLICITUD']."' AND
												D.Ensayo_IdEnsayo = E.id_ensayo AND
												E.id_norma_ensayo = N.id_norma_ensayo

											ORDER BY
												D.Ensayo_IdEnsayo
										";
										$SqlItemModal = mysqli_query($link, $QryItemModal) or die ("Error en Sql Item Modal ". mysqli_error($link));;
										?>
									<div class="modal fade bs-example-modal-md" id="modal_aridos<?php echo $DatModal['ID_SOLICITUD'];?>" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-md">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="modal_titulo_aridos">Asfalto</h4>
												</div>
												<div class="modal-body">
													<form name="form_aridos<?php echo $DatModal['ID_SOLICITUD'];?>" id="form_aridos<?php echo $DatModal['ID_SOLICITUD'];?>" method="get" action="laboratorio-ensayos/aridos/ensayo_aridos_res.php">
														<?php
														$i=1;
														while($DatItem = mysqli_fetch_assoc($SqlItemModal)){
															if($DatItem['ID_ENSAYO']=='37'){
																$HeaderDensidad = '
																<div class="col-md-12">
																	<table class="table table-bordered" style="font-size: 10px; width:100%;" >
																	<thead style="background: #EDEDED;">
																	<tr>
																		<th colspan="2">REFERENCIAS</th>
																	</tr>
																	</thead>
																	<tr>
																		<td>DISEÑO MARSHALL DE REFERENCIA</td>
																		<td><input style="width:100%;" type="text" name="DisenoMarshall" id="DisenoMarshall" value=""></td>
																	</tr>
																	<tr>
																		<td>DENSIMETRO MARCA	</td>
																		<td><input style="width:100%;" type="text" name="DensimetroMarca" id="DensimetroMarca" value=""></td>
																	</tr>
																	</table>
																</div>
																';
															}
															else {
																$HeaderDensidad = "";
															}
															echo $HeaderDensidad;
															?>

																	<div class="col-md-12">
																  	<table class="table table-bordered" style="font-size: 10px; width:100%;" >
																    	<thead style="background: #EDEDED;">
																      <tr>
																        <th colspan="3"><?php echo strtoupper($DatItem['NOMBRE_ENSAYO'])?></br> <?php echo strtoupper($DatItem['NOMBRE_NORMA'])?></th>
																      </tr>
																    	</thead>
																    	<tbody>
																      <?php
																      $QryItemEnsayo = "
																        SELECT
																          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
																        FROM
																          TBL_EnsayoItem
																        WHERE
																          id_ensayo ='".$DatItem['ID_ENSAYO']."'";
																      $SqlItemEnsayo = mysqli_query($link, $QryItemEnsayo);
																      while ($ItemEnsayo = mysqli_fetch_assoc($SqlItemEnsayo)) {?>
															        <tr>
															          <td><?php echo $ItemEnsayo['nombre_ensayo_item'];?></td>
															          <td><input style="width:100%;" type="text" name="EnsayoItem<?php echo $ItemEnsayo['id_ensayo_item']?>" id="<?php echo $ItemEnsayo['id_ensayo_item']?>" value=""></td>
															          <td><?php echo $ItemEnsayo['unidad_medida_item']?></td>
															        </tr>
																      <?php
																      }
																      ?>
																      <tr>
																        <td >FECHA ENSAYO</td>
																        <td colspan="2"><input style="width:50%;" type="date" name="fecha_ensayo_<?php echo $DatItem['ID_ENSAYO']?>" id="fecha_ensayo_<?php echo $DatItem['ID_ENSAYO']?>" value=""></td>
																      </tr>
																    	</tbody>
																  	</table>
																	</div>

															<?php

															}?>
															<table class="table table-bordered" style="font-size: 10px; width:100%;" >
																<thead style="background: #EDEDED;">
																	<tr>
																		<th>OBSERVACIONES</th>
																	</tr>
																</thead>
																<tr>
																	<td><textarea class="form-control" name="observaciones"></textarea></td>
																</tr>
															</table>
															<input type="hidden" id="NS" name="NS" value="<?php echo $DatModal['ID_SOLICITUD'];?>">
															<input type="hidden" id="TE" name="TE" value="3">
													</form>
												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" onclick="nombre_formulario(<?php echo $DatModal['ID_SOLICITUD'];?>)" class="btn btn-success">Aceptar</button>
												</div>
											</div>
										</div>
									</div>
									<?php
									}?>

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

													<button type="submit" id="confirmar" value="" class="btn btn-success" onclick="envia_form()">Aceptar</button>
												</div>
											</div>
										</div>
									</div>



									<div class="modal fade bs-example-modal-md" id="ModalEnsayado" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-md">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="modal-titulo_aridos">Mensaje</h4>
												</div>
												<div class="modal-body">
													Esta muestra ya ha sido ensayada
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
												</div>
											</div>
										</div>
									</div>
									<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->

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

				var nombre_form;
				function nombre_formulario(formulario){
					nombre_form = 0;
					nombre_form = formulario;
				}
				function envia_form(){

					nombre_form = "form_aridos"+nombre_form;
					document.getElementById(nombre_form).submit();
				}

			 $('#Tabla_Asfalto').DataTable( {
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
