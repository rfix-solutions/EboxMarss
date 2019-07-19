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


 /*<!-- /////////////////////////////////////////OBTENER DATOS COTIZACION////////////////////////////////////////////////// -->*/

$CotizacionId = $_GET['id'];
$sql_form_aceptacion = "
SELECT
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
	F.id_cotizacion='".$CotizacionId."' AND
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
if($result_form_aceptacion!=0){?>
	<script>alert("El formulario ya se encuentra aceptado por el cliente");</script>
	<?php
	$readonly = "readonly";
	while($datos_formulario = mysqli_fetch_assoc($query_form_aceptacion)){
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
	c.fecha_creacion as FECHA,
	c.numero_cotizacion as COTIZACION,
	c.nombre_proyecto as PROYECTO,
	u.sigla_usuario as RESPONSABLE,
	s.codigo_sucursal as SUCURSAL,
	cl.razon_social as CLIENTE,
	cl.id_cliente AS IDCLIENTE,
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
	c.id_cotizacion = '".$CotizacionId."'
	")or die('Consulta fallida: '.mysql_error());;

while($result = mysqli_fetch_assoc($query)){
	$cotizacion_id = $result['ID'];
	$cotizacion_idCliente = $result['IDCLIENTE'];
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




/*!-- /////////////////////////////////////////SELECT ENTIDAD FISCAL////////////////////////////////////////////////// -->*/

$query_entidad_fiscalizadora = mysqli_query ($link," SELECT id_entidad_fiscal AS ID, nombre_entidad AS Nombre_Entidad FROM TBL_EntidadFiscal")
				 or die('Consulta fallida: '.mysqli_error());;
				 $i = 1;
				 while ($valores = mysqli_fetch_assoc($query_entidad_fiscalizadora))
                 {
					$dropentidad = $dropentidad."<option value=".$valores['ID'].">".$valores['Nombre_Entidad']."</option>";

					if($i==2)
						break;
					$i++;
                 };


/*!-- /////////////////////////////////////////SELECT REGIONES ////////////////////////////////////////////////// -->*/

$query_regiones = mysqli_query ($link,"SELECT * FROM TBL_Region ORDER BY region_nombre ")
				 or die('Consulta fallida: '.mysql_error());;
				 while ($valores = mysqli_fetch_assoc($query_regiones))
                 {
						$dropregiones = $dropregiones."<option value=".$valores['region_id'].">".$valores['region_nombre']."</option>";

                 };

/*!-- /////////////////////////////////////////SELECT PROVINCIAS //////////////////////////////////////////// -->*/

$query_provincia = mysqli_query ($link,"SELECT * FROM TBL_Provincia ORDER BY provincia_nombre ")
				 or die('Consulta fallida: '.mysql_error());;
				 while ($valores = mysqli_fetch_assoc($query_provincia))
                 {
						$dropprovincias = $dropprovincias."<option value=".$valores['provincia_id'].">".$valores['provincia_nombre']."</option>";
                 };

/*!-- /////////////////////////////////////////SELECT COMUNAS //////////////////////////////////////////// -->*/

$query_comuna = mysqli_query ($link,"
				 SELECT * FROM TBL_Comuna ORDER BY comuna_nombre ")
				 or die('Consulta fallida: '.mysql_error());;
				 while ($valores = mysqli_fetch_assoc($query_comuna))
                 {
						$dropcomunas = $dropcomunas."<option value=".$valores['comuna_id'].">".$valores['comuna_nombre']."</option>";
                 };

/*!-- /////////////////////////////////////////SELECT TIPO PAGO////////////////////////////////////////////////// -->*/

 $query_forma_pago = mysqli_query ($link,"
					 SELECT id_forma_pago AS ID, nombre_forma_pago AS Forma_Pago
					 FROM TBL_FormaPago ")
					 or die('Consulta fallida: '.mysql_error());;
           while ($files = mysqli_fetch_assoc($query_forma_pago))
                {
						 $droppago = $droppago."<option value=".$files['ID'].">".$files['Forma_Pago']."</option>";
  		   	    };

$hoy = date("d-m-Y");
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo $Title.$Company;	?> </title>

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
			/*width:210mm;*/
			text-align: center;
			background-color: #F7F7F7;
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
				width:70%;
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
	  </style>
  	<script type="text/javascript" src="js/valida_form_acep.js"></script>
		<script language="JavaScript">
		function CambiarFormulario(){
			switch(document.forms[0].forma_pago.selectedIndex){
				case 0:
						document.forms[0].otro.value="";
						document.forms[0].otro.disabled=true;
				break;
				case 4:
		      document.forms[0].otro.value="";
					document.forms[0].otro.disabled=false;
					break;
				default:
						document.forms[0].otro.value="";
						document.forms[0].otro.disabled=true;
				break;
			}
		}

		</script>
    </head>

<body class="nav-md" role="main" onLoad="CambiarFormulario();">

	<div class="container body" id="formato_pag">
		<div class="main_container" id="ancho_pag">
			<div class="">
		        <div class="clearfix"></div>
			    <div class="row">
              		<div class="col-md-12 col-sm-12 col-xs-12">
            	    	<div class="x_panel">
                  			<div class="x_content">

								<div class="col-md-6 col-sm-6 col-xs-12">
        							<img src="images/Logo_marss-lab_255x100.jpg">
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<h4 style="text-align: center;">
										Servicios de Laboratorio de Construcción, Ensayos de Materiales, Análisis Químicos y Ensayos No Destructivos.
									</h4>
									<div class="ln_solid"></div>

									<div class="col-md-6 col-sm-6 col-xs-12" style="align-items: center;">
										<h5><strong>N° Cotización:  </strong></h5>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">

										<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ver Cotizaci&oacute;n" aria-describedby="tooltip588119">
											<a href="cotizaciones/<?php echo $cotizacion_numero;?>.pdf" target="_blank">
											<strong> <?php echo $cotizacion_numero;  ?></strong>
											</a>
										</button>
									</div>
								</div>
								</br></br>

								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="ln_solid"></div>
									<h3 style="text-align: center;">ACEPTACIÓN DE COTIZACIÓN Y ANTECEDENTES DE OBRA</h3>
									<p style="text-align: center;">
										Por medio de la presente acepto los términos de la oferta técnico – económica Nº <strong><?php echo $cotizacion_numero; ?></strong> propuesta por <strong>Sociedad Marss Laboratorios y Cía. Ltda.</strong> para proceder con el servicio en ella señalado.
									</p>
								</div>
							</div>



<form class="form-horizontal form-label-left" data-parsley-validate novalidate action="form_aceptacion_res.php" method="get">
<input type="hidden" name="cot_id" value="<?php echo $cotizacion_id;?>" >
<input type="hidden" name="cli_id" value="<?php echo $cotizacion_idCliente;?>" >


	<div class="x_title">

    	<h2 style="padding-top: 30px;">Antecedentes de Aceptaci&oacute;n de Cotizaci&oacute;n</h2>
       	<div class="clearfix"></div>
	</div>

	<div class="form-group">

        <div class="col-md-8 col-sm- col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Empresa que solicita el servicio de laboratorio</label>
        	<input type="text"  id= "empresa_solicitante" name="empresa_solicitante" class="form-control" value ="<?php echo $cotizacion_cliente;?>" title="Solo letras, un minimo de 4 y un maximo de 35 caracteres" required <?php echo $readonly;?>>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-12 xdisplay_inputx form-group has-feedback">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Fecha de aceptaci&oacute;n de cotizaci&oacute;n</label>

			<input type="text" readonly name="fecha_aceptacion" class="form-control has-feedback-left" required value="<?php echo $hoy;?>">
			<!--
<input type="text" class="form-control has-feedback-left" id="single_cal2" aria-describedby="inputSuccess2Status2" required name="fecha_aceptacion">
-->
			<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
			<span id="inputSuccess2Status2" class="sr-only">(success)</span>
		</div>
	</div>
    <div class="form-group">

        <div class="col-md-6 col-sm-6 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">
				Nombre autorizado para solicitar informe
			</label>
        	<input type="text" maxlength="30" class="form-control" id="nombre_solicitante" name="nombre_solicitante" pattern="[A-Za-z ]+" value="<?php echo $cotizacion_contacto?>" required <?php echo $readonly;?>>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">
				Email autorizado para solicitar informe
			</label>
        	<input type="email" maxlength="30" class="form-control" value="<?php echo $cotizacion_email;?>" id= "email_solicitante" name="email_solicitante" required <?php echo $readonly;?>>
		</div>
	</div>


<!-- /////////////////////////// SECCION 2 ///////////////////////////////////////// -->
	<div class="x_title">
    	<p>
			<h2 style="padding-top: 30px;">Antecedentes de Obra <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Los siguientes datos ingresados en esta sección serán parte del informe que se emitirá posteriormente" aria-describedby="tooltip401610"></i></h2>
			</p>
        <div class="clearfix"></div>
	</div>
	<p style="font-weight: bold; background: red; color:white;">Los siguientes datos ingresados en esta sección serán parte del informe que se emitirá posteriormente</p>
	<div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<label style="text-align: left;" class="col-md-12 col-sm-12 col-xs-12">Empresa Constructora</label>
        	<input type="text" maxlength="30" class="form-control" name="empresa_constructora" placeholder="Nombre Empresa Constructora" id="empresa_constructora" required <?php echo $readonly;?> value="<?php echo $form_empresa_constructora;?>">
		</div>
	</div>
    <div class="form-group">
        <div class="col-md-8 col-sm-8 col-xs-12">
			<label style="text-align: left;" class=" col-md-12 col-sm-12 col-xs-12">Nombre de la obra</label>
        	<input type="text" maxlength="75" class="form-control" placeholder="Nombre de la Obra" id="nombre_obra" required name="nombre_obra" <?php echo $readonly;?> value="<?php echo $form_nombre_obra;?>">
		</div>
        <div class="col-md-4 col-sm-4 col-xs-12">
			<label style="text-align: left;" class=" col-md-12 col-sm-12 col-xs-12">Código de la obra (N° de licitación)</label>
        	<input type="text" class="form-control" placeholder="Código de la Obra" id="codigo_obra" name="codigo_obra" <?php echo $readonly;?> value="<?php echo $form_codigo_obra;?>">
		</div>
	</div>
	<div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<label  style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Dirección de obra</label>
        	<input type="text" class="form-control" placeholder="Direccion" id="direccion_obra" required name="direccion_obra" <?php echo $readonly;?> value="<?php echo $form_direccion_obra;?>">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<?php
			if($readonly==""){?>
				<select class="form-control" name="region_obra" required="required" id="regiones"></select>
			<?php
			}else{?>
				<input type="text" class="form-control" placeholder="Direccion" id="regiones" required name="region_obra" <?php echo $readonly;?> value="<?php echo $form_region;?>">
			<?php
			}
			?>
			<br>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">

			<?php
			if($readonly==""){?>
				<select class="form-control" required="required" name="comuna_obra" id="comunas"></select>
				<?php
			}else{?>
				<input type="text" class="form-control" placeholder="Direccion" id="comunas" required name="comuna_obra" <?php echo $readonly;?> value="<?php echo $form_comuna;?>">
			<?php
			}
			?>


			<br>
		</div>

	</div>

	<div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<label style="text-align: left;" class=" col-md-12 col-sm-12 col-xs-12">Encargado de Terreno</label>
        	<input type="text" maxlength="30" class="form-control" placeholder="Nombre Encargado" id="encargado_terreno" pattern="[A-Za-z ]+" required name="encargado_terreno" <?php echo $readonly;?> value="<?php echo $form_encargado_terreno?>">
		</div>
	</div>
	<div class="form-group">

        <div class="col-md-6 col-sm-6 col-xs-12">
			<label style="text-align: left;" class=" col-md-12 col-sm-12 col-xs-12">Email de Profesional</label>
        	<input type="email" maxlength="30" class="form-control" placeholder="Email"  id="email_encargado" required name="email_encargado" <?php echo $readonly;?> value="<?php echo $form_email_encargado?>">
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<label style="text-align: left;" class=" col-md-12 col-sm-12 col-xs-12">Tel&eacute;fono del Profesional</label>
        	<input type="tel" maxlength="15" class="form-control" placeholder="Telefono" id="telefono_encargado"  required name="telefono_encargado" <?php echo $readonly;?> value="<?php echo $form_telefono_encargado;?>" >
		</div>
	</div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Entidad Fiscalizadora</label>




			<?php
			if($readonly==""){?>
				<select class="form-control" id="entidad_fiscal" name="entidad_fiscal" required <?php echo $readonly;?>>
				 	<option value="">Seleccione:</option>
				 	<?php
						/*<!-- //////////////////////SELECT ENTIDAD FISCAL////////////////////////// -->*/
						echo $dropentidad;
				 		?>
			 		</select>
			<?php
			}else{?>
				<input type="text" class="form-control" placeholder="Direccion" id="entidad_fiscal" required name="entidad_fiscal" <?php echo $readonly;?> value="<?php echo $form_entidad_fiscal;?>">
			<?php
			}
			?>

		</div>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Fono de obra</label>
        	<input type="tel" maxlength="15" class="form-control" placeholder="Fono de la obra" id="fono_obra" required name="fono_obra" <?php echo $readonly;?> value="<?php echo $form_fono_obra;?>">
		</div>



	</div>

<!-- /////////////////////////// SECCION 3 ///////////////////////////////////////// -->
	<div class="x_title">
    	<h2 style="padding-top: 30px;">
					Antecedentes para elaboración de informe
					<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Los siguientes datos ingresados en esta sección serán parte del informe que se emitirá posteriormente" aria-describedby="tooltip401610"></i>
			</h2>

      <div class="clearfix"></div>
	</div>
	<p style="font-weight: bold; background: red; color:white;">Los siguientes datos ingresados en esta sección serán parte del informe que se emitirá posteriormente</p>

	<div class="form-group">
    	<label style="text-align: left;" class="control-label col-md-4 col-sm-4 col-xs-12">Empresa a la cual van dirigidos los informes</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
        	<input type="text" maxlength="30" class="form-control" placeholder="Nombre Empresa Receptora" id="empresa_encargada" required name="empresa_encargada" <?php echo $readonly;?> value="<?php echo $form_empresa_encargada?>">
		</div>
	</div>
	<div class="form-group">
    	<label style="text-align: left;" class="control-label col-md-4 col-sm-4 col-xs-12">Profesional a cargo de la obra</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
        	<input type="text" maxlength="30" class="form-control" placeholder="Nombre Profesional a cargo" id="profesional_acargo" required name="profesional_acargo" <?php echo $readonly;?> value="<?php echo $form_profesional_acargo;?>">
		</div>
	</div>

<!-- /////////////////////////// SECCION 4 ///////////////////////////////////////// -->
	<div class="x_title">
    	<h2 style="padding-top: 30px;">Antecedentes para facturaci&oacute;n <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Los siguientes datos ingresados en esta sección serán parte del informe que se emitirá posteriormente" aria-describedby="tooltip401610"></i></h2>
        <div class="clearfix"></div>
	</div>
	<p style="font-weight: bold; background: red; color:white;">Los siguientes datos ingresados en esta sección serán parte del informe que se emitirá posteriormente</p>
     <div class="form-group">
        <div class="col-md-8 col-sm-8 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Razon Social</label>
        	<input type="text" maxlength="30" class="form-control" placeholder="Razon Social"  id="razon_social" required name="razon_social" <?php echo $readonly;?> value="<?php echo $form_razon_social;?>">
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Rut de Empresa</label>
        	<input type="text"  maxlength="13" class="form-control" maxlength="10" placeholder="Rut Empresa" id="rut_empresa_factura" oninput="checkRut(this)" required name="rut_empresa_factura" <?php echo $readonly;?> value="<?php echo $form_rut_empresa_factura?>">
					<script src="js/CheckRut.js"></script>

		</div>
	</div>
	<div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Giro de Empresa</label>
        	<input type="text" class="form-control" placeholder="Giro Empresa" id="giro_empresa"  required name="giro_empresa" <?php echo $readonly;?> value="<?php echo $form_giro_empresa?>">
		</div>
	</div>
	<div class="form-group">
  	<div class="col-md-12 col-sm-12 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Dirección de facturación y envío</label>
      <input type="text" class="form-control" placeholder="Direccion de envio de la Factura" id="direccion_factura"  required name="direccion_factura" <?php echo $readonly;?> value="<?php echo $form_direccion_factura?>">
		</div>
</div>
<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php
				if($readonly==""){?>
					<select class="form-control" name="region_facturacion" required="required" id="regiones_"></select>
					<?php
				}else{?>
					<input type="text" class="form-control" placeholder="Direccion" id="regiones_" required name="region_facturacion" <?php echo $readonly;?> value="<?php echo $form_region;?>">
				<?php
				}
				?>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<?php
			if($readonly==""){?>
				<select class="form-control" name="ciudad_facturacion" required="required" id="comunas_"></select>
				<?php
			}else{?>
				<input type="text" class="form-control" placeholder="Direccion" id="comunas_" required name="ciudad_facturacion" <?php echo $readonly;?> value="<?php echo $form_comuna;?>">
			<?php
			}
			?>
			</div>
		</div>




	<div class="form-group" id="periodo_facturacion" >
  	<div class="col-md-3 col-sm-4 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Forma de pago</label>
			<?php
			if($readonly==""){?>
				<select class="form-control" id="forma_pago" name="forma_pago" required <?php echo $readonly;?> onChange="CambiarFormulario()">
					<option value="0" selected>Seleccione:</option>
					<?php
						echo $droppago;
					?>
				</select>
				<?php
			}else{?>
				<input type="text" class="form-control" placeholder="Direccion" id="forma_pago" required name="forma_pago" <?php echo $readonly;?> value="<?php echo $form_forma_pago;?>">
			<?php
			}
			?>
		</div>

		<div class="col-md-3 col-sm-4 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12"> Otro </label>
      <input type="text" name="otro" class="form-control">
		</div>

		<div class="col-md-2 col-sm-4 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Referencia</label>
			<?php
			if($readonly==""){?>
				<select class="form-control" id="referencia" name="referencia" required <?php echo $readonly;?>>
					<option value="0" selected>Seleccione:</option>
					<option value="1" >OC</option>
					<option value="2" >HES</option>
					<option value="3" >Automedicion</option>
					<option value="4" >Otros</option>
				</select>
				<?php
			}else{?>
				<input type="text" class="form-control" placeholder="Direccion" id="forma_pago" required name="forma_pago" <?php echo $readonly;?> value="<?php echo $form_forma_pago;?>">
			<?php
			}
			?>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-12">
			<label style="text-align: left;" class="col-md-12 col-sm-12 col-xs-12 control-label">Periodo de facturación</label>
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<label>
					<input type="radio" class="flat col-md-4 col-sm-4 col-xs-12" name="periodo_facturacion" value="1" <?php echo $readonly;?> > Semanal
				</label>
			</div>
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<label>
					<input type="radio" class="flat col-md-4 col-sm-4 col-xs-12" name="periodo_facturacion" value="2" <?php echo $readonly;?>> Quincenal
				</label>
			</div>
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<label>
					<input type="radio" class="flat col-md-4 col-sm-4 col-xs-12" name="periodo_facturacion" value="3" checked <?php echo $readonly;?>> Mensual
				</label>
			</div>
		</div>
	</div>
	 <div class="form-group">

		<div class="col-md-6 col-sm-6 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Teléfono para Facturación</label>
        	<input type="tel" maxlength="15" class="form-control" placeholder="Telefono" id="telefono_facturacion"   required name="telefono_facturacion" <?php echo $readonly;?> value="<?php echo $form_telefono_facturacion?>">
		</div>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<label style="text-align: left;" class="control-label col-md-12 col-sm-12 col-xs-12">Email de Facturación</label>
        	<input type="email" maxlength="30" class="form-control" placeholder="Email" id="email_facturacion" name="email_facturacion" required <?php echo $readonly;?> value="<?php echo $form_email_facturacion;?>">
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre de quien acepta</label>
        <div class="col-md-10 col-sm-10 col-xs-12">
        	<input type="text" maxlength="30" class="form-control" placeholder="Nombre Persona o Entidad Aceptante" id="nombre_aceptante" required name="nombre_aceptante" <?php echo $readonly;?> value="<?php echo $form_nombre_aceptante;?>">
		</div>
	</div>



	<div class="ln_solid"></div>
	<?php
	if($result_form_aceptacion==0){?>
    <div class="form-group">
       	<div class="col-md-12 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm" >Enviar Aceptaci&oacute;n  </button>
		</div>
	</div>
    <?php
	}?>


    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
									  </button>
									  <h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n de Aceptaci&oacute;n</h4>
									</div>
									<div class="modal-body">
									  <h4>Declaro que los datos ingreados en el formulario de aceptación son correctos y pueden ser utilizados para la emision del(los) informe(s) de servicio(s)
										<p>¿Desea Continuar?</p>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
									  <button type="submit" class="btn btn-success">Aceptar</button>
									</div>
							  	</div>
							</div>
						</div>


</form>



                		</div>
              		</div>
            	</div>
          	</div>
      	</div>
    </div>
<!-- ///////////////////////// POPUP CONFIRMACION -->

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

		<script>

		var RegionesYcomunas = {
			"regiones": [
					<?php
					$query_regiones = "SELECT region_id, region_nombre FROM TBL_Region";
					$sql_regiones = mysqli_query($link, $query_regiones);
					while($nombre_region = mysqli_fetch_assoc($sql_regiones)){?>
					{
					"NombreRegion": "<?php echo $nombre_region['region_nombre']?>",
					"comunas": [<?php $query_comunas = "SELECT c.comuna_id as ID_COMUNA, c.comuna_nombre as COMUNA FROM TBL_Region r, TBL_Provincia p, TBL_Comuna c WHERE r.region_id = '".$nombre_region['region_id']."' AND r.region_id = p.region_id AND p.provincia_id = c.provincia_id ORDER BY COMUNA ASC"; $sql_comunas = mysqli_query($link, $query_comunas); $total = mysqli_num_rows($sql_comunas); $i=1; while($nombre_comuna = mysqli_fetch_assoc($sql_comunas)){?>"<?php echo $nombre_comuna['COMUNA']; ?>"<?php $i++; if($i<=$total){echo ","; }}?>]
					},
					<?php
					}?>
			]
		}
		var RegionesYcomunas_ = RegionesYcomunas;

		jQuery(document).ready(function () {

			var iRegion = 0;
			var htmlRegion = '<option value="sin-region">Seleccione región</option><option value="sin-region">--</option>';
			var htmlComunas = '<option value="sin-region">Seleccione comuna</option><option value="sin-region">--</option>';

			jQuery.each(RegionesYcomunas.regiones, function () {
				htmlRegion = htmlRegion + '<option value="' + RegionesYcomunas.regiones[iRegion].NombreRegion + '">' + RegionesYcomunas.regiones[iRegion].NombreRegion + '</option>';
				iRegion++;
			});

			jQuery('#regiones').html(htmlRegion);
			jQuery('#comunas').html(htmlComunas);

			jQuery('#regiones_').html(htmlRegion);
			jQuery('#comunas_').html(htmlComunas);

			jQuery('#regiones').change(function () {
				var iRegiones = 0;
				var valorRegion = jQuery(this).val();
				var htmlComuna = '<option value="sin-comuna">Seleccione comuna</option><option value="sin-comuna">--</option>';
				jQuery.each(RegionesYcomunas.regiones, function () {
					if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
						var iComunas = 0;
						jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function () {
							htmlComuna = htmlComuna + '<option value="' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '">' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '</option>';
							iComunas++;
						});
					}
					iRegiones++;
				});
				jQuery('#comunas').html(htmlComuna);
			});

			jQuery('#regiones_').change(function () {
				var iRegiones = 0;
				var valorRegion = jQuery(this).val();
				var htmlComuna = '<option value="sin-comuna">Seleccione comuna</option><option value="sin-comuna">--</option>';
				jQuery.each(RegionesYcomunas.regiones, function () {
					if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
						var iComunas = 0;
						jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function () {
							htmlComuna = htmlComuna + '<option value="' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '">' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '</option>';
							iComunas++;
						});
					}
					iRegiones++;
				});
				jQuery('#comunas_').html(htmlComuna);
			});



			jQuery('#comunas').change(function () {
				if (jQuery(this).val() == 'sin-region') {
					alert('selecciones Región');
				} else if (jQuery(this).val() == 'sin-comuna') {
					alert('selecciones Comuna');
				}
			});

			jQuery('#comunas_').change(function () {
				if (jQuery(this).val() == 'sin-region') {
					alert('selecciones Región');
				} else if (jQuery(this).val() == 'sin-comuna') {
					alert('selecciones Comuna');
				}
			});

			jQuery('#regiones').change(function () {
				if (jQuery(this).val() == 'sin-region') {
					alert('selecciones Región');
				}
			});

			jQuery('#regiones_').change(function () {
				if (jQuery(this).val() == 'sin-region') {
					alert('selecciones Región');
				}
			});
		});


		</script>
</body>
</html>
