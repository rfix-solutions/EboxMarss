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

include 'crearPDF.php';

//visualización PDF
$pdf->Output();

//Guarda PDF en la ubicación y nombre escogidos
//$pdf->Output('F','cotizaciones/'.$cot_numero.'.pdf',true);

?>
