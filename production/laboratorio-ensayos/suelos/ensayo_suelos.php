
<!-- SECCION 3-->
<div class="x_content">
  <form method="get" action="laboratorio-ensayos/suelos/ensayo_suelos_res.php" name="form_suelo" id="form_suelo">
  <div class="col-md-5 col-sm-6 col-xs-12" style="margin-top:10px;">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <table id="tablas" class="table table-bordered" style="font-size: 10px;">
          <thead style="background: #EDEDED;">
            <tr>
              <th>Granulometr&iacute;a</th>
              <th>MC Vol 8 - 8.202.2</br>MC Vol 8 - 8.102.1	</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="width:60%" >Tamiz</td>
              <td>% Acumulado que pasa</td>
            </tr>

          <?php
          //GRANULOMETRIA
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='14'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><input type="number" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td>FECHA DE ENSAYO</td>
            <td><input type="date" name="fecha_ensayo_14" id="fecha_ensayo_14" value=""></td>
          </tr>

        </tbody>
      </table>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">LIMITES DE ATTERBERG NCh 1517/1 Of 79 - NCh 1517/2 Of 79	</th>
        </tr>
        </thead>
        <tbody>
          <?php
          //LIMITE ATTERBERG
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='15'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td>FECHA DE ENSAYO</td>
            <td><input type="date" name="fecha_ensayo_15" id="fecha_ensayo_15" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">CLASIFICACIÓN DE SUELOS (No acreditable)</th>
        </tr>
        </thead>
        <tbody>
          <?php
          //CLASIFICACION USCS / AASHTO
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='16'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td>FECHA DE ENSAYO</td>
            <td><input type="date" name="fecha_ensayo_16" id="fecha_ensayo_16" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">CUBICIDAD DE PARTÍCULAS MC Vol 8 - 8.202.6</th>
        </tr>
        </thead>
        <tbody>
          <?php
          //CUBICIDAD DE PARTICULAS
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='20'";
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
            <td>FECHA DE ENSAYO</td>
            <td colspan="2"><input type="date" name="fecha_ensayo_20" id="fecha_ensayo_20" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>



  </div>
<!-- SECCION 4 -->
  <div class="col-md-7 col-sm-6 col-xs-12" style="margin-top:10px;">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
      <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">RELACIÓN HUMEDAD/DENSIDAD PROCTOR MODIFICADO NCh 1534/2 Of 79	</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //PROCTOR MODIFICADO
        $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='17'";
        $sql_a = mysqli_query($link, $query_a);
        while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
          <tr>
            <td><?php echo $item_a['nombre_ensayo_item'];?></td>
            <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
            <td><?php echo $item_a['unidad_medida_item']?></td>
          </tr>
        <?php
        }
        ?>
        <tr>
          <td>FECHA DE ENSAYO</td>
          <td colspan="2"><input type="date" name="fecha_ensayo_17" id="fecha_ensayo_17" value=""></td>
        </tr>
      </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
      <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">
            DETERMINACIÓN DE LA RAZÓN DE SOPORTE C.B.R	NCh 1852 Of 81</br>
            DETERMINACIÓN DE LAS HUMEDADES DE LA MUESTRA	NCh 1515 Of 79
          </th>
        </tr>
        </thead>
        <tbody>
          <?php
          //CBR y HUMEDAD
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='18'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
              <td><?php echo $item_a['unidad_medida_item']?></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td>FECHA DE ENSAYO</td>
            <td colspan="2"><input type="date" name="fecha_ensayo_18" id="fecha_ensayo_18" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="3" style="text-align:center;">DETERMINACIÓN DEL EQUIVALENTE DE ARENA	NCh 1325 Of 10</th>
          </tr>
        </thead>
        <tbody>
          <?php
          //EQUIVALENTE DE ARENA
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='22'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
              <td><?php echo $item_a['unidad_medida_item']?></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td>FECHA DE ENSAYO</td>
            <td colspan="2"><input type="date" name="fecha_ensayo_22" id="fecha_ensayo_2" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="3" style="text-align:center;">DESGASTE POR MÉTODO DE LOS ÁNGELES	NCh 1369 Of 10</th>
          </tr>
        </thead>
        <tbody>
          <?php
          //DESGASTE LOS ANGELES
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='19'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
              <td><?php echo $item_a['unidad_medida_item']?></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td>FECHA DE ENSAYO</td>
            <td colspan="2"><input type="date" name="fecha_ensayo_19" id="fecha_ensayo_19" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">DENSIDAD DE PARTÍCULAS SOLIDAS TOTALES NCh 1532 Of 80</th>
        </tr>
        </thead>
        <tbody>
          <?php
          //DENSIDAD DE PARTICULAS SOLIDAS
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='21'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
              <td><?php echo $item_a['unidad_medida_item']?></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td>FECHA DE ENSAYO</td>
            <td colspan="2"><input type="date" name="fecha_ensayo_21" id="fecha_ensayo_21" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-sm-12 col-md-12 col-xs-12">
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
</div>
