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


$SolicitudNumero 	= $_GET['id'];
$SolicitudTipo 		= $_GET['tipo'];
$InformeFolio 		= $_GET['folio'];
$InformeId				= $_GET['idf'];

switch ($SolicitudTipo) {
	case 'SS':
		$TipoInforme_Qry = "
		SELECT
			d.Ensayo_IdEnsayo AS ID
		FROM
			TBL_FormSSDetalle d, TBL_FormSS s, TBL_Informe i
		WHERE
			i.Informe_Id = '".$InformeId."' AND
			i.Informe_IdFormSS = s.id_form_solicitud_servicio AND
			s.id_form_solicitud_servicio = d.FormSS_Id
			";
		break;
	case 'HM':

		$TipoInforme_Qry = "
		SELECT
		e.id_ensayo AS ID
		FROM
		TBL_Informe i, TBL_FormHM f, TBL_FormHMDet d, TBL_FormHMProb p, TBL_Ensayo e
		WHERE
		i.Informe_Id = '".$InformeId."' AND
		i.Informe_IdFormCH = f.id_form_c_h_m AND
		f.id_form_c_h_m = d.id_form_c_h_m AND
		d.FormHMProb_Id = p.FormHMProb_Id AND
		p.FormHMProb_IdEnsayo = e.id_ensayo
		";
		break;

	default:
		exit;
		break;
}

$TipoInforme_Sql = mysqli_query($link, $TipoInforme_Qry) or die ("Error en Tipo Informe: ". mysqli_error($link));;

while($TipoInforme_Data = mysqli_fetch_assoc($TipoInforme_Sql)){
	$TipoEnsayoId 		=	$TipoInforme_Data['ID'];
}
//echo $TipoEnsayoId;

switch ($TipoEnsayoId) {
	case '5':
	// Compresión Testigos Hormigón
	include("InformeTH.php");
	break;

	case '10':
	// Ruptura Probeta Mortero (RILEM)
	include("InformeRIHOROF.php");
	break;

	case '11':
		// Compresión Cilíndro Hormigón
		include("InformeCIHOROF.php");
	break;

	case '12':
	// Compresión Cubo Hormigón
	include("InformeCUHOROF.php");
	break;

	case '13':
		// Flexo tracción Hormigón
		include("InformeVIHOROF.php");
	break;
}


//printf("</pre>");
?>
