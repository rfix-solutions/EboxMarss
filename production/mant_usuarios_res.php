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

$U_Rut = $_GET['UsrRut'];
$U_Nombre = strtolower($_GET['UsrNombre']);
$U_ApPat = strtolower($_GET['UsrApPat']);
$U_ApMat = strtolower($_GET['UsrApMat']);
$U_Email = strtolower($_GET['UsrEmail']);
$U_Tel = $_GET['UsrTel'];
$U_Cell = $_GET['UsrCell'];
$U_Tipo = $_GET['UsrTipo'];
$U_Cargo = $_GET['UsrCargo'];
$U_Area = $_GET['UsrArea'];
$U_CC = $_GET['UsrCC'];
$U_Suc = $_GET['UsrSuc'];

$U_Sigla = $U_Nombre[0].$U_ApPat[0].$U_ApMat[0];
$Opt = $_GET['opt'];
switch ($Opt) {
  case '0':
  $Qry = "
	  INSERT INTO TBL_Usuario
	  (
			rut_usuario,
			password,
			nombre_usuario,
			apellido_paterno,
			apellido_materno,
			telefono_fijo_usuario,
			telefono_movil_usuario,
			email_usuario,
			id_tipo_usuario,
			id_sucursal,
			id_area_empresa,
			id_cargo_empresa,
			id_centro_costo,
			sigla_usuario,
			UsuarioEstado
			)
	  VALUES
	  (
			'".$U_Rut."',
			'".$U_Rut."',
			'".$U_Nombre."',
			'".$U_ApPat."',
			'".$U_ApMat."',
			'".$U_Tel."',
			'".$U_Cell."',
			'".$U_Email."',
			'".$U_Tipo."',
			'".$U_Suc."',
			'".$U_Area."',
			'".$U_Cargo."',
			'".$U_CC."',
			'".$U_Sigla."',
			'1'
		)
  ";
  break;
  case '1': // EDITAR

	$Qry = "
	  UPDATE TBL_Usuario
	  SET
			password = '".$U_Rut."',
			nombre_usuario = '".$U_Nombre."',
			apellido_paterno = '".$U_ApPat."',
			apellido_materno = '".$U_ApMat."',
			telefono_fijo_usuario = '".$U_Tel."',
			telefono_movil_usuario = '".$U_Cell."',
			email_usuario = '".$U_Email."',
			id_tipo_usuario = '".$U_Tipo."',
			id_sucursal = '".$U_Suc."',
			id_area_empresa = '".$U_Area."',
			id_cargo_empresa = '".$U_Cargo."',
			id_centro_costo = '".$U_CC."',
			sigla_usuario = '".$U_Sigla."'
		WHERE
			rut_usuario = '".$U_Rut."'
  ";

  break;
  case '2':// INACTIVAR
	$Qry = "
	  UPDATE TBL_Usuario
	  SET
			UsuarioEstado = '".$_GET['e']."'
		WHERE
			id_usuario = '".$_GET['id']."'
  ";
  break;

  default:
  // code...
  break;
}

$Sql_User = mysqli_query($link, $Qry) or die ("Existe error en Qry :</br>".$Qry);;
if($Sql_User){
	$Msg = "El registro ha sido realizado con &eacute;xito";
	$Btn = "location.href='mant_usuarios.php'";
}
else{
	$Msg = "Existen problemas en el registro. Intente nuevamente";
	$Btn = "location.href='history.back();'";
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
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
	<body class="nav-md">
		<div class="container body">

			<div class="modal fade" id="mensaje" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							<h4 class="modal-title" id="myModalLabel2">Mensaje</h4>
						</div>
						<div class="modal-body" style="text-align:center;">
							<h4><?php echo $Msg;?></h4>

						</div>
						<div class="modal-footer" style="text-align:center;">
							<button type="button" class="btn btn-success" onclick="<?php echo $Btn;?>">Aceptar</button>
						</div>
					</div>
				</div>
			</div>

		</div>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../build/js/custom.min.js"></script>
		<script>
			$(window).load(function(){
						 $('#mensaje').modal('show');
				 });
		</script>
	</body>
