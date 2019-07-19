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

$sql_form_aceptacion = "
SELECT
	F.id_form_aceptacion,
	F.empresa_solicitante,
	F.fecha_aceptacion,
	F.nombre_solicitante,
	F.email_solicitante,
	F.nombre_obra,
	F.codigo_obra,
	F.direccion_obra,
	F.comuna_obra,
	F.empresa_constructora,
	F.fono_obra,
	F.encargado_terreno,
	F.email_encargado,
	F.telefono_encargado,
	E.nombre_entidad as entidad_fiscal,
	F.empresa_encargada,
	F.profesional_acargo,
	F.razon_social,
	F.rut_empresa_factura,
	F.giro_empresa,
	F.direccion_factura,
	F.nombre_ciudad,
	P.nombre as periodo_facturacion,
	FP.nombre_forma_pago as forma_pago,
	F.email_facturacion,
	F.telefono_facturacion,
	F.nombre_aceptante,
	co.comuna_nombre AS COMUNA,
	pr.provincia_nombre AS PROVINCIA,
	re.region_nombre AS REGION

FROM
	TBL_FormAC F, TBL_EntidadFiscal E, TBL_PeriodoFacturacion P, TBL_FormaPago FP, TBL_Comuna co, TBL_Provincia pr, TBL_Region re
WHERE
	F.id_cotizacion='".$_GET['id']."' AND
	F.id_entidad_fiscal = E.id_entidad_fiscal AND
	F.id_periodo_facturacion = P.id_periodo_facturacion AND
	F.id_forma_pago = FP.id_forma_pago AND
	F.comuna_obra = co.comuna_id AND
	co.provincia_id = pr.provincia_id AND
	pr.region_id = re.region_id
";
$query_form_aceptacion = mysqli_query($link, $sql_form_aceptacion)or die('Consulta fallida: '.mysql_error());;
$result_form_aceptacion = mysqli_num_rows($query_form_aceptacion);
$readonly = "";
if($result_form_aceptacion!=0){
	while($datos_formulario = mysqli_fetch_assoc($query_form_aceptacion)){
		$form_id_form_aceptacion = "Aceptacion_nro_".$datos_formulario['id_form_aceptacion'].".pdf";
		$form_empresa_solicitante = $datos_formulario['empresa_solicitante'];
		$form_fecha_aceptacion = $datos_formulario['fecha_aceptacion'];
		$form_nombre_solicitante = $datos_formulario['nombre_solicitante'];
		$form_email_solicitante = $datos_formulario['email_solicitante'];
		$form_nombre_obra = $datos_formulario['nombre_obra'];
		$form_codigo_obra = $datos_formulario['codigo_obra'];
		$form_comuna_obra = $datos_formulario['comuna_obra'];
		$form_direccion_obra = $datos_formulario['direccion_obra'];
		$form_fono_obra = $datos_formulario['fono_obra'];
		$form_encargado_terreno = $datos_formulario['encargado_terreno'];
		$form_email_encargado = $datos_formulario['email_encargado'];
		$form_telefono_encargado = $datos_formulario['telefono_encargado'];
		$form_entidad_fiscal = $datos_formulario['entidad_fiscal'];
		$form_empresa_encargada = $datos_formulario['empresa_encargada'];
		$form_empresa_constructora = $datos_formulario['empresa_constructora'];
		$form_profesional_acargo = $datos_formulario['profesional_acargo'];
		$form_razon_social = $datos_formulario['razon_social'];
		$form_rut_empresa_factura = $datos_formulario['rut_empresa_factura'];
		$form_giro_empresa = $datos_formulario['giro_empresa'];
		$form_direccion_factura = $datos_formulario['direccion_factura'];
		$form_nombre_ciudad = $datos_formulario['nombre_ciudad'];
		$form_id_periodo_facturacion = $datos_formulario['periodo_facturacion'];
		$form_forma_pago = $datos_formulario['forma_pago'];
		$form_telefono_facturacion = $datos_formulario['telefono_facturacion'];
		$form_email_facturacion = $datos_formulario['email_facturacion'];
		$form_nombre_aceptante = $datos_formulario['nombre_aceptante'];
		$form_comuna = $datos_formulario['COMUNA'];
		$form_provincia = $datos_formulario['PROVINCIA'];
		$form_region = $datos_formulario['REGION'];
	}
}

