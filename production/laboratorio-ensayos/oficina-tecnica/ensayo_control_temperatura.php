  <form method="get" action="laboratorio-ensayos/oficina-tecnica/ensayo_control_temperatura_res.php" name="form_control_temperatura" id="form_control_temperatura">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table id="tablas" class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="4">REFERENCIAS:</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>CONTROLES REFERIDOS A INFORME (S)</td>
            <td><input type="text" name="referencia_1" class="form-control" style="width:100%;"></td>
            <td><input type="text" name="referencia_2" class="form-control" style="width:100%;"></td>
            <td><input type="text" name="referencia_3" class="form-control" style="width:100%;"></td>
          </tr>
          <tr>
            <td>EQUIPO DE CONO DE ARENA UTILIZADO	</td>
            <td colspan="3"><input type="text" name="densimetro" class="form-control" style="width:100%;"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th>DENSIDAD</th>
            <th colspan="6" style="text-align:center;">
              Densidad en terreno, metodo Cono de Arena
            </th>
            <th colspan="2">
              NCh 1516 Of 1979
            </th>
          </tr>
        </thead>
        <tbody>
          <td>CONTROL N°</td>
          <?php
          for($i=1; $i<=8; $i++){?>
            <td><?php echo $i;?></td>
          <?php
          }
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='95'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td>
                <?php echo $item_a['nombre_ensayo_item'];?>
                <?php echo $item_a['unidad_medida_item']?>
              </td>
              <?php
              for($i=1; $i<=8; $i++){?>
                <td><input type="number" style="width:100%;" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
              <?php
              }?>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td>FECHA DE CONTROL</td>
            <td colspan="8"><input type="date" style="width:100%;" class="form-control" name="fecha_ensayo_95" id="fecha_ensayo_95" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="2" style="text-align:left;">UBICACI&Oacute;N</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for($i=1; $i<=8; $i++){?>
          <tr>
            <td style="text-align:center;"><?php echo $i;?></td>
            <td><input type="text" style="width:100%;" name="ubicacion_<?php echo $i;?>" id="ubicacion_<?php echo $i;?>" value=""></td>
          </tr>
          <?php
          }?>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th style="text-align:center;">OBSERVACIONES</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="text-align:left;"><textarea style="width:100%;" name="observaciones" id="observaciones"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
  </form>
