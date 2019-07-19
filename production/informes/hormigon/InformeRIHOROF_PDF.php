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


$InformeHM_Qry= "
	SELECT
		F.id_form_c_h_m AS IDFORMHM,
		F.numero_solicitud AS NFORMHM,
		F.fecha_muestra AS FECHAMUESTREO,
		F.hora_control AS HORACONTROL,
		L.nombre_laboratorista AS REALIZADOPOR,
		C.FormHMTipoCurado_Nombre AS CURADO,
		D.lugar_extraccion AS LUGAREXTRACCION,
		K.FormHMComp_Nombre AS COMPRESION,
		M.FormHMMov_Nombre AS TRANSPORTE,
		A.FormHMAs_Nombre AS ASPECTO,
		D.guia AS GUIA,
		P.FormHMProb_Nombre AS PROBETA,
		D.m3 AS VOLUMEN,
		T.FormHMTex_Nombre AS TEXTURA,
		D.elemento_hormigonado AS ELEMENTOHORMIGONADO,
		O.FormHMPro_Nombre AS PROCEDENCIA,
		D.dosificacion_declarada AS DOSIFICACION,
		D.cono AS CONO,
		D.temperatura_ambiente AS TAMBIENTE,
		D.temperatura_hormigon AS THORMIGON,
		D.aditivos AS ADITIVOS,
		F.correlativo AS CORRELATIVO,
		F.cantidad_muestras AS CANTIDADMUESTRAS,
		Z.empresa_constructora AS CONSTRUYE,
		Z.empresa_solicitante AS SOLICITANTE,
		Z.direccion_obra AS DIRECCION,
		Z.nombre_solicitante AS ATSENOR,
		Z.nombre_obra AS OBRA,
		P.FormHMProb_Tipo AS TIPO
	FROM
		TBL_FormHMTipoCurado C, TBL_FormHM F, TBL_FormHMDet D, TBL_FormHMComp K, TBL_Laboratorista L, TBL_Informe I, TBL_FormHMProb P, TBL_FormHMMov M, TBL_FormHMAs A, TBL_FormHMTex T, TBL_FormHMProc O, TBL_AgendaVisita V, TBL_FormAC Z
	WHERE
		I.Informe_Id = '".$InformeId."' AND
		I.Informe_IdFormCH = F.id_form_c_h_m AND
		F.realizado_por = L.id_laboratorista AND
		F.id_form_c_h_m = D.id_form_c_h_m AND
		D.FormHMComp_Id = K.FormHMComp_Id AND
		D.FormHMProb_Id = P.FormHMProb_Id AND
		D.FormHMMov_Id = M.FormHMMov_Id AND
		D.FormHMAs_Id = A.FormHMAs_Id AND
		D.FormHMTex_Id = T.FormHMTex_Id AND
		D.FormHMPro_Id = O.FormHMPro_Id AND
		D.FormHMTipoCurado_Id = C.FormHMTipoCurado_Id AND
		F.id_agendamiento_visita = V.id_agendamiento_visita AND
		V.id_form_aceptacion = Z.id_form_aceptacion
";
$InformeHM_Sql = mysqli_query($link, $InformeHM_Qry) or die ("Error QryHM1: ". mysqli_error($link));;

