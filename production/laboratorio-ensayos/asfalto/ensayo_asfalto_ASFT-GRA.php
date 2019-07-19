<form method="get" action="laboratorio-ensayos/elementos/ensayo_elementos_ASFT-GRA_res.php" name="form_ASFT_GRA" id="form_ASFT_GRA">

  <div class="col-md-12 col-sm-12 col-xs-12">
    <table id="tablas" class="table table-bordered" style="font-size: 10px;">
      <thead style="background: #EDEDED;">
        <tr>
          <th colspan="2">MUESTREO DE MEZCLAS BITUMINOSAS Y	ANÁLISIS GRANULOMÉTRICO DE AGREGADOS PROVENIENTES DE EXTRACCIÓN ASFÁLTICA	</th>
          <th colspan="2">MC Vol 8 - 8.302.27	MC Vol 8 - 8.302.28	</th>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td >TAMIZ</td>
          <td >% ACUMULADO QUE PASA</td>
          <td colspan="2">BANDA DE TRABAJO SEGÚN DISEÑO</td>
        </tr>
        <?php
      //VERIFICACIÓN DE REQUISITOS GEOMETRICOS Y DIMENSIONALES
      $query_a = "
        SELECT
          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
        FROM
          TBL_EnsayoItem
        WHERE
          id_ensayo ='39' and (
          id_ensayo_item = ' 141' OR
          id_ensayo_item = ' 142' OR
          id_ensayo_item = ' 143' OR
          id_ensayo_item = ' 144' OR
          id_ensayo_item = ' 145' OR
          id_ensayo_item = ' 146' OR
          id_ensayo_item = ' 147' OR
          id_ensayo_item = ' 148' OR
          id_ensayo_item = ' 149' OR
          id_ensayo_item = ' 150' OR
          id_ensayo_item = ' 151' OR
          id_ensayo_item = ' 152' OR
          id_ensayo_item = ' 153'
          )";
      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
        <tr>
          <td><?php echo $item_a['nombre_ensayo_item'];?></td>
          <td>
            <input type="number" style="width:100%;" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value="">
          </td>
          <td>
            <input type="number" style="width:100%;" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value="">
          </td>
          <td>
            <input type="number" style="width:100%;" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value="">
        </td>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td >FECHA DE ENSAYO</td>
        <td>
          <input type="date" style="width:100%;" name="fecha_ensayo_39[]" id="fecha_ensayo_39" value="">
        </td>

      </tr>
      </tbody>
    </table>
  </div>

  <div class="col-md-12 col-sm-12 col-xs-12">
    <table id="tablas" class="table table-bordered" style="font-size: 10px;">
      <thead style="background: #EDEDED;">
        <tr>
          <th colspan="2">DETERMINACIÓN DEL CONTENIDO DE BITUMEN EN MEZCLAS ASFÁLTICAS </th>
          <th colspan="2">MC Vol 8 - 8.302.36	</th>
        </tr>
      </thead>
      <tbody>
        <?php
      //RESISTENCIA A FLEXIÓN						Codigo MINVU Art. 6.5.3.2
      $query_a = "
        SELECT
          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
        FROM
          TBL_EnsayoItem
        WHERE
          id_ensayo ='39' and (
          id_ensayo_item = ' 154' OR
          id_ensayo_item = ' 155' OR
          id_ensayo_item = ' 156'
          )";

      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {

        ?>
        <tr>
          <td><?php echo $item_a['nombre_ensayo_item'];?></td>
          <?php
          if($item_a['id_ensayo_item'] == '155'){?>
            <td><input type="number" style="width:100%;" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
            <td><input type="number" style="width:100%;" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          <?php
          }
          else{?>
            <td colspan="2"><input type="number" style="width:100%;" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          <?php
          }?>
        </tr>
      <?php
      }
      ?>
      <tr>
        <td >FECHA DE ENSAYO</td>
        <td colspan="2">
          <input type="date" style="width:100%;" name="fecha_ensayo_39[]" id="fecha_ensayo_39" value="">
        </td>

      </tr>
      </tbody>
    </table>
  </div>


  <div class="col-md-12 col-sm-12 col-xs-12">
    <table id="tablas" class="table table-bordered" style="font-size: 10px;">
      <tbody>
        <?php
      //RESISTENCIA A FLEXIÓN	Codigo MINVU Art. 6.5.3.2
      $query_a = "
      SELECT
        id_ensayo_item, nombre_ensayo_item, unidad_medida_item
      FROM
        TBL_EnsayoItem
      WHERE
        id_ensayo ='39' AND
        id_ensayo_item = ' 157'
        ";

      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
        <tr>
          <td><?php echo $item_a['nombre_ensayo_item'];?></td>
          <td><input type="number" style="width:100%;" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
        </tr>
      <?php
      }
      ?>

      </tbody>
    </table>
  </div>




  <div class="col-md-12 col-sm-12 col-xs-12">
    <table class="table table-bordered" style="font-size: 10px;">
      <thead style="background: #EDEDED;">
        <tr>
          <th style="text-align:center;">Observaciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align:left;"><textarea style="width:100%;" name="observaciones_EL" id="observaciones_EL"></textarea></td>
        </tr>
      </tbody>
    </table>
  </div>
  <input type="hidden" id="NSAG" name="NS" value="">
  <input type="hidden" id="TEAG" name="TE" value="">
</form>
