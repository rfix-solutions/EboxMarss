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
  case "0": $h3_text = "Agregar Usuario";
			$user_rut = "";
			$user_nombre = "";
			$user_ap_pat = "";
			$user_ap_mat = "";
			$user_email = "";
			$user_tel_fijo = "";
			$user_tel_movil = "";

	  break;
  case "1": $h3_text = "Editar Usuario";
			$RO = "readonly";
			$sql = "SELECT * FROM TBL_Usuario WHERE id_usuario = '".$_GET['id']."'";
			$result = mysqli_query($link, $sql) or die('Consulta fallida: '.mysql_error());;
			while($fila = mysqli_fetch_assoc($result)){
				$user_rut = $fila['rut_usuario'];
				$user_nombre = $fila['nombre_usuario'];
				$user_ap_pat = $fila['apellido_paterno'];
				$user_ap_mat = $fila['apellido_materno'];
				$user_email = $fila['email_usuario'];
				$user_tel_fijo = $fila['telefono_fijo_usuario'];
				$user_tel_movil = $fila['telefono_movil_usuario'];

			}

	  break;
  case "2": $h3_text = "Eliminar Usuario";
			$sql = "SELECT * FROM TBL_Usuario WHERE id_usuario = '".$_GET['id']."'";
			$result = mysqli_query($link, $sql) or die('Consulta fallida: '.mysql_error());;
			while($fila = mysqli_fetch_assoc($result)){
				$user_rut = $fila['rut_usuario'];
				$user_nombre = $fila['nombre_usuario'];
				$user_ap_pat = $fila['apellido_paterno'];
				$user_ap_mat = $fila['apellido_materno'];
				$user_email = $fila['email_usuario'];
				$user_tel_fijo = $fila['telefono_fijo_usuario'];
				$user_tel_movil = $fila['telefono_movil_usuario'];

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
$sql1 = mysqli_query($link, "SELECT * FROM TBL_EmpresaCargo");
$sql2 = mysqli_query($link, "SELECT * FROM TBL_EmpresaArea");
$sql3 = mysqli_query($link, "SELECT * FROM TBL_EmpresaCC");
$SQL_Sucursal = mysqli_query($link, "SELECT * FROM TBL_Sucursal");
$SQL_TipoUsuario = mysqli_query($link, "SELECT * FROM TBL_UsuarioTipo");
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
											<form class="form-horizontal form-label-left" action="mant_usuarios_res.php" method="get">

												<div class="row">
													<div class="form-group col-md-2">
														<label>Rut</label>
														<input type="text" class="form-control" name="UsrRut" <?php echo $RO;?> value="<?php echo $user_rut?>" >
													</div>
													<div class="form-group col-md-4">
														<label>Nombre</label>
														<input type="text" class="form-control" name="UsrNombre" value="<?php echo $user_nombre;?>" >
													</div>
													<div class="form-group col-md-3">
														<label>Apellido Paterno</label>
														<input type="text" class="form-control" name="UsrApPat" value="<?php echo $user_ap_pat;?>">
													</div>
													<div class="form-group col-md-3">
														<label>Apellido Materno</label>
														<input type="text" class="form-control" name="UsrApMat" value="<?php echo $user_ap_mat;?>" >
													</div>
												</div>

												<div class="row">
													<div class="form-group col-md-6">
														<label>Email</label>
														<input type="email" name="UsrEmail" class="form-control" value="<?php echo $user_email; ?>" >
													</div>

													<div class="form-group col-md-2">
														<label>Telefono fijo</label>
														<input type="number" class="form-control" name="UsrTel" value="<?php echo $user_tel_fijo;?>" >
													</div>
													<div class="form-group col-md-2">
														<label>Celular</label>
														<input type="number" class="form-control" name="UsrCell" value="<?php echo $user_tel_movil;?>" >
													</div>
													<div class="form-group col-md-2">
														<label>Sucursal</label>
														<select class="form-control" required="required" id="UsrSuc" name="UsrSuc">
															<option value="">-- Seleccione Sucursal --</option>
															<?php
															while($row1 = mysqli_fetch_assoc($SQL_Sucursal)){?>
																<option value="<?php echo $row1['id_sucursal']?>"><?php echo $row1['nombre_sucursal']?></option>
															<?php
															} ?>
														</select>
													</div>
												</div>

												<div class="row">
													<div class="form-group col-md-3">
														<label>Tipo Usuario</label>
														<select class="form-control" required="required" id="tipo" name="UsrTipo">
															<option value="">-- Seleccione Tipo --</option>
															<?php
															while($row2 = mysqli_fetch_assoc($SQL_TipoUsuario)){?>
																<option value="<?php echo $row2['id_tipo_usuario']?>"><?php echo $row2['nombre_tipo_usuario']?></option>
																<?php
															} ?>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label>Cargo</label>
														<select class="form-control" required="required" id="UsrCargo" name="UsrCargo">
															<option value="">-- Seleccione Cargo --</option>
															<?php
															while($row1 = mysqli_fetch_assoc($sql1)){?>
																<option value="<?php echo $row1['id_cargo_empresa']?>"><?php echo $row1['nombre_cargo_empresa']?></option>
															<?php
															} ?>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label>Area</label>
														<select class="form-control" required="required" id="UsrArea" name="UsrArea">
															<option value="">-- Seleccione Area --</option>
															<?php
															while($row2 = mysqli_fetch_assoc($sql2)){?>
																<option value="<?php echo $row2['id_area_empresa']?>"><?php echo $row2['nombre_area_empresa']?></option>
																<?php
															} ?>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label>Centro de Costo</label>
														<select class="form-control" required="required" id="UsrCC" name="UsrCC">
															<option value="">-- Seleccione C. Costo --</option>
															<?php
															while($row3 = mysqli_fetch_assoc($sql3)){?>
																<option value="<?php echo $row3['id_centro_costo']?>"><?php echo $row3['nombre_centro_costo']?></option>
																<?php
															} ?>
														</select>
													</div>
												</div>
											</div>

									  	<div class="ln_solid"></div>
											<div class="x-content" style="text-align:right;">
													<input type="hidden" name="opt" value="<?php echo $Opt?>">
													<button type="button" class="btn btn-danger" onClick="location.href='mant_usuarios.php'" >Cancelar</button>
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
