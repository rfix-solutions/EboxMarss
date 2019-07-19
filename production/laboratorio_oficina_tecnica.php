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
//DENSIDAD NUCLEAR
$Qry51 = "
SELECT
	DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
	S.numero_solicitud AS SOLICITUD_NUMERO,
	A.id_agendamiento_visita AS ID_AGENDAMIENTO,
	A.razon_social AS CLIENTE,
	A.nombre_proyecto AS PROYECTO
FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
WHERE
	D.Ensayo_IdEnsayo = '51' AND
	D.FormSS_Id = S.id_form_solicitud_servicio AND
	S.id_agendamiento_visita = A.id_agendamiento_visita
";

$Qry56 = "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '56' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";
$Qry57 = "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '57' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";

$Qry52 = "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '52' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";

$Qry6 = "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '6' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";

$Qry3 = "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '3' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";

$Qry_9= "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '9' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";


$Qry_46= "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '46' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";



$Qry37 = "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '37' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";

$Qry44 = "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '44' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";

$Qry40 = "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '40' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";

$Qry7 = "
	SELECT
		DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS SOLICITUD_FECHA,
		S.numero_solicitud AS SOLICITUD_NUMERO,
		A.id_agendamiento_visita AS ID_AGENDAMIENTO,
		A.razon_social AS CLIENTE,
		A.nombre_proyecto AS PROYECTO
	FROM TBL_FormSSDetalle D, TBL_FormSS S, TBL_AgendaVisita A
	WHERE
		D.Ensayo_IdEnsayo = '7' AND
		D.FormSS_Id = S.id_form_solicitud_servicio AND
		S.id_agendamiento_visita = A.id_agendamiento_visita
";

?>

