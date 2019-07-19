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
		location.href="../../login/index.php?url=<?php echo $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];?>";
	</script>
<?php
		exit;
}
include '../_qry/db_connect_local.php';



$NumeroSolicitud = $_GET['id'];
$Tipo = $_GET['tipo'];
$Folio = $_GET['folio'];
if($Tipo = "HM" ){
		$QRY_HeaderInforme = "
		SELECT
				AC.empresa_solicitante AS EMPRESA_SOLICITANTE,
		    AC.direccion_obra AS DIRECCION_OBRA,
		    AC.nombre_solicitante AS NOMBRE_SOLICITANTE,
		    AC.nombre_obra AS NOMBRE_OBRA,
		    C.comuna_nombre AS COMUNA,
		    L.nombre_laboratorista AS LABORATORISTA,
		    HM.lugar_extraccion AS LUGAR_EXTRACCION,
				HM.fecha_muestra AS FECHA_MUESTREO
		FROM
			TBL_FormHM HM, TBL_FormAC AC, TBL_AgendaVisita AV, TBL_Laboratorista L, TBL_Comuna C
		WHERE
			HM.numero_solicitud = '".$NumeroSolicitud."' AND
		    HM.realizado_por = L.id_laboratorista AND
		    AC.nombre_ciudad = C.comuna_id AND
		    HM.id_agendamiento_visita = AV.id_agendamiento_visita AND
		    AV.id_form_aceptacion = AC.id_form_aceptacion
		";
}else {
	if($Tipo = "SS" ){
			$QRY_HeaderInforme = "SELECT * FROM TBL_FormSS WHERE numero_solicitud = '".$numero_solicitud."' ";
	}
	else {
		echo "ERROR EN SQL";
	}
}

$SQL_HeaderInforme = mysqli_query($link, $QRY_HeaderInforme) or die ("Error en SQL Header".mysqli_error());;
while ($Dat_HeaderInforme = mysqli_fetch_assoc($SQL_HeaderInforme)) {
	$EmpresaSolicitante = $Dat_HeaderInforme['EMPRESA_SOLICITANTE'];
	$DireccionObra = $Dat_HeaderInforme['DIRECCION_OBRA'];
	$NombreSolicitante = $Dat_HeaderInforme['NOMBRE_SOLICITANTE'];
	$Obra = $Dat_HeaderInforme['NOMBRE_OBRA'];
	$Comuna = $Dat_HeaderInforme['COMUNA'];
	$Laboratorista = $Dat_HeaderInforme['LABORATORISTA'];
	$LugarExtraccion = $Dat_HeaderInforme['LUGAR_EXTRACCION'];
	$FechaMuestreo = $Dat_HeaderInforme['FECHA_MUESTREO'];
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
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
    <link href="../../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<style>
			html,body{
				height:297mm;
				text-align: center;
				background-color: #9b9b9b;
				font-family: arial;
				color: black;
				font-size: 12px;
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
				color: #171695;
				background-color: #FFFFFF;
				width: 100%;
				text-decoration-style: double;
			}
			#footer_borde{
				background-color: #171695;
				height: 10px;
			}
			#logo{
				height: 70%
			}
			#servicios{
				align-content: center;
				font-size: 12px;
			}
			#firma{
				width: 100%; height:40px; text-align: center; padding: 2px; font-size: 14px;
			}
			#firma_imagenes{
				width: 100%; text-align: center;
			}
			#titulo{
				text-align:center;
				margin-top:5px;
				font-size: 16px;
				text-align:center;
				color: black;
				font-weight: bold;
				padding-top:10px;
				height:30px;
			}
			#observaciones{
				margin-top: 10px;
				text-align:center;
			}
			table{
				width: 100%; border-collapse: collapse;
			}
			table, th,td{
				border: 2px solid #EDEDED;
			}

		</style>
  </head>

