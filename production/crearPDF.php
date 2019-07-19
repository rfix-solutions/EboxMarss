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

$sql = mysqli_query($link, "
SELECT
	c.id_cotizacion AS ID,
	DATE_FORMAT(c.fecha_creacion, '%d/%M/%Y') as FECHA,
	c.numero_cotizacion as COTIZACION,
	c.version_cotizacion as VERSION,
	c.nombre_contacto as CONTACTO,
	c.nombre_proyecto as PROYECTO,
	s.nombre_sucursal as SUCURSAL,
	cl.razon_social as CLIENTE,
	cl.direccion_cliente as DIRECCION,
	c.email_contacto as EMAIL

FROM
	TBL_Cotizacion c, TBL_Usuario u, TBL_Cliente cl, TBL_Sucursal s, TBL_CotizacionEstado e
WHERE
	c.id_cotizacion = '".$_GET['id']."' AND
	c.id_cliente = cl.id_cliente AND
	c.id_usuario = u.id_usuario AND
	c.id_estado_cotizacion = e.id_estado_cotizacion AND
	u.id_sucursal = s.id_sucursal
") or die('Consulta fallida: '.mysql_error());;
while($fila = mysqli_fetch_assoc($sql)){
	$cot_fecha = $fila['FECHA'];
	$cot_numero = $fila['COTIZACION'];
	$cot_proyecto = $fila['PROYECTO'];
	$cot_version = $fila['VERSION'];
	$cot_cliente = $fila['CLIENTE'];
	$cot_email = $fila['EMAIL'];
	$cot_contacto = $fila['CONTACTO'];
	$cot_direccion = $fila['DIRECCION'];
	$cot_telefono = "N/A";
}

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


//inicio pdf
require '../vendors/fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(10, 25 , 30); #Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetAutoPageBreak(true,25);
$pdf->AddPage();
$pdf->SetFont('Arial','',9);

$pdf->Image('images/banner-cotizacion.png',0,0,0,-175);


$pdf->SetFont('Arial','B', 10);
$pdf->Cell(19,5,utf8_decode('Valparaíso,'),0,0,'L');
$pdf->Cell(22, 5, utf8_decode($cot_fecha),0, 1, 'L');
$pdf->SetFont('Arial','B', 15);
$pdf->MultiCell(185,5,utf8_decode('Cotización '.$cot_numero),0,'R');
$pdf->SetFont('Arial','', 10);
$pdf->Cell(16,5,utf8_decode('Estimado '),0,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(169,5,$cot_contacto,0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Ln();


$pdf->MultiCell(185,5,utf8_decode('Tenemos el agrado de enviar a usted la cotización correspondiente a los servicios de Laboratorio para el proyecto "'.$cot_proyecto.'", de la empresa "'.$cot_cliente.'", ubicada en la localidad de "'.$cot_direccion.'".'),0,'J');
$pdf->Ln();

$pdf->MultiCell(185,5,utf8_decode('MARSS LABORATORIOS es una empresa especializada en inspecciones y ensayos de materiales, que cuenta con equipos de última generacion y personal altamente calificado para ejecutar distintos análisis y ensayos en el area de construccion y mineria, ademas se encuentra acreditado bajo la Norma Nch-ISO 17025 Of2005 en las áreas que se describen a continuación:'),0,'J');
$pdf->Ln();

// CELL (Ancho, Alto, Texto, Borde, Posicion, alineamiento, )
$pdf->Cell(60,5,utf8_decode('Asfalto (LE 447)'),0,0,'L');
$pdf->Cell(60,5,utf8_decode('Áridos (LE 448)'),0,0,'L');
$pdf->Cell(60,5,utf8_decode('Ensayo Físico - Químicos (LE 449)'),0,1,'L');
$pdf->Cell(60,5,utf8_decode('Mecánica de suelos (LE 445)'),0,0,'L');
$pdf->Cell(60,5,utf8_decode('Hormigones y Morteros (LE 446)'),0,0,'L');
$pdf->Cell(60,5,utf8_decode('Elementos y Componentes (LE 788)'),0,1,'L');
$pdf->Ln();

$pdf->MultiCell(185,5,utf8_decode('Cabe hacer presente que el Ministerio de Vivienda y Urbanismo (MINVU) ha informado a traves del documento ORD Nº1089 (21.07.09) y confirmado con ORD Nº1473 (01.09.09), que en proyectos y obras MINVU/SERVIU que están bajo su responsabilidad y/o administración, aceptaran solamente Certificados de Ensayo efectuados a partir de muestreos realizados por la institucion Oficial de Control Tecnico Acreditada, tanto en la toma de muestras como en la elaboración de los ensayos correspondientes, a contar del 01.10.09.'),0,'J');
$pdf->Ln();

$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(185,5,utf8_decode('A continuación, se presentan valores correspondientes a los servicios de laboratorio para Obras Civiles, presentación de cotización en modalidad de Precio Unitario.'),0,'J');
$pdf->Cell(80,5,utf8_decode('Ensayo'),0,0,'C');
$pdf->Cell(60,5,utf8_decode('Norma'),0,0,'C');
$pdf->Cell(30,5,utf8_decode('Acreditado'),0,0,'C');
$pdf->Cell(15,5,utf8_decode('Precio'),0,1,'C');

$sql2 = mysqli_query($link, "
	SELECT
		e.nombre_ensayo as NOMBRE_ENSAYO, n.nombre_norma_ensayo as NORMA, a.nombre_estado_acreditado as ACREDITADO, e.precio as PRECIO
	FROM
		TBL_Ensayo e, TBL_CotizacionDetalleEnsayos d, TBL_EnsayoNorma n, TBL_EnsayoAcreditacion a
	WHERE
		d.numero_cotizacion = '".$cot_numero."'  AND
		d.version_cotizacion = '".$cot_version."' AND
		e.id_ensayo = d.id_ensayo AND
		e.id_norma_ensayo = n.id_norma_ensayo AND
		e.id_estado_acreditado = a.id_estado_acreditado
")or die('Consulta fallida: '.mysql_error());;
				while($row2 = mysqli_fetch_assoc($sql2)){
					$ensayo_nombre = $row2['NOMBRE_ENSAYO'];
					$ensayo_norma = $row2['NORMA'];
					$ensayo_acreditado = $row2['ACREDITADO'];
					$ensayo_precio = $row2['PRECIO'];
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(80,5,utf8_decode($ensayo_nombre),0,0,'L');
					$pdf->Cell(60,5,utf8_decode($ensayo_norma),0,0,'L');
					$pdf->Cell(30,5,utf8_decode($ensayo_acreditado),0,0,'C');
					$pdf->Cell(15,5,utf8_decode($ensayo_precio),0,1,'C');

				}

$pdf->Ln();

$sql3 = mysqli_query($link, "
	SELECT
		a.id_destino as ID, a.nombre_destino as NOMBRE, a.precio as PRECIO
	FROM
		TBL_Destino a, TBL_CotizacionDetalleDestino b
	WHERE
		a.id_destino = b.id_destino AND
		b.numero_cotizacion = '".$cot_numero."' AND
		b.version_cotizacion = '".$cot_version."'
	")or die('Consulta fallida: '.mysql_error());;
	while($row3 = mysqli_fetch_assoc($sql3)){
		$destino_nombre = $row3['NOMBRE'];
		$destino_id = $row3['ID'];
		$destino_precio = $row3['PRECIO'];
		$total = $total+$destino_precio;

		$pdf->Cell(70,5,utf8_decode('Valor de visita de laboratorio a: '.$destino_nombre),0,0,'L');
		$pdf->Cell(20,5,utf8_decode(' UF '.$destino_precio),0,1,'R');
	}
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,5,utf8_decode('Total: '),0,0,'R');
$pdf->Cell(20,5,utf8_decode(' UF '.$total),0,1,'R');
$pdf->Ln();

$pdf->AddPage();
$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(185,5,utf8_decode('La visita a terreno contempla:'),0,'J');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(185,5,utf8_decode('a.	Laboratorista Vial C (con ayudante si la situación lo amerita).'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('b.	Toma de muestra de Suelos y/o Hormigón según corresponda.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('c.	En el caso de Hormigones: control de temperatura Hormigón y Ambiente, Control de Cono de Abrams.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('d.	En el caso de Mecánica de suelos: Clasificación USCS / AASHTO.'),0,'J');
$pdf->Ln();

$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(185,5,utf8_decode('Los plazos de entrega de los informes son los siguientes:'),0,'J');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(185,5,utf8_decode('a.	15 días hábiles para ensayos de Mecánica de suelos (se pueden solicitar informes preliminares).'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('b.	2 días hábiles posterior a rupturas de hormigón.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('c.	5 días hábiles posterior a la toma de densidad.'),0,'J');
$pdf->Ln();


$pdf->SetFont('Arial','UB',9);
$pdf->MultiCell(185,5,utf8_decode('Las políticas de Marss Laboratorios, considera que dichos plazos de entrega de sus informes, quedan condicionados al pago de la factura.'),0,'C');
$pdf->Ln();

$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(185,5,utf8_decode('Aportes de Mandante'),0,'J');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(185,5,utf8_decode('* Asegurar las condiciones óptimas de operatividad y seguridad para el trabajo del laboratorista en faena.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('* Facilitar acceso a los recintos, procurando el buen estado de los caminos.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('* Entregar planos de ubicación o croquis para la identificación de las calicatas.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('* Acceso a toma de agua para un correcto funcionamiento de los equipos.'),0,'J');
$pdf->Ln();


$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(185,5,utf8_decode('1. Recargos de Servicios'),0,'J');
$pdf->SetFont('Arial','',9);

$pdf->MultiCell(185,5,utf8_decode('Los valores anteriormente cotizados para el control de ensayos en terreno, corresponden a servicios prestados en días hábiles de lunes a viernes, entre las 08:30 y 17:00 horas, y contemplan un máximo de 80 minutos del Laboratorista en obra. Si por solicitud del cliente, o por la magnitud de las labores solicitadas a ejecutar en terreno, se trabaja fuera de este horario, se aplican los siguientes recargos:'),0,'J');
$pdf->Ln();
$pdf->MultiCell(185,5,utf8_decode('* Si se sobrepasan los 80 minutos cotizados, dentro del horario mencionado, se aplicará un recargo de 1,0 UF por cada hora que el laboratorista permanezca en faena y/o su proporción en minutos.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('* Días hábiles de lunes a viernes, entre las 17:00 y 21:00 horas, se aplicará un recargo de 1,5 UF por cada hora, o proporción de ella, que el Laboratorista permanezca en terreno. Fuera de este horario, se considerará valor de día "Domingo y festivos".'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('* Día sábado, entre las 08:30 y 21:00 horas, se cobrará un adicional de 1,5 UF por cada hora (con un mínimo de dos horas), o proporción de ella, que el Laboratorista permanezca en terreno. Fuera de este horario, se considerará valor de día "Domingo y festivos".'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('* En caso de Domingos y Festivos se cobrará un adicional de 2,0 UF por hora o proporción de ella (con un mínimo de dos horas) que el laboratorista este en faena.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('*En caso que el Laboratorista visite la Obra o Planta y no realice los controles solicitados por razones ajenas al laboratorio, este viaje será cobrado como viaje perdido (ítem valor viaje a obra).'),0,'J');
$pdf->Ln();
$pdf->MultiCell(185,5,utf8_decode('El resguardo de las probetas durante el curado inicial será responsabilidad del cliente. En caso de extravío de probetas durante este período, se cobrarán los siguientes valores (valor por molde):'),0,'J');
$pdf->Ln();
$pdf->MultiCell(185,5,utf8_decode('*Moldes Muestras Extraviadas en Obra (cilíndricas, cúbicas, prismáticas). 		4,0 UF'),0,'J');
$pdf->Ln();


$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(185,5,utf8_decode('2. Emisión y Envío de Informes Oficiales'),0,'J');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(185,5,utf8_decode('Este valor incluye la emisión de informes oficiales en formato digital con firma avanzada, según ley 19.799 y resolución MINVU. los cuáles serán enviados vía correo electrónico a la cuenta de mail indicada en el "Formulario de Aceptación de la Oferta".
En caso de solicitar Re-Envío de certificación, pasado seis meses, se considerará un valor adicional de 0,1 UF por informe y en caso de solicitar Re- Emisión, por modificación de certificación, se considerará un valor de 0,50 UF por informe.'),0,'J');
$pdf->Ln();



$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(185,5,utf8_decode('3. Aceptación de Cotización'),0,'J');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(185,5,utf8_decode('De ser aceptada esta cotización deberá enviar "Formulario de Aceptación de la Oferta" con los antecedentes allí solicitados, además de emitir orden de compra (abierta y valores en UF) correspondiente para dar el inicio a los servicios de laboratorios.'),0,'J');
$pdf->Ln();

$pdf->MultiCell(185,5,utf8_decode('En lo que respecta a programación de servicios, estos deben ser realizadas con 24 horas de anticipación, hasta las 17:00 horas, quedando sujeta a disponibilidad. Esta coordinación debe ser realizada vía mail al correo programacion@marsslab.cl o a los fonos (32) 2138800 / (56-9) 94498437.'),0,'J');
$pdf->Ln();

$pdf->MultiCell(185,5,utf8_decode('El pago de los servicios se debe realizar vía depósito o transferencia bancaria. Los datos del Laboratorio son: '),0,'J');
$pdf->Ln();


$pdf->SetFont('Arial','',8);
$pdf->Cell(185,5,utf8_decode('Rut: 76.082.270-1'),0,1,'L');
$pdf->Cell(185,5,utf8_decode('Razón Social: Soc. Marss Laboratorios y Cía. Ltda.'),0,1,'L');
$pdf->Cell(185,5,utf8_decode('Giro: Laboratorio de control de calidad'),0,1,'L');
$pdf->Cell(185,5,utf8_decode('Dirección: Décima N° 494 esquina Segunda Norte, Placilla, Valparaíso'),0,1,'L');
$pdf->Cell(185,5,utf8_decode('Cuenta Corriente Banco de Chile: 10105073-09'),0,1,'L');
$pdf->Ln();

$pdf->MultiCell(185,5,utf8_decode('Se considera como valor de la UF el correspondiente al día de emisión del estado de pago. Cabe destacar que los valores por ensayes antes indicados están en UF y son netos, se debe incluir I.V.A.'),0,'J');
$pdf->Ln();
$pdf->Cell(80,5,utf8_decode('Saluda atentamente,'),0,0,'L');
//Firmas

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','',10);
$pdf->Cell(92,5,utf8_decode('Claudio González Pajarrito'),0,0,'C');
$pdf->Cell(92,5,utf8_decode('Alejandro Vargas Carrasco'),0,1,'C');
$pdf->Cell(92,5,utf8_decode('Jefe Comercial'),0,0,'C');
$pdf->Cell(92,5,utf8_decode('Jefe Laboratorio'),0,1,'C');




?>
