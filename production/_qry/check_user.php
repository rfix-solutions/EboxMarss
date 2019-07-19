<?php
session_start();
include 'db_connect_local.php';
print("<pre>");

if($_GET['cot'] == null || $_GET['cot'] == ""){
	$QRY_Usuario = "
		SELECT
			id_usuario AS ID,
			'LM' AS TIPO
		FROM
			TBL_Usuario
		WHERE
			email_usuario = '".$_GET['user']."' AND
			password = '".$_GET['password']."'
		";
}
else {
	$QRY_Usuario = "
		SELECT
			CU.ClienteUsuarios_Id AS ID,
			CU.ClienteUsuarios_Email AS PASS,
			CL.rut_cliente AS USER,
			'CL' AS TIPO
		FROM
			TBL_ClienteUsuarios CU, TBL_Cliente CL
		WHERE
			CU.ClienteUsuarios_IdCliente = CL.id_cliente AND
			CL.rut_cliente = '".$_GET['user']."' AND
			CU.ClienteUsuarios_Email = '".$_GET['password']."'
	";
}


$result = mysqli_query($link, $QRY_Usuario) or die('Error en QRY Usuario: '.mysql_error());;
//mysqli_query($link, "SELECT DATABASE()")
//or die('Consulta fallida: '.mysql_error());;
//$result = mysqli_query($link, $QRY_Usuario) or die('Consulta fallida: '.mysql_error());;
//$nrows = mysqli_num_rows($result);
//echo $nrows;
if(mysqli_num_rows($result)>0) {
	while($rows=mysqli_fetch_assoc($result)){
		$_SESSION['loggedin'] = true;
		$_SESSION['type'] = $rows['TIPO'];
    $_SESSION['id_user'] = $rows['ID'];
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
		$_SESSION['currency'] = 0;

		if($_SESSION['currency']==0 || $_SESSION['currency']==""){
			function filter_floats($in = '',$sep = '.') {
		  	$out = FALSE;
		  	if (!empty($in)) {
		    	$output = preg_split('/([^0-9]+[^'.$sep.']{1}+[^0-9])/',$in,-1,PREG_SPLIT_NO_EMPTY);
		    	if (count($output) > 0) {
		      	foreach($output AS $a) if (strpos($a,$sep) !== FALSE) $out[] = $a;
		      	unset($output,$a);
		    	}
		  	}
		  	return $out;
			}


			$contenido = file_get_contents('https://www.bancoestado.cl/bancoestado/indiceseconomicos/indicadores.asp');
			$indicadores = filter_floats($contenido);
			print_r($contenido);

			$UF = str_replace(".", "", $indicadores[0]);
			$UTM = str_replace(".", "", $indicadores[1]);
			$USD = str_replace(".", "", $indicadores[5]);

			$UF = str_replace(",", ".", $UF);
			$UTM = str_replace(",", ".", $UTM);
			$USD = str_replace(",", ".", $USD);
			$_SESSION['currency']= 27565.76;
			$hoy = date('Y-m-d');

			$QRY_Currency = "
				SELECT IndEconomicos_Fecha FROM
					TBL_IndEconomicos
				WHERE
					IndEconomicos_Fecha = '".$hoy."'
			";

			$SQL_Currency = mysqli_query($link, $QRY_Currency) or die ("ERROE EN QRY CURRENCY".mysqli_error($link));;

			if(mysqli_num_rows($SQL_Currency)<=0){
			$QRY_UF = "
					INSERT INTO TBL_IndEconomicos
						(IndEconomicos_Fecha, IndEconomicos_Valor, IndEconomicos_FechaOp)
					VALUES
						('".date('Y-m-d')."', '".$UF."', '".date('Y-m-d H:i:s')."')
					";
				$SQL_UF = mysqli_query($link, $QRY_UF) or die ("ERROR EN QRY UF".mysqli_error($link));;
			}
		}
		if($_GET['dir']!=""){?>
			<script type="text/javascript">
				location.href="<?php echo $_GET['dir']?>";
				</script>
				<?php
		}else{
			?>
			<script type="text/javascript">
				location.href="../dashboard_workflow.php";
				</script>
				<?php
		}
	}
}
else{?>
	<script type="text/javascript">
		alert("Los datos ingresados son incorrectos\nIntente nuevamente");
		location.href="../../login/";
	</script>
	<?php
}
print("</pre>");
?>
