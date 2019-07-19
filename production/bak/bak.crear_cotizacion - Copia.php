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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>.: EBOX PLATFORM - LOGIN :. </title>

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
	<script src="js/validarut.js"></script>
	<script type="text/javascript">
		function valida_rut(){
			return Rut(document.getElementById("rut_cliente").value);
		}
	</script>
  </head>

  <body class="nav-md footer_fixed" >
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

            <div class="clearfix"></div><br />

            <!-- sidebar menu -->
          <?php
		  include 'menu_sidebar.php';
		  ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php
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
                <h3>Crear Cotizaci&oacute;n</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row" >
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

<!-- CONTENIDO DE PAGINA -->
<form name="crear_cotizacion" action="crear_cotizacion_res.php" method="get">
			<div class="form-group">
				<div class="col-md12">
				<h4 style="text-align: left;" class="col-md12">
					<strong>Datos del proyecto</strong>
                </h4>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
                <script language="javascript">
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
</script>

                	<input type="text" required oninput="checkRut(this)"class="form-control has-feedback-left" id="rut_cliente" placeholder="Rut Cliente" name="rut_cliente">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</br>
				</div>			
				<div class="col-md-6">
<script type="text/javascript">
    //Funcion input Solo letras
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
                	<input type="text" onKeyPress="return soloLetras(event)" required class="form-control has-feedback-left" id="nombre_cliente" placeholder="Nombre Cliente" name="nombre_cliente">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</br>
                </div>
            </div>
						  
			<div class="form-group">
				<div class="col-md-6">
                	<input type="text" onKeyPress="return letrasYnumeros(event)" required class="form-control has-feedback-left" id="nombre_proyecto" placeholder="Nombre Proyecto" name="nombre_proyecto">
					<span class="fa fa-file-text-o form-control-feedback left" aria-hidden="true"></span>
					</br>
				</div>
			
				<div class="col-md-6">
                	<input type="text" required class="form-control has-feedback-left" id="localidad" placeholder="Localidad Proyecto" name="localidad">
					<span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
					</br>
                </div>
            </div>
			
			  
 			<div class="form-group">
				<div class="col-md-6">
                	<input type="text" onKeyPress="return soloLetras(event)" required class="form-control has-feedback-left" id="contacto" placeholder="Contacto Cliente" name="contacto">
					<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
					</br>
				</div>
			
				<div class="col-md-6">
                	<input type="email" required class="form-control has-feedback-left" id="email" placeholder="Email" name="email">
					<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
					</br>
                </div>
            </div>

            <div class="form-group">
				<div class="col-md-6">
                	<input type="text" minlength="8" maxlength="12" onKeyPress="return soloNumeros(event)"  required class="form-control has-feedback-left" id="telefono" placeholder="Telefono" name="telefono" oninvalid="setCustomValidity('Minimo 8 y máximo 12 números')"
                oninput="setCustomValidity('')">
					<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
					</br>
				</div>
			
				<div class="col-md-6">
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
			<div class="col-md12">
				<h4 style="text-align: left;" class="col-md12">
					<strong>Tipo de Servicio</strong>
                </h4>
				</div>
	  		</div>
	  		<div class="form-group">

				<div class="col-md12">
