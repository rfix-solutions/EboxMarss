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
	c.numero_cotizacion as COTIZACION,
	cl.razon_social as CLIENTE,
	c.nombre_proyecto as PROYECTO,
	cl.contacto_cliente AS CONTACTO,
	cl.telefono_cliente AS TELEFONO,
	cl.email_cliente AS EMAIL,
	e.nombre_estado_cotizacion as ESTADO,
	DATE_FORMAT(c.fecha_creacion, '%d-%m-%Y') as FECHA,
	s.codigo_sucursal as SUCURSAL,
	u.sigla_usuario as RESPONSABLE

FROM
	TBL_Cotizacion c, TBL_Usuario u, TBL_Cliente cl, TBL_Sucursal s, TBL_CotizacionEstado e
WHERE
	c.id_cliente = cl.id_cliente AND
	c.id_usuario = u.id_usuario AND
	c.id_estado_cotizacion = e.id_estado_cotizacion AND
	u.id_sucursal = s.id_sucursal
ORDER BY c.fecha_creacion DESC
") or die('Consulta fallida: '.mysqli_error());;

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
      	<div class="">
        	<div class="page-title">
          	<div class="title_left">
            	<h3>Comercial</h3>
							<a style="width:150px; text-align: center;" href="cotizacion_crear.php?id=0" class="btn  btn-xs color bg-green	">
									Crear Cotizaci&oacute;n
							</a>
            </div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
              	<div class="x_content">
									<table id="datatable" class="table" cellspacing="0" width="100%">
                  	<thead>
                    <tr>
                    	<th>#</th>
											<th>Fecha Creaci&oacute;n</th>
											<th>Estado</th>
											<th>Sucursal</th>
											<th>Cotizaci&oacute;n</th>
											<th>Cliente</th>
											<th>Proyecto</th>
											<th>Contacto</th>
											<th>Tel&eacute;fono</th>
											<th>Email</th>
											<th>Fecha Ult. Gesti&oacute;n</th>

                      <th>Responsable</th>
                    </tr>
										<tr>
                    	<th>#</th>
											<th>Fecha Creaci&oacute;n</th>
											<th>Estado</th>
											<th>Sucursal</th>
											<th>Cotizaci&oacute;n</th>
											<th>Cliente</th>
											<th>Proyecto</th>
											<th>Contacto</th>
											<th>Tel&eacute;fono</th>
											<th>Email</th>
											<th>Fecha Ult. Gesti&oacute;n</th>
                      <th>Responsable</th>
                    </tr>
                  	</thead>

										<tbody>
											<?php
											$i=1;
											while($row = mysqli_fetch_assoc($sql)){
												$QRY_Gestion = "
												SELECT MAX(id_historial_cotizacion) AS ID,
													DATE_FORMAT(fecha_historial_cotizacion, '%d-%m-%Y') as FECHA_GESTION
												FROM
													TBL_CotizacionGestion
												WHERE
													id_cotizacion = '".$row['ID']."'
												";
												$SQL_Gestion = mysqli_query($link, $QRY_Gestion) or die ("Error en QRY Gestion".mysqli_error($link));;
												while($Data_Gestion = mysqli_fetch_assoc($SQL_Gestion)){

													if($Data_Gestion['ID'] == null || $Data_Gestion['FECHA_GESTION'] == null){
														$Gestion_ID			= "N/A";
														$Gestion_Fecha	= "Sin Gestion";
													}else{
														$Gestion_ID			= $Data_Gestion['ID'];
														$Gestion_Fecha	= $Data_Gestion['FECHA_GESTION'];
													}
												}
											?>
											<tr>
						  					<td><?php echo $i; ?></td>
												<td><?php echo $row['FECHA'];?></td>
												<td><?php echo ucwords(strtolower($row['ESTADO']));?></td>
												<td><?php echo $row['SUCURSAL'];?></td>
												<td style="text-align: center;" >
													<a type="button" href="comercial_detalle.php?id=<?php echo $row['ID'];?>" class="btn btn-default btn-xs"><?php echo $row['COTIZACION'];?></a>
												</td>
						  					<td><?php echo ucwords(strtolower($row['CLIENTE']));?></td>
												<td><?php echo ucwords(strtolower($row['PROYECTO']));?></td>
                        <td><?php echo ucwords(strtolower($row['CONTACTO']));?></td>
												<td><?php echo $row['TELEFONO'];?></td>
												<td><?php echo strtolower($row['EMAIL']);?></td>
												<td><?php echo $Gestion_Fecha;?></td>
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


	$('#datatable').DataTable( {
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
							} );
					} );
			}
	} );





		</script>
  </body>
</html>
