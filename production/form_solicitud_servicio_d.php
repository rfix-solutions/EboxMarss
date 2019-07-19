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
				width:75%;
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
			#add_fields_placeholderValue1{display:none}

			#add_fields_placeholderValue2{display:none}
			#add_fields_placeholderValue3{display:none}
			#add_fields_placeholderValue4{display:none}

			#add_fields_placeholderValue5{display:none}
			#add_fields_placeholderValue6{display:none}
	  </style>
          <script type="text/javascript">
var nextinput = 0;
function AgregarCampos(){
nextinput++;
campo = 'Campo:<input type="text" name="<?php
while($cantidad > 0){
$name = "variable".$cantidad;
echo $name;
}
?>"size="20" id="campo' + nextinput + '"&nbsp; />';
$("#campos").append(campo);
}
</script>
  </head>

<body class="nav-md" role="main">
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
															<p id="header" style="text-align:right; ">SOLICITUD DE SERVICIO</p>
														</div>
													</div>
													<div class="form-group col-md-3 col-sm-4 col-xs-2">
														<img src="images/Logo_marss-lab_255x100.jpg" style="width: 100%;">
													</div>
													<div class="form-group col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
														<img src="images/logo_inn-424x100.png" style="width: 15%;">
													</div>
												</div>



<form class="form-horizontal form-label-left" method="get" action="form_solicitud_servicio_res.php">
<!-- /////////////////////////// SECCION 1 ///////////////////////////////////////// -->
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
<input type="hidden" name="te" value="<?php echo $_GET['te'];?>">

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
    	<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Fecha</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
				<div class="input-group date" id="fecha_solicitud">
        	<input type="text" name="fecha_solicitud" class="form-control" required value="<?php echo $if_fecha;?>" readonly>
          <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
			</div>

			<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Correlativo Obra</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="correlativo_obra" placeholder="Escriba" required>
			</div>
	</div>
	<div class="form-group row">
    	<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Obra</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control" name="nombre_obra"  placeholder="Escriba" required value="<?php echo $if_proyecto; ?>" >
			</div>
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Construye</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input type="text" class="form-control" name="construye" placeholder="Escriba" required value="">
			</div>
	</div>
	<div class="form-group row">
    	<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Cliente</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control"name="cliente" placeholder="Escriba" required  value="<?php echo $if_cliente?>">
			</div>
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Atencion Sr.</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control" name="atencionsr" placeholder="Escriba" required value="<?php echo $if_contacto; ?>">
			</div>
	</div>
	<div class="form-group row">
    	<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Direccion Obra</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control" name="direccion_obra" placeholder="Escriba" required value="<?php echo $if_direccion; ?>">
			</div>
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12" style="text-align:right;">Fono Cliente</label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input readonly type="text" class="form-control" name="fono_cliente" placeholder="Escriba" required value="<?php echo $if_telefono; ?>">
			</div>
	</div>

	<div class="form-group row">
		<label class="col-form-label col-md-2 col-sm-2 col-xs-12">Servicio</label>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12">Inicio:</label>
			</br>
			<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_inicio">
					<input type="text" class="form-control" name="hora_ini" required>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
			</div>
		</div>

    <div class="col-md-3 col-sm-3 col-xs-12">
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12">Fin:</label>
			</br>
			<div class="input-group col-md-12 col-sm-12 col-xs-12 date" id="hora_fin">
				<input type="text" class="form-control"  name="hora_fin" required>
				<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-12">
			<label class="col-form-label col-md-2 col-sm-2 col-xs-12">Kilometraje</label>
      <input type="number" class="form-control" name="kilometraje" min="0" placeholder="Escriba" pattern="[0-9]">
		</div>
	</div>

	<div class="form-group row">
		<label class="col-form-label col-md-2 col-sm-2 col-xs-12"></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
			<label class="col-form-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Realizado por</label>
      <!--<input type="text" class="form-control" name="realizado_por" placeholder="Escriba" required pattern="[A-Za-z ]+" value="<?php echo $if_laboratorista; ?>">
