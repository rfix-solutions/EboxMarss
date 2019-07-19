  <form method="get" action="laboratorio-ensayos/elementos/ensayo_elementos_res.php" name="form_elementos" id="form_elementos">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table id="tablas" class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="6">VERIFICACIÓN DE REQUISITOS GEOMETRICOS Y DIMENSIONALES</th>
            <th colspan="2">Codigo MINVU Art. 6.7	- Codigo MINVU Art. 6.7.3.1</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="2">Unidad a Ensayar</td>
            <td colspan="2">1</td>
            <td colspan="2">2</td>
            <td colspan="2">3</td>
          </tr>
          <?php
        //VERIFICACIÓN DE REQUISITOS GEOMETRICOS Y DIMENSIONALES
        $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='92'";
        $sql_a = mysqli_query($link, $query_a);
        while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
          <tr>
            <td><?php echo $item_a['nombre_ensayo_item'];?></td>
            <td><?php echo $item_a['unidad_medida_item']?></td>
            <?php
            for($i=1;$i<=6;$i++){?>
              <td><input type="number" style="width:100%;" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
            <?php
            }?>
          </tr>
        <?php
        }
        ?>
          <tr>
            <td colspan="2">FECHA DE ENSAYO</td>
            <?php
            for($i=1;$i<=3;$i++){?>
            <td colspan="2"><input type="date" style="width:100%;" name="fecha_ensayo_14" id="fecha_ensayo_14" value=""></td>
            <?php
            }?>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="6" style="text-align:center;">
              ENSAYO DE RESISTENCIA A COMPRESIÓN EN TESTIGOS DE SOLERAS CON ZARPA
            </th>
            <th colspan="2">
              Codigo MINVU Art. 6.7.3.2</br>
              NCh 1037 Of 2009	NCh 1171 Of 2012
            </th>
          </tr>
        </thead>
        <tbody>
          <td colspan="2">IDENTIFICACIÓN DE LOS TESTIGOS</td>
          <td>1A</td>
          <td>1B</td>
          <td>2A</td>
          <td>2B</td>
          <td>3A</td>
          <td>3B</td>
          <?php
          //LIMITE ATTERBERG
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='93'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><?php echo $item_a['unidad_medida_item']?></td>
              <?php
              for($i=1;$i<=6;$i++){?>
                <td><input type="number" style="width:100%;" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
              <?php
              }?>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td colspan="2">FECHA DE ENSAYO</td>
            <?php
            for($i=1;$i<=3;$i++){?>
            <td colspan="2"><input type="date" style="width:100%;" name="fecha_ensayo_14" id="fecha_ensayo_14" value=""></td>
            <?php
            }?>
          </tr>
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
            <td style="text-align:left;"><textarea style="width:100%;" name="observaciones" id="observaciones"></textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
  </form>
