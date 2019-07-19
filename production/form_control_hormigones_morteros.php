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



$query = "
SELECT
	ag.id_agendamiento_visita AS ID,
	ag.nombre_proyecto AS PROYECTO,
	ag.rut_empresa AS RUT,
	ag.razon_social AS CLIENTE,
	ag.id_laboratorista as IDLABORATORISTA,
	l.nombre_laboratorista AS LABORATORISTA,
	ag.fecha_agendamiento AS FECHA,
	ag.email_proyecto AS EMAIL,
	ag.contacto_proyecto AS CONTACTO,
	ag.direccion_proyecto AS DIRECCION,
	ag.telefono_proyecto AS TELEFONO
FROM
	TBL_AgendaVisita ag, TBL_Laboratorista l
WHERE
	ag.id_agendamiento_visita = '".$_GET['id']."' AND
	ag.id_laboratorista = l.id_laboratorista
";


$sql = mysqli_query($link, $query) or die('Consulta fallida: '.mysql_error());;

while($fila = mysqli_fetch_assoc($sql)){
	$if_proyecto = $fila['PROYECTO'];
	$if_rut = $fila['RUT'];
	$if_cliente = $fila['CLIENTE'];
	$if_laboratorista = $fila['LABORATORISTA'];
	$if_idlaboratorista = $fila['IDLABORATORISTA'];
	$if_construye = $fila['CONSTRUYE'];
	$if_fecha = $fila['FECHA'];
	$if_email = $fila['EMAIL'];
	$if_contacto = $fila['CONTACTO'];
	$if_direccion = $fila['DIRECCION'];
	$if_telefono = $fila['TELEFONO'];
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

	<title>.: EBOX PLATFORM :. </title>


	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
	<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<!-- bootstrap-datetimepicker -->
	<link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
	<!-- Ion.RangeSlider -->
	<link href="../vendors/normalize-css/normalize.css" rel="stylesheet">
	<link href="../vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
	<link href="../vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
	<!-- Bootstrap Colorpicker -->
	<link href="../vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

	<link href="../vendors/cropper/dist/cropper.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
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
				width:60%;
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

  </head>

<body class="nav-md" role="main" onLoad="total_muestras();">
	<div class="container body" id="formato_pag">
		<div class="main_container" id="ancho_pag">
			<div class="">
		        <div class="clearfix"></div>
			    <div class="row">
              		<div class="col-md-12 col-sm-12 col-xs-12">
            	    	<div class="x_panel">
											<div class="x_content">
												<div class="form-group col-md-9 col-sm-8 col-xs-12">
													<div class="col-md-12 col-sm-12 col-xs-12" id="encabezado_verde"></div>
													<div class="col-md-12 col-sm-12 col-xs-12" id="encabezado_azul">
														<p id="header" style="text-align:right; ">CONTROL DE HORMIGONES Y MORTEROS</p>
													</div>
												</div>
												<div class="form-group col-md-3 col-sm-4 col-xs-2">
													<img src="images/Logo_marss-lab_255x100.jpg" style="width: 100%;">
												</div>
												<div class="form-group col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
													<img src="images/logo_inn-424x100.png" style="width: 15%;">
												</div>
											</div>



<form name="form_ch"class="form-horizontal form-label-left" action="form_control_hormigones_morteros_res.php" method="get">
	<input type="hidden" name="te" value="<?php echo $_GET['te'];?>">
	<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

<!-- /////////////////////////// SECCION 1 ///////////////////////////////////////// -->
	<div class="x_title">
	   	<div class="clearfix"></div>
	</div>

	<div class="form-group row">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">N° Solicitud</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" name="numero_solicitud" class="form-control" required value="">
			</div>
	</div>


	<div class="form-group row">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Fecha</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="input-group date" >
					<input type="text" name="fecha_solicitud" id="fecha_solicitud" class="form-control" required value="<?php echo $if_fecha; ?>" readonly>
					<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Correlativo Obra</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" class="form-control" name="correlativo_obra" placeholder="Correlativo Obra">
			</div>
	</div>

	<div class="form-group row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Obra</label>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<input type="text" class="form-control" name="obra" placeholder="Obra" readonly required value="<?php echo $if_proyecto; ?>" >
		</div>
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Construye</label>
    	<div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="construye" placeholder="Construye"  required value="<?php echo $if_construye?>">
			</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3 col-xs-12">Cliente</label>
		<div class="col-md-4 col-sm-9 col-xs-12">
			<input type="text" class="form-control" placeholder="Escriba"  readonly required name="cliente" value="<?php echo $if_cliente?>">
		</div>
    <label class="control-label col-md-2 col-sm-3 col-xs-12">Atención Señor</label>
    <div class="col-md-4 col-sm-9 col-xs-12">
    	<input type="text" class="form-control" placeholder="Escriba" readonly required name="atencion_sr" value="<?php echo $if_contacto; ?>">
		</div>
	</div>
	<div class="form-group row">
    	<label class="control-label col-md-2 col-sm-2 col-xs-12">Direccion Obra</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="direccion_obra"  readonly placeholder="Escriba" name="direccion_obra" required value="<?php echo $if_direccion; ?>">
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Fono Cliente</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="fono_cliente" readonly placeholder="Escriba" required name="fono_cliente" value="<?php echo $if_telefono; ?>">
			</div>
	</div>



	<div class="form-group row">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Servicio</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Inicio:</label>
			</br>
			<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_inicio">
					<input type="text" class="form-control" name="hora_ini" required>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
			</div>
		</div>

    <div class="col-md-3 col-sm-3 col-xs-12">
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Fin:</label>
			</br>
			<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_fin">
				<input type="text" class="form-control" name="hora_fin" required>
				<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-12">
			<label class="control-label col-md-2 col-sm-2 col-xs-12">Kilometraje</label>
      <input type="number" class="form-control" name="kilometraje" placeholder="Escriba" pattern="[0-9]" min=0>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-form-label col-md-2 col-sm-2 col-xs-12"></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
			<label class="col-form-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Realizado por</label>

			<?php
			$QRY_Laboratorista = "SELECT nombre_laboratorista, id_laboratorista FROM TBL_Laboratorista WHERE id_laboratorista!='15' AND LaboratoristaEstado = '1' ORDER BY nombre_laboratorista ASC";
			$SQL_Laboratorista = mysqli_query($link, $QRY_Laboratorista) or die('Error en Qry Lab: '.mysql_error($link));;
			?>
			<select class="form-control" required="required" id="realizado_por" name="realizado_por">
				<option value="">-- Seleccione --</option>
				<?php
				while($DataLab = mysqli_fetch_assoc($SQL_Laboratorista))
				{
					if($DataLab['id_laboratorista'] == $if_idlaboratorista){
						$selected = "selected";
					}
					else{
						$selected = "";
					}
				?>
				<option <?php echo $selected;?> value="<?php echo $DataLab['id_laboratorista'];?>"><?php echo $DataLab['nombre_laboratorista']?></option>
				<?php
				}
				?>
			</select>


		</div>

    <div class="col-md-4 col-sm-4 col-xs-12">
			<label class="col-form-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;"> Cantidad de Muestras</label>
				<select class="btn btn-default dropdown-toggle" name="cantidad_muestras" onChange="total_muestras()" required>
					<option value="0">-- Seleccione --</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
			 </select>
		</div>
	</div>


<!-- /////////////////////////// SECCION 2 ///////////////////////////////////////// -->



	<div class="x_title">
		<h2 style="padding-top: 30px;">Muestra</h2>
    <div class="clearfix"></div>
	</div>

	<div class="form-group">
  	<label class="control-label col-md-2 col-sm-2 col-xs-12">N°</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="number" class="form-control" placeholder="Escriba" name="correlativo" min=0 required>
		</div>
  	<label class="control-label col-md-2 col-sm-2 col-xs-12">Cod. Hormigon</label>
    <div class="input-group col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control" placeholder="Escriba" name="cod_hormigon" required>
		</div>
	</div>

  <div class="form-group">
		<label class="control-label col-md-2 col-sm-2 col-xs-12">Fecha</label>
		<div class="col-md-4 col-sm-3 col-xs-12">
			<div class="input-group date" id="fecha_muestra">
				<input type="text" name="fecha_muestra" class="form-control" required value="<?php echo $if_fecha;?>" readonly>
				<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>


		<label class="control-label col-md-2 col-sm-2 col-xs-12">Hora</label>
		<div class="input-group col-md-4 col-sm-4 col-xs-12 date" id="hora_control">
			<input type="text" class="form-control" required name="hora_control">
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>



	</div>



<!-- /////////////////////////// SECCION 2 ///////////////////////////////////////// -->
	<div class="x_title">
  	<h2 style="padding-top: 30px;">Probeta</h2>
    <div class="clearfix"></div>
	</div>

	<div class="form-group">
		<div class="col-md-1 col-sm-3 col-xs-12" >
		</div>

		<div class="col-md-2 col-sm-3 col-xs-12" >
			<!-- /////////////
			Probeta:
			1 = 20x20x20 COMPRESION CUBO HORMIGÓN
			2 = 15x15x15 COMPRESION CUBO HORMIGÓN
			3 = 15x15x30 CILINDRO
			4 = 15x15x53 FLEXO TRACCIÓN
			5 = 4x4x16   RILEN
			/////////////-->

			<?php
			$QRY_Probeta = "SELECT FormHMProb_Id, FormHMProb_Nombre FROM TBL_FormHMProb WHERE 1 ORDER BY FormHMProb_Nombre ASC";
			$SQL_Probeta = mysqli_query($link, $QRY_Probeta) or die ("Existe error en SQL Probeta".mysqli_error($link));;
			while ($Data_Probeta = mysqli_fetch_assoc($SQL_Probeta)) {
				?>
				<div class="row" style="text-align: left;">
					<input type="radio" name="probeta"  value="<?php echo $Data_Probeta['FormHMProb_Id']?>">
					<label ><?php echo $Data_Probeta['FormHMProb_Nombre']?></label>
				</div>
				<?php
			}
			?>
		</div>
		<div class="col-md-9 col-sm-10 col-xs-12" >
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Designación de</br> Moldes utilizadas</label>
				<div class="col-md-8 col-sm-8 col-xs-12">

				<?php
				for($i=1; $i<=6; $i++){?>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<?php echo $i;?></br><input type="text" class="form-control" maxlength="4" placeholder="" name="DMU<?php echo $i;?>" id="DMU<?php echo $i;?>"><br>
					</div>
				<?php
				}?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 col-sm-2 col-xs-12">
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<!-- ///////////// compresion: 1=apisonado; 2=Inmersion /////////////-->

					<?php
					$QRY_Compresion = "SELECT FormHMComp_Id, FormHMComp_Nombre FROM TBL_FormHMComp WHERE 1 ORDER BY FormHMComp_Nombre ASC";
					$SQL_Compresion = mysqli_query($link, $QRY_Compresion) or die ("Existe error en SQL Compresion".mysqli_error($link));;
					while ($Data_Compresion = mysqli_fetch_assoc($SQL_Compresion)) {
						?>
						<div class="row" style="text-align: left;">
							<input type="radio" name="compresion"  value="<?php echo $Data_Compresion['FormHMComp_Id']?>">
							<label ><?php echo $Data_Compresion['FormHMComp_Nombre']?></label>
						</div>

						<?php
					}
					?>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<!-- ///////////// movimiento: 1=enviado; 2=Retirado /////////////-->

					<?php
					$QRY_Mov = "SELECT FormHMMov_Id, FormHMMov_Nombre FROM TBL_FormHMMov WHERE 1 ORDER BY FormHMMov_Nombre ASC";
					$SQL_Mov = mysqli_query($link, $QRY_Mov) or die ("Existe error en SQL Movimiento".mysqli_error($link));;
					while ($Data_Mov = mysqli_fetch_assoc($SQL_Mov)) {
						?>
						<div class="row" style="text-align: left;">
							<input type="radio" name="movimiento"  value="<?php echo $Data_Mov['FormHMMov_Id']?>">
							<label ><?php echo $Data_Mov['FormHMMov_Nombre']?></label>
						</div>

						<?php
					}
					?>
				</div>

			</div>


		</div>
	</div>




	<!-- /////////////////////////// SECCION 3 ///////////////////////////////////////// -->
	<div class="x_title">
    	<h2 style="padding-top: 30px;">Tipo Curado</h2>
        <div class="clearfix"></div>
	</div>
<!-- ///////////// curado: 1=humeda; 2=Inmersion /////////////-->
	<div class="form-group">
		<div class="col-md-1 col-sm-4 col-xs-12" >
		</div>
		<div class="col-md-3 col-sm-4 col-xs-12" >
			<div class="row" style="text-align: left;">
				<label>
					C&aacute;mara H&uacute;meda
				</label>
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="curado" value="1">
			</div>

			<div class="row" style="text-align: left;">
				<label>
					Inmersi&oacute;n
				</label>
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="curado" value="2">
			</div>

		</div>
		<div class="col-md-8 col-sm-6 col-xs-12" >
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora de Carga en Planta</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_carga_planta">
							<input type="text" class="form-control" name="hora_carga_planta">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>
				</div>
			</div>
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora Salida Planta</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_salida_planta">
							<input type="text" class="form-control" name="hora_salida_planta">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>

				</div>
			</div>
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora Llegada Planta</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_llegada_planta">
							<input type="text" class="form-control" name="hora_llegada_planta">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>
				</div>
			</div>
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora Inicio Descarga</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_inicio_descarga">
							<input type="text" class="form-control" name="hora_inicio_descarga">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>
				</div>
			</div>
			<div class="row">
				<label class="control-label col-md-4 col-sm-4 col-xs-12">Hora T&eacute;rmino Descarga</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_termino_descarga">
							<input type="text" class="form-control" name="hora_termino_descarga">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- /////////////////////////// SECCION 3 ///////////////////////////////////////// -->
	<div class="x_title">

        <div class="clearfix"></div>
	</div>

	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Curado obra</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control" placeholder="Escriba" name="curado_obra">
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Muestreo efectuado por</label>
        <div class="col-md-9 col-sm-9 col-xs-12">

					<?php
					$QRY_Laboratorista = "SELECT nombre_laboratorista, id_laboratorista FROM TBL_Laboratorista WHERE id_laboratorista!='15' AND LaboratoristaEstado = '1' ORDER BY nombre_laboratorista ASC";
					$SQL_Laboratorista = mysqli_query($link, $QRY_Laboratorista) or die('Error en Qry Lab: '.mysql_error($link));;
					?>
					<select class="form-control" required="required" id="responsable_muestreo" name="responsable_muestreo">
						<option value="">-- Seleccione --</option>
						<?php
						while($DataLab = mysqli_fetch_assoc($SQL_Laboratorista))
						{
							if($DataLab['id_laboratorista'] == $if_idlaboratorista){
								$selected = "selected";
							}
							else{
								$selected = "";
							}
						?>
							<option <?php echo $selected;?> value="<?php echo $DataLab['id_laboratorista'];?>"><?php echo $DataLab['nombre_laboratorista']?></option>
						<?php
						}
						?>
					</select>
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Lugar de Extracción</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control" placeholder="Escriba" name="lugar_extraccion">
		</div>
	</div>


<!-- /////////////////////////// SECCION 3 ///////////////////////////////////////// -->
	<div class="x_title">
    	<h2 style="padding-top: 30px;">Hormig&oacute;n</h2>
        <div class="clearfix"></div>
	</div>

	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Dosificaci&oacute;n declarada</label>
			<div class="col-md-1 col-sm-1 col-xs-12">
      	<input type="text" class="form-control" placeholder="Escriba" id="DOSD_tipo" name="DOSD_tipo" value="">
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12">
      	<input type="number" step="0.1" class="form-control" placeholder="Escriba" id="DOSD_resistencia" name="DOSD_resistencia" onchange="cambia_valor()" min=0>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12">
      	<input type="number" class="form-control" placeholder="Escriba" id="DOSD_nivel" name="DOSD_nivel" min=0>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12">
      	<input type="number" class="form-control" placeholder="Escriba" id="DOSD_tamano" name="DOSD_tamano" min=0>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12">
      	<input type="number" class="form-control" placeholder="Escriba" id="DOSD_densidad" name="DOSD_densidad" min=0>
			</div>


	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Resistencia especificada</label>
    <div class="col-md-3 col-sm-2 col-xs-12">
    	<input type="number" step="0.1" class="form-control" placeholder="Escriba" id="resistencia_especificada" name="resistencia_especificada" min=0>
		</div>
		<div class="radio col-md-6 col-sm-6 col-xs-12" style="text-align: left">
			<label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="radio" class="flat col-md-6 col-sm-6 col-xs-12" id="resistencia_tipo1" name="resistencia_tipo" value="1">MPa
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="radio" class="flat col-md-6 col-sm-6 col-xs-12" id="resistencia_tipo2" name="resistencia_tipo" value="2">Kgf/cm2
				</div>
			</label>
		</div>
	</div>


	<div class="form-group">
		<label class="col-md-3 col-sm-3 col-xs-12 control-label">Procedencia Obra</label>
		<div class="radio col-md-3 col-sm-3 col-xs-12" style="text-align: left;">
			<!-- //////////////////// Procedencia: 1 = Maquina; 2 = Pala  //////////////////// -->
			<label>
				<input type="radio" class="flat" name="procedencia" value="1"> M&aacute;quina
				<br><br><br>
				<input type="radio" class="flat" name="procedencia" value="2"> Pala
			</label>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
    		<label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: left;">Premezclado</label>

				<div class="col-md-9 col-sm-9 col-xs-12" >
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Marca</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select class="form-control" required="required" id="marca" name="marca">
							<option value="">--</option>
							<?php
							$QRY_Marca = "SELECT FormHMMarca_Id, FormHMMarca_Nombre FROM TBL_FormHMMarca";
							$SQL_Marca = mysqli_query($link, $QRY_Marca) or die ("Error en Marca".mysqli_error($link));;
							while ($Marca = mysqli_fetch_assoc($SQL_Marca)) {
								?>
								<option value="<?php echo $Marca['FormHMMarca_Id'];?>"><?php echo $Marca['FormHMMarca_Nombre'];?></option>
							<?php
							}
							?>
						</select>
					</div>
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Cami&oacute;n</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" class="form-control" placeholder="Escriba" name="camion">
					</div>
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Gu&iacute;a</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" class="form-control" placeholder="Escriba" name="guia">
					</div>
					<label class="control-label col-md-3 col-sm-3 col-xs-12">M3</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="number" step="0.1" class="form-control" placeholder="Escriba" name="M3" min=0>
					</div>
				</div>
			</label>
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Cono</label>
        <div class="col-md-3 col-sm-2 col-xs-12">
        	<input type="number" step="0.1" min=0 class="form-control" placeholder="Escriba">
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left">
			<!--////////////////////////// Cono: 1=cms; 2= mms //////////////////////////-->
			<div class="radio col-md-6 col-sm-6 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="cono" value="1">
				<label>
					cms
				</label>
			</div>
			<div class="radio col-md-6 col-sm-6 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="cono" value="2">
				<label>
					mms
				</label>
			</div>

		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Aspecto</label>
<!-- ////////////////////////// Aspecto: 1 = seco; 2 = plastico; 3 = fluido-->
		<div class="col-md-9 col-sm-9 col-xs-12" style="text-align: left">
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="aspecto" value="1">
				<label>
					Seco
				</label>
			</div>
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="aspecto" value="2">
				<label>
					Pl&aacute;stico
				</label>
			</div>
      <div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="aspecto" value="3">
				<label>
					Fluido
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Textura</label>
<!-- ////////////////////////// Textura: 1 = normal; 2 = ripiosa; 3 = arenosa //////////////////////////-->
		<div class="col-md-9 col-sm-9 col-xs-12" style="text-align: left">
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="col-md-3 col-sm-3 col-xs-12" name="textura" value="1">
				<label>
					 Normal
				</label>
			</div>
			<div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="textura" value="2">
				<label>
					Ripiosa
				</label>
			</div>
      <div class="radio col-md-4 col-sm-4 col-xs-12">
				<input type="radio" class="flat col-md-3 col-sm-3 col-xs-12" name="textura" value="3">
				<label>
					Arenosa
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Elemento Hormigonado</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control" placeholder="Escriba" name="elemento_hormigonado">
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Aditivos</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control" placeholder="Escriba" name="aditivos">
		</div>
	</div>
	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        	<input type="text" class="form-control" placeholder="Escriba" name="observaciones">
		</div>
	</div>


<!-- /////////////////////////// SECCION 4 ///////////////////////////////////////// -->
	<div class="x_title">
    	<h2 style="padding-top: 30px;">Equipos utilizados</h2>
        <div class="clearfix"></div>
	</div>
  <div class="form-group">
  	<label class="control-label col-md-2 col-sm-2 col-xs-12">Term&oacute;metro</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control" placeholder="Escriba" name="termometro">
		</div>

		<label class="control-label col-md-2 col-sm-2 col-xs-12">Equipo cono</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control" placeholder="Escriba" name="equipo_cono">
		</div>
	</div>

	<div class="form-group row">
  	<label class="control-label col-md-2 col-sm-2 col-xs-12">Vibrador + Sonda</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control" placeholder="Escriba" name="vibrador_sonda">
		</div>
	 	<label class="control-label col-md-2 col-sm-2 col-xs-12">Regla met&aacute;lica</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    	<input type="text" class="form-control" placeholder="Escriba" name="regla_metrica">
		</div>
	</div>

	<div class="form-group row">
		<label class="control-label col-md-2 col-sm-3 col-xs-12">Otros</label>
    <div class="col-md-10 col-sm-9 col-xs-12">
    	<input type="text" class="form-control" placeholder="Escriba" name="otros">
		</div>
	</div>



	<div class="x_title">
    	<h2 style="padding-top: 30px;">Edades</h2>
        <div class="clearfix"></div>
	</div>
	<div class="form-group">
		<?php
		for($i=1; $i<=6; $i++){;?>

	  	<div class="col-md-2 col-sm-4 col-xs-12">
				<label class="control-label">Muestra <?php echo $i;?></label>
	      <input type="number" min='0' max='100' class="form-control" name="EM<?php echo $i;?>" id="EM<?php echo $i;?>" onchange="CalculaFecha(this.id);" placeholder="Escriba" pattern="[0-9]">
			</div>
		<?php
		}
		for($i=1; $i<=6; $i++){;?>
			<div class="col-md-2 col-sm-4 col-xs-12">
				<label class="control-label">Fecha final <?php echo $i;?></label>
	      <input type="text" class="form-control" name="fecha_EM<?php echo $i;?>" id="fecha_EM<?php echo $i;?>"  readonly value="">
			</div>
		<?php
		}?>
	</div>



	<div class="ln_solid"></div>
	<div class="form-group row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<button type="button" onclick="location.href='/production/operaciones_ingreso_formulario_reg.php?id=<?php echo $_GET['id'];?>'" class="btn btn-danger">Cancelar</button>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#envio-solicitud">Guardar</button>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="envio-solicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="envio-solicitud-titulo">Confirmación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					¿Esta seguro que desea continuar?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Guardar</button>
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
		<!-- jQuery -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="../vendors/fastclick/lib/fastclick.js"></script>
		<!-- NProgress -->
		<script src="../vendors/nprogress/nprogress.js"></script>
		<!-- bootstrap-daterangepicker -->
		<script src="../vendors/moment/min/moment.min.js"></script>
		<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
		<!-- bootstrap-datetimepicker -->
		<script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<!-- Ion.RangeSlider -->
		<script src="../vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
		<!-- Bootstrap Colorpicker -->
		<script src="../vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<!-- jquery.inputmask -->
		<script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
		<!-- jQuery Knob -->
		<script src="../vendors/jquery-knob/dist/jquery.knob.min.js"></script>
		<!-- Cropper -->
		<script src="../vendors/cropper/dist/cropper.min.js"></script>

		<!-- Custom Theme Scripts -->
		<script src="../build/js/custom.min.js"></script>

		<!-- Initialize datetimepicker -->
		<script>

		var cantidad = document.forms[0].cantidad_muestras.selectedIndex;

		function CalculaFecha(id){
			var FechaSolicitud = document.getElementById("fecha_solicitud").value;
			var Edad = document.getElementById(id).value;
			var FechaMuestra = new Date(FechaSolicitud);
			var Dias = parseInt(Edad);
			var FechaFinal = "";
			FechaMuestra.setDate(FechaMuestra.getDate() + (Dias + 1));
		  FechaFinal =  FechaMuestra.getFullYear() + '-' + (FechaMuestra.getMonth() + 1) + '-' + FechaMuestra.getDate();

			document.getElementById("fecha_"+id).value = FechaFinal;



/*
/////////
	document.getElementById("fecha_solicitud").value;
			var fecha = new Date($('#EM').val());
			var dias = 2; // Número de días a agregar
			var nuevaFecha = fecha.setDate(fecha.getDate() + dias);
			alert(nuevaFecha);
			console.info(fecha);
			document.getElementById("fecha_EM1").value = nuevaFecha;
			*/
		}




		$('#hora_inicio').datetimepicker({
				format: 'HH:mm'
		});
		$('#hora_fin').datetimepicker({
				format: 'HH:mm'
		});
		$('#hora_control').datetimepicker({
				format: 'HH:mm'
		});

		$('#hora_salida_planta').datetimepicker({
				format: 'HH:mm'
		});
		$('#hora_llegada_planta').datetimepicker({
				format: 'HH:mm'
		});
		$('#hora_inicio_descarga').datetimepicker({
				format: 'HH:mm'
		});
		$('#hora_termino_descarga').datetimepicker({
				format: 'HH:mm'
		});

		$('#hora_carga_planta').datetimepicker({
				format: 'HH:mm'
		});



		function total_muestras(){
			var cantidad = document.forms[0].cantidad_muestras.selectedIndex;
			switch(document.forms[0].cantidad_muestras.selectedIndex){
				case 1:
						document.forms[0].DMU1.disabled=false;
						document.forms[0].DMU2.disabled=true;
						document.forms[0].DMU3.disabled=true;
						document.forms[0].DMU4.disabled=true;
						document.forms[0].DMU5.disabled=true;
						document.forms[0].DMU6.disabled=true;

						document.forms[0].EM1.disabled=false;
						document.forms[0].EM2.disabled=true;
						document.forms[0].EM3.disabled=true;
						document.forms[0].EM4.disabled=true;
						document.forms[0].EM5.disabled=true;
						document.forms[0].EM6.disabled=true;
				break;
				case 2:
						document.forms[0].DMU1.disabled=false;
						document.forms[0].DMU2.disabled=false;
						document.forms[0].DMU3.disabled=true;
						document.forms[0].DMU4.disabled=true;
						document.forms[0].DMU5.disabled=true;
						document.forms[0].DMU6.disabled=true;

						document.forms[0].EM1.disabled=false;
						document.forms[0].EM2.disabled=false;
						document.forms[0].EM3.disabled=true;
						document.forms[0].EM4.disabled=true;
						document.forms[0].EM5.disabled=true;
						document.forms[0].EM6.disabled=true;
					break;

					case 3:
					document.forms[0].DMU1.disabled=false;
					document.forms[0].DMU2.disabled=false;
					document.forms[0].DMU3.disabled=false;
					document.forms[0].DMU4.disabled=true;
					document.forms[0].DMU5.disabled=true;
					document.forms[0].DMU6.disabled=true;

					document.forms[0].EM1.disabled=false;
					document.forms[0].EM2.disabled=false;
					document.forms[0].EM3.disabled=false;
					document.forms[0].EM4.disabled=true;
					document.forms[0].EM5.disabled=true;
					document.forms[0].EM6.disabled=true;
					break;

					case 4:
					document.forms[0].DMU1.disabled=false;
					document.forms[0].DMU2.disabled=false;
					document.forms[0].DMU3.disabled=false;
					document.forms[0].DMU4.disabled=false;
					document.forms[0].DMU5.disabled=true;
					document.forms[0].DMU6.disabled=true;

					document.forms[0].EM1.disabled=false;
					document.forms[0].EM2.disabled=false;
					document.forms[0].EM3.disabled=false;
					document.forms[0].EM4.disabled=false;
					document.forms[0].EM5.disabled=true;
					document.forms[0].EM6.disabled=true;
					break;

					case 5:
					document.forms[0].DMU1.disabled=false;
					document.forms[0].DMU2.disabled=false;
					document.forms[0].DMU3.disabled=false;
					document.forms[0].DMU4.disabled=false;
					document.forms[0].DMU5.disabled=false;
					document.forms[0].DMU6.disabled=true;

					document.forms[0].EM1.disabled=false;
					document.forms[0].EM2.disabled=false;
					document.forms[0].EM3.disabled=false;
					document.forms[0].EM4.disabled=false;
					document.forms[0].EM5.disabled=false;
					document.forms[0].EM6.disabled=true;
					break;

					case 6:
					document.forms[0].DMU1.disabled=false;
					document.forms[0].DMU2.disabled=false;
					document.forms[0].DMU3.disabled=false;
					document.forms[0].DMU4.disabled=false;
					document.forms[0].DMU5.disabled=false;
					document.forms[0].DMU6.disabled=false;

					document.forms[0].EM1.disabled=false;
					document.forms[0].EM2.disabled=false;
					document.forms[0].EM3.disabled=false;
					document.forms[0].EM4.disabled=false;
					document.forms[0].EM5.disabled=false;
					document.forms[0].EM6.disabled=false;
					break;
			}

			var i = cantidad;
			var j =0;
			for(i; i<=6; i++){
				j = i + 1;
				document.getElementById("fecha_EM"+j).value = "";
				document.getElementById("EM"+j).value = "";
				document.getElementById("DMU"+j).value = "";
			}
		}

		function cambia_valor(){
			var resistencia = document.getElementById("DOSD_resistencia").value;
			document.getElementById("resistencia_especificada").value = resistencia;
		}

		</script>
		</body>
		</html>
