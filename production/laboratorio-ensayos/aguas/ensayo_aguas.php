<form name="form_aguas" id="form_aguas" method="get" action="laboratorio-ensayos/aguas/ensayo_aguas_res.php">
  <!-- ///////////////////// Espesor Asfalto////////////////-->

<div class="col-md-6 col-sm-6 col-xs-12">
  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <thead style="background: #EDEDED;">
      <tr>
        <th colspan="3">DETERMINACIÓN DE TEMPERATURA EN TERRENO</br>(No acreditado)</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //Determinacion de Temperatura en Terreno
      $query_a = "
          SELECT
            id_ensayo_item, nombre_ensayo_item, unidad_medida_item
          FROM
            TBL_EnsayoItem
          WHERE
            id_ensayo ='87'
        ";
      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
        <tr>
          <td><?php echo $item_a['nombre_ensayo_item'];?></td>
          <td><input type="number" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          <td><?php echo $item_a['unidad_medida_item']?></td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td >FECHA ENSAYO</td>
        <td colspan="2"><input style="width:100%;" type="date" name="fecha_ensayo_87" id="fecha_ensayo_87" value=""></td>
      </tr>
    </tbody>
  </table>

  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <thead style="background: #EDEDED;">
      <tr>
        <th colspan="3">DETERMINACIÓN DE MATERIA ORGANICA</br>(NCh 1498 Of 2012)</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //DETERMINACIÓN DE MATERIA ORGANICA
      $query_a = "
        SELECT
          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
        FROM
          TBL_EnsayoItem
        WHERE
          id_ensayo ='31'";
      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
        <tr>
          <td><?php echo $item_a['nombre_ensayo_item'];?></td>
          <td><input type="number" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          <td><?php echo $item_a['unidad_medida_item']?></td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td >FECHA ENSAYO</td>
        <td colspan="2"><input style="width:100%;" type="date" name="fecha_ensayo_31" id="fecha_ensayo_31"  value=""></td>
      </tr>
    </tbody>
  </table>


  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <thead style="background: #EDEDED;">
      <tr>
        <th colspan="3">DETERMINACIÓN DE PH</br>(NCh 413 Of 1963)</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //DETERMINACIÓN DE PH
      $query_a = "
        SELECT
          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
        FROM
          TBL_EnsayoItem
        WHERE
          id_ensayo ='26'";
      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
        <tr>
          <td><?php echo $item_a['nombre_ensayo_item'];?></td>
          <td><input type="number" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          <td><?php echo $item_a['unidad_medida_item']?></td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td >FECHA ENSAYO</td>
        <td colspan="2"><input style="width:100%;" type="date" name="fecha_ensayo_26" id="fecha_ensayo_31" value=""></td>
      </tr>
    </tbody>
  </table>

</div>
<div class="col-md-6 col-sm-6 col-xs-12">
  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <thead style="background: #EDEDED;">
      <tr>
        <th colspan="3">DETERMINACIÓN DE CLORUROS</br>(NCh 1444/1 Of 2010 y NCh 1498 Of 2012)</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //DETERMINACIÓN DE CLORUROS
      $query_a = "
        SELECT
          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
        FROM
          TBL_EnsayoItem
        WHERE
          id_ensayo ='28'";
      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
        <tr>
          <td><?php echo $item_a['nombre_ensayo_item'];?></td>
          <td><input type="number" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          <td><?php echo $item_a['unidad_medida_item']?></td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td >FECHA ENSAYO</td>
        <td colspan="2"><input style="width:100%;" type="date" name="fecha_ensayo_28" id="fecha_ensayo_28" value=""></td>
      </tr>
    </tbody>
  </table>

  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <thead style="background: #EDEDED;">
      <tr>
        <th colspan="3">DETERMINACIÓN DE SULFATOS</br>(NCh 1444/1 Of 2010)</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //DETERMINACIÓN DE SULFATOS
      $query_a = "
        SELECT
          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
        FROM
          TBL_EnsayoItem
        WHERE
          id_ensayo ='29'";
      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
        <tr>
          <td><?php echo $item_a['nombre_ensayo_item'];?></td>
          <td><input type="number" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          <td><?php echo $item_a['unidad_medida_item']?></td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td >FECHA ENSAYO</td>
        <td colspan="2"><input style="width:100%;" type="date" name="fecha_ensayo_29" id="fecha_ensayo_29" value=""></td>
      </tr>
    </tbody>
  </table>

  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <thead style="background: #EDEDED;">
      <tr>
        <th colspan="3">SOLIDOS EN SUSPENSIÓN Y  DISUELTOS</br> (NCh 416 Of 1963)</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //SOLIDOS EN SUSPENSIÓN Y  DISUELTOS
      $query_a = "
        SELECT
          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
        FROM
          TBL_EnsayoItem
        WHERE
          id_ensayo ='30'";
      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
        <tr>
          <td><?php echo $item_a['nombre_ensayo_item'];?></td>
          <td><input type="number" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          <td><?php echo $item_a['unidad_medida_item']?></td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td >FECHA ENSAYO</td>
        <td colspan="2"><input style="width:100%;" type="date" name="fecha_ensayo_30" id="fecha_ensayo_30" value=""></td>
      </tr>
    </tbody>
  </table>

</div>
<div class="col-md-12 col-sm-12 col-xs-12">

  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <thead style="background: #EDEDED;">
    <tr>
      <th>OBSERVACIONES</th>
    </tr>
  </thead>
    <tr>
      <td><textarea class="form-control" name="observaciones"></textarea></td>
    </tr>
  </table>
  <input type="hidden" id="NS" name="NS" value="">
  <input type="hidden" id="TE" name="TE" value="1">
</div>

<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->
<div class="modal fade bs-example-modal-sm" id="MODAL_CONFIRMAR" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="MODAL_TITULO_CONFIRMAR">Confirmación</h4>
      </div>
      <div class="modal-body">
        ¿Esta seguro de continuar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <input type="hidden" id="NS" name="NS" value="">
        <input type="hidden" id="TE" name="TE" value="2">
        <button type="submit" id="confirmar" value="2" class="btn btn-success" onclick="envia_form()">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<!-- ///////////////////////////////////////////////////// CONFIRMACION ///////////////////////////////////////////////////// -->
</form>
