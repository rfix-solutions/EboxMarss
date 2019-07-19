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


switch($_GET['opt']){
		case "1": //EDITAR AGENDAMIENTO
				$query =  "
					SELECT
						rut_empresa AS RUT,
						razon_social AS RAZON_SOCIAL,
						nombre_proyecto AS PROYECTO_NOMBRE,
						direccion_proyecto AS PROYECTO_DIRECCION,
						contacto_proyecto AS PROYECTO_CONTACTO,
						email_proyecto AS PROYECTO_EMAIL,
						telefono_proyecto AS PROYECTO_TELEFONO,
						id_destino AS DESTINO,
						id_laboratorista AS LABORATORISTA,
						fecha_agendamiento AS FECHA_AGENDAMIENTO,
						hora_ini_agendamiento AS HORA_INICIO,
						hora_fin_agendamiento AS HORA_FIN,
						observaciones AS OBS,
						fecha_operacion AS FECHA_OP,
						id_cotizacion AS COT_ID,
						id_form_aceptacion AS FORMACEPT_ID
					FROM
						TBL_AgendaVisita
					WHERE
						id_agendamiento_visita = '".$_GET['agenda_id']."'
				";
				$sql = mysqli_query($link, $query) or die('Consulta fallida: '.mysqli_error($link));;
				while($datos_formulario = mysqli_fetch_assoc($sql)){
					$ag_rut = $datos_formulario['RUT'];
					$ag_razon_social = $datos_formulario['RAZON_SOCIAL'];
					$ag_proyecto_nombre = $datos_formulario['PROYECTO_NOMBRE'];
					$ag_proyecto_direccion = $datos_formulario['PROYECTO_DIRECCION'];
					$ag_proyecto_email = $datos_formulario['PROYECTO_EMAIL'];
					$ag_proyecto_contacto = $datos_formulario['PROYECTO_CONTACTO'];
					$ag_proyecto_telefono = $datos_formulario['PROYECTO_TELEFONO'];
					$ag_destino = $datos_formulario['DESTINO'];
					$ag_laboratorista = $datos_formulario['LABORATORISTA'];
					$ag_fecha_agendamiento = $datos_formulario['FECHA_AGENDAMIENTO'];
					$ag_hora_ini = $datos_formulario['HORA_INICIO'];
					$ag_hora_fin = $datos_formulario['HORA_FIN'];
					$ag_obs = $datos_formulario['OBS'];
					$ag_fecha_operacion = $datos_formulario['FECHA_OP'];
					$ag_id_cotizacion = $datos_formulario['COT_ID'];
					$ag_id_form_aceptacion = $datos_formulario['FORMACEPT_ID'];
				}

				$readonly =  "";
				$anular = '<button type="button" data-toggle="modal" data-target="#modal_eliminar" class="btn btn-warning">Eliminar</button>';



				$opcion = '<input type="hidden" name="opcion" value="E">';
				$agenda = '<input type="hidden" name="id_agenda" value="'.$_GET['agenda_id'].'">';

		break;

		case '2': //PENDIENTE FORMULARIO
			$query = "
				SELECT
					co.id_cotizacion AS ID,
			    cl.rut_cliente AS RUT,
			    cl.razon_social AS RAZON_SOCIAL,
					co.nombre_proyecto AS PROYECTO_NOMBRE,
			    co.nombre_contacto AS PROYECTO_CONTACTO,
			    cl.direccion_cliente AS PROYECTO_DIRECCION,
			    co.email_contacto AS PROYECTO_EMAIL,
			    cl.telefono_cliente AS PROYECTO_TELEFONO
				FROM
					TBL_Cotizacion co, TBL_Cliente cl
				WHERE
					co.id_cliente = cl.id_cliente AND co.id_cotizacion = '".$_GET['id']."'
			";
			$sql = mysqli_query($link, $query) or die('Consulta fallida: '.mysqli_error($link));;
			while($datos_formulario = mysqli_fetch_assoc($sql)){
				$ag_rut = $datos_formulario['RUT'];
				$ag_razon_social = $datos_formulario['RAZON_SOCIAL'];
				$ag_proyecto_nombre = $datos_formulario['PROYECTO_NOMBRE'];
				$ag_proyecto_direccion = $datos_formulario['PROYECTO_DIRECCION'];
				$ag_proyecto_email = $datos_formulario['PROYECTO_EMAIL'];
				$ag_proyecto_contacto = $datos_formulario['PROYECTO_CONTACTO'];
				$ag_proyecto_telefono = $datos_formulario['PROYECTO_TELEFONO'];
				$ag_destino = $datos_formulario['DESTINO'];
				$ag_laboratorista = $_GET['laboratorista'];
				$ag_fecha_agendamiento = $datos_formulario['FECHA_AGENDAMIENTO'];
				$ag_id_cotizacion = $_GET['id'];
			}

			$readonly =  "readonly";
			//$anular = '<button type="button" onClick="#" class="btn btn-warning">Anular</button>';
			$opcion = '<input type="hidden" name="opcion" value="U">';
			$agenda = '<input type="hidden" name="id_agenda" value="'.$_GET['agenda_id'].'">';

		break;

		case '3': //CON FORMULARIO DE ACEPTACION
				$query = "
					SELECT
						F.empresa_solicitante,
						F.fecha_aceptacion,
						F.nombre_solicitante,
						F.email_solicitante,
						F.nombre_obra,
						F.codigo_obra,
						F.direccion_obra,
						F.comuna_obra,
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
						F.id_cotizacion
					FROM
						TBL_FormAC F, TBL_EntidadFiscal E, TBL_PeriodoFacturacion P, TBL_FormaPago FP
					WHERE
						F.id_form_aceptacion='".$_GET['id']."' AND
						F.id_entidad_fiscal = E.id_entidad_fiscal AND
						F.id_periodo_facturacion = P.id_periodo_facturacion AND
						F.id_forma_pago = FP.id_forma_pago
				";
				$sql = mysqli_query($link, $query) or die('Consulta fallida: '.mysqli_error($link));;
				while($datos_formulario = mysqli_fetch_assoc($sql)){
					$ag_empresa_solicitante = $datos_formulario['empresa_solicitante'];
					$ag_fecha_aceptacion = $datos_formulario['fecha_aceptacion'];
					$ag_nombre_solicitante = $datos_formulario['nombre_solicitante'];
					$ag_proyecto_email = $datos_formulario['email_solicitante'];
					$ag_proyecto_nombre = $datos_formulario['nombre_obra'];
					$ag_codigo_obra = $datos_formulario['codigo_obra'];
					$ag_comuna_obra = $datos_formulario['comuna_obra'];
					$ag_proyecto_direccion = $datos_formulario['direccion_obra'];
					$ag_proyecto_telefono = $datos_formulario['fono_obra'];
					$ag_encargado_terreno = $datos_formulario['encargado_terreno'];
					$ag_email_encargado = $datos_formulario['email_encargado'];
					$ag_telefono_encargado = $datos_formulario['telefono_encargado'];
					$ag_id_entidad_fiscal = $datos_formulario['entidad_fiscal'];
					$ag_empresa_encargada = $datos_formulario['empresa_encargada'];
					$ag_profesional_acargo = $datos_formulario['profesional_acargo'];
					$ag_razon_social = $datos_formulario['razon_social'];
					$ag_rut = $datos_formulario['rut_empresa_factura'];
					$ag_giro_empresa = $datos_formulario['giro_empresa'];
					$ag_direccion_factura = $datos_formulario['direccion_factura'];
					$ag_nombre_ciudad = $datos_formulario['nombre_ciudad'];
					$ag_id_periodo_facturacion = $datos_formulario['periodo_facturacion'];
					$ag_id_forma_pago = $datos_formulario['forma_pago'];
					$ag_telefono_facturacion = $datos_formulario['telefono_facturacion'];
					$ag_email_facturacion = $datos_formulario['email_facturacion'];
					$ag_proyecto_contacto = $datos_formulario['nombre_aceptante'];
					$ag_id_cotizacion = $datos_formulario['id_cotizacion'];
				}
				$titulo = "Proyecto:".$ag_proyecto_nombre;
				$readonly = "readonly";
				$opcion = '<input type="hidden" name="opcion" value="C">';
				$form_aceptacion = '<input type="hidden" name="form_id" value="'.$_GET['id'].'" >';
		break;

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
          <div class="">
            <div class="page-title">
              <div class="title_left">
              	<h3 style="text-align: left;" class="col-md-12 col-sm-12">
									<strong> <?php echo $titulo;?></strong>
								</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
<form name="agendar_visita" onSubmit="return validar(this)" action="operaciones_form_agendamiento_res.php" data-parsley-validate novalidate method="get">
	<input type="hidden" name="cot_id" value="<?php echo $ag_id_cotizacion;?>" >
	<?php echo $form_aceptacion;?>
	<div class="form-group">
		<div class="col-md-6 col-sm-12 col-xs-12 ">
			<label>Rut Solicitante</label>
    	<input type="text" required oninput="checkRut(this)" class="form-control" id="rut_cliente" placeholder="Rut Cliente" name="rut_cliente" maxlength="10" value="<?php echo $ag_rut; ?>" <?php echo $readonly;?>>
			</br>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<label>Empresa Solicitante</label>
			<input type="text" onKeyPress="return soloLetras(event)" required class="form-control" id="nombre_cliente" placeholder="Nombre Cliente" name="nombre_cliente" value="<?php echo $ag_empresa_solicitante;?>">
			</br>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<label>Proyecto</label>
  		<input type="text" onKeyPress="return letrasYnumeros(event)" required class="form-control" id="nombre_proyecto" placeholder="Nombre Proyecto" name="nombre_proyecto" value="<?php echo $ag_proyecto_nombre;?>">
			</br>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<label>Direcci&oacute;n Proyecto</label>
    	<input type="text" required class="form-control" id="localidad" placeholder="Localidad Proyecto" name="localidad" value="<?php echo $ag_proyecto_direccion;?>">
			</br>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<label>Encargado Terreno</label>
    	<input type="text" onKeyPress="return soloLetras(event)" required class="form-control" id="contacto" placeholder="Contacto Cliente" name="contacto" value="<?php echo $ag_encargado_terreno;?>">
			</br>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<label>Email de Encargado</label>
    	<input type="email" required class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $ag_email_encargado;?>">
			</br>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<label>Tel&eacute;fono Obra</label>
  		<input type="text" minlength="8" maxlength="12" onKeyPress="return soloNumeros(event)"  required class="form-control" id="telefono" placeholder="Telefono" name="telefono" oninvalid="setCustomValidity('Minimo 8 y máximo 12 números')"
 oninput="setCustomValidity('')" value="<?php echo $ag_proyecto_telefono;?>">
			</br>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<label>Tel&eacute;fono Encargado</label>
  		<input type="text" minlength="8" maxlength="12" onKeyPress="return soloNumeros(event)"  required class="form-control" id="telefono" placeholder="Telefono" name="telefono" oninvalid="setCustomValidity('Minimo 8 y máximo 12 números')"
 oninput="setCustomValidity('')" value="<?php echo $ag_telefono_encargado;?>">
			</br>
		</div>
	</div>

	<div class="form-group">
		<h4 style="text-align: left;" class="col-md-12 col-sm-12 col-xs-12"><strong>Tipo de Servicio</strong></h4>
		<div class="col-md-12 col-xs-12 col-sm-12">
			<table class="table table-striped jambo_table" >
				<thead>
					<tr class="headings">
						<th class="column-title"># </th>
						<th class="column-title">Cantidad </th>
						<th class="column-title">Nombre </th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql2 = mysqli_query($link, "
					SELECT
					nombre_tipo_ensayo AS NOMBRE_T_E, id_tipo_ensayo AS ID_T_E
					FROM
					TBL_EnsayoTipo
					") or die('Consulta fallida: '.mysqli_error($link));;
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
							<td><?php echo $row2['ID_T_E'];?></td>
							<td>
								<input type="number" style="width:50px;" name="tipo_ensayo_cantidad[]" value="0">
								<input type="hidden" name="tipo_ensayo_id[]" value="<?php echo $row2['ID_T_E'];?>">
							</td>
							<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;" >
								<?php
								$nombre_serv = utf8_encode($row2['NOMBRE_T_E']);
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

			<div class="ln_solid"></div>

			<div class="col-md-3 col-sm-3 col-xs-12">
				<label style="font-size: 14px;">Laboratorista</label>
				<?php
				switch($_GET['opt']){
					case '1':
					$query = "SELECT * FROM TBL_Laboratorista WHERE id_laboratorista!='15'";
					$sql4 = mysqli_query($link, $query) or die('Consulta fallida: '.mysqli_error($link));;
					?>
					<select class="form-control" required="required" id="equipo" name="id_laboratorista">
						<option value="">-- Seleccione --</option>
						<?php
						while($filas = mysqli_fetch_assoc($sql4))
						{
							?>
							<option value="<?php echo $filas['id_laboratorista'];?>"><?php echo $filas['nombre_laboratorista']?></option>
							<?php
						}
						?>
					</select>
					<?php
					break;
					case '2':
					//$query = "SELECT * FROM TBL_Laboratorista WHERE id_laboratorista!='15'";
					$query = "
					SELECT *
					FROM
					TBL_Laboratorista
					WHERE nombre_laboratorista = '".$_GET['laboratorista']."'
					";
					$sql4 = mysqli_query($link, $query) or die('Consulta fallida: '.mysqli_error($link));;
					while($filas = mysqli_fetch_assoc($sql4)){
						?>
						<input type="text" required readonly class="form-control " id="nombre_laboratorista" name="nombre_laboratorista" value="<?php echo $filas['nombre_laboratorista']?>">
						<input type="hidden" name="id_laboratorista" value="<?php echo $filas['id_laboratorista'];?>">
						<?php
					}
					break;
					case '3':
					$query = "SELECT * FROM TBL_Laboratorista WHERE id_laboratorista = '".$_GET['lab_id']."'";
					$sql4 = mysqli_query($link, $query) or die('Consulta fallida: '.mysqli_error($link));;
					while($filas = mysqli_fetch_assoc($sql4)){
						?>
						<input type="text" required readonly class="form-control " id="nombre_laboratorista" name="nombre_laboratorista" value="<?php echo $filas['nombre_laboratorista']?>">
						<input type="hidden" name="id_laboratorista" value="<?php echo $filas['id_laboratorista'];?>">
						<?php
					}
					break;
				}
				?>
			</div>

			<div class="col-md-2 col-sm-3 col-xs-12">
				<label style="font-size: 14px;">Fecha Agenda</label>
				<input type="text" required <?php echo $readonly; ?> class="form-control" id="fecha_agenda" name="fecha_agenda" value="<?php echo $_GET['fecha_'];?>">
			</div>

			<div class="col-md-1 col-sm-3 col-xs-6">
				<label style="font-size: 14px;">Desde</label>
				<input type="text" required <?php echo $readonly; ?> class="form-control" id="hora_ini_agenda" name="hora_ini_agenda" value="<?php echo $_GET['desde_'];?>">
			</div>

			<div class="col-md-1 col-sm-3 col-xs-6">
				<label style="font-size: 14px;">Hasta</label>
				<input type="text" required <?php echo $readonly; ?> class="form-control" id="hora_fin_agenda" name="hora_fin_agenda" value="<?php echo $_GET['hasta_'];?>">
			</div>

			<div class="col-md-5 col-sm-12 col-xs-12">
				<label style="font-size: 14px;">Destino</label>
				<select name="destino" class="form-control" required>
					<option value="">- Seleccione -</option>
					<?php
					$sql3 = mysqli_query($link, "
					SELECT
					id_destino as ID, nombre_destino as NOMBRE
					FROM
					TBL_Destino
					ORDER BY
					nombre_destino ASC
					") or die('Consulta fallida: '.mysqli_error($link));;
					$i = 1;
					while($row3 = mysqli_fetch_assoc($sql3)){
						?>
						<option value="<?php echo $row3['ID'];?>"><?php echo ucwords($row3['NOMBRE']);?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</div>

			<?php
			$query_ = mysqli_query($link, "SELECT * FROM TBL_EquipoTipo");
			while($filas = mysqli_fetch_assoc($query_)){
				$filas['id_tipo_equipo']; $filas['nombre_tipo_equipo'];
				$sql4 = mysqli_query($link, "
				SELECT id_equipo, nombre_equipo
				FROM TBL_Equipo
				WHERE id_tipo_equipo ='".$filas['id_tipo_equipo']."'
				AND id_estado_equipo = '1'
				") or die('Consulta fallida: '.mysqli_error($link));;
				while($filas = mysqli_fetch_assoc($sql4)){?>
					<input type="hidden" name="equipo[]" value="<?php echo $filas['id_equipo'];?>">
					<?php
				}
			}
			?>
			<div class="form-group">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="ln_solid"></div>
					<h4 style="text-align: left;" class="col-md-6"><strong>Observaciones</strong></h4>
					<textarea id="message" class="form-control" name="observaciones" data-parsley-trigger="keyup" data-parsley-validation-threshold="10"><?php echo $ag_obs;?></textarea>
				</div>
			</div>

			<div class="form-group" align="right">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="ln_solid"></div>
					<?php echo $anular; ?>
					<?php echo $opcion; ?>
					<?php echo $agenda; ?>
					<button type="button" onClick="Javascript:location.href='operaciones_calendario.php';" class="btn btn-danger">Cancelar</button>
					<button id="send" type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm" >Agendar</button>
				</div>
			</div>

		</div>
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
					<p>¿Esta seguro que desea continuar con el agendamiento?</p>
				</div>
				<div class="modal-footer">
			  	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			  	<button type="submit" class="btn btn-success">Aceptar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_eliminar">
		<div class="modal-dialog modal-sm" >
			<div class="modal-content">
				<div class="modal-header">
			  	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
			  	</button>
			  	<h4 class="modal-title" id="eliminar_agendamiento">Eliminar Agendamiento</h4>
				</div>
				<div class="modal-body">
					<p>¿Esta seguro que desea eliminar el agendamiento?</p>
				</div>
				<div class="modal-footer">
			  	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			  	<button type="button" onClick="location.href='operaciones_form_agendamiento_res.php?opcion=A&id_agenda=<?php echo $_GET['agenda_id'];?>&cod_id=<?php echo $ag_id_cotizacion;?>'" class="btn btn-success">Aceptar</button>
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
        <?php
				include 'footer.php';
        ?>
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