-->

			<?php
			$query = "SELECT * FROM TBL_Laboratorista WHERE id_laboratorista!='15'";
			$sql4 = mysqli_query($link, $query) or die('Consulta fallida: '.mysql_error());;
			?>
			<select class="form-control" required="required" id="realizado_por" name="realizado_por" required>
				<option value="">-- Seleccione --</option>
				<?php
				while($filas = mysqli_fetch_assoc($sql4))
				{
					if($filas['id_laboratorista'] == $if_idlaboratorista){
						$selected = "selected";
					}
					else{
						$selected = "";
					}
				?>

					<option <?php echo $selected;?> value="<?php echo $filas['id_laboratorista'];?>"><?php echo $filas['nombre_laboratorista']?></option>
				<?php
				}
				?>
			</select>



		</div>

    <div class="col-md-4 col-sm-4 col-xs-12">
			<label class="col-form-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;"> Cantidad de Muestras</label>
			<div class="btn-group">
				<select class="btn btn-default dropdown-toggle" name="cantidad_muestras" onChange="total_muestras()" required>
					<option value="0">--</option>
					<?php
					for($i=1; $i<=8; $i++){?>
						<option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php
					}
					?>
			 </select>
			</div>
		</div>

	</div>

	<!-- /////////////////////////// SECCION 3 DETALLE DE ENSAYOS ///////////////////////////////////////// -->

<?php

//// Orden de formulario /////
$listado_tipo_ensayos_a[0] = 2;
$listado_tipo_ensayos_a[1] = 7;
$listado_tipo_ensayos_a[2] = 8;
$listado_tipo_ensayos_b[0] = 4;
$listado_tipo_ensayos_b[1] = 3;
$listado_tipo_ensayos_c[0] = 1;
$listado_tipo_ensayos_c[1] = 6;
$listado_tipo_ensayos_c[2] = 5;

$i=1;
?>

