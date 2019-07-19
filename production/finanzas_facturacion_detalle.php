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

$FacturaId = $_GET['id'];


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
              	<h3>Detalle de Facturación</h3>
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

												$Qry = "
													SELECT
														Factura_ClienteRut AS RUT,
														Factura_ClienteRazonSocial AS EMPRESA,
														Factura_ObraNombre AS OBRA,
														Factura_Numero AS NFACTURA,
														Factura_FechaEmision AS FECHAEMISION,
														Factura_Estado AS ESTADO,
														Factura_Solicitante AS SOLICITANTE,
														Factura_Encargado AS ENCARGADO,
														Factura_Email AS EMAIL,
														Factura_FormaPago AS FORMAPAGO,
														Factura_ValorUF AS UF,
														Factura_Ciudad AS CIUDAD
													FROM
														TBL_Factura
													WHERE
														Factura_Id = '".$FacturaId."'
												";
												$Sql = mysqli_query($link, $Qry) or die ("Existe error en Qry ".$AVID.": ".mysqli_error($link));;

												while($Rows=mysqli_fetch_assoc($Sql)){
													$Rut 			= $Rows['RUT'];
													$Empresa 	= $Rows['EMPRESA'];
													$Obra  		= $Rows['OBRA'];
													$NFactura = $Rows['NFACTURA'];
													$FechaEmision = $Rows['FECHAEMISION'];
													$Estado 	= $Rows['ESTADO'];
													$Solicitante = $Rows['SOLICITANTE'];
													$Encargado  = $Rows['ENCARGADO'];
													$Email = $Rows['EMAIL'];
													$FormaPago = $Rows['FORMAPAGO'];
													$ValorUF = $Rows['UF'];
													$Ciudad = $Rows['CIUDAD'];
												}
											?>
											<div class="col-sm-2 col-md-2 col-xs-3">Rut</div>
											<div class="col-sm-2 col-md-2 col-xs-3"><input class="form-control" readonly name="pf_rut" value="<?php echo $Rut ?>" type="text"></div>
											<div class="col-sm-2 col-md-2 col-xs-3">Factura N°</div>
											<div class="col-sm-2 col-md-2 col-xs-3"><input class="form-control" readonly name="pf_factnro" value="<?php echo $NFactura?>" type="text"></div>
											<div class="col-sm-2 col-md-2 col-xs-3">Fecha Operacion</div>
											<div class="col-sm-2 col-md-2 col-xs-3"><input class="form-control" readonly name="pf_fecha" value="<?php echo date("d-m-Y")?>" type="text"></div>
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
											<div class="col-sm-4 col-md-4 col-xs-3"><input class="form-control" type="text" readonly value="<?php echo $ValorUF;?>"></div>
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
													$QRY_FacturaDetalle ="
														SELECT
															DATE_FORMAT(FacturaDetalle_FechaOp, '%Y-%m-%d') AS FECHA,
															FacturaDetalle_SolicitudN	AS N_SOLICITUD,
															FacturaDetalle_EnsayoQ AS CANTIDAD,
															FacturaDetalle_EnsayoId AS SERVICIO,
															FacturaDetalle_ValorUnit AS VALORUNIT
														FROM
															TBL_FacturaDetalle
														WHERE
															FacturaDetalle_FacturaId = '".$FacturaId."'
														";

														$SQL_FacturaDetalle = mysqli_query($link, $QRY_FacturaDetalle) or die ("Existe error en Qry Facturables ".mysqli_error($link));;
														$i=1;
														$TotalNetoUF = 0;
														$TotalNetoCLP = 0;
														$TotalIvaUF = 0;
														$TotalIvaCLP = 0;
														$TotalUF = 0;
														$TotalCLP = 0;

														while($Rows=mysqli_fetch_assoc($SQL_FacturaDetalle)){
															$TotalUnitUF = $Rows['VALORUNIT']*$Rows['CANTIDAD'];
															$TotalNetoUF = $TotalNetoUF + $TotalUnitUF;
															$TotalIvaUF = $TotalNetoUF * 0.19;
															$TotalUF = $TotalNetoUF+$TotalIvaUF;

															$TotalUnitCLP = $ValorUF*($Rows['VALORUNIT']*$Rows['CANTIDAD']);
															$TotalNetoCLP = $TotalNetoCLP + $TotalUnitCLP;
															$TotalIvaCLP = $TotalNetoCLP * 0.19;
															$TotalCLP = $TotalNetoCLP+$TotalIvaCLP;
															?>
															<tr>
															<td><?php echo $i;?></td>
															<td><?php echo $Rows['FECHA'];?></td>
															<td><?php echo $Rows['N_SOLICITUD'];?></td>
															<td><?php echo $Rows['CANTIDAD'];?></td>
															<td><?php echo $Rows['ENSAYO'];?> (<?php echo $Rows['SERVICIO']; ?>)</td>
															<td style="text-align: right;"><?php echo	$Rows['VALORUNIT'];?></td>
															<td style="text-align: right;"><?php echo	$Rows['VALORUNIT']*$Rows['CANTIDAD'];?></td>
															<td style="text-align: right;">$<?php echo	number_format($TotalUnitCLP, 0, ',', '.');?></td>
															</tr>
														<?php
														$i++;
													}

												?>
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
										<a class="btn btn-default" href="finanzas_facturacion.php">Volver</a>
										<?php
										if($NFactura == "" || $NFactura == "0" ){?>
											<button type="button" class="btn btn-success" data-toggle="modal" data-target="#FACTURA" >Registrar Factura</button>
										<?php
										}
										?>

									</div>

                </div>

            	</div>
          	</div>
					</form>
        </div>
      </div>

			<div class="modal fade" id="FACTURA" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							<h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n de Registro de factura</h4>
						</div>
						<form method="post" action="finanzas_facturacion_detalle_res.php">
							<input type="hidden" name="factura_id" value="<?php echo $FacturaId;?>">
							<div class="modal-body" style="text-align:center;">
								<div class="form-group row">
									<label class="control-label col-md-6 col-sm-6 col-xs-6" style="text-align:left;">N&uacute;mero de factura asociada</label>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<input type="number" class="form-control" name="factura_n" value="" minvalue="1">
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-6 col-sm-6 col-xs-6" style="text-align:left;">Fecha de emisi&oacute;n de factura asociada</label>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<input type="date" class="form-control" name="factura_fecha" value="" minvalue="1">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-success">Aceptar</button>
							</div>
						</form>
					</div>
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
