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
include '_qry/db_connect_local.php';


$sql_tab2 = "

	SELECT
		H.id_form_c_h_m AS ID_SOLICITUD,
		DATE_FORMAT(H.fecha_muestra, '%Y-%m-%d') AS FECHA_SOLICITUD,
		H.id_agendamiento_visita AS ID_AGENDAMIENTO,
		H.numero_solicitud AS N_SOLICITUD,
		a.razon_social AS CLIENTE,
		a.nombre_proyecto AS PROYECTO,
		T.nombre_tipo_ensayo AS TIPO_ENSAYO,
		E.nombre_ensayo AS NOMBRE_ENSAYO,
		E.id_ensayo AS IDENSAYO,
		D.edad AS EDAD,
		R.FormHMDetRE_Valor AS RESISTENCIA_ESPECIFICA,
		'HM' as FORM,
		D.Estado AS ESTADO
	FROM
		TBL_FormHM H, TBL_AgendaVisita a, TBL_EnsayoTipo T, TBL_FormHMDet D, TBL_FormHMDetRE R, TBL_Ensayo E, TBL_FormHMProb P
	WHERE
		H.id_tipo_ensayo = '1' AND
		H.id_agendamiento_visita = a.id_agendamiento_visita AND
		H.id_tipo_ensayo = T.id_tipo_ensayo AND
		H.id_form_c_h_m = D.id_form_c_h_m AND
		D.FormHMDetRE_Id = R.FormHMDetRE_Id AND
		D.FormHMProb_Id = P.FormHMProb_Id AND
		P.FormHMProb_IdEnsayo = E.id_ensayo
	UNION

	SELECT
		S.id_form_solicitud_servicio AS ID_SOLICITUD,
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
		S.id_agendamiento_visita AS ID_AGENDAMIENTO,
		S.numero_solicitud AS N_SOLICITUD,
		a.razon_social AS CLIENTE,
		a.nombre_proyecto AS PROYECTO,
		T.nombre_tipo_ensayo AS TIPO_ENSAYO,
		E.nombre_ensayo AS NOMBRE_ENSAYO,
		E.id_ensayo AS IDENSAYO,
		'N/A' AS EDAD,
		'N/A' AS RESISTENCIA_ESPECIFICA,
		'SS' AS FORM,
		D.Estado AS ESTADO
	FROM
		TBL_FormSS S, TBL_AgendaVisita a, TBL_EnsayoTipo T, TBL_Ensayo E, TBL_FormSSDetalle D
	WHERE
		S.id_tipo_ensayo = '1' AND
		S.id_agendamiento_visita = a.id_agendamiento_visita AND
		S.id_tipo_ensayo = T.id_tipo_ensayo AND
		S.id_form_solicitud_servicio = D.FormSSDetalle_Id AND
		E.id_ensayo = D.Ensayo_IdEnsayo
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
            	<h3>Bit&aacute;cora de Ensayos - Hormigón</h3>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
              	<div class="x_content">
									<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_sala_PDF.php?OP=HO"><i class="fa fa-file-pdf-o"></i> PDF</a>
									<table id="hormigon" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
												 <tr>
													 <th>#</th>
													 <th>Ensayar</th>
													 <th>Fecha Ensayo</th>
													 <th>N° Solicitud</th>
													 <th>Cliente</th>
													 <th>Proyecto</th>
													 <th>Tipo de Ensayo</th>
													 <th>Fecha Muestra</th>
													 <th>Edad</th>
													 <th>Resistencia Especificada</th>
													 <th>Resistencia Ensayo</th>
												 </tr>
												 <tr>

												 	<th>#</th>
													<th>Ensayar</th>
												 	<th>Fecha Ensayo</th>
												 	<th>N° Solicitud</th>
												 	<th>Cliente</th>
												 	<th>Proyecto</th>
												 	<th>Tipo de Ensayo</th>
												 	<th>Fecha Muestra</th>
												 	<th>Edad</th>
												 	<th>Resistencia Especificada</th>
												 	<th>Resistencia Ensayo</th>
												 </tr>
											</thead>
										 <tbody>
										<?php


										$query_tab2 = mysqli_query($link, $sql_tab2) or die("Error en Qry CHM".mysqli_error($link));;

										$i=1;
										$hoy = date("Y-m-d");
										while ($datos_tab2 = mysqli_fetch_assoc($query_tab2)) {
											$QMuestras = $datos_tab2['QMUESTRAS'];
											switch ($datos_tab2['FORM']) {
												case 'HM':
													//$Form = "form_control_hormigones_morteros_det";
													$Form = "operaciones_FormHMdet";
												break;
												case 'SS':
													//$Form = "form_solicitud_servicio_det";
													$Form = "operaciones_FormSSdet";
												break;
												default:
													$Form = "#";
												break;
											}
											$dias = intval($datos_tab2['EDAD']);
										?>
											<tr>
												<td><?php echo $i; ?></td>
												<td style="text-align: center;" >

													<?php
													switch ($datos_tab2['IDENSAYO']) {
													 case '10':
														 $modal_div = "RI-HOR-OF";
														 $modal_title = "Ruptura Probeta Mortero (RILEM)";
														 $modal_url = "ensayo_hormigon_".$modal_div;
													 break;

													 case '11':
														 $modal_div = "CI-HOR-OF-COMP";
														 $modal_title = "Compresión Cilindro Hormigón";
														 $modal_url = "ensayo_hormigon_".$modal_div;
													 break;

													 case '12':
														 $modal_div = "CU-HOR-OF-COMP";
														 $modal_title = "Compresión Cubo Hormigón";
														 $modal_url = "ensayo_hormigon_".$modal_div;
													 break;

													 case '13':
														 $modal_div = "VI-HOR-OF-FLEX";
														 $modal_title = "Flexo tracción Hormigón";
														 $modal_url = "ensayo_hormigon_".$modal_div;
													 break;

													 case '5':
														 $modal_div = "COMPRESION-TESTIGOS";
														 $modal_title = "Flexo tracción Hormigón";
														 $modal_url = "ensayo_hormigon_".$modal_div;
													 break;

													 default:
														 // code...
														 break;
													}

													switch ($datos_tab2['ESTADO']) {
													 case '0':
														 $ButtonName = "Ensayar";
														 $ButtonClass = "btn btn-default btn-xs";
														 break;

													 case '1':
														 $ButtonName = "Ensayado";
														 $ButtonClass = "btn btn-success btn-xs";
														 $modal_div = "ModalEnsayado";
														 break;
													}
													?>
												 <button type="button" name="id_solicitud" id="id_solicitud" onclick="SetVal('<?php echo $datos_tab2['ID_SOLICITUD'];?>','<?php echo $datos_tab2['TIPO_ENSAYO'];?>')" data-toggle="modal" data-target="#<?php echo $modal_div;?>" class="<?php echo $ButtonClass; ?>"><?php echo $ButtonName; ?></button>


											 </td>

												 <td><?php echo date("Y-m-d",strtotime($datos_tab2['FECHA_SOLICITUD']."+ $dias days"));?></td>

												<td style="text-align: center;" >
													<a type="button" target="_blank" href="<?php echo $Form;?>.php?id=<?php echo $datos_tab2['ID_AGENDAMIENTO'];?>&folio=<?php echo $datos_tab2['N_SOLICITUD'];?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $datos_tab2['FORM'];?>"><?php echo $datos_tab2['N_SOLICITUD'];?></a>
												</td>
												 <td><?php echo $datos_tab2['CLIENTE'];?></td>
												<td><?php echo $datos_tab2['PROYECTO'];?></td>
												 <td><?php echo $datos_tab2['TIPO_ENSAYO'];?> (<?php echo $datos_tab2['NOMBRE_ENSAYO'];?>)</td>
												 <td><?php echo $datos_tab2['FECHA_SOLICITUD'];?></td>
												 <td><?php echo $datos_tab2['EDAD'];?></td>
												 <td><?php echo $datos_tab2['RESISTENCIA_ESPECIFICA'];?></td>
												 <td></td>

											</tr>
											<?php
											$i++;
											}
											?>
										</tbody>
									</table>

