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


echo $_GET['proyecto']."</br>";
echo $_GET['cliente']."</br>";
echo $_GET['laboratorista']."</br>";
echo $_GET['fecha_']."</br>";
echo $_GET['desde_']."</br>";
echo $_GET['hasta_']."</br>";
echo $_GET['lab_id']."</br>";
echo $_GET['agenda_id']."</br>";
?>
