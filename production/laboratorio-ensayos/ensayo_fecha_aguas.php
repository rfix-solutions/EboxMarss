<!-- ///////////////////// DETERMINACIÓN DE TEMPERATURA EN TERRENO ////////////////-->
<?php
$query_titulo_aguas = "
  SELECT e.id_ensayo AS ID, e.nombre_ensayo AS NOMBRE,  n.nombre_norma_ensayo AS NORMA
  FROM tbl_ensayo e, tbl_norma_ensayo n
  WHERE
  e.id_ensayo = '87' AND
  e.id_norma_ensayo = n.id_norma_ensayo
";

$query_item_aguas = "
  SELECT
    id_ensayo_item AS ID, nombre_ensayo_item AS NOMBRE, unidad_medida_item AS UM
  FROM
    tbl_ensayo_item ei, tbl_tipo_ensayo te
  WHERE
    ei.id_ensayo = '87' AND
    te.id_tipo_ensayo = '3'
";

$sql_titulo_aguas = mysqli_query($link, $query_titulo_aguas) or die('Consulta fallida: '.mysqli_error());;
$sql_item_aguas = mysqli_query($link, $query_item_aguas) or die('Consulta fallida: '.mysqli_error());;

while ($titulo_aguas = mysqli_fetch_assoc($sql_titulo_aguas)) {
  $titulo = $titulo_aguas['NOMBRE'];
  $norma = $titulo_aguas['NORMA'];
}
?>
<!--//////////// DETERMINACION DE TEMPERATURA EN TERRENO ////////////-->
<table class="table table-bordered" style="font-size: 10px; width:100%">
    <thead>
      <tr>
        <th style="width:50%"><?php echo strtoupper($titulo)?></th>
        <th colspan="2"><?php echo strtoupper($norma)?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($items = mysqli_fetch_assoc($sql_item_aguas)){?>

        <tr>
          <td><?php echo $items['NOMBRE']?></td>
          <td><input type="text" name="<?php echo $items['ID']?>"></td>
          <td><?php echo $items['UM']?></td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td>FECHA DE ENSAYO</td>
        <td colspan="2"><input type="text" name="fecha_ensayo"></td>
      </tr>
    </tbody>
  </tbody>
</table>

<!-- ///////////////////// DETERMINACIÓN DE MATERIA ORGANICA ////////////////-->
<?php
$query_titulo_aguas = "
  SELECT e.id_ensayo AS ID, e.nombre_ensayo AS NOMBRE,  n.nombre_norma_ensayo AS NORMA
  FROM tbl_ensayo e, tbl_norma_ensayo n
  WHERE
  e.id_ensayo = '31' AND
  e.id_norma_ensayo = n.id_norma_ensayo
";

$query_item_aguas = "
  SELECT
    id_ensayo_item AS ID, nombre_ensayo_item AS NOMBRE, unidad_medida_item AS UM
  FROM
    tbl_ensayo_item ei, tbl_tipo_ensayo te
  WHERE
    ei.id_ensayo = '87' AND
    te.id_tipo_ensayo = '3'
";

$sql_titulo_aguas = mysqli_query($link, $query_titulo_aguas) or die('Consulta fallida: '.mysqli_error());;
$sql_item_aguas = mysqli_query($link, $query_item_aguas) or die('Consulta fallida: '.mysqli_error());;

while ($titulo_aguas = mysqli_fetch_assoc($sql_titulo_aguas)) {
  $titulo = $titulo_aguas['NOMBRE'];
  $norma = $titulo_aguas['NORMA'];
}
?>
<!--//////////// DETERMINACION DE TEMPERATURA EN TERRENO ////////////-->
<table class="table table-bordered" style="font-size: 10px; width:100%">
    <thead>
      <tr>
        <th style="width:50%"><?php echo strtoupper($titulo)?></th>
        <th colspan="2"><?php echo strtoupper($norma)?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($items = mysqli_fetch_assoc($sql_item_aguas)){?>

        <tr>
          <td><?php echo $items['NOMBRE']?></td>
          <td><input type="text" name="<?php echo $items['ID']?>"></td>
          <td><?php echo $items['UM']?></td>
        </tr>


      <?php
      }
      ?>
      <tr>
        <td>FECHA DE ENSAYO</td>
        <td colspan="2"><input type="text" name="fecha_ensayo"></td>
      </tr>
    </tbody>
  </tbody>
</table>

<!-- ///////////////////// DETERMINACIÓN DE PH ////////////////-->
<?php
$query_titulo_aguas = "
  SELECT e.id_ensayo AS ID, e.nombre_ensayo AS NOMBRE,  n.nombre_norma_ensayo AS NORMA
  FROM tbl_ensayo e, tbl_norma_ensayo n
  WHERE
  e.id_ensayo = '26' AND
  e.id_norma_ensayo = n.id_norma_ensayo
";

$query_item_aguas = "
  SELECT
    id_ensayo_item AS ID, nombre_ensayo_item AS NOMBRE, unidad_medida_item AS UM
  FROM
    tbl_ensayo_item ei, tbl_tipo_ensayo te
  WHERE
    ei.id_ensayo = '26' AND
    te.id_tipo_ensayo = '3'
";

$sql_titulo_aguas = mysqli_query($link, $query_titulo_aguas) or die('Consulta fallida: '.mysqli_error());;
$sql_item_aguas = mysqli_query($link, $query_item_aguas) or die('Consulta fallida: '.mysqli_error());;

while ($titulo_aguas = mysqli_fetch_assoc($sql_titulo_aguas)) {
  $titulo = $titulo_aguas['NOMBRE'];
  $norma = $titulo_aguas['NORMA'];
}
?>
<!--//////////// DETERMINACION DE TEMPERATURA EN TERRENO ////////////-->
<table class="table table-bordered" style="font-size: 10px; width:100%">
    <thead>
      <tr>
        <th style="width:50%"><?php echo strtoupper($titulo)?></th>
        <th colspan="2"><?php echo strtoupper($norma)?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($items = mysqli_fetch_assoc($sql_item_aguas)){?>

        <tr>
          <td><?php echo $items['NOMBRE']?></td>
          <td><input type="text" name="<?php echo $items['ID']?>"></td>
          <td><?php echo $items['UM']?></td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td>FECHA DE ENSAYO</td>
        <td colspan="2"><input type="text" name="fecha_ensayo"></td>
      </tr>
    </tbody>
  </tbody>
</table>

<!-- ///////////////////// CLORUROS Y SULFATOS ////////////////-->
<?php
$query_titulo_aguas = "
  SELECT e.id_ensayo AS ID, e.nombre_ensayo AS NOMBRE,  n.nombre_norma_ensayo AS NORMA
  FROM tbl_ensayo e, tbl_norma_ensayo n
  WHERE
  e.id_ensayo = '88' AND
  e.id_norma_ensayo = n.id_norma_ensayo
";

$query_item_aguas = "
  SELECT
    id_ensayo_item AS ID, nombre_ensayo_item AS NOMBRE, unidad_medida_item AS UM
  FROM
    tbl_ensayo_item ei, tbl_tipo_ensayo te
  WHERE
    ei.id_ensayo = '88' AND
    te.id_tipo_ensayo = '3'
";

$sql_titulo_aguas = mysqli_query($link, $query_titulo_aguas) or die('Consulta fallida: '.mysqli_error());;
$sql_item_aguas = mysqli_query($link, $query_item_aguas) or die('Consulta fallida: '.mysqli_error());;

while ($titulo_aguas = mysqli_fetch_assoc($sql_titulo_aguas)) {
  $titulo = $titulo_aguas['NOMBRE'];
  $norma = $titulo_aguas['NORMA'];
}
?>
<!--//////////// DETERMINACION DE TEMPERATURA EN TERRENO ////////////-->
<table class="table table-bordered" style="font-size: 10px; width:100%">
    <thead>
      <tr>
        <th style="width:50%"><?php echo strtoupper($titulo)?></th>
        <th colspan="2"><?php echo strtoupper($norma)?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($items = mysqli_fetch_assoc($sql_item_aguas)){?>

        <tr>
          <td><?php echo $items['NOMBRE']?></td>
          <td><input type="text" name="<?php echo $items['ID']?>"></td>
          <td><?php echo $items['UM']?></td>
        </tr>


      <?php
      }
      ?>
      <tr>
        <td>FECHA DE ENSAYO</td>
        <td colspan="2"><input type="text" name="fecha_ensayo"></td>
      </tr>
    </tbody>
  </tbody>
</table>


<!-- ///////////////////// SOLIDOS EN SUSPENSION Y DISUELTOS ////////////////-->
<?php
$query_titulo_aguas = "
  SELECT e.id_ensayo AS ID, e.nombre_ensayo AS NOMBRE,  n.nombre_norma_ensayo AS NORMA
  FROM tbl_ensayo e, tbl_norma_ensayo n
  WHERE
  e.id_ensayo = '30' AND
  e.id_norma_ensayo = n.id_norma_ensayo
";

$query_item_aguas = "
  SELECT
    id_ensayo_item AS ID, nombre_ensayo_item AS NOMBRE, unidad_medida_item AS UM
  FROM
    tbl_ensayo_item ei, tbl_tipo_ensayo te
  WHERE
    ei.id_ensayo = '30' AND
    te.id_tipo_ensayo = '3'
";

$sql_titulo_aguas = mysqli_query($link, $query_titulo_aguas) or die('Consulta fallida: '.mysqli_error());;
$sql_item_aguas = mysqli_query($link, $query_item_aguas) or die('Consulta fallida: '.mysqli_error());;

while ($titulo_aguas = mysqli_fetch_assoc($sql_titulo_aguas)) {
  $titulo = $titulo_aguas['NOMBRE'];
  $norma = $titulo_aguas['NORMA'];
}
?>
<!--//////////// DETERMINACION DE TEMPERATURA EN TERRENO ////////////-->
<table class="table table-bordered" style="font-size: 10px; width:100%">
    <thead>
      <tr>
        <th style="width:50%"><?php echo strtoupper($titulo)?></th>
        <th colspan="2"><?php echo strtoupper($norma)?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($items = mysqli_fetch_assoc($sql_item_aguas)){?>

        <tr>
          <td><?php echo $items['NOMBRE']?></td>
          <td><input type="text" name="<?php echo $items['ID']?>"></td>
          <td><?php echo $items['UM']?></td>
        </tr>

      <?php
      }
      ?>
      <tr>
        <td>FECHA DE ENSAYO</td>
        <td colspan="2"><input type="text" name="fecha_ensayo"></td>
      </tr>
    </tbody>
  </tbody>
</table>
