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
switch($Opt){
  case "0": $h3_text = "Agregar Cliente";
			$CliRut = "";
			$CliRazonSocial = "";
			$CliNombreFant = "";
			$CliDireccion = "";
			$CliContacto = "";
			$CliEmail = "";
			$CliTel = "";

	  break;

  case "1": $h3_text = "Editar Cliente";
			$RO = "readonly";
			$sql = "SELECT * FROM TBL_Cliente WHERE id_cliente = '".$_GET['id']."'";
			$result = mysqli_query($link, $sql) or die('Consulta fallida: '.mysql_error());;
			while($fila = mysqli_fetch_assoc($result)){
				$CliRut = $fila['rut_cliente'];
				$CliRazonSocial = $fila['razon_social'];
				$CliNombreFant = $fila['nombre_cliente'];
				$CliDireccion = $fila['direccion_cliente'];
				$CliContacto = $fila['contacto_cliente'];
				$CliEmail = $fila['email_cliente'];
				$CliTel = $fila['telefono_cliente'];
				$CliTarifado = $fila['tarifado'];
				$CliForPago = $fila['id_forma_pago_cli'];
				$CliPerPago = $fila['id_periodo_pago_cli'];
				$CliLibre = $fila['libre_envio'];
				$CliEstado = $fila['id_estado_cliente'];
			}

	  break;
  case "2": $h3_text = "Eliminar Cliene";
			$sql = "SELECT * FROM TBL_Usuario WHERE id_usuario = '".$_GET['id']."'";
			$result = mysqli_query($link, $sql) or die('Consulta fallida: '.mysql_error());;
			while($fila = mysqli_fetch_assoc($result)){
				$CliRut = $fila['rut_cliente'];
				$CliRazonSocial = $fila['razon_social'];
				$CliNombreFant = $fila['nombre_cliente'];
				$CliDireccion = $fila['direccion_cliente'];
				$CliContacto = $fila['contacto_cliente'];
				$CliEmail = $fila['email_cliente'];
				$CliTel = $fila['telefono_cliente'];

			}
	  break;
  default:  $h3_text = "Opción Incorrecta";
			?>
			<script type="text/javascript">
				alert("Opción Incorrecta.");
				location.href=history.back();
			</script>
			<?php
}

$QRY_FormaPago = "SELECT * FROM TBL_FormaPago";
$QRY_ClienteEstado = "SELECT * FROM TBL_ClienteEstado";
$QRY_PeriodoPago = "SELECT * FROM TBL_PeriodoPago";

$SQL_FormaPago = mysqli_query($link, $QRY_FormaPago);
$SQL_ClienteEstado = mysqli_query($link, $QRY_ClienteEstado);
$SQL_PeriodoPago = mysqli_query($link, $QRY_PeriodoPago);
?>



<!DOCTYPE html>
<html lang="es">
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
            <div class="clearfix"></div><br />
						<?php include 'menu_sidebar.php'; ?>
						<?php include 'menu_footer.php'; ?>
					</div>
				</div>
				<?php include 'menu_top.php'; ?>
				<div class="right_col" role="main">
          	<div class="page-title">
            	<div class="title_left">
				  			<h3><?php echo $h3_text;?></h3>
              </div>
            </div>
	          <div class="clearfix"></div>
			     	<div class="row">
				  		<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
					  			<div class="x_content">
						  			<div class="col-md-10 center-margin">
											<form class="form-horizontal form-label-left" action="mant_clientes_res.php" method="get">
												<div class="row">
													<div class="form-group col-md-2">
														<label>Rut</label>
														<input type="text" class="form-control" name="CliRut" id="CliRut" <?php echo $RO;?> value="<?php echo $CliRut?>" required oninput="checkRut(this)" maxlength="10">
														<script src="js/CheckRut.js"></script>
													</div>
													<div class="form-group col-md-5">
														<label>Razon Social</label>
														<input type="text" class="form-control" name="CliRazonSocial" value="<?php echo $CliRazonSocial;?>" required>
													</div>
													<div class="form-group col-md-5">
														<label>Nombre Fantasia</label>
														<input type="text" class="form-control" name="CliNombreFant" value="<?php echo $CliNombreFant;?>" required>
													</div>

												</div>

												<div class="row">
													<div class="form-group col-md-12">
														<label>Direcci&oacute;n</label>
														<input type="text" class="form-control" name="CliDireccion" value="<?php echo $CliDireccion;?>" required>
													</div>
												</div>

												<div class="row">
													<div class="form-group col-md-4">
														<label>Contacto</label>
														<input type="text" class="form-control" name="CliContacto" value="<?php echo $CliContacto;?>" required>
													</div>
													<div class="form-group col-md-4">
														<label>Email</label>
														<input type="email" name="CliEmail" class="form-control" value="<?php echo $CliEmail; ?>" required>
													</div>
													<div class="form-group col-md-4">
														<label>Telefono fijo</label>
														<input type="number" class="form-control" name="CliTel" value="<?php echo $CliTel;?>" required>
													</div>

												</div>

												<div class="row">
													<div class="form-group col-md-3">
														<label>Periodo Pago</label>
														<select class="form-control" required id="CliPerPago" name="CliPerPago">
															<option value="">-- Seleccione Periodo Pago --</option>
															<?php
															while($row2 = mysqli_fetch_assoc($SQL_PeriodoPago)){
																if($CliPerPago == $row2['id_periodo_pago_cli']){ $SELECTED = "selected"; } else { $SELECTED = ""; }
																?>
																<option <?php echo $SELECTED;?> value="<?php echo $row2['id_periodo_pago_cli']?>"><?php echo $row2['nombre_periodo']?></option>
																<?php
															} ?>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label>Forma de Pago</label>
														<select class="form-control"  required id="CliForPago" name="CliForPago">
															<option value="">-- Seleccione Forma de Pago --</option>
															<?php
															while($row1 = mysqli_fetch_assoc($SQL_FormaPago)){
																if($CliForPago == $row1['id_forma_pago']){ $SELECTED = "selected"; } else { $SELECTED = ""; }
																?>
																<option <?php echo $SELECTED;?> value="<?php echo $row1['id_forma_pago']?>"><?php echo $row1['nombre_forma_pago']?></option>
															<?php
															} ?>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label>Estado</label>
														<select class="form-control" required id="CliEstado" name="CliEstado">
															<option value="">-- Seleccione Estado </option>
															<?php
															while($row2 = mysqli_fetch_assoc($SQL_ClienteEstado)){
																if($CliEstado == $row2['id_estado_cliente']){ $SELECTED = "selected"; } else { $SELECTED = ""; }
																?>
																<option <?php echo $SELECTED;?> value="<?php echo $row2['id_estado_cliente']?>"><?php echo $row2['nombre_estado']?></option>
																<?php
															} ?>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label>Libre Env&iacute;o</label>
														<select class="form-control" required id="CliLibre" name="CliLibre">
															<option value="">-- Seleccione Tipo Envío--</option>
															<option value="1">SI</option>
															<option value="0" SELECTED>NO</option>
														</select>
													</div>
												</div>
											</div>

									  	<div class="ln_solid"></div>
											<div class="x-content" style="text-align:right;">
													<input type="hidden" name="opt" value="<?php echo $Opt?>">
													<button type="button" class="btn btn-danger" onClick="location.href='mant_clientes.php'" >Cancelar</button>
													<button type="submit" class="btn btn-success">Aceptar</button>

											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
				</div>
				<?php include 'footer.php';	?>
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
