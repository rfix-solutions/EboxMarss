<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} 
else 
{?>
	<script type="text/javascript">
		alert("Esta pagina es solo para usuarios registrados.")
		location.href="https://www.ebox.cl";
	</script>	
<?php
		exit;
}
include '_qry/db_connect_local.php';
mysql_set_charset('utf8');
setlocale(LC_ALL,"es_ES");
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
		  
		 
		  
  </head>

  <body class="nav-md footer_fixed">
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

            <!-- menu profile quick info -->
			<?php
			/*
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->
			*/
			?>
            <br />

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
                <h3>Operaciones</h3>
				<a style="width:150px; text-align: center;" href="calendario_operaciones.php" class="btn  btn-xs color bg-green	">
						Ver Calendario</a>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                      <!-- CONTENIDO EDITABLE -->

                    <table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
                        <tr>
							<th>#</th>
							<th>Cotización</th>
							<th>Cliente</th>
							<th>Proyecto</th>
							<th>Sucursal</th>
							<th>Responsable</th>								
							<th>Estado</th>
							<th>Fecha Aceptaci&oacute;n</th>
						  	<th>Agendar</th>
                        </tr>
                      	</thead>
						<tbody>
					  
<?php
$sql = mysql_query("
SELECT 
	c.id_cotizacion AS ID,
	c.fecha_creacion as FECHA,
	c.numero_cotizacion as COTIZACION,
	c.nombre_proyecto as PROYECTO,
	u.sigla_usuario as RESPONSABLE,
	s.codigo_sucursal as SUCURSAL,
	cl.razon_social as CLIENTE,
	e.nombre_estado_cotizacion as ESTADO

FROM 
	tbl_cotizacion c, tbl_usuarios u, tbl_cliente cl, tbl_sucursal s, tbl_estado_cotizacion e
WHERE
	c.id_cliente = cl.id_cliente AND
	c.id_usuario = u.id_usuario AND
	c.id_estado_cotizacion = e.id_estado_cotizacion AND
	u.id_sucursal = s.id_sucursal
") or die('Consulta fallida: '.mysql_error());;
$i=1;
while($row = mysql_fetch_assoc($sql)){
	
?>					  
					  
                        <tr>							
							<td><?php echo $i; ?></td>
							<td><?php echo $row['COTIZACION'];?></td>  
							<td><?php echo $row['CLIENTE'];?></td>
							<td><?php echo $row['PROYECTO'];?></td>
							<td><?php echo $row['SUCURSAL'];?></td>
							<td><?php echo $row['RESPONSABLE'];?></td>
							<td><?php echo $row['ESTADO'];?></td>
							<td><?php echo $row['FECHA'];?></td>
							  <td style="text-align: center;" >
								<a style="width:50px; text-align: center;" href="detalle.php?id=<?php echo $row['ID'];?>" class="btn btn-success btn-xs">
									<i class="glyphicon glyphicon-new-window"></i>
								</a>
							  </td>						  
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
  </body>
</html>
