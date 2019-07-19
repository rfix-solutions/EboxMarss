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


require '../../../vendors/fpdf/fpdf.php';

$NumeroSolicitud = $_GET['id'];
$Folio = $_GET['F'];

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


$Titulo = "Laboratorio de Obras Civiles ".$Folio."";
$ResolucionMinvu = "RESOLUCIÓN MINVU N° 13901 DEL 04/12/2017";
$FechaEmision = date("d/m/Y H:i:s");
$Inn = "../../images/logo_inn-424x100.png";
//inicio pdf

//$pdf = new FPDF('P', 'mm', array(215.9, 330.2));
$pdf = new FPDF('P', 'mm', 'Legal');
$pdf->SetMargins(12, 20 , 30); #Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();


$pdf->Image('../../images/banner-informe-ensayo-oficial.jpg',0,0,0,-171);
// CELL (Ancho, Alto, Texto, Borde, Posicion, alineamiento, )
// MULTICELL (Ancho, Alto, Texto, Borde, Alineacion, Relleno, )

$pdf->SetFont('Arial','B',12);
$pdf->Cell(185,5,utf8_decode($Titulo),0,1,'C');
$pdf->Ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell(100,4,utf8_decode($ResolucionMinvu),0,0,'L',false);
$pdf->Cell(85,4,utf8_decode($FechaEmision),0,0,'R',false);
$pdf->Ln();


