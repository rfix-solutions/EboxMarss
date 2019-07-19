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


$Opt = $_GET['opt'];
$IdLab = $_GET['id'];

$QryLab = "SELECT id_laboratorista as ID, nombre_laboratorista as NOMBRE, LaboratoristaEstado as ESTADO FROM TBL_Laboratorista WHERE id_laboratorista = '".$IdLab."'";




$SqlLab = mysqli_query($link, $QryLab) or die('Error en QRY: '.mysql_error());;

while($fila = mysqli_fetch_assoc($SqlLab)){
	$LabNombre = $fila['NOMBRE'];
	$LabID = $fila['ID'];
	$LabEstado = $fila['ESTADO'];
}
?>
<!DOCTYPE html>
<html lang="es">
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
				  			<?php
							  switch($_GET['opt']){
								  case "0": $h3_text = "Agregar Laboratorista"; $readonly="readonly"; $selected="selected";
									  break;
								  case "1": $h3_text = "Editar Laboratorista"; $readonly=""; $selected="selected";
									  break;
								  case "2": $h3_text = "Inactivar Laboratorista"; $readonly="readonly"; $selected="selected";
									  break;
								  default:  $h3_text = "Opción Incorrecta"; $readonly="readonly"; $selected="selected";
							  }
							  ?>
                <h3><?php echo $h3_text;?></h3>
              </div>
            </div>
            <div class="clearfix"></div>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
                	<div class="x_panel">
										<div class="x_content">
								  		<form class="form-horizontal form-label-left input_mask" method="get" action="mant_laboratoristas_res.php">
												<input type="hidden" name="opt" value="<?php echo $Opt;?>" />
												<input type="hidden" name="id" value="<?php echo $IdLab;?>" />

												<label for="fullname">Nombre * :</label>
												<input type="text" value="<?php echo $LabNombre?>" id="fullname" class="form-control" name="Lab_Nombre" required />
												<br/>

                    		<label for="heard">Estado *:</label>
												<select name="Lab_Estado" id="estado" class="form-control" required <?php echo $readonly; ?>>
													<option value="">Seleccione..</option>
													<option value="1" <?php echo $selected; ?>>Activo</option>
													<option value="0">Inactivo</option>
												</select>
												</br>

					  						<div class="ln_solid"></div>
                      	<div class="form-group">
                        	<button type="button" onClick="location.href='mant_laboratoristas.php'" class="btn btn-primary">Volver</button>
                        	<button type="submit" class="btn btn-success">Aceptar</button>
                      	</div>
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
  <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
