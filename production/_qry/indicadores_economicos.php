<?php
if($_SESSION['currency']==0){
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

$contenido = file_get_contents('http://www.bancoestado.cl/bancoestado/indiceseconomicos/indicadores.asp');
$indicadores = filter_floats($contenido);


$UF = str_replace(".", "", $indicadores[0]);
$UTM = str_replace(".", "", $indicadores[1]);
$USD = str_replace(".", "", $indicadores[5]);

$UF = str_replace(",", ".", $UF);
$UTM = str_replace(",", ".", $UTM);
$USD = str_replace(",", ".", $USD);
$_SESSION['currency']=$UF;
}

//$UF = str_replace(".", "", $UF);

/*
// Opcional: Sacar los datos desde el banco central:
//$contenido = file_get_contents('http://si2.bcentral.cl/Basededatoseconomicos/951_480.asp');

echo '<pre>';
print_r(filter_floats($contenido));

// Si el punto decimal fuera formato gringo (AKA con un punto en vez de una coma):
//print_r(filter_floats('400.2333','.'));
echo '</pre>';
*/

?>
