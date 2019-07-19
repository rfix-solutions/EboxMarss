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



require('../vendors/fpdf/fpdf.php');
require('../vendors/fpdf/FPDFHtmlDoc.php');



$hoy = date("Y-m-d");
$Opcion = $_GET['OP'];
$i=1;
switch ($Opcion) {
	case 'SU':
		$pdf=new PDF('L','mm',array(200,310));
		$Titulo = "Suelos";

		$Tabla_Header = '

					<tr>
						<td width="20%">#</td>
						<td width="60%">F. Solicitud</td>
						<td width="50%">SS</td>
						<td width="80%">Cliente</td>
						<td width="80%">Proyecto</td>
						<td width="70%">Material</td>
						<td width="70%">Procedencia</td>
						<td width="70%">Ubicacion</td>
						<td width="60%">Ciudad</td>
						<td width="60%">F. Entrega</td>
						<td width="40%">GR 2"</td>
						<td width="40%">GR 4</td>
						<td width="40%">GR 10</td>
						<td width="40%">GR 200</td>
						<td width="40%">LIM IP</td>
						<td width="60%">CLA USCS</td>
						<td width="60%">PM DMCS</td>
						<td width="60%">PM% OPT</td>
						<td width="65%">CBR AL 95%</td>
						<td width="60%">DR DMAX</td>
						<td width="60%">DR DMIN</td>
					</tr>

		';

		$Qry = "
			SELECT
				s.id_form_solicitud_servicio AS ID_SOLICITUD,
				DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
				s.id_agendamiento_visita AS ID_AGENDAMIENTO,
				e.nombre_tipo_ensayo AS TIPO_ENSAYO,
				s.numero_solicitud AS N_SOLICITUD,
				s.material AS MATERIAL,
				s.procedencia AS PROCEDENCIA,
				s.ubicacion AS UBICACION,
				a.razon_social AS CLIENTE,
				a.nombre_proyecto AS PROYECTO
			FROM
				TBL_FormSS s, TBL_AgendaVisita a, TBL_EnsayoTipo e
			WHERE
				s.id_tipo_ensayo = '2' AND
				s.id_agendamiento_visita = a.id_agendamiento_visita AND
				s.id_tipo_ensayo = e.id_tipo_ensayo
		";


		$Sql = mysqli_query($link, $Qry);

		while ($Tabla_Data = mysqli_fetch_assoc($Sql)) {
			$Tabla_Content = $Tabla_Content . '
			<tr>
				<td width="20%">'.$i.'</td>
				<td width="60%">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
				<td width="50%">'.$Tabla_Data['N_SOLICITUD'].'</td>
				<td width="80%">'.substr($Tabla_Data['CLIENTE'],0,10).'</td>
				<td width="80%">'.substr($Tabla_Data['PROYECTO'],0,10).'</td>
				<td width="70%">'.$Tabla_Data['MATERIAL'].'</td>
				<td width="70%">'.$Tabla_Data['PROCEDENCIA'].'</td>
				<td width="70%">'.$Tabla_Data['UBICACION'].'</td>
				<td width="60%">Ciudad</td>
				<td width="60%">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
				<td width="40%">N/A</td>
				<td width="40%">N/A</td>
				<td width="40%">N/A</td>
				<td width="40%">N/A</td>
				<td width="40%">N/A</td>
				<td width="60%">N/A</td>
				<td width="60%">N/A</td>
				<td width="60%">N/A</td>
				<td width="65%">N/A</td>
				<td width="60%">N/A</td>
				<td width="60%">N/A</td>
			</tr>
			';

		$i++;
		}

	break;
	case 'HO':
		$pdf=new PDF('P');
		$Titulo = "Hormigon";
		$Tabla_Header='

				<tr>
					<td width="20">#</td>
					<td width="70">F. Ensayo</td>
					<td width="50">Nro Sol</td>
					<td width="160">Cliente</td>
					<td width="160">Proyecto</td>
					<td width="100">Tipo de Ensayo</td>
					<td width="70">F. Muestra</td>
					<td width="40">Edad</td>
					<td width="120">Resistencia Especificada</td>

				</tr>

		';

		$Qry = "
				SELECT
					H.id_form_c_h_m AS ID_SOLICITUD,
					DATE_FORMAT(H.fecha_muestra, '%Y-%m-%d') AS FECHA_SOLICITUD,
					H.id_agendamiento_visita AS ID_AGENDAMIENTO,
					H.numero_solicitud AS N_SOLICITUD,
					a.razon_social AS CLIENTE,
					a.nombre_proyecto AS PROYECTO,
					T.nombre_tipo_ensayo AS TIPO_ENSAYO,
					E.nombre_ensayo AS NOMBRE_ENSAYO,
					D.edad AS EDAD,
					R.FormHMDetRE_Valor AS RESISTENCIA_ESPECIFICA,
					'HM' as FORM
				FROM
					TBL_FormHM H, TBL_AgendaVisita a, TBL_EnsayoTipo T, TBL_FormHMDet D, TBL_FormHMDetRE R, TBL_Ensayo E, TBL_FormHMProb P
				WHERE
					H.id_tipo_ensayo = '1' AND
					H.id_agendamiento_visita = a.id_agendamiento_visita AND
					H.id_tipo_ensayo = T.id_tipo_ensayo AND
					H.id_form_c_h_m = D.id_form_c_h_m AND
					D.FormHMDetRE_Id = R.FormHMDetRE_Id AND
					D.FormHMProb_Id = P.FormHMProb_Id AND
					P.FormHMProb_IdEnsayo = E.id_ensayo
				UNION

				SELECT
					S.id_form_solicitud_servicio AS ID_SOLICITUD,
					DATE_FORMAT(S.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
					S.id_agendamiento_visita AS ID_AGENDAMIENTO,
					S.numero_solicitud AS N_SOLICITUD,
					a.razon_social AS CLIENTE,
					a.nombre_proyecto AS PROYECTO,
					T.nombre_tipo_ensayo AS TIPO_ENSAYO,
					E.nombre_ensayo AS NOMBRE_ENSAYO,
					'N/A' AS EDAD,
					'N/A' AS RESISTENCIA_ESPECIFICA,
					'SS' AS FORM
				FROM
					TBL_FormSS S, TBL_AgendaVisita a, TBL_EnsayoTipo T, TBL_Ensayo E, TBL_FormSSDetalle D
				WHERE
					S.id_tipo_ensayo = '1' AND
					S.id_agendamiento_visita = a.id_agendamiento_visita AND
					S.id_tipo_ensayo = T.id_tipo_ensayo AND
					S.id_form_solicitud_servicio = D.FormSSDetalle_Id AND
					E.id_ensayo = D.Ensayo_IdEnsayo

		";

		$Sql = mysqli_query($link, $Qry) or die("Error en Qry CHM".mysqli_query());;
		while ($Tabla_Data = mysqli_fetch_assoc($Sql)) {
			if($Tabla_Data['EDAD'] == ""){
				$EDAD = 0;
			}
			else{
				$EDAD = $Tabla_Data['EDAD'];
			}
			$dias = intval($EDAD);
			$Tabla_Content = $Tabla_Content . '
				<tr>
					<td width="20">'.$i.'</td>
					<td width="70">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
					<td width="50">'.$Tabla_Data['N_SOLICITUD'].'</td>
					<td width="160">'.$Tabla_Data['CLIENTE'].'</td>
					<td width="160">'.$Tabla_Data['PROYECTO'].'</td>
					<td width="100">'.utf8_decode($Tabla_Data['TIPO_ENSAYO']).'</td>
					<td width="70">'.date("Y-m-d",strtotime($Tabla_Data['FECHA_SOLICITUD']."+ $dias days")).'</td>
					<td width="40">'.$EDAD.'</td>
					<td width="120">'.$Tabla_Data['RESISTENCIA_ESPECIFICA'].'</td>
				</tr>
			';
			$i++;
			}

	break;
	case 'EL':
		$pdf=new PDF('L');
		$Titulo = "Elementos";
		$Tabla_Header = '
		<tr>
			<td width="20">#</td>
			<td width="80">Fecha Ensayo</td>
			<td width="60">SS N°</td>
			<td width="130">Cliente</td>
			<td width="130">Proyecto</td>
			<td width="130">Tipo de Ensayo</td>
			<td width="80">Fecha Muestra</td>
			<td width="40">Edad</td>
			<td width="120">Resistencia Especificada</td>
			<td width="120">Resistencia Ensayo</td>
		</tr>
		';

		$Qry = "
		SELECT
			s.id_form_solicitud_servicio AS ID_SOLICITUD,
			DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
			s.id_agendamiento_visita AS ID_AGENDAMIENTO,
			e.nombre_tipo_ensayo AS TIPO_ENSAYO,
			s.numero_solicitud AS N_SOLICITUD,
			s.material AS MATERIAL,
			s.procedencia AS PROCEDENCIA,
			s.ubicacion AS UBICACION,
			a.razon_social AS CLIENTE,
			a.nombre_proyecto AS PROYECTO
		FROM
			TBL_FormSS s, TBL_AgendaVisita a, TBL_EnsayoTipo e
		WHERE
			s.id_tipo_ensayo = '6' AND
			s.id_agendamiento_visita = a.id_agendamiento_visita AND
			s.id_tipo_ensayo = e.id_tipo_ensayo
		";

		$Sql = mysqli_query($link, $Qry);
		while ($Tabla_Data = mysqli_fetch_assoc($Sql)) {
				$Tabla_Content = $Tabla_Content . '
				<tr>
					<td width="20">'.$i.'</td>
					<td width="80">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
					<td width="60">'.$Tabla_Data['N_SOLICITUD'].'</td>
					<td width="130">'.$Tabla_Data['CLIENTE'].'</td>
					<td width="130">'.$Tabla_Data['PROYECTO'].'</td>
					<td width="130">'.$Tabla_Data['TIPO_ENSAYO'].'</td>
					<td width="80">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
					<td width="40">'.$Tabla_Data['EDAD'].'</td>
					<td width="120">'.$Tabla_Data['RESISTENCIA_ESPECIFICA'].'</td>
					<td width="120"></td>
				</tr>
				';
				$i++;
			}


	break;
	case 'AS':
		$pdf=new PDF('L','mm',array(200,450));
		$Titulo = "Asfalto";
		$Tabla_Header = '
		<tr>
			<td width="30">#</td>
			<td width="70">F. Solicitud</td>
			<td width="40">SS N</td>
			<td width="130">Cliente</td>
			<td width="120">Proyecto</td>
			<td width="70">Material</td>
			<td width="70">Procedencia</td>
			<td width="70">Ubicacion</td>
			<td width="70">F Entrega</td>
			<td width="120">ASF. GR Y CONT ASF</td>
			<td width="100">ASF. ESPESOR</td>
			<td width="90">ASF. DREAL</td>
			<td width="120">ASF. CONT ASF (T)</td>
			<td width="100">DOS. HORMIGÓN</td>
			<td width="110">DOS. MORTERO</td>
			<td width="120">DOS. SUELO CEMENTO</td>
			<td width="90">DOS. SUELOS</td>
			<td width="100">Aridos</td>
			<td width="80">Aguas</td>
		</tr>
		';

		$Sql = "
		SELECT
			s.id_form_solicitud_servicio AS ID_SOLICITUD,
			DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
			e.nombre_tipo_ensayo AS TIPO_ENSAYO,
			s.numero_solicitud AS N_SOLICITUD,
			s.material AS MATERIAL,
			s.procedencia AS PROCEDENCIA,
			s.ubicacion AS UBICACION,
			a.razon_social AS CLIENTE,
			a.nombre_proyecto AS PROYECTO
		FROM
			TBL_FormSS s, TBL_AgendaVisita a, TBL_EnsayoTipo e
		WHERE
			s.id_tipo_ensayo = '5' AND
			s.id_agendamiento_visita = a.id_agendamiento_visita AND
			s.id_tipo_ensayo = e.id_tipo_ensayo
		";

		$Qry = mysqli_query($link, $Sql);
		while($Tabla_Data = mysqli_fetch_assoc($Qry)){
			if($Tabla_Data['MATERIAL'] == ""){ $Mat = "N/A"; }else{ $Mat = $Tabla_Data['MATERIAL']; }
			if($Tabla_Data['PROCEDENCIA'] == ""){ $Pro = "N/A"; }else{ $Pro = $Tabla_Data['PROCEDENCIA']; }
			if($Tabla_Data['UBICACION'] == ""){ $Ubi = "N/A"; }else{ $Ubi = $Tabla_Data['UBICACION']; }

			$Tabla_Content =  $Tabla_Content . '
			<tr>
				<td width="30">'.$i.'</td>
				<td width="70">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
				<td width="40">'.$Tabla_Data['N_SOLICITUD'].'</td>
				<td width="130">'.$Tabla_Data['CLIENTE'].'</td>
				<td width="120">'.$Tabla_Data['PROYECTO'].'</td>
				<td width="70">'.$Mat.'</td>
				<td width="70">'.$Pro.'</td>
				<td width="70">'.$Ubi.'</td>
				<td width="70">22/08/2018</td>
				<td width="120">OK</td>
				<td width="100">OK</td>
				<td width="90">OK</td>
				<td width="120">OK</td>
				<td width="100">OK</td>
				<td width="110">OK</td>
				<td width="120">OK</td>
				<td width="90">OK</td>
				<td width="100">OK</td>
				<td width="80">OK</td>
			</tr>
			';
			$i++;
		}

	break;
	case 'DO':
		$pdf=new PDF('L','mm',array(200,450));
		$Titulo = "Dosificacion";

		$Tabla_Content = '
		<tr>
			<td width="40">#</td>
			<td width="60">F. Solicitud</td>
			<td width="40">SS </td>
			<td width="130">Cliente</td>
			<td width="130">Proyecto</td>
			<td width="70">Material</td>
			<td width="70">Procedencia</td>
			<td width="70">Ubicacion</td>
			<td width="60">F. Entrega</td>
			<td width="110">ASF. GR Y CONT ASF</td>
			<td width="80">ASF. ESPESOR</td>
			<td width="70">ASF. DREAL</td>
			<td width="100">ASF. CONT ASF (T)</td>
			<td width="90">DOS. HORMIGON</td>
			<td width="90">DOS. MORTERO</td>
			<td width="120">DOS. SUELO CEMENTO</td>
			<td width="80">DOS. SUELOS</td>
			<td width="60">ARIDOS</td>
			<td width="60">AGUAS</td>
		</tr>
		';

		$Qry = "
		SELECT
			s.id_form_solicitud_servicio AS ID_SOLICITUD,
			DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
			e.nombre_tipo_ensayo AS TIPO_ENSAYO,
			s.numero_solicitud AS N_SOLICITUD,
			s.material AS MATERIAL,
			s.procedencia AS PROCEDENCIA,
			s.ubicacion AS UBICACION,
			a.razon_social AS CLIENTE,
			a.nombre_proyecto AS PROYECTO
		FROM
			TBL_FormSS s, TBL_AgendaVisita a, TBL_EnsayoTipo e
		WHERE
			s.id_tipo_ensayo = '7' AND
			s.id_agendamiento_visita = a.id_agendamiento_visita AND
			s.id_tipo_ensayo = e.id_tipo_ensayo
		";


		$Sql = mysqli_query($link, $Qry) or die("Error en DO: ".mysqli_error());;

		while($Tabla_Data = mysqli_fetch_assoc($Sql)){
			if($Tabla_Data['MATERIAL'] == ""){ $Mat = "N/A"; }else{ $Mat = $Tabla_Data['MATERIAL']; }
			if($Tabla_Data['PROCEDENCIA'] == ""){ $Pro = "N/A"; }else{ $Pro = $Tabla_Data['PROCEDENCIA']; }
			if($Tabla_Data['UBICACION'] == ""){ $Ubi = "N/A"; }else{ $Ubi = $Tabla_Data['UBICACION']; }

			$Tabla_Content = $Tabla_Content . '
			<tr>
				<td width="40">'.$i.'</td>
				<td width="60">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
				<td width="40">'.$Tabla_Data['N_SOLICITUD'].'</td>
				<td width="130">'.$Tabla_Data['CLIENTE'].'</td>
				<td width="130">'.$Tabla_Data['PROYECTO'].'</td>
				<td width="70">'.$Mat.'</td>
				<td width="70">'.$Pro.'</td>
				<td width="70">'.$Ubi.'</td>
				<td width="60">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
				<td width="110">OK</td>
				<td width="80">OK</td>
				<td width="70">OK</td>
				<td width="100">OK</td>
				<td width="90">OK</td>
				<td width="90">OK</td>
				<td width="120">OK</td>
				<td width="80">OK</td>
				<td width="60">OK</td>
				<td width="60">OK</td>
			</tr>
			';
			$i++;
		}


	break;

	case 'AR':

		$pdf=new PDF('L','mm',array(200,450));
		$Titulo = "Aridos";

		$Qry = "
			SELECT
				s.id_form_solicitud_servicio AS ID_SOLICITUD,
				DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
				e.nombre_tipo_ensayo AS TIPO_ENSAYO,
				s.numero_solicitud AS N_SOLICITUD,
				s.material AS MATERIAL,
				s.procedencia AS PROCEDENCIA,
				s.ubicacion AS UBICACION,
				a.razon_social AS CLIENTE,
				a.nombre_proyecto AS PROYECTO
			FROM
				TBL_FormSS s, TBL_AgendaVisita a, TBL_EnsayoTipo e
			WHERE
				s.id_tipo_ensayo = '4' AND
				s.id_agendamiento_visita = a.id_agendamiento_visita AND
				s.id_tipo_ensayo = e.id_tipo_ensayo
		";

		$Tabla_Content = '
			<tr>
				<td width="40">#</td>
				<td width="80">F. SOLICITUD</td>
				<td width="40">SS </td>
				<td width="130">CLIENTE</td>
				<td width="130">PROYECTO</td>
				<td width="70">MATERIAL</td>
				<td width="90">PROCEDENCIA</td>
				<td width="70">UBICACION</td>
				<td width="80">F. ENTREGA</td>
				<td width="110">ASF. GR Y CONT ASF</td>
				<td width="90">ASF. ESPESOR</td>
				<td width="70">ASF. DREAL</td>
				<td width="100">ASF. CONT ASF (T)</td>
				<td width="100">DOS. HORMIGON</td>
				<td width="100">DOS. MORTERO</td>
				<td width="120">DOS. SUELO CEMENTO</td>
				<td width="80">DOS. SUELOS</td>
				<td width="70">ARIDOS</td>
				<td width="70">AGUAS</td>
			</tr>
		';

		$Sql = mysqli_query($link, $Qry) or die("Error en AR: ".mysqli_error());;

		while($Tabla_Data = mysqli_fetch_assoc($Sql)){
			if($Tabla_Data['MATERIAL'] == ""){ $Mat = "N/A"; }else{ $Mat = $Tabla_Data['MATERIAL']; }
			if($Tabla_Data['PROCEDENCIA'] == ""){ $Pro = "N/A"; }else{ $Pro = $Tabla_Data['PROCEDENCIA']; }
			if($Tabla_Data['UBICACION'] == ""){ $Ubi = "N/A"; }else{ $Ubi = $Tabla_Data['UBICACION']; }

			$Tabla_Content = $Tabla_Content . '
			<tr>
				<td width="40">'.$i.'</td>
				<td width="80">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
				<td width="40">'.$Tabla_Data['N_SOLICITUD'].'</td>
				<td width="130">'.$Tabla_Data['CLIENTE'].'</td>
				<td width="130">'.$Tabla_Data['PROYECTO'].'</td>
				<td width="70">'.$Mat.'</td>
				<td width="90">'.$Pro.'</td>
				<td width="70">'.$Ubi.'</td>
				<td width="80">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
				<td width="110">OK</td>
				<td width="90">OK</td>
				<td width="70">OK</td>
				<td width="100">OK</td>
				<td width="100">OK</td>
				<td width="100">OK</td>
				<td width="120">OK</td>
				<td width="80">OK</td>
				<td width="70">OK</td>
				<td width="70">OK</td>
			</tr>
			';
			$i++;
		}



	break;
	case 'AG':
		$pdf=new PDF('L','mm',array(200,450));
		$Titulo = "Aguas";
		$Tabla_Content='
		<tr>
			<td width="40">#</td>
			<td width="80">F. SOLICITUD</td>
			<td width="40">SS </td>
			<td width="130">CLIENTE</td>
			<td width="130">PROYECTO</td>
			<td width="70">MATERIAL</td>
			<td width="90">PROCEDENCIA</td>
			<td width="70">UBICACION</td>
			<td width="80">F. ENTREGA</td>
			<td width="110">ASF. GR Y CONT ASF</td>
			<td width="90">ASF. ESPESOR</td>
			<td width="70">ASF. DREAL</td>
			<td width="100">ASF. CONT ASF (T)</td>
			<td width="100">DOS. HORMIGON</td>
			<td width="100">DOS. MORTERO</td>
			<td width="120">DOS. SUELO CEMENTO</td>
			<td width="80">DOS. SUELOS</td>
			<td width="70">ARIDOS</td>
			<td width="70">AGUAS</td>
		</tr>
		';

		$Qry = "
			SELECT
				s.id_form_solicitud_servicio AS ID_SOLICITUD,
				DATE_FORMAT(s.fecha_solicitud, '%Y-%m-%d') AS FECHA_SOLICITUD,
				e.nombre_tipo_ensayo AS TIPO_ENSAYO,
				s.numero_solicitud AS N_SOLICITUD,
				s.material AS MATERIAL,
				s.procedencia AS PROCEDENCIA,
				s.ubicacion AS UBICACION,
				a.razon_social AS CLIENTE,
				a.nombre_proyecto AS PROYECTO
			FROM
				TBL_FormSS s, TBL_AgendaVisita a, TBL_EnsayoTipo e
			WHERE
				s.id_tipo_ensayo = '3' AND
				s.id_agendamiento_visita = a.id_agendamiento_visita AND
				s.id_tipo_ensayo = e.id_tipo_ensayo
		";
		$Sql = mysqli_query($link, $Qry) or die("Error en AG: ".mysqli_error());;

		while($Tabla_Data = mysqli_fetch_assoc($Sql)){
			if($Tabla_Data['MATERIAL'] == ""){ $Mat = "N/A"; }else{ $Mat = $Tabla_Data['MATERIAL']; }
			if($Tabla_Data['PROCEDENCIA'] == ""){ $Pro = "N/A"; }else{ $Pro = $Tabla_Data['PROCEDENCIA']; }
			if($Tabla_Data['UBICACION'] == ""){ $Ubi = "N/A"; }else{ $Ubi = $Tabla_Data['UBICACION']; }

			$Tabla_Content = $Tabla_Content . '
			<tr>
				<td width="40">'.$i.'</td>
				<td width="80">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
				<td width="40">'.$Tabla_Data['N_SOLICITUD'].'</td>
				<td width="130">'.$Tabla_Data['CLIENTE'].'</td>
				<td width="130">'.$Tabla_Data['PROYECTO'].'</td>
				<td width="70">'.$Mat.'</td>
				<td width="90">'.$Pro.'</td>
				<td width="70">'.$Ubi.'</td>
				<td width="80">'.$Tabla_Data['FECHA_SOLICITUD'].'</td>
				<td width="110">OK</td>
				<td width="90">OK</td>
				<td width="70">OK</td>
				<td width="100">OK</td>
				<td width="100">OK</td>
				<td width="100">OK</td>
				<td width="120">OK</td>
				<td width="80">OK</td>
				<td width="70">OK</td>
				<td width="70">OK</td>
			</tr>
			';
			$i++;
		}

	break;
}
$Tabla_Full = '<br><table border="1">' . $Tabla_Header . $Tabla_Content . '</table>';




$pdf->AddPage();
//$pdf->SetLeftMargin(2);
//$pdf->SetRightMargin(2);

$pdf->Image('images/banner-bitacora.png',0,0,0,-175);
$pdf->Ln(11);
$pdf->SetFont('Arial','b',20);

$pdf->Cell(169,5,$Titulo,0,1,'L');
$pdf->SetFont('Arial','',7);


$pdf->WriteHTML($Tabla_Full);
$pdf->Output();

?>
