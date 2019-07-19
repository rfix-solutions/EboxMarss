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
setlocale(LC_ALL,"es_ES");
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
		<!-- Datatables -->
		<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
	    <!-- Custom Theme Style -->
	    <link href="../build/css/custom.min.css" rel="stylesheet">
		  
		 
		  
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
                <h3>Ingreso de Formularios</h3>				  
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                      <!-- CONTENIDO EDITABLE -->
					
<div class="form-group">

				<div class="col-md12">
<?php
$sql1 = mysqli_query($link, "
SELECT 
	id_cotizacion AS ID,
	fecha_creacion as FECHA,
	numero_cotizacion as COTIZACION
FROM 
	tbl_cotizacion
") or die('Consulta fallida: '.mysql_error());;
while($row1 = mysqli_fetch_assoc($sql1)){
	if($row1['ID']==1){	$href = "One"; }
	if($row1['ID']==2){	$href = "Two"; }
	if($row1['ID']==3){	$href = "Three"; }
	if($row1['ID']==4){	$href = "Four"; }
?>										
									
<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true"><!-- Inicio Acordeon -->
	<div class="panel">
    	<a class="panel-heading" role="tab" id="heading<?php echo $href;?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $href;?>" aria-expanded="false" aria-controls="collapse<?php echo $href;?>">
        	<h4 class="panel-title"><?php echo $row1['COTIZACION']?> <?php echo $row1['FECHA']?> </h4>
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
						<th class="column-title">Servicio </th>
						<th class="column-title">Precio </th>
					</tr>
					</thead>
					<tbody>

	<?php
	$sql2 = mysqli_query($link, "
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
							<td>
								<button type="button" class="btn btn-info" onclick="window.location.href='form_solicitud_servicio.php?id=<?php echo $row2['ID'];?>'">Registrar</button>
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
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
	<!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
  </body>
</html>
