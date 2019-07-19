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
$_SESSION['id_user'];
/*
	echo $_SESSION['id_user']."</br>";
  echo $_GET['id_cotizacion']."</br>";
  echo $_GET['detalle_actividad_cotizacion']."</br>";
*/
  $hoy =  date("Y-m-d H:i:s");


$query_tbl_historial_cotizacion ="
INSERT INTO TBL_CotizacionGestion
(id_cotizacion, detalle_historial_cotizacion, fecha_historial_cotizacion, id_usuario)
VALUES
('".$_GET['id_cotizacion']."', '".$_GET['detalle_actividad_cotizacion']."', '".$hoy."', '".$_SESSION['id_user']."')
";

$insert_tbl_historial_cotizacion = mysqli_query($link, $query_tbl_historial_cotizacion) or die('Insert fallido: '.mysqli_error());;
if($insert_tbl_historial_cotizacion){?>
  <script type="text/javascript">
    alert("Registro realizado con éxito.")
    location.href="/production/comercial_detalle.php?id=<?php echo $_GET['id_cotizacion'];?>";
  </script>
<?php
}
?>
