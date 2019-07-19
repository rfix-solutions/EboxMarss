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

$InformeId    = $_GET['idi'];
$InformeFolio = $_GET['foi'];
$Hoy = date("d-m-Y");
$FechaFabricacion = $Hoy;


$InformeHM_Qry= "
SELECT
	S.id_form_solicitud_servicio AS IDFORMSS,
	A.empresa_solicitante AS SOLICITANTEEMPRESA,
	A.nombre_obra AS OBRANOMBRE,
	A.direccion_obra AS OBRADIRECCION,
	C.comuna_nombre AS OBRACOMUNA,
	A.nombre_solicitante AS ATSENOR,
	S.cantidad_muestras AS QMUESTRAS,
	S.numero_solicitud AS NSOLICITUD,
	DATE_FORMAT(S.fecha_operacion, '%d-%m-%Y') FECHAOPERACION,
	DATE_FORMAT(S.fecha_solicitud, '%d-%m-%Y') FECHASOLICITUD,
	L.nombre_laboratorista AS REALIZADOPOR
FROM
	TBL_FormSS S, TBL_FormAC A, TBL_Informe I, TBL_AgendaVisita G, TBL_Laboratorista L, TBL_Comuna C
WHERE
	I.Informe_Id = '".$InformeId."' AND
	I.Informe_IdFormSS = S.id_form_solicitud_servicio AND
	S.id_agendamiento_visita = G.id_agendamiento_visita AND
	G.id_form_aceptacion = A.id_form_aceptacion AND
	S.realizado_por = L.id_laboratorista AND
	A.comuna_obra = C.comuna_id
";
$InformeHM_Sql = mysqli_query($link, $InformeHM_Qry) or die ("Error QryHM1: ". mysqli_error($link));;

while($InformeHM_Dat = mysqli_fetch_assoc($InformeHM_Sql)){
	$IDFormSS					= $InformeHM_Dat['IDFORMSS'];
	$NSolicitud				= $InformeHM_Dat['NSOLICITUD'];
	$RealizadoPor			= $InformeHM_Dat['REALIZADOPOR'];
	$CantidadMuestras	= $InformeHM_Dat['QMUESTRAS'];
	$Solicitante			= $InformeHM_Dat['SOLICITANTEEMPRESA'];
	$ObraDireccion		= $InformeHM_Dat['OBRADIRECCION'];
	$ObraComuna				= $InformeHM_Dat['OBRACOMUNA'];
	$ObraNombre				= $InformeHM_Dat['OBRANOMBRE'];
	$AtSenor					= $InformeHM_Dat['ATSENOR'];
	$FechaOperacion		= $InformeHM_Dat['FECHAOPERACION'];
	$FechaSolicitud		= $InformeHM_Dat['FECHASOLICITUD'];
}


$DetalleEnsayos_Qry = "
	SELECT
		EnsayoDetalleItem_IdEnsayoItem AS ID,
		EnsayoDetalleItem_ValorEnsayoItem AS VALUE
	FROM
		TBL_EnsayoDetalleItem
	WHERE
		EnsayoDetalleItem_IdSolicitudSS = '".$IDFormSS."'
";

$DetalleEnsayos_Sql = mysqli_query($link, $DetalleEnsayos_Qry) or die ("Error en Detalle Ensayos : ". mysqli_error($link));;

while($DetalleEnsayos_Dat = mysqli_fetch_assoc($DetalleEnsayos_Sql)){
	switch ($DetalleEnsayos_Dat['ID']) {
		case '78':
			$InformeExtraccion = $DetalleEnsayos_Dat['VALUE'];
			break;

		case '79':
			$ProcedimientoAserrado = $DetalleEnsayos_Dat['VALUE'];
			break;

		case '80':
			$CondicionesConservacion = $DetalleEnsayos_Dat['VALUE'];
			break;
	}
}





require('../../../vendors/fpdf/fpdf.php');
//require('../../vendors/fpdf/FPDFHtmlDoc.php');

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border

		$this->Rect($x,$y,$w,$h);

		$this->MultiCell($w,5,$data[$i],0,$a,'true');
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}


$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(10, 25 , 30); #Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetAutoPageBreak(true,25);
$pdf->AddPage();
$pdf->Image('../../images/banner-informe-ensayo-oficial.jpg',0,0,0,-175);
$pdf->Image('../../images/logo_inn.jpg',10,20,0,-300);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(185,5,utf8_decode('LABORATORIO DE OBRAS CIVILES '.$InformeFolio.''),0,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(170,5,utf8_decode('RESOLUCIÓN MINVU N° 4410 DEL 11/07/2018'),0,0,'L');
$pdf->Cell(20, 5, utf8_decode($Hoy),0, 1, 'L');

$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(220,220,220);


$pdf->Cell(35,5,utf8_decode('Solicitante'),1,0,'L');
$pdf->Cell(155,5,utf8_decode($Solicitante),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Dirección Cliente'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($ObraDireccion),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Atención Sr.'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($AtSenor),1,1,'L');


$pdf->Cell(35,5,utf8_decode('Obra'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($ObraNombre),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Correlativo N°'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($Correlativo),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Ciudad'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($ObraComuna),1,0,'L');
$pdf->Cell(40,5,utf8_decode('N° Solicitud'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($NSolicitud), 1, 1, 'L');

$pdf->Cell(35,5,utf8_decode('Fecha Fabricación'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($FechaFabricacion),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Fecha Muestreo'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($FechaOperacion),1,1,'L');


$pdf->Cell(35,5,utf8_decode('Cantidad'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($CantidadMuestras),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Muestra Tomada Por'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($RealizadoPor),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Material Controlado'),1,0,'L');
$pdf->Cell(155,5,utf8_decode($MaterialControlado),1,1,'L');


$pdf->Ln(2);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,utf8_decode('RESULTADOS'),1,1,'J', TRUE);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,5,utf8_decode('INFORME DE EXTRACCIÓN:'),1,1,'J');
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,utf8_decode($InformeExtraccion),1,1,'J');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,5,utf8_decode('PROCEDIMIENTO DE ASERRADO Y REFRENADO:'),1,1,'J');
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,utf8_decode($ProcedimientoAserrado),1,1,'J');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,5,utf8_decode('CONDICIONES DE CONSERVACIÓN:'),1,1,'J');
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,utf8_decode($CondicionesConservacion),1,1,'J');

