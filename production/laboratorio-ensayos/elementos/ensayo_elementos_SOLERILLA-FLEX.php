  <form method="get" action="laboratorio-ensayos/elementos/ensayo_elementos_SOLERILLA_FLEX_res.php" name="form_SOLERILLA_FLEX" id="form_SOLERILLA_FLEX">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table id="tablas" class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="2">VERIFICACIÓN DE REQUISITOS GEOMETRICOS Y DIMENSIONALES</th>
            <th colspan="2">Codigo MINVU Art. 6.7	- Codigo MINVU Art. 6.7.3.1</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="2">UNIDAD A ENSAYAR</td>
            <td colspan="2">1</td>
          </tr>
          <?php
        //VERIFICACIÓN DE REQUISITOS GEOMETRICOS Y DIMENSIONALES
        $query_a = "
          SELECT
            id_ensayo_item, nombre_ensayo_item, unidad_medida_item
          FROM
            TBL_EnsayoItem
          WHERE
            id_ensayo ='49' and (
            id_ensayo_item = '134' OR
            id_ensayo_item = '135' OR
            id_ensayo_item = '136' OR
            id_ensayo_item = '137' OR
            id_ensayo_item = '138'
            )";
        $sql_a = mysqli_query($link, $query_a);
        while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
          <tr>
            <td><?php echo $item_a['nombre_ensayo_item'];?></td>
            <td><?php echo $item_a['unidad_medida_item']?></td>
            <td><input type="number" style="width:100%;" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>

          </tr>
        <?php
        }
        ?>

        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table id="tablas" class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="2">RESISTENCIA A FLEXIÓN</th>
            <th colspan="2">Codigo MINVU Art. 6.5.3.2</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="2">UNIDAD A ENSAYAR</td>
            <td colspan="2">1</td>
          </tr>
          <?php
        //RESISTENCIA A FLEXIÓN						Codigo MINVU Art. 6.5.3.2
        $query_a = "
          SELECT
            id_ensayo_item, nombre_ensayo_item, unidad_medida_item
          FROM
            TBL_EnsayoItem
          WHERE
            id_ensayo ='49' and (
            id_ensayo_item = ' 139' OR
            id_ensayo_item = ' 140'
            )";

        $sql_a = mysqli_query($link, $query_a);
        while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
          <tr>
            <td><?php echo $item_a['nombre_ensayo_item'];?></td>
            <td><?php echo $item_a['unidad_medida_item']?></td>
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
        <tr>
          <td >FECHA DE ENSAYO</td>
          <td ><input type="date" style="width:100%;" name="fecha_ensayo_47" id="fecha_ensayo_49" value=""></td>
        </tr>
      </table>
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
    <input type="hidden" id="NSSF" name="NS" value="">
    <input type="hidden" id="TESF" name="TE" value="">
  </form>
