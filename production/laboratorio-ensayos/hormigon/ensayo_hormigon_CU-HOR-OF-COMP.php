<?php
$QRY12 = "SELECT id_ensayo AS ID, nombre_ensayo_item AS NE, unidad_medida_item AS UM FROM TBL_EnsayoItem WHERE id_ensayo = '12'";
$SQL12 = mysqli_query($link, $QRY12) or die ("Error en QRY12A".mysqli_error($link));;
?>
<form name="form_hormigon_CU" id="form_hormigon_CU-HOR-OF-COMP" method="get" action="laboratorio-ensayos/hormigon/ensayo_hormigon_CU-HOR-OF-COMP_res.php">
  <div class="x_content">
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
      <table class="table table-bordered" style="font-size: 11px; width:100%;" >
              <tr>
                <td width="33%">Masa kg </td>
                <td width="67%">
                  <input class="form-control" type="text" name="MasaKG_CU" id="MasaKG_CU" value="" >
                  </td>
              </tr>
              <tr>
                <td width="33%">Carga PKN </td>
                <td width="67%">
                  <input class="form-control" type="text" name="CargaPKN_CU" id="CargaPKN_CU" value="" >
                  </td>
              </tr>
              <tr>
                <td width="33%">a (mm)</td>
                <td width="67%">
                  <input class="form-control" type="text" name="Ancho_CU" id="Ancho_CU" value="" >
                  </td>
              </tr>
              <tr>
                <td width="33%">b (mm)</td>
                <td width="67%">
                  <input class="form-control" type="text" name="Base_CU" id="Base_CU" value="" >
                  </td>
              </tr>
              <tr>
                <td width="33%">h (mm)</td>
                <td width="67%">
                  <input class="form-control" type="text" name="Altura_CU" id="Altura_CU" value="" >
                  </td>
              </tr>
              <tr>
                <td colspan="2" width="100%"><button type="button" class="btn btn-warning" onclick="CU_calcula()" >Calcular</button></td>
              </tr>
              <tr>
                <td width="33%">CargaPN</td>
                <td width="67%">
                  <input class="form-control" type="text" name="EnsayoItem3" id="CargaPN_CU" value="" READONLY>
                </td>
              </tr>
              <tr>
                <td width="33%">Area (mm2) </td>
                <td width="67%">
                  <input class="form-control" type="text" name="EnsayoItem1" id="Area_CU" value="" READONLY>
                  </td>
              </tr>
              <tr>
                <td width="33%">Volumen(mm3) </td>
                <td width="67%">
                  <input class="form-control" type="text" name="EnsayoItem59" id="Volumen_CU" value="" READONLY>
                  </td>
              </tr>
              <tr>
                <td width="33%">Densidad (kg/m3) </td>
                <td width="67%">
                  <input class="form-control" type="text" name="EnsayoItem2" id="Densidad_CU" value="" READONLY>
                   </td>
              </tr>
              <tr>
                <td width="33%">Rc (MPa) </td>
                <td width="67%">
                  <input class="form-control" type="text" name="EnsayoItem4" id="RcMPa_CU" value="" READONLY>
                  </td>
              </tr>
              <tr>
                <td width="33%">NCh170</td>
                <td width="67%">
                  <input class="form-control" type="text" name="EnsayoItem60" id="NCh170_CU" value="" READONLY>
                  </td>
              </tr>
              <tr>
                <th>Observaciones</th>
                <td><input class="form-control" type="text" class="form-control" id="observaciones_CU" name="observaciones_CU" ></td>
              </tr>
      </table>
    </div>
  </div>

  <input type="hidden" id="NSCU" name="NS" value="">
  <input type="hidden" id="TECU" name="TE" value="">

</form>
<script>


function CU_calcula() { //v3.0
  var MasaKG_CU = document.getElementById('MasaKG_CU').value;
  var CargaPKN_CU = document.getElementById('CargaPKN_CU').value;
  var Ancho_CU = document.getElementById('Ancho_CU').value;
  var Base_CU = document.getElementById('Base_CU').value;
  var Altura_CU = document.getElementById('Altura_CU').value;

  var CargaPN_CU =  parseFloat(CargaPKN_CU) * 1000;
  var Area_CU  = Math.round(parseFloat(Ancho_CU) * parseFloat(Base_CU) * 100)/100;
  var Volumen_CU = Math.round(parseFloat(Altura_CU) * Area_CU* 100)/100;
  var Densidad_CU = Math.round(1000000000 * parseFloat(MasaKG_CU) / Volumen_CU * 100)/100;
  var RcMPa_CU = Math.round(CargaPN_CU / Area_CU * 100)/100;
  var NCh170_CU = Math.round(RcMPa_CU * 0.95 * 100)/100;

  document.getElementById('CargaPN_CU').value = CargaPN_CU;
  document.getElementById('Area_CU').value = Area_CU;
  document.getElementById('Densidad_CU').value = Densidad_CU;
  document.getElementById('Volumen_CU').value = Volumen_CU;
  document.getElementById('RcMPa_CU').value = RcMPa_CU;
  document.getElementById('NCh170_CU').value = NCh170_CU;
}
</script>
