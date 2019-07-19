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


$sql = mysqli_query($link, "
SELECT
	c.id_cotizacion AS ID,
	DATE_FORMAT(c.fecha_creacion, '%d-%m-%Y') as FECHA,
	c.numero_cotizacion as COTIZACION,
	c.nombre_proyecto as PROYECTO,
	u.sigla_usuario as RESPONSABLE,
	s.codigo_sucursal as SUCURSAL,
	cl.razon_social as CLIENTE,
	e.nombre_estado_cotizacion as ESTADO

FROM
	TBL_Cotizacion c, TBL_Usuario u, TBL_Cliente cl, TBL_Sucursal s, TBL_CotizacionEstado e
WHERE
	c.id_cliente = cl.id_cliente AND
	c.id_usuario = u.id_usuario AND
	c.id_estado_cotizacion = e.id_estado_cotizacion AND
	u.id_sucursal = s.id_sucursal
ORDER BY c.fecha_creacion DESC
") or die('Consulta fallida: '.mysql_error());;
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
<!-- Datatables -->
		<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
            <br />
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
							<h3>Workflow</h3>
            </div>
          </div>
					<div class="clearfix"></div>
					<div class="row tile_count">
						<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Cotizaciones</span>
              <div class="count green">2,500</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>+34% </i> Que año anterior</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Clientes con Cotizaci&oacute;n</span>
              <div class="count">2500</div>
              <span class="count_bottom"><i class="green">+4% </i> que semana pasada</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Cotizaciones generadas </span>
              <div class="count red">120</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>-3% </i> que mes anterior</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Cotizaciones Enviadas</span>
              <div class="count red">467</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> que mes anterior</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Cotizaciones Aceptadas</span>
              <div class="count green">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>2% </i> que mes anterior</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Cotizaciones Rechazadas</span>
              <div class="count red">25</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-asc"></i>+34% </i> que mes anterior</span>
            </div>
          </div>

					<div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
              	<div class="x_content">
                	<table id="datatable" class="table" cellspacing="0" width="100%">
                  	<thead>
                    	<tr>
                      	<th>#</th>
						  					<th>Fecha</th>
												<th>Sucursal</th>
												<th>Cotizaci&oacute;n</th>
                        <th>Cliente</th>
                        <th>Proyecto</th>
						  					<th>Estado</th>
                        <th>Responsable</th>
											</tr>
											<tr>
												<th></th>
						  					<th></th>
												<th></th>
                        <th></th>
                        <th></th>
						  					<th></th>
												<th></th>
                        <th></th>
											</tr>
										</thead>
										<tbody>

										<?php
										$i=1;
										while($row = mysqli_fetch_assoc($sql)){
										?>
											<tr>
						 						<td><?php echo $i; ?></td>
                        <td><?php echo $row['FECHA'];?></td>
												<td><?php echo $row['SUCURSAL'];?></td>
												<td>
													<a style="width:100px; text-align: center;" href="detalle.php?id=<?php echo $row['ID'];?>" class="btn btn-default btn-xs">
														<?php echo $row['COTIZACION'];?>
													</a>
						  					</td>
												<td><?php echo ucwords(strtolower($row['CLIENTE']));?></td>
                        <td><?php echo ucwords(strtolower($row['PROYECTO']));?></td>
                        <td><?php echo $row['ESTADO'];?></td>

                        <td><?php echo strtoupper($row['RESPONSABLE']);?></td>
											</tr>
										<?php
										$i++;
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

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

	<!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
		<script>


	var table = $('#datatable').DataTable( {
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


	$('a.toggle-vis').on( 'click', function (e) {
         e.preventDefault();

         // Get the column API object
         var column = table.column( $(this).attr('data-column') );

         // Toggle the visibility
         column.visible( ! column.visible() );
     } );



		</script>
  </body>
</html>