<!DOCTYPE html>
<html lang="es">
	<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $Title;?></title>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Datatables -->
		<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
		<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  </head>
	<body class="nav-md">
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
            	<h3>Oficina T&eacute;cnica</h3>
            </div>
          </div>
					<div class="clearfix"></div>
					<div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
              	<div class="x_content">
									<div class="col-md-3">
										<ul class="nav nav-tabs tabs-left">
	                  	<li class="active"><a href="#0" data-toggle="tab">DENSIDAD NUCLEAR</a></li>
											<li><a href="#1" data-toggle="tab">PORCHET</a></li>
	                    <li><a href="#2" data-toggle="tab">ESTRATIGRAFIA</a></li>
	                    <li><a href="#3" data-toggle="tab">DENSIDAD CONO ARENA</a></li>
											<li><a href="#4" data-toggle="tab">CONTROL DE DOCILIDAD</a></li>
											<li><a href="#5" data-toggle="tab">DENSIDAD APARENTE HORMIGON FRESCO</a></li>
											<li><a href="#6" data-toggle="tab">LISURA HI-LO (ASFALTO)</a></li>
											<li><a href="#10" data-toggle="tab">LISURA HI-LO (HORMIG&Oacute;N)</a></li>
											<li><a href="#7" data-toggle="tab">DENSIDAD EN TERRENO (ASFALTO)</a></li>
											<li><a href="#8" data-toggle="tab">CONTROL DE TEMPERATURA</a></li>
											<li><a href="#9" data-toggle="tab">CONTROL DE RIEGO ASFALTICO</a></li>
											<li><a href="#11" data-toggle="tab">INDICE ESCLEROMETRICO</a></li>

	                  </ul>
									</div>
									<div class="col-md-9">
	                	<div class="tab-content">

	                  	<div class="tab-pane active" id="0">
	                    	<p class="lead"> DENSIDAD NUCLEAR </p>
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=DN"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="densidad-nuclear" class="table table-striped table-bordered" style="width:100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

														$Sql51 = mysqli_query($link, $Qry51) or die("Error en SQL51:". mysqli_error());;
														$i=1;
														while($Item51 = mysqli_fetch_assoc($Sql51)){?>
														<tr>
															<td><?php echo $i;?></td>
															<td><?php echo $Item51['SOLICITUD_FECHA']; ?></td>
															<td style="text-align: center;" >
																<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item51['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item51['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item51['SOLICITUD_NUMERO'];?></a>
															</td>
															<td><?php echo $Item51['CLIENTE']; ?></td>
															<td><?php echo $Item51['PROYECTO']; ?></td>
															<td><button type="button" data-toggle="modal" data-target="#modal-densidad-nuclear" class="btn btn-default btn-xs">Ensayar</button></td>
														</tr>
														<?php
														$i++;
														}
														?>
													</tbody>
												</table>
											</div>

		                  <div class="tab-pane" id="1">
												<p class="lead">PORCHET</p>
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=PC"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="porchet" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

														$Sql56 = mysqli_query($link, $Qry56) or die("Error en SQL56:". mysqli_error());;
														$i=1;
														while($Item56 = mysqli_fetch_assoc($Sql56)){?>
															<tr>
																<td><?php echo $i;?></td>
																<td><?php echo $Item56['SOLICITUD_FECHA']; ?></td>
																<td style="text-align: center;" >
																	<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item56['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item56['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item56['SOLICITUD_NUMERO'];?></a>
																</td>
																<td><?php echo $Item56['CLIENTE']; ?></td>
																<td><?php echo $Item56['PROYECTO']; ?></td>
																<td><button type="button" data-toggle="modal" data-target="#modal-porchet" class="btn btn-default btn-xs">Ensayar</button></td>
															</tr>
														<?php
														$i++;
														}
														?>
													</tbody>
												</table>
											</div>

		                  <div class="tab-pane" id="2">
												<p class="lead">ESTRATIGRAFIA</p>
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=ET"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="estratigrafia" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

															$Sql57 = mysqli_query($link, $Qry57) or die("Error en SQL57:". mysqli_error());;
															$i=1;
															while($Item57 = mysqli_fetch_assoc($Sql57)){?>
																<tr>
																	<td><?php echo $i;?></td>
																	<td><?php echo $Item57['SOLICITUD_FECHA']; ?></td>
																	<td style="text-align: center;" >
																		<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item57['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item57['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item57['SOLICITUD_NUMERO'];?></a>
																	</td>
																	<td><?php echo $Item57['CLIENTE']; ?></td>
																	<td><?php echo $Item57['PROYECTO']; ?></td>
																	<td><button type="button" data-toggle="modal" data-target="#modal-estratigrafia" class="btn btn-default btn-xs">Ensayar</button></td>
																</tr>
															<?php
															$i++;
															}
														?>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="3">
												<p class="lead">DENSIDAD CONO ARENA</p>
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=DCA"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="densidad-cono-arena" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

														$Sql52 = mysqli_query($link, $Qry52) or die("Error en SQL52:". mysqli_error());;
														$i=1;
														while($Item52 = mysqli_fetch_assoc($Sql52)){?>
															<tr>
																<td><?php echo $i;?></td>
																<td><?php echo $Item52['SOLICITUD_FECHA']; ?></td>
																<td style="text-align: center;" >
																	<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item52['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item52['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item52['SOLICITUD_NUMERO'];?></a>
																</td>
																<td><?php echo $Item52['CLIENTE']; ?></td>
																<td><?php echo $Item52['PROYECTO']; ?></td>
																<td><button type="button" data-toggle="modal" data-target="#modal-densidad-cono-arena" class="btn btn-default btn-xs">Ensayar</button></td>
															</tr>
														<?php
														$i++;
														}
														?>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="4">
												<p class="lead">CONTROL DE DOCILIDAD</p>
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=CD"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="control-docilidad" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

														$Sql6 = mysqli_query($link, $Qry6) or die("Error en SQL6:". mysqli_error());;
														$i=1;
														while($Item6 = mysqli_fetch_assoc($Sql6)){?>
															<tr>
																<td><?php echo $i;?></td>
																<td><?php echo $Item6['SOLICITUD_FECHA']; ?></td>
																<td style="text-align: center;" >
																	<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item6['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item6['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item6['SOLICITUD_NUMERO'];?></a>
																</td>
																<td><?php echo $Item6['CLIENTE']; ?></td>
																<td><?php echo $Item6['PROYECTO']; ?></td>
																<td><button type="button" data-toggle="modal" data-target="#modal-control-docilidad" class="btn btn-default btn-xs">Ensayar</button></td>
															</tr>
														<?php
														$i++;
														}
														?>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="5">
												<p class="lead">DENSIDAD APARENTE HORMIGON FRESCO</p>
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=DAH"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="densidad-aparente-hormigon-fresco" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

															$Sql3 = mysqli_query($link, $Qry3) or die("Error en SQL3:". mysqli_error());;
															$i=1;
															while($Item3 = mysqli_fetch_assoc($Sql3)){?>
																<tr>
																	<td><?php echo $i;?></td>
																	<td><?php echo $Item3['SOLICITUD_FECHA']; ?></td>
																	<td style="text-align: center;" >
																		<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item3['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item3['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item3['SOLICITUD_NUMERO'];?></a>
																	</td>
																	<td><?php echo $Item6['CLIENTE']; ?></td>
																	<td><?php echo $Item6['PROYECTO']; ?></td>
																	<td><button type="button" data-toggle="modal" data-target="#modal-densidad-aparente-HF" class="btn btn-default btn-xs">Ensayar</button></td>
																</tr>
															<?php
															$i++;
															}
														?>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="6">
												<p class="lead">LISURA HI LO (ASFALTO)</p>
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=LHL"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="lisura-hi-lo-a" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

															$Sql_46 = mysqli_query($link, $Qry_46) or die("Error en SQL9_46:". mysqli_error());;
															$i=1;
															while($Item_46 = mysqli_fetch_assoc($Sql_46)){?>
																<tr>
																	<td><?php echo $i;?></td>
																	<td><?php echo $Item_46['SOLICITUD_FECHA']; ?></td>
																	<td style="text-align: center;" >
																		<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item_46['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item_46['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item_46['SOLICITUD_NUMERO'];?></a>
																	</td>
																	<td><?php echo $Item_46['CLIENTE']; ?></td>
																	<td><?php echo $Item_46['PROYECTO']; ?></td>
																	<td><button type="button" data-toggle="modal" data-target="#modal-lisura" class="btn btn-default btn-xs">Ensayar</button></td>
																</tr>
															<?php
															$i++;
															}
														?>
													</tbody>
												</table>
											</div>


											<div class="tab-pane" id="10">

												<p class="lead">LISURA HI LO (HORMIGÓN)</p>

												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=LHL"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="lisura-hi-lo-h" class="table table-striped table-bordered" width="100%" >

													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$Sql_9 = mysqli_query($link, $Qry_9) or die("Error en SQL_9:". mysqli_error());;
															$i=1;
															while($Item_9 = mysqli_fetch_assoc($Sql_9)){?>
																<tr>
																	<td><?php echo $i;?></td>
																	<td><?php echo $Item_9['SOLICITUD_FECHA']; ?></td>
																	<td style="text-align: center;" >
																		<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item_9['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item_9['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item_9['SOLICITUD_NUMERO'];?></a>
																	</td>
																	<td><?php echo $Item_9['CLIENTE']; ?></td>
																	<td><?php echo $Item_9['PROYECTO']; ?></td>
																	<td><button type="button" data-toggle="modal" data-target="#modal-lisura-hi-lo-h" class="btn btn-default btn-xs">Ensayar</button></td>
																</tr>
															<?php
															$i++;
															}
														?>
													</tbody>
												</table>
											</div>


											<div class="tab-pane" id="7">
												<p class="lead">DENSIDAD EN TERRENO (ASFALTO)</p>
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=DT"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="densidad-terreno" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

															$Sql37 = mysqli_query($link, $Qry37) or die("Error en SQL37:". mysqli_error());;
															$i=1;
															while($Item37 = mysqli_fetch_assoc($Sql37)){?>
																<tr>
																	<td><?php echo $i;?></td>
																	<td><?php echo $Item37['SOLICITUD_FECHA']; ?></td>
																	<td style="text-align: center;" >
																		<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item37['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item37['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item37['SOLICITUD_NUMERO'];?></a>
																	</td>
																	<td><?php echo $Item37['CLIENTE']; ?></td>
																	<td><?php echo $Item37['PROYECTO']; ?></td>
																	<td><button type="button" data-toggle="modal" data-target="#modal-densidad-terreno" class="btn btn-default btn-xs">Ensayar</button></td>
																</tr>
															<?php
															$i++;
															}
														?>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="8">
												<p class="lead">CONTROL DE TEMPERATURA</p>
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=CT"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="control-temperatura" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

														$Sql40 = mysqli_query($link, $Qry40) or die("Error en SQL40:". mysqli_error());;
														$i=1;
														while($Item40 = mysqli_fetch_assoc($Sql40)){?>
															<tr>
																<td><?php echo $i;?></td>
																<td><?php echo $Item40['SOLICITUD_FECHA']; ?></td>
																<td style="text-align: center;" >
																	<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item40['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item40['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item40['SOLICITUD_NUMERO'];?></a>
																</td>
																<td><?php echo $Item40['CLIENTE']; ?></td>
																<td><?php echo $Item40['PROYECTO']; ?></td>
																<td><button type="button" data-toggle="modal" data-target="#modal-control-temperatura" class="btn btn-default btn-xs">Ensayar</button></td>
															</tr>
														<?php
														$i++;
														}
														?>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="9">
												<p class="lead">CONTROL DE RIEGO ASFALTICO</p><!-- ID 44 -->
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=CR"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="control-riego-asfaltico" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php

															$Sql44 = mysqli_query($link, $Qry44) or die("Error en SQL44:". mysqli_error());;
															$i=1;
															while($Item44 = mysqli_fetch_assoc($Sql44)){?>
																<tr>
																	<td><?php echo $i;?></td>
																	<td><?php echo $Item44['SOLICITUD_FECHA']; ?></td>
																	<td style="text-align: center;" >
																		<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item44['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item44['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item44['SOLICITUD_NUMERO'];?></a>
																	</td>
																	<td><?php echo $Item44['CLIENTE']; ?></td>
																	<td><?php echo $Item44['PROYECTO']; ?></td>
																	<td><button type="button" data-toggle="modal" data-target="#modal-control-riego" class="btn btn-default btn-xs">Ensayar</button></td>
																</tr>
															<?php
															$i++;
															}
														?>
													</tbody>
												</table>
											</div>

											<div class="tab-pane" id="11">

												<p class="lead">INDICE ESCLEROMETRICO</p>
<!-- ID 44 -->
												<a class="btn btn-success btn-xs" target="_blank" href="laboratorio_oftec_PDF.php?OP=CR"><i class="fa fa-file-pdf-o"></i> PDF</a>
												<table id="indice-esclerometrico" class="table table-striped table-bordered" width="100%" >
													<thead>
														<tr>
															<th>#</th>
															<th>Fecha Solicitud</th>
															<th>SS N°</th>
															<th>Cliente</th>
															<th>Proyecto</th>
															<th>Opcion</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$Sql7 = mysqli_query($link, $Qry7) or die("Error en SQL7:". mysqli_error());;
															$i=1;
															while($Item7 = mysqli_fetch_assoc($Sql7)){?>
																<tr>
																	<td><?php echo $i;?></td>
																	<td><?php echo $Item7['SOLICITUD_FECHA']; ?></td>
																	<td style="text-align: center;" >
																		<a type="button" href="operaciones_FormSSdet.php?id=<?php echo $Item7['ID_AGENDAMIENTO'];?>&folio=<?php echo $Item7['SOLICITUD_NUMERO'];?>" class="btn btn-default btn-xs"><?php echo $Item7['SOLICITUD_NUMERO'];?></a>
																	</td>
																	<td><?php echo $Item7['CLIENTE']; ?></td>
																	<td><?php echo $Item7['PROYECTO']; ?></td>
																	<td><button type="button" data-toggle="modal" data-target="#modal-control-riego" class="btn btn-default btn-xs">Ensayar</button></td>
																</tr>
															<?php
															$i++;
															}
														?>
													</tbody>

												</table>
											</div>


										</div>
<!-- MODALS -->

										<div class="modal fade bs-example-modal-lg" id="modal-control-temperatura" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title" id="modal_titulo_control_temperatura">Control de Temperatura</h4>
													</div>
													<div class="modal-body">
														<?php
															include("laboratorio-ensayos/oficina-tecnica/ensayo_control_temperatura.php");
														?>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
														<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
													</div>
												</div>
											</div>
										</div>

										<div class="modal fade bs-example-modal-md" id="modal-densidad-nuclear" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-md">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title" id="modal_titulo_densidad_nuclear">Densidad Nuclear</h4>
													</div>
													<div class="modal-body">
														<?php
														include("laboratorio-ensayos/oficina-tecnica/ensayo_densidad_nuclear.php");
														?>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
														<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
													</div>
												</div>
											</div>
										</div>

										<div class="modal fade bs-example-modal-lg" id="modal-densidad-cono-arena" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title" id="modal_titulo_densidad_cono_arena">Densidad Cono de Arena</h4>
													</div>
													<div class="modal-body">
														<?php
															include("laboratorio-ensayos/oficina-tecnica/ensayo_densidad_cono_arena.php");
														?>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
														<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
													</div>
												</div>
											</div>
										</div>

										<div class="modal fade bs-example-modal-md" id="modal-porchet" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-md">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
														</button>
														<h4 class="modal-title" id="modal_titulo_porchet">Porchet</h4>
													</div>
													<div class="modal-body">
														<?php
														include("laboratorio-ensayos/oficina-tecnica/ensayo_porchet.php");
														?>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
														<button type="button" data-toggle="modal" data-target="#MODAL_CONFIRMAR" class="btn btn-success">Aceptar</button>
													</div>
												</div>
											</div>
										</div>
<!-- MODALS -->
									</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->
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
  <!-- Datatables -->
	<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>

  <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="../vendors/jszip/dist/jszip.min.js"></script>
  <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
	<!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
	<script>

		 		function SetVal(valor){ document.getElementById('NS').value = valor; }
				function envia_form(dato){ document.form_densidad_nuclear.submit(); }

		 	$(document).ready(function() {
				$('#densidad-nuclear').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
		 		} );

				$('#porchet').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
		 		} );

				$('#estratigrafia').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
		 		} );

				$('#densidad-cono-arena').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
		 		} );

				$('#control-docilidad').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
		 		} );

				$('#densidad-aparente-hormigon-fresco').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
		 		} );

				$('#lisura-hi-lo-a').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
				} );

				$('#lisura-hi-lo-h').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
				} );

				$('#indice-esclerometrico').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
				} );


				$('#densidad-terreno').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
				} );

				$('#control-temperatura').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
				} );

				$('#control-riego-asfaltico').DataTable( {
				 "paging": true,
				 "ordering": true,
				 "info": true,
				 "striped": true,
				 "bordered":true
				} );



			} );
		 </script>

  </body>
</html>
