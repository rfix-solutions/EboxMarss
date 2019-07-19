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
	  <!-- iCheck -->
	  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	  <!-- Datatables -->
	  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
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
            <br />
            <!-- sidebar menu -->
          	<?php
					  include 'menu_sidebar.php';
						include 'menu_footer.php';
						?>
            <!-- /menu footer buttons -->
					</div>
				</div>
				<!-- top navigation -->
				<?php
       	include 'menu_top.php';
        ?>

        <div class="right_col" role="main">
					<div class="">
          	<div class="page-title">
            	<div class="title_left">
              	<h3>Detalle de Pre Facturación</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
									<div class="x_content">
										<button type="button" class="btn btn-default btn-xs" onclick="window.print();"><i class="fa fa-print"></i> Imprimir</button>
										<button type="button" class="btn btn-default btn-xs" ><i class="fa fa-file-pdf-o"></i> PDF</button>
									</div>

									<form name="facturables" method="get" action="finanzas_prefacturacion_detalle_res.php">
									<div class="x_content">
										<div class="form-group row">
											<?php
											foreach($_GET['SOLICITUD'] as $SOLICITUD){
												$Qry = "
													SELECT
														AC.empresa_solicitante AS EMPRESA,
														AC.nombre_solicitante AS SOLICITANTE,
														AC.email_facturacion AS EMAIL,
														AC.encargado_terreno AS ENCARGADO,
														AC.rut_empresa_factura AS RUT,
														C.comuna_nombre AS CIUDAD,
														AC.nombre_obra AS OBRA,
														FP.nombre_forma_pago AS FORMA_PAGO,
														AC.id_form_aceptacion AS ID_ACEPTACION
													FROM
														TBL_AgendaVisita AV, TBL_FormAC AC, TBL_FormaPago FP, TBL_FormHM H, TBL_Comuna C
													WHERE
														AV.id_form_aceptacion = AC.id_form_aceptacion AND
														AC.id_forma_pago = FP.id_forma_pago AND
														AC.comuna_obra = C.comuna_id AND
														AV.id_agendamiento_visita = H.id_agendamiento_visita AND
														H.numero_solicitud = '".$SOLICITUD."'

													UNION

													SELECT
														AC.empresa_solicitante AS EMPRESA,
														AC.nombre_solicitante AS SOLICITANTE,
														AC.email_facturacion AS EMAIL,
														AC.encargado_terreno AS ENCARGADO,
														AC.rut_empresa_factura AS RUT,
														C.comuna_nombre AS CIUDAD,
														AC.nombre_obra AS OBRA,
														FP.nombre_forma_pago AS FORMA_PAGO,
														AC.id_form_aceptacion AS ID_ACEPTACION
													FROM
														TBL_AgendaVisita AV, TBL_FormAC AC, TBL_FormaPago FP, TBL_FormSS S, TBL_Comuna C
													WHERE
														AV.id_form_aceptacion = AC.id_form_aceptacion AND
														AC.id_forma_pago = FP.id_forma_pago AND
														AC.comuna_obra = C.comuna_id AND
														AV.id_agendamiento_visita = S.id_agendamiento_visita AND
														S.numero_solicitud = '".$SOLICITUD."'

												";
												$Sql = mysqli_query($link, $Qry) or die ("Existe error en Qry ".$AVID.": ".mysqli_error($link));;

												while($Rows=mysqli_fetch_assoc($Sql)){
													$Empresa = $Rows['EMPRESA'];
													$Solicitante = $Rows['SOLICITANTE'];
													$Email = $Rows['EMAIL'];
													$Encargado  = $Rows['ENCARGADO'];
													$Rut  = $Rows['RUT'];
													$FormaPago = $Rows['FORMA_PAGO'];
													$Ciudad = $Rows['CIUDAD'];
													$Obra  = $Rows['OBRA'];
													$Aceptacion = $Rows['ID_ACEPTACION'];
												}
											}?>
											<div class="col-sm-2 col-md-2 col-xs-3">Rut</div>
											<div class="col-sm-2 col-md-2 col-xs-3"><input class="form-control" name="pf_rut" readonly value="<?php echo $Rut ?>" type="text"><input type="hidden" name="pf_aceptacion" value="<?php echo $Aceptacion;?>"></div>
											<div class="col-sm-2 col-md-2 col-xs-3">Factura N°</div>
											<div class="col-sm-2 col-md-2 col-xs-3"><input class="form-control" name="pf_factnro" type="text"></div>
											<div class="col-sm-2 col-md-2 col-xs-3">Fecha Operacion</div>
											<div class="col-sm-2 col-md-2 col-xs-3"><input class="form-control" name="pf_fecha" value="<?php echo date("d-m-Y")?>" readonly type="text"></div>
										</div>

	                  <div class="form-group row">
											<div class="col-sm-2 col-md-2 col-xs-3">Facturar A</div>
											<div class="col-sm-10 col-md-10 col-xs-3"><input class="form-control" name="pf_facturar_a" value="<?php echo $Empresa ?>" readonly type="text"></div>
										</div>
										<div class="form-group row">
											<div class="col-sm-2 col-md-2 col-xs-3">Solicitante</div>
											<div class="col-sm-4 col-md-4 col-xs-3"><input class="form-control" name="pf_solicitante"  value="<?php echo $Solicitante?>" readonly type="text"></div>
											<div class="col-sm-2 col-md-2 col-xs-3">Ciudad</div>
											<div class="col-sm-4 col-md-4 col-xs-3"><input class="form-control" name="pf_ciudad" value="<?php echo $Ciudad ?>" readonly type="text"></div>
										</div>
										<div class="form-group row">
											<div class="col-sm-2 col-md-2 col-xs-3">Encargado</div>
											<div class="col-sm-4 col-md-4 col-xs-3"><input class="form-control" type="text" name="pf_encargado" readonly value="<?php echo $Encargado ?>"></div>
											<div class="col-sm-2 col-md-2 col-xs-3">Email</div>
											<div class="col-sm-4 col-md-4 col-xs-3"><input class="form-control" type="text" name="pf_email" readonly  value="<?php echo $Email?>"></div>
										</div>
										<div class="form-group row">
											<div class="col-sm-2 col-md-2 col-xs-3">Obra</div>
											<div class="col-sm-4 col-md-4 col-xs-3"><input class="form-control" type="text" name="pf_obra" readonly value="<?php echo $Obra?>"></div>
											<div class="col-sm-2 col-md-2 col-xs-3">Forma Pago</div>
											<div class="col-sm-4 col-md-4 col-xs-3"><input class="form-control" type="text" name="pf_forma_pago" readonly value="<?php echo $FormaPago?>"></div>
										</div>
										<div class="form-group row">
											<div class="col-sm-2 col-md-2 col-xs-3">Cotizacion</div>
											<div class="col-sm-4 col-md-4 col-xs-3"><input class="form-control" type="text" name="pf_cotizacion"></div>
											<div class="col-sm-2 col-md-2 col-xs-3">UF</div>
											<div class="col-sm-4 col-md-4 col-xs-3"><input class="form-control" type="text" name="pf_valor_uf" readonly value="<?php echo $_GET['uf'];?>"></div>
										</div>
									</div>

									<div class="x_content">
											<table id="datatable-responsive" class="table table-striped table-bordered">
												<thead>
													<th>#</th>
													<th>Fecha Factura</th>
													<th>Solicitud</th>
													<th>Cantidad</th>
													<th>Descripcion del servicio</th>
													<th>Unit UF</th>
													<th>Total UF</th>
													<th>Total Pesos</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$AvId = array_unique($_GET['SOLICITUD']);
												$i=0;
												foreach ($AvId as $ID) {
													$QRY_Facturables ="

														SELECT
															DATE_FORMAT(HM.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
															HM.numero_solicitud AS N_SOLICITUD,
															T.nombre_tipo_ensayo AS SERVICIO,
													    E.nombre_ensayo AS ENSAYO,
															E.id_ensayo AS IDENSAYO,
													    E.precio AS PRECIO,
															(SELECT COUNT(HM.numero_solicitud)) AS CANTIDAD
														FROM
															TBL_FormHM HM, TBL_AgendaVisita A, TBL_EnsayoTipo T, TBL_FormAC AC, TBL_Ensayo E
														WHERE
															HM.numero_solicitud = '".$ID."' AND
															HM.id_agendamiento_visita = A.id_agendamiento_visita AND
															HM.id_tipo_ensayo = E.id_ensayo AND
													  	E.id_tipo_ensayo = T.id_tipo_ensayo AND
															A.id_form_aceptacion = AC.id_form_aceptacion

														UNION

														SELECT
															DATE_FORMAT(SS.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
															SS.numero_solicitud AS N_SOLICITUD,
															T.nombre_tipo_ensayo AS SERVICIO,
													    E.nombre_ensayo AS ENSAYO,
															E.id_ensayo AS IDENSAYO,
													    E.precio AS PRECIO,
															(SELECT COUNT(SS.numero_solicitud)) AS CANTIDAD
														FROM
															TBL_FormSS SS, TBL_AgendaVisita A, TBL_EnsayoTipo T, TBL_FormAC AC, TBL_Ensayo E, TBL_FormSSDetalle D
														WHERE
															SS.numero_solicitud = '".$ID."' AND
															SS.id_form_solicitud_servicio = D.FormSS_Id AND
															D.Ensayo_IdEnsayo = E.id_ensayo AND
															SS.id_agendamiento_visita = A.id_agendamiento_visita AND
															E.id_tipo_ensayo = T.id_tipo_ensayo AND
															A.id_form_aceptacion = AC.id_form_aceptacion

														";

														$Sql = mysqli_query($link, $QRY_Facturables) or die ("Existe error en Qry Facturables ".mysqli_error($link));;
														while($Rows=mysqli_fetch_assoc($Sql)){
															$TotalUnitUF = $Rows['PRECIO']*$Rows['CANTIDAD'];
															$TotalNetoUF = $TotalNetoUF + $TotalUnitUF;
															$TotalIvaUF = $TotalNetoUF * 0.19;
															$TotalUF = $TotalNetoUF+$TotalIvaUF;

															$TotalUnitCLP = $_SESSION['currency']*($Rows['PRECIO']*$Rows['CANTIDAD']);
															$TotalNetoCLP = $TotalNetoCLP + $TotalUnitCLP;
															$TotalIvaCLP = $TotalNetoCLP * 0.19;
															$TotalCLP = $TotalNetoCLP+$TotalIvaCLP;
															if($Rows['FECHA_SOLICITUD']==""){

															}
															else{
															?>
															<tr>
																<td><?php echo $i+1;?></td>
																<td><?php echo $Rows['FECHA_SOLICITUD'];?></td>
																<td><?php echo $Rows['N_SOLICITUD'];?></td>
																<td><?php echo $Rows['CANTIDAD'];?></td>
																<td><?php echo $Rows['ENSAYO'];?> (<?php echo $Rows['SERVICIO']; ?>)</td>
																<td style="text-align: right;"><?php echo	$Rows['PRECIO'];?></td>
																<td style="text-align: right;"><?php echo	$Rows['PRECIO']*$Rows['CANTIDAD'];?></td>
																<td style="text-align: right;">$<?php echo	number_format($TotalUnitCLP, 0, ',', '.');?></td>
															</tr>
															<input type="hidden" name="SOLICITUD[]" value="<?php echo $Rows['N_SOLICITUD'];?>">
															<input type="hidden" name="IDESANYO[]" value="<?php echo $Rows['IDENSAYO'];?>">
															<input type="hidden" name="CANTIDAD[]" value="<?php echo $Rows['CANTIDAD'];?>">
															<input type="hidden" name="VALORUNIT[]" value="<?php echo $Rows['PRECIO'];?>">
															<input type="hidden" name="VALORUF[]" value="<?php echo $_SESSION['currency'];?>">
															<input type="hidden" name="FECHAOP[]" value="<?php echo date("Y-m-d H:i:s");?>">

														<?php
															}
														}
														$i++;
													}
												?>
												<input type="hidden" name="NROWS" value="<?php echo $i;?>">
												<tr>
													<th colspan="6" style="text-align:right">Neto</th>
													<th style="text-align: right;">UF <?php echo number_format($TotalNetoUF, 2, ',', '.');?></th>
													<th style="text-align: right;">$ <?php echo number_format($TotalNetoCLP, 0, ',', '.');?></th>
												</tr>
												<tr>
													<th colspan="6" style="text-align:right">IVA</th>
													<th style="text-align: right;">UF <?php echo number_format($TotalIvaUF, 2, ',', '.');?></th>
													<th style="text-align: right;">$ <?php echo number_format($TotalIvaCLP, 0, ',', '.');?></th>
												</tr>
												<tr>
													<th colspan="6" style="text-align:right">TOTAL</th>
													<th style="text-align: right;">UF <?php echo number_format($TotalUF, 2, ',', '.');?></th>
													<th style="text-align: right;">$ <?php echo number_format($TotalCLP, 0, ',', '.');?></th>
												</tr>

											</tbody>
										</table>


                  </div>
									<div class="x-content" style="text-align: right;">
										<a class="btn btn-danger" href="finanzas_prefacturacion.php">Cancelar</a>
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#PREFACTURA" >Prefacturar</button>
									</div>

                </div>
								<div class="modal fade" id="PREFACTURA" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-sm">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
												<h4 class="modal-title" id="myModalLabel2">Alerta</h4>
											</div>
											<div class="modal-body" style="text-align:center;">
												<h5>
													¿Seguro que desea continuar?
													</br></br>
													Esta opci&oacute;n no puede revertirse.
												</h5>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
												<button type="submit" class="btn btn-success" >Aceptar</button>
											</div>
										</div>
									</div>
								</div>
            	</div>
          	</div>
					</form>
        </div>
      </div>


        <!-- /page content -->

        <!-- footer content -->
        <?php
		include 'footer.php';
        ?>
        <!-- /footer content -->
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


		$('#datatable-responsive').dataTable( {
	    paging: false,
	    searching: false,
		} );


		</script>
  </body>
</html>
