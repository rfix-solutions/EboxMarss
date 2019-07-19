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

$sql_total = mysqli_query($link, "SELECT MAX(id_ensayo_item) AS MAYOR FROM TBL_EnsayoItem");
while($max = mysqli_fetch_assoc($sql_total)){ $total = $max['MAYOR']; }

for($i=1; $i<=$total; $i++){
	if(isset($_GET["EnsayoItem".$i])){
		$ItemEnsayo = $_GET["EnsayoItem".$i];
		foreach ($ItemEnsayo as $ValorItem => $value) {
			for($j=1; $j<=$_GET['QM']; $j++){
				$QryItemSuelos = "
					INSERT INTO TBL_EnsayoDetalleItem
					(EnsayoDetalleItem_IdEnsayoItem, EnsayoDetalleItem_ValorEnsayoItem, EnsayoDetalleItem_NMuestra, EnsayoDetalleItem_IdSolicitudSS, EnsayoDetalleItem_FechaOperacion)
					VALUES
					('".$i."', '".$value."', '".$j."', '".$_GET['NS']."', '".date('Y-m-d H:i:s')."')
				";
				$SqlItemSuelos = mysqli_query($link, $QryItemSuelos) or die ("Error en QRY Item Ensayo: " . mysqli_error($link));;
			}
		}
	}
}




$sql_total_ensayos = mysqli_query($link, "SELECT MAX(id_ensayo) AS MAYOR FROM TBL_Ensayo");
while($max = mysqli_fetch_assoc($sql_total_ensayos)){ $total_ensayos = $max['MAYOR']; }

for($i=1; $i<=$total_ensayos; $i++){
	if(isset($_GET["fecha_ensayo_".$i])){
		$FechaEnsayo = $_GET["fecha_ensayo_".$i];
		foreach($FechaEnsayo as $FechaItem => $value){
			for($j=1; $j<=$_GET['QM']; $j++){
				$QryFechaEnsayo = "
				INSERT INTO TBL_EnsayoDetalleFecha
				(EnsayoDetalleFecha_IdEnsayoItem, EnsayoDetalleFecha_IdSolicitudSS, EnsayoDetalleFecha_NMuestra, EnsayoDetalleFecha_FechaEnsayo, EnsayoDetalleFecha_FechaOperacion)
				VALUES
				('".$i."', '".$_GET['NS']."', '".$j."', '".$value."', '".date('Y-m-d H:i:s')."')
				";
				$SqlFechaEnsayo = mysqli_query($link, $QryFechaEnsayo) or die ("Error en SQL Fecha Ensayo: " . mysqli_error($link));;
			}
		}
	}
}




$QryObs = "
	INSERT INTO TBL_EnsayoDetalleObs
		(EnsayoDetalleObs_IdSolicitudSS, EnsayoDetalleObs_Obs, EnsayoDetalleObs_FechaOperacion)
	VALUES
		('".$_GET['NS']."', '".$_GET['observaciones']."', '".date('Y-m-d H:i:s')."')
";



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
		Informe_IdFormSS = '".$_GET['NS']."'
";


$SqlObs = mysqli_query($link, $QryObs) or die ("Error en Insert Observaciones " . mysqli_error($link));;
$SqlInf = mysqli_query($link, $QryInf) or die ("Error en Insert Informe " . mysqli_error($link));;


$UpdateEstadoMuestra_Qry = "
	UPDATE TBL_FormSSDetalle
	SET estado = '1'
	WHERE
		FormSS_Id = '".$_GET['NS']."'
";

$UpdateEstadoMuestra_Sql = mysqli_query($link, $UpdateEstadoMuestra_Qry) or die ("Error en Update Muestra: ".mysqli_error($link));;

?>
<script type="text/javascript">
	alert("Los datos han sido ingresados con éxito.")
  location.href="../../laboratorio_sala_hormigon.php";
</script>
<?php /*
printf("</pre>");
/*
*/?>
