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
$hoy = date("Y-m-d h:i:s");
$fecha_agendamiento = date('Y-m-d', strtotime($_GET['fecha_agenda']));
if($_GET['observaciones']==""){$Observaciones = "Sin observaciones"; }





switch ($_GET['opcion']) {
/////////////////////////////////////////////////////PENDIENTE FORMULARIO
	case 'U':
	$positivo = 0;
	foreach ($_GET['tipo_ensayo_cantidad'] as $cantidad) {
		if($cantidad > 0){
			$positivo++;
		}
	}
	if($positivo==0){
	?>
	<script>
		alert("No ha seleccionado un tipo de servicio para agendar");
		history.back();
	</script>
	<?php
	exit;
	}
	/////////////////////////////// EJECUCIÖN DE QUERYS ////////////////////////////
	$query_agendamiento = "
		INSERT INTO TBL_AgendaVisita
		(
			rut_empresa,
			razon_social,
			nombre_proyecto,
			direccion_proyecto,
			contacto_proyecto,
			email_proyecto,
			telefono_proyecto,
			id_destino,
			id_laboratorista,
			fecha_agendamiento,
			hora_ini_agendamiento,
			hora_fin_agendamiento,
			observaciones,
			fecha_operacion,
			id_cotizacion,
			id_form_aceptacion
		)
		VALUES
		(
			'".$_GET['rut_cliente']."',
			'".$_GET['nombre_cliente']."',
			'".$_GET['nombre_proyecto']."',
			'".$_GET['localidad']."',
			'".$_GET['contacto']."',
			'".$_GET['email']."',
			'".$_GET['telefono']."',
			'".$_GET['destino']."',
			'".$_GET['id_laboratorista']."',
			'".$fecha_agendamiento."',
			'".$_GET['hora_ini_agenda']."',
			'".$_GET['hora_fin_agenda']."',
			'".$Observaciones."',
			'".$hoy."',
			'".$_GET['cot_id']."',
			'".$_GET['form_id']."'
		)
	";

	//echo $query_agendamiento."</br>";
	$query_update = "UPDATE TBL_Cotizacion SET id_estado_cotizacion = '4' WHERE id_cotizacion = '".$_GET['cot_id']."'";
	$query_update = "UPDATE TBL_FormAC SET estado_formulario = '0' WHERE id_cotizacion = '".$_GET['cot_id']."'";

	$query_max_id_agendamiento = "SELECT MAX(id_agendamiento_visita) AS id_mayor FROM TBL_AgendaVisita";
	$insert_agendamiento = mysqli_query($link, $query_agendamiento)or die('Error INSERT de agendamiento: '.mysqli_error());;
	$max_id_agendamiento = mysqli_query($link, $query_max_id_agendamiento)or die('Error SELECT de mayor en agendamiento: '.mysqli_error());;
	$update = mysqli_query($link, $query_update)or die('Error UPDATE de cotizacion: '.mysqli_error());;

	//////////////////////////////////////////////////////////////////////////////////////////

	while($max = mysqli_fetch_assoc($max_id_agendamiento)){	$id_agendamiento = $max['id_mayor'];}

	$servicios["id"] = $_GET['tipo_ensayo_id'];
	$servicios["cantidad"] = $_GET['tipo_ensayo_cantidad'];
	$i = count($servicios["id"]);
	for($j=0; $j<=$i; $j++){
		if($servicios["cantidad"][$j]==!0){
			$query_detalle_servicio_agendado =  "
				INSERT INTO TBL_AgendaVisitaDetalle
				(id_agendamiento_visita, id_tipo_ensayo, cantidad)
				VALUES
				('".$id_agendamiento."', '".$servicios["id"][$j]."', '".$servicios["cantidad"][$j]."')
			";
			$insert_detalle_servicio_agendado = mysqli_query($link, $query_detalle_servicio_agendado)or die('Error INSERT de detalle de servicio: '.mysqli_error());;
		}
	}

	foreach($_GET['equipo'] as $equipos){
		$query_detalle_equipo_agendado = "
			INSERT INTO TBL_AgendaVisitaDetalleEquipo
			(id_agendamiento_visita, id_equipo)
			VALUES
			('".$id_agendamiento."', '".$equipos."')
		";
		$insert_detalle_equipo_agendado = mysqli_query($link, $query_detalle_equipo_agendado)or die('Error INSERT de detalle de equipo: '.mysqli_error());;
	}

	if($insert_agendamiento && $insert_detalle_equipo_agendado && $insert_detalle_servicio_agendado && $update){
		?>
		<script>
			alert("El agendamiento ha sido realizado con éxito");
			location.href="operaciones_calendario.php";
		</script>
	<?php
	}

	break;



///////////////////////////////////////////////////CON FORMULARIO DE ACEPTACION
	case 'C':
	$positivo = 0;
	foreach ($_GET['tipo_ensayo_cantidad'] as $cantidad) {
		if($cantidad > 0){
			$positivo++;
		}
	}
	if($positivo==0){
		?>
		<script>
			alert("No ha seleccionado un tipo de servicio para agendar");
			history.back();
		</script>
		<?php
		exit;
	}

	$query_agendamiento = "
		INSERT INTO TBL_AgendaVisita
			(
			rut_empresa,
			razon_social,
			nombre_proyecto,
			direccion_proyecto,
			contacto_proyecto,
			email_proyecto,
			telefono_proyecto,
			id_destino,
			id_laboratorista,
			fecha_agendamiento,
			hora_ini_agendamiento,
			hora_fin_agendamiento,
			observaciones,
			fecha_operacion,
			id_cotizacion,
			id_form_aceptacion
			)
		VALUES
			(
			'".$_GET['rut_cliente']."',
			'".$_GET['nombre_cliente']."',
			'".$_GET['nombre_proyecto']."',
			'".$_GET['localidad']."',
			'".$_GET['contacto']."',
			'".$_GET['email']."',
			'".$_GET['telefono']."',
			'".$_GET['destino']."',
			'".$_GET['id_laboratorista']."',
			'".$fecha_agendamiento."',
			'".$_GET['hora_ini_agenda']."',
			'".$_GET['hora_fin_agenda']."',
			'".$Observaciones."',
			'".$hoy."',
			'".$_GET['cot_id']."',
			'".$_GET['form_id']."'
			)
	";

	$query_update = "UPDATE TBL_Cotizacion SET id_estado_cotizacion = '4' WHERE id_cotizacion = '".$_GET['cot_id']."'";
	$query_max_id_agendamiento = "SELECT MAX(id_agendamiento_visita) AS id_mayor FROM TBL_AgendaVisita";
	$insert_agendamiento = mysqli_query($link, $query_agendamiento)or die('Error INSERT de agendamiento: '.mysqli_error());;
	$max_id_agendamiento = mysqli_query($link, $query_max_id_agendamiento)or die('Error SELECT de mayor en agendamiento: '.mysqli_error());;
	$update = mysqli_query($link, $query_update)or die('Error UPDATE de cotizacion: '.mysqli_error());;

	while($max = mysqli_fetch_assoc($max_id_agendamiento)){	$id_agendamiento = $max['id_mayor'];}

	$servicios["id"] = $_GET['tipo_ensayo_id'];
	$servicios["cantidad"] = $_GET['tipo_ensayo_cantidad'];
	$i = count($servicios["id"]);
	for($j=0; $j<=$i; $j++){
		if($servicios["cantidad"][$j]==!0){
			$query_detalle_servicio_agendado =  "
				INSERT INTO TBL_AgendaVisitaDetalle
				(id_agendamiento_visita, id_tipo_ensayo, cantidad)
				VALUES
				('".$id_agendamiento."', '".$servicios["id"][$j]."', '".$servicios["cantidad"][$j]."')
			";
			$insert_detalle_servicio_agendado = mysqli_query($link, $query_detalle_servicio_agendado)or die('Error INSERT de detalle de servicio: '.mysqli_error());;
		}
	}
	foreach($_GET['equipo'] as $equipos){
		$query_detalle_equipo_agendado = "
			INSERT INTO TBL_AgendaVisitaDetalleEquipo
			(id_agendamiento_visita, id_equipo)
			VALUES
			('".$id_agendamiento."', '".$equipos."')
		";
		$insert_detalle_equipo_agendado = mysqli_query($link, $query_detalle_equipo_agendado)or die('Error INSERT de detalle de equipo: '.mysqli_error());;
	}

	if($insert_agendamiento && $insert_detalle_equipo_agendado && $insert_detalle_servicio_agendado && $update){
		$QRY_Insert = "
			INSERT INTO TBL_CotizacionGestion
			(id_cotizacion, detalle_historial_cotizacion, fecha_historial_cotizacion, id_usuario)
			VALUES
			('".$_GET['cot_id']."', 'Se agenda visita para el ".$fecha_agendamiento." de ".$_GET['hora_ini_agenda']." a ".$_GET['hora_fin_agenda']." horas.', '".date("Y-m-d H:i:s")."', '".$_SESSION['id_user']."')
		";

		$SQL_Insert = mysqli_query($link, $QRY_Insert);
		?>
		<script>
			alert("El agendamiento ha sido realizado con éxito");
			location.href="operaciones_calendario.php";
		</script>
		<?php
	}
	break;


//////////////////////////////////////////////////////EDITAR AGENDAMIENTO
	case 'E':
		$positivo = 0;
		foreach ($_GET['tipo_ensayo_cantidad'] as $cantidad) {
			if($cantidad > 0){
				$positivo++;
			}
		}
		if($positivo==0){
			?>
			<script>
				alert("No ha seleccionado un tipo de servicio para agendar");
				history.back();
			</script>
			<?php
			exit;
		}
		$query_update_agendamiento ="
			UPDATE TBL_AgendaVisita SET
				rut_empresa = '".$_GET['rut_cliente']."',
				razon_social = '".$_GET['nombre_cliente']."',
				nombre_proyecto = '".$_GET['nombre_proyecto']."',
				direccion_proyecto = '".$_GET['localidad']."',
				contacto_proyecto = '".$_GET['contacto']."',
				email_proyecto = '".$_GET['email']."',
				telefono_proyecto = '".$_GET['telefono']."',
				id_destino = '".$_GET['destino']."',
				id_laboratorista = '".$_GET['id_laboratorista']."',
				fecha_agendamiento = '".$fecha_agendamiento."',
				hora_ini_agendamiento = '".$_GET['hora_ini_agenda']."',
				hora_fin_agendamiento = '".$_GET['hora_fin_agenda']."',
				observaciones = '".$_GET['observaciones']."',
				fecha_operacion = '".$hoy."',
				id_cotizacion = '".$_GET['cot_id']."',
				id_form_aceptacion = '".$_GET['form_id']."'
			WHERE
				id_agendamiento_visita = '".$_GET['id_agenda']."'
		";
		$sql_update_agendamiento = mysqli_query($link, $query_update_agendamiento);
		$servicios["id"] = $_GET['tipo_ensayo_id'];
		$servicios["cantidad"] = $_GET['tipo_ensayo_cantidad'];
		$sql_update_detalle = 0;
		$sql_update_detalle_equipo = 0;
		$i = count($servicios["id"]);
		for($j=0; $j<=$i; $j++){
			if($servicios["cantidad"][$j]==!0){
				$query_detalle_servicio_agendado =  "
					UPDATE TBL_AgendaVisitaDetalle
					SET
						id_tipo_ensayo = '".$servicios["id"][$j]."',
						cantidad = '".$servicios["cantidad"][$j]."'
					WHERE
						id_agendamiento_visita = '".$_GET['id_agenda']."'
				";
				$update_detalle_servicio_agendado = mysqli_query($link, $query_detalle_servicio_agendado)or die('Error UPDATE detalle de servicio: '.mysqli_error());;
				//echo $query_detalle_servicio_agendado."</br>";
			}
		}
		foreach($_GET['equipo'] as $equipos){
			$query_detalle_equipo_agendado = "
				UPDATE TBL_AgendaVisitaDetalleEquipo
				SET
					id_equipo = '".$equipos."'
				WHERE
					id_agendamiento_visita = '".$_GET['id_agenda']."'
				";
			$update_detalle_equipo_agendado = mysqli_query($link, $query_detalle_equipo_agendado)or die('Error UPDATE de detalle de equipo: '.mysqli_error());;
		}
		if($sql_update_agendamiento){
			$QRY_Insert = "
				INSERT INTO TBL_CotizacionGestion
					(id_cotizacion, detalle_historial_cotizacion, fecha_historial_cotizacion, id_usuario)
				VALUES
					('".$_GET['cot_id']."', 'el agendamiento de la cotizacion ha sido actualizado', '".date("Y-m-d H:i:s")."', '".$_SESSION['id_user']."')
			";
			$SQL_Insert = mysqli_query($link, $QRY_Insert);
			?>
			<script>
				alert("El agendamiento ha sido actualizado con éxito");
				location.href="operaciones_calendario.php";
			</script>
			<?php
		}


////////////////////////// ANULAR AGENDAMIENTO
	case 'A':
	//	print("<pre>");
		$Qry_AgendaVisita  = "
			DELETE FROM TBL_AgendaVisita WHERE id_agendamiento_visita = '".$_GET['id_agenda']."'
		";
	 	$Qry_AgendaVisitaDetalle = "
			DELETE FROM TBL_AgendaVisitaDetalle WHERE id_agendamiento_visita = '".$_GET['id_agenda']."'
		";

		$Qry_AgendaVisitaDetalleEquipo = "
			DELETE FROM TBL_AgendaVisitaDetalleEquipo WHERE id_agendamiento_visita = '".$_GET['id_agenda']."'
		";
/*
		echo $Qry_CotizacionGestion = "
			INSERT INTO TBL_CotizacionGestion
				(id_cotizacion, detalle_historial_cotizacion, fecha_historial_cotizacion, id_usuario)
			VALUES
				('".$_GET['cot_id']."', 'Se anuló agendamiento N°'".$_GET['id_agenda']."', '".date("Y-m-d H:i:s")."', '".$_SESSION['id_user']."')
		";

		print("</pre>");
		*/
		$Del_AgendaVisita = mysqli_query($link, $Qry_AgendaVisita) or die ("Error en Del_AgendaVisita ".mysqli_error());;
		$Del_AgendaVisitaDetalle = mysqli_query($link, $Qry_AgendaVisitaDetalle)  or die ("Error en Del_AgendaVisitaDetalle ".mysqli_error());;
		$Del_AgendaVisitaDetalleEquipo = mysqli_query($link, $Qry_AgendaVisitaDetalleEquipo)  or die ("Error en Del_AgendaVisitaDetalleEquipo ".mysqli_error());;
		//$Ins_CotizacionGestion = mysqli_query($link, $Qry_CotizacionGestion)  or die ("Error en Ins_CotizacionGestion ".mysqli_error());;

		if($Del_AgendaVisita && $Del_AgendaVisitaDetalle && $Del_AgendaVisitaDetalleEquipo){
			?>
			<script>
				alert("El agendamiento ha sido anulado con éxito");
				location.href="operaciones_calendario.php";
			</script>
			<?php

		}
	break;
}
//print("<pre>");
