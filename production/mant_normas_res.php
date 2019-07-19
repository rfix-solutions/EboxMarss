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




switch($_GET['opt']){
  case "0": $h3_text = "Se ha insertado el registro con éxito";

		$qry = "
		INSERT INTO TBL_EnsayoNorma
		(nombre_norma_ensayo)
		VALUES
		('".$_GET['nombre_norma_ensayo']."')";

	  break;
  case "1": $h3_text = "Se ha actualizado el registro con éxito";
		$qry = "
		UPDATE TBL_EnsayoNorma
		SET
			nombre_norma_ensayo = '".$_GET['nombre_norma_ensayo']."'
		WHERE id_norma_ensayo = '".$_GET['ids']."'";


	  break;
  case "2": $h3_text = "Eliminar Norma";
	  break;
  default:  $h3_text = "Opción Incorrecta";
}

$SQL = mysqli_query($link, $qry) or die('Consulta fallida: '.mysql_error());;

if(!$SQL){
	$h3_text = "Error en el registro. Intente nuevamente.";
}
?>
<script type="text/javascript">
	alert("<?php echo $h3_text?>")
	location.href="mant_normas.php";
</script>
