  <form method="get" action="laboratorio-ensayos/oficina-tecnica/ensayo_porchet_res.php" name="form_porchet" id="form_porchet">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table class="table table-bordered" >
          <tr>
            <td>Fecha de Ensayo</td>
            <td><input type="date" style="width:100%;" class="form-control" name="fecha_ensayo_56[]" id="fecha_ensayo_56" value=""></td>
          </tr>
          <tr>
            <td>Pozo N°</td>
            <td><input type="number" style="width:100%;" class="form-control" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          </tr>
          <tr>
            <td>Cotas (m)</td>
            <td><input type="number" style="width:100%;" class="form-control" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          </tr>
          <tr>
            <td>Infiltraci&oacute;n (mm/hr)</td>
            <td><input type="number" style="width:100%;" class="form-control" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          </tr>
          <tr>
            <td>Observaciones de las mediciones</td>
            <td><input type="text" style="width:100%;" class="form-control" name="<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          </tr>
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
