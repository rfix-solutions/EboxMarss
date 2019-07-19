<?php
// Include the main TCPDF library (search for installation path).
require_once('../../../vendors/tcpdf/tcpdf.php');


$border_style = array('all' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = '../../images/banner-informe-ensayo-oficial.jpg';
        $this->Image($image_file, 0, 0, 210, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
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
        $this->Cell(185,1,'',0,0,'C',true);
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
$pdf->SetTitle('INFORME '.$Folio);
$pdf->SetSubject('INFORME '.$Folio);
$pdf->SetKeywords('INFORME '.$Folio);

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
$pdf->AddPage();

//$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
//$pdf->setCellMargins(1, 1, 1, 1);

$Hoy = date("d/m/Y H:i:s");
$ResMinvu = "RESOLUCIÓN MINVU N° 13901 DEL 04/12/2017";
$Titulo = "Laboratorio de Obras Civiles ".$Folio;
$Inn = "../../images/logo_inn-424x100.png";
$Borde = 0;
$Relleno = 0;

// set color for background
//$pdf->SetFillColor(255, 255, 127);
//$pdf->MultiCell(60, 5,'' , 1, 'L', 1, 0, '', '', true);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->MultiCell(180, 5, $Titulo, $Borde, 'C', $Relleno, 1, '', '', true);
$pdf->SetFont('helvetica', '', 9);
$pdf->MultiCell(90, 5, $ResMinvu, $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(90, 5, $Hoy, $Borde, 'R', $Relleno, 1, '', '', true);
//Multicell(ancho, alto , contenido, borde, alineacion, relleno, salto de linea)
// set some text to print


$Borde = 1;
$Relleno = 1;
$pdf->SetFont('helvetica', '', 8);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(30, 5, "Solicitante", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(150, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(30, 5, "Dirección Cliente", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(55, 5, "", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(35, 5, "Atención Sr.", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(60, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(30, 5, "Obra", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(55, 5, "", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(35, 5, "Correlativo N°", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(60, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(30, 5, "Ciudad", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(55, 5, "", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(35, 5, "N° Solicitud", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(60, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(30, 5, "Fecha Fabricación", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(55, 5, "", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(35, 5, "Fecha Muestreo", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(60, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(30, 5, "Cantidad", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(55, 5, "", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(35, 5, "Muestra tomada por", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(60, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(30, 5, "Ensayo realizado en", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(55, 5, "LABORATORIO CENTRAL - PLACILLA", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(35, 5, "Material Controlado", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(60, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);


$pdf->ln();
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetFillColor(237, 237, 237);
$pdf->MultiCell(180, 5, "Resultados", $Borde, 'L', $Relleno, 1, '', '', true);


$pdf->SetFont('helvetica', '', 8);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(180, 5, "Informe de Extracción", $Borde, 'L', $Relleno, 1, '', '', true);
$pdf->MultiCell(180, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);
$pdf->MultiCell(180, 5, "Procedimiento de aserrado y Refrenado", $Borde, 'L', $Relleno, 1, '', '', true);
$pdf->MultiCell(180, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);
$pdf->MultiCell(180, 5, "Condiciones de Conservación", $Borde, 'L', $Relleno, 1, '', '', true);
$pdf->MultiCell(180, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);



$pdf->ln();
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetFillColor(237, 237, 237);
$pdf->MultiCell(120, 5, "ENSAYO DE COMPRESIÓN EN TESTIGOS DE HORMIGÓN", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(60, 5, "NCh 1171 Of 2012", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->SetFont('helvetica', '', 7);
$pdf->SetFillColor(255, 255, 255);

$pdf->MultiCell(60, 5, "TESTIGO NUMERO", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(60, 5, "ESBELTEZ", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(50, 5, "DIÁMETRO", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(10, 5, "cm", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(50, 5, "ALTURA DE CORTE	", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(10, 5, "cm", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(50, 5, "DENSIDAD (Método volumétrico)	", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(10, 5, "kg/m3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(50, 5, "ALTURA DE ENSAYO", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(10, 5, "cm", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(50, 5, "CARGA DE ROTURA	", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(10, 5, "kN", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(50, 5, "RESISTENCIA DEL TESTIGO", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(10, 5, "MPa", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(50, 5, "RESISTENCIA CILÍNDRICA", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(10, 5, "MPa", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->MultiCell(50, 5, "RESISTENCIA CUBICA NCh 170 of 85", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(10, 5, "MPa", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "1", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "2", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "3", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "4", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "5", $Borde, 'L', $Relleno, 0, '', '', true);
$pdf->MultiCell(20, 5, "6", $Borde, 'L', $Relleno, 1, '', '', true);


$pdf->ln();
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetFillColor(237, 237, 237);
$pdf->MultiCell(180, 5, "Identificación de los Testigos", $Borde, 'L', $Relleno, 1, '', '', true);


$pdf->SetFont('helvetica', '', 8);
$pdf->SetFillColor(255, 255, 255);
for($i=1;$i<=6;$i++){
  $pdf->MultiCell(30, 5, $i, $Borde, 'L', $Relleno, 0, '', '', true);
  $pdf->MultiCell(150, 5, "", $Borde, 'L', $Relleno, 1, '', '', true);
}

$pdf->ln();
$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetFillColor(237, 237, 237);
$pdf->MultiCell(180, 5, "OBSERVACIONES", $Borde, 'L', $Relleno, 1, '', '', true);

$pdf->SetFont('helvetica', '', 7);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(180, 8, "", $Borde, 'L', $Relleno, 1, '', '', true);



$pdf->SetXY(70, 240);

$pdf->Image("../../images/timbre-informe-marss.png", '', '', 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
$pdf->Image("../../images/firma_avargas.png", '', '', 30, '', 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);

$pdf->SetXY(0, 240);
$pdf->Ln();$pdf->Ln();$pdf->Ln();


$pdf->SetFont('helvetica', '', 10);
$txt = <<<EOD
ALEJANDRO VARGAS CARRASCO
JEFE ÁREA HORMIGÓN
EOD;

// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', 'I', 7);
$txt = <<<EOD

EL PRESENTE INFORME DE ENSAYO NO DEBE SER REPRODUCIDO EXCEPTO EN SU TOTALIDAD SIN LA AUTORIZACIÓN DE MARSS LABORATORIOS LOS RESULTADOS PRESENTADOS CORRESPONDEN SOLO A LA MUESTRA ENSAYADA Y NO A UN TOTAL DEL LOTE
EOD;

// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
$NombreInforme = 'INFORME_LS_'.$_GET['F'];
$pdf->Output($NombreInforme, 'I');
//============================================================+
// END OF FILE
//============================================================+
?>
