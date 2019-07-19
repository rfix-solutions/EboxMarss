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


$Opt = $_GET['opt'];
$Laboratorista = $_GET['laboratorista'];
$Cantidad = $_GET['cantidad'];

$QRY_Mayor = "
	SELECT
		MAX(Correlativo_Id) AS MAYOR,
		Correlativo_Numero AS NUMERO
	FROM
		TBL_Correlativo
	WHERE
		Correlativo_Estado = '1'
";


//print("<pre>");

$SQL_Mayor = mysqli_query($link, $QRY_Mayor) or die ("ERROR EN SQL MAYOR: ". mysqli_error($link));;
while($Mayor = mysqli_fetch_assoc($SQL_Mayor)){
	$Correlativo_Id = $Mayor['MAYOR'];
	$Correlativo_Mayor = $Mayor['NUMERO'];
}?>
<!DOCTYPE html>
<html lang="es">
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


<?php

for($i=1; $i<= $Cantidad; $i++){
	$Correlativo_Mayor = $Correlativo_Mayor + 1;
	$QRY_Folios = "
	INSERT INTO TBL_Correlativo
		(Correlativo_Numero, Correlativo_IdLaboratorista, Correlativo_Estado)
	VALUES
		('".$Correlativo_Mayor."', '".$Laboratorista."', '1')
	";
	$SQL_Folios = mysqli_query($link, $QRY_Folios) or die('Error en QRY: '.mysql_error($link));;
}
//print("</pre>");

?>

<script>
	alert(" Los folios han sido creados exitosamente");
	location.href = "mant_correlativos.php";
</script>
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
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
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>
