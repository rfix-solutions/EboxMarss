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

include 'crearPDF.php';
$pdf->Output('F','cotizaciones/'.$cot_numero.'.pdf',true);

$query = mysqli_query($link, "
SELECT
	c.id_cotizacion AS ID,
	c.fecha_creacion as FECHA,
	c.numero_cotizacion as COTIZACION,
	c.nombre_proyecto as PROYECTO,
	u.sigla_usuario as RESPONSABLE,
	s.codigo_sucursal as SUCURSAL,
	cl.razon_social as CLIENTE,
	e.nombre_estado_cotizacion as ESTADO,
	c.nombre_contacto as CONTACTO,
	c.email_contacto as EMAIL,
	cl.telefono_cliente as TELEFONO,
	cl.direccion_cliente as LOCALIDAD

FROM
	TBL_Cotizacion c, TBL_Usuario u, TBL_Cliente cl, TBL_Sucursal s, TBL_CotizacionEstado e
WHERE
	c.id_cliente = cl.id_cliente AND
	c.id_usuario = u.id_usuario AND
	c.id_estado_cotizacion = e.id_estado_cotizacion AND
	u.id_sucursal = s.id_sucursal AND
	c.id_cotizacion = '".$_GET['id']."'
	");

while($result = mysqli_fetch_assoc($query)){
	$cotizacion_id = $result['ID'];
	$cotizacion_fecha = $result['FECHA'];
	$cotizacion_numero = $result['COTIZACION'];
	$cotizacion_proyecto = $result['PROYECTO'];
	$cotizacion_responsable = $result['RESPONSABLE'];
	$cotizacion_sucursal = $result['SUCURSAL'];
	$cotizacion_cliente = $result['CLIENTE'];
	$cotizacion_estado = $result['ESTADO'];
	$cotizacion_contacto = $result['CONTACTO'];
	$cotizacion_email = $result['EMAIL'];
	$cotizacion_telefono = $result['TELEFONO'];

	$cotizacion_localidad = $result['LOCALIDAD'];

}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- PNotify -->
	<link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

	<title>EBOX - COTIZACION: <?php echo $cotizacion_numero; ?></title>
	<style>
		html,body{
			height:297mm;
			/*width:210mm;*/
			text-align: center;
			background-color: #9b9b9b;
			font-family: arial;
			font-size: 12px;
			/*
			padding-left: 20px; padding-right: 20px;
			margin-left: 12%;
			*/
		}
			#item-checkbox{
				font-size: 9px;
				text-align: left;
			}
			#formato_pag{
				display: flex; justify-content: center; align-items: center;
			}
			#ancho_pag{
				width:65%;
			}
			#encabezado_azul{
				width: 100%; height:45px; background-color: blue;
				font-size: 16px; color: white; text-align: center; padding-top:10px; padding-button:10px;
			}
			#encabezado_verde{
				width: 100%; height:10px; background-color: green;
				font-size: 16px; color: white; text-align: center; padding-top:10px; padding-button:10px;
			}
			#header{
				font-size: 18px;
				font-family: sans-serif;
				font-weight: bold;
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
			width:50%;
			margin-left:25%;
		}
		#empresa{
			align-content: center;
			font-size: 12px;
			width:70%;
			margin-left:25%;
		}
		table thead {
		  font-weight: bold;
		}
		table th {
		  font-weight: bold;
		}
		#editar{
			position:fixed;
			bottom:40px;
			right:40px;
			background-color:#F4F4F4;
			color:#7B8484;
			border-radius:50px;
			text-align:center;
			box-shadow: 2px 2px 3px #999999;
			position:fixed;
			width:50px;
			height:50px;
			font-size: 20px;
		}
		#aceptar{
			position:fixed;
			bottom:110px;
			right:40px;
			background-color:#F4F4F4;
			color:#7B8484;
			border-radius:50px;
			text-align:center;
			box-shadow: 2px 2px 3px #999999;
			position:fixed;
			width:50px;
			height:50px;
			font-size: 20px;
		}
		#email{
			position:fixed;
			bottom:180px;
			right:40px;
			background-color:#F4F4F4;
			color:#7B8484;
			border-radius:50px;
			text-align:center;
			box-shadow: 2px 2px 3px #999999;
			position:fixed;
			width:50px;
			height:50px;
			font-size: 20px;

		}
	</style>

</head>

