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



$SQL_Suelos = "
	SELECT
		S.id_form_solicitud_servicio AS ID_SOLICITUD,
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
		S.numero_solicitud AS N_SOLICITUD,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		S.muestra AS MUESTRA,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO,
		S.material AS MATERIAL,
		S.procedencia AS PROCEDENCIA,
		S.ubicacion AS UBICACION
	FROM
		TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		S.id_tipo_ensayo = '2' AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
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
          	<h3>Bit&aacute;cora de Ensayos - Suelos</h3>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
	       	<div class="col-md-12 col-sm-12 col-xs-12">
	         	<div class="x_panel">
	           	<div class="x_content">
									<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_sala_PDF.php?OP=SU"><i class="fa fa-file-pdf-o"></i> PDF</a>
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
														<th>Ensayar</th>
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
														<th>Ensayar</th>
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
													$QRY_Suelos = mysqli_query($link, $SQL_Suelos);
													$QRY_Suelos2 = mysqli_query($link, $SQL_Suelos);

													$i=1;
													$hoy = date("Y-m-d");
													while ($DAT_Suelos = mysqli_fetch_assoc($QRY_Suelos)) {
													?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $DAT_Suelos['FECHA_SOLICITUD'];?></td>
														<td style="text-align: center;" >
															<a type="button" target="_blank" href="operaciones_FormSSdet.php?id=<?php echo $DAT_Suelos['ID_AGENDAMIENTO'];?>&folio=<?php echo $DAT_Suelos['N_SOLICITUD'];?>" class="btn btn-default btn-xs"><?php echo $DAT_Suelos['N_SOLICITUD'];?></a>
															<input type="hidden" name="id_solicitud" value="<?php echo $DAT_Suelos['ID_SOLICITUD'];?>">
														</td>
														<td><?php echo $DAT_Suelos['CLIENTE'];?></td>
														<td><?php echo $DAT_Suelos['PROYECTO'];?></td>
														<td><?php echo $DAT_Suelos['MATERIAL'];?></td>
														<td><?php echo $DAT_Suelos['PROCEDENCIA'];?></td>
														<td><?php echo $DAT_Suelos['UBICACION'];?></td>
														<td>Ciudad</td>
														<td><?php echo $DAT_Suelos['FECHA_SOLICITUD'];?></td>
														<td><button type="button" data-toggle="modal" data-target="#modal_suelos<?php echo $i; ?>" onclick="SetVal('<?php echo $DAT_Suelos['ID_SOLICITUD'];?>')" class="btn btn-default btn-xs">Ensayar</button></td>
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




									<!-- =============================== &&&&& MODALS &&&&&  =============================== -->
									<?php
									$k = 1;
									while ($DET_Suelos = mysqli_fetch_assoc($QRY_Suelos2)) {
										$QRY_FormSSDet = "
											SELECT
												I.id_ensayo AS ID, I.nombre_ensayo_item AS NOMBRE, I.unidad_medida_item AS UM
											FROM
												TBL_FormSSDetalle D, TBL_EnsayoItem I
											WHERE
												D.FormSS_Id = '".$DET_Suelos['ID_SOLICITUD']."' AND D.Muestra = '".$DET_Suelos['MUESTRA']."' AND
												D.Ensayo_IdEnsayo = I.id_ensayo_item
										";
										$SQL_FormSSDet = mysqli_query($link, $QRY_FormSSDet) or die ("Error en QRY FORM SS DET: " . mysqli_error($link));;
										?>
									<div class="modal fade bs-example-modal-lg" id="modal_suelos<?php echo $k; ?>" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="modal_titulo_suelos">Suelos <?php echo $k; ?></h4>
												</div>
												<div class="modal-body">

													<?php

													include("laboratorio-ensayos/suelos/ensayo_suelos.php");
/*
													?>

													<form method="get" action="laboratorio-ensayos/suelos/ensayo_suelos_res.php" name="form_suelo" id="form_suelo">
															<table id="tablas" class="table table-bordered" style="font-size: 10px;">
											          <thead style="background: #EDEDED;">
											            <tr>
											              <th>Granulometr&iacute;a</th> <!-- // Mostrar nombre de ensayo según el item-->
											              <th>MC Vol 8 - 8.202.2</br>MC Vol 8 - 8.102.1	</th> <!-- // Mostrar norma de Ensayo-->
											            </tr>
											          </thead>
											          <tbody>
											            <tr>
											              <td style="width:60%" >Tamiz</td>
											              <td>% Acumulado que pasa</td>
											            </tr>
											          <?php
											          while ($DAT_FormSSDet = mysqli_fetch_assoc($SQL_FormSSDet)) {?>
											            <tr>
											              <td><?php echo $DAT_FormSSDet['NOMBRE']." - ".$DAT_FormSSDet['UM'];?></td>
											              <td><input type="number" name="<?php echo $DAT_FormSSDet['ID']?>" id="<?php echo $DAT_FormSSDet['ID']?>" value=""></td>
											            </tr>
											          <?php
											          }
											          ?>
											          <tr>
											            <td>FECHA DE ENSAYO</td>
											            <td><input type="date" name="fecha_ensayo_14" id="fecha_ensayo_14" value=""></td>
											          </tr>
											        </tbody>
											      </table>
													</form>
													<?php */?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
												</div>
											</div>
										</div>
									</div>
									<?php
									$k++;
									}?>




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

		 <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>

     <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
     <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
     <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
     <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
     <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
     <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
     <script src="../vendors/jszip/dist/jszip.min.js"></script>
     <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

     <!-- Custom Theme Scripts -->
     <script src="../build/js/custom.min.js"></script>

		 <script>
			 function SetVal(valor){
				 document.getElementById('NS').value = valor;

			 }

			 function envia_form(dato){
				 document.form_suelo.submit();
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

		 </script>


  </body>
</html>
