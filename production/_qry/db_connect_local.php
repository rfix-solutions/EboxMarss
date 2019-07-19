<?php
date_default_timezone_set('America/La_Paz');
//date_default_timezone_set('America/Santiago');

setlocale(LC_ALL,"es_ES");
// 186.64.117.95
$link = mysqli_connect("localhost", "eboxcl", "mCBt169yj3", "eboxcl_labmarss");
mysqli_set_charset($link, 'utf8');
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if(isset($_SESSION['id_user'])){
    $id = $_SESSION['id_user'];
    $query_ = mysqli_query($link, "SELECT nombre_usuario FROM TBL_Usuario WHERE id_usuario = '".$id."'");
    while($rows = mysqli_fetch_assoc($query_)){
      $nombre_usuario = $rows['nombre_usuario'];

    }
}

$Title = "EBOX PLATFORM - ";
$Company = "Lab Marss";

// $link = mysqli_connect('localhost', 'eboxcl', 's3mp3r_fidelis') or die('No se pudo conectar: ' . mysql_error());
//mysqli_select_db($link , 'eboxcl_labmarss') or die('No se pudo seleccionar la base de datos');

?>
