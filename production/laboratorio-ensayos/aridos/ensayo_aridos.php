<form method="get" action="laboratorio-ensayos/aridos/ensayo_aridos_res.php" name="form_arido" id="form_arido">
  <div class="col-md-5 col-sm-6 col-xs-12" style="margin-top:10px;">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <table id="tablas" class="table table-bordered" style="font-size: 10px;">
          <thead style="background: #EDEDED;">
            <tr>
              <th>Granulometr&iacute;a</th>
              <th>NCh 164 Of 09	</br>NCh 165 Of 09</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="width:60%" >Tamiz</td>
              <td>% Acumulado que pasa</td>
            </tr>

          <?php
          //GRANULOMETRIA
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='32'";
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
            <td><input type="date" style="width:100%" name="fecha_ensayo_32" id="fecha_ensayo_32" value=""></td>
          </tr>

        </tbody>
      </table>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="2" style="text-align:center;">MATERIAL FINO MENOR A 0,080 mm </th><th>NCh 1223 Of 77		</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='68'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td colspan="2"><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td colspan="2">FECHA DE ENSAYO</td>
            <td><input type="date" style="width:100%" name="fecha_ensayo_68" id="fecha_ensayo_68" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="2" style="text-align:center;">DETERMINACIÓN DE LAS SALES SOLUBLES TOTALES</th><th>MC Vol 8 - 8.202.14	</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='35'";
          $sql_a = mysqli_query($link, $query_a);
          while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
            <tr>
              <td colspan="2"><?php echo $item_a['nombre_ensayo_item'];?></td>
              <td><input type="text" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <td colspan="2">FECHA DE ENSAYO</td>
            <td><input type="date" style="width:100%" name="fecha_ensayo_35" id="fecha_ensayo_35" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="2" style="text-align:center;">DETERMINACIÓN DEL EQUIVALENTE DE ARENA</th><th>NCh 1325 Of 10	</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='77'";
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
            <td colspan="2"><input type="date" style="width:100%" name="fecha_ensayo_77" id="fecha_ensayo_77" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="2" style="text-align:center;">DESGASTE POR MÉTODO DE LOS ÁNGELES</th><th>NCh 1369 Of 10</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='73'";
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
            <td >FECHA DE ENSAYO</td>
            <td colspan="2"><input type="date" style="width:100%" name="fecha_ensayo_73" id="fecha_ensayo_73" value=""></td>
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
          <th colspan="3" style="text-align:center;">DENSIDAD REAL, NETA Y ABSORCIÓN DE AGUA </br>NCh 1239 Of 09
		NCh 1117 Of 10</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='89'";
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
          <td colspan="2"><input type="date" style="width:100%" name="fecha_ensayo_89" id="fecha_ensayo_89" value=""></td>
        </tr>
      </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
      <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">
            DETERMINACIÓN DE CARBON Y LIGNITO</br>ASTM C123 / C123M-14
          </th>
        </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='81'";
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
            <td colspan="2"><input type="date" style="width:100%" name="fecha_ensayo_81" id="fecha_ensayo_81" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="3" style="text-align:center;">CLORUROS Y SULFATOS</br>NCh 1444/1 Of 10</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='79'";
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
            <td colspan="2"><input type="date" style="width:100%" name="fecha_ensayo_79" id="fecha_ensayo_79" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
          <tr>
            <th colspan="3" style="text-align:center;">DESINTEGRACIÓN MEDIANTE SALES DE SULFATO</br>NCh 1328 Of 77 MC Vol 8 - 8.202.7</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='90'";
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
            <td colspan="2"><input type="date" style="width:100%" name="fecha_ensayo_90" id="fecha_ensayo_90" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">PARTICULAS DESMENUZABLES</br>NCh 1327 Of 77</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='76'";
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
            <td colspan="2"><input type="date" style="width:100%" name="fecha_ensayo_76" id="fecha_ensayo_76" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">CONTENIDO IMPUREZAS ORGÁNICAS</br>NCh 166 Of 09</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='80'";
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
            <td colspan="2"><input type="date" style="width:100%" name="fecha_ensayo_80" id="fecha_ensayo_80" value=""></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" style="font-size: 10px;">
        <thead style="background: #EDEDED;">
        <tr>
          <th colspan="3" style="text-align:center;">DENSIDAD APARENTE COMPACTADA Y SUELTA</br>NCh 1116 Of 08</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $query_a = "SELECT id_ensayo_item, nombre_ensayo_item, unidad_medida_item FROM `TBL_EnsayoItem`where id_ensayo ='69' or id_ensayo = '86'";
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
            <td colspan="2"><input type="date" style="width:100%" name="fecha_ensayo_80" id="fecha_ensayo_80" value=""></td>
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
</form>
