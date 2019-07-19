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
		<!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">

                <h3>Ingreso Formulario</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                      <!-- CONTENIDO EDITABLE -->
											<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#PDF" ><i class="fa fa-file-pdf-o"></i> PDF</button>
											<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#XLS" ><i class="fa fa-file-excel-o"></i> XLS</button>
					<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
            <tr>
							<th>#</th>
							<th>ID</th>
							<th>Proyecto</th>
							<th>Rut</th>
							<th>Cliente</th>
							<th>Laboratorista</th>
							<th>Fecha Agendamiento</th>
            </tr>
            </thead>
						<tbody>

<?php

$query = "
SELECT
	ag.id_agendamiento_visita AS ID,	ag.nombre_proyecto AS PROYECTO,	ag.rut_empresa AS RUT,
	ag.razon_social AS CLIENTE,	l.nombre_laboratorista AS LABORATORISTA,	ag.fecha_agendamiento AS FECHA
FROM
	TBL_AgendaVisita ag, TBL_Laboratorista l
WHERE
	ag.id_laboratorista = l.id_laboratorista
ORDER BY fecha_agendamiento DESC
";
$i=1;

$sql = mysqli_query($link, $query) or die('Consulta fallida: '.mysql_error());;

while ($fila = mysqli_fetch_assoc($sql)) {

?>

                        <tr>
							<td><?php echo $i; ?></td>
							<td style="text-align: center;" >
								<a style="width:50px; text-align: center;" href="operaciones_ingreso_formulario_reg.php?id=<?php echo $fila['ID'];?>" class="btn btn-default btn-xs">
									<?php echo $fila['ID'];?>
								</a>
							</td>


							<td><?php echo $fila['PROYECTO'];?></td>
							<td><?php echo $fila['RUT'];?></td>
							<td><?php echo $fila['CLIENTE'];?></td>
							<td><?php echo $fila['LABORATORISTA'];?></td>
							<td><?php echo $fila['FECHA'];?></td>
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
