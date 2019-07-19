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


/*
if($_GET['id']!=0){
	$sql_0 = mysqli_query($link, "
	SELECT
		c.id_cotizacion AS ID,
		DATE_FORMAT(c.fecha_creacion, '%d/%M/%Y') as FECHA,
		c.numero_cotizacion as COTIZACION,
		c.version_cotizacion as VERSION,
		c.nombre_contacto as CONTACTO,
		c.nombre_proyecto as PROYECTO,
		s.nombre_sucursal as SUCURSAL,
		cl.razon_social as RAZON_CLIENTE,
		cl.rut_cliente as RUT_CLIENTE,
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
	while($fila = mysqli_fetch_assoc($sql_0)){
		$cot_fecha = $fila['FECHA'];
		$cot_numero = $fila['COTIZACION'];
		$cot_proyecto = $fila['PROYECTO'];
		$cot_version = $fila['VERSION'];
		$cot_cliente_razon = $fila['RAZON_CLIENTE'];
		$cot_cliente_rut = $fila['RUT_CLIENTE'];
		$cot_email = $fila['EMAIL'];
		$cot_contacto = $fila['CONTACTO'];
		$cot_direccion = $fila['DIRECCION'];
		$cot_telefono = "N/A";
	}
	$titulo = "COTIZACION: ".$cot_numero."";

}
else{
	$titulo = "AGENDAMIENTO SIN FORMULARIO";
}
*/


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>.: EBOX PLATFORM :. </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	  <style type="text/css">
	  html,body{
			height:297mm;
			width:210mm;
			text-align: center;
			background-color: #F7F7F7;
			font-family: arial;
			font-size: 12px;
		  	padding-left: 20px; padding-right: 20px;
		  	margin-left: 12%;
		}
	  </style>
  </head>

