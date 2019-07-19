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

$Or = $_GET['O'];
if($Or == 1){
	$btn = "Javascript:history.back();";
}
else{
	$btn = "location.href='mant_usuarios.php'";
}
$user = $_GET['id'];
$query = mysqli_query($link, "SELECT * FROM TBL_Usuario WHERE id_usuario = '".$user."'");
while($res_query = mysqli_fetch_assoc($query)){
	$nombre_usuario = $res_query['nombre_usuario'];
	$apellido_paterno = $res_query['apellido_paterno'];
	$apellido_materno = $res_query['apellido_materno'];
	$email = $res_query['email_usuario'];
	$tel_fijo = $res_query['telefono_fijo_usuario'];
	$tel_cel = $res_query['telefono_movil_usuario'];
	$firma = $res_query['UsuarioSignature'];
	$avatar = $res_query['UsuarioAvatar'];
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

	<title>.: EBOX PLATFORM :.</title>

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
                <h3>Perfil de Usuario</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
							<div class="x_panel">
								<div class="x_content">
									<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
										<h4>Avatar de Usuario</h4>
                    <div class="profile_img">
                      <div id="crop-avatar">
                        <img class="img-responsive avatar-view" src="images/profile/<?php echo $avatar?>" alt="Avatar" title="avatar">
                      </div>
                    </div>
										<button type="button" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#ActualizaAvatar">Actualizar Imagen</button>

										<div class="ln_solid"></div>

                    <h4>Firma para informes</h4>
										<div class="profile_img">
                      <div id="crop-avatar">
                        <img class="img-responsive avatar-view" src="images/signature/<?php echo $firma?>" alt="Avatar" title="1">
                      </div>
                    </div>
										<button type="button" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#ActualizaFirma">Actualizar firma</button>


										<div class="modal fade" id="ActualizaAvatar" tabindex="-1" role="dialog" aria-labelledby="actualizaimagen" aria-hidden="true">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="ActualizaAvatarLabel">Actualizar Imagen de Perfil</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
													<form action="mant_usuarios_img.php" method="post" enctype="multipart/form-data">
														<input type="hidden" name="ImgType" value="1">
														<input type="hidden" name="User" value="<?php echo $_GET['id'];?>">
											      <div class="modal-body">
	            									<input type="file" name="archivo" id="archivo">
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
															<input type="submit" class="btn btn-success" value="Aceptar">
											      </div>
													</form>
										    </div>
										  </div>
										</div>


										<div class="modal fade" id="ActualizaFirma" tabindex="-1" role="dialog" aria-labelledby="actualizaimagen" aria-hidden="true">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="ActualizaFirmaLabel">Actualizar Firma para informes</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
													<form action="mant_usuarios_img.php" method="post" enctype="multipart/form-data">
														<input type="hidden" name="ImgType" value="2">
														<input type="hidden" name="User" value="<?php echo $_GET['id'];?>">
											      <div class="modal-body">
	            									<input type="file" name="archivo" id="archivo">
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
															<input type="submit" class="btn btn-success" value="Aceptar">
											      </div>
													</form>
										    </div>
										  </div>
										</div>



									</div>
									<div class="col-md-9 col-sm-9 col-xs-9">
										<div class="x_content">
											<div class="col-md-12 center-margin">
												<form class="form-horizontal form-label-left">
													<div class="form-group col-md-12">
														<label>Rut</label>
														<input type="text" class="form-control" readonly="readonly" placeholder="16456857-1" name="rut" >
													</div>
													<div class="form-group col-md-4">
														<label>Nombre</label>
														<input type="text" class="form-control" name="nombre" value="<?php echo $nombre_usuario;?>" >
													</div>
													<div class="form-group col-md-4">
														<label>Apellido Paterno</label>
														<input type="text" class="form-control" name="apellido_pat" value="<?php echo $apellido_paterno;?>">
													</div>
													<div class="form-group col-md-4">
														<label>Apellido Materno</label>
														<input type="text" class="form-control" name="apellido_pat" value="<?php echo $apellido_materno;?>" >
													</div>

													<div class="form-group col-md-6">
														<label>Email</label>
														<input type="email" name="email" class="form-control" value="<?php echo $email; ?>" >
													</div>
													<div class="form-group col-md-6">
														<label>Password</label>
														<input type="password" class="form-control" >
													</div>
													<div class="form-group col-md-6">
														<label>Telefono fijo</label>
														<input type="text" class="form-control" name="telefono" value="<?php echo $tel_fijo;?>" >
													</div>
													<div class="form-group col-md-6">
                        		<label>Celular</label>
														<input type="text" class="form-control" name="celular" value="<?php echo $tel_cel;?>" >
													</div>
													<div class="form-group col-md-3">
														<label>Tipo Usuario</label>
														<select class="form-control" required="required" id="tipo_usuario" name="tipo_usuario">
															<option value="">-- Seleccione Tipo --</option>
															<option value="1">Super Usuario</option>
															<option value="2">Administrador</option>
															<option value="3">Usuario</option>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label>Cargo</label>
														<select class="form-control" required="required" id="cargo" name="cargo">
															<option value="">-- Seleccione Cargo --</option>
															<?php
															$sql1 = mysqli_query($link, "SELECT * FROM TBL_EmpresaCargo") or die ("Error en Cargo ".mysqli_error($link));;
															while($row1 = mysqli_fetch_assoc($sql1)){?>
																<option value="<?php echo $row1['id_cargo_empresa']?>"><?php echo $row1['nombre_cargo_empresa']?></option>
																<?php
															}
															?>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label>Area</label>
														<select class="form-control" required="required" id="area" name="area">
															<option value="">-- Seleccione Area --</option>
															<?php
															$sql2 = mysqli_query($link, "SELECT * FROM TBL_EmpresaArea") or die ("Error en Cargo ".mysqli_error($link));;
															while($row2 = mysqli_fetch_assoc($sql2)){?>
																<option value="<?php echo $row2['id_area_empresa']?>"><?php echo $row2['nombre_area_empresa']?></option>
																<?php
															}
															?>
														</select>
													</div>
													<div class="form-group col-md-3">
														<label>Centro de Costo</label>
														<select class="form-control" required="required" id="ccosto" name="centro_costo">
															<option value="">-- Seleccione C. Costo --</option>
															<?php
															$sql3 = mysqli_query($link, "SELECT * FROM TBL_EmpresaCC") or die ("Error en Cargo ".mysqli_error($link));;
															while($row3 = mysqli_fetch_assoc($sql3)){?>
																<option value="<?php echo $row3['id_centro_costo']?>"><?php echo $row3['nombre_centro_costo']?></option>
																<?php
															}
															?>
														</select>
													</div>
												</div>
												<div class="ln_solid"></div>
                    		<div class="form-group">
                    			<div class="col-md-12 col-sm-12 col-xs-12">
                      			<button type="button" onClick="<?php echo $btn;?>" class="btn btn-primary">Cancelar</button>
                       			<button type="submit" class="btn btn-success">Aceptar</button>
													</div>
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
		//include 'footer.php';
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
  </body>
</html>
