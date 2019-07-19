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



require('../vendors/fpdf/fpdf.php');
require('../vendors/fpdf/FPDFHtmlDoc.php');



$hoy = date("Y-m-d");
$Opcion = $_GET['OP'];
$i=1;
switch ($Opcion) {
	case 'DN':
		$pdf=new PDF('P');
		$Titulo = "DENSIDAD NUCLEAR";
		$Qry = "
			SELECT
				DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
				S.numero_solicitud AS SOLICITUD_NUMERO,
				A.razon_social AS CLIENTE,
				A.nombre_proyecto AS PROYECTO
			FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
			WHERE
				D.Ensayo_IdEnsayo = '51' AND
				D.FormSS_Id = S.id_form_solicitud_servicio AND
				S.id_agendamiento_visita = A.id_agendamiento_visita
		";

	break;

	case 'PC':
		$pdf=new PDF('P');
		$Titulo = "PORCHET";
		$Qry = "
			SELECT
				DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
				S.numero_solicitud AS SOLICITUD_NUMERO,
				A.razon_social AS CLIENTE,
				A.nombre_proyecto AS PROYECTO
			FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
			WHERE
				D.Ensayo_IdEnsayo = '56' AND
				D.FormSS_Id = S.id_form_solicitud_servicio AND
				S.id_agendamiento_visita = A.id_agendamiento_visita
		";

	break;

	case 'ET':
		$pdf=new PDF('P');
		$Titulo = "ESTRATIGRAFIA";
		$Qry = "
		SELECT
			DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
			S.numero_solicitud AS SOLICITUD_NUMERO,
			A.razon_social AS CLIENTE,
			A.nombre_proyecto AS PROYECTO
		FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
		WHERE
			D.Ensayo_IdEnsayo = '57' AND
			D.FormSS_Id = S.id_form_solicitud_servicio AND
			S.id_agendamiento_visita = A.id_agendamiento_visita
		";
	break;

	case 'DCA':
		$pdf=new PDF('P');
		$Titulo = "DENSIDAD CONO ARENA";
		$Qry = "
		SELECT
			DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
			S.numero_solicitud AS SOLICITUD_NUMERO,
			A.razon_social AS CLIENTE,
			A.nombre_proyecto AS PROYECTO
		FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
		WHERE
			D.Ensayo_IdEnsayo = '52' AND
			D.FormSS_Id = S.id_form_solicitud_servicio AND
			S.id_agendamiento_visita = A.id_agendamiento_visita
		";
	break;

	case 'CD':
		$pdf=new PDF('P');
		$Titulo = "CONTROL DE DOCILIDAD";
		$Qry = "
		SELECT
			DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
			S.numero_solicitud AS SOLICITUD_NUMERO,
			A.razon_social AS CLIENTE,
			A.nombre_proyecto AS PROYECTO
		FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
		WHERE
			D.Ensayo_IdEnsayo = '6' AND
			D.FormSS_Id = S.id_form_solicitud_servicio AND
			S.id_agendamiento_visita = A.id_agendamiento_visita
		";
	break;

	case 'DAH':
		$pdf=new PDF('P');
		$Titulo = "DENSIDAD APARENTE HORMIGON FRESCO";
		$Qry = "
		SELECT
			DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
			S.numero_solicitud AS SOLICITUD_NUMERO,
			A.razon_social AS CLIENTE,
			A.nombre_proyecto AS PROYECTO
		FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
		WHERE
			D.Ensayo_IdEnsayo = '3' AND
			D.FormSS_Id = S.id_form_solicitud_servicio AND
			S.id_agendamiento_visita = A.id_agendamiento_visita
		";
	break;

	case 'LHL':
		$pdf=new PDF('P');
		$Titulo = "LISURA HI LO (ASFALTO Y HORMIGON)";
		$Qry = "
		SELECT
			DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
			S.numero_solicitud AS SOLICITUD_NUMERO,
			A.razon_social AS CLIENTE,
			A.nombre_proyecto AS PROYECTO
		FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
		WHERE
			(D.Ensayo_IdEnsayo = '9' OR D.Ensayo_IdEnsayo = '46') AND
			D.FormSS_Id = S.id_form_solicitud_servicio AND
			S.id_agendamiento_visita = A.id_agendamiento_visita
		";
	break;

	case 'DT':
		$pdf=new PDF('P');
		$Titulo = "DENSIDAD EN TERRENO (ASFALTO)";
		$Qry = "
		SELECT
			DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
			S.numero_solicitud AS SOLICITUD_NUMERO,
			A.razon_social AS CLIENTE,
			A.nombre_proyecto AS PROYECTO
		FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
		WHERE
			D.Ensayo_IdEnsayo = '37' AND
			D.FormSS_Id = S.id_form_solicitud_servicio AND
			S.id_agendamiento_visita = A.id_agendamiento_visita
		";
	break;

	case 'CT':
		$pdf=new PDF('P');
		$Titulo = "CONTROL DE TEMPERATURA";
		$Qry = "
		SELECT
			DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
			S.numero_solicitud AS SOLICITUD_NUMERO,
			A.razon_social AS CLIENTE,
			A.nombre_proyecto AS PROYECTO
		FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
		WHERE
			D.Ensayo_IdEnsayo = '40' AND
			D.FormSS_Id = S.id_form_solicitud_servicio AND
			S.id_agendamiento_visita = A.id_agendamiento_visita
		";
	break;

	case 'CR':
		$pdf=new PDF('P');
		$Titulo = "CONTROL DE RIEGO ASFALTICO";
		$Qry = "
		SELECT
			DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
			S.numero_solicitud AS SOLICITUD_NUMERO,
			A.razon_social AS CLIENTE,
			A.nombre_proyecto AS PROYECTO
		FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
		WHERE
			D.Ensayo_IdEnsayo = '44' AND
			D.FormSS_Id = S.id_form_solicitud_servicio AND
			S.id_agendamiento_visita = A.id_agendamiento_visita
		";
	break;

}


$Sql = mysqli_query($link, $Qry);

while ($Tabla_Data = mysqli_fetch_assoc($Sql)) {
	$Tabla_Content = $Tabla_Content . '
	<tr>
		<td width="30">'.$i.'</td>
		<td width="100">'.$Tabla_Data['SOLICITUD_FECHA'].'</td>
		<td width="100">'.$Tabla_Data['SOLICITUD_NUMERO'].'</td>
		<td width="250">'.$Tabla_Data['CLIENTE'].'</td>
		<td width="250">'.$Tabla_Data['PROYECTO'].'</td>
	</tr>
	';

$i++;
}

$Tabla_Header = '
	<tr>
		<td width="30">#</td>
		<td width="100">Fecha Solicitud</td>
		<td width="100">SS </td>
		<td width="250">Cliente</td>
		<td width="250">Proyecto</td>
	</tr>
';

$Tabla_Full = '<br><table border="1">' . $Tabla_Header . $Tabla_Content . '</table>';




$pdf->AddPage();
//$pdf->SetLeftMargin(2);
//$pdf->SetRightMargin(2);

$pdf->Image('images/banner-bitacora.png',0,0,0,-175);
$pdf->Ln(11);
$pdf->SetFont('Arial','b',20);

$pdf->Cell(169,5,$Titulo,0,1,'L');
$pdf->SetFont('Arial','',9);


$pdf->WriteHTML($Tabla_Full);
$pdf->Output();

?>