<!-- ///////////////////////////////////////////////////// MODALS ENSAYOS ///////////////////////////////////////////////////// -->

									<div class="modal fade bs-example-modal-md" id="CU-HOR-OF-COMP" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-md">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="modal-titulo_hormigon">Compresi&oacute;n Cubo Hormig&oacute;n</h4>
												</div>
												<div class="modal-body">
													<?php
														include("laboratorio-ensayos/hormigon/ensayo_hormigon_CU-HOR-OF-COMP.php");
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR_CU" class="btn btn-success">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade bs-example-modal-md" id="CI-HOR-OF-COMP" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-md">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="modal-titulo_hormigon">Compresi&oacute;n Cil&iacute;ndro Hormig&oacute;n</h4>
												</div>
												<div class="modal-body">
													<?php
														include("laboratorio-ensayos/hormigon/ensayo_hormigon_CI-HOR-OF-COMP.php");
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR_CI" class="btn btn-success">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade bs-example-modal-md" id="VI-HOR-OF-FLEX" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="modal-titulo_hormigon">Flexo tracci&oacute;n Hormig&oacute;n</h4>
												</div>
												<div class="modal-body">
													<?php
														include("laboratorio-ensayos/hormigon/ensayo_hormigon_VI-HOR-OF-FLEX.php");
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR_VI" class="btn btn-success">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade bs-example-modal-lg" id="COMPRESION-TESTIGOS" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="modal-titulo_hormigon">Compresi&oacute;n Testigos Hormig&oacute;n</h4>
												</div>
												<div class="modal-body">
													<?php
														include("laboratorio-ensayos/hormigon/ensayo_hormigon_COMPRESION-TESTIGOS.php");
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR_TH" class="btn btn-success">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade bs-example-modal-md" id="RI-HOR-OF" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-md">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="modal-titulo_hormigon">Ruptura Probeta Mortero (RILEM)</h4>
												</div>
												<div class="modal-body">
													<?php
														include("laboratorio-ensayos/hormigon/ensayo_hormigon_RI-HOR-OF.php");
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR_RI" class="btn btn-success">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

