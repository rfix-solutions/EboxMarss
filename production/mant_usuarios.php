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

$SqlUsr = mysqli_query($link, "
SELECT
		U.id_usuario,
		U.rut_usuario,
		U.nombre_usuario,
		U.apellido_paterno,
		U.apellido_materno,
		U.telefono_fijo_usuario,
		U.telefono_movil_usuario,
		U.email_usuario,
		U.id_cargo_empresa,
		U.sigla_usuario,
		U.UsuarioEstado,
        T.nombre_tipo_usuario,
        S.codigo_sucursal as nombre_sucursal,
        A.codigo_area_empresa as nombre_area_empresa,
        C.nombre_cargo_empresa as cargo_usuario,
        CC.nombre_centro_costo

	FROM
		TBL_Usuario U, TBL_UsuarioTipo T, TBL_Sucursal S, TBL_EmpresaArea A, TBL_EmpresaCargo C, TBL_EmpresaCC CC
	WHERE
     U.id_tipo_usuario = T.id_tipo_usuario AND
     U.id_sucursal = S.id_sucursal AND
     U.id_area_empresa = A.id_area_empresa AND
     U.id_cargo_empresa = C.id_cargo_empresa AND
     U.id_centro_costo = CC.id_centro_costo
") or die('Error en Sql '.$SqlUsr);;

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
                <h3>Usuarios</h3>
									<button type="button" onclick="location.href='mant_usuarios_opt.php?opt=0&id=0'" class="btn btn-xs btn-default">
										<i class="fa fa-plus"></i> Agregar Usuario
									</button>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
										<table id="datatable" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                    	<thead>
                        <tr>
                        	<th>ID</th>
													<th>Rut</th>
                        	<th>Nombre</th>
													<th>Ap. Paterno</th>
													<th>Ap. Materno</th>
													<th>Email</th>
													<th>Tipo Usuario</th>
													<th>Opciones</th>
													<th>Tel. Fijo</th>
													<th>Tel. Movil</th>
													<th>Sucursal</th>
													<th>Area</th>
													<th>Cargo</th>
													<th>C. Costo</th>
                        </tr>
											</thead>
					  					<tbody>
											<?php
											while($row = mysqli_fetch_assoc($SqlUsr)){
											?>
											<tr>
                      	<td><?php echo $row['id_usuario'];?></td>
												<td><?php echo $row['rut_usuario'];?></td>
												<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;">
													<?php
														  $nombre_serv = utf8_encode($row['nombre_usuario']);
														  echo ucwords(utf8_decode($nombre_serv));
													?>
												</td>
												<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;">
													<?php
														  $nombre_serv = utf8_encode($row['apellido_paterno']);
														  echo ucwords(utf8_decode($nombre_serv));
													?>
												</td>
												<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;">
													<?php
														  $nombre_serv = utf8_encode($row['apellido_materno']);
														  echo ucwords(utf8_decode($nombre_serv));
													?>
												</td>
												<td><?php echo $row['email_usuario'];?></td>
												<td><?php echo $row['nombre_tipo_usuario'];?></td>
												<td style="max-width: 150px;">
													<button type="button" onclick="location.href='perfil.php?opt=1&id=<?php echo $row['id_usuario'];?>'" class="btn btn-xs btn-default">
														<i class="fa fa-edit"></i> Editar
													</button>
													<?php
													if($row['UsuarioEstado']==1){
														$txt = "Inactivar"; $class = "danger"; $estado = 0;
													}else{
														$txt = "Activar"; $class = "success"; $estado = 1;
													}?>
													<button type="button" onclick="location.href='mant_usuarios_res.php?opt=2&id=<?php echo $row['id_usuario'];?>&e=<?php echo $estado;?>'" class="btn btn-xs btn-<?php echo $class;?>">
													<i class="fa fa-ban"></i> <?php echo $txt;?>
													</button>
												</td>
												<td><?php echo $row['telefono_fijo_usuario'];?></td>
												<td><?php echo $row['telefono_movil_usuario'];?></td>
												<td><?php echo $row['nombre_sucursal'];?></td>
												<td><?php echo $row['nombre_area_empresa'];?></td>
												<td><?php echo $row['cargo_usuario'];?></td>
												<td><?php echo $row['nombre_centro_costo'];?></td>

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