<body class="nav-md" role="main">
  <div class="container body">
    <div class="main_container">
        <div class="clearfix"></div>
			  <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content">



                <table cellspacing=0 border=1>
                					<tr>
                						<td style=min-width:50px>I N F O R M E D E E N S A Y O O F I C I A L</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px> LABORATORIO DE OBRAS CIVILES LH 84579 / 17</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>RESOLUCIÓN MINVU N° 4569 DEL 02/07/2016</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>07-17-18</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>SOLICITANTE</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>MATERIAL</td>
                						<td style=min-width:50px>SE CARGAN AL INGRESAR LA SOLICITUD DE SERVICIO</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>DIRECCIÓN CLIENTE</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>ATENCIÓN SR.</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>PROCEDENCIA</td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>OBRA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>CIUDAD</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>UBICACIÓN</td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>MATERIAL (CLASE DE ARIDO)</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>CORRELATIVO N°</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>PROCEDENCIA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>N° SOLICITUD</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>UBICACIÓN</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA MUESTREO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>ENSAYO REALIZADO EN</td>
                						<td style=min-width:50px>LABORATORIO CENTRAL - PLACILLA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>MUESTRA TOMADA POR</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>RESULTADOS:</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>GRANULOMETRÍA</td>
                						<td style=min-width:50px>MC Vol 8 - 8.202.2</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>DENSIDAD REAL, NETA Y ABSORCIÓN DE AGUA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>MC Vol 8 - 8.102.1</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>TAMIZ</td>
                						<td style=min-width:50px>% ACUMULADO QUE PASA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>DENSIDAD REAL SSS</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>kg/cm3</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>SOBRETAMAÑO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>DENSIDAD REAL SECA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>kg/cm3</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>3”</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>DENSIDAD REAL NETA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>kg/cm3</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>2 ½”</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>ABSORCIÓN DE GUA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>%</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>2”</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>09-08-16</td>
                						<td style=min-width:50px>09-13-16</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>1 1/2"</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>1”</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>DETERMINACIÓN DE CARBON Y LIGNITO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>3/4"</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>1/2"</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>MASA DE LA MUESTRA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>gr</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>3/8”</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>TIPO Y GRAVEDAD ESPECIFICA DEL LIQUIDO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>N° 4</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>CARBON Y LIGNITO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>%</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>N° 8</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>09-08-16</td>
                						<td style=min-width:50px>09-13-16</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>Nº 16</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>Nº 30</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>CLORUROS Y SULFATOS</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>N° 50</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>N° 100</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>CONTENIDO DE CLORUROS</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>kg Cl - / kg de arido</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>N° 200</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>CONTENIDO DE SULFATOS</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>kg SO4-2 / kg de arido</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>MODULO DE FINURA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>09-08-16</td>
                						<td style=min-width:50px>09-13-16</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>T.M.A.</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>PORCENTAJE DE HUECOS (%)</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>DESINTEGRACIÓN MEDIANTE SALES DE SULFATO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px> FECHA DE ENSAYO</td>
                						<td style=min-width:50px>11-28-16</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>PERDIDA DE MASA (SODIO)</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>%</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>MATERIAL FINO MENOR A 0,080 mm</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>PERDIDA DE MASA (MAGNESIO)</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>%</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>09-08-16</td>
                						<td style=min-width:50px>09-13-16</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>CONTENIDO DE FINOS</td>
                						<td style=min-width:50px>--</td>
                						<td style=min-width:50px>%</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>11-28-16</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>PARTICULAS DESMENUZABLES</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>HUMEDAD NATURAL</td>
                						<td style=min-width:50px>NCh 1515 Of 79</td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>DETERMINACIÓN DE LAS SALES SOLUBLES TOTALES</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>PERDIDA DE MASA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>%</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>09-08-16</td>
                						<td style=min-width:50px>09-13-16</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>HUMEDAD</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>%</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>SALES SOLUBLES</td>
                						<td style=min-width:50px>--</td>
                						<td style=min-width:50px>%</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>11-28-16</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>CONTENIDO IMPUREZAS ORGÁNICAS</td>
                						<td style=min-width:50px>NCh 166 Of 09</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>DETERMINACIÓN DEL EQUIVALENTE DE ARENA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>NCh 1325 Of 10</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>COLORACIÓN MUESTRA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>09-08-16</td>
                						<td style=min-width:50px>09-13-16</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>ABSORCIÓN DE AGUA EN ARENAS</td>
                						<td style=min-width:50px>NCh 1515 Of 79</td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>AGITACIÓN MECÁNICA</td>
                						<td style=min-width:50px>ASTM D 2419</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>ABSORCIÓN DE AGUA EN GRAVAS</td>
                						<td style=min-width:50px>NCh 1117 Of 10</td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>EQUIVALENTE DE ARENA (E.A.)</td>
                						<td style=min-width:50px>-</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>DENSIDADES APARENTES COMPACTADAS Y SUELTAS</td>
                						<td style=min-width:50px>NCh 1325 Of 10</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>ABS. DE AGUA (ARENAS)</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>%</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>TIEMPO SEDIMENTACIÓN</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>minutos</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>ABS. DE AGUA (GRAVAS)</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>%</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>12-21-16</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>METODO DE ENSAYO (D.A.C.)</td>
                						<td style=min-width:50px>APISONADO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>PROMEDIO DENSIDAD APARENTE COMPACTADA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>Kg/m3</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>DENSIDAD DE PARTÍCULAS SOLIDAS TOTALES</td>
                						<td style=min-width:50px>NCh 1532 Of 80</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>METODO DE ENSAYO (D.A.S.)</td>
                						<td style=min-width:50px>POR SIMPLE VACIADO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>PROMEDIO DENSIDAD APARENTE SUELTA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>Kg/m3</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>CONTENIDO IMPUREZAS ORGÁNICAS</td>
                						<td style=min-width:50px>NCh 166 Of 09</td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>D.P.S. TOTAL </td>
                						<td style=min-width:50px>---</td>
                						<td style=min-width:50px>g/cm3</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>09-08-18</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>---</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>COLORACIÓN MUESTRA</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>FECHA DE ENSAYO</td>
                						<td style=min-width:50px>09-08-16</td>
                						<td style=min-width:50px>09-13-16</td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>OBSERVACIONES:</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>---</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px>DETERMINACIÓN DE LAS SALES SOLUBLES TOTALES</td>
                						<td style=min-width:50px>M.C.Vol 8 - 8.202.14 </td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>ALEJANDRO VARGAS CARRASCO</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>JEFE ÁREA HORMIGÓN</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>EL PRESENTE INFORME DE ENSAYO NO DEBE SER REPRODUCIDO EXCEPTO EN SU TOTALIDAD SIN LA AUTORIZACIÓN DE MARSS LABORATORIOS</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>LOS RESULTADOS PRESENTADOS CORRESPONDEN SOLO A LA MUESTRA ENSAYADA Y NO A UN TOTAL DEL LOTE</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                					<tr>
                						<td style=min-width:50px>Calle Decima 494 Placilla Valparaíso - (32) 2138800 - laboratorio@marsslab.cl - www.marsslaboratorios.cl</td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                						<td style=min-width:50px></td>
                					</tr>
                				</table>




              </div>
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
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
	 <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
</body>
</html>
