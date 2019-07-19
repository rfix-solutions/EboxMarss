<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} 
else 
{?>
	<script type="text/javascript">
		alert("Esta pagina es solo para usuarios registrados.")
		location.href="https://www.ebox.cl/login/index.php?url=<?php echo $_SERVER["PHP_SELF"];?>";
	</script>		
<?php
		exit;
}
include '_qry/db_connect_local.php';
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

	  <script src="js/validarut.js"></script>
	<script type="text/javascript">
		function valida_rut(){
			return Rut(document.getElementById("rut_cliente").value);
		}
		
		//inicio funcion verificar CheckBoxs
function validar(esto){ 
valido=false; 
for(a=0;a<esto.elements.length;a++){ 
if(esto[a].getElementById('ensayos').type=="checkbox" && esto[a].checked==true){ 
valido=true; 
break 
}else{
	alert("Marque alguna casilla!");
	} 
} 
return valido;

} 
//termino funcion verificar Checkboxs
		function cambiaGrupo(chk) {
			var padreDIV=chk;
			while( padreDIV.nodeType==1 && padreDIV.tagName.toUpperCase()!="DIV" )
				padreDIV=padreDIV.parentNode;
			//ahora que padreDIV es el DIV, cogeremos todos sus checkboxes
			var padreDIVinputs=padreDIV.getElementsByTagName("input");
			for(var i=0; i<padreDIVinputs.length; i++) {
				if( padreDIVinputs[i].getAttribute("type")=="checkbox" )
					padreDIVinputs[i].checked = chk.checked;
			}
		}
		
		    // Funcion Validar Rut
    function checkRut(rut_cliente) {

        var valor = rut_cliente.value.replace('.', '');

        valor = valor.replace('-', '');

        cuerpo = valor.slice(0, -1);
        dv = valor.slice(-1).toUpperCase();

        rut_cliente.value = cuerpo + '-' + dv

        if (cuerpo.length < 7) {
            rut_cliente.setCustomValidity("RUT Incompleto");
            return false;
        }

        suma = 0;
        multiplo = 2;

        for (i = 1; i <= cuerpo.length; i++) {

            index = multiplo * valor.charAt(cuerpo.length - i);

            suma = suma + index;

            if (multiplo < 7) {
                multiplo = multiplo + 1;
            } else {
                multiplo = 2;
            }

        }

        dvEsperado = 11 - (suma % 11);

        dv = (dv == 'K') ? 10 : dv;
        dv = (dv == 0) ? 11 : dv;

        if (dvEsperado != dv) {
            rut_cliente.setCustomValidity("RUT Inválido");
            return false;
        }

        rut_cliente.setCustomValidity('');
    }
		
		function letrasYnumeros(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789.";
        especiales = "8-37-39-46";

        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }

    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz.";
        especiales = "8-37-39-46";

        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }

    /*function soloNumeros() {
        var e = e || window.event;
        if ((e.keyCode < 48) || (e.keyCode > 57)) {
            e.returnValue = false;
            e.preventDefault();
        }
    }*/

//Función SoloNumeros
    function soloNumeros(e) {
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla == 8) {
            return true;
        }

        // Patron de entrada, en este caso solo acepta numeros
        patron = /[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }
	</script>
  </head>
  

<body class="nav-md"  role="main">
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
            <br />

            <!-- sidebar menu -->
          	<?php
		  	include 'menu_sidebar.php';
			include 'menu_footer.php';
			?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		<?php
       include 'menu_top.php';
        ?>
		<!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              	<h3 style="text-align: center;" class="col-md-12 col-sm-12">
					<strong><?php echo $titulo;?></strong>
				</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