$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,4,utf8_decode('Solicitante'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(150,4,utf8_decode('Datos Solicitante'),1,0,'L');
$pdf->Ln();

$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,4,utf8_decode('Direccion Cliente'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(60,4,utf8_decode('Dato Direccion'),1,0,'L');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(40,4,utf8_decode('Atención Sr.'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(50,4,utf8_decode('Datos At. Sr.'),1,0,'L');
$pdf->Ln();

$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,4,utf8_decode('Obra'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(60,4,utf8_decode('Dato Obra'),1,0,'L');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(40,4,utf8_decode('Ciudad'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(50,4,utf8_decode('Datos Ciudad'),1,0,'L');
$pdf->Ln();

$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,4,utf8_decode('Material'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(60,4,utf8_decode('Dato Material'),1,0,'L');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(40,4,utf8_decode('Correlativo N°'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(50,4,utf8_decode('Datos Correlativo'),1,0,'L');
$pdf->Ln();

$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,4,utf8_decode('Procedencia'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(60,4,utf8_decode('Dato Procedencia'),1,0,'L');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(40,4,utf8_decode('N° Solicitud'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(50,4,utf8_decode('Datos Solicitud'),1,0,'L');
$pdf->Ln();

$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,4,utf8_decode('Ubicación'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(60,4,utf8_decode('Dato Ubicación'),1,0,'L');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(40,4,utf8_decode('Fecha Muestreo'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(50,4,utf8_decode('Datos fecha'),1,0,'L');
$pdf->Ln();

$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,4,utf8_decode('Ensayo Realizado En'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(60,4,utf8_decode('LABORATORIO CENTRAL - PLACILLA'),1,0,'L');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(40,4,utf8_decode('Muestra tomada por'),1,0,'L');
$pdf->SetFont('Arial','',7);
$pdf->Cell(50,4,utf8_decode('Datos muestra'),1,0,'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,4,utf8_decode('Resultados'),0,0,'L');
$pdf->SetFont('Arial','',7);
///////////////////////////////GRANULOMETRIA
$header = array('GRANULOMETRIA', utf8_decode('MC Vol 8 - 8.202.2 MC Vol 8 - 8.102.1'));
$data = [];
$query_a = "
	SELECT
		ED.EnsayoDetalleItem_ValorEnsayoItem AS ITEM_VALOR, EI.nombre_ensayo_item AS ITEM_NOMBRE, EI.id_ensayo_item AS ITEM_ID
	FROM
		TBL_FormSS SS, TBL_EnsayoItem EI, TBL_EnsayoDetalleItem ED
	WHERE
			SS.numero_solicitud = '".$NumeroSolicitud."' AND
			SS.id_form_solicitud_servicio = ED.EnsayoDetalleItem_IdSolicitud AND
			ED.EnsayoDetalleItem_IdEnsayoItem = EI.id_ensayo_item AND
			EI.id_ensayo = '14'
";
$sql_a = mysqli_query($link, $query_a);
while ($item_a = mysqli_fetch_assoc($sql_a)){
	array_push($data, array(utf8_decode($item_a['ITEM_NOMBRE']), $item_a['ITEM_VALOR']));
}

$QRY_Fecha14 = "
	SELECT
		DATE_FORMAT(F.EnsayoDetalleFecha_FechaEnsayo, '%d/%m/%Y') AS FECHA14
	FROM
		TBL_EnsayoDetalleFecha F, TBL_FormSS S
	WHERE
		S.numero_solicitud = '".$NumeroSolicitud."' AND
		F.EnsayoDetalleFecha_IdSolicitud = S.id_form_solicitud_servicio AND
		F.EnsayoDetalleFecha_IdEnsayoItem = '14'
";
$SQL_Fecha14 = mysqli_query($link, $QRY_Fecha14) or die ("Error en SQL F14".mysqli_error());;
while($ResFecha14 = mysqli_fetch_assoc($SQL_Fecha14)){
	array_push($data, array('Fecha de Ensayo', $ResFecha14['FECHA14']));
}

$pdf->BasicTable($header, $data, 12, 69); //Titulo. valores, margen izquierdo, margen superrior




///////////////////////////////LIMITES DE ATTERBERG NCh 1517/1 Of 79 - NCh 1517/2 Of 79
$header = array('LIMITES DE ATTERBERG', utf8_decode('NCh 1517/1 Of 79 - NCh 1517/2 Of 79'));
$data = [];
$Qry15 = "
	SELECT
		ED.EnsayoDetalleItem_ValorEnsayoItem AS ITEM_VALOR, EI.nombre_ensayo_item AS ITEM_NOMBRE, EI.id_ensayo_item AS ITEM_ID
	FROM
		TBL_FormSS SS, TBL_EnsayoItem EI, TBL_EnsayoDetalleItem ED
	WHERE
			SS.numero_solicitud = '".$NumeroSolicitud."' AND
			SS.id_form_solicitud_servicio = ED.EnsayoDetalleItem_IdSolicitud AND
			ED.EnsayoDetalleItem_IdEnsayoItem = EI.id_ensayo_item AND
			EI.id_ensayo = '15'
";
$Sql15 = mysqli_query($link, $Qry15);
while ($Item15 = mysqli_fetch_assoc($Sql15)){
	array_push($data, array(utf8_decode($Item15['ITEM_NOMBRE']), $Item15['ITEM_VALOR']));
}

$QRY_Fecha15 = "
	SELECT
		DATE_FORMAT(F.EnsayoDetalleFecha_FechaEnsayo, '%d/%m/%Y') AS FECHA15
	FROM
		TBL_EnsayoDetalleFecha F, TBL_FormSS S
	WHERE
		S.numero_solicitud = '".$NumeroSolicitud."' AND
		F.EnsayoDetalleFecha_IdSolicitud = S.id_form_solicitud_servicio AND
		F.EnsayoDetalleFecha_IdEnsayoItem = '15'
";
$SQL_Fecha15 = mysqli_query($link, $QRY_Fecha15) or die ("Error en SQL F15".mysqli_error());;
while($ResFecha15 = mysqli_fetch_assoc($SQL_Fecha15)){
	array_push($data, array('Fecha de Ensayo', $ResFecha15['FECHA15']));
}

$pdf->BasicTable($header, $data, 12, 199); //Titulo. valores, margen izquierdo, margen superrior





///////////////////////////////CLASIFICACIÓN DE SUELOS (No acreditable)
$header = array(utf8_decode('CLASIFICACIÓN DE SUELOS'), utf8_decode('(No acreditable)'));
$data = [];
$Qry16 = "
	SELECT
		ED.EnsayoDetalleItem_ValorEnsayoItem AS ITEM_VALOR, EI.nombre_ensayo_item AS ITEM_NOMBRE, EI.id_ensayo_item AS ITEM_ID
	FROM
		TBL_FormSS SS, TBL_EnsayoItem EI, TBL_EnsayoDetalleItem ED
	WHERE
			SS.numero_solicitud = '".$NumeroSolicitud."' AND
			SS.id_form_solicitud_servicio = ED.EnsayoDetalleItem_IdSolicitud AND
			ED.EnsayoDetalleItem_IdEnsayoItem = EI.id_ensayo_item AND
			EI.id_ensayo = '16'
";
$Sql16 = mysqli_query($link, $Qry16);
while ($Item16 = mysqli_fetch_assoc($Sql16)){
	array_push($data, array(utf8_decode($Item16['ITEM_NOMBRE']), $Item16['ITEM_VALOR']));
}

$QRY_Fecha16 = "
	SELECT
		DATE_FORMAT(F.EnsayoDetalleFecha_FechaEnsayo, '%d/%m/%Y') AS FECHA15
	FROM
		TBL_EnsayoDetalleFecha F, TBL_FormSS S
	WHERE
		S.numero_solicitud = '".$NumeroSolicitud."' AND
		F.EnsayoDetalleFecha_IdSolicitud = S.id_form_solicitud_servicio AND
		F.EnsayoDetalleFecha_IdEnsayoItem = '16'
";
$SQL_Fecha16 = mysqli_query($link, $QRY_Fecha16) or die ("Error en SQL F16".mysqli_error());;
while($ResFecha16 = mysqli_fetch_assoc($SQL_Fecha16)){
	array_push($data, array('Fecha de Ensayo', $ResFecha16['FECHA16']));
}

$pdf->BasicTable($header, $data, 12, 245); //Titulo. valores, margen izquierdo, margen superrior




///////////////////////////////CUBICIDAD DE PARTÍCULAS MC Vol 8 - 8.202.6

$header = array(utf8_decode('CUBICIDAD DE PARTÍCULAS'), utf8_decode('MC Vol 8 - 8.202.6'));
$data = [];
$Qry20 = "
	SELECT
		ED.EnsayoDetalleItem_ValorEnsayoItem AS ITEM_VALOR, EI.nombre_ensayo_item AS ITEM_NOMBRE, EI.id_ensayo_item AS ITEM_ID
	FROM
		TBL_FormSS SS, TBL_EnsayoItem EI, TBL_EnsayoDetalleItem ED
	WHERE
			SS.numero_solicitud = '".$NumeroSolicitud."' AND
			SS.id_form_solicitud_servicio = ED.EnsayoDetalleItem_IdSolicitud AND
			ED.EnsayoDetalleItem_IdEnsayoItem = EI.id_ensayo_item AND
			EI.id_ensayo = '20'
";
$Sql20 = mysqli_query($link, $Qry20);
while ($Item20 = mysqli_fetch_assoc($Sql20)){
	array_push($data, array(utf8_decode($Item20['ITEM_NOMBRE']), $Item20['ITEM_VALOR']));
}

$QRY_Fecha20 = "
	SELECT
		DATE_FORMAT(F.EnsayoDetalleFecha_FechaEnsayo, '%d/%m/%Y') AS FECHA20
	FROM
		TBL_EnsayoDetalleFecha F, TBL_FormSS S
	WHERE
		S.numero_solicitud = '".$NumeroSolicitud."' AND
		F.EnsayoDetalleFecha_IdSolicitud = S.id_form_solicitud_servicio AND
		F.EnsayoDetalleFecha_IdEnsayoItem = '20'
";
$SQL_Fecha20 = mysqli_query($link, $QRY_Fecha20) or die ("Error en SQL F20".mysqli_error());;
while($ResFecha20 = mysqli_fetch_assoc($SQL_Fecha20)){
	array_push($data, array('Fecha de Ensayo', $ResFecha20['FECHA20']));
}

$pdf->BasicTable($header, $data, 12, 273); //Titulo. valores, margen izquierdo, margen superrior




///////////////////////////////////////// COLUMNA 2 /////////////////////////////////////////

///////////////////////RELACIÓN HUMEDAD/DENSIDAD PROCTOR MODIFICADO
$header = array(utf8_decode('RELACIÓN HUMEDAD/DENSIDAD PROCTOR MODIFICADO'), 'NCh 1534/2 Of 79');
$data = [];
$Qry17 = "
SELECT
	ED.EnsayoDetalleItem_ValorEnsayoItem AS ITEM_VALOR, EI.nombre_ensayo_item AS ITEM_NOMBRE, EI.id_ensayo_item AS ITEM_ID, EI.unidad_medida_item AS ITEM_UM
FROM
	TBL_FormSS SS, TBL_EnsayoItem EI, TBL_EnsayoDetalleItem ED
WHERE
		SS.numero_solicitud = '".$NumeroSolicitud."' AND
		SS.id_form_solicitud_servicio = ED.EnsayoDetalleItem_IdSolicitud AND
		ED.EnsayoDetalleItem_IdEnsayoItem = EI.id_ensayo_item AND
		EI.id_ensayo = '17'
";
$Sql17 = mysqli_query($link, $Qry17);
while ($Item17 = mysqli_fetch_assoc($Sql17)){
	array_push($data, array(utf8_decode($Item17['ITEM_NOMBRE']), $Item17['ITEM_VALOR']));
}

$QRY_Fecha17 = "
	SELECT
		DATE_FORMAT(F.EnsayoDetalleFecha_FechaEnsayo, '%d/%m/%Y') AS FECHA17
	FROM
		TBL_EnsayoDetalleFecha F, TBL_FormSS S
	WHERE
		S.numero_solicitud = '".$NumeroSolicitud."' AND
		F.EnsayoDetalleFecha_IdSolicitud = S.id_form_solicitud_servicio AND
		F.EnsayoDetalleFecha_IdEnsayoItem = '17'
";
$SQL_Fecha17 = mysqli_query($link, $QRY_Fecha17) or die ("Error en SQL F17".mysqli_error());;
while($ResFecha17 = mysqli_fetch_assoc($SQL_Fecha17)){
	array_push($data, array('Fecha de Ensayo', $ResFecha17['FECHA17']));
}

$pdf->BasicTable($header, $data, 107, 69); //Titulo. valores, margen izquierdo, margen superrior




/////////////////////// DETERMINACIÓN DE LA RAZÓN DE SOPORTE C.B.R	NCh 1852 Of 81</br> DETERMINACIÓN DE LAS HUMEDADES DE LA MUESTRA	NCh 1515 Of 79
$header = array(utf8_decode('DETERMINACIÓN DE LA RAZÓN DE SOPORTE C.B.R	NCh 1852 Of 81'), utf8_decode('DETERMINACIÓN DE LAS HUMEDADES DE LA MUESTRA	NCh 1515 Of 79'));
$data = [];
$Qry18 = "
SELECT
	ED.EnsayoDetalleItem_ValorEnsayoItem AS ITEM_VALOR, EI.nombre_ensayo_item AS ITEM_NOMBRE, EI.id_ensayo_item AS ITEM_ID, EI.unidad_medida_item AS ITEM_UM
FROM
	TBL_FormSS SS, TBL_EnsayoItem EI, TBL_EnsayoDetalleItem ED
WHERE
		SS.numero_solicitud = '".$NumeroSolicitud."' AND
		SS.id_form_solicitud_servicio = ED.EnsayoDetalleItem_IdSolicitud AND
		ED.EnsayoDetalleItem_IdEnsayoItem = EI.id_ensayo_item AND
		EI.id_ensayo = '18'
";
$Sql18 = mysqli_query($link, $Qry18);
while ($Item18 = mysqli_fetch_assoc($Sql18)){
	array_push($data, array(utf8_decode($Item18['ITEM_NOMBRE']), $Item18['ITEM_VALOR']));
}

$QRY_Fecha18 = "
	SELECT
		DATE_FORMAT(F.EnsayoDetalleFecha_FechaEnsayo, '%d/%m/%Y') AS FECHA18
	FROM
		TBL_EnsayoDetalleFecha F, TBL_FormSS S
	WHERE
		S.numero_solicitud = '".$NumeroSolicitud."' AND
		F.EnsayoDetalleFecha_IdSolicitud = S.id_form_solicitud_servicio AND
		F.EnsayoDetalleFecha_IdEnsayoItem = '18'
";
$SQL_Fecha18 = mysqli_query($link, $QRY_Fecha18) or die ("Error en SQL F18".mysqli_error());;
while($ResFecha18 = mysqli_fetch_assoc($SQL_Fecha18)){
	array_push($data, array('Fecha de Ensayo', $ResFecha18['FECHA18']));
}

$pdf->BasicTable($header, $data, 107, 121); //Titulo. valores, margen izquierdo, margen superrior




/////////////////////// DETERMINACIÓN DEL EQUIVALENTE DE ARENA	NCh 1325 Of 10
$header = array(utf8_decode('DETERMINACIÓN DEL EQUIVALENTE DE ARENA	'), utf8_decode('NCh 1325 Of 10'));
$data = [];
$Qry22 = "
SELECT
	ED.EnsayoDetalleItem_ValorEnsayoItem AS ITEM_VALOR, EI.nombre_ensayo_item AS ITEM_NOMBRE, EI.id_ensayo_item AS ITEM_ID, EI.unidad_medida_item AS ITEM_UM
FROM
	TBL_FormSS SS, TBL_EnsayoItem EI, TBL_EnsayoDetalleItem ED
WHERE
		SS.numero_solicitud = '".$NumeroSolicitud."' AND
		SS.id_form_solicitud_servicio = ED.EnsayoDetalleItem_IdSolicitud AND
		ED.EnsayoDetalleItem_IdEnsayoItem = EI.id_ensayo_item AND
		EI.id_ensayo = '22'
";
$Sql22 = mysqli_query($link, $Qry22);
while ($Item22 = mysqli_fetch_assoc($Sql22)){
	array_push($data, array(utf8_decode($Item22['ITEM_NOMBRE']), $Item22['ITEM_VALOR']));
}

$QRY_Fecha22 = "
	SELECT
		DATE_FORMAT(F.EnsayoDetalleFecha_FechaEnsayo, '%d/%m/%Y') AS FECHA22
	FROM
		TBL_EnsayoDetalleFecha F, TBL_FormSS S
	WHERE
		S.numero_solicitud = '".$NumeroSolicitud."' AND
		F.EnsayoDetalleFecha_IdSolicitud = S.id_form_solicitud_servicio AND
		F.EnsayoDetalleFecha_IdEnsayoItem = '22'
";
$SQL_Fecha22 = mysqli_query($link, $QRY_Fecha22) or die ("Error en SQL F22".mysqli_error());;
while($ResFecha22 = mysqli_fetch_assoc($SQL_Fecha22)){
	array_push($data, array('Fecha de Ensayo', $ResFecha22['FECHA22']));
}

$pdf->BasicTable($header, $data, 107, 221); //Titulo. valores, margen izquierdo, margen superrior




/////////////////////// DESGASTE POR MÉTODO DE LOS ÁNGELES	NCh 1369 Of 10
$header = array(utf8_decode('DESGASTE POR MÉTODO DE LOS ÁNGELES'), utf8_decode('NCh 1369 Of 10'));
$data = [];
$Qry19 = "
SELECT
	ED.EnsayoDetalleItem_ValorEnsayoItem AS ITEM_VALOR, EI.nombre_ensayo_item AS ITEM_NOMBRE, EI.id_ensayo_item AS ITEM_ID, EI.unidad_medida_item AS ITEM_UM
FROM
	TBL_FormSS SS, TBL_EnsayoItem EI, TBL_EnsayoDetalleItem ED
WHERE
		SS.numero_solicitud = '".$NumeroSolicitud."' AND
		SS.id_form_solicitud_servicio = ED.EnsayoDetalleItem_IdSolicitud AND
		ED.EnsayoDetalleItem_IdEnsayoItem = EI.id_ensayo_item AND
		EI.id_ensayo = '19'
";
$Sql19 = mysqli_query($link, $Qry19);
while ($Item19 = mysqli_fetch_assoc($Sql19)){
	array_push($data, array(utf8_decode($Item19['ITEM_NOMBRE']), $Item19['ITEM_VALOR']));
}

$QRY_Fecha19 = "
	SELECT
		DATE_FORMAT(F.EnsayoDetalleFecha_FechaEnsayo, '%d/%m/%Y') AS FECHA19
	FROM
		TBL_EnsayoDetalleFecha F, TBL_FormSS S
	WHERE
		S.numero_solicitud = '".$NumeroSolicitud."' AND
		F.EnsayoDetalleFecha_IdSolicitud = S.id_form_solicitud_servicio AND
		F.EnsayoDetalleFecha_IdEnsayoItem = '19'
";
$SQL_Fecha19 = mysqli_query($link, $QRY_Fecha19) or die ("Error en SQL F19".mysqli_error());;
while($ResFecha19 = mysqli_fetch_assoc($SQL_Fecha19)){
	array_push($data, array('Fecha de Ensayo', $ResFecha19['FECHA19']));
}

$pdf->BasicTable($header, $data, 107, 255); //Titulo. valores, margen izquierdo, margen superrior






/////////////////////// DENSIDAD DE PARTÍCULAS SOLIDAS TOTALES NCh 1532 Of 80
$header = array(utf8_decode('DENSIDAD DE PARTÍCULAS SOLIDAS TOTALES'), utf8_decode('NCh 1532 Of 80'));
$data = [];
$Qry21 = "
SELECT
	ED.EnsayoDetalleItem_ValorEnsayoItem AS ITEM_VALOR, EI.nombre_ensayo_item AS ITEM_NOMBRE, EI.id_ensayo_item AS ITEM_ID, EI.unidad_medida_item AS ITEM_UM
FROM
	TBL_FormSS SS, TBL_EnsayoItem EI, TBL_EnsayoDetalleItem ED
WHERE
		SS.numero_solicitud = '".$NumeroSolicitud."' AND
		SS.id_form_solicitud_servicio = ED.EnsayoDetalleItem_IdSolicitud AND
		ED.EnsayoDetalleItem_IdEnsayoItem = EI.id_ensayo_item AND
		EI.id_ensayo = '21'
";
$Sql21 = mysqli_query($link, $Qry21);
while ($Item21 = mysqli_fetch_assoc($Sql21)){
	array_push($data, array(utf8_decode($Item21['ITEM_NOMBRE']), $Item21['ITEM_VALOR']));
}

$QRY_Fecha21 = "
	SELECT
		DATE_FORMAT(F.EnsayoDetalleFecha_FechaEnsayo, '%d/%m/%Y') AS FECHA19
	FROM
		TBL_EnsayoDetalleFecha F, TBL_FormSS S
	WHERE
		S.numero_solicitud = '".$NumeroSolicitud."' AND
		F.EnsayoDetalleFecha_IdSolicitud = S.id_form_solicitud_servicio AND
		F.EnsayoDetalleFecha_IdEnsayoItem = '21'
";
$SQL_Fecha21 = mysqli_query($link, $QRY_Fecha21) or die ("Error en SQL F21".mysqli_error());;
while($ResFecha21 = mysqli_fetch_assoc($SQL_Fecha21)){
	array_push($data, array('Fecha de Ensayo', $ResFecha21['FECHA21']));
}

$pdf->BasicTable($header, $data, 107, 285); //Titulo. valores, margen izquierdo, margen superrior

$pdf->Ln(4);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(100,4,utf8_decode('Observaciones'),0,0,'L');
$pdf->Cell(40,10, $pdf->Image("../../images/firma_avargas.png", $pdf->GetX(), $pdf->GetY(),40,40),0,0,'C');
$pdf->Cell(40,10, $pdf->Image("../../images/timbre-informe-marss.png", $pdf->GetX(), $pdf->GetY(),38,32),0,0,'C');


//$pdf->Cell(185,4,$pdf->Image('../../images/firma_avargas.png',0,0,0,-171),0,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Ln(7);
$pdf->Cell(185,4,utf8_decode('ALEJANDRO VARGAS CARRASCO'),0,0,'C');
$pdf->Ln(4);
$pdf->Cell(185,4,utf8_decode('JEFE ÁREA MECÁNICA DE SUELOS'),0,0,'C');
$pdf->Ln(4);
$pdf->SetFont('Arial','I',6);
$pdf->MultiCell(100,4,utf8_decode('EL PRESENTE INFORME DE ENSAYO NO DEBE SER REPRODUCIDO EXCEPTO, EN SU TOTALIDAD, SIN LA AUTORIZACIÓN DE MARSS LABORATORIOS.
LOS RESULTADOS PRESENTADOS CORRESPONDEN SOLO A LA MUESTRA ENSAYADA Y NO A UN TOTAL DEL LOTE.'),0,'J', false);

$NombreArchivo = "INF-".$NumeroSolicitud.".pdf";
$pdf->Output('I',$NombreArchivo);

?>
