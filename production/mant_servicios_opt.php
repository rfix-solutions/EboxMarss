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



$opcion = $_GET['opt'];
$id_serv = $_GET['id'];

$sql1 = mysqli_query($link, "SELECT id_tipo_ensayo as ID, nombre_tipo_ensayo as NOMBRE FROM TBL_EnsayoTipo") or die('Consulta fallida: '.mysql_error());;

$sql2 = mysqli_query($link, "SELECT id_estado_acreditado as ID, nombre_estado_acreditado as NOMBRE FROM TBL_EnsayoAcreditacion") or die('Consulta fallida: '.mysql_error());;

$sql3 = mysqli_query($link, "SELECT id_norma_ensayo as ID, nombre_norma_ensayo as NOMBRE FROM TBL_EnsayoNorma") or die('Consulta fallida: '.mysql_error());;

$sql4 = mysqli_query($link, "SELECT nombre_ensayo as NOMBRE, precio as PRECIO FROM TBL_Ensayo WHERE id_ensayo = '".$_GET['id']."'") or die('Consulta fallida: '.mysql_error());;
while($fila = mysqli_fetch_assoc($sql4)){
	$nombre_ensayo = $fila['NOMBRE'];
	$precio_ensayo = $fila['PRECIO'];
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

	<title>.: EBOX PLATFORM - LOGIN :. </title>

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
				  <?php
				  switch($_GET['opt']){
					  case "0": $h3_text = "Agregar Ensayo";
						  break;
					  case "1": $h3_text = "Editar Ensayo";
						  break;
					  case "2": $h3_text = "Eliminar Ensayo";
						  break;
					  default:  $h3_text = "Opción Incorrecta";
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
					  		<form class="form-horizontal form-label-left input_mask" method="get" action="mant_servicios_res.php">
								<input type="hidden" name="opt" value="<?php echo $opcion;?>" />
								<input type="hidden" name="ids" value="<?php echo $id_serv;?>" />
                    			<label for="heard">Tipo de Ensayo *:</label>
								<select name="tipo_ensayo" id="heard" class="form-control" required>

									<option value="">Seleccione..</option>
									<?php
									while($row = mysqli_fetch_assoc($sql1)){
									?>
									<option value="<?php echo $row['ID'];?>"><?php echo $row['NOMBRE'];?></option>
									<?php
									}
									?>
								</select>
								</br>
					  			<label for="heard">Estado de Ensayo *:</label>
								<select name="estado_ensayo" id="heard" class="form-control" required>
									<option value="">Seleccione..</option>
									<?php
									while($row = mysqli_fetch_assoc($sql2)){
									?>
									<option value="<?php echo $row['ID'];?>"><?php echo $row['NOMBRE'];?></option>
									<?php
									}
									?>
								</select>
								</br>

								<label for="heard">Norma de Ensayo *:</label>
                        		<select name="norma_ensayo" id="heard" class="form-control" required>

									<option value="">Seleccione..</option>
									<?php
									while($row = mysqli_fetch_assoc($sql3)){
									?>

									<option value="<?php echo $row['ID'];?>"><?php echo $row['NOMBRE'];?></option>
									<?php
									}
									?>
                        		</select>
								</br>

						<label for="fullname">Nombre Ensayo * :</label>
                      	<input type="text" value="<?php echo $nombre_ensayo;?>" id="fullname" class="form-control" name="nombre_ensayo" required />
						<br/>

						<label for="digits">Precio UF * :</label>
                      		<input type="digits" value="<?php echo $precio_ensayo;?>" id="digits" class="form-control" name="precio_ensayo" data-parsley-trigger="change" required />

                        <br/>


					  	<div class="ln_solid"></div>
                      	<div class="form-group">
                        	<button type="button" onClick="Javascript: history.back();" class="btn btn-primary">Volver</button>
                        	<button type="submit" class="btn btn-success">Aceptar</button>
                      	</div>

                    </form>







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
