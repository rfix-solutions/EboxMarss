<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} 
else 
{?>
	<script type="text/javascript">
		alert("Esta pagina es solo para usuarios registrados.")
		history.back();
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

	<title>.: EBOX PLATFORM :. </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- Nuevo Calendario -->
	<link href="../calendario/scheduler.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
    <link href="../vendors/fullcalendar2/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendors/fullcalendar2/dist/fullcalendar.print.css" rel="stylesheet" media="print">

	<!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	  <script type="text/javascript">
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



</script>
	  <style type="text/css">
	  #calendar {
    max-width: 900px;
    margin: 50px auto;
  }

	  </style>
	  
	
  </head>

  <body class="nav-md footer_fixed">
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

            <!-- menu profile quick info -->
			<?php
			/*
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->
			*/
			?>
            <br />

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
                <h3>Calendario Operaciones</h3>
              </div>
            </div>
			  

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
					<a style="width:150px; text-align: center;" href="Javascript:history.back()" class="btn  btn-xs color bg-green	">Volver</a> 
					  <div class="col-md-12 col-sm-12 col-xs-12">
						  
						
						<div class="col-md-12 col-sm-12 col-xs-12" id='calendar'></div>
						  
					  	

				      </div>
				  
<!-- /////////////////////////// -->
<!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" >

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Nueva Visita</h4>
          </div>
          <div class="modal-body">
            
			  
			  
			  
