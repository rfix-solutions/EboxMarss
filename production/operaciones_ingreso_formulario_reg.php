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
	l.nombre_laboratorista AS LABORATORISTA,
	ag.fecha_agendamiento AS FECHA,
	ag.email_proyecto AS EMAIL,
	ag.contacto_proyecto AS CONTACTO,
	ag.direccion_proyecto AS DIRECCION,
	ag.telefono_proyecto AS TELEFONO
FROM
	TBL_AgendaVisita ag, TBL_Laboratorista l
WHERE
	ag.id_laboratorista = l.id_laboratorista AND
	ag.id_agendamiento_visita = '".$_GET['id']."'
";

$sql = mysqli_query($link, $query) or die('Consulta fallida: '.mysql_error());;

while($fila = mysqli_fetch_assoc($sql)){
	$ag_proyecto = $fila['PROYECTO'];
	$ag_rut = $fila['RUT'];
	$ag_cliente = $fila['CLIENTE'];
	$ag_laboratorista = $fila['LABORATORISTA'];
	$ag_fecha = $fila['FECHA'];
	$ag_email = $fila['EMAIL'];
	$ag_contacto = $fila['CONTACTO'];
	$ag_direccion = $fila['DIRECCION'];
	$ag_telefono = $fila['TELEFONO'];
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
		<!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
            <div class="clearfix"></div><br />
          <?php
		  		include 'menu_sidebar.php';
		  		?>
          <?php
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
							<a style="width:50px; text-align: center;" href="operaciones_ingreso_formulario.php" class="btn  btn-xs color bg-green	">
								Volver
							</a>
						</div>
					</div>
          <div class="clearfix"></div>
          <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">

<!-- CONTENIDO DE PAGINA -->
<form name="crear_cotizacion" onSubmit="return validar(this)" action="#" method="get">
	<div class="form-group">
			<h4 style="text-align: left;" class="col-md-12">
				<strong>Datos del proyecto</strong>
      </h4>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<label>Rut</label>
			<input type="text" readonly class="form-control " id="rut_cliente" value="<?php echo $ag_rut;?>"  name="rut_cliente">
			</br>
		</div>
		<div class="col-md-6">
			<label>Cliente</label>
			<input type="text" readonly class="form-control " id="nombre_cliente" value="<?php echo $ag_cliente;?>" name="nombre_cliente">
			</br>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<label>Obra</label>
			<input type="text" readonly class="form-control " id="nombre_proyecto" value="<?php echo $ag_proyecto;?>" name="nombre_proyecto">
			</br>
		</div>
		<div class="col-md-6">
			<label>Direción Obra</label>
			<input type="text" readonly class="form-control " id="localidad" value="<?php echo $ag_direccion;?>" name="localidad">
			</br>
		</div>
	</div>
 	<div class="form-group">
		<div class="col-md-6">
			<label>Contacto</label>
    	<input type="text" readonly class="form-control " id="contacto" value="<?php echo $ag_contacto;?>" name="contacto">
			</br>
		</div>
		<div class="col-md-6">
			<label>Email</label>
  		<input type="email" readonly class="form-control " id="email" value="<?php echo $ag_email;?>"  name="email">
			</br>
    </div>
  </div>
  <div class="form-group">
		<div class="col-md-6">
			<label>Tel&eacute;fono</label>
    	<input type="text" readonly class="form-control " id="telefono" value="<?php echo $ag_telefono;?>" name="telefono">
			</br>
		</div>
		<div class="col-md-6">
			<label>Laboratorista</label>
    	<input type="text" readonly class="form-control " id="laboratorista" value="<?php echo $ag_laboratorista;?>" name="laboratorista">
			</br>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md12">
			<h4 style="text-align: left;" class="col-md-12">
				<strong>Servicios</strong>
      </h4>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md12">
			<table class="table table-striped jambo_table">
				<thead>
				<tr class="headings">
					<th class="column-title"># </th>
					<th class="column-title">Nombre </th>
					<th class="column-title">Agendados</th>
					<th class="column-title">Ingresados</th>
					<th class="column-title">Folios</th>
					<th class="column-title">Formularios</th>
				</tr>
				</thead>
				<tbody>
					<?php
					$sql2 = mysqli_query($link, "
					SELECT
						nombre_tipo_ensayo AS NOMBRE_T_E, id_tipo_ensayo AS ID_T_E
					FROM
						TBL_EnsayoTipo
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
						$query_cantidad = "
						SELECT
						 	cantidad
						FROM
							TBL_AgendaVisitaDetalle
						WHERE
								id_agendamiento_visita = '".$_GET['id']."' AND
								id_tipo_ensayo = '".$row2['ID_T_E']."'
						";

						$QRY_Folio = "
						 	SELECT
						 		id_agendamiento_visita AS ID, numero_solicitud AS FOLIO, 'HM' AS FORM
						 	FROM
						 		TBL_FormHM
						 	WHERE
						 		id_agendamiento_visita = '".$_GET['id']."' AND
								id_tipo_ensayo = '".$row2['ID_T_E']."'

						 UNION

						 	SELECT
						 		id_agendamiento_visita AS ID, numero_solicitud AS FOLIO, 'SS' AS FORM
						 	FROM
						 		TBL_FormSS
						 	WHERE
						 		id_agendamiento_visita = '".$_GET['id']."' AND
								id_tipo_ensayo = '".$row2['ID_T_E']."'
						 ";

						 $query_cantidad_ingresados_ss = "
					 		SELECT COUNT(*) AS cantidad_ingresados FROM TBL_FormSS WHERE id_agendamiento_visita = '".$_GET['id']."' AND id_tipo_ensayo = '".$row2['ID_T_E']."'
					 		";

					 		$query_cantidad_ingresados_chm = "
					 		SELECT COUNT(*) AS cantidad_ingresados FROM TBL_FormHM WHERE id_agendamiento_visita = '".$_GET['id']."' AND id_tipo_ensayo = '".$row2['ID_T_E']."'
					 		";
						$SQL_Folio = mysqli_query($link, $QRY_Folio) or die("Error en SQL Qry Folio".mysql_error());;
						$sql_cantidad = mysqli_query($link, $query_cantidad) or die("Error en SQL de cantidad".mysql_error());;

						$sql_cantidad_ingresados_ss = mysqli_query($link, $query_cantidad_ingresados_ss) or die("Error en SQL de cantidad ingresados".mysql_error());;
						$sql_cantidad_ingresados_chm = mysqli_query($link, $query_cantidad_ingresados_chm) or die("Error en SQL de cantidad ingresados".mysql_error());;

						while($result1 = mysqli_fetch_assoc($sql_cantidad)){
							$cantidad_agendado = $result1['cantidad'];
						}
						while($result2 = mysqli_fetch_assoc($sql_cantidad_ingresados_ss)){
							$cantidad_ingresado_ss = $result2['cantidad_ingresados'];
						}

						while($result3 = mysqli_fetch_assoc($sql_cantidad_ingresados_chm)){
							$cantidad_ingresado_chm = $result3['cantidad_ingresados'];
						}

						$cantidad_ingresado = $cantidad_ingresado_ss + $cantidad_ingresado_chm;
					?>
								<tr class="<?php echo $class; ?>">
									<td><?php echo $row2['ID_T_E'];?></td>
									<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;" >
										<?php $nombre_serv = utf8_encode($row2['NOMBRE_T_E']); echo utf8_decode($nombre_serv); ?>
									</td>
									<td>
										<input type="number" style="width:50px;" name="cant_agendado" value="<?php echo $cantidad_agendado; ?>" readonly>
									</td>
									<td>
										<input type="number" style="width:50px;" name="cant_ingresado" value="<?php echo $cantidad_ingresado; ?>" readonly>
									</td>
									<td>
										<?php
											while ($Folio_Data = mysqli_fetch_assoc($SQL_Folio)) {
												switch ($Folio_Data['FORM']) {
													case 'HM':
														$Form = "operaciones_FormHMdet";
													break;
													case 'SS':
														$Form = "operaciones_FormSSdet";
													break;
													default:
														$Form = "#";
													break;
												}

												?>
												<a style="width:50px; text-align: center;" target="_blank" href="<?php echo $Form;?>.php?id=<?php echo $Folio_Data['ID'];?>&folio=<?php echo $Folio_Data['FOLIO']?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $Folio_Data['FORM'];?>">
													<?php echo $Folio_Data['FOLIO']?>
												</a>
												<?php
											}
										?>
									</td>
									<td>
										<a style="width:50px; text-align: center;" href="operaciones_FormSS.php?id=<?php echo $_GET['id']; ?>&te=<?php echo $row2['ID_T_E']?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Solicitud Servicio">
											SS
										</a>
										<?php
											if($row2['ID_T_E']==1){?>
											<a style="width:50px; text-align: center;" href="operaciones_FormHM.php?id=<?php echo $_GET['id']; ?>&te=<?php echo $row2['ID_T_E']?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hormigones y Morteros">
												HM
											</a>
											<?php
											}?>
										</td>
									</tr>
									<?php
									$n++;
									$cantidad_agendado = 0;
								}
				?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="ln_solid"></div>
</form>
<!-- CONTENIDO DE PAGINA -->

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    <?php
		include 'footer.php';
    ?>
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
		<! iCheck
    <script src="../vendors/iCheck/icheck.min.js"></script>
     Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
		<!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
		<!-- DataTables-->
		<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
		<!-- <script src="../vendors/pdfmake/build/pdfmake.min.js"></script> -->
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
  </body>
</html>
