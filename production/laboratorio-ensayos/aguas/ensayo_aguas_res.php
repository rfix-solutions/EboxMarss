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
		location.href="../../../login/index.php?url=<?php echo $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];?>";
	</script>
<?php
		exit;
}
include '../../_qry/db_connect_local.php';

//printf("<pre>");


$TotalEnsayos_Qry = "SELECT MAX(id_ensayo_item) AS TOTAL_ENSAYOS FROM TBL_EnsayoItem";
$TotalEnsayos_Sql = mysqli_query($link, $TotalEnsayos_Qry) or die ("Error en QRY Total Ensayos: ". mysqli_error($link));;

while($TotalEnsayos_Data = mysqli_fetch_assoc($TotalEnsayos_Sql)){ $TotalEnsayos_Q = $TotalEnsayos_Data['TOTAL_ENSAYOS']; }

for($i = 1; $i<=$TotalEnsayos_Q; $i++){
	$NameVar = "EnsayoItem".$i;
	if(isset($_GET[$NameVar])){
		$QryEnsayoItem = "
      INSERT INTO TBL_EnsayoDetalleItem
      (EnsayoDetalleItem_IdEnsayoItem, EnsayoDetalleItem_ValorEnsayoItem, EnsayoDetalleItem_IdSolicitudSS, EnsayoDetalleItem_FechaOperacion)
      VALUES
      ('".$i."', '".$_GET[$NameVar]."', '".$_GET['NS']."', '".date('Y-m-d H:i:s')."')
    ";
		$SqlEnsayoItem = mysqli_query($link, $QryEnsayoItem) or die ("Error en QRY Ensayo Item ".$i.": ".mysqli_error($link));;
	}
}





$sql_total_ensayos = mysqli_query($link, "SELECT MAX(id_ensayo) AS MAYOR FROM TBL_Ensayo");
while($max = mysqli_fetch_assoc($sql_total_ensayos)){ $total_ensayos = $max['MAYOR']; }
for($i=1; $i<=$total_ensayos; $i++){
	if(isset($_GET["fecha_ensayo_".$i])){
		$fecha_ensayo = $_GET["fecha_ensayo_".$i];
		$QryFechaEnsayo = "
		INSERT INTO TBL_EnsayoDetalleFecha
		(EnsayoDetalleFecha_IdEnsayoItem, EnsayoDetalleFecha_IdSolicitudSS, EnsayoDetalleFecha_FechaEnsayo, EnsayoDetalleFecha_FechaOperacion)
		VALUES
		('".$i."', '".$_GET['NS']."', '".$fecha_ensayo."', '".date('Y-m-d H:i:s')."')
		";
		$SqlFechaEnsayo = mysqli_query($link, $QryFechaEnsayo) or die ("Error en QRY Fecha Ensayo: ".mysqli_error($link));;
	}
}

$QryObs = "
	INSERT INTO TBL_EnsayoDetalleObs
		(EnsayoDetalleObs_IdSolicitudSS, EnsayoDetalleObs_Obs, EnsayoDetalleObs_FechaOperacion)
	VALUES
		('".$_GET['NS']."', '".$_GET['observaciones']."', '".date('Y-m-d H:i:s')."')
";

$QrySS = "
	UPDATE
		TBL_FormSS
	SET
		estadoSS = '1'
	WHERE
		id_form_solicitud_servicio = '".$_GET['NS']."'

";

$QryInf = "
	UPDATE TBL_Informe
	SET Informe_Estado = '2', Informe_FechaEdicion = '".date("Y-m-d H:i:s")."'
	WHERE
		Informe_Tipo = '".$_GET['TE']."' AND
		Informe_IdFormSS = '".$_GET['NS']."'
";
$SqlSS = mysqli_query($link, $QrySS) or die ("Error en QRY SS: ".mysqli_error($link));;
$SqlObs = mysqli_query($link, $QryObs) or die ("Error en QRY Obs: ".mysqli_error($link));;
$SqlInf = mysqli_query($link, $QryInf) or die ("Error en QRY Inf: ".mysqli_error($link));;

//printf("</pre>");

?>
<script type="text/javascript">
	alert("Los datos han sido ingresados con éxito.")
  location.href="../../laboratorio_sala_aguas.php";
</script>
<?php
?>