<!-- ////////////////77CONTENIDO POPUP AGREGAR -->			  
			<div class="col-md12">
				<h3 style="text-align: center;" class="">
					Cotizaciones Aceptadas
                </h3>
			</div>
			  
			  <div class="col-md12">

				<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true"><!-- Inicio Acordeon -->
					<div class="panel">
						<a class="panel-heading" role="tab" id="heading_X" data-toggle="collapse" data-parent="#accordion" href="#collapse_X" aria-expanded="false" aria-controls="collapse_X">
							<h4 class="panel-title">Detalle</h4>
						</a>
						<div id="collapse_X" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="heading_X">
							<div class="panel-body">
								<div class="table-responsive">				  
								  <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 11px;">
										<thead>
										<tr>
											<th>#</th>
											<th>*</th>
											<th>Cotización</th>
											<th>Cliente</th>
											<th>Proyecto</th>
											<th>Fecha Aceptaci&oacute;n</th>
										</tr>
										</thead>
										<tbody>

				<?php
				$sql = mysql_query("
				SELECT 
					c.id_cotizacion AS ID,
					DATE_FORMAT(DATE(c.fecha_creacion), '%d-%m-%Y') as FECHA,
					c.numero_cotizacion as COTIZACION,
					c.nombre_proyecto as PROYECTO,
					u.sigla_usuario as RESPONSABLE,
					s.codigo_sucursal as SUCURSAL,
					cl.razon_social as CLIENTE,
					e.nombre_estado_cotizacion as ESTADO

				FROM 
					tbl_cotizacion c, tbl_usuarios u, tbl_cliente cl, tbl_sucursal s, tbl_estado_cotizacion e
				WHERE
					c.id_cliente = cl.id_cliente AND
					c.id_usuario = u.id_usuario AND
					c.id_estado_cotizacion = e.id_estado_cotizacion AND
					u.id_sucursal = s.id_sucursal
				ORDER BY c.fecha_creacion DESC
				") or die('Consulta fallida: '.mysql_error());;
				$i=1;
				while($row = mysql_fetch_assoc($sql)){

				?>					  
											

										<tr>							
											<td><?php echo $i; ?></td>
											<td><input type="radio" class="iradio_flat-green" name="cot[]"></td>
											<td><?php echo $row['COTIZACION'];?></td>  
											<td><?php echo $row['CLIENTE'];?></td>
											<td><?php echo $row['PROYECTO'];?></td>
											<td><?php echo $row['FECHA'];?></td>
										</tr>
				<?php
				$i++;
				}
				?>                       
									  </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- FIN ACORDEON -->
			  
			  
			  
			  
			  
			<div class="col-md12">
				<h3 style="text-align: center;" class="">
					Datos del proyecto
                </h3>
			</div>
			<div class="form-group">
            	<label class="control-label col-md-3" for="last-name">
					Hora de visita
					<span class="required">*</span>
				</label>
				<div class="col-md-9">
					<div class="input-group date" id="myDatepicker">
                    	<input type="text" class="form-control">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
                        </span>
					</div>
                </div>
			 </div>
			<div class="form-group">
        		<label class="control-label col-md-3" for="first-name">
					Nombre Proyecto <span class="required">*</span>
				</label>
				<div class="col-md-9">
					<input type="text" id="rut_cliente" name="title" required="required" class="form-control col-md-7 col-xs-12">
					</br></br>
				</div>							
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="last-name">
					Rut Cliente <span class="required">*</span>
				</label>
				<div class="col-md-9">
					<input type="text" id="last-name" name="nombre_cliente" required="required" class="form-control col-md-7 col-xs-12">
					</br></br>
				</div>
			</div>
			<div class="form-group">
				<label for="middle-name" class="control-label col-md-3">
					Nombre Cliente <span class="required">*</span>
				</label>
				<div class="col-md-9">
					<input type="text" name="localidad_cliente" id="middle-name" class="form-control col-md-7 col-xs-12" name="middle-name">
					</br></br>
				</div>
			</div>
			<div class="form-group">
				<label for="middle-name" class="control-label col-md-3">
					Localidad Cliente <span class="required">*</span>
				</label>
				<div class="col-md-9">
					<input type="text" name="localidad_cliente" id="middle-name" class="form-control col-md-7 col-xs-12" name="middle-name">
					</br></br>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">
					Origen <span class="required">*</span>
				</label>
				<div class="col-md-9">
                	<select class="form-control">
						<option>-- Seleccione --</option>
						<option>Santiago</option>
						<option>Valparaiso</option>
						<option>Los Andes</option>
						<option>San Antonio</option>
					</select>
					</br>
				</div>
			</div>
			  
 			<div class="form-group">
            	<label class="control-label col-md-3" for="first-name">
					Contacto 
					<span class="required">*</span>
				</label>
				<div class="col-md-9">
                	<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
					</br></br>
				</div>
			</div>
            <div class="form-group">
            	<label class="control-label col-md-3" for="last-name">
					Email
					<span class="required">*</span>
				</label>
				<div class="col-md-9 col-sm-6 col-xs-12">
                	<input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
					</br></br>
                </div>
            </div>

            <div class="form-group">
            	<label class="control-label col-md-3">
					Tel&eacute;fono <span class="required">*</span>
                </label>
				<div class="col-md-9">
                	<input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
					</br></br>
                </div>
            </div>			  
			  			  
			<div class="col-md12">
				<h3 style="text-align: center;" class="">
					Tipo de Servicio
                </h3>	
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
				<div class="table-responsive"><!-- Inicio de tabla con checkbox -->
					<table class="table table-striped jambo_table">
					<thead>
					<tr class="headings">
						<th><input type="checkbox" class="flat" onchange="cambiaGrupo(this)"></th>
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
								<input type="checkbox" value="<?php echo $row2['ID'];?>" class="flat" name="<?php echo $row1['ID'];?>[]">
							</td>
							<td><?php echo $row2['ID'];?></td>  
							<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;" >
								<?php 
								  $nombre_serv = utf8_encode($row2['NOMBRE_ENSAYO']);
								  echo utf8_decode($nombre_serv);
								?>
							</td>
							<td>UF <input type="text" value="<?php echo $row2['PRECIO'];?>" style="max-width:35px;"></td>
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
			  			  
			<div class="col-md12">
				<h3 style="text-align: center;" class="">
					Destino
                </h3>	        	
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
<!-- ////////////////77CONTENIDO POPUP AGREGAR -->			  			  
			  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary antosubmit">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Editar visita</h4>
          </div>
          <div class="modal-body">

			  
<!-- ////////////////////// datos de ventana popup ///////////////////////////////////////////-->			  
			 <div class="col-md12">
				<h3 style="text-align: center;" class="">
					Datos del proyecto
                </h3>
			 </div>
			  <div class="form-group">
            	<label class="control-label col-md-3" for="last-name">
					Hora de visita
					<span class="required">*</span>
				</label>
				<div class="col-md-9">
					<div class="input-group date" id="myDatepicker">
                    	<input type="text" class="form-control">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
                        </span>
					</div>
                </div>
			 </div>
			<div class="form-group">
        		<label class="control-label col-md-3" for="first-name">
					Nombre Proyecto <span class="required">*</span>
				</label>
				<div class="col-md-9">
					<input type="text" id="rut_cliente" name="rut_cliente" required="required" class="form-control col-md-7 col-xs-12">
					</br></br>
				</div>							
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="last-name">
					Rut Cliente <span class="required">*</span>
				</label>
				<div class="col-md-9">
					<input type="text" id="last-name" name="nombre_cliente" required="required" class="form-control col-md-7 col-xs-12">
					</br></br>
				</div>
			</div>
			<div class="form-group">
				<label for="middle-name" class="control-label col-md-3">
					Nombre Cliente <span class="required">*</span>
				</label>
				<div class="col-md-9">
					<input type="text" name="localidad_cliente" id="middle-name" class="form-control col-md-7 col-xs-12" name="middle-name">
					</br></br>
				</div>
			</div>
			<div class="form-group">
				<label for="middle-name" class="control-label col-md-3">
					Localidad Cliente <span class="required">*</span>
				</label>
				<div class="col-md-9">
					<input type="text" name="localidad_cliente" id="middle-name" class="form-control col-md-7 col-xs-12" name="middle-name">
					</br></br>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">
					Origen <span class="required">*</span>
				</label>
				<div class="col-md-9">
                	<select class="form-control">
						<option>-- Seleccione --</option>
						<option>Santiago</option>
						<option>Valparaiso</option>
						<option>Los Andes</option>
						<option>San Antonio</option>
					</select>
					</br>
				</div>
			</div>
			  
 			<div class="form-group">
            	<label class="control-label col-md-3" for="first-name">
					Contacto 
					<span class="required">*</span>
				</label>
				<div class="col-md-9">
                	<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
					</br></br>
				</div>
			</div>
            <div class="form-group">
            	<label class="control-label col-md-3" for="last-name">
					Email
					<span class="required">*</span>
				</label>
				<div class="col-md-9 col-sm-6 col-xs-12">
                	<input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
					</br></br>
                </div>
            </div>

            <div class="form-group">
            	<label class="control-label col-md-3">
					Tel&eacute;fono <span class="required">*</span>
                </label>
				<div class="col-md-9">
                	<input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
					</br></br>
                </div>
            </div>			  
			  			  
			<div class="col-md12">
				<h3 style="text-align: center;" class="">
					Tipo de Servicio
                </h3>	
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
        <div id="collapse<?php echo $href;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $href;?>">
        	<div class="panel-body">
				<div class="table-responsive"><!-- Inicio de tabla con checkbox -->
					<table class="table table-striped jambo_table bulk_action">
					<thead>
					<tr class="headings">
						<th><input type="checkbox" id="check-all" class="flat"></th>
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
								<input type="checkbox" value="<?php echo $row2['ID'];?>" class="flat" name="<?php echo $row1['ID'];?>[]">
							</td>
							<td><?php echo $row2['ID'];?></td>  
							<td style="overflow:hidden; white-space:nowrap; text-overflow: ellipsis; max-width: 350px;" >
								<?php 
								  $nombre_serv = utf8_encode($row2['NOMBRE_ENSAYO']);
								  echo utf8_decode($nombre_serv);
								?>
							</td>
							<td>UF <input type="text" value="<?php echo $row2['PRECIO'];?>" style="max-width:35px;"></td>
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
			  			  
			<div class="col-md12">
				<h3 style="text-align: center;" class="">
					Destino
                </h3>	        	
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
 			
		
<!-- ////////////////////// fin datos de ventana popup ///////////////////////////////////////////-->			  

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary antosubmit2">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->
        
		
					  
					  
					  
<!-- /////////////////////////// -->
					  
					  
					  
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
	<script src="../vendors/moment/min/moment.min.js"></script>    
	<!-- FullCalendar -->
    
    <script src="../vendors/fullcalendar2/dist/fullcalendar.js"></script>
	
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
	<!-- bootstrap-daterangepicker -->
    
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<!-- Nuevo Calendario -->    
	
	<script src="../calendario/scheduler.min.js"></script>
	<script>
    
    $('#myDatepicker').datetimepicker({
        format: 'hh:mm A'
    });

	function  init_calendar() {		
		$(function() { // document ready

			$('#calendar').fullCalendar({
				schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
				defaultView: 'agendaDay',
				defaultDate: '2018-05-04',
				editable: true,
				selectable: true,
				eventLimit: true, // allow "more" link when too many events
				header: {
					left: 'prev,next today',
					center: 'title',
					//right: 'agendaDay,agendaTwoDay,agendaWeek,month'
					right: 'agendaDay,agendaTwoDay'
				},
				views: {
					agendaTwoDay: {
					type: 'agenda',
					duration: { days: 2 },

					// views that are more than a day will NOT do this behavior by default
					// so, we need to explicitly enable it
					groupByResource: true

					//// uncomment this line to group by day FIRST with resources underneath
					//groupByDateAndResource: true
					}
				},

				//// uncomment this line to hide the all-day slot
				//allDaySlot: false,

				resources: [
					{ id: 'a', title: 'Laboratorista 1' },
					{ id: 'b', title: 'Laboratorista 2', eventColor: 'green' },
					{ id: 'c', title: 'Laboratorista 3', eventColor: 'orange' },
					{ id: 'd', title: 'Laboratorista 4', eventColor: 'red' },
					{ id: 'e', title: 'Laboratorista 5', eventColor: 'blue' },
					{ id: 'f', title: 'Laboratorista 6', eventColor: 'yellow' }
				],
				events: [
					{ id: '1', resourceId: 'a', start: '2018-04-06', end: '2018-04-08', title: 'event 1' },
					{ id: '2', resourceId: 'a', start: '2018-05-07T09:00:00', end: '2018-05-07T14:00:00', title: 'event 2' },
					{ id: '3', resourceId: 'b', start: '2018-05-07T12:00:00', end: '2018-05-08T06:00:00', title: 'event 3' },
					{ id: '4', resourceId: 'c', start: '2018-05-07T07:30:00', end: '2018-05-07T09:30:00', title: 'event 4' },
					{ id: '5', resourceId: 'd', start: '2018-05-07T10:00:00', end: '2018-05-07T15:00:00', title: 'event 5' }
				],

				select: function(start, end, jsEvent, view, resource) {
					console.log(
					'select',
					start.format(),
					end.format(),
					resource ? resource.id : '(no resource)'
					);
				},
				dayClick: function(date, jsEvent, view, resource) {
					console.log(
						'dayClick',
						date.format(),
						resource ? resource.id : '(no resource)'
					);
				}
			});

		});
	}

	/*
	
	function  init_calendar() {
					
				if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
				console.log('init_calendar');
					
				var date = new Date(),
					d = date.getDate(),
					m = date.getMonth(),
					y = date.getFullYear(),
					started,
					categoryClass;

				var calendar = $('#calendar').fullCalendar({
				  header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listMonth'
				  },
				  selectable: true,
				  selectHelper: true,
				  select: function(start, end, allDay) {
					$('#fc_create').click();

					started = start;
					ended = end;

					$(".antosubmit").on("click", function() {
					  var title = $("#title").val();
					  if (end) {
						ended = end;
					  }

					  categoryClass = $("#event_type").val();

					  if (title) {
						calendar.fullCalendar('renderEvent', {
							title: title,
							start: started,
							end: end,
							allDay: allDay
						  },
						  true // make the event "stick"
						);
					  }

					  $('#title').val('');

					  calendar.fullCalendar('unselect');

					  $('.antoclose').click();

					  return false;
					});
				  },
				  eventClick: function(calEvent, jsEvent, view) {
					$('#fc_edit').click();
					$('#title2').val(calEvent.title);

					categoryClass = $("#event_type").val();

					$(".antosubmit2").on("click", function() {
					  calEvent.title = $("#title2").val();

					  calendar.fullCalendar('updateEvent', calEvent);
					  $('.antoclose2').click();
					});

					calendar.fullCalendar('unselect');
				  },
				  editable: true,
				  events: [{
					title: 'Hola',
					start: new Date(y, m, 1)
				  }, {
					title: 'Long Event',
					start: new Date(y, m, d - 5),
					end: new Date(y, m, d - 2)
				  }, {
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				  }, {
					title: 'Lunch',
					start: new Date(y, m, d + 14, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				  }, {
					title: 'Birthday Party',
					start: new Date(y, m, d + 1, 19, 0),
					end: new Date(y, m, d + 1, 22, 30),
					allDay: false
				  }, {
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				  }]
				});
				
			};
	*/
</script>

  </body>
</html>