<body class="nav-md" role="main">
	<div class="container body" id="formato_pag">
		<div class="main_container" id="ancho_pag">
			<div id="pagina" class="col-sm-12 col-md-12 col-xs-12">

					<img src="../images/banner-informes.jpg" style="width:108%; text-align: center; margin: -20px -20px 0px -35px;">

					<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
						<img src="../images/logo_inn-424x100.png" style="height: 35px; text-align:left;">
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12" id="titulo">
						Laboratorio de Obras Civiles <?php echo $Folio;?>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
						<!-- BLANK -->
					</div>
				<div class="x_content">
					<table>
		      	<tbody>
							<tr>
		          	<th scope="row" style="width:20%">Solicitante</th>
		            <td colspan="4"><?php echo $EmpresaSolicitante;?></td>
							</tr>
		          <tr>
		          	<th scope="row">Direccion Cliente</th>
		            <td  style="width:30%"><?php echo $DireccionObra?></td>
		            <th scope="row" style="width:20%">Atencion Sr.</th>
		            <td><?php echo $NombreSolicitante; ?></td>
							</tr>
							<tr>
		          	<th scope="row">Obra</th>
		            <td><?php echo $Obra?></td>
		            <th scope="row">Ciudad</th>
		            <td><?php echo $Comuna?></td>
							</tr>
							<tr>
		          	<th scope="row">Material</th>
		            <td></td>
		            <th scope="row">Correlativo N°</th>
		            <td></td>
							</tr>
							<tr>
		           	<th scope="row">Procedencia</th>
		            <td></td>
		            <th scope="row">N° Solicitud</th>
		            <td><?php echo $NumeroSolicitud?></td>
		          </tr>
							<tr>
								<th scope="row">Ubicaci&oacute;n</th>
		            <td></td>
		            <th scope="row">Fecha Muestreo</th>
		            <td><?php echo $FechaMuestreo?></td>
							</tr>
							<tr>
		          	<th scope="row">Ensayo Realizado en</th>
		            <td><?php echo $LugarExtraccion?></td>
		            <th scope="row">Muestra tomada por</th>
		            <td><?php echo $Laboratorista?></td>
							</tr>
						</tbody>
					</table>
				</div>


				<div class="x_content">
				  <div class="col-md-5 col-sm-6 col-xs-12" style="margin-top:10px;">
				    <div class="col-md-12 col-sm-12 col-xs-12">
				        <table id="tablas" class="table table-bordered" style="font-size: 10px;">
				          <thead style="background: #EDEDED;">
				            <tr>
				              <th>Granulometr&iacute;a</th>
				              <th>MC Vol 8 - 8.202.2</br>MC Vol 8 - 8.102.1	</th>
				            </tr>
				          </thead>
				          <tbody>
				            <tr>
				              <td style="width:60%" >Tamiz</td>
				              <td>% Acumulado que pasa</td>
				            </tr>

				          <?php
				          //GRANULOMETRIA
				          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='14'";
				          $sql_a = mysqli_query($link, $query_a);
				          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
				            <tr>
				              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
				              <td><input type="number" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
				            </tr>
				          <?php
				          }
				          ?>
				          <tr>
				            <td>FECHA DE ENSAYO</td>
				            <td><input type="date" name="fecha_ensayo_14" id="fecha_ensayo_14" value=""></td>
				          </tr>

				        </tbody>
				      </table>
				    </div>
				    <div class="col-md-12 col-sm-12 col-xs-12">
				      <table class="table table-bordered" style="font-size: 10px;">
				        <thead style="background: #EDEDED;">
				        <tr>
				          <th colspan="3" style="text-align:center;">LIMITES DE ATTERBERG NCh 1517/1 Of 79 - NCh 1517/2 Of 79	</th>
				        </tr>
				        </thead>
				        <tbody>
				          <?php
				          //LIMITE ATTERBERG
				          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='15'";
				          $sql_a = mysqli_query($link, $query_a);
				          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
				            <tr>
				              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
				              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
				            </tr>
				          <?php
				          }
				          ?>
				          <tr>
				            <td>FECHA DE ENSAYO</td>
				            <td><input type="date" name="fecha_ensayo_15" id="fecha_ensayo_15" value=""></td>
				          </tr>
				        </tbody>
				      </table>
				    </div>

				    <div class="col-md-12 col-sm-12 col-xs-12">
				      <table class="table table-bordered" style="font-size: 10px;">
				        <thead style="background: #EDEDED;">
				        <tr>
				          <th colspan="3" style="text-align:center;">CLASIFICACIÓN DE SUELOS (No acreditable)</th>
				        </tr>
				        </thead>
				        <tbody>
				          <?php
				          //CLASIFICACION USCS / AASHTO
				          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='16'";
				          $sql_a = mysqli_query($link, $query_a);
				          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
				            <tr>
				              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
				              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
				            </tr>
				          <?php
				          }
				          ?>
				          <tr>
				            <td>FECHA DE ENSAYO</td>
				            <td><input type="date" name="fecha_ensayo_16" id="fecha_ensayo_16" value=""></td>
				          </tr>
				        </tbody>
				      </table>
				    </div>

				    <div class="col-md-12 col-sm-12 col-xs-12">
				      <table class="table table-bordered" style="font-size: 10px;">
				        <thead style="background: #EDEDED;">
				        <tr>
				          <th colspan="3" style="text-align:center;">CUBICIDAD DE PARTÍCULAS MC Vol 8 - 8.202.6</th>
				        </tr>
				        </thead>
				        <tbody>
				          <?php
				          //CUBICIDAD DE PARTICULAS
				          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='20'";
				          $sql_a = mysqli_query($link, $query_a);
				          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
				            <tr>
				              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
				              <td><input type="number" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
				              <td><?php echo $item_a['unidad_medida_item']?></td>
				            </tr>
				          <?php
				          }
				          ?>
				          <tr>
				            <td>FECHA DE ENSAYO</td>
				            <td colspan="2"><input type="date" name="fecha_ensayo_20" id="fecha_ensayo_20" value=""></td>
				          </tr>
				        </tbody>
				      </table>
				    </div>



				  </div>
				<!-- SECCION 4 -->
				  <div class="col-md-7 col-sm-6 col-xs-12" style="margin-top:10px;">
				    <div class="col-md-12 col-sm-12 col-xs-12">
				      <table class="table table-bordered" style="font-size: 10px;">
				      <thead style="background: #EDEDED;">
				        <tr>
				          <th colspan="3" style="text-align:center;">RELACIÓN HUMEDAD/DENSIDAD PROCTOR MODIFICADO NCh 1534/2 Of 79	</th>
				        </tr>
				      </thead>
				      <tbody>
				        <?php
				        //PROCTOR MODIFICADO
				        $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='17'";
				        $sql_a = mysqli_query($link, $query_a);
				        while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
				          <tr>
				            <td><?php echo $item_a['nombre_ensayo_item'];?></td>
				            <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
				            <td><?php echo $item_a['unidad_medida_item']?></td>
				          </tr>
				        <?php
				        }
				        ?>
				        <tr>
				          <td>FECHA DE ENSAYO</td>
				          <td colspan="2"><input type="date" name="fecha_ensayo_17" id="fecha_ensayo_17" value=""></td>
				        </tr>
				      </tbody>
				      </table>
				    </div>

				    <div class="col-md-12 col-sm-12 col-xs-12">
				      <table class="table table-bordered" style="font-size: 10px;">
				      <thead style="background: #EDEDED;">
				        <tr>
				          <th colspan="3" style="text-align:center;">
				            DETERMINACIÓN DE LA RAZÓN DE SOPORTE C.B.R	NCh 1852 Of 81</br>
				            DETERMINACIÓN DE LAS HUMEDADES DE LA MUESTRA	NCh 1515 Of 79
				          </th>
				        </tr>
				        </thead>
				        <tbody>
				          <?php
				          //CBR y HUMEDAD
				          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='18'";
				          $sql_a = mysqli_query($link, $query_a);
				          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
				            <tr>
				              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
				              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
				              <td><?php echo $item_a['unidad_medida_item']?></td>
				            </tr>
				          <?php
				          }
				          ?>
				          <tr>
				            <td>FECHA DE ENSAYO</td>
				            <td colspan="2"><input type="date" name="fecha_ensayo_18" id="fecha_ensayo_18" value=""></td>
				          </tr>
				        </tbody>
				      </table>
				    </div>
				    <div class="col-md-12 col-sm-12 col-xs-12">
				      <table class="table table-bordered" style="font-size: 10px;">
				        <thead style="background: #EDEDED;">
				          <tr>
				            <th colspan="3" style="text-align:center;">DETERMINACIÓN DEL EQUIVALENTE DE ARENA	NCh 1325 Of 10</th>
				          </tr>
				        </thead>
				        <tbody>
				          <?php
				          //EQUIVALENTE DE ARENA
				          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='22'";
				          $sql_a = mysqli_query($link, $query_a);
				          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
				            <tr>
				              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
				              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
				              <td><?php echo $item_a['unidad_medida_item']?></td>
				            </tr>
				          <?php
				          }
				          ?>
				          <tr>
				            <td>FECHA DE ENSAYO</td>
				            <td colspan="2"><input type="date" name="fecha_ensayo_22" id="fecha_ensayo_2" value=""></td>
				          </tr>
				        </tbody>
				      </table>
				    </div>
				    <div class="col-md-12 col-sm-12 col-xs-12">
				      <table class="table table-bordered" style="font-size: 10px;">
				        <thead style="background: #EDEDED;">
				          <tr>
				            <th colspan="3" style="text-align:center;">DESGASTE POR MÉTODO DE LOS ÁNGELES	NCh 1369 Of 10</th>
				          </tr>
				        </thead>
				        <tbody>
				          <?php
				          //DESGASTE LOS ANGELES
				          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='19'";
				          $sql_a = mysqli_query($link, $query_a);
				          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
				            <tr>
				              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
				              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
				              <td><?php echo $item_a['unidad_medida_item']?></td>
				            </tr>
				          <?php
				          }
				          ?>
				          <tr>
				            <td>FECHA DE ENSAYO</td>
				            <td colspan="2"><input type="date" name="fecha_ensayo_19" id="fecha_ensayo_19" value=""></td>
				          </tr>
				        </tbody>
				      </table>
				    </div>

				    <div class="col-md-12 col-sm-12 col-xs-12">
				      <table class="table table-bordered" style="font-size: 10px;">
				        <thead style="background: #EDEDED;">
				        <tr>
				          <th colspan="3" style="text-align:center;">DENSIDAD DE PARTÍCULAS SOLIDAS TOTALES NCh 1532 Of 80</th>
				        </tr>
				        </thead>
				        <tbody>
				          <?php
				          //DENSIDAD DE PARTICULAS SOLIDAS
				          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='21'";
				          $sql_a = mysqli_query($link, $query_a);
				          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
				            <tr>
				              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
				              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
				              <td><?php echo $item_a['unidad_medida_item']?></td>
				            </tr>
				          <?php
				          }
				          ?>
				          <tr>
				            <td>FECHA DE ENSAYO</td>
				            <td colspan="2"><input type="date" name="fecha_ensayo_21" id="fecha_ensayo_21" value=""></td>
				          </tr>
				        </tbody>
				      </table>
				    </div>
				  </div>
				  <div class="col-sm-12 col-md-12 col-xs-12">
				    <table class="table table-bordered" style="font-size: 10px;">
				      <thead style="background: #EDEDED;">
				        <tr>
				          <th style="text-align:center;">Observaciones</th>
				        </tr>
				      </thead>
				      <tbody>
				        <tr>
				          <td style="text-align:left;"><textarea style="width:100%;" name="observaciones" id="observaciones"></textarea></td>
				        </tr>
				      </tbody>
				    </table>
				  </div>
				</div>




				<div class="x_content">
					<div id="firma_imagenes">
						<img src="../images/firma_avargas.png">
						<img src="../images/timbre-informe-marss.png">
					</div>
					<div id="firma">
						ALEJANDRO VARGAS CARRASCO</br>JEFE ÁREA HORMIGÓN
					</div>
					<div id="observaciones">
						EL PRESENTE INFORME DE ENSAYO NO DEBE SER REPRODUCIDO EXCEPTO EN SU TOTALIDAD SIN LA AUTORIZACIÓN DE MARSS LABORATORIOS</br>
						LOS RESULTADOS PRESENTADOS CORRESPONDEN SOLO A LA MUESTRA ENSAYADA Y NO A UN TOTAL DEL LOTE
					</div>
					<div id="footer_borde"></div>
					<div id="footer">
						Calle Décima Nº 493-494, Placilla, Valparaíso (32) 2138800 - Email: laboratorio@marsslab.cl - www.labmars.cl
					</div>
				</div>
			</div>
		</div>
	</div>
	  <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
	 <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../../vendors/starrr/dist/starrr.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
</body>
</html>
