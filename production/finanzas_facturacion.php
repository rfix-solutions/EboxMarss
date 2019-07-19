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

$QRY_Facturas = "
	SELECT
		Factura_Id AS ID,
		Factura_ClienteId AS CLIENTEID,
		Factura_ClienteRut AS CLIENTERUT,
		Factura_ClienteRazonSocial AS CLIENTERS,
		Factura_ObraId AS OBRAID,
		Factura_ObraNombre AS OBRANOMBRE,
		Factura_Numero AS FACTURA,
		DATE_FORMAT(Factura_FechaEmision, '%Y-%m-%d') AS FECHA
	FROM
		TBL_Factura
";

$SQL_Facturas = mysqli_query($link, $QRY_Facturas) or die ("Error en QRY FACTURAS".mysqli_error($link));

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
          	<h3>Facturación</h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content">
								<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#PDF" ><i class="fa fa-file-pdf-o"></i> PDF</button>
								<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#XLS" ><i class="fa fa-file-excel-o"></i> XLS</button>
								<form name="facturables" method="get" action="finanzas_facturacion_detalle.php">
									<table id="datatable-facturacion" class="table table-striped table-bordered">
										<thead>
											<th>#</th>
											<th>Fecha Emision</th>
											<th>Rut</th>
											<th>Facturar a</th>
											<th>Obra</th>
											<th>Factura N°</th>
											<th>Total Neto</th>
											<th>Estado</th>
											<th>Detalle</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while($Data_Facturas = mysqli_fetch_assoc($SQL_Facturas)){?>
											<tr>
												<td><?php echo $Data_Facturas['ID']?></td>
												<td>
													<?php
													if($Data_Facturas['FECHA']=="" || $Data_Facturas['FECHA']=="0000-00-00"){
															echo "Sin Emitir";
													}
													else{
														echo $Data_Facturas['FECHA'];
													}
													?>
												</td>
												<td><?php echo $Data_Facturas['CLIENTERUT']?></td>
												<td><?php echo $Data_Facturas['CLIENTERS']?></td>
												<td><?php echo $Data_Facturas['OBRANOMBRE']?></td>
												<td>
													<?php
													if($Data_Facturas['FACTURA'] == "" || $Data_Facturas['FACTURA'] == 0){
															echo "SIN FOLIO";
													}
													else{
														echo $Data_Facturas['FACTURA'];
													}
													?>
												</td>
												<td>$320,800</td>
												<?php
												if($Data_Facturas['FACTURA'] == "" || $Data_Facturas['FACTURA'] == 0){
													$estado = "Prefacturada";
													$class = "btn-default";

												}
												else{
													$estado = "Facturada";
													$class = "btn-warning";
												}
												?>
												<td><a class="btn btn-round <?php echo $class; ?> btn-xs"><?php echo $estado?></a></td>
												<td><a class="btn btn-success btn-xs" href="finanzas_facturacion_detalle.php?id=<?php echo $Data_Facturas['ID']?>">Ver</a></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</form>
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
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>

<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script>
		$('#datatable-facturacion').dataTable( {
	    paging: true,
	    searching: true,
			lengthMenu: [[10, 20, 25, 50, -1], [10, 20, 25, 50, "Todos"]]
		} );
		</script>
  </body>
</html>
