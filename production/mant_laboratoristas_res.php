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


$LabId = $_GET['id'];
$LabOpt = $_GET['opt'];



switch($_GET['opt']){
  case "0":
		$h3_text = "Se ha ingresado el laboratorista con éxito";
		$LabNombre = $_GET['Lab_Nombre'];
		$LabEstado = $_GET['Lab_Estado'];

		$Qry = "
		INSERT INTO TBL_Laboratorista
		(nombre_laboratorista, LaboratoristaEstado)
		VALUES
		('".$LabNombre."', '".$LabEstado."')";

	  break;
  case "1":

		$h3_text = "Se ha actualizado el laboratorista con éxito";
		$LabNombre = $_GET['Lab_Nombre'];
		$LabEstado = $_GET['Lab_Estado'];

		$Qry = "
			UPDATE TBL_Laboratorista
			SET LaboratoristaEstado = '".$LabEstado."' AND nombre_laboratorista = '".$LabNombre."'
			WHERE id_laboratorista = '".$LabId."'
		";


	  break;
  case "2":
		$LabEstado = $_GET['estado'];
		$h3_text = "Se ha actualizado el laboratorista con éxito";
		$Qry = "
			UPDATE TBL_Laboratorista
			SET LaboratoristaEstado = '".$LabEstado."'
			WHERE id_laboratorista = '".$LabId."'
		";
	  break;
  default:  $h3_text = "Opción Incorrecta";
}


$Sql = mysqli_query($link, $Qry) or die('Error en Qry: '.mysqli_error());;

if(!$Sql){
	$h3_text = "Error en el registro. Intente nuevamente.";
}
?>
<script type="text/javascript">
	alert("<?php echo $h3_text?>")
	location.href="mant_laboratoristas.php";
</script>
