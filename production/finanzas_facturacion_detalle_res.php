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

$FacturaNumero	= $_POST['factura_n'];
$FacturaId			= $_POST['factura_id'];
$FacturaFecha		= $_POST['factura_fecha'];

$QRY_UpdateFactura = "
	UPDATE
		TBL_Factura
	SET
		Factura_Numero = '".$FacturaNumero."',
		Factura_FechaEmision = '".$FacturaFecha."'
	WHERE
		Factura_Id = '".$FacturaId."'
";


$SQL_UpdateFactura = mysqli_query($link, $QRY_UpdateFactura) or die ("Error en QRY Update Factura".mysqli_error($link));;

if($SQL_UpdateFactura){
  ?>
  <script type="text/javascript">
    alert("La factura ha sido registrada con éxito.")
    location.href="/production/finanzas_facturacion.php";
  </script>
  <?php
  exit;
}
else{
	?>
  <script type="text/javascript">
    alert("Por favor intente mas tarde.")
    location.href="/production/finanzas_facturacion.php";
  </script>
  <?php
  exit;
}

?>
