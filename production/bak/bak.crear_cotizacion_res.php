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
mysql_set_charset('utf8');
setlocale(LC_ALL,"es_ES");
date_default_timezone_set('America/Santiago').
$sql_ = mysql_query("
SELECT s.codigo_sucursal as SUCURSAL
FROM tbl_usuarios u, tbl_sucursal s
WHERE
	u.id_usuario = '".$_SESSION['id_user']."' AND
	u.id_sucursal = s.id_sucursal
");
while($rows = mysql_fetch_assoc($sql_)){	$sucursal = $rows['SUCURSAL']; }

$sql__ = mysql_query("SELECT MAX(id_correlativo_cotizacion) as CORRELATIVO FROM tbl_correlativo_cotizacion");
while($rows = mysql_fetch_assoc($sql__)){ 
	$correlativo = $rows['CORRELATIVO']; 
	if($correlativo==null){ $correlativo = 0; }
	$correlativo++; 
}

$n_cotizacion = $sucursal."-".$correlativo."-".date("Y");
$sql___ = mysql_query("
	INSERT INTO tbl_correlativo_cotizacion
	(codigo_sucursal, ano)
	VALUES
	('".$sucursal."', '".date("Y")."')
");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EBOX - COTIZACION: <?php echo $n_cotizacion; ?></title>
	<style>
		html,body{
			height:297mm;
			width:210mm;
			text-align: center;
			background-color: darkgrey;
			font-family: arial;
			font-size: 12px;
		}
		#pagina{
			padding: 20px 35px 20px 35px; /* _Arriba _derecha _Abajo _Izquierda*/ 
			background-color: white;
			text-align: justify;
		}
		#footer{
			font-size: 13px;
			text-align: center;
			padding-top: 10px;
			padding-bottom: 10px;
			color: white;
			background-color: #81B703;
			width: 100%;
			text-decoration-style: double;
			
			
		}
		#footer_borde{
			background-color: #171693;
			height: 10px;			
		}
		#logo{
			height: 70%
		}
		#servicios{
			align-content: center;
			font-size: 12px;
			
		}
	</style>
</head>

