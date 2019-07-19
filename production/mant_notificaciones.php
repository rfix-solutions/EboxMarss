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

$QryNotificaciones = "
	SELECT
		Notificaciones_Id AS ID,
		Notificaciones_Tipo AS TIPO,
		Notificaciones_Email AS EMAIL,
		Notificaciones_Nombre AS NOMBRE
	FROM
		TBL_Notificaciones
";


$SQLNotificaciones = mysqli_query($link, $QryNotificaciones) or die('Consulta fallida: '.mysql_error());;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>.: EBOX PLATFORM :. </title>
		<!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet" />
  	<!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet" />
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet" />
  </head>
	<body class="nav-md">
		<div class="container body">
    	<div class="main_container">
      	<div class="col-md-3 left_col">
        	<div class="left_col scroll-view">
          	<div class="navbar nav_title" style="border: 0;">
            	<a href="#" class="site_title">
								<p style="text-align:center;">
									<img src="images/logo_marss.png" alt="logo" />
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
							<h3>Notificaciones</h3>
							<a style="width:150px; text-align: center;" href="mant_notificaciones_opt.php?opt=0&id=0" class="btn btn-xs color bg-blue">Agregar Email</a>
						</div>
					</div>
          <div class="clearfix"></div>
          <div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
              	<div class="x_content">
									<table id="datatable" style="width: 100%" class="table table-striped table-bordered dt-responsive nowrap" >
											<thead>
												<tr>
													<th>ID</th>
													<th>Email</th>
													<th>Nombre</th>
													<th>Tipo</th>
													<th>Opciones</th>
												</tr>
											</thead>
											<tbody>
												<?php
												while($row = mysqli_fetch_assoc($SQLNotificaciones)){
												?>
												<tr>
													<td><?php echo $row['ID'];?></td>
													<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;">
														<?php
															  $Notificaciones_Email = utf8_encode($row['EMAIL']);
															  echo utf8_decode($Notificaciones_Email);
														?>
													</td>
													<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;">
														<?php
															  $Notificaciones_Nombre = utf8_encode($row['NOMBRE']);
															  echo utf8_decode($Notificaciones_Nombre);
														?>
													</td>
													<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;">
														<?php
															  $Notificaciones_Tipo = utf8_encode($row['TIPO']);
															  switch ($Notificaciones_Tipo) {
															  	case '1':
															  	// CC
																	echo "CC";
															  	break;

																	case '2':
																	// BCC
																	echo "BCC";
																	break;

																	case '3':
															  		// FROM
																		echo "FROM";
															  	break;
															  }
														?>
													</td>
													<td>
														<button type="button" onclick="Javascript:location.href='mant_notificaciones_opt.php?opt=1&id=<?php echo $row['ID'];?>'" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Editar</button>
													</td>
												</tr>
												<?php
												}
												?>
											</tbody>
                  	</table>
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
	</body>
</html>
