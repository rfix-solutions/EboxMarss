<?php

session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} 
else 
{?>
	<script type="text/javascript">
		alert("Esta pagina es solo para usuarios registrados.")
		location.href="https://www.ebox.cl";
	</script>	
<?php
		exit;
}
include '_qry/db_connect_local.php';
setlocale(LC_ALL,"es_ES");
date_default_timezone_set('America/Santiago');

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
	tbl_cotizacion c, tbl_usuarios u, tbl_cliente cl, tbl_sucursal s, tbl_estado_cotizacion e
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







	$sql2 = mysqli_query($link, "
		SELECT 
			e.id_ensayo as ID, e.nombre_ensayo as NOMBRE_ENSAYO, e.precio as PRECIO 
		FROM 
			tbl_ensayo e, tbl_detalle_ensayos_cotizacion d
		WHERE 
			e.id_ensayo = d.id_ensayo AND
			d.numero_cotizacion = '".$cot_numero."' AND
			d.version_cotizacion = '".$cot_version."'
		")or die('Consulta fallida: '.mysql_error());;


	function seleccionar_datos($sql2){

		$valores = array();

		while($row2 = mysqli_fetch_assoc($sql2)){
			$ensayo_id = $row2['ID'];
			$ensayo_nombre = $row2['NOMBRE_ENSAYO'];
			$ensayo_precio = $row2['PRECIO'];	
			array_push($valores, $row2);
			
		}

	}


	function cabeceraHorizontal($cabecera)
	{
        $this->SetXY(10, 10);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $ejeX = 10;
        foreach($cabecera as $fila)
        {
            $this->RoundedRect($ejeX, 10, 40, 7, 2, 'FD');
            $this->CellFitSpace(40,7, utf8_decode($fila),0, 0 , 'C');
            $ejeX = $ejeX + 40;
        }
    }
 
    function datosHorizontal($datos)
    {
        $this->SetXY(10,17);
        $this->SetFont('Arial','',10);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        $ejeY = 17; //Aquí se encuentra la primer CellFitSpace e irá incrementando
        $letra = 'D'; //'D' Dibuja borde de cada CellFitSpace -- 'FD' Dibuja borde y rellena
        foreach($datos as $fila)
        {
            //Por cada 3 CellFitSpace se crea un RoundedRect encimado
            //El parámetro $letra de RoundedRect cambiará en cada iteración
            //para colocar FD y D, la primera iteración es D
            //Solo la celda de enmedio llevará bordes, izquierda y derecha
            //Las celdas laterales colocarlas sin borde
            $this->RoundedRect(10, $ejeY, 120, 7, 2, $letra);
            //$this->CellFitSpace(40,7, utf8_decode($fila['id_user']),0, 0 , 'L' );
            $this->CellFitSpace(40,7, utf8_decode($fila['ID']),0, 0 , 'L' );
            $this->CellFitSpace(40,7, utf8_decode($fila['NOMBRE_ENSAYO']),'LR', 0 , 'L' );
            $this->CellFitSpace(40,7, utf8_decode($fila['PRECIO']),0, 0 , 'L' );
 
            $this->Ln();
            //Condición ternaria que cambia el valor de $letra
            ($letra == 'D') ? $letra = 'FD' : $letra = 'D';
            //Aumenta la siguiente posición de Y (recordar que X es fijo)
            //Se suma 7 porque cada celda tiene esa altura
            $ejeY = $ejeY + 7;
        }
    }
 








//inicio pdf
require '../vendors/fpdf/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(255, 255, 255); 
$pdf->SetTextColor(0,0,0);
$pdf->Image('images/Logo_marss-lab_255x100.jpg',10,5,45);
$pdf->Image('images/logo_inn-424x100.png',125,7,80);
$pdf->MultiCell(185,5,'',0,'L');
$pdf->MultiCell(185,5,'',0,'L');
$pdf->MultiCell(185,5,'',0,'L');
$pdf->MultiCell(185,5,'',0,'L');
$pdf->SetFont('Arial','B', 10);
$pdf->Cell(19,5,utf8_decode('Valparaíso,'),0,0,'L');
$pdf->Cell(22, 5, utf8_decode($cot_fecha),0, 1, 'L');
$pdf->SetFont('Arial','B', 15);
$pdf->MultiCell(185,5,$cot_numero,0,'R');
$pdf->SetFont('Arial','', 10);
$pdf->Cell(16,5,utf8_decode('Estimado '),0,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(169,5,$cot_contacto,0,1,'L');
$pdf->SetFont('Arial','',10);                                                       
$pdf->MultiCell(185,5,'',0,'L');

$pdf->MultiCell(185,5,utf8_decode('Tenemos el agrado de enviar a usted la cotización correspondiente a los servicios de Laboratorio para el proyecto "'.$cot_proyecto.'", de la empresa "'.$cot_cliente.'", ubicada en la localidad de "'.$cot_direccion.'".'),0,'J');


$pdf->MultiCell(185,5,utf8_decode('MARSS LABORATORIOS es una empresa especializada en inspecciones y ensayos de materiales, que cuenta con equipos de última generacion y personal altamente calificado para ejecutar distintos análisis y ensayos en el area de construccion y mineria, ademas se encuentra acreditado bajo la Norma Nch-ISO 17025 Of2005 en las áreas que se describen a continuación:'),0,'J');

$pdf->MultiCell(185,5,'',0,'L');

$pdf->MultiCell(185,5,utf8_decode('Asfalto (LE 447) Áridos (LE 448) Ensayo Físico - Químicos (LE 449)'),0,'J');

$pdf->MultiCell(185,5,utf8_decode('Mecánica de suelos (LE 445) Hormigones y Morteros (LE 446) Elementos y Componentes (LE 788) '),0,'J');
$pdf->MultiCell(185,5,'');
$pdf->MultiCell(185,5,utf8_decode('Cabe hacer presente que el Ministerio de Vivienda y Urbanismo (MINVU) ha informado a traves del documento ORD Nº1089 (21.07.09) y confirmado con ORD Nº1473 (01.09.09), que en proyectos y obras MINVU/SERVIU que están bajo su responsabilidad y/o administración, aceptaran solamente Certificados de Ensayo efectuados a partir de muestreos realizados por la institucion Oficial de Control Tecnico Acreditada, tanto en la toma de muestras como en la elaboración de los ensayos correspondientes, a contar del 01.10.09.'),0,'J');
$pdf->MultiCell(185,5,'');
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(185,5,utf8_decode('A continuación, se presentan valores correspondientes a los servicios de laboratorio para Obras Civiles, presentación de cotización en modalidad de Precio Unitario.'),0,'J');

/*			
				$pdf->Cell(15,5,utf8_decode('ID'),1,0,'C');
				$pdf->Cell(158,5,utf8_decode('Ensayo'),1,0,'C');
				$pdf->Cell(12,5,utf8_decode('Precio'),1,1,'R');
*/			



$datosReporte = seleccionar_datos($sql2);

$miCabecera = array('ID','Ensayo','Precio');
// Carga de datos


$pdf->cabeceraHorizontal($miCabecera);
$pdf->datosHorizontal($datosReporte);


$pdf->SetFont('Arial','',10);
$pdf->MultiCell(185,5,'',0,1,'L');
$pdf->SetFont('Arial','UB',10);
$pdf->Cell(10,5,utf8_decode('Nota:'),0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(175,5,utf8_decode('el valor es por cada probeta'),0,1,'L');
$pdf->MultiCell(185,5,'');
$pdf->MultiCell(185,5,utf8_decode('Valor de visita de laboratorio a:_______'),0,'C');

$pdf->MultiCell(185,5,'',0,'L');
$pdf->SetFont('Arial','UB',10);
$pdf->MultiCell(185,5,utf8_decode('Esta contempla lo siguiente:'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(185,5,'',0,'L');

$pdf->MultiCell(185,5,utf8_decode('1. Personal de Laboratorio calificado.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('2. Disponibilidad 100% en faena, de acuerdo a la ley laboral vigente.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('3. Horario de Trabajo en jornada diurna (a acordar con mandante), válido de Lunes a Viernes horario diurno, si los'),0,1,'J');
$pdf->MultiCell(185,5,utf8_decode('    trabajos a realizar corresponden a día Sábado tendrá un recargo del 50% en valor cotizado, para los días'),0,1,'J');
$pdf->Cell(185,5,utf8_decode('    Domingos y/o Feriados se hará un recargo del 100% al valor cotizado.'),0,1,'J');

$pdf->MultiCell(185,5,utf8_decode('4. Las horas trabajadas corresponden de 9:00 horas a 17:00 horas con una hora de colación, fuera de este horario'),0,'J');
$pdf->Cell(185,5,utf8_decode('    corresponderá a sobretiempo cuyo valor será de 1,0 UF por cada hora que el personal de Laboratorio permanezca'),0,1,'J');
$pdf->Cell(185,5,utf8_decode('    en Obra.'),0,1,'J');
$pdf->MultiCell(185,5,utf8_decode('5. Asesoría Técnica de parte del Laboratorio a través de profesionales competentes en las distintas áreas'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('    acreditadas.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('6. El Laboratorio hará entrega de Ropa y equipamiento de seguridad ad hoc para la realización óptima de los'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('    trabajos solicitados.'),0,1,'L');
$pdf->MultiCell(185,5,'',0,1,'L');
$pdf->SetFont('Arial','UB','10');
$pdf->MultiCell(185,5,utf8_decode('El valor cotizado incluye:'),0,'L');
$pdf->SetFont('Arial','','10');
$pdf->MultiCell(185,5,'',0,1,'L');
$pdf->MultiCell(185,5,utf8_decode('1. Toma de muestra de suelos según MN Vol. 8102.1 (2013)'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('2. Toma de muestra de áridos, según NCh 164 Of.76'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('3. Densidades en Terreno LIBRES (Densímetro Nuclear) NCh 1516. Of1979 o MC Vol. 8.8.502.1 (2013)'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('4. Toma de muestra de Hormigón fresco en obra y docilidad, según NCh1019. Of2009 y NCh171.EOf1975'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('5. Extracción de testigos de pavimento de hormigón, hasta un espesor no mayor a 20 cm (Broca de 4") según'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('    NCh 1171/1 Of2001'),0,1,'J');
$pdf->MultiCell(185,5,utf8_decode('6. Muestreo de mezclas bituminosas, según MC Vol.8.8.302.27 (2013)'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('7. Densidad en terreno de capas asfálticas (método nuclear) MC Vol.8.8.502.9 (2013)'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('8. Vehículo equipado para faena, traslado de personal, traslado de personal y equipos de laboratorio'),0,'J');
$pdf->MultiCell(185,5,utf8_decode('9. Emisión de informes oficiales en formato digital con firma digital avanzada, según ley 19.799 y resolución MINVU'),0,'J');
$pdf->MultiCell(185,5,'',0,'L');
$pdf->SetFont('Arial','UB','10');
$pdf->MultiCell(185,5,utf8_decode('Aportes Técnicos Para su comodidad Los plazos de entrega de los informes son los siguientes:'),0,'J');
$pdf->SetFont('Arial','','10');
$pdf->MultiCell(185,5,'',0,'L');
$pdf->MultiCell(185,5,utf8_decode('a. 18 días de corrido para ensayos de Mecánica de suelos, desde que el laboratorista realiza el muestreo, además'),0,'L');
$pdf->MultiCell(185,5,utf8_decode('    tener en consideración que se pueden solicitar informes preliminares.'),0,1,'J');
$pdf->MultiCell(185,5,utf8_decode('b. días hábiles posterior a rupturas de hormigón se puede efectuar la entrega de informe.'),0,'L');


$pdf->MultiCell(185,5,'',0,'L');
$pdf->SetFillColor(255, 255, 255); 
$pdf->SetTextColor(0,0,0); 
$pdf->SetFont('Arial','UB',10); 
$pdf->Cell(185,5,'',0,1,'L');
$pdf->Cell(185,5,utf8_decode('Las políticas de Marss Laboratorios, considera que dichos plazos de entrega de sus informes, quedan '),0,1,'J');
$pdf->Cell(185,5,utf8_decode('condicionados al pago de la factura.'),0,1,'L');
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(185,5,utf8_decode('Aportes de Mandante'),0,'L');
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(185,5,utf8_decode('           -Asegurar las condiciones óptimas de operatividad y seguridad para el trabajo del laboratorista en faena.'),0,'L');

$pdf->MultiCell(185,5,utf8_decode('           -Facilitar al laboratorio las medidas de seguridad necesarias para la ejecución de los trabajos.'),0,'L');	

$pdf->MultiCell(185,5,utf8_decode('           -Facilitar acceso a los recintos, procurando el buen estado de los caminos.'),0,'L');

$pdf->MultiCell(185,5,utf8_decode('           -Entregar planos de ubicación o croquis para la identificación de las calicatas.'),0,'L');

$pdf->MultiCell(185,5,utf8_decode('           -Acceso a toma de agua para un correcto funcionamiento de los equipos.'),0,'L');

$pdf->SetFont('Arial','UB',10);
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode('1. Emisión y Envío de Informes Oficiales'),0,'J');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(185,5,utf8_decode(''),0,1,'L');
$pdf->MultiCell(185,5,utf8_decode('Este valor incluye la emisión de informes oficiales en formato digital con firma avanzada, según ley 19.799 y resolución MINVU. Los cuáles serán enviados vía correo electrónico a la cuenta de mail indicada en el "Formulario de Aceptación de la Oferta."'),0,1,'J');
/*
$pdf->MultiCell(185,5,utf8_decode('Este valor incluye la emisión de informes oficiales en formato digital con firma avanzada, según ley 19.799 y resolución MINVU. Los cuáles serán enviados vía correo electrónico a la cuenta de mail indicada en el "Formulario de Aceptación de la Oferta."'),0,0,'J');
*/
$pdf->MultiCell(185,5,utf8_decode('En caso de solicitar Re-Envío de certificación, pasado seis meses, se considerará un valor adicional de 0,1 UF por Informe.'),0,1,'J');
$pdf->Cell(156,5,utf8_decode('En caso de solicitar Re- Emisión, por modificación de certificación, se considerará un valor de 0,1 UF por Informe.'),0,1,'J');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(148,5,utf8_decode('0,50 UF por Informe.'),0,1,'L');
$pdf->SetFont('Arial','UB',10);
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode('2. Antecedentes Generales'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode('El resguardo de las probetas durante el curado inicial será responsabilidad del cliente. En caso de extravío de probetas durante este período, se cobrarán los siguientes valores (valor por molde):'),0,'L');
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->Cell(135,5,utf8_decode('Moldes Muestras Cilíndricas Extraviadas en Obra.  '),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,utf8_decode('    4,0 UF'),0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(135,5,utf8_decode('Moldes Muestras Cubicas Extraviadas en Obra.      '),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,utf8_decode('    3,5 UF'),0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(135,5,utf8_decode('Moldes Muestras Prismáticas Extraviadas en Obra.'),0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,utf8_decode('    4,5 UF'),0,1,'L');
$pdf->SetFont('Arial','UB',10);
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode('Aceptación de la cotización'),0,'L');
$pdf->SetFont('Arial','',10);

$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->Cell(74,5,utf8_decode('De ser aceptada esta cotización deberá enviar'),0,0,'J');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(68,5,utf8_decode('"Formulario de Aceptación de la Oferta"'),0,0,'J');
$pdf->SetFont('Arial','',10);
$pdf->Cell(43,5,utf8_decode('con los antecedentes allí'),0,1,'J');
$pdf->Cell(74,5,utf8_decode('solicitados, además de emitir orden de compra'),0,0,'J');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(42,5,utf8_decode('(abierta y valores en UF)'),0,0,'J');
$pdf->SetFont('Arial','',10);
$pdf->Cell(69,5,utf8_decode('correspondiente para dar el inicio a los'),0,1,'J');
$pdf->Cell(69,5,utf8_decode('servicios de laboratorio.'),0,1,'J');
$pdf->MultiCell(185,5,utf8_decode(''),0,1,'L');
$pdf->Cell(185,5,utf8_decode('En lo que respecta a programación de servicios, estos deben ser realizadas con 24 horas de anticipación, hasta las'),0,1,'J');
$pdf->Cell(185,5,utf8_decode('17:00 horas, quedando sujeta a disponibilidad. Esta coordinación debe ser realizada vía mail al correo'),0,1,'J');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(48,5,utf8_decode('programación@marsslab.cl'),0,0,'J');
$pdf->SetFont('Arial','',10);
$pdf->Cell(21,5,utf8_decode('o a los fonos'),0,0,'J');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(116,5,utf8_decode('032-2138800/+56 9 94498437.'),0,0,'J');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode('El pago de los servicios se debe realizar vía depósito o transferencia bancaria. Los datos del Laboratorio son: Razón Social: Soc. Marss Laboratorios y Cía. Ltda., Rut: 76.082.270-1, Giro: Laboratorio de control de calidad, Cuenta Corriente Banco de Chile: 10105073-09, Dirección: Calle Décima N° 494 esquina Segunda Norte Placilla - Valparaíso.'),0,'J');
$pdf->MultiCell(185,5,utf8_decode(''),0,'J');
$pdf->MultiCell(185,5,utf8_decode('Se considera como valor de la UF el correspondiente al día de emisión del estado de pago cabe destacar que los valores por ensayes antes indicados están en UF y son netos, se debe incluir I.V.A. '),0,'J');
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode('Lo mantendremos informado de cualquier novedad que se produzca durante el proceso, esperando una buena acogida.'),0,1,'J');
//Firmas
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode(''),0,'L');
$pdf->MultiCell(185,5,utf8_decode('Claudio González Pajarrito                                                    Alejandro Vargas Carrasco'),0,'C');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(185,5,utf8_decode('Jefe Comercial                                                                            Jefe Laboratorio'),0,'C');


//visualización PDF
$pdf->Output();

//Guarda PDF en la ubicación y nombre escogidos
$pdf->Output('F','cotizaciones/'.$cot_numero.'.pdf',true);

?>