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
		location.href="../../../login/index.php?url=<?php echo $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];?>";
	</script>
<?php
		exit;
}
include '../../_qry/db_connect_local.php';




$NumeroSolicitud = $_GET['id'];
$Tipo = $_GET['tipo'];
$Folio = $_GET['folio'];
if($Tipo == "HM" ){
		$QRY_HeaderInforme = "
		SELECT
				AC.empresa_encargada AS EMPRESA_SOLICITANTE,
		    AC.direccion_obra AS DIRECCION_OBRA,
		    AC.profesional_acargo AS NOMBRE_SOLICITANTE,
		    AC.nombre_obra AS NOMBRE_OBRA,
		    C.comuna_nombre AS COMUNA,
		    L.nombre_laboratorista AS LABORATORISTA,
		    HM.lugar_extraccion AS LUGAR_EXTRACCION,
				DATE_FORMAT(HM.fecha_muestra, '%d-%m-%Y') as FECHA_MUESTREO

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
	if($Tipo == "SS" ){
		$QRY_HeaderInforme = "
			SELECT
        SS.procedencia AS PROCEDENCIA,
				DATE_FORMAT(SS.fecha_solicitud, '%d-%m-%Y') as FECHA_LLEGADA,
        SS.inicio_servicio AS HORA_MUESTREO,
        AC.empresa_encargada AS EMPRESA_SOLICITANTE,
				AC.direccion_obra AS DIRECCION_OBRA,
				CL.direccion_cliente AS DIRECCION_CLIENTE,
				AC.profesional_acargo AS NOMBRE_SOLICITANTE,
				AC.nombre_obra AS NOMBRE_OBRA,
        L.nombre_laboratorista AS LABORATORISTA,
				COM.comuna_nombre AS CIUDAD
			FROM
				TBL_FormSS SS, TBL_FormAC AC, TBL_AgendaVisita AV, TBL_Laboratorista L, TBL_Comuna C, TBL_Cotizacion CO, TBL_Cliente CL, TBL_Comuna COM
			WHERE
				SS.numero_solicitud = '".$NumeroSolicitud."' AND
        SS.realizado_por = L.id_laboratorista AND
        SS.id_agendamiento_visita = AV.id_agendamiento_visita AND
        AV.id_form_aceptacion = AC.id_form_aceptacion AND
				AC.id_cotizacion = CO.id_cotizacion AND
				CO.id_cliente = CL.id_cliente AND
				AC.comuna_obra = COM.comuna_id
			";
	}
	else {
		echo "ERROR EN SQL";
	}
}
$SQL_HeaderInforme = mysqli_query($link, $QRY_HeaderInforme) or die ("Error en SQL Header".mysqli_error());;

while ($Dat_HeaderInforme = mysqli_fetch_assoc($SQL_HeaderInforme)) {
	$EmpresaSolicitante = $Dat_HeaderInforme['EMPRESA_SOLICITANTE'];
	$DireccionObra = $Dat_HeaderInforme['DIRECCION_OBRA'];
	$DireccionCliente = $Dat_HeaderInforme['DIRECCION_CLIENTE'];
	$NombreSolicitante = $Dat_HeaderInforme['NOMBRE_SOLICITANTE'];
	$Obra = $Dat_HeaderInforme['NOMBRE_OBRA'];
	$Comuna = $Dat_HeaderInforme['COMUNA'];
	$Laboratorista = $Dat_HeaderInforme['LABORATORISTA'];
	$LugarExtraccion = $Dat_HeaderInforme['LUGAR_EXTRACCION'];
	$FechaMuestreo = $Dat_HeaderInforme['FECHA_MUESTREO'];
	$Procedencia  = $Dat_HeaderInforme['PROCEDENCIA'];
	$FechaLlegada = $Dat_HeaderInforme['FECHA_LLEGADA'];
	$HoraMuestreo = $Dat_HeaderInforme['HORA_MUESTREO'];
	$Ciudad = $Dat_HeaderInforme['CIUDAD'];
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
    <link href="../../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
    <link href="../../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../../build/css/custom.min.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
    <link href="../../../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../../../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
			<img src="../../images/banner-informe-ensayo-oficial.jpg" style="width:100%; text-align: center;">
			<div id="pagina" class="col-sm-12 col-md-12 col-xs-12">
					<div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:5px;">
						<img src="../../images/logo_inn-424x100.png" style="height: 35px; text-align:left;">
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
		            <td colspan="4"><?php echo strtoupper($EmpresaSolicitante);?></td>
							</tr>
		          <tr>
		          	<th scope="row">Direccion Cliente</th>
		            <td  style="width:30%"><?php echo strtoupper($DireccionCliente); ?></td>
		            <th scope="row" style="width:20%">Atencion Sr.</th>
		            <td><?php echo strtoupper($NombreSolicitante); ?></td>
							</tr>
							<tr>
		          	<th scope="row">Obra</th>
		            <td><?php echo strtoupper($Obra);?></td>
		            <th scope="row">Ciudad</th>
		            <td><?php echo strtoupper($Ciudad);?></td>
							</tr>
							<tr>
		          	<th scope="row">Tamaño Muestra</th>
		            <td><input type="text" name="TamanoMuestra" style="width:100%"></td>
		            <th scope="row">Correlativo N°</th>
		            <td><input type="text" name="CorrelativoN" value="" readonly style="width:100%"></td>
							</tr>
							<tr>
		           	<th scope="row">Tipo fuente de agua</th>
		            <td><input type="text" name="TipoFuenteAgua" style="width:100%"></td>
		            <th scope="row">N° Solicitud</th>
								<td><a target="_blank" href="../../operaciones_FormSSdet.php?id=<?php echo $_GET['ida']?>&folio=<?php echo $NumeroSolicitud;?>"><?php echo $NumeroSolicitud;?></a></td>

		          </tr>
							<tr>
								<th scope="row">Procedencia</th>
								<td><input type="text" name="Procedencia" value="<?php echo $Procedencia?>" style="width:100%"></td>

		            <th scope="row">Muestra tomada por</th>
		            <td><?php echo $Laboratorista?></td>
							</tr>
							<tr>
								<th scope="row">Fecha de llegada</th>
								<td><input type="date" name="FechaLlegada" value="" style="width:100%"></td>
		            <th scope="row">Fecha de Muestreo</th>
		            <td><?php echo $FechaLlegada?></td>
							</tr>
							<tr>
		          	<th scope="row">Ensayo Realizado en</th>
								<td><input type="text" name="EnsayoRealizadoEn" value="LABORATORIO CENTRAL - PLACILLA" style="width:100%"></td>
		            <th scope="row">Hora de muestreo</th>
		            <td><?php echo $HoraMuestreo;?></td>
							</tr>
						</tbody>
					</table>
				</div>


				<div class="x_content">

					<div class="col-md-6 col-sm-6 col-xs-12">
					  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
					    <thead style="background: #EDEDED;">
					      <tr>
					        <th colspan="2">DETERMINACIÓN DE TEMPERATURA</br> EN TERRENO</th>
					        <th>No acreditado</th>
					      </tr>
					    </thead>
					    <tbody>
								<?php
								$query_a = "
								SELECT
									E.id_ensayo_item AS IDITEM,
									E.nombre_ensayo_item AS NOMBREITEM,
									E.unidad_medida_item AS UMITEM,
									D.EnsayoDetalleItem_ValorEnsayoItem AS VALORITEM
								FROM
									TBL_EnsayoItem E, TBL_EnsayoDetalleItem D
								WHERE
									E. id_ensayo ='87' AND D.EnsayoDetalleItem_IdEnsayoItem = E.id_ensayo_item";

					      $sql_a = mysqli_query($link, $query_a);
								$i=0;
					      while ($item_a = mysqli_fetch_assoc($sql_a)) {
									$i++;?>
					        <tr>
					          <td><?php echo $item_a['NOMBREITEM'];?></td>
					          <td><input type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="<?php echo $item_a['VALORITEM']?>"></td>
					          <td><?php echo $item_a['UMITEM']?></td>
					        </tr>
					      <?php
					      }

								if($i==0){
									$query_b = "
									SELECT
										E.id_ensayo_item AS IDITEM,
										E.nombre_ensayo_item AS NOMBREITEM,
										E.unidad_medida_item AS UMITEM
									FROM
										TBL_EnsayoItem E
									WHERE
										E. id_ensayo ='87'";

						      $sql_b = mysqli_query($link, $query_b);
									$i=0;
						      while ($item_a = mysqli_fetch_assoc($sql_b)) {
										$i++;?>
						        <tr>
						          <td><?php echo $item_a['NOMBREITEM'];?></td>
						          <td><input style="width:100px" type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="----"></td>
						          <td><?php echo $item_a['UMITEM']?></td>
						        </tr>
						      <?php
						      }
									?>
									<tr>
						        <td >Fecha Ensayo</td>
						        <td colspan="2"><input style="width:100px" type="text" name="fecha_ensayo_87" id="fecha_ensayo_87"  value="-------"></td>
						      </tr>
									<?php
								}
								else{?>
									<tr>
									 <td >Fecha Ensayo</td>
									 <td colspan="2"><input style="width:100px" type="date" name="fecha_ensayo_87" id="fecha_ensayo_87"></td>
								 </tr>
								<?php
								}
					      ?>
					    </tbody>
					  </table>

					  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
					    <thead style="background: #EDEDED;">
					      <tr>
					        <th colspan="2">DETERMINACIÓN DE MATERIA ORGANICA</th>
					        <th >NCh 1498 Of 2012	</th>
					      </tr>
					    </thead>
					    <tbody>
					      <?php
					      //DETERMINACIÓN DE MATERIA ORGANICA
								$query_a = "
								SELECT
									E.id_ensayo_item AS IDITEM,
									E.nombre_ensayo_item AS NOMBREITEM,
									E.unidad_medida_item AS UMITEM,
									D.EnsayoDetalleItem_ValorEnsayoItem AS VALORITEM
								FROM
									TBL_EnsayoItem E, TBL_EnsayoDetalleItem D
								WHERE
									E. id_ensayo ='31' AND D.EnsayoDetalleItem_IdEnsayoItem = E.id_ensayo_item";

					      $sql_a = mysqli_query($link, $query_a);
								$i=0;
					      while ($item_a = mysqli_fetch_assoc($sql_a)) {
									$i++;?>
					        <tr>
					          <td><?php echo $item_a['NOMBREITEM'];?></td>
					          <td><input type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="<?php echo $item_a['VALORITEM']?>"></td>
					          <td><?php echo $item_a['UMITEM']?></td>
					        </tr>
					      <?php
					      }

								if($i==0){
									$query_b = "
									SELECT
										E.id_ensayo_item AS IDITEM,
										E.nombre_ensayo_item AS NOMBREITEM,
										E.unidad_medida_item AS UMITEM
									FROM
										TBL_EnsayoItem E
									WHERE
										E. id_ensayo ='31'";

						      $sql_b = mysqli_query($link, $query_b);
									$i=0;
						      while ($item_a = mysqli_fetch_assoc($sql_b)) {
										$i++;?>
						        <tr>
						          <td><?php echo $item_a['NOMBREITEM'];?></td>
						          <td><input style="width:100px" type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="----"></td>
						          <td><?php echo $item_a['UMITEM']?></td>
						        </tr>
						      <?php
						      }
									?>
									<tr>
						        <td >Fecha Ensayo</td>
						        <td colspan="2"><input style="width:100px" type="text" name="fecha_ensayo_31" id="fecha_ensayo_31"  value="-------"></td>
						      </tr>
									<?php
								}
								else{?>
									<tr>
									 <td >Fecha Ensayo</td>
									 <td colspan="2"><input style="width:100px" type="date" name="fecha_ensayo_31" id="fecha_ensayo_31"></td>
								 </tr>
								<?php
								}
					      ?>

					    </tbody>
					  </table>


					  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
					    <thead style="background: #EDEDED;">
					      <tr>
					        <th colspan="2">DETERMINACIÓN DE PH</th>
					        <th >NCh 413 Of 1963</th>
					      </tr>
					    </thead>
					    <tbody>
								<?php
					      //DETERMINACIÓN DE MATERIA ORGANICA
								$query_a = "
								SELECT
									E.id_ensayo_item AS IDITEM,
									E.nombre_ensayo_item AS NOMBREITEM,
									E.unidad_medida_item AS UMITEM,
									D.EnsayoDetalleItem_ValorEnsayoItem AS VALORITEM
								FROM
									TBL_EnsayoItem E, TBL_EnsayoDetalleItem D
								WHERE
									E. id_ensayo ='26' AND D.EnsayoDetalleItem_IdEnsayoItem = E.id_ensayo_item";

					      $sql_a = mysqli_query($link, $query_a);
								$i=0;
					      while ($item_a = mysqli_fetch_assoc($sql_a)) {
									$i++;?>
					        <tr>
					          <td><?php echo $item_a['NOMBREITEM'];?></td>
					          <td><input type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="<?php echo $item_a['VALORITEM']?>"></td>
					          <td><?php echo $item_a['UMITEM']?></td>
					        </tr>
					      <?php
					      }

								if($i==0){
									$query_b = "
									SELECT
										E.id_ensayo_item AS IDITEM,
										E.nombre_ensayo_item AS NOMBREITEM,
										E.unidad_medida_item AS UMITEM
									FROM
										TBL_EnsayoItem E
									WHERE
										E. id_ensayo ='26'";

						      $sql_b = mysqli_query($link, $query_b);
									$i=0;
						      while ($item_a = mysqli_fetch_assoc($sql_b)) {
										$i++;?>
						        <tr>
						          <td><?php echo $item_a['NOMBREITEM'];?></td>
						          <td><input style="width:100px" type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="----"></td>
						          <td><?php echo $item_a['UMITEM']?></td>
						        </tr>
						      <?php
						      }
									?>
									<tr>
						        <td >Fecha Ensayo</td>
						        <td colspan="2"><input style="width:100px" type="text" name="fecha_ensayo_26" id="fecha_ensayo_26"  value="-------"></td>
						      </tr>
									<?php
								}
								else{?>
									<tr>
 									 <td >Fecha Ensayo</td>
 									 <td colspan="2"><input style="width:100px" type="date" name="fecha_ensayo_26" id="fecha_ensayo_26"></td>
 								 </tr>
									<?php
								}
					      ?>
					  </table>

					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
					  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
					    <thead style="background: #EDEDED;">
					      <tr>
					        <th colspan="2">DETERMINACIÓN DE CLORUROS	</th>
					        <th >NCh 1444/1 Of 2010</br>NCh 1498 Of 2012</th>
					      </tr>
					    </thead>
					    <tbody>
								<?php
 							 //DETERMINACIÓN DE MATERIA ORGANICA
 							 $query_a = "
 							 SELECT
 								 E.id_ensayo_item AS IDITEM,
 								 E.nombre_ensayo_item AS NOMBREITEM,
 								 E.unidad_medida_item AS UMITEM,
 								 D.EnsayoDetalleItem_ValorEnsayoItem AS VALORITEM
 							 FROM
 								 TBL_EnsayoItem E, TBL_EnsayoDetalleItem D
 							 WHERE
 								 E. id_ensayo ='28' AND D.EnsayoDetalleItem_IdEnsayoItem = E.id_ensayo_item";

 							 $sql_a = mysqli_query($link, $query_a);
 							 $i=0;
 							 while ($item_a = mysqli_fetch_assoc($sql_a)) {
 								 $i++;?>
 								 <tr>
 									 <td><?php echo $item_a['NOMBREITEM'];?></td>
 									 <td><input type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="<?php echo $item_a['VALORITEM']?>"></td>
 									 <td><?php echo $item_a['UMITEM']?></td>
 								 </tr>
 							 <?php
 							 }

 							 if($i==0){
 								 $query_b = "
 								 SELECT
 									 E.id_ensayo_item AS IDITEM,
 									 E.nombre_ensayo_item AS NOMBREITEM,
 									 E.unidad_medida_item AS UMITEM
 								 FROM
 									 TBL_EnsayoItem E
 								 WHERE
 									 E. id_ensayo ='28'";

 								 $sql_b = mysqli_query($link, $query_b);
 								 $i=0;
 								 while ($item_a = mysqli_fetch_assoc($sql_b)) {
 									 $i++;?>
 									 <tr>
 										 <td><?php echo $item_a['NOMBREITEM'];?></td>
 										 <td><input style="width:100px" type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="----"></td>
 										 <td><?php echo $item_a['UMITEM']?></td>
 									 </tr>
 								 <?php
 								 }
 								 ?>
 								 <tr>
 									 <td >Fecha Ensayo</td>
 									 <td colspan="2"><input style="width:100px" type="text" name="fecha_ensayo_28" id="fecha_ensayo_28"  value="-------"></td>
 								 </tr>
 								 <?php
 							 }
							 else{?>
								 <tr>
									 <td >Fecha Ensayo</td>
									 <td colspan="2"><input style="width:100px" type="date" name="fecha_ensayo_28" id="fecha_ensayo_28"></td>
								 </tr>
							<?php
							 }
 							 ?>
					    </tbody>
					  </table>

					  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
					    <thead style="background: #EDEDED;">
					      <tr>
					        <th colspan="2">DETERMINACIÓN DE SULFATOS</th>
					        <th >NCh 1444/1 Of 2010</th>
					      </tr>
					    </thead>
					    <tbody>
								<?php
					      //DETERMINACIÓN DE MATERIA ORGANICA
								$query_a = "
								SELECT
									E.id_ensayo_item AS IDITEM,
									E.nombre_ensayo_item AS NOMBREITEM,
									E.unidad_medida_item AS UMITEM,
									D.EnsayoDetalleItem_ValorEnsayoItem AS VALORITEM
								FROM
									TBL_EnsayoItem E, TBL_EnsayoDetalleItem D
								WHERE
									E. id_ensayo ='29' AND D.EnsayoDetalleItem_IdEnsayoItem = E.id_ensayo_item";

					      $sql_a = mysqli_query($link, $query_a);
								$i=0;
					      while ($item_a = mysqli_fetch_assoc($sql_a)) {
									$i++;?>
					        <tr>
					          <td><?php echo $item_a['NOMBREITEM'];?></td>
					          <td><input type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="<?php echo $item_a['VALORITEM']?>"></td>
					          <td><?php echo $item_a['UMITEM']?></td>
					        </tr>
					      <?php
					      }

								if($i==0){
									$query_b = "
									SELECT
										E.id_ensayo_item AS IDITEM,
										E.nombre_ensayo_item AS NOMBREITEM,
										E.unidad_medida_item AS UMITEM
									FROM
										TBL_EnsayoItem E
									WHERE
										E. id_ensayo ='29'";

						      $sql_b = mysqli_query($link, $query_b);
									$i=0;
						      while ($item_a = mysqli_fetch_assoc($sql_b)) {
										$i++;?>
						        <tr>
						          <td><?php echo $item_a['NOMBREITEM'];?></td>
						          <td><input style="width:100px" type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="----"></td>
						          <td><?php echo $item_a['UMITEM']?></td>
						        </tr>
						      <?php
						      }
									?>
									<tr>
						        <td >Fecha Ensayo</td>
						        <td colspan="2"><input style="width:100px" type="text" name="fecha_ensayo_29" id="fecha_ensayo_29"  value="-------"></td>
						      </tr>
									<?php
								}
								else{?>
									<tr>
						        <td >Fecha Ensayo</td>
						        <td colspan="2"><input style="width:100px" type="date" name="fecha_ensayo_29" id="fecha_ensayo_29"></td>
						      </tr>
									<?php
								}
					      ?>
					    </tbody>
					  </table>

					  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
					    <thead style="background: #EDEDED;">
					      <tr>
					        <th colspan="2">SOLIDOS EN SUSPENSIÓN Y  DISUELTOS</th>
					        <th >NCh 416 Of 1963</th>
					      </tr>
					    </thead>
					    <tbody>
								<?php
					      //DETERMINACIÓN DE MATERIA ORGANICA
								$query_a = "
								SELECT
									E.id_ensayo_item AS IDITEM,
									E.nombre_ensayo_item AS NOMBREITEM,
									E.unidad_medida_item AS UMITEM,
									D.EnsayoDetalleItem_ValorEnsayoItem AS VALORITEM
								FROM
									TBL_EnsayoItem E, TBL_EnsayoDetalleItem D
								WHERE
									E. id_ensayo ='30' AND D.EnsayoDetalleItem_IdEnsayoItem = E.id_ensayo_item";

					      $sql_a = mysqli_query($link, $query_a);
								$i=0;
					      while ($item_a = mysqli_fetch_assoc($sql_a)) {
									$i++;?>
					        <tr>
					          <td><?php echo $item_a['NOMBREITEM'];?></td>
					          <td><input type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="<?php echo $item_a['VALORITEM']?>"></td>
					          <td><?php echo $item_a['UMITEM']?></td>
					        </tr>
					      <?php
					      }

								if($i==0){
									$query_b = "
									SELECT
										E.id_ensayo_item AS IDITEM,
										E.nombre_ensayo_item AS NOMBREITEM,
										E.unidad_medida_item AS UMITEM
									FROM
										TBL_EnsayoItem E
									WHERE
										E. id_ensayo ='30'";

						      $sql_b = mysqli_query($link, $query_b);
									$i=0;
						      while ($item_a = mysqli_fetch_assoc($sql_b)) {
										$i++;?>
						        <tr>
						          <td><?php echo $item_a['NOMBREITEM'];?></td>
						          <td><input style="width:100px" type="text" name="<?php echo $item_a['IDITEM']?>" id="<?php echo $item_a['IDITEM']?>" value="----"></td>
						          <td><?php echo $item_a['UMITEM']?></td>
						        </tr>
						      <?php
						      }
									?>
									<tr>
						        <td >Fecha Ensayo</td>
						        <td colspan="2"><input style="width:100px" type="text" name="fecha_ensayo_31" id="fecha_ensayo_31"  value="-------"></td>
						      </tr>
									<?php
								}
								else{?>
									<tr>
						        <td >Fecha Ensayo</td>
						        <td colspan="2"><input style="width:100px" type="date" name="fecha_ensayo_31" id="fecha_ensayo_31"></td>
						      </tr>
								<?php
								}
					      ?>
					    </tbody>
					  </table>

					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">

					  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
					    <thead style="background: #EDEDED;">
					    <tr>
					      <th>OBSERVACIONES</th>
					    </tr>
					  </thead>
					    <tr>
					      <td><textarea class="form-control" name="observaciones"></textarea></td>
					    </tr>
					  </table>
					  <input type="hidden" id="NS" name="NS" value="">
					  <input type="hidden" id="TE" name="TE" value="1">
					</div>
				</div>

				<div class="x_content">

					<div style="text-align: center;" >
						<button type="button" style="width:100%;" class="btn btn-success btn-md" data-toggle="modal" data-target="#Aprobar_informe">Aprobar Informe</button>
					</div>


					<div class="modal fade bs-example-modal-sm" id="Aprobar_informe" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									<h4 class="modal-title" id="myModalLabel2">Confirmaci&oacute;n</h4>
								</div>
								<div class="modal-body">
									<p>¿Realmente desea aprobar el informe <?php echo $InformeFolio;?>? </br>Esta operación incluirá la firma del documento y no se puede revertir</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
									<button type="button" class="btn btn-success" onclick="aprobar()">Aprobar</button>
								</div>
							</div>
						</div>
					</div>
				<!-- //////////////////////////////-->
			</div>



			</div>
		</div>
	</div>
	  <!-- jQuery -->
    <script src="../../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../../../vendors/iCheck/icheck.min.js"></script>
	 <!-- bootstrap-daterangepicker -->
    <script src="../../../vendors/moment/min/moment.min.js"></script>
    <script src="../../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../../../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../../../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../../../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../../../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../../../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../../../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../../../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../../../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../../../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../../../vendors/starrr/dist/starrr.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../../build/js/custom.min.js"></script>
		<script>
 	 	function aprobar(){
 			alert('Aprobado');
 			location.href="../../laboratorio_informes.php?idi=<?php echo $InformeId;?>&foi=<?php echo $InformeFolio;?>";
 		}
 	 </script>
</body>
</html>
