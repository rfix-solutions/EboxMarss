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

$FacturaDetalle_Q = $_GET['NROWS'];
$FacturaDetalle_SOLICITUD = $_GET['SOLICITUD'];
$FacturaDetalle_IDESANYO = $_GET['IDESANYO'];
$FacturaDetalle_CANTIDAD = $_GET['CANTIDAD'];
$FacturaDetalle_VALORUNIT = $_GET['VALORUNIT'];
$FacturaDetalle_FECHAOP = $_GET['FECHAOP'];

$QRY_Factura = "
INSERT INTO TBL_Factura
(
	Factura_ClienteRut,
	Factura_ClienteRazonSocial,
	Factura_ObraNombre,
	Factura_FormACId,
	Factura_Solicitante,
	Factura_Encargado,
	Factura_Ciudad,
	Factura_Email,
	Factura_FormaPago,
	Factura_ValorUF
)
VALUES
(
	'".$_GET['pf_rut']."',
	'".$_GET['pf_facturar_a']."',
	'".$_GET['pf_facturar_a']."',
	'".$_GET['pf_aceptacion']."',
	'".$_GET['pf_solicitante']."',
	'".$_GET['pf_encargado']."',
	'".$_GET['pf_ciudad']."',
	'".$_GET['pf_email']."',
	'".$_GET['pf_forma_pago']."',
	'".$_GET['pf_valor_uf']."'
)
";
$SQL_Factura = mysqli_query($link, $QRY_Factura) or die ("Error en QRY Factura ".mysqli_error($link));

$SQL_MAX = mysqli_query($link, "SELECT MAX(Factura_Id) AS MAYOR FROM TBL_Factura") or die ("Error en MAX".mysqli_error($link));;

while($Data_Max = mysqli_fetch_assoc($SQL_MAX)){
	$MAX = $Data_Max['MAYOR'];
}

$error = 0;
for($i=0; $i<$FacturaDetalle_Q; $i++){
  $QRY_Prefactura = "
    INSERT INTO TBL_FacturaDetalle
    (
      FacturaDetalle_FacturaId,
			FacturaDetalle_SolicitudN,
      FacturaDetalle_EnsayoId,
      FacturaDetalle_EnsayoQ,
      FacturaDetalle_ValorUnit,
      FacturaDetalle_FechaOp
    )
    VALUES
    (
			'".$MAX."',
      '".$FacturaDetalle_SOLICITUD[$i]."',
      '".$FacturaDetalle_IDESANYO[$i]."',
      '".$FacturaDetalle_CANTIDAD[$i]."',
      '".$FacturaDetalle_VALORUNIT[$i]."',
      '".$FacturaDetalle_FECHAOP[$i]."'
    )
  ";

  $SQL_Prefactura = mysqli_query($link, $QRY_Prefactura) or die ("Error en QRY Prefactura".mysqli_error($link));;
	$QRY_UpdateFormSS = "
		UPDATE
			TBL_FormSS
		SET
			prefactura_estado = '1'
		WHERE
			numero_solicitud = '".$FacturaDetalle_SOLICITUD[$i]."'
	";

	$QRY_UpdateFormHM = "
		UPDATE
			TBL_FormHM
		SET
			prefactura_estado = '1'
		WHERE
			numero_solicitud = '".$FacturaDetalle_SOLICITUD[$i]."'
	";

	$SQL_UpdateFormSS = mysqli_query($link, $QRY_UpdateFormSS);
	$SQL_UpdateFormHM = mysqli_query($link, $QRY_UpdateFormHM);

  if(!$SQL_Prefactura){
    $error++;
  }
}

if($error == 0){
  ?>
  <script type="text/javascript">
    alert("La prefacturacion ha sido registrada con éxito.")
    location.href="/production/finanzas_prefacturacion.php";
  </script>
  <?php
  exit;
}
else{
  ?>
    <script type="text/javascript">
      alert("Por favor intente mas tarde.")
      location.href="/production/finanzas_prefacturacion.php";
    </script>
    <?php
    exit;

}

?>