<?php
$sql1 = mysql_query("
SELECT 
	id_tipo_ensayo as ID, nombre_tipo_ensayo as NOMBRE_TIPO
FROM 
	tbl_tipo_ensayo
") or die('Consulta fallida: '.mysql_error());;
while($row1 = mysql_fetch_assoc($sql1)){
	if($row1['ID']==1){	$href = "One"; }
	if($row1['ID']==2){	$href = "Two"; }
	if($row1['ID']==3){	$href = "Three"; }
	if($row1['ID']==4){	$href = "Four"; }
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
                	
					<table class="table table-striped jambo_table bulk_action">
					<thead>
					<tr class="headings">
<?php /* ?>						
					<script type="text/javascript">
    function marcar(source) {
        checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
        for (i = 0; i < checkboxes.length; i++) //recoremos todos los controles
        {
            if (checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
            {
                checkboxes[i].checked = source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
            }
        }
    }
</script>

        				<th><input type="checkbox" onClick="marcar(this)" id="check-all" class="flat"></th>
<?php */ ?>				
 
						<th>
							<input type="checkbox" id="check-all" class="flat">
                        </th>
						<th class="column-title"># </th>
						<th class="column-title">Nombre </th>
						<th class="column-title">Precio </th>
						<th class="bulk-actions" colspan="7">
							<a class="antoo" style="color:#fff; font-weight:500;">Selecci&oacute;n ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
						</th>
					</tr>
					</thead>
					<tbody>

	<?php
	$sql2 = mysql_query("
	SELECT 
		e.id_ensayo as ID, t.nombre_tipo_ensayo as NOMBRE_TIPO, e.nombre_ensayo as NOMBRE_ENSAYO, e.precio as PRECIO 
	FROM 
		tbl_ensayo e, tbl_tipo_ensayo t 
	WHERE e.id_tipo_ensayo = t.id_tipo_ensayo
	AND
	e.id_tipo_ensayo = '".$row1['ID']."'
	") or die('Consulta fallida: '.mysql_error());;
	$i = 0;
	$n = 1;									
	while($row2 = mysql_fetch_assoc($sql2)){
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
								<input type="checkbox" value="<?php echo $row2['ID'];?>" class="flat" id="ensayos" name="ensayos[]">
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
		
	
		<div class="form-group">
			<div class="col-md12">
				<h4 style="text-align: left;" class="col-md12">
					<strong>Destino</strong>
               	</h4>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md12">
					        	
<?php
$sql3 = mysql_query("
	SELECT 
		id_destino as ID, nombre_destino as NOMBRE, precio as PRECIO
	FROM 
		tbl_destino
	") or die('Consulta fallida: '.mysql_error());;
$i = 1;
while($row3 = mysql_fetch_assoc($sql3)){
?>													
				<div class="col-md-3">
    				<input type="checkbox" name="destinos[]" id="hobby<?php echo $i;?>" value="<?php echo $row3['ID'];?>" class="flat" /> <?php echo $row3['NOMBRE'];?>
				</div>				
<?php 
	$i++;
}
?>										
				</br></br>
            </div>	
	  	</div>
<br>
<br>
		<div class="form-group">
			<div class="col-md12">
				<h4 style="text-align: left;" class="col-md12">
					<strong>Tipo Descuento</strong>
               	</h4>
			</div>
		</div>
		<div class="form-group">
			
            <div class="col-md-3 col-sm-4 col-xs-12">
				<input type="radio" class="flat" name="tipo_descuento" onclick="document.getElementById('valor_descuento').disabled=false;" onChange="changeStatus();" id="descuento_g" value="g" /> 
				General
				<br>
				<input type="radio" class="flat" name="tipo_descuento" onclick="document.getElementById('valor_descuento').disabled=false;" onChange="changeStatus();" id="descuento_e" value="e" />
				Ensayo  
                <br>
                <input type="radio" class="flat" name="tipo_descuento" onclick="document.getElementById('valor_descuento').disabled=true;" onChange="changeStatus();" id="descuento_s" value="s" />
				Sin Descuento  
			</div>
			<div class="col-md-3 col-sm-4 col-xs-12">
				<input type="number" min="0" max="100" step="0.01" class="form-control has-feedback-left" id="valor_descuento" name="valor_descuento" style="width: 110px;"
				<span class="fa form-control-feedback left" aria-hidden="true">%</span>
			</div>
			<label style="text-align: left" class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">
				Autorizado por:
			</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="checkbox" name="autoriza[]" id="autoriza1" value="1" class="flat" /> Finanzas
				| 
				<input type="checkbox" name="autoriza[]" id="autoriza2" value="2" class="flat" /> Laboratorio
                |
				<input type="checkbox" name="autoriza[]" id="autoriza3" value="3" class="flat" /> Gerente
                <br />		 
			</div>
			
			
			</br></br>
        </div>
	
		<div class="ln_solid"></div>
		<div class="form-group" align="right">
			<div class="col-md-12">
				<button type="button" onClick="Javascript:history.back();" class="btn btn-primary">Cancelar</button>
				<button id="send" type="submit" class="btn btn-success">Aceptar</button>
			</div><br><br>
		</div>
          
</form>					  
					  
					  
				</div>	  
<!-- CONTENIDO DE PAGINA -->
				  
					  
                  </div>
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
    <!-- jQuery Smart Wizard -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
	<!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	<!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
    <script type="application/javascript">
					function changeStatus()
					{
						console.log(document.getElementsByName("tipo_descuento")[2]);	
					};
	</script>
  </body>
</html>
