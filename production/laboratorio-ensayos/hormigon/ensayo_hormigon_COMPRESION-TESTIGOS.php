<form name="form_hormigon_TH" id="form_hormigon" method="get" action="laboratorio-ensayos/hormigon/ensayo_hormigon_COMPRESION-TESTIGOS_res.php">
  <table class="table table-bordered" style="font-size: 10px; width:100%">
    <thead style="background: #EDEDED;">
      <tr>
        <th>Resultados</th>
      </tr>
    </thead>
    <?php
    //RESULTADOS DE TESTIGOS DE HORMIGÓN
    $QRY_91 = "
        SELECT
          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
        FROM
          TBL_EnsayoItem
        WHERE
          id_ensayo_item = '78' OR
          id_ensayo_item = '79' OR
          id_ensayo_item = '80'
      ";
    $SQL_91 = mysqli_query($link, $QRY_91);
    while ($item_a = mysqli_fetch_assoc($SQL_91)) {?>
      <tr>
        <td><?php echo $item_a['nombre_ensayo_item'];?></td>
      </tr>
      <tr>
        <td><input type="text" class="form-control" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>[]" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
      </tr>
    <?php
    }
    ?>
    </tbody>
  </table>

  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <thead style="background: #EDEDED;">
      <tr>
        <th colspan="<?php echo $QMuestras+2; ?>">EXTRACCIÓN Y DETERMINACIÓN DE ESPESOR EN TESTIGOS DE HORMIGÓN </br> NCh 1172 Of 2010	 NCh 1037 Of 2009	</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2">TESTIGO NUMERO</td>
        <?php
        for($i=1; $i<=$QMuestras; $i++){?>
        <td><?php echo $i;?></td>
        <?php
        }
        ?>

      </tr>

      <?php
      //EXTRACCIÓN Y DETERMINACIÓN DE ESPESOR EN TESTIGOS DE HORMIGÓN
      $query_a = "
          SELECT
            id_ensayo_item, nombre_ensayo_item, unidad_medida_item
          FROM
            TBL_EnsayoItem
          WHERE
            id_ensayo_item = '67'
        ";
      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {?>
        <tr>
          <td style="width:35%;"><?php echo $item_a['nombre_ensayo_item'];?></td>
          <td style="width:5%;"><?php echo $item_a['unidad_medida_item'];?></td>
          <?php
          for($i=1; $i<=$QMuestras; $i++){?>
          <td><input type="number" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>[]" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
          <?php
          }
          ?>



        </tr>
      <?php
      }
      ?>
      <tr>
        <td colspan="2" >Fecha Ensayo</td>
        <?php
        for($i=1; $i<=$QMuestras; $i++){?>
        <td><input style="width:50%;" type="date" name="fecha_ensayo_4[]" value=""></td>
        <?php
        }

        ?>
      </tr>
    </tbody>
  </table>

  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <thead style="background: #EDEDED;">
      <tr>
        <th colspan="<?php echo $QMuestras+2;?>">ENSAYO DE COMPRESIÓN EN TESTIGOS DE HORMIGÓN</br>NCh 1171 Of 2012</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //ENSAYO DE COMPRESIÓN EN TESTIGOS DE HORMIGÓN
      $query_a = "
      SELECT
        id_ensayo_item, nombre_ensayo_item, unidad_medida_item
      FROM
        TBL_EnsayoItem
      WHERE
        id_ensayo = '5'

      ";
      $sql_a = mysqli_query($link, $query_a);
      while ($item_a = mysqli_fetch_assoc($sql_a)) {
        if($item_a['id_ensayo_item'] != '67' && $item_a['id_ensayo_item'] != '78' && $item_a['id_ensayo_item'] != '79' && $item_a['id_ensayo_item'] != '80' && $item_a['id_ensayo_item'] != '81' ){

          ?>
          <tr>
            <td style="width:35%;"><?php echo $item_a['nombre_ensayo_item'];?></td>
            <td style="width:5%;"><?php echo $item_a['unidad_medida_item']?></td>
            <?php
            for($i=1; $i<=$QMuestras; $i++){?>
            <td><input type="number" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>[]" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
            <?php
            }
            ?>
          </tr>
        <?php
        }
      }
      ?>
      <tr>
        <td colspan="2">Fecha Ensayo</td>
        <?php
        for($i=1; $i<=$QMuestras; $i++){?>
        <td><input style="width:50%;" type="date" name="fecha_ensayo_5[]" value=""></td>
        <?php
        }
        ?>



      </tr>
    </tbody>
  </table>




  <table class="table table-bordered" style="font-size: 10px; width:100%;" >
    <?php
    $QRY_9191 = "
        SELECT
          id_ensayo_item, nombre_ensayo_item, unidad_medida_item
        FROM
          TBL_EnsayoItem
        WHERE
          id_ensayo ='91' AND id_ensayo_item = '91'
      ";
    $SQL_9191 = mysqli_query($link, $QRY_9191);
    while ($item_a = mysqli_fetch_assoc($SQL_9191)) {?>
      <thead style="background: #EDEDED;">
      <tr>
        <td><?php echo $item_a['nombre_ensayo_item'];?></td>
      </tr>
      </thead>
      <tr>
        <td><input type="text" class="form-control" name="EnsayoItem<?php echo $item_a['id_ensayo_item']?>" id="<?php echo $item_a['id_ensayo_item']?>" value=""></td>
      </tr>
    <?php
    }
    ?>
  </table>

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
  <input type="hidden" id="NSCT" name="NS" value="">
  <input type="hidden" id="TECT" name="TE" value="">
  <input type="hidden" id="QM" name="QM" value="<?php echo $QMuestras;?>">


</form>