<form name="agendar_visita" onSubmit="return validar(this)" action="form_agendamiento_res.php" data-parsley-validate novalidate method="get">
	<div class="form-group">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h4 style="text-align: left;" class="col-md-12"><strong>Datos del proyecto</strong></h4>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-12 col-xs-12 ">
        	<input type="text" required oninput="checkRut(this)" class="form-control has-feedback-left" id="rut_cliente" placeholder="Rut Cliente" name="rut_cliente" value="<?php echo $cot_cliente_rut; ?>">
			<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
		</br>
		</div>			
		<div class="col-md-6 col-sm-12 col-xs-12">
			<input type="text" onKeyPress="return soloLetras(event)" required class="form-control has-feedback-left" id="nombre_cliente" placeholder="Nombre Cliente" name="nombre_cliente" value="<?php echo $cot_cliente_razon;?>">
			<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
			</br>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-12 col-xs-12">
        	<input type="text" onKeyPress="return letrasYnumeros(event)" required class="form-control has-feedback-left" id="nombre_proyecto" placeholder="Nombre Proyecto" name="nombre_proyecto" value="<?php echo $cot_proyecto;?>">
			<span class="fa fa-file-text-o form-control-feedback left" aria-hidden="true"></span>
			</br>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
        	<input type="text" required class="form-control has-feedback-left" id="localidad" placeholder="Localidad Proyecto" name="localidad" value="<?php echo $cot_direccion;?>">
			<span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
			</br>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-12 col-xs-12">
        	<input type="text" onKeyPress="return soloLetras(event)" required class="form-control has-feedback-left" id="contacto" placeholder="Contacto Cliente" name="contacto" value="<?php echo $cot_contacto;?>">
			<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
			</br>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
        	<input type="email" required class="form-control has-feedback-left" id="email" placeholder="Email" name="email" value="<?php echo $cot_email;?>">
			<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
			</br>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-sm-12 col-xs-12">
        	<input type="text" minlength="8" maxlength="12" onKeyPress="return soloNumeros(event)"  required class="form-control has-feedback-left" id="telefono" placeholder="Telefono" name="telefono" oninvalid="setCustomValidity('Minimo 8 y máximo 12 números')"
 oninput="setCustomValidity('')" value="<?php echo $cot_telefono;?>">
		<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
		</br>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
        	<select class="form-control" required="required" id="origen" name="origen">
				<option value="">-- Seleccione Origen --</option>
				<option value="1">Santiago</option>
				<option value="2">Valparaiso</option>
				<option value="3">Los Andes</option>
				<option value="4">San Antonio</option>
			</select>
			</br>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h4 style="text-align: left;" class="col-md-12 col-sm-12 col-xs-12"><strong>Tipo de Servicio</strong></h4>
		</div>
	</div>
	<div class="form-group" style="text-align: left;">
		<div class="col-md-12 col-xs-12 col-sm-12">
		<?php
		$sql1 = mysqli_query($link, "
		SELECT 
			id_tipo_ensayo as ID, nombre_tipo_ensayo as NOMBRE_TIPO
		FROM 
			tbl_tipo_ensayo
		") or die('Consulta fallida: '.mysql_error());;
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
								<table class="table table-striped jambo_table" >
									<thead>
									<tr class="headings">
										<th>
											<input type="checkbox" class="icheckbox_flat-green" onchange="cambiaGrupo(this)">
										</th>
										<th class="column-title"># </th>
										<th class="column-title">Cantidad </th>
										<th class="column-title">Nombre </th>						
									</tr>
									</thead>
									<tbody>

									<?php
									$sql2 = mysqli_query($link, "
									SELECT 
										e.id_ensayo as ID, t.nombre_tipo_ensayo as NOMBRE_TIPO, e.nombre_ensayo as NOMBRE_ENSAYO 
									FROM 
										tbl_ensayo e, tbl_tipo_ensayo t 
									WHERE e.id_tipo_ensayo = t.id_tipo_ensayo
									AND
									e.id_tipo_ensayo = '".$row1['ID']."'
									") or die('Consulta fallida: '.mysql_error());;
									$i = 0;
									$n = 1;									
									while($row2 = mysqli_fetch_assoc($sql2)){
										if($i != 0){
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
										<td><input type="number" step="1" min="0" id="cantidad_ensayo" name="cantidad_ensayo[]" value="0" style="max-width:50px;"></td>
										<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;" >
											<?php 
											  $nombre_serv = utf8_encode($row2['NOMBRE_ENSAYO']);
											  echo utf8_decode($nombre_serv);
											?>
										</td>

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
	<div class="form-group">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="ln_solid"></div>
			<label style="font-size: 14px;">Destino</label>
		</div>
	</div>
	<div class="form-group" style="text-align: left;">
		<div class="col-md-12 col-sm-12 col-xs-12">		        	
			<?php
			$sql3 = mysqli_query($link, "
				SELECT 
					id_destino as ID, nombre_destino as NOMBRE
				FROM 
					tbl_destino
				") or die('Consulta fallida: '.mysql_error());;
			$i = 1;
			while($row3 = mysqli_fetch_assoc($sql3)){
			?>													
				<div class="col-md-3 col-sm-6 col-xs-6">
    				<input type="radio" name="destino" id="hobby<?php echo $i;?>" value="<?php echo $row3['ID'];?>" class="iradio_flat-green" /> <?php echo $row3['NOMBRE'];?>
				</div>				
				<?php 
				$i++;
			}
			?>										
			
		</div>	
	</div>
	<div class="form-group col-md-12 col-sm-12 col-xs-12">
		<div class="ln_solid"></div>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<label style="font-size: 14px;">Laboratorista</label>				
		<?php 
		$query = "SELECT * FROM tbl_laboratorista WHERE id_laboratorista = '".$_GET['lab_id']."'";
		$sql4 = mysqli_query($link, $query) or die('Consulta fallida: '.mysql_error());;
		while($filas = mysqli_fetch_assoc($sql4)){ 
		?>
			<input type="text" required readonly class="form-control has-feedback-left" id="hora_fin_agenda" name="hora_fin_agenda" value="<?php echo $filas['nombre_laboratorista']?>">
			<input type="hidden" name="id_laboratorista" value="<?php echo $filas['id_laboratorista'];?>">
		<?php
		} 
		?>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<label style="font-size: 14px;">Fecha Agenda</label>
        	<input type="text" required readonly class="form-control has-feedback-left" id="fecha_agenda" name="fecha_agenda" value="<?php echo $_GET['fecha_'];?>">
		</div>
		<div class="col-md-3 col-sm-3 col-xs-6">
            <label style="font-size: 14px;">Desde</label>
			<input type="text" required readonly class="form-control has-feedback-left" id="hora_ini_agenda" name="hora_ini_agenda" value="<?php echo $_GET['desde_'];?>">
		</div>
		<div class="col-md-3 col-sm-3 col-xs-6">
            <label style="font-size: 14px;">Hasta</label>
            <input type="text" required readonly class="form-control has-feedback-left" id="hora_fin_agenda" name="hora_fin_agenda" value="<?php echo $_GET['hasta_'];?>">
		</div>
		
	</div>
	<div class="form-group col-md-12 col-sm-12 col-xs-12">
		<div class="ln_solid"></div>
		<h4 style="text-align: left;" class="col-md-12 col-sm-12 col-xs-12"><strong>Equipos</strong></h4>
		<br>

		<?php
		$query_ = mysqli_query($link, "SELECT * FROM tbl_tipo_equipo");
		while($filas = mysqli_fetch_assoc($query_)){
			$filas['id_tipo_equipo']; $filas['nombre_tipo_equipo'];	
		?>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<label style="font-size: 14px;"><?php echo $filas['nombre_tipo_equipo'];?></label>
			<select class="form-control" required="required" id="equipo[]" name="origen">
				<option value="">-- Seleccione --</option>
				<?php 
				$sql4 = mysqli_query($link, "
					SELECT id_equipo, nombre_equipo 
					FROM tbl_equipo 
					WHERE id_tipo_equipo ='".$filas['id_tipo_equipo']."' 
					AND id_estado_equipo = '1'
				") or die('Consulta fallida: '.mysql_error());;
				while($filas = mysqli_fetch_assoc($sql4))
				{
				?>
					<option value="<?php echo $filas['id_equipo'];?>"><?php echo $filas['nombre_equipo']?></option>
				<?php
				}
				?>
			</select>
			<br>
		</div>	
		
		<?php
		}
		?>
	</div>
	<div class="form-group">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="ln_solid"></div>
			<h4 style="text-align: left;" class="col-md-6"><strong>Observaciones</strong></h4>
			<textarea id="message" required="required" class="form-control" name="observaciones" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-validation-threshold="10"></textarea>
		</div>
	</div>
	<br>
	
	<div class="form-group" align="right">	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="ln_solid"></div>
			<button type="button" onClick="Javascript:location.href='calendario_operaciones.php';" class="btn btn-primary">Cancelar</button>
			<button id="send" type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm" >Agendar</button>
		</div><br><br>
	</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
			  </button>
			  <h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n de Agendamiento</h4>
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
	
	
	
	
	
	
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php
		include 'footer.php';
        ?>
        <!-- /footer content -->
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