$pdf->Ln(2);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,utf8_decode('EXTRACCIÓN Y DETERMINACIÓN DE ESPESOR EN TESTIGOS DE HORMIGÓN'),1,1,'C', TRUE);
$pdf->Cell(190,5,utf8_decode('NCh 1171 Of 2012'),1,1,'C', TRUE);


$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(220,220,220);
$pdf->Cell(82,5,utf8_decode('TESTIGO NUMERO'),1,0,'J');
$pdf->Cell(18,5,utf8_decode('1'),1,0,'C');
$pdf->Cell(18,5,utf8_decode('2'),1,0,'C');
$pdf->Cell(18,5,utf8_decode('3'),1,0,'C');
$pdf->Cell(18,5,utf8_decode('4'),1,0,'C');
$pdf->Cell(18,5,utf8_decode('5'),1,0,'C');
$pdf->Cell(18,5,utf8_decode('6'),1,1,'C');

$pdf->Cell(82,5,utf8_decode('Fecha Ensayo'),1,0,'J');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,1,'C');

$pdf->Cell(82,5,utf8_decode('Altura Inicial (mm)'),1,0,'J');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,0,'C');
$pdf->Cell(18,5,utf8_decode(''),1,1,'C');



$pdf->Cell(190,5,utf8_decode('ENSAYO DE COMPRESIÓN EN TESTIGOS DE HORMIGÓN'),1,1,'C', TRUE);
$pdf->Cell(190,5,utf8_decode('NCh 1172 Of 2010 NCh 1037 Of 2009'),1,1,'C', TRUE);



$pdf->SetFont('Arial','',7);
$DetalleEnsayos_QRY2 = "SELECT id_ensayo_item AS ID, nombre_ensayo_item AS NOMBRE, unidad_medida_item AS UM FROM TBL_EnsayoItem WHERE id_ensayo = '5' AND id_ensayo_item != '67'";
$DetalleEnsayos_SQL2 = mysqli_query($link, $DetalleEnsayos_QRY2) or die ("Error en QRY Detalle" . mysqli_error($link));;

while($DetalleEnsayos_DAT2 = mysqli_fetch_assoc($DetalleEnsayos_SQL2)){
	if($DetalleEnsayos_DAT2['ID'] != '78' && $DetalleEnsayos_DAT2['ID'] != '79' && $DetalleEnsayos_DAT2['ID'] != '80' && $DetalleEnsayos_DAT2['ID'] != '81'){

		$pdf->Cell(82,5,utf8_decode($DetalleEnsayos_DAT2['NOMBRE'].' ('.$DetalleEnsayos_DAT2['UM'].')'),1,0,'J');

		for($i=1; $i<=6; $i++){
		$Qry = "
			SELECT
				EnsayoDetalleItem_ValorEnsayoItem AS VALOR
			FROM
				TBL_EnsayoDetalleItem
			WHERE
				EnsayoDetalleItem_NMuestra = '".$i."' AND
				EnsayoDetalleItem_IdSolicitudSS = '".$IDFormSS."' AND
				EnsayoDetalleItem_IdEnsayoItem = '".$DetalleEnsayos_DAT2['ID']."'
		";
		$Sql = mysqli_query($link, $Qry) or die ("Error en Qry: " . mysqli_error($link));;
		while ($Dat = mysqli_fetch_assoc($Sql)) {
			if($Dat['VALOR']!= ""){
					$ValorEnsayo = $Dat['VALOR'];
			}
			else {
				$ValorEnsayo = "";
			}
		}
		if($i==6){
			$break= 1;
		}
		else{
			$break= 0;
		}
		$pdf->Cell(18,5,utf8_decode($ValorEnsayo),1,$break,'C');
		$ValorEnsayo = "";
		}
	}
}




$pdf->Ln(2);

$pdf->Cell(190,5,utf8_decode('IDENTIFICACIÓN DE LOS TESTIGOS'),1,1,'C', TRUE);
for($i=1;$i<=6;$i++){
	$pdf->Cell(20,4,utf8_decode($i),1,0,'C');
	$pdf->Cell(170,4,utf8_decode(''),1,1,'J');
}
$pdf->Ln(10);




$pdf->Image('../../images/firma_avargas.jpg',85,230,-125);
$pdf->Image('../../images/timbre_marss.jpg',145,230,-125);
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,5,utf8_decode('Alejandro Vargas Carrasco'),0,1,'C');
$pdf->Cell(190,5,utf8_decode('Jefe Laboratorio'),0,1,'C');

$pdf->Output('I','Informe_'.$InformeFolio.'_'.date("Y-m-d H:i:s"), TRUE);

?>
