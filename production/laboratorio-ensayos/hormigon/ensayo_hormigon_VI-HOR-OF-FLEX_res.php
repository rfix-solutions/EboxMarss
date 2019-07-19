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



$VI_Obs			= $_GET['VI_observaciones'];
$NS					= $_GET['NS'];
$TE					= $_GET['TE'];
$Txt 				= "EnsayoItem";

$sql_total = mysqli_query($link, "SELECT MAX(id_ensayo_item) AS MAYOR FROM TBL_EnsayoItem");
while($max = mysqli_fetch_assoc($sql_total)){ $total = $max['MAYOR']; }
for($i=1; $i<=$total; $i++){
  if(isset($_GET[$Txt.$i])){
    $valor_ensayo = $_GET[$Txt.$i];
		$QryItemHormigon = "
      INSERT INTO TBL_EnsayoDetalleItem
      (EnsayoDetalleItem_IdEnsayoItem, EnsayoDetalleItem_ValorEnsayoItem, EnsayoDetalleItem_IdSolicitudHM, EnsayoDetalleItem_FechaOperacion)
      VALUES
      ('".$i."', '".$valor_ensayo."', '".$_GET['NS']."', '".date('Y-m-d H:i:s')."')
    ";
    $SqlItemHormigon = mysqli_query($link, $QryItemHormigon);
  }
}


$sql_total_ensayos = mysqli_query($link, "SELECT MAX(id_ensayo) AS MAYOR FROM TBL_Ensayo");
while($max = mysqli_fetch_assoc($sql_total_ensayos)){ $total_ensayos = $max['MAYOR']; }
for($i=1; $i<=$total_ensayos; $i++){
	if(isset($_GET["fecha_ensayo_".$i])){
		$fecha_ensayo = $_GET["fecha_ensayo_".$i];
		$QryFechaEnsayo = "
		INSERT INTO TBL_EnsayoDetalleFecha
		(EnsayoDetalleFecha_IdEnsayoItem, EnsayoDetalleFecha_IdSolicitudHM, EnsayoDetalleFecha_NMuestra, EnsayoDetalleFecha_FechaEnsayo, EnsayoDetalleFecha_FechaOperacion)
		VALUES
		('".$i."', '".$_GET['NS']."', '1', '".$fecha_ensayo."', '".date('Y-m-d H:i:s')."')
		";
		$SqlFechaEnsayo = mysqli_query($link, $QryFechaEnsayo);
	}
}

$QryObs = "
	INSERT INTO TBL_EnsayoDetalleObs
		(EnsayoDetalleObs_IdSolicitudHM, EnsayoDetalleObs_Obs, EnsayoDetalleObs_FechaOperacion)
	VALUES
		('".$_GET['NS']."', '".$_GET['observaciones']."', '".date('Y-m-d H:i:s')."')
";
$SqlObs = mysqli_query($link, $QryObs) or die ("Error en Insert Observaciones " . mysqli_error($link));;

$QryEnsayo = "
	SELECT
		id_tipo_ensayo AS ID_TIPO_ENSAYO
	FROM
		TBL_EnsayoTipo
	WHERE
		nombre_tipo_ensayo like '%".$_GET['TE']."%'
";
$SqlEnsayo = mysqli_query($link, $QryEnsayo) or die ("Error en QRY ENSAYO". mysqli_error($link));;
while($DataEnsayo = mysqli_fetch_assoc($SqlEnsayo)){ $IdTipoEnsayo = $DataEnsayo['ID_TIPO_ENSAYO'];}


$QryInf = "
	UPDATE TBL_Informe
	SET Informe_Estado = '2', Informe_FechaEdicion = '".date("Y-m-d H:i:s")."'
	WHERE
		Informe_Tipo = '".$IdTipoEnsayo."' AND
		Informe_IdFormCH = '".$_GET['NS']."'
";
$SqlInf = mysqli_query($link, $QryInf) or die ("Error en Insert Informe " . mysqli_error($link));;

$UpdateEstadoMuestra_Qry = "
	UPDATE TBL_FormHMDet
	SET estado = '1'
	WHERE
		id_form_c_h_m = '".$_GET['NS']."'
";
$UpdateEstadoMuestra_Sql = mysqli_query($link, $UpdateEstadoMuestra_Qry) or die ("Error en Update Muestra: ".mysqli_error($link));;
?>
<script type="text/javascript">
	alert("Los datos han sido ingresados con éxito.")
  location.href="../../laboratorio_sala_hormigon.php";
</script>
<?php
//printf("</pre>");
?>
