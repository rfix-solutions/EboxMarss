<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '32' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '32' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td >TAMIZ</td>
        <td>% ACUMULADO QUE PASA	</td>
      </tr>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>

<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '68' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '68' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>



<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '35' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '35' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>


<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '36' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '36' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>



<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '89' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '89' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>


<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '81' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '81' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>



<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '79' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '79' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>

<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '90' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '90' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>


<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '76' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '76' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>


<table class="table table-bordered" style="font-size: 10px;">
    <thead>
      <?php
      ///////////////////// Granulometria (ARIDOS) ////////////////

      $query_ensayo_nombre = "
      SELECT
        e.nombre_ensayo AS NOMBRE, n.nombre_norma_ensayo AS NORMA
      FROM
        tbl_ensayo e, tbl_norma_ensayo n
      WHERE
        e.id_ensayo = '80' AND
        e.id_norma_ensayo = n.id_norma_ensayo
      ";

      $query_ensayo_items = "
      SELECT
        i.nombre_ensayo_item NOMBRE
      FROM
        tbl_norma_ensayo n, tbl_ensayo e, tbl_ensayo_item i
      WHERE
        e.id_ensayo = '80' AND
        e.id_norma_ensayo = n.id_norma_ensayo AND
        i.id_ensayo = e.id_ensayo
      ";

      $result_ensayo_items = mysqli_query($link,$query_ensayo_items);
      $result_ensayo_nombre = mysqli_query($link,$query_ensayo_nombre);
      while ($fila = mysqli_fetch_assoc($result_ensayo_nombre)) {
        $nombre_ensayo = $fila['NOMBRE'];
        $norma_ensayo = $fila['NORMA'];
      }
      ?>
      <tr>
        <th style="width:50%;"><?php echo strtoupper($nombre_ensayo); ?></th>
        <th><?php echo strtoupper($norma_ensayo); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($filas = mysqli_fetch_assoc($result_ensayo_items)){?>
        <tr>
          <td><?php echo strtoupper($filas['NOMBRE']);?></td>
          <td><input type="text" name="<?php echo $filas['NOMBRE']?>"></td>
        </tr>
      <?php
      }?>
    <tr>
      <td> FECHA DE ENSAYO</td>
      <td><input type="text" name="fecha_ensayo" value="<?php echo date("Y-m-d");?>"></td>
    </tr>
  </tbody>
</table>
