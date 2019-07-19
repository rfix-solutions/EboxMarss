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




$query = "
SELECT
	c.id_cotizacion AS ID,
	DATE_FORMAT(c.fecha_creacion, '%d/%M/%Y') as FECHA,
	c.numero_cotizacion as COTIZACION,
	c.version_cotizacion as VERSION,
	c.nombre_contacto as CONTACTO,
	c.nombre_proyecto as PROYECTO,
	s.nombre_sucursal as SUCURSAL,
	cl.razon_social as CLIENTE,
	cl.rut_cliente as RUT,
	cl.direccion_cliente as DIRECCION,
	c.email_contacto as EMAIL

FROM
	TBL_Cotizacion c, TBL_Usuario u, TBL_Cliente cl, TBL_Sucursal s, TBL_CotizacionEstado e
WHERE
	c.id_cotizacion = '".$_GET['id']."' AND
	c.id_cliente = cl.id_cliente AND
	c.id_usuario = u.id_usuario AND
	c.id_estado_cotizacion = e.id_estado_cotizacion AND
	u.id_sucursal = s.id_sucursal
";

$sql = mysqli_query($link, $query) or die('Consulta fallida: '.mysql_error());;

while($fila = mysqli_fetch_assoc($sql)){
	$cot_fecha = $fila['FECHA'];
	$cot_numero = $fila['COTIZACION'];
	$cot_proyecto = $fila['PROYECTO'];
	$cot_version = $fila['VERSION'];
	$cot_cliente = $fila['CLIENTE'];
	$cot_rut = $fila['RUT'];
	$cot_email = $fila['EMAIL'];
	$cot_contacto = $fila['CONTACTO'];
	$cot_direccion = $fila['DIRECCION'];
	$cot_telefono = "N/A";
}

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
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	<!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


  </head>

  <body class="nav-md footer_fixed" >
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

            <div class="clearfix"></div><br />

            <!-- sidebar menu -->
          <?php
		  include 'menu_sidebar.php';
		  ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php
			include 'menu_footer.php';
			?>
            <!-- /menu footer buttons -->
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

              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row" >
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

<!-- CONTENIDO DE PAGINA -->
<form name="crear_cotizacion" onSubmit="return validar(this)" action="crear_cotizacion_res.php" method="get">
			<div class="form-group">
				<div class="col-md12">
				<h4 style="text-align: left;" class="col-md12">
					<strong>Datos del proyecto</strong>
                </h4>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">


                	<input type="text" readonly class="form-control has-feedback-left" id="rut_cliente" value="<?php echo $cot_rut;?>"  name="rut_cliente">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</br>
				</div>
				<div class="col-md-6">

                	<input type="text" readonly class="form-control has-feedback-left" id="nombre_cliente" value="<?php echo $cot_cliente;?>" name="nombre_cliente">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</br>
                </div>
            </div>

			<div class="form-group">
				<div class="col-md-6">
                	<input type="text" readonly class="form-control has-feedback-left" id="nombre_proyecto" value="<?php echo $cot_proyecto;?>" name="nombre_proyecto">
					<span class="fa fa-file-text-o form-control-feedback left" aria-hidden="true"></span>
					</br>
				</div>

				<div class="col-md-6">
                	<input type="text" readonly class="form-control has-feedback-left" id="localidad" value="<?php echo $cot_direccion;?>" name="localidad">
					<span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
					</br>
                </div>
            </div>


 			<div class="form-group">
				<div class="col-md-6">
                	<input type="text" readonly class="form-control has-feedback-left" id="contacto" value="<?php echo $cot_contacto;?>" name="contacto">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</br>
				</div>

				<div class="col-md-6">
                	<input type="email" readonly class="form-control has-feedback-left" id="email" value="<?php echo $cot_email;?>"  name="email">
					<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
					</br>
                </div>
            </div>

            <div class="form-group">
				<div class="col-md-12">
                	<input type="text" readonly class="form-control has-feedback-left" id="telefono" value="<?php echo $cot_telefono;?>" name="telefono">
					<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
					</br>
				</div>


			</div>





			<div class="form-group">
			<div class="col-md12">
				<h4 style="text-align: left;" class="col-md12">
					<strong>Servicios</strong>
                </h4>
				</div>
	  		</div>
	  		<div class="form-group">

				<div class="col-md12">


                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
					<tr class="headings">
						<th class="column-title"># </th>
						<th class="column-title">Nombre Ensayo </th>
						<th class="column-title">Tipo Ensayo </th>
						<th class="column-title">Opción</th>
					</tr>
					</thead>
					<tbody>

	<?php
	$sql2 = mysqli_query($link, "
	SELECT
		e.id_ensayo as ID, e.nombre_ensayo as NOMBRE_ENSAYO, t.nombre_tipo_ensayo AS TIPO_ENSAYO, e.precio as PRECIO
	FROM
		TBL_Ensayo e, TBL_cotizacionDetalleEnsayos d, TBL_Cotizacion c, TBL_EnsayoTipo t
	WHERE
		c.id_cotizacion = '".$_GET['id']."' AND
		c.id_correlativo_cotizacion = d.id_correlativo_cotizacion AND
		d.id_ensayo = e.id_ensayo AND
		e.id_ensayo = t.id_tipo_ensayo
	") or die('Consulta fallida: '.mysql_error());;
	$i = 0;
	$n = 1;
	while($row2 = mysqli_fetch_assoc($sql2)){
		if($i<0 || $i>1){
			$i = 0;
		}
		switch($i){
			case "0": $class = "even pointer";
				break;
			case "1": $class = "odd pointer";
				break;
			default: $i=0;
		}
	?>
						<tr class="<?php echo $class; ?>">
							<td><?php echo $row2['ID'];?></td>
							<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;" >
								<?php
								  $nombre_serv = utf8_encode($row2['NOMBRE_ENSAYO']);
								  echo utf8_decode($nombre_serv);
								?>
							</td>
							<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;" >
								<?php
								  $nombre_serv = utf8_encode($row2['TIPO_ENSAYO']);
								  echo utf8_decode($nombre_serv);
								?>
							</td>
							<td>
								<button type="button" onClick="Javascript:location.href='form_control_hormigones_morteros.php?cot_id=<?php echo $_GET['id']?>';" class="btn btn-success">Ingresar Formulario</button>
							</td>
						</tr>
<?php
		$n++;
	}

?>
					</tbody>
					</table>


				</div>
			</div>






		<div class="ln_solid"></div>


</form>


				</div>
<!-- CONTENIDO DE PAGINA -->


                  </div>
                </div>
              </div>
            </div>
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
    <!-- jQuery Smart Wizard -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
	<!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	<!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
	<!-- DataTables-->
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

  </body>
</html>
