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



$sql_total = mysqli_query($link, "SELECT MAX(id_ensayo_item) AS MAYOR FROM TBL_EnsayoItem");
while($max = mysqli_fetch_assoc($sql_total)){ $total = $max['MAYOR']; }

// printf("<pre>");
for($i=1; $i<=$total; $i++){
  if($_GET[$i]!=""){
    $valor_ensayo = $_GET[$i];
    $query_suelos = "
      INSERT INTO TBL_EnsayoDetalleItem
      (id_ensayo_item, valor_ensayo_item, id_solicitud)
      VALUES
      ('".$i."', '".$valor_ensayo."', '".$_GET['id_solicitud']."')
    ";
    $sql_suelos = mysqli_query($link, $query_suelos) or die ('Consulta fallida: '.mysqli_error());;
  }
}

// printf("</pre>");
// if($sql_suelos){

	?>
  <script type="text/javascript">
    alert("Los datos han sido ingresados con éxito.")
    location.href="../laboratorio_sala_suelos.php";
  </script>
<?php

//exit;
//}



?>
