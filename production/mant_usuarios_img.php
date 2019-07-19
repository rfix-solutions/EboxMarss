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

function generateRandomString($length = 15){
  return substr(sha1(rand()), 0, $length);
}

/*
"Nombre: " . $_FILES['archivo']['name'] . "<br>";
"Tipo: " . $_FILES['archivo']['type'] . "<br>";
"Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";
"Carpeta temporal: " . $_FILES['archivo']['tmp_name'] . " kB<br>";
"Usuario: " . $_POST['User'] . "<br>";
*/


/*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
//move_uploaded_file($_FILES['archivo']['tmp_name'],"images/profile/" . $_FILES['archivo']['name']);//<em id="__mceDel"> </em>
//move_uploaded_file($_FILES['archivo']['tmp_name'],"images/signature/" . $_FILES['archivo']['name']);//<em id="__mceDel"> </em>

if ($_FILES['archivo']["error"] > 0){
  echo "Error: " . $_FILES['archivo']['error'] . "<br>";
}
else {
  $random = generateRandomString();
  $NewName = $random."_".$_POST['User'].".png";
  switch ($_POST['ImgType']) {
    case '1':// PROFILE 130x130px
    $QryUpdt = "
      UPDATE TBL_Usuario
      SET UsuarioAvatar = '".$NewName."'
      WHERE id_usuario = '".$_POST['User']."'
    ";
    $Dir = "images/profile/";
    break;

    case '2': // SIGNATURE
    $QryUpdt = "
      UPDATE TBL_Usuario
      SET UsuarioSignature = '".$NewName."'
      WHERE id_usuario = '".$_POST['User']."'
    ";
    $Dir = "images/signature/";

    break;
  }
  move_uploaded_file($_FILES['archivo']['tmp_name'], $Dir . $NewName);//<em id="__mceDel"> </em>
  $SQLUpdt = mysqli_query($link, $QryUpdt) or die ("Error en QryUpdt :" . mysqli_error());;
}
if($SQLUpdt){
  ?>
  <script>alert("La imagen ha sido actualizada con éxito");location.href='mant_usuarios.php';</script>
<?php
}
else{
  ?>
  <script>alert("Error en la actualización. Por favor inténtelo más tarde");location.href='mant_usuarios.php';</script>
<?php
}
?>
