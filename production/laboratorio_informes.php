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
        <!-- top navigation -->
				<?php
       	include 'menu_top.php';
        ?>
				<!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
        	<div class="">
          	<div class="page-title">
            	<div class="title_left">
              	<h3>Informes</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
										<table id="informes" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>N° Informe </th>
													<th>Cliente</th>
													<th>Proyecto</th>
													<th>N° Solicitud</th>
													<th>Fecha Solicitud</th>
													<th>Estado</th>
													<th>Descargar</th>
												</tr>
												<tr>
													<th>#</th>
													<th>N° Informe </th>
													<th>Cliente</th>
													<th>Proyecto</th>
													<th>N° Solicitud</th>
													<th>Fecha Solicitud</th>
													<th>Estado</th>
													<th>Descargar</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$query_informes = "
												SELECT
													I.Informe_Id AS ID,
													I.Informe_IdFormCH AS ID_HM,
													I.Informe_IdFormSS AS ID_SS,
													I.Informe_Tipo AS TIPO_SERVICIO,
													E.InformeEstado_Descripcion AS ESTADO,
													T.nombre_informe AS SIGLA,
													I.Informe_Estado AS ID_ESTADO
												FROM
													TBL_Informe I, TBL_InformeEstado E, TBL_EnsayoTipo T
												WHERE
													I.Informe_Estado = E.InformeEstado_Id AND
													I.Informe_Tipo = T.id_tipo_ensayo
											";
											$sql_informes = mysqli_query($link, $query_informes);
											while($datos = mysqli_fetch_assoc($sql_informes)){
												switch ($datos['ID_ESTADO']) {
													case '1':// creado
													$class = "btn btn-default btn-xs";
													$dir = "#informes/";
													break;

													case '2':// ensayado
													$class = "btn btn-warning btn-xs";
													$dir = "informes/";
													break;

													case '3':// aprobado
													$class = "btn btn-success btn-xs";
													$dir = "informes/";
													break;

													case '4':// rechadazo
													$class = "btn btn-danger btn-xs";
													$dir = "informes/";
													break;

													case '5':// anulado
													$class = "btn btn-danger btn-xs";
													$dir = "informes/";
													break;
												}
												if($datos['ID_HM']!=0){
													$QRY_Detalle = "
														SELECT
															'HM' AS TIPO,
															HM.numero_solicitud AS N_SOLICITUD,
															DATE_FORMAT(HM.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
															AV.razon_social AS CLIENTE,
															AV.nombre_proyecto AS PROYECTO,
															AV.id_agendamiento_visita AS ID_AV
														FROM
															TBL_AgendaVisita AV, TBL_FormHM HM
														WHERE
															HM.id_agendamiento_visita = AV.id_agendamiento_visita AND
															HM.id_form_c_h_m = '".$datos['ID_HM']."'
													";
												}
												else{
													if($datos['ID_SS']!=0){
														$QRY_Detalle = "
															SELECT
																'SS' AS TIPO,
																SS.numero_solicitud AS N_SOLICITUD,
																DATE_FORMAT(SS.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
																AV.razon_social AS CLIENTE,
																AV.nombre_proyecto AS PROYECTO,
																AV.id_agendamiento_visita AS ID_AV
															FROM
																TBL_AgendaVisita AV, TBL_FormSS SS
															WHERE
																SS.id_agendamiento_visita = AV.id_agendamiento_visita AND
																SS.id_form_solicitud_servicio = '".$datos['ID_SS']."'
														";
													}
												}
												$SQL_Detalle = mysqli_query($link, $QRY_Detalle) or die ("Error en SQL detalle: ".mysqli_error());;
												while($detalle = mysqli_fetch_assoc($SQL_Detalle)){
													$tipo = $detalle['TIPO'];
													$cliente = $detalle['CLIENTE'];
													$proyecto = $detalle['PROYECTO'];
													$solicitud = $detalle['N_SOLICITUD'];
													$fecha = $detalle['FECHA_SOLICITUD'];
													$agendamiento = $detalle['ID_AV'];
												}
												$Folio =  $datos['SIGLA']."-".$datos['ID']."/".date("y");

												switch($datos['TIPO_SERVICIO']){
													case "1": $url = "hormigon/informe_detalle_hormigon";
													break;
													case "2": $url = "suelos/informe_detalle_suelos";
													break;
													case "3": $url = "aguas/informe_detalle_aguas";
													break;
													case "4": $url = "aridos/informe_detalle_aridos";
													break;
													case "5": $url = "asfalto/informe_detalle_asfalto";
													break;
													case "6": $url = "elementos/informe_detalle_elementos";
													break;
													case "7": $url = "densidad/informe_detalle_densidad";
													break;
													default: echo "Error";
												}
												?>

														<tr>
															<td><?php echo $datos['ID'];?></td>
															<td style="text-align: center;" >
																<a type="button" href="informes/<?php echo $url;?>.php?id=<?php echo $solicitud;?>&ida=<?php echo $agendamiento;?>&tipo=<?php echo $tipo;?>&folio=<?php echo $Folio;?>&idf=<?php echo $datos['ID'];?>" target="_blank" class="btn btn-default btn-xs">
																	<?php echo $Folio;?>
																</a>
															</td>
															<td><?php echo $cliente;?></td>
															<td><?php echo $proyecto;?></td>
															<td style="text-align: center;">
																<?php
																switch ($tipo) {
																	case 'SS':
																		//$dir = "form_solicitud_servicio_det";
																		$dir = "operaciones_FormSSdet";
																	break;
																	case 'HM':
																		//$dir = "form_control_hormigones_morteros_det";
																		$dir = "operaciones_FormHMdet";
																	break;

																}
																?>
																<a type='button' href='<?php echo $dir; ?>.php?id=<?php echo $agendamiento;?>&folio=<?php echo $solicitud;?>' class='btn btn-default btn-xs'><?php echo $solicitud;?></a>
															</td>
															<td><?php echo $fecha;?></td>
															<td style="text-align: center;">
																<button type="button" href="#" class="<?php echo $class;?>"><?php echo ucwords($datos['ESTADO']);?></button>
															</td>
															<td style="text-align: center;">
																<?php
																if($datos['ESTADO'] == "aprobado"){?>
																<a type='button' style='width: 40%;' class='btn btn-default btn-xs' target='_blank' data-toggle='tooltip' data-placement='top' data-original-title='PDF' href='<?php echo $dir.$url;?>_res.php?id=<?php echo $solicitud;?>&F=<?php echo $Folio;?>'>
																	<span class='fa fa-file-pdf-o'></span>
																</a>
																<?
																}
																else{?>
																	<button type='button' style='width: 40%;' class='btn btn-default btn-xs' onclick='javascript:alert("Documento pendiente de aprobación")'><span class='fa fa-file-pdf-o'></span></button>
																<?php
																}?>
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
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
		<!-- Custom Theme Scripts -->
   	<script src="../build/js/custom.min.js"></script>
		<script>

		$('#informes').DataTable( {
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
								 select.append( "<option value='"+d+"'>"+d+"</option>" )
								 //select.append('<option value='+d+'>"+d+"</option>')
						 } );
				 } );
		 }
		} );



		</script>
	</body>
</html>
