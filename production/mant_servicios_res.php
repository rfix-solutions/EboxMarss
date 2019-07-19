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


/*
echo "OPT: ".$_GET['opt']."<br>";
echo "ID: ".$_GET['ids']."<br>";
echo "Tipo: ".$_GET['tipo_ensayo']."<br>";
echo "Nombre: ".$_GET['nombre_ensayo']."<br>";
echo "Precio:".$_GET['precio_ensayo']."<br>";
echo "Norma: ".$_GET['norma_ensayo']."<br>";
echo "Estado".$_GET['estado_ensayo']."<br>";
*/


switch($_GET['opt']){
  case "0": $h3_text = "Se ha insertado el registro con éxito";

		$qry = "
		INSERT INTO TBL_Ensayo
		(id_tipo_ensayo, nombre_ensayo, id_norma_ensayo, id_estado_acreditado, precio)
		VALUES
		('".$_GET['tipo_ensayo']."', '".$_GET['nombre_ensayo']."', '".$_GET['norma_ensayo']."', '".$_GET['estado_ensayo']."', '".$_GET['precio_ensayo']."')";

	  break;
  case "1": $h3_text = "Se ha actualizado el registro con éxito";
		$qry = "
		UPDATE TBL_Ensayo
		SET
			id_tipo_ensayo ='".$_GET['tipo_ensayo']."',
			nombre_ensayo = '".$_GET['nombre_ensayo']."',
			id_norma_ensayo = '".$_GET['norma_ensayo']."',
			id_estado_acreditado = '".$_GET['estado_ensayo']."',
			precio = '".$_GET['precio_ensayo']."'
		WHERE id_ensayo = '".$_GET['ids']."'";


	  break;
  case "2": $h3_text = "Eliminar Ensayo";
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
	location.href="https://www.ebox.cl/production/mant_servicios.php";
</script>