<!-- ///////////////////////////////////////////////////// MODALS CONFIRMACION ///////////////////////////////////////////////////// -->
									<div class="modal fade bs-example-modal-sm" id="MODAL_CONFIRMAR_CU" tabindex="-1" role="dialog" aria-hidden="true">
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
													<button type="submit" class="btn btn-success" onclick="envia_form('CU')">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade bs-example-modal-sm" id="MODAL_CONFIRMAR_CI" tabindex="-1" role="dialog" aria-hidden="true">
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
													<button type="submit" class="btn btn-success" onclick="envia_form('CI')">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade bs-example-modal-sm" id="MODAL_CONFIRMAR_TH" tabindex="-1" role="dialog" aria-hidden="true">
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
													<button type="submit" class="btn btn-success" onclick="envia_form('TH')">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade bs-example-modal-sm" id="MODAL_CONFIRMAR_VI" tabindex="-1" role="dialog" aria-hidden="true">
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
													<button type="submit" class="btn btn-success" onclick="envia_form('VI')">Aceptar</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal fade bs-example-modal-sm" id="MODAL_CONFIRMAR_RI" tabindex="-1" role="dialog" aria-hidden="true">
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
													<button type="submit" class="btn btn-success" onclick="envia_form('RI')">Aceptar</button>
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
													<h4 class="modal-title" id="modal-titulo_hormigon">Mensaje</h4>
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

									<div class="modal fade bs-example-modal-sm" id="ModalFueraRango" tabindex="-1" role="dialog" aria-hidden="true">
									  <div class="modal-dialog modal-sm">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">×</span>
									        </button>
									        <h4 class="modal-title" id="MODAL_TITULO_CONFIRMAR">Advertencia</h4>
									      </div>
									      <div class="modal-body">
									        C&aacute;lculo fuera de rango
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
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
		 	var ns = 0;
			var te = 0
			function SetVal(v1,v2){
				ns = v1;
				te = v2;
			}


		 function envia_form(tf){
			 switch (tf) {
			 	case 'CU': //Compresión Cubo Hormigón
					document.getElementById('NSCU').value = ns;
					document.getElementById('TECU').value = te;
					document.form_hormigon_CU.submit();
				break;

				case 'CI': //Compresión Cilindro Hormigón
					document.getElementById('NSCI').value = ns;
					document.getElementById('TECI').value = te;
					document.form_hormigon_CI.submit();
				break;

				case 'TH': //Compresión de Testigos
				document.getElementById('NSCT').value = ns;
				document.getElementById('TECT').value = te;
				document.form_hormigon_TH.submit();
				break;

				case 'VI': //Flexo tracción Hormigón
					document.getElementById('NSVI').value = ns;
					document.getElementById('TEVI').value = te;
					document.form_hormigon_VI.submit();
				break;

				case 'RI': //Flexo tracción Hormigón
					document.getElementById('NSRI').value = ns;
					document.getElementById('TERI').value = te;
					document.form_hormigon_RI.submit();
				break;
			 }
		 }

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
													var val = $.fn.dataTable.util.escapeRegex($(this).val());
													column.search( val ? '^'+val+'$' : '', true, false ).draw();
												} );
												column.data().unique().sort().each( function ( d, j ) {
													select.append( '<option value="'+d+'">'+d+'</option>' )
										//select.append( "<option value='"+d+"'>"+d+"</option>" )
												} );
											} );
				}
			} );



		 </script>


  </body>
</html>
