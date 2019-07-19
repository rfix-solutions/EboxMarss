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



$CliOpt = $_GET['opt'];
$CliId = $_GET['id'];
$CliRut = $_GET['CliRut'];
$CliRazonSocial = $_GET['CliRazonSocial'];
$CliNombreFant = $_GET['CliNombreFant'];
$CliDireccion = $_GET['CliDireccion'];
$CliContacto = $_GET['CliContacto'];
$CliEmail = $_GET['CliEmail'];
$CliTel = $_GET['CliTel'];
$CliPerPago = $_GET['CliPerPago'];
$CliForPago = $_GET['CliForPago'];
$CliEstado = $_GET['CliEstado'];
$CliLibre = $_GET['CliLibre'];
print("<pre>");

switch($_GET['opt']){
  case "0":
		$h3_text = "Se ha ingresado el Cliente con éxito";
		$Qry = "
		INSERT INTO TBL_Cliente
			(
				rut_cliente,
				nombre_cliente,
				razon_social,
				direccion_cliente,
				contacto_cliente,
				telefono_cliente,
				email_cliente,
				tarifado,
				id_periodo_pago_cli,
				id_forma_pago_cli,
				libre_envio,
				id_estado_cliente
			)
		VALUES
			(
				'".$CliRut."',
				'".$CliNombreFant."',
				'".$CliRazonSocial."',
				'".$CliDireccion."',
				'".$CliContacto."',
				'".$CliTel."',
				'".$CliEmail."',
				'1',
				'".$CliPerPago."',
				'".$CliForPago."',
				'".$CliLibre."',
				'".$CliEstado."'
			)
		";

	  break;
  case "1":

		$h3_text = "El cliente ha sido actualizado con éxito";

		$Qry = "
			UPDATE
				TBL_Cliente
			SET
				nombre_cliente = '".$CliNombreFant."',
				razon_social = '".$CliRazonSocial."',
				direccion_cliente = '".$CliDireccion."',
				contacto_cliente = '".$CliContacto."',
				telefono_cliente = '".$CliTel."',
				email_cliente = '".$CliEmail."',
				tarifado = '1',
				id_periodo_pago_cli = '".$CliPerPago."',
				id_forma_pago_cli = '".$CliForPago."',
				libre_envio = '".$CliLibre."',
				id_estado_cliente = '".$CliEstado."'
			WHERE
				id_cliente = '".$CliId."'
		";


	  break;
  default:  $h3_text = "Opción Incorrecta";
}
;


 $Sql = mysqli_query($link, $Qry) or die('Error en Qry: '.mysqli_error($link));;
print("/<pre>");
if(!$Sql){
	$h3_text = "Error en el registro. Intente nuevamente.";
}

?>
<script type="text/javascript">
	alert("<?php echo $h3_text?>")
	location.href="mant_clientes.php";
</script>