<body>
	<?php 
	$rut_cliente = $_GET['rut_cliente'];	
	$nombre_cliente = strtoupper($_GET['nombre_cliente']);	
	$nombre_proyecto = strtoupper($_GET['nombre_proyecto']);	
	$localidad = strtoupper($_GET['localidad']);	
	$email = strtoupper($_GET['email']);
	$contacto = strtoupper($_GET['contacto']);	
	$telefono = $_GET['telefono'];	
	$origen = $_GET['origen'];	
	$ensayos = $_GET['ensayos'];	
	$destinos = $_GET['destinos'];	
	$tipo_descuento = $_GET['tipo_descuento'];	
	$valor_descuento = $_GET['valor_descuento'];	
	$autoriza = $_GET['autoriza'];
	$fecha = date("Y-m-d H:i:s");
	
	$insert_tbl_cliente = mysql_query("
	INSERT INTO tbl_cliente
	(rut_cliente, razon_social, direccion_cliente, contacto_cliente, telefono_cliente, email_cliente)
	VALUES
	('".$rut_cliente."', '".$nombre_cliente."', '".$localidad."', '".$contacto."', '".$telefono."', '".$email."')
	")or die('Consulta fallida: '.mysql_error());;
	
	$sql_cliente = mysql_query("SELECT id_cliente FROM tbl_cliente WHERE rut_cliente ='".$rut_cliente."'")or die('Consulta fallida: '.mysql_error());;
	while($fila = mysql_fetch_assoc($sql_cliente)){
		$id_cliente = $fila['id_cliente'];
	}
	
	$insert_tbl_cotizacion = mysql_query("
	INSERT INTO tbl_cotizacion
	(id_cliente, id_tipo_descuento, id_origen, numero_cotizacion, version_cotizacion, nombre_proyecto, fecha_creacion, nombre_contacto, email_contacto, id_usuario, id_estado_cotizacion)
	VALUES
	('".$id_cliente."', '".$tipo_descuento."', '".$origen."', '".$n_cotizacion."', '1', '".$nombre_proyecto."', '".$fecha."', '".$contacto."', '".$email."', '1', '1')	
	")or die('Consulta fallida: '.mysql_error());;
	
	
	
	
	
	
	
	?>
<div id="pagina" >
		<table style="width: 100%">
			<tr>
				<td style="text-align: left"><img id="logo" src="images/Logo_marss-lab_255x100.jpg" ></td>
				<td style="text-align: right"><img id="logo" src="images/logo_inn-424x100.png" ></td>
			</tr>
		</table>
	
	
	<p style="text-align: justify">
		<table style="width: 100%">
			<tr>
				<td style="text-align: left"><strong>Valparaíso, 
					<?php 
						$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
						$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
						echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
						?></strong></td>
				<td style="text-align: right; font-size: 16px;"><strong>COTIZACION: <?php echo $n_cotizacion;?></strong></td>
			</tr>
		</table><br>


		Estimado 
		<strong><?php echo $contacto;?>, <?php echo $email;?>, <?php echo $telefono; ?></strong></br><br>


		Tenemos el agrado de enviar a usted la cotización correspondiente a los servicios de Laboratorio para el proyecto <strong>“<?php echo $nombre_proyecto;?>”</strong>, de la empresa <strong>“<?php echo $nombre_cliente;?>”</strong>, ubicada en la localidad de <strong><?php echo $localidad;?></strong>.
		</br>

		<strong>MARSS LABORATORIOS</strong> es una empresa especializada en inspecciones y ensayos de materiales, que cuenta con equipos de última generación y personal altamente calificado para ejecutar distintos análisis y ensayes en el área construcción y minería, además se encuentra acreditado bajo la Norma Nch – ISO 17025 Of 2005 en las áreas que se 	describen a continuación:
		</br></br>

		Asfalto (LE 447) Áridos (LE 448) Ensayo Físico - Químicos (LE 449)</br>
		Mecánica de suelos (LE 445) Hormigones y Morteros (LE 446) Elementos y Componentes (LE 788)
		</br></br>

		Cabe hacer presente que el Ministerio de Vivienda y Urbanismo (MINVU) ha informado a través del documento ORD Nº1089 (21.07.09) y confirmado con ORD Nº1473 (01.09.09), que en proyectos y obras MINVU/SERVIU que están bajo su responsabilidad y/o administración, aceptarán solamente Certificados de Ensayo efectuados a partir de muestreos realizados por la institución Oficial de Control Técnico Acreditada, tanto en la toma de muestras como en la elaboración de los ensayos correspondientes, a contar del 01.10.09.
		</br></br>

		<strong>
			A continuación, se presentan valores correspondientes a los servicios de laboratorio para Obras Civiles, 	presentación de cotización en modalidad de Precio Unitario.
		</strong>
		</br>
		<div id="servicios">
				<table>
				<tr>
					<td>ID</td>
					<td>Ensayo</td>
					<td>Precio</td>
				</tr>

			<?php
			foreach ($ensayos as $id_ensayo){

				$sql = mysql_query("
				SELECT 
					e.id_ensayo as ID, e.nombre_ensayo as NOMBRE_ENSAYO, e.precio as PRECIO 
				FROM 
					tbl_ensayo e
				WHERE 
					e.id_ensayo = '".$id_ensayo."'
				")or die('Consulta fallida: '.mysql_error());;
				while($row = mysql_fetch_assoc($sql)){
					$ensayo_id = $row['ID'];
					$ensayo_nombre = $row['NOMBRE_ENSAYO'];
					$ensayo_precio = $row['PRECIO'];
					
					?>
				<tr>
					<td><?php echo $ensayo_id;?></td>
					<td><?php echo $ensayo_nombre;?></td>
					<td style="width: 60px;">UF <?php echo $ensayo_precio;?></td>
				</tr>

				<?php
													  
					$insert_detalle_ensayos_cotizacion = mysql_query("
						INSERT INTO tbl_detalle_ensayos_cotizacion
						(numero_cotizacion, version_cotizacion, id_ensayo, valor_ensayo)
						VALUES
						('".$n_cotizacion."', '1', '".$ensayo_id."', '".$ensayo_precio."')
					")or die('Consulta fallida: '.mysql_error());;
				}
			}
			?>
				</table>
			</div>
		</br></br>

		<strong><u>NOTA:</u></strong> el valor es por cada probeta
		</br><br>
		<div align="center">
			<table>
				<?php
				foreach ($destinos as $id_destino){

					$sql2 = mysql_query("
					SELECT 
						id_destino as ID, nombre_destino as NOMBRE, precio as PRECIO 
					FROM 
						tbl_destino
					WHERE 
						id_destino = '".$id_destino."'
					")or die('Consulta fallida: '.mysql_error());;
					while($row2 = mysql_fetch_assoc($sql2)){
						$destino_nombre = $row2['NOMBRE'];
						$destino_id = $row2['ID'];
						$destino_precio = $row2['PRECIO'];
						?>
					<tr>
						<td>Valor de visita de laboratorio a:</td>
						<td><?php echo $destino_nombre; ?></td>
						<td style="width: 60px;">UF <?php echo $destino_precio;?></td>
					</tr>

					<?php	
						$insert_detalle_destino_cotizacion = mysql_query("
						INSERT INTO tbl_detalle_destino_cotizacion
						(numero_cotizacion, version_cotizacion, id_destino, precio_destino)
						VALUES
						('".$n_cotizacion."', '1', '".$destino_id."', '".$destino_precio."')
						")or die('Consulta fallida: '.mysql_error());;
					}
				}
				?>
			</table><br>
		</div>
		<strong><u>Esta contempla lo siguiente:</u></strong><br>
		<ol>
			<li value="1">Personal de Laboratorio calificado.</li>
			<li>Disponibilidad 100% en faena, de acuerdo a la ley laboral vigente.</li>
			<li>Horario de Trabajo en jornada diurna (a acordar con mandante),<strong> válido de Lunes a Viernes horario diurno</strong>, si los trabajos a realizar corresponden a día <strong>Sábado</strong> tendrá un recargo del 50% en valor cotizado, para los días <strong>Domingos y/o Feriados</strong> se hará un recargo del 100% al valor cotizado.</li>
			<li>Las horas trabajadas corresponden de 9:00 horas a 17:00 horas con una hora de colación, fuera de este horario corresponderá a sobretiempo cuyo valor será de 1,0 UF por cada hora que el personal de Laboratorio permanezca en Obra.</li>
			<li>Asesoría Técnica de parte del Laboratorio a través de profesionales competentes en las distintas áreas acreditadas.</li>
			<li>El Laboratorio hará entrega de Ropa y equipamiento de seguridad ad hoc para la realización óptima de los trabajos solicitados.</li>
		</ol>
		<strong><u>El valor cotizado incluye:</u></strong><br>
		<ol>
			<li value="1">Toma de muestra de suelos según MN Vol. 8102.1 (2013)</li>
			<li>Toma de muestra de áridos, según NCh 164 Of.76</li>
			<li><strong>Densidades en Terreno LIBRES</strong> (Densímetro Nuclear) NCh 1516. Of1979 o MC Vol. 8.8.502.1 (2013)</li>
			<li>Toma de muestra de Hormigón fresco en obra y docilidad, según NCh1019. Of2009 y NCh171.EOf1975</li>
			<li>Extracción de testigos de pavimento de hormigón, hasta un espesor no mayor a 20 cm (Broca de 4”) según NCh 1171/1 Of2001</li>
			<li>Muestreo de mezclas bituminosas, según MC Vol.8.8.302.27 (2013)</li>
			<li>Densidad en terreno de capas asfálticas (método nuclear) MC Vol.8.8.502.9 (2013)</li>
			<li>Vehículo equipado para faena, traslado de personal, traslado de personal y equipos de laboratorio</li>
			<li>Emisión de informes oficiales en formato digital con firma digital avanzada, según ley 19.799 y resolución MINVU</li>
		</ol>
		<strong><u>Aportes Técnicos Para su comodidad</u>
		Los plazos de entrega de los informes son los siguientes:	
		</strong><br>
		<ul>
			<li>a. 18 días de corrido para ensayos de Mecánica de suelos, desde que el laboratorista realiza el muestreo, además tener en consideración que se pueden solicitar informes preliminares.</li>
			<li>b. días hábiles posterior a rupturas de hormigón se puede efectuar la entrega de informe.</li>
		</ul>
		
		<div id="footer_borde"></div>
		<div id="footer">
			Décima Nº 494, Placilla Valparaíso (32) 2138800 – (56-9) 92231503 - comercial@marsslab.cl - consultoría@marsslab.cl
		</div>
		<div id="footer_borde"></div>
		<br>
		<strong><u>Las políticas de Marss Laboratorios, considera que dichos plazos de entrega de sus informes, quedan condicionados al pago de la factura.</u><br>
		Aportes de Mandante	
		</strong><br>
		<ul>
			<li>Asegurar las condiciones óptimas de operatividad y seguridad para el trabajo del laboratorista en faena</li>
			<li>Facilitar al laboratorio las medidas de seguridad necesarias para la ejecución de los trabajos.</li>
			<li>Facilitar acceso a los recintos, procurando el buen estado de los caminos.</li>
			<li>Entregar planos de ubicación o croquis para la identificación de las calicatas.</li>
			<li>Acceso a toma de agua para un correcto funcionamiento de los equipos.</li>
		</ul>

		<strong><u>1. Emisión y Envío de Informes Oficiales</u></strong><br><br>

		Este valor incluye la emisión de informes oficiales en formato digital con firma avanzada, según ley 19.799 y resolución MINVU. Los cuáles serán enviados vía correo electrónico a la cuenta de mail indicada en el <strong>"Formulario de Aceptación de la Oferta".</strong>
		<br>
		En caso de solicitar Re-Envío de certificación, pasado seis meses, se considerará un valor adicional de <strong>0,1 UF por informe.</strong>
		<br>
		En caso de solicitar Re- Emisión, por modificación de certificación, se considerará un valor de <strong>0,50 UF por informe.</strong>
		<br><br>

		<strong><u>2. Antecedentes Generales</u></strong><br><br>

		El resguardo de las probetas durante el curado inicial será responsabilidad del cliente. En caso de extravío de probetas durante este período, se cobrarán los siguientes valores (valor por molde):
		<br><br>
		<div align="center">
			<table>
				<tr>
					<td>Moldes Muestras Cilíndricas Extraviadas en Obra.</td>
					<td><strong>4,0 UF</strong></td>
				</tr>
				<tr>
					<td>Moldes Muestras Cubicas Extraviadas en Obra.</td>
					<td><strong>3,5 UF</strong></td>
				</tr>
				<tr>
					<td>Moldes Muestras Prismáticas Extraviadas en Obra.</td>
					<td><Strong>4,5 UF</strong></td>
				</tr>
			</table>
		</div>
		<br>
		
		<strong><u>3. Aceptacion de la cotizacion</u></strong><br><br>

		De ser aceptada esta cotización deberá enviar <strong>"Formulario de Aceptación de la Oferta"</strong> con los antecedentes allí solicitados, además de emitir orden de compra <strong>(abierta y valores en UF)</strong> correspondiente para dar el inicio a los servicios de laboratorios.
		<br><br>

		En lo que respecta a programación de servicios, estos deben ser realizadas con 24 horas de anticipación, hasta las 17:00 horas, quedando sujeta a disponibilidad. Esta coordinación debe ser realizada vía mail al correo <strong>programacion@marsslab.cl</strong> o a los fonos <strong>032-2138800/+56 9 94498437</strong>.
		<br><br>

		El pago de los servicios se debe realizar vía depósito o transferencia bancaria. Los datos del Laboratorio son: Razón Social: Soc. Marss Laboratorios y Cía. Ltda., Rut: 76.082.270-1, Giro: Laboratorio de control de calidad, Cuenta Corriente Banco de Chile: 10105073-09, Dirección: Calle Décima N° 494 esquina Segunda Norte Placilla – Valparaíso.
		<br><br>

		Se considera como valor de la UF el correspondiente al día de emisión del estado de pago cabe destacar que los valores por ensayes antes indicados están en UF y son netos, se debe incluir I.V.A.
		<br><br>

		Lo mantendremos informado de cualquier novedad que se produzca durante el proceso, esperando una buena acogida.
	</p>
	<div align="center" style="margin-top: 100px;">
		<table>
			<td style="width: 300px; text-align: center">
				<strong>Claudio González Pajarito</strong><br>
				Jefe Comercial
			</td>
			<td style="width: 200px;"></td>
			<td style="width: 300px; text-align: center">
				<strong>Alejandro Vargas Carrasco</strong><br>
				Jefe Laboratorio
			</td>
		</table>
	</div>
	
		<div id="footer_borde"></div>
		<div id="footer">
			Décima Nº 494, Placilla Valparaíso (32) 2138800 – (56-9) 92231503 - comercial@marsslab.cl - consultoría@marsslab.cl
		</div>
		<div id="footer_borde"></div>
		<br>

</div>		
</div>		
</body>
</html>