while($InformeHM_Dat = mysqli_fetch_assoc($InformeHM_Sql)){
	$IDFormHM          = $InformeHM_Dat['IDFORMHM'];
	$NFormHM           = $InformeHM_Dat['NFORMHM'];
	$FechaMuestreo     = $InformeHM_Dat['FECHAMUESTREO'];
	$HoraControl       = $InformeHM_Dat['HORACONTROL'];
	$RealizadoPor      = $InformeHM_Dat['REALIZADOPOR'];
	$Curado            = $InformeHM_Dat['CURADO'];
	$LugarExtraccion   = $InformeHM_Dat['LUGAREXTRACCION'];
	$Compresion        = $InformeHM_Dat['COMPRESION'];
	$Guia              = $InformeHM_Dat['GUIA'];
	$Probeta           = $InformeHM_Dat['PROBETA'];
	$Volumen           = $InformeHM_Dat['VOLUMEN'];
	$Transporte        = $InformeHM_Dat['TRANSPORTE'];
	$Aspecto           = $InformeHM_Dat['ASPECTO'];
	$Textura           = $InformeHM_Dat['TEXTURA'];
	$ElemHormigonado   = $InformeHM_Dat['ELEMENTOHORMIGONADO'];
  $Procedencia       = $InformeHM_Dat['PROCEDENCIA'];
	$Dosificacion      = $InformeHM_Dat['DOSIFICACION'];
	$Aditivos          = $InformeHM_Dat['ADITIVOS'];
	$Cono              = $InformeHM_Dat['CONO'];
	$TAmbiente				 = $InformeHM_Dat['TAMBIENTE'];
	$THormigon				 = $InformeHM_Dat['THORMIGON'];
	$Correlativo       = $InformeHM_Dat['CORRELATIVO'];
	$CantidadMuestras  = $InformeHM_Dat['CANTIDADMUESTRAS'];
	$Construye         = $InformeHM_Dat['CONSTRUYE'];
	$Solicitante       = $InformeHM_Dat['SOLICITANTE'];
	$Direccion         = $InformeHM_Dat['DIRECCION'];
	$Obra              = $InformeHM_Dat['OBRA'];
	$AtSenor           = $InformeHM_Dat['ATSENOR'];
	$Tipo              = $InformeHM_Dat['TIPO'];
}
$DosificacionArray = explode("-", $Dosificacion);
$DosificacionTxt = $DosificacionArray[0]." ".$DosificacionArray[1]."(".$DosificacionArray[2].")".$DosificacionArray[3]."/".$DosificacionArray[4];
$InformeHMItem_Qry = "
SELECT
	D.EnsayoDetalleItem_IdEnsayoItem AS ID,
	D.EnsayoDetalleItem_ValorEnsayoItem AS VALUE,
	E.nombre_ensayo_item AS NAME,
	D.EnsayoDetalleItem_FechaOperacion AS DATEOP,
	T.edad AS EDAD,
	T.observaciones AS OBS
FROM
	TBL_EnsayoDetalleItem D, TBL_EnsayoItem E, TBL_FormHMDet T
WHERE
	D.EnsayoDetalleItem_IdSolicitudHM = '".$IDFormHM."' AND D.EnsayoDetalleItem_IdEnsayoItem = E.id_ensayo_item AND T.id_form_c_h_m = '".$IDFormHM."'
";


$InformeHMItem_Sql = mysqli_query($link, $InformeHMItem_Qry) or die ("Error en HM2 Qry: ". mysqli_error($link));;

while($InformeHMItem_Dat = mysqli_fetch_assoc($InformeHMItem_Sql)){
	switch ($InformeHMItem_Dat['ID']) {
		case '1':
			$Area = $InformeHMItem_Dat['VALUE'];
			break;

		case '2':
			$DensidadAparente = $InformeHMItem_Dat['VALUE'];
			break;

		case '3':
			$CargaMax  = $InformeHMItem_Dat['VALUE'];
			break;
		case '4':
			$ResistenciaComp  = $InformeHMItem_Dat['VALUE'];
			break;

		case '59':
			$Volumen = $InformeHMItem_Dat['VALUE'];
			break;
		case '60':
			$NCh170 = $InformeHMItem_Dat['VALUE'];
			break;

	}
	$FechaEnsayo = $InformeHMItem_Dat['DATEOP'];
	$Edad = $InformeHMItem_Dat['EDAD'];
	$Obs = $InformeHMItem_Dat['OBS'];
}

$Hoy = date("d-m-Y");

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
$pdf->Cell(110,5,utf8_decode('IDENTIFICACIÓN DE LA OBRA'),1,0,'C', TRUE);
$pdf->Cell(80,5,utf8_decode('CARACTERISTICAS DE MUESTREO'),1,1,'C', TRUE);


