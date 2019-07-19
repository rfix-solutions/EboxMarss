<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
}
else
{?>
	<script type="text/javascript">
		alert("Esta pagina es solo para usuarios registrados.")
		location.href="../../login/index.php?url=<?php echo $_SERVER["PHP_SELF"];?>";
	</script>
<?php
		exit;
}
include '../_qry/db_connect_local.php';


// Include the main TCPDF library (search for installation path).

require_once('../../vendors/tcpdf/tcpdf.php');

$Hoy = date("d/m/Y H:i:s");
$Titulo = "Resumen Prefacturación";


$border_style = array('all' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));



class MYPDF extends TCPDF {

    //Page header

    public function Header() {
        // Logo
        $image_file = '../images/banner-resumen-prefacturacion.jpg';
        $this->Image($image_file, 0, 0, 300, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        //IMAGE(ruta, margen izquierda, margen superior, ancho de columnas de archivo )
    }

    // Page footer

    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-10);
        // Set font
        $this->SetFont('helvetica', 'B', 8);
        // Page number
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetFillColor(23,22,149);
        $this->Cell(270,1,'',0,0,'C',true);
        $this->ln(1);
        $this->SetDrawColor(0, 0, 0);
        $this->SetFillColor(0, 0, 0);
        $this->SetTextColor(23, 22, 149);
        $this->cell(0,10,'Calle Décima Nº 493-494, Placilla, Valparaíso (32) 2138800 - Email: laboratorio@marsslab.cl - www.marsslab.cl', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}


// create new PDF document

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$Folio = $_GET['F'];
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('TECNOTRACK');
$pdf->SetTitle($Titulo);
$pdf->SetSubject($Titulo);
$pdf->SetKeywords($Titulo);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(1);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);
// set image scale factor

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set font
// add a page

$pdf->AddPage('L', 'A4');
//$pdf->setCellPaddings(1, 1, 1, 1);
// set cell margins
//$pdf->setCellMargins(1, 1, 1, 1);

$Borde = 0;
$Relleno = 0;
$QRY_Facturables ="

SELECT
	HM.numero_solicitud AS N_SOLICITUD,
	DATE_FORMAT(HM.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
	A.razon_social AS CLIENTE,
	A.nombre_proyecto AS PROYECTO,
	T.nombre_tipo_ensayo AS SERVICIO,
	AC.empresa_solicitante AS SOLICITANTE,
	A.id_agendamiento_visita AS ID,
	HM.id_form_c_h_m AS ID_SOLICITUD,
	E.nombre_ensayo AS ENSAYO,
	E.precio AS PRECIO,
	'HM' AS TABLA
FROM
	TBL_FormHM HM, TBL_AgendaVisita A, TBL_EnsayoTipo T, TBL_FormAC AC, TBL_Ensayo E
WHERE
	HM.id_agendamiento_visita = A.id_agendamiento_visita AND
	HM.id_tipo_ensayo = E.id_ensayo AND
	E.id_tipo_ensayo = T.id_tipo_ensayo AND
	A.id_form_aceptacion = AC.id_form_aceptacion
GROUP BY
	HM.numero_solicitud


UNION

SELECT
	SS.numero_solicitud AS N_SOLICITUD,
	DATE_FORMAT(SS.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
	A.razon_social AS CLIENTE,
	A.nombre_proyecto AS PROYECTO,
	T.nombre_tipo_ensayo AS SERVICIO,
	AC.empresa_solicitante AS SOLICITANTE,
	A.id_agendamiento_visita AS ID,
	SS.id_form_solicitud_servicio AS ID_SOLICITUD,
	E.nombre_ensayo AS ENSAYO,
	E.precio AS PRECIO,
	'SS' AS TABLA
FROM
	TBL_FormSS SS, TBL_AgendaVisita A, TBL_EnsayoTipo T, TBL_FormAC AC, TBL_Ensayo E, TBL_FormSSDetalle D
WHERE
	SS.id_agendamiento_visita = A.id_agendamiento_visita AND
	SS.id_form_solicitud_servicio = D.FormSS_Id AND
	D.Ensayo_IdEnsayo = E.id_ensayo AND
	SS.id_agendamiento_visita = A.id_agendamiento_visita AND
	E.id_tipo_ensayo = T.id_tipo_ensayo AND
	A.id_form_aceptacion = AC.id_form_aceptacion
GROUP BY
	SS.numero_solicitud

";
$SQL_Facturables = mysqli_query($link, $QRY_Facturables) or die ("Error en QRY Union:".mysqli_error($link));;

// set color for background
//$pdf->SetFillColor(255, 255, 127);
//$pdf->MultiCell(60, 5,'' , 1, 'L', 1, 0, '', '', true);


$pdf->SetFont('helvetica', 'I', 9);
$pdf->MultiCell(270, 5, "Creado el: ".$Hoy, $Borde, 'R', $Relleno, 1, '', '', true);

//Multicell(ancho, alto , contenido, borde, alineacion, relleno, salto de linea)

// set some text to print
$Borde = 1;
$Relleno = 1;

$pdf->ln();
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetFillColor(237, 237, 237);
$pdf->MultiCell(15, 5, "Folio", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "Fecha", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(50, 5, "Cliente", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(40, 5, "Proyecto", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(40, 5, "Servicio", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(85, 5, "Solicitante", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(15, 5, "Total", $Borde, 'L', $Relleno, 1, '', '', true);


$pdf->SetFont('helvetica', '', 8);
$pdf->SetFillColor(255, 255, 255);

while($Item = mysqli_fetch_assoc($SQL_Facturables)){

	$pdf->MultiCell(15, 5, substr($Item['N_SOLICITUD'], 0, -2), $Borde, 'L', $Relleno, 0, '', '', true);
	$pdf->MultiCell(20, 5, $Item['FECHA_SOLICITUD'], $Borde, 'L', $Relleno, 0, '', '', true);
	$pdf->MultiCell(50, 5, $Item['CLIENTE'], $Borde, 'L', $Relleno, 0, '', '', true);
	$pdf->MultiCell(40, 5, $Item['PROYECTO'], $Borde, 'L', $Relleno, 0, '', '', true);
	$pdf->MultiCell(40, 5, $Item['SERVICIO'], $Borde, 'L', $Relleno, 0, '', '', true);
	$pdf->MultiCell(85, 5, $Item['SOLICITANTE'], $Borde, 'L', $Relleno, 0, '', '', true);
	$pdf->MultiCell(15, 5, "UF 25,2", $Borde, 'L', $Relleno, 1, '', '', true);
}



$pdf->SetXY(120, 160);



$pdf->Image("../images/timbre-informe-marss.png", '', '', 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
$pdf->Image("../images/firma_avargas.png", '', '', 30, '', 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);

$pdf->SetXY(120, 160);
$pdf->Ln();$pdf->Ln();$pdf->Ln();

$pdf->SetFont('helvetica', '', 10);

$txt = <<<EOD

ALEJANDRO VARGAS CARRASCO

JEFE ÁREA ASFALTOS

EOD;

// print a block of text using Write()

$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document

$NombreInforme = 'MARSS-PREFACTURA_RESUMEN_'.$Hoy;

$pdf->Output($NombreInforme, 'I');



//============================================================+

// END OF FILE

//============================================================+

?>
