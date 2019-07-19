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

$sql1 = mysqli_query($link, "
SELECT
	id_tipo_ensayo as ID, nombre_tipo_ensayo as NOMBRE_TIPO
FROM
	TBL_EnsayoTipo
") or die('Consulta fallida: '.mysql_error());;

$sql3 = mysqli_query($link, "
	SELECT
		id_destino as ID, nombre_destino as NOMBRE, precio as PRECIO
	FROM
		TBL_Destino
	ORDER BY
		nombre_destino
	") or die('Consulta fallida: '.mysql_error());;


if($_GET['id']=='0'){
	$SQLCliente = "
	SELECT
		id_cliente AS ID,
		rut_cliente AS RUT,
		nombre_cliente AS NOMBRE,
		razon_social AS RAZON_SOCIAL,
		direccion_cliente AS DIRECCION,
		contacto_cliente AS CONTACTO,
		telefono_cliente AS TELEFONO,
		email_cliente AS EMAIL
	FROM
		TBL_Cliente
	";
	$QryClientes = mysqli_query($link, $SQLCliente) or die('Consulta fallida: '.mysql_error());;
}
else{
	$SQLCliente = "
	SELECT
		id_cliente AS ID,
		rut_cliente AS RUT,
		nombre_cliente AS NOMBRE,
		razon_social AS RAZON_SOCIAL,
		direccion_cliente AS DIRECCION,
		contacto_cliente AS CONTACTO,
		telefono_cliente AS TELEFONO,
		email_cliente AS EMAIL
	FROM
		TBL_Cliente
	WHERE
		id_cliente = '".$_GET['id']."'
	";
	$QryClientes = mysqli_query($link, $SQLCliente) or die('Consulta fallida: '.mysql_error());;
	while($RowCliente = mysqli_fetch_assoc($QryClientes)){
		$CliRut = $RowCliente['RUT'];
		$CliNombre = $RowCliente['NOMBRE'];
		$CliProyecto = $RowCliente['RAZON_SOCIAL'];
		$CliDireccion = $RowCliente['DIRECCION'];
		$CliContacto  = $RowCliente['CONTACTO'];
		$CliEmail = $RowCliente['EMAIL'];
		$CliTelefono  = $RowCliente['TELEFONO'];
	}
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
		<title><?php echo $Title.$Company;?></title>
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

		<!--
		<script src="js/validarut.js"></script>-->
		<script type="text/javascript" src="../src/js/scripts.js"></script>
		<style>
		.dropdown-check-list{
		display: inline-block;
		width: 100%;
		}
		.dropdown-check-list:focus{
		outline:0;
		}
		.dropdown-check-list .anchor {
		width: 100%;
		position: relative;
		cursor: pointer;
		display: inline-block;
		padding-top:5px;
		padding-left:5px;
		padding-bottom:8px;
		border:1px solid;
		}
		.dropdown-check-list .anchor:after {
		position: absolute;
		content: "";
		border-left: 2px solid black;
		border-top: 2px solid black;
		padding: 5px;
		right: 10px;
		top: 20%;
		-moz-transform: rotate(-135deg);
		-ms-transform: rotate(-135deg);
		-o-transform: rotate(-135deg);
		-webkit-transform: rotate(-135deg);
		transform: rotate(-135deg);
		}
		.dropdown-check-list .anchor:active:after {
		right: 8px;
		top: 21%;
		}
		.dropdown-check-list ul.items {
		padding: 2px;
		display: none;
		margin: 0;
		border: 1px solid #ccc ;
		border-top: none;
		}
		.dropdown-check-list ul.items li {
		list-style: none;
		}

		.dropdown-check-list.visible .items {
		display: block;
		}
		</style>
	</head>
	<body class="nav-md" >
  	<div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title">
				  			<p style="text-align:center;">
									<img src="images/logo_marss.png" />
				  			</p>
				 			</a>
            </div>
            <div class="clearfix"></div>
						<?php
		  			include 'menu_sidebar.php';
						include 'menu_footer.php';
						?>
          </div>
        </div>
				<?php
       	include 'menu_top.php';
        ?>
				<div class="right_col" role="main">
					<div class="page-title">
          	<div class="title_left">
              <h3>Crear Cotizaci&oacute;n</h3>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
              	<div class="x_content">
									<form name="crear_cotizacion" action="cotizacion_crear_reg.php" method="get" data-parsley-validate class="form-horizontal form-label-left">

										<div class="form-group row">
											<div class="col-md-12">
												<h4 style="text-align: left;" class="col-md12">
													<strong>Datos del proyecto</strong>
												</h4>
											</div>
										</div>
	<div class="form-group row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<label>Rut</label>
    	<input type="text" class="form-control" id="rut_cliente" placeholder="Rut Cliente" name="rut_cliente" value="<?php echo $CliRut;?>">
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<label>Cliente</label>
			<input type="text" onKeyPress="return soloLetras(event)" required class="form-control" id="nombre_cliente" placeholder="Nombre Cliente" name="nombre_cliente" value="<?php echo $CliNombre;?>">
    </div>
  </div>

	<div class="form-group row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<label>Proyecto</label>
    	<input type="text" onKeyPress="return letrasYnumeros(event)" required class="form-control" id="nombre_proyecto" placeholder="Nombre Proyecto" name="nombre_proyecto" value="" >
		</div>
	</div>

	<div class="form-group row">
		<div class="col-md-6 col-sm-4 col-xs-12">
			<label>Direccion Proyecto</label>
    	<input type="text" required class="form-control" id="localidad" placeholder="Direccion Proyecto" name="localidad" value="">
		</div>
		<div class="col-md-3 col-sm-4 col-xs-12">
			<label>Regi&oacute;n</label>
			<select class="form-control" required id="regiones" name="region"></select>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-12">
			<label>Comuna</label>
			<select class="form-control" required id="comunas" name="comuna"></select>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<label>Contacto</label>
    	<input type="text" onKeyPress="return soloLetras(event)" required class="form-control" id="contacto" placeholder="Contacto Cliente" name="contacto" value="<?php echo $CliContacto;?>">
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<label>Email</label>
    	<input type="email" required class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $CliEmail;?>">
		</div>
	</div>

	<div class="form-group row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<label>Tel&eacute;fono</label>
    	<input type="text" minlength="8" maxlength="12" onKeyPress="return soloNumeros(event)" class="form-control" id="telefono" placeholder="Telefono" name="telefono" value="<?php echo $CliTelefono;?>">
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<label>Origen</label>
    	<select class="form-control" required="required" id="origen" name="origen">
				<option value="">-- Seleccione Origen --</option>
						<?php
						$query_origen = "SELECT id_origen, nombre_origen FROM TBL_Origen";
						$sql_origen = mysqli_query($link, $query_origen)  or die('Consulta fallida: '.mysql_error());;
						while($origen = mysqli_fetch_assoc($sql_origen)){?>
							<option value="<?php echo $origen['id_origen'];?>"><?php echo $origen['nombre_origen'];?></option>
						<?php
						}
						?>
				</select>
			</div>

			<div class="col-md-3 col-sm-3 col-xs-12">
				<label>Destino</label>
				<div class="button-group" style="text-align:left;">
	        <button type="button" class="form-control btn-default dropdown-toggle" data-toggle="dropdown">
						-- Seleccione Destino --  <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php
						while($destino = mysqli_fetch_assoc($sql3)){?>
					  <li>
							<a href="#" class="small" data-value="option1" tabIndex="-1"><input id="<?php echo $destino['ID'];?>" name="destinos[]" type="checkbox" value="<?php echo $destino['ID'];?>"/>
								&nbsp;<?php echo strtoupper($destino['NOMBRE']);?>
							</a>
						</li>
						<?php
						}
						?>
					</ul>
	  	</div>
		</div>





		</div>

		<div class="form-group row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h4 style="text-align: left;" class="col-md-12 col-sm-12 col-xs-12">
					<strong>Tipo de Servicio</strong>
				</h4>
			</div>
		</div>

	  <div class="form-group row">
			<div class="col-md-12 col-xs-12 col-sm-12">
			<?php
			while($row1 = mysqli_fetch_assoc($sql1)){
				$href = $row1['ID'];
				?>

			<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true"><!-- Inicio Acordeon -->
					<div class="panel">
    				<a class="panel-heading" role="tab" id="heading<?php echo $href;?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $href;?>" aria-expanded="false" aria-controls="collapse<?php echo $href;?>">
        			<h4 class="panel-title"><?php echo $row1['NOMBRE_TIPO']?></h4>
        		</a>
        		<div id="collapse<?php echo $href;?>" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="heading<?php echo $href;?>">
        			<div class="panel-body">
								<div class="table-responsive">
                <!-- Inicio de tabla con checkbox -->
									<table class="table table-striped jambo_table">
									<thead>
										<tr class="headings">
											<th>
												<input type="checkbox" class="icheckbox_flat-green" onchange="cambiaGrupo(this)">
                      </th>
											<th class="column-title"># </th>
											<th class="column-title">Nombre </th>
											<th class="column-title">Precio </th>
										</tr>
									</thead>
									<tbody>

									<?php
									$sql2 = mysqli_query($link, "
									SELECT
										e.id_ensayo as ID, t.nombre_tipo_ensayo as NOMBRE_TIPO, e.nombre_ensayo as NOMBRE_ENSAYO, e.precio as PRECIO
									FROM
										TBL_Ensayo e, TBL_EnsayoTipo t
									WHERE
										e.id_tipo_ensayo = t.id_tipo_ensayo
									AND
									e.id_tipo_ensayo = '".$row1['ID']."' AND
									e.id_estado_ensayo = '1'
									") or die('Consulta fallida: '.mysql_error());;
									$i = 0;
									$n = 1;
									while($row2 = mysqli_fetch_assoc($sql2)){
										if($i<0 || $i>1){
											$i = 0;
										}
										switch($i){
											case "0": $class = "even pointer";
												break;
											case "1": $class = "odd pointer";
												break;
											default: $i=0;
										}
										?>
											<tr class="<?php echo $class; ?>">
												<td class="a-center ">
													<input type="checkbox" value="<?php echo $row2['ID'];?>" class="icheckbox_flat-green" id="ensayos" name="ensayos[]">
												</td>
												<td><?php echo $row2['ID'];?></td>
												<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;" >
													<?php
									  			$nombre_serv = utf8_encode($row2['NOMBRE_ENSAYO']);
									  			echo utf8_decode($nombre_serv);
													?>
												</td>
												<td>UF <input type="number" step="0.01" min="0" id="precio_ensayo" name="precio_ensayo<?php echo $row2['ID'];?>" value="<?php echo $row2['PRECIO'];?>" style="max-width:50px;"></td>
											</tr>
										<?php
										$n++;
										}
										?>
									</tbody>
								</table>
							</div><!-- fin tabla responsive -->
						</div>
					</div>
				</div>
			</div>
			<?php
			}
			?>									<!-- end of accordion -->
		</div>
	</div>





	<div class="form-group row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h4 style="text-align: left;" class="col-md-12 col-xs-12 col-sm-12">
				<strong>Tipo Descuento</strong>
			</h4>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-md-3 col-sm-4 col-xs-12">
			<input type="radio" class="flat form-control" name="tipo_descuento" value="1" />
			General
			<br>
			<input type="radio"  class="flat" name="tipo_descuento"  value="2" />
			Ensayo
	    <br>
	    <input type="radio"  class="flat" name="tipo_descuento" value="3" checked />
			Sin Descuento
		</div>
		<div class="col-md-3 col-sm-2 col-xs-12">
			<input type="number" min="0" max="10" step="0.01" class="form-control has-feedback-left" id="valor_descuento" placeholder="%" name="valor_descuento" value="0" style="width: 110px;">
		</div>

		<div class="col-md-6 col-sm-4 col-xs-12">
			<label style="text-align: left" class="control-label col-md-12 col-sm-12 col-xs-12">
				Autorizado por:
			</label>

			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="checkbox" name="autoriza"  id="autoriza1" value="1" class="flat col-md-4" /> Finanzas
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="checkbox" name="autoriza"  id="autoriza2" value="2" class="flat col-md-4" /> Laboratorio
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="checkbox" name="autoriza"  id="autoriza3" value="3" class="flat col-md-4" /> Gerente
			</div>
		</div>
	</div>

	<div class="form-group row" align="right">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="ln_solid" ALIGN="justify"></div>
			<button type="button" onClick="Javascript:history.back();" class="btn btn-danger">Cancelar</button>
			<button type="button" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-success">Crear Cotizaci&oacute;n</button>
		</div>
	</div>


	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				  <h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n</h4>
				</div>
				<div class="modal-body">
					<p>¿Esta seguro que desea Continuar?</p>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				  <button type="submit" class="btn btn-success">Aceptar</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- CONTENIDO DE PAGINA -->

<div class="modal fade" id="clientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Seleccionar cliente</h5></br>
				<button type="button" onclick="Javascript:location.href='mant_clientes_opt.php?opt=0&id=0'" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Agregar</button>
      </div>
      <div class="modal-body">
				<table id="tblclientes" style="width: 100%" class="table table-striped table-bordered nowrap" >
					<thead>
						<tr>
							<th>ID</th>
							<th>Rut</th>
							<th>Nombre</th>
							<th>Razon Social</th>
							<th>Ir</th>
						</tr>
						</thead>
					<tbody>
					<?php
					while($row = mysqli_fetch_assoc($QryClientes)){
					?>
						<tr>
							<td><?php echo $row['ID'];?></td>
							<td><?php echo $row['RUT'];?></td>
							<td><?php echo ucwords($row['NOMBRE']);?></td>
							<td><?php echo ucwords($row['RAZON_SOCIAL']);?></td>
							<td>
								<button type="button" onclick="Javascript:location.href='cotizacion_crear.php?id=<?php echo $row['ID'];?>'" class="btn btn-success btn-xs"><i class="fa fa-arrow-right"></i></button>
							</td>
							</tr>
					<?php
					}
					?>
					</tbody>
				</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="location.href='dashboard_comercial.php'" >Cancelar</button>

      </div>
    </div>
  </div>
</div>


								</div>
							</div>
            </div>
          </div>
        </div>
			</div>
			<?php
			include 'footer.php';
      ?>
		</div>


    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
	<!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
		<!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
    <script type="application/javascript">

		$(window).load(function(){

			function getQueryVariable(variable){
				var query = window.location.search.substring(1);
				var vars = query.split("&");
				for (var i=0;i<vars.length;i++) {
        	var pair = vars[i].split("=");
          if(pair[0] == variable){return pair[1];}
       	}
				return(false);
			}

			var CotId = getQueryVariable("id");

			if(CotId=='0'){
				$('#clientes').modal('show');
			}
		});




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

			jQuery(document).ready(function () {

				var iRegion = 0;
				var htmlRegion = '<option value="">Seleccione región</option>';
				var htmlComunas = '<option value="">Seleccione comuna</option>';

				jQuery.each(RegionesYcomunas.regiones, function () {
					htmlRegion = htmlRegion + '<option value="' + RegionesYcomunas.regiones[iRegion].NombreRegion + '">' + RegionesYcomunas.regiones[iRegion].NombreRegion + '</option>';
					iRegion++;
				});

				jQuery('#regiones').html(htmlRegion);
				jQuery('#comunas').html(htmlComunas);

				jQuery('#regiones').change(function () {
					var iRegiones = 0;
					var valorRegion = jQuery(this).val();
					var htmlComuna = '<option value="">Seleccione comuna</option>';
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
				jQuery('#comunas').change(function () {
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

		});



		jQuery(function ($) {
        var checkList = $('.dropdown-check-list');
        checkList.on('click', 'span.anchor', function(event){
            var element = $(this).parent();

            if ( element.hasClass('visible') )
            {
                element.removeClass('visible');
            }
            else
            {
                element.addClass('visible');
            }
        });
    });

	</script>
  </body>
</html>