$pdf->Cell(35,5,utf8_decode('Solicitante'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($Solicitante),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Correlativo N°'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($Correlativo),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Dirección Cliente'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($Direccion),1,0,'L');
$pdf->Cell(40,5,utf8_decode('N° Solicitud'),1,0,'L');
$pdf->Cell(40,5, utf8_decode($NFormHM), 1, 1, 'L');

$pdf->Cell(35,5,utf8_decode('Obra'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($Obra),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Fecha Muestreo'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($FechaMuestreo),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Construye'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($Construye),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Hora de Muestreo'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($HoraControl),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Atención Sr.'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($AtSenor),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Muestra Tomada Por'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($RealizadoPor),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Ubicación Obra'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($Direccion),1,0,'L');
$pdf->Cell(40,5,utf8_decode('N° Guía Despacho'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($Guia),1,1,'L');



$pdf->SetFillColor(220,220,220);
$pdf->Cell(110,5,utf8_decode('ANTECEDENTES DE LA MEZCLA'),1,0,'C', TRUE);
$pdf->Cell(40,5,utf8_decode('Tipo Curado'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($Curado),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Objetivo de la Mezcla'),1,0,'L');
$pdf->Cell(25,5,utf8_decode('//////////'),1,0,'L');
$pdf->Cell(25,5,utf8_decode('Consistencia'),1,0,'L');
$pdf->Cell(25,5,utf8_decode('//////////'),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Tipo Compactación'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($Compresion),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Materiales Empleados'),1,0,'L');
$pdf->Cell(25,5,utf8_decode('//////////'),1,0,'L');
$pdf->Cell(25,5,utf8_decode('Contenido de Aire'),1,0,'L');
$pdf->Cell(25,5,utf8_decode('//////////'),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Tipo de Moldes'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($Tipo),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Temperatura de Mezcla'),1,0,'L');
$pdf->Cell(25,5,utf8_decode($THormigon),1,0,'L');
$pdf->Cell(25,5,utf8_decode('Dosificación'),1,0,'L');
$pdf->Cell(25,5,utf8_decode($Dosificacion),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Cantidad de Probetas'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($CantidadMuestras),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Temperatura Ambiente'),1,0,'L');
$pdf->Cell(25,5,utf8_decode($TAmbiente),1,0,'L');
$pdf->Cell(25,5,utf8_decode('Procedencia'),1,0,'L');
$pdf->Cell(25,5,utf8_decode($Procedencia),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Humedad Ambiente'),1,0,'L');
$pdf->Cell(40,5,utf8_decode('//////////'),1,1,'L');

$pdf->Cell(35,5,utf8_decode('Elemento Muestreado'),1,0,'L');
$pdf->Cell(75,5,utf8_decode($ElemHormigonado),1,0,'L');
$pdf->Cell(40,5,utf8_decode('Volumen Amasada'),1,0,'L');
$pdf->Cell(40,5,utf8_decode($Volumen),1,1,'L');

$pdf->Ln();
$pdf->SetFillColor(220,220,220);
$pdf->Cell(35,5,utf8_decode('ENSAYOS SOLICITADOS '),1,0,'L', TRUE);
$pdf->Cell(50,5,utf8_decode('NCh 171 2008'),1,0,'J', FALSE);
$pdf->Cell(105,5,utf8_decode('Extracción de muestras de hormigón fresco.'),1,1,'J');

$pdf->Cell(35,5,utf8_decode('Y NORMAS '),1,0,'L', TRUE);
$pdf->Cell(50,5,utf8_decode('NCh 2257/3 Of 1996'),1,0,'J', FALSE);
$pdf->Cell(105,5,utf8_decode('Determinación de la consistencia.'),1,1,'J');

$pdf->Cell(35,5,utf8_decode('DE'),1,0,'L', TRUE);
$pdf->Cell(50,5,utf8_decode('NCh 158 Of 1967'),1,0,'J', FALSE);
$pdf->Cell(105,5,utf8_decode('Método del asentamiento del conoEnsaye de flexión y compresión de morteros de cemento.'),1,1,'J');

$pdf->Cell(35,5,utf8_decode('REFERENCIA'),1,0,'L', TRUE);
$pdf->Cell(50,5,utf8_decode('NCh 2261 2010'),1,0,'J', FALSE);
$pdf->Cell(105,5,utf8_decode('Determinación de la resistencia mecanica de probetas confeccionadas en obra.'),1,1,'J');

$pdf->Ln(2);
$pdf->SetFont('Arial','',8);
$pdf->Cell(105,5,utf8_decode('RESULTADOS:'),0,1,'J');
$pdf->Ln(2);


$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(220,220,220);
$pdf->Cell(35,5,utf8_decode('FECHA DE ENSAYO'),1,0,'C', TRUE);
$pdf->Cell(20,5,utf8_decode('EDAD'),1,0,'C', TRUE);
$pdf->Cell(20,5,utf8_decode('AREA'),1,0,'C', TRUE);
$pdf->Cell(35,5,utf8_decode('DENSIDAD APARENTE'),1,0,'C', TRUE);
$pdf->Cell(40,5,utf8_decode('RESISTENCIA A COMPRESIÓN'),1,0,'C', TRUE);
$pdf->Cell(40,5,utf8_decode('RESISTENCIA A FLEXIÓN'),1,1,'C', TRUE);

$pdf->Cell(35,5,utf8_decode(''),1,0,'C', TRUE);
$pdf->Cell(20,5,utf8_decode('(DIAS)'),1,0,'C', TRUE);
$pdf->Cell(20,5,utf8_decode('(mm2)'),1,0,'C', TRUE);
$pdf->Cell(35,5,utf8_decode('(kg/m3)'),1,0,'C', TRUE);
$pdf->Cell(40,5,utf8_decode('(kN)'),1,0,'C', TRUE);
$pdf->Cell(40,5,utf8_decode('(MPa)'),1,1,'C', TRUE);

for($i=1;$i<=5;$i++){
  $pdf->Cell(35,10,utf8_decode($FechaEnsayo),1,0,'C');
  $pdf->Cell(20,10,utf8_decode($Edad),1,0,'C');
  $pdf->Cell(20,10,utf8_decode($Area),1,0,'C');
  $pdf->Cell(35,10,utf8_decode($DensidadAparente),1,0,'C');
  $pdf->Cell(40,10,utf8_decode($ResistenciaComp),1,0,'C');
  $pdf->Cell(40,10,utf8_decode($ResistenciaComp),1,1,'C');
}

$pdf->Ln(2);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(105,5,utf8_decode('LOS VALORES INDICADOS CORRESPONDEN AL PROMEDIO DE TRES PROBETAS ENSAYADAS.'),0,1,'J');
$pdf->Ln(2);
$pdf->Cell(105,5,utf8_decode('CONDICIÓN APARENTE DE HUMEDAD DE PROBETAS:'),0,1,'J');
$pdf->SetFont('Arial','',8);
$pdf->Cell(105,5,utf8_decode(''),0,1,'J');
$pdf->Ln(2);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(105,5,utf8_decode('OBSERVACIONES RELATIVAS AL MORTERO DESPUES DE LA ROTURA:'),0,1,'J');
$pdf->SetFont('Arial','',8);
$pdf->Cell(105,5,utf8_decode($Obs),0,1,'J');
$pdf->Ln(2);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(105,5,utf8_decode('OBSERVACIONES:'),0,1,'J');
$pdf->SetFont('Arial','',8);
$pdf->Cell(105,5,utf8_decode(''),0,1,'J');
$pdf->Ln(10);




$pdf->Image('../../images/firma_avargas.jpg',85,230,-125);
$pdf->Image('../../images/timbre_marss.jpg',145,230,-125);
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,5,utf8_decode('Alejandro Vargas Carrasco'),0,1,'C');
$pdf->Cell(190,5,utf8_decode('Jefe Laboratorio'),0,1,'C');

$pdf->Output('I','Informe_'.$InformeFolio.'_'.date("Y-m-d H:i:s"), TRUE);

?>