<div class="form-group row">
	<!-- ////////////// COLUMNA 1 ////////////// -->
	<div class="col-md-4 col-sm-4 col-xs-12">
		<?php
		foreach($listado_tipo_ensayos_a as $tipo){
			$query_tipo_ensayo =  "
			SELECT id_tipo_ensayo AS ID, nombre_tipo_ensayo AS NOMBRE FROM TBL_EnsayoTipo where id_tipo_ensayo = '".$tipo."'
			";
			$sql_tipo_ensayo = mysqli_query($link, $query_tipo_ensayo);
			while($filas = mysqli_fetch_assoc($sql_tipo_ensayo)){
					$sql_item_ensayo = "
					SELECT id_ensayo AS IDENSAYO, nombre_ensayo AS NENSAYO
					FROM TBL_Ensayo
					WHERE id_tipo_ensayo = '".$filas['ID']."' AND id_estado_ensayo = '1' ";
					$query_item_ensayo = mysqli_query($link, $sql_item_ensayo);
					?>
					<div class="x_title">
						<h5 style="padding-top: 30px; text-align: left"><?php echo $filas['NOMBRE']?></h5>
						<div class="clearfix"></div>
					</div>
					<?php
					while($detalle = mysqli_fetch_assoc($query_item_ensayo)){
						?>

						<div class="col-md-12 col-sm-12 col-xs-12" id="item-checkbox" >

							<?php
							switch ($filas['ID']) {
								case '2': // MECANICA DE SUELOS
								if($filas['ID'] == $_GET['te']){ $disable = ""; }else{ $disable = "disabled"; }
								for($i=1;$i<=8;$i++){
									?>
									<input type="checkbox" <?php echo $disable; ?> name="t2_muestra_<?php echo $i;?>[]" value="<?php echo $detalle['IDENSAYO']?>">
									<?php
								}
								echo $detalle['NENSAYO'];

								break;

								case '7': // DENSIDAD
								if($filas['ID'] == $_GET['te']){ $disable = ""; }else{ $disable = "disabled"; }
									?>
									<input type="checkbox" <?php echo $disable; ?> name="t7_muestra_1[]" value="<?php echo $detalle['IDENSAYO']?>">
									<?php echo $detalle['NENSAYO'];
								break;

								case '8': // OTROS
								if($filas['ID'] == $_GET['te']){ $disable = ""; }else{ $disable = "disabled"; }
									?>
									<input type="checkbox" <?php echo $disable; ?> name="t8_muestra_1[]" value="<?php echo $detalle['IDENSAYO']?>">
									<?php echo $detalle['NENSAYO'];
								break;

							}
							?>
						</div>
						<?php
					}
					?>
					<div class="clearfix"></div>
					<?php
					$i++;
			}
		}
		?>
		</div>

		<!-- ////////////// COLUMNA 2 ////////////// -->
		<div class="col-md-4 col-sm-4 col-xs-12">
			<?php
			foreach($listado_tipo_ensayos_b as $tipo){
				$query_tipo_ensayo =  "
				SELECT id_tipo_ensayo AS ID, nombre_tipo_ensayo AS NOMBRE FROM TBL_EnsayoTipo where id_tipo_ensayo = '".$tipo."'
				";
				$sql_tipo_ensayo = mysqli_query($link, $query_tipo_ensayo);
				while($filas = mysqli_fetch_assoc($sql_tipo_ensayo)){

						$sql_item_ensayo = "
						SELECT id_ensayo AS IDENSAYO, nombre_ensayo AS NENSAYO
						FROM TBL_Ensayo
						WHERE id_tipo_ensayo = '".$filas['ID']."' AND id_estado_ensayo = '1' ";
						$query_item_ensayo = mysqli_query($link, $sql_item_ensayo);
						?>
						<div class="x_title">
							<h5 style="padding-top: 30px; text-align: left"><?php echo $filas['NOMBRE']?></h5>
							<div class="clearfix"></div>
						</div>
						<?php
						while($detalle = mysqli_fetch_assoc($query_item_ensayo)){?>

							<div class="col-md-12 col-sm-12 col-xs-12" id="item-checkbox" >

								<?php
								switch ($filas['ID']) {
									case '4': // ARIDOS
									if($filas['ID'] == $_GET['te']){ $disable = ""; }else{ $disable = "disabled"; }
									for($i=1;$i<=8;$i++){
										?>
										<input type="checkbox" <?php echo $disable; ?> name="t4_muestra_<?php echo $i;?>[]" value="<?php echo $detalle['IDENSAYO']?>">
										<?php
									}
									echo $detalle['NENSAYO'];
									break;

									case '3': // AGUAS
									if($filas['ID'] == $_GET['te']){ $disable = ""; }else{ $disable = "disabled"; }
										?>
										<input type="checkbox" <?php echo $disable; ?> name="t3_muestra_1[]" value="<?php echo $detalle['IDENSAYO']?>">
										<?php echo $detalle['NENSAYO'];
									break;

								}
								?>
							</div>
							<?php
						}
						?>
						<div class="clearfix"></div>
						<?php
						$i++;
				}
			}
			?>
		</div>

		<!-- ////////////// COLUMNA 3 ////////////// -->
		<div class="col-md-4 col-sm-4 col-xs-12">
			<?php
			foreach($listado_tipo_ensayos_c as $tipo){
				$query_tipo_ensayo =  "
				SELECT id_tipo_ensayo AS ID, nombre_tipo_ensayo AS NOMBRE FROM TBL_EnsayoTipo where id_tipo_ensayo = '".$tipo."'
				";
				$sql_tipo_ensayo = mysqli_query($link, $query_tipo_ensayo);
				while($filas = mysqli_fetch_assoc($sql_tipo_ensayo)){

						$sql_item_ensayo = "
						SELECT id_ensayo AS IDENSAYO, nombre_ensayo AS NENSAYO
						FROM TBL_Ensayo
						WHERE id_tipo_ensayo = '".$filas['ID']."' AND id_estado_ensayo = '1' ";
						$query_item_ensayo = mysqli_query($link, $sql_item_ensayo);
						?>
						<div class="x_title">
							<h5 style="padding-top: 30px; text-align: left"><?php echo $filas['NOMBRE']?></h5>
							<div class="clearfix"></div>
						</div>
						<?php
						while($detalle = mysqli_fetch_assoc($query_item_ensayo)){?>

							<div class="col-md-12 col-sm-12 col-xs-12" id="item-checkbox" >

								<?php
								switch ($filas['ID']) {
									case '1': // HORMIGON
									if($filas['ID'] == $_GET['te']){ $disable = ""; }else{ $disable = "disabled"; }
										?>
										<input type="checkbox" <?php echo $disable; ?> name="t1_muestra_1[]" value="<?php echo $detalle['IDENSAYO']?>">
										<?php echo $detalle['NENSAYO'];

									break;

									case '6': // ELEMENTOS Y COMPONENTES
									if($filas['ID'] == $_GET['te']){ $disable = ""; }else{ $disable = "disabled"; }
										?>
										<input type="checkbox" <?php echo $disable; ?> name="t6_muestra_1[]" value="<?php echo $detalle['IDENSAYO']?>">
										<?php echo $detalle['NENSAYO'];
									break;
									case '5': // ASFALTO
									if($filas['ID'] == $_GET['te']){ $disable = ""; }else{ $disable = "disabled"; }
										?>
										<input type="checkbox" <?php echo $disable; ?> name="t5_muestra_1[]" value="<?php echo $detalle['IDENSAYO']?>">
										<?php echo $detalle['NENSAYO'];
									break;
								}
								?>
							</div>
							<?php
						}
						?>
						<div class="clearfix"></div>
						<?php
						$i++;
				}
			}
			?>

		</div>
	</div>
	<div class="ln_solid"></div>

	<?php
	if($_GET['te'] == 2 || $_GET['te'] == 4){ ?>
	<div class="form-group row">
		<table>
			<tr>
				<td style="width:8%"></td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
			</tr>
			<tr>
				<td style="text-align:left;">Material</td>
				<?php
				for($i=1; $i<=8; $i++){;?>
					<td>
						<input type="text" class="form-control" required name="material<?php echo $i;?>" id="material<?php echo $i;?>" placeholder="Material" disabled>
					</td>
				<?php
				}?>
			</tr>
			<tr>
				<td style="text-align:left;">Procedencia</td>
				<?php
				for($i=1; $i<=8; $i++){;?>
					<td>
						<input type="text" class="form-control" required name="procedencia<?php echo $i;?>" id="procedencia<?php echo $i;?>" placeholder="Procedencia" disabled>
					</td>
				<?php
				}?>
			</tr>
			<tr>
				<td style="text-align:left;">Ubicaci&oacute;n</td>
				<?php
				for($i=1; $i<=8; $i++){;?>
					<td>
						<input type="text" class="form-control" required name="ubicacion<?php echo $i;?>" id="ubicacion<?php echo $i;?>" placeholder="Ubicación" disabled>
					</td>
				<?php
				}?>
			</tr>
		</table>
	</div>
	<div class="ln_solid"></div>
<?php }?>



	<div class="form-group row">
		<div class="col-md-8 col-sm-8 col-xs-12">
			<label for="message">Observaciones:</label>
			<textarea id="message" required="required" class="form-control" name="observaciones"></textarea>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<label for="message">Persona que firma por cliente</label>
			<input type="text" class="form-control" name="firma_cliente_rut" placeholder="Rut"  >
			<input type="text" class="form-control" name="firma_cliente_nombre" placeholder="Nombre" >
		</div>
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
	        <button type="button" class="btn btn-danger"  data-dismiss="modal">Cancelar</button>
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
		const te = "<?php echo $_GET['te'];?>";

		$('#fecha_solicitud').datetimepicker({
				format: 'YYYY-MM-DD'
		});

		$('#hora_inicio').datetimepicker({
				format: 'HH:mm'
		});
		$('#hora_fin').datetimepicker({
				format: 'HH:mm'
		});



		function total_muestras(){
			var cantidad = document.forms[0].cantidad_muestras.selectedIndex;
			switch(cantidad){
				case 0:

					<?php
						for($i=1;$i<=8;$i++){
						?>
						document.forms[0].material<?php echo $i;?>.disabled=true;
						document.forms[0].procedencia<?php echo $i;?>.disabled=true;
						document.forms[0].ubicacion<?php echo $i;?>.disabled=true;

						var x = document.getElementsByName("t"+te+"_muestra_<?php echo $i;?>[]");
    				var i;
    				for (i = 0; i < x.length; i++) {
		        	if (x[i].type == "checkbox") {
		            x[i].disabled = true;
		        	}
		    		}
						<?
						}
					?>

				break;

				case 1:
					<?php
						for($i=1;$i<=8;$i++){
							if($i<2){
								$Disable = "false";
							}
							else {
								$Disable = "true";
							}

						?>

						document.forms[0].material<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].procedencia<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].ubicacion<?php echo $i;?>.disabled=<?php echo $Disable;?>;

						var x = document.getElementsByName("t"+te+"_muestra_<?php echo $i;?>[]");
						var i;
						for (i = 0; i < x.length; i++) {
							if (x[i].type == "checkbox") {
								x[i].disabled = <?php echo $Disable;?>;
							}
						}
						<?
						}
					?>

				break;
				case 2:

				<?php
					for($i=1;$i<=8;$i++){
						if($i<3){
							$Disable = "false";
						}
						else {
							$Disable = "true";
						}

					?>

					document.forms[0].material<?php echo $i;?>.disabled=<?php echo $Disable;?>;
					document.forms[0].procedencia<?php echo $i;?>.disabled=<?php echo $Disable;?>;
					document.forms[0].ubicacion<?php echo $i;?>.disabled=<?php echo $Disable;?>;

					var x = document.getElementsByName("t"+te+"_muestra_<?php echo $i;?>[]");
					var i;
					for (i = 0; i < x.length; i++) {
						if (x[i].type == "checkbox") {
							x[i].disabled = <?php echo $Disable;?>;
						}
					}
					<?
					}
				?>




					break;

					case 3:

					<?php
						for($i=1;$i<=8;$i++){
							if($i<4){
								$Disable = "false";
							}
							else {
								$Disable = "true";
							}

						?>

						document.forms[0].material<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].procedencia<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].ubicacion<?php echo $i;?>.disabled=<?php echo $Disable;?>;

						var x = document.getElementsByName("t"+te+"_muestra_<?php echo $i;?>[]");
						var i;
						for (i = 0; i < x.length; i++) {
							if (x[i].type == "checkbox") {
								x[i].disabled = <?php echo $Disable;?>;
							}
						}
						<?
						}
					?>

					break;

					case 4:

					<?php
						for($i=1;$i<=8;$i++){
							if($i<5){
								$Disable = "false";
							}
							else {
								$Disable = "true";
							}

						?>

						document.forms[0].material<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].procedencia<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].ubicacion<?php echo $i;?>.disabled=<?php echo $Disable;?>;

						var x = document.getElementsByName("t"+te+"_muestra_<?php echo $i;?>[]");
						var i;
						for (i = 0; i < x.length; i++) {
							if (x[i].type == "checkbox") {
								x[i].disabled = <?php echo $Disable;?>;
							}
						}
						<?
						}
					?>

					break;

					case 5:

					<?php
						for($i=1;$i<=8;$i++){
							if($i<6){
								$Disable = "false";
							}
							else {
								$Disable = "true";
							}

						?>

						document.forms[0].material<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].procedencia<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].ubicacion<?php echo $i;?>.disabled=<?php echo $Disable;?>;

						var x = document.getElementsByName("t"+te+"_muestra_<?php echo $i;?>[]");
						var i;
						for (i = 0; i < x.length; i++) {
							if (x[i].type == "checkbox") {
								x[i].disabled = <?php echo $Disable;?>;
							}
						}
						<?
						}
					?>

					break;

					case 6:

					<?php
						for($i=1;$i<=8;$i++){
							if($i<7){
								$Disable = "false";
							}
							else {
								$Disable = "true";
							}

						?>

						document.forms[0].material<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].procedencia<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].ubicacion<?php echo $i;?>.disabled=<?php echo $Disable;?>;

						var x = document.getElementsByName("t"+te+"_muestra_<?php echo $i;?>[]");
						var i;
						for (i = 0; i < x.length; i++) {
							if (x[i].type == "checkbox") {
								x[i].disabled = <?php echo $Disable;?>;
							}
						}
						<?
						}
					?>

					break;

					case 7:

					<?php
						for($i=1;$i<=8;$i++){
							if($i<8){
								$Disable = "false";
							}
							else {
								$Disable = "true";
							}

						?>

						document.forms[0].material<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].procedencia<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].ubicacion<?php echo $i;?>.disabled=<?php echo $Disable;?>;

						var x = document.getElementsByName("t"+te+"_muestra_<?php echo $i;?>[]");
						var i;
						for (i = 0; i < x.length; i++) {
							if (x[i].type == "checkbox") {
								x[i].disabled = <?php echo $Disable;?>;
							}
						}
						<?
						}
					?>

					break;

					case 8:

					<?php
						for($i=1;$i<=8;$i++){
							if($i<9){
								$Disable = "false";
							}
							else {
								$Disable = "true";
							}

						?>

						document.forms[0].material<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].procedencia<?php echo $i;?>.disabled=<?php echo $Disable;?>;
						document.forms[0].ubicacion<?php echo $i;?>.disabled=<?php echo $Disable;?>;

						var x = document.getElementsByName("t"+te+"_muestra_<?php echo $i;?>[]");
						var i;
						for (i = 0; i < x.length; i++) {
							if (x[i].type == "checkbox") {
								x[i].disabled = <?php echo $Disable;?>;
							}
						}
						<?
						}
					?>

					break;
			}

			var i = cantidad;
			var j =0;
			for(i; i<=8; i++){
				j = i + 1;
				document.getElementById("material"+j).value = "";
				document.getElementById("procedencia"+j).value = "";
				document.getElementById("ubicacion"+j).value = "";
			}
		}





</script>
</body>
</html>