<body  onload="new PNotify({
                                  title: 'Notificación',
                                  text: 'La cotización N°<?php echo $cotizacion_numero?> ha sido creada exitosamente.',
                                  type: 'success',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });">


  <div class="container body" id="formato_pag">
		<div class="main_container" id="ancho_pag">
			<div id="pagina" >
				<img src="images/banner-cotizacion.png" style="width:111.5%; text-align: center; margin: -20px -20px 0px -35px;">

				<button type="button" id="editar"  class="btn btn-primary" onmouseout="this.style.backgroundColor='#F4F4F4'; return true;" onmouseover="this.style.backgroundColor='#DCDCDC'; return true;" onclick="window.location.href='cotizacion_editar.php?id=<?php echo $cotizacion_id;?>'"><i class="fa fa-edit"></i></button>
				<button type="button" id="email"   class="btn btn-primary" onmouseout="this.style.backgroundColor='#F4F4F4'; return true;" onmouseover="this.style.backgroundColor='#DCDCDC'; return true;" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-send-o"></i></button>
				<button type="button" id="aceptar" class="btn btn-primary" onmouseout="this.style.backgroundColor='#F4F4F4'; return true;" onmouseover="this.style.backgroundColor='#DCDCDC'; return true;" onclick="window.location.href='dashboard_comercial.php'"><i class="fa fa-check"></i></button>

				<p style="text-align: justify">
					<table style="width: 100%">
						<tr>
							<td style="text-align: left">
								<strong>
									Valparaíso,
									<?php
									$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
									$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
									echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
									?>
								</strong>
							</td>
							<td style="text-align: right; font-size: 16px;"><strong>COTIZACION: <?php echo $cotizacion_numero;?></strong></td>
						</tr>
					</table>
					<br>
					Estimado
					<strong><?php echo $cotizacion_contacto;?>, <?php echo $cotizacion_email;?>, <?php echo $cotizacion_telefono; ?></strong></br><br>
					Tenemos el agrado de enviar a usted la cotización correspondiente a los servicios de Laboratorio para el proyecto <strong>“<?php echo $cotizacion_proyecto;?>”</strong>, de la empresa <strong>“<?php echo $cotizacion_cliente;?>”</strong>, ubicada en la localidad de <strong><?php echo $cotizacion_localidad;?></strong>.
					</br></br>
					<strong>MARSS LABORATORIOS</strong> es una empresa especializada en inspecciones y ensayos de materiales, que cuenta con equipos de última generación y personal altamente calificado para ejecutar distintos análisis y ensayes en el área construcción y minería, además se encuentra acreditado bajo la Norma Nch – ISO 17025 Of 2005 en las áreas que se 	describen a continuación:
					</br></br>
					<table align="center" style="width:100%; margin-left:30px;" >
						<tr>
							<td>Asfalto (LE 447)</td>
							<td>Áridos (LE 448)</td>
							<td>Ensayo Físico - Químicos (LE 449)</td>
						</tr>
						<tr>
							<td>Mecánica de suelos (LE 445)</td>
							<td>Hormigones y Morteros (LE 446)</td>
							<td>Elementos y Componentes (LE 788)</td>
						</tr>
					</table>
					</br></br>

					Cabe hacer presente que el Ministerio de Vivienda y Urbanismo (MINVU) ha informado a través del documento ORD Nº1089 (21.07.09) y confirmado con ORD Nº1473 (01.09.09), que en proyectos y obras MINVU/SERVIU que están bajo su responsabilidad y/o administración, aceptarán solamente Certificados de Ensayo efectuados a partir de muestreos realizados por la institución Oficial de Control Técnico Acreditada, tanto en la toma de muestras como en la elaboración de los ensayos correspondientes, a contar del 01.10.09.
					</br></br>

					<strong>
						A continuación, se presentan valores correspondientes a los servicios de laboratorio para Obras Civiles, 	presentación de cotización en modalidad de Precio Unitario.
					</strong>
					</br>
					<table id="servicios">
						<thead>
							<tr>
								<td>ID</td>
								<td>Ensayo</td>
								<td>Precio</td>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = mysqli_query($link, "
								SELECT
									e.id_ensayo as ID, e.nombre_ensayo as NOMBRE, d.valor_ensayo as PRECIO
								FROM
									TBL_CotizacionDetalleEnsayos d, TBL_Ensayo e
								WHERE
									d.numero_cotizacion = '".$cotizacion_numero."' AND
									d.id_ensayo = e.id_ensayo ORDER BY id_detalle_ensayo_cotizacion
								")or die('Consulta fallida: '.mysql_error());;
								while($row = mysqli_fetch_assoc($sql)){
									$ensayo_id = $row['ID'];
									$ensayo_nombre = $row['NOMBRE'];
									$ensayo_precio = $row['PRECIO'];

									?>
								<tr>
									<td><?php echo $ensayo_id;?></td>
									<td><?php echo $ensayo_nombre;?></td>
									<td style="width: 60px;">UF <?php echo $ensayo_precio;?></td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>

						</br></br>
						<strong><u>NOTA:</u></strong> el valor es por cada probeta
						</br><br>
						<div align="center">
							<table>
								<?php
									$sql2 = mysqli_query($link, "
									SELECT
										det.id_destino as ID, des.nombre_destino as NOMBRE, det.precio_destino as PRECIO
									FROM
										TBL_CotizacionDetalleDestino det, TBL_Destino des
									WHERE
										det.numero_cotizacion = '".$cotizacion_numero."' AND det.id_destino = des.id_destino
									")or die('Consulta fallida: '.mysql_error());;
									while($row2 = mysqli_fetch_assoc($sql2)){
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
								}
								?>
							</table><br>
						</div>
						<strong>La visita a terreno contempla:</strong><br>
						<ol>
							<li type="a">Laboratorista Vial C (con ayudante si la situación lo amerita).</li>
							<li>Toma de muestra de Suelos y/o Hormigón según corresponda.</li>
							<li>En el caso de Hormigones: control de temperatura Hormigón y Ambiente, Control de Cono de Abrams.</li>
							<li>En el caso de Mecánica de suelos: Clasificación USCS / AASHTO</li>
						</ol>


						<strong>Los plazos de entrega de los informes son los siguientes:</strong><br>
						<ol>
							<li value="1">15 días hábiles para ensayos de Mecánica de suelos (se pueden solicitar informes preliminares).</li>
							<li>2 días hábiles posterior a rupturas de hormigón.</li>
							<li>5 días hábiles posterior a la toma de densidad.</li>
						</ol>
						</br>

						<div style="text-align:center;">
							<strong>
								<u>
									Las políticas de Marss Laboratorios, considera que dichos plazos de entrega de sus informes, quedan condicionados al pago de la factura.
								</u>
							</strong>
						</div>

						</br></br>
						<div id="footer_borde"></div>
						<div id="footer">
							Décima Nº 494, Placilla Valparaíso (32) 2138800 – (56-9) 92231503 - comercial@marsslab.cl - consultoría@marsslab.cl
						</div>
						<div id="footer_borde"></div>
						<br><br>


						<strong>Aportes de Mandante</strong><br>
						<ul>
							<li>Asegurar las condiciones óptimas de operatividad y seguridad para el trabajo del laboratorista en faena</li>
							<li>Facilitar al laboratorio las medidas de seguridad necesarias para la ejecución de los trabajos.</li>
							<li>Facilitar acceso a los recintos, procurando el buen estado de los caminos.</li>
							<li>Entregar planos de ubicación o croquis para la identificación de las calicatas.</li>
							<li>Acceso a toma de agua para un correcto funcionamiento de los equipos.</li>
						</ul>


						<strong>1. Recargos de Servicios</strong>
						<p style="text-align:justify;">
							Los valores anteriormente cotizados para el control de ensayos en terreno, corresponden a servicios prestados en días hábiles de lunes a viernes, entre las 08:30 y 17:00 horas, y contemplan un máximo de 80 minutos del Laboratorista en obra. Si por solicitud del cliente, o por la magnitud de las labores solicitadas a ejecutar en terreno, se trabaja fuera de este horario, se aplican
				los siguientes recargos:</br>
				<ul>
					<li>Si se sobrepasan los 80 minutos cotizados, dentro del horario mencionado, se aplicará un recargo de 1,0 UF por cada hora que
					el laboratorista permanezca en faena y/o su proporción en minutos.</li>
					<li>Días hábiles de lunes a viernes, entre las 17:00 y 21:00 horas, se aplicará un recargo de 1,5 UF por cada hora, o proporción de
					ella, que el Laboratorista permanezca en terreno. Fuera de este horario, se considerará valor de día "Domingo y festivos".</li>
					<li>Día sábado, entre las 08:30 y 21:00 horas, se cobrará un adicional de 1,5 UF por cada hora (con un mínimo de dos horas), o
					proporción de ella, que el Laboratorista permanezca en terreno. Fuera de este horario, se considerará valor de día "Domingo y
					festivos".</li>
					<li>En caso de Domingos y Festivos se cobrará un adicional de 2,0 UF por hora o proporción de ella (con un mínimo de dos horas)
					que el laboratorista este en faena.</li>
					<li>En caso que el Laboratorista visite la Obra o Planta y no realice los controles solicitados por razones ajenas al laboratorio, este
					viaje será cobrado como viaje perdido (ítem valor viaje a obra).</li>
				</ul>
				<p style="text-align:justify">
					El resguardo de las probetas durante el curado inicial será responsabilidad del cliente. En caso de extravío de probetas durante este período, se cobrarán los siguientes valores (valor por molde):
					</br></br>
					*Moldes Muestras Extraviadas en Obra (cilíndricas, cúbicas, prismáticas). 		4,0 UF
				</p>

						</p>

						<strong>2. Emisión y Envío de Informes Oficiales</strong><br><br>

						Este valor incluye la emisión de informes oficiales en formato digital con firma avanzada, según ley 19.799 y resolución MINVU. Los cuáles serán enviados vía correo electrónico a la cuenta de mail indicada en el <strong>"Formulario de Aceptación de la Oferta".</strong>
						<br>
						En caso de solicitar Re-Envío de certificación, pasado seis meses, se considerará un valor adicional de <strong>0,1 UF por informe.</strong>
						<br>
						En caso de solicitar Re- Emisión, por modificación de certificación, se considerará un valor de <strong>0,50 UF por informe.</strong>
						<br><br>



						<strong><u>3. Aceptacion de la cotizacion</u></strong><br><br>
						<p style="text-align: justify">
						De ser aceptada esta cotización deberá enviar <strong>"Formulario de Aceptación de la Oferta"</strong> con los antecedentes allí solicitados, además de emitir orden de compra <strong>(abierta y valores en UF)</strong> correspondiente para dar el inicio a los servicios de laboratorios.
						<br>
						En lo que respecta a programación de servicios, estos deben ser realizadas con 24 horas de anticipación, hasta las 17:00 horas, quedando sujeta a disponibilidad. Esta coordinación debe ser realizada vía mail al correo <strong>programacion@marsslab.cl</strong> o a los fonos <strong>032-2138800/+56 9 94498437</strong>.
						<br>

						El pago de los servicios se debe realizar vía depósito o transferencia bancaria. Los datos del Laboratorio son:
						</p>
						<table id="empresa">
							<tr>
								<th>Razón Social:</th><td>Soc. Marss Laboratorios y Cía. Ltda.</td>
							</tr>
							<tr>
								<th>Rut:</th><td>76.082.270-1</td>
							</tr>
							<tr>
								<th>Giro:</th><td>Laboratorio de control de calidad</td>
							</tr>
							<tr>
								<th>Cuenta Corriente:</th><td> Banco de Chile N° 10105073-09</td>
							</tr>
							<tr>
								<th>Dirección:</th><td>Calle Décima N° 494 esquina Segunda Norte Placilla – Valparaíso.</td>
							</tr>
						</table>
						<br>
						Se considera como valor de la UF el correspondiente al día de emisión del estado de pago. Cabe destacar que los valores por ensayes antes indicados están en UF y son netos, se debe incluir I.V.A.
						<br>

						Saluda atentamente,
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

		  <br>

			</div>
		</div>

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
-->
                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n</h4>
                        </div>
                        <div class="modal-body">
                          <h4>Env&iacute;o de cotizaci&oacute;n <br><?php echo $cotizacion_numero;?></h4>
                          <p>La cotizacion será enviada al siguiente email:</p>
                          <p style="font-weight: bold;"><?php echo $cotizacion_email;?></p>
													<p>¿Desea Continuar?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          <button type="button" onclick="window.location.href='cotizacion_enviar.php?id=<?php echo $cotizacion_id;?>'" class="btn btn-success">Aceptar</button>
                        </div>

                      </div>
                    </div>
                  </div>


	</div>

<!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
	<script src="../vendors/moment/min/moment.min.js"></script>
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
</body>
</html>
