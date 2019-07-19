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


////////////////////////////////////////////////
$cotizacion_id = $_GET['id'];
$hoy= date("d-m-Y");

$query = mysqli_query($link, "
SELECT
	c.id_cotizacion AS ID,
	c.fecha_creacion as FECHA,
	c.numero_cotizacion as COTIZACION,
	c.nombre_proyecto as PROYECTO,
	u.sigla_usuario as RESPONSABLE,
	s.codigo_sucursal as SUCURSAL,
	cl.razon_social as CLIENTE,
	cl.rut_cliente AS RUT,
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
	c.id_cotizacion = '".$cotizacion_id."'
	");

while($result = mysqli_fetch_assoc($query)){
	$cotizacion_id = $result['ID'];
	$cotizacion_rut = $result['RUT'];
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

$update = mysqli_query($link, "UPDATE TBL_Cotizacion SET id_estado_cotizacion = '2' WHERE id_cotizacion = '".$_GET['id']."'");
$QRY_ClientUser = "
	INSERT INTO TBL_ClienteUsuarios
		(
		ClienteUsuarios_Nombre,
		ClienteUsuarios_Email,
		ClienteUsuarios_IdCliente
		)
	VALUES
		(
		'".$cotizacion_contacto."',
		'".$cotizacion_email."',
		'".$cotizacion_id."'
		)
";
$SQL_ClientUser = mysqli_query($link, $QRY_ClientUser) or die("Error en USER CLIENT".mysqli_error($link));;




//////////////////////////////////////////// EMAIL ////////////////////////////////////////////
// Varios destinatarios
$para  = ''.$cotizacion_email.'' . ', '; // atención a la coma
//$para .= 'edmundosarriainzulza@gmail.com';

// título
$titulo = 'Envío de Cotización N° '.$cotizacion_numero.'';

// mensaje
$mensaje = '
<!DOCTYPE html>
<html>
<head>
<title>'.$titulo.'</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="EBOX" />

	<style type="text/css">

	    body{
            width: 100%;
            background-color: #9f9fa3;
            margin:0;
            padding:0;
            -webkit-font-smoothing: antialiased;
        }

        html{
            width: 100%;
        }

        table{
            font-size: 14px;
            border: 0;
        }
		 @media only screen and (max-width: 768px){
			.container {
				width: 700px !important;
			}
		}
        @media only screen and (max-width: 640px){

            .header-bg{width: 440px !important; height: 10px !important;}
            .main-header{line-height: 28px !important;}
            .main-subheader{line-height: 28px !important;}

            .feature{width: 420px !important;}
            .feature-middle{width: 400px !important; text-align: center !important;}
            .feature-img{width: 440px !important; height: auto !important;}

            .container{width: 440px !important;}
            .container-middle{width: 420px !important;}
            .mainContent{width: 400px !important;}

            .main-image{width: 400px !important; height: auto !important;}
            .banner{width: 400px !important; height: auto !important;}

			.section-item{width: 400px !important;}
            .section-img{width: 400px !important; height: auto !important;}

			.prefooter-header{padding: 0 10px !important; line-height: 24px !important;}
            .prefooter-subheader{padding: 0 10px !important; line-height: 24px !important;}

			.top-bottom-bg{width: 420px !important; height: auto !important;}
            table {
				width: 100% !important;
				text-align:center;
			}
        }

        @media only screen and (max-width: 479px){

        	/*------ top header ------ */
            .header-bg{width: 280px !important; height: 10px !important;}
            .top-header-left{width: 260px !important; text-align: center !important;}
            .top-header-right{width: 260px !important;}
            .main-header{line-height: 28px !important; text-align: center !important;}
            .main-subheader{line-height: 28px !important; text-align: center !important;}

            /*------- header ----------*/
            .logo{width: 260px !important;}
            .nav{width: 260px !important;}

            /*----- --features ---------*/
            .feature{width: 260px !important;}
            .feature-middle{width: 240px !important; text-align: center !important;}
            .feature-img{width: 260px !important; height: auto !important;}


            .container{width: 290px !important;}
            .container-middle{width: 260px !important;}
            .mainContent{width: 240px !important;}

            .main-image{width: 240px !important; height: auto !important;}
            .banner{width: 240px !important; height: auto !important;}
            /*------ sections ---------*/
            .section-item{width: 240px !important;}
            .section-img{width: 240px !important; height: auto !important;}
            /*------- prefooter ------*/
            .prefooter-header{padding: 0 10px !important;line-height: 28px !important;}
            .prefooter-subheader{padding: 0 10px !important; line-height: 28px !important;}
            /*------- footer ------*/
            .top-bottom-bg{width: 260px !important; height: auto !important;}
			table {
				  width: 100% !important;
			}
            .gallery-img a img {
				height: 134px !important;
			}
			.gallery-img1 a img {
				height: 60px !important;
			}
			.gallery-img2 a img {
				height: 60px !important;
			}
	    }
    </style>

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tbody><tr><td height="30"></td></tr>
        <tr bgcolor="#9f9fa3">
            <td width="100%" align="center" valign="top" bgcolor="#9f9fa3">
                <!-- main content -->
                <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="container top-header-left" bgcolor="e5eaf7">
				<!-- Header -->
                	<tbody><tr bgcolor="FFFFFF"><td height="40"></td></tr>
                	<tr class="header-bg" bgcolor="FFFFFF">
	                	<td>
	                		<table border="0" width="560" align="center" cellpadding="0" cellspacing="0" class="container-middle" bgcolor="FFFFFF">
								<tbody><tr class="top-header-left">
									<td style="color: #777; font-size: 1em;font-family: Candara; font-weight: normal; line-height: 2em;">
										<table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="logo">
				                			<tbody><tr>
				                				<td align="center">
													'.$hoy.'
												</td>
											</tr>
										</tbody></table>
									</td>
								</tr>
	                			<tr>
	                				<td>
	                					<table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="logo">
				                			<tbody><tr>
				                				<td align="center">
													<a href="#" style="text-decoration:none"><img src="https://platform.ebox.cl/production/images/logo_marss_400.png" alt=" " width="241" height="80" border="0"></a>
												</td>
				                			</tr>
				                		</tbody></table>
				                		<table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; " class="nav">
				                			<tbody><tr><td height="30"></td></tr>
				                			<tr>
												<td style="font-size:15px; color:#a7a7a7; font-family:Candara, Helvetica, sans-serif;">
													<a href="mailto:laboratorio@marsslab.cl" style="color:#a7a7a7; font-family:Candara, Helvetica, sans-serif;text-decoration:none;">
														laboratorio@marsslab.cl
													</a>
												</td>
											</tr>
				                		</tbody></table>
	                				</td>
	                			</tr>
	                		</tbody></table>
	                	</td>
                	</tr>


                	<!-- end header -->
					<!-- main section -->
						<!-- dummy-text -->
						<tr bgcolor="f5f5f5"><td height="40"></td></tr>
						<tr bgcolor="f5f5f5">
							<td bgcolor="f5f5f5">
								<table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="mainContent" bgcolor="f5f5f5">
									<tbody>
									<tr>
										<td style="font-size:14px; color:#0000FF; font-family:Gill Sans MT, Arial, sans-serif; padding-left: 70px; padding-right: 70px; font-style=italic;" align="center">Estimado '.$cotizacion_contacto.', hemos enviado la siguiente cotizaci&oacute;n:</td>
									</tr>
									<tr>
										<td style="font-size:25px; color:#0000FF; font-family:Gill Sans MT, Arial, sans-serif; padding-left: 70px; padding-right: 70px; font-style=italic;" align="center">Cotizaci&oacute;n Nro: '.$cotizacion_numero.'</td>
									</tr>
									<tr>
										<td style="font-size:25px; color:#0000FF; font-family:Gill Sans MT, Arial, sans-serif; padding-left: 70px; padding-right: 70px; font-style=italic;" align="center">
											<br>
											<a href="https://platform.ebox.cl/login/index.php?C='.$cotizacion_id.'&U='.$cotizacion_rut.'&P='.$cotizacion_email.'">Ver formulario de aceptaci&oacute;n</a>
										</td>
									</tr>
									<tr>
										<td style="font-size:25px; color:#0000FF; font-family:Gill Sans MT, Arial, sans-serif; padding-left: 70px; padding-right: 70px; font-style=italic;" align="center">
											<br>
											<a href="https://platform.ebox.cl/production/cotizaciones/'.$cotizacion_numero.'.pdf">Ver Cotizaci&oacute;n</a>
										</td>
									</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr bgcolor="f5f5f5"><td height="40"></td></tr>
						<!-- //dummy-text -->
						<!-- service -->
						<tr><td bgcolor="#FFF" height="40"></td></tr>


						<!-- service -->
						<!-- 3-grids-images -->



						<!-- //3-grids-images -->
						<!-- news -->



						<!-- news -->

						<!-- footer -->
						<tr>
							<td bgcolor="008000" style="height:10px;">
							</td>
						</tr>
						<tr>
							<td bgcolor="0000FF">
								<table border="0" align="center" cellpadding="0" cellspacing="0" class="mainContent">
									<tbody>
										<tr>
											<td height="20"></td>
										</tr>
										<tr>
											<td style="vertical-align:top;">
												<table>
													<tbody>
														<tr><td>
															<table border="0">
																<tbody>
																	<tr>
																		<td style="color: #fff; font-size: 1em;font-family: Candara; text-align:center; font-weight: normal; line-height: 1.5em;">
																			Calle Decima 494 Placilla Valpara&iacute;so - (32) 2138800 -  marsslaboratorios.cl
																			<br>
																			<br>
																			Copyright 2018 <a href="https://www.ebox.cl" style="color: #fff; font-size: 1em;text-decoration:none;">Ebox Platform by Tecnotrack</a>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr></tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td height="10"></td>
										</tr>

										<tr>
											<td height="20"></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<!-- footer -->
				</tbody></table>
                </td></tr><tr><td height="35"></td></tr>

	</tbody></table>

</body>
</html>
';



// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: '.$cotizacion_contacto.' <'.$cotizacion_email.'>' . "\r\n";
$cabeceras .= 'From: MarssLab <contacto@ebox.cl>' . "\r\n";



$cabeceras .= 'Cc: ';
$QRY_EmailCC = "
SELECT
	Notificaciones_Email, Notificaciones_Nombre
FROM
	TBL_Notificaciones
WHERE
	Notificaciones_Tipo = '1'
";
$SQL_EmailCC = mysqli_query($link, $QRY_EmailCC) or die ("Error en QRY EMAIL CC: " . mysqli_error());;
while ($EmailCC = mysqli_fetch_assoc($SQL_EmailCC)) {
		$cabeceras .= ''.$EmailCC['Notificaciones_Nombre'].' <'.$Notificaciones_Email.'>; ';
}

$EboxContacto = "Contacto Ebox";
$EboxEmail	= "contacto@ebox.cl";
$cabeceras .= ''.$EboxContacto.' <'.$EboxEmail.'>; ';
$cabeceras .= "\r\n";




$cabeceras .= 'Bcc: ';
$QRY_EmailBCC = "
SELECT
	Notificaciones_Email, Notificaciones_Nombre
FROM
	TBL_Notificaciones
WHERE
	Notificaciones_Tipo = '2'
";
$SQL_EmailBCC = mysqli_query($link, $QRY_EmailBCC) or die ("Error en QRY EMAIL BCC: " . mysqli_error());;
while ($EmailBCC = mysqli_fetch_assoc($SQL_EmailBCC)) {
		$cabeceras .= ''.$EmailBCC['Notificaciones_Nombre'].' <'.$Notificaciones_Email.'>; ';
}


$cabeceras .= "\r\n";





// Enviarlo
$enviado = mail($para, $titulo, $mensaje, $cabeceras);


if($enviado){
	$QRY_Insert = "
		INSERT INTO TBL_CotizacionGestion
		(id_cotizacion, detalle_historial_cotizacion, fecha_historial_cotizacion, id_usuario)
		VALUES
		('".$cotizacion_id."', 'Cotizacion enviada a cliente', '".date("Y-m-d H:i:s")."', '".$_SESSION['id_user']."')
	";

	$SQL_Insert = mysqli_query($link, $QRY_Insert);

	?>
	<script>
		alert("Envío realizado con éxito al siguiente destinatario:\n\nNombre: <?php echo $cotizacion_contacto;?>\nEmail: <?php echo $cotizacion_email;?>\nCliente: <?php echo $cotizacion_cliente?>");
		location.href="dashboard_comercial.php";
	</script>
	<?php
}
?>
