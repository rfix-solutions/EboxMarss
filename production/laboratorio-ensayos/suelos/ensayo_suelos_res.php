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
		location.href="../../login/index.php?url=<?php echo $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];?>";
	</script>
<?php
		exit;
}
include '../_qry/db_connect_local.php';

//printf("<pre>");

$sql_total = mysqli_query($link, "SELECT MAX(id_ensayo_item) AS MAYOR FROM TBL_EnsayoItem");
while($max = mysqli_fetch_assoc($sql_total)){ $total = $max['MAYOR']; }
for($i=1; $i<=$total; $i++){
  if($_GET[$i]!=""){
    $valor_ensayo = $_GET[$i];
		$QryItemSuelos = "
      INSERT INTO TBL_EnsayoDetalleItem
      (EnsayoDetalleItem_IdEnsayoItem, EnsayoDetalleItem_ValorEnsayoItem, EnsayoDetalleItem_IdSolicitud, EnsayoDetalleItem_FechaOperacion)
      VALUES
      ('".$i."', '".$valor_ensayo."', '".$_GET['NS']."', '".date('Y-m-d H:i:s')."')
    ";
    $SqlItemSuelos = mysqli_query($link, $QryItemSuelos) or die ("Error en la query $i".mysqli_error());;
  }
}
//printf("</pre>");



$sql_total_ensayos = mysqli_query($link, "SELECT MAX(id_ensayo) AS MAYOR FROM TBL_Ensayo");
while($max = mysqli_fetch_assoc($sql_total_ensayos)){ $total_ensayos = $max['MAYOR']; }
for($i=1; $i<=$total_ensayos; $i++){
	if(isset($_GET["fecha_ensayo_".$i])){
		$fecha_ensayo = $_GET["fecha_ensayo_".$i];
		$QryFechaEnsayo = "
		INSERT INTO TBL_EnsayoDetalleFecha
		(EnsayoDetalleFecha_IdEnsayoItem, EnsayoDetalleFecha_IdSolicitud, EnsayoDetalleFecha_FechaEnsayo, EnsayoDetalleFecha_FechaOperacion)
		VALUES
		('".$i."', '".$_GET['NS']."', '".$fecha_ensayo."', '".date('Y-m-d H:i:s')."')
		";
		$SqlFechaEnsayo = mysqli_query($link, $QryFechaEnsayo);
	}
}

$QryObs = "
	INSERT INTO TBL_EnsayoDetalleObs
		(EnsayoDetalleObs_IdSolicitud, EnsayoDetalleObs_Obs, EnsayoDetalleObs_FechaOperacion)
	VALUES
		('".$_GET['NS']."', '".$_GET['observaciones']."', '".date('Y-m-d H:i:s')."')
";
//printf("</pre>");

$QryInf = "
	UPDATE TBL_Informe
	SET Informe_Estado = '2', Informe_FechaEdicion = '".date("Y-m-d H:i:s")."'
	WHERE
		Informe_Tipo = '".$_GET['TE']."' AND
		Informe_IdFormSS = '".$_GET['NS']."'
";
$SqlObs = mysqli_query($link, $QryObs);
$SqlInf = mysqli_query($link, $QryInf);
?>
<script type="text/javascript">
	alert("Los datos han sido ingresados con éxito.")
  location.href="../../laboratorio_sala_suelos.php";
</script>
