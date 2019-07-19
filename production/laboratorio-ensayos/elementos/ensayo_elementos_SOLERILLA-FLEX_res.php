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

$TotalEnsayos_Qry = "SELECT count(*) AS TOTAL_ENSAYOS FROM TBL_EnsayoItem";
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

if(isset($_GET['observaciones_EL'])){
	if($_GET['observaciones_EL'] == "" || $_GET['observaciones_EL'] == null){
		$EnsayoItemObs = "Sin Observaciones";
	}
	else {
		$EnsayoItemObs = $_GET['observaciones_EL'];
	}
}else {
	$EnsayoItemObs = "Sin Observaciones";
}

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
	UPDATE
		TBL_Informe
	SET
		Informe_Estado = '2', Informe_FechaEdicion = '".date("Y-m-d H:i:s")."'
	WHERE
		Informe_Tipo = '".$IdTipoEnsayo."' AND
		Informe_IdFormCH = '".$_GET['NS']."'
";

$QryObs = "
INSERT INTO TBL_EnsayoDetalleObs
(EnsayoDetalleObs_IdSolicitudSS, EnsayoDetalleObs_Obs, EnsayoDetalleObs_FechaOperacion)
VALUES
('".$_GET['NS']."', '".$EnsayoItemObs."', '".date('Y-m-d H:i:s')."')
";

$SqlObs = mysqli_query($link, $QryObs) or die ("Error en QRY OBS: ".mysqli_error($link));;
$SqlInf = mysqli_query($link, $QryInf) or die ("Error en QRY INF: ".mysqli_error($link));;


$UpdateEstadoMuestra_Qry = "
UPDATE TBL_FormSSDetalle
SET estado = '1'
WHERE
	FormSS_Id = '".$_GET['NS']."'
";

$UpdateEstadoMuestra_Sql = mysqli_query($link, $UpdateEstadoMuestra_Qry) or die ("Error en Update Muestra: ".mysqli_error($link));;

//printf("</pre>");
?>
<script type="text/javascript">
	alert("Los datos han sido ingresados con éxito.")
  location.href="../../laboratorio_sala_elementos.php";
</script>