$query = mysqli_query($link, "
SELECT
	c.id_cotizacion AS ID,
	c.numero_cotizacion as COTIZACION
FROM
	TBL_Cotizacion c
WHERE
	c.id_cotizacion = '".$_GET['id']."'
	")or die('Consulta fallida: '.mysql_error());;

while($result = mysqli_fetch_assoc($query)){
	$cotizacion_id = $result['ID'];
	$cotizacion_numero = $result['COTIZACION'];
}





require '../vendors/fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(10, 25 , 30); #Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetAutoPageBreak(true,25);
$pdf->AddPage();
$pdf->Image('images/banner-aceptacion.png',0,0,0,-175);
$pdf->SetFont('Arial','I',10);
$pdf->SetTextColor(115,135,159);  // Establece el color del texto: gris
$pdf->Cell(190,5,utf8_decode('Servicios de Laboratorio de Construcción, Ensayos de Materiales, Análisis Químicos y Ensayos No Destructivos'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('Arial','B',15);
$pdf->Cell(190,10,utf8_decode('ACEPTACIÓN DE COTIZACIÓN Y ANTECEDENTES DE OBRA'),0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,5,utf8_decode('Cotización N°'),0,1,'C');
$pdf->Cell(190,5,utf8_decode($cotizacion_numero),0,1,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(255,255,255); // Establece el color de la celda: blanca
$pdf->MultiCell(190,5,utf8_decode('Por medio de la presente acepto los términos de la oferta técnico / económica Nº SCL-251-2018 propuesta por Sociedad Marss Laboratorios y Cía. Ltda. para proceder con el servicio en ella señalado.'),0,'C', False);
$pdf->Ln();



/*========================== SECCION ==========================*/
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,255,255);  // Establece el color del texto: gris
$pdf->SetFillColor(19,17,156); // Establece el color de la celda: azul
$pdf->Cell(190,7,utf8_decode('Antecedentes de Aceptación de Cotización'),0,1,'L', True);
$pdf->Cell(190,2,utf8_decode(''),0,1,'L', False);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(115,135,159);  // Establece el color del texto: gris

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Empresa que solicita el servicio de Laboratorio'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_empresa_solicitante),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Nombre autorizado para solicitar informe'),0,0,'L', False);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_nombre_solicitante),0,1,'L', False);

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Email autorizado para solicitar informe'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_email_solicitante),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Fecha de aceptación de cotización'),0,0,'L', False);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_fecha_aceptacion),0,1,'L', False);

$pdf->Ln();
$pdf->Ln();
/*========================== SECCION ==========================*/
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,255,255);  // Establece el color del texto: gris
$pdf->SetFillColor(19,17,156); // Establece el color de la celda: azul
$pdf->Cell(190,7,utf8_decode('Antecedentes de Obra'),0,1,'L', True);
$pdf->Cell(190,2,utf8_decode(''),0,1,'L', False);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(115,135,159);  // Establece el color del texto: gris

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Empresa Constructora'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_empresa_constructora),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Nombre de la obra'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_nombre_obra),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Código de la obra (N° de licitación)'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_codigo_obra),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Dirección de obra'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_direccion_obra),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Encargado de Terreno'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_encargado_terreno),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Email de Profesional'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_email_encargado),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Teléfono del Profesional'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_telefono_encargado),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Entidad Fiscalizadora'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_entidad_fiscal),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Fono de obra'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_fono_obra),0,1,'L', True);

$pdf->Ln();
$pdf->Ln();
/*========================== SECCION ==========================*/
/*========================== SECCION ==========================*/
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(255,255,255);  // Establece el color del texto: gris
$pdf->SetFillColor(19,17,156); // Establece el color de la celda: azul
$pdf->Cell(190,7,utf8_decode('Antecedentes para facturación'),0,1,'L', True);
$pdf->Cell(190,2,utf8_decode(''),0,1,'L', False);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(115,135,159);  // Establece el color del texto: gris

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Razon Social'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_razon_social),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Rut de Empresa'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_rut_empresa_factura),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Giro de Empresa'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_giro_empresa),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Dirección de facturación y envío'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_direccion_factura),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Forma de pago'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_forma_pago),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Periodo de facturación'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_id_periodo_facturacion),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Teléfono para Facturación'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_telefono_facturacion),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(255, 255, 255); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Email de Facturación'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_email_facturacion),0,1,'L', True);

/*====================================*/
$pdf->SetFillColor(238, 238, 238); // Establece el color de la celda: gris
$pdf->Cell(90,5,utf8_decode('Nombre de quien acepta'),0,0,'L', True);
$pdf->Cell(5,5,'',0,0,'L'); //Espacio
$pdf->Cell(95,5,utf8_decode($form_nombre_aceptante),0,1,'L', True);

$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','I',10);
$pdf->SetTextColor(115,135,159);  // Establece el color del texto: gris
$pdf->MultiCell(190,5,utf8_decode('Los datos existentes en este documento serán los que posteriormente se utilicen para la emisión de los informes de servicio asociados a la cotización aceptada'),0,'C');



$pdf->Ln();


if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}




$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getBrowser($user_agent){

if(strpos($user_agent, 'MSIE') !== FALSE)
   return 'EXPLORER';
 elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
   return 'EDGE';
 elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    return 'EXPLORER';
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
   return "OPERAMINI";
 elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
   return "OPERA";
 elseif(strpos($user_agent, 'Firefox') !== FALSE)
   return 'FIREFOX';
 elseif(strpos($user_agent, 'Chrome') !== FALSE)
   return 'CHROME';
 elseif(strpos($user_agent, 'Safari') !== FALSE)
   return "SAFARI";
 else
   return 'UND';
}
$navegador = getBrowser($user_agent);

$emision = date("d-m-Y H:i:s")."-USR:".$_SESSION['id_user']."-".$ip."-".$navegador;


$pdf->SetFont('Courier','B',7);
$pdf->SetTextColor(115,135,159);  // Establece el color del texto: gris
$pdf->Cell(190,10,utf8_decode($emision),0,0,'L', True);


$pdf->Output('I',$form_id_form_aceptacion);
