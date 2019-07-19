<form name="form_hormigon_CI" id="form_hormigon_CU-HOR-OF-COMP" method="get" action="laboratorio-ensayos/hormigon/ensayo_hormigon_CU-HOR-OF-COMP_res.php">
  <div class="x_content">
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
      <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Masa (Kg)</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" tabindex="1" value=""  name="EnsayoItem114" id="MasaKG_CI" >
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Carga PN</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" value="" name="EnsayoItem61" id="CargaPN_CI" READONLY>
        </div>

        <label class="control-label col-md-2 col-sm-2 col-xs-12">Carga PKN</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" tabindex="2" value=""  name="EnsayoItem115" id="CargaPkn_CI" >
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Area (mm2)</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" value="" name="EnsayoItem62" READONLY id="Area_CI">
        </div>

        <label class="control-label col-md-2 col-sm-2 col-xs-12">d (mm)</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" tabindex="3" value=""  name="EnsayoItem116" id="Dmm_CI">
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Volumen (mm3)</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" value="" name="EnsayoItem66" READONLY id="Volumen_CI">
        </div>

        <label class="control-label col-md-2 col-sm-2 col-xs-12">h (mm)</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" tabindex="4" value=""  name="EnsayoItem116" id="Hmm_CI">
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Densidad (kg/m3)</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" name="EnsayoItem63" value="" READONLY id="Densidad_CI">
        </div>

        <label class="control-label col-md-2 col-sm-2 col-xs-12">Fecha Ensayo</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="date" tabindex="5" name="fecha_ensayo_11" id="CI_FechaEnsayo" value="<?php echo date("Y-m-d"); ?>">
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Rc (MPa)</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" name="EnsayoItem64" value="" READONLY id="RcMPa_CI">
        </div>

        <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <button type="button" class="btn btn-warning" tabindex="6" onclick="CI_calcula()" >Calcular</button>
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">K2</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="text" name="EnsayoItem65" value="" READONLY id="K2_CI">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Oservaciones</label>
        <textarea class="form-control rounded-0" tabindex="7" id="CI_observaciones" name="observaciones" rows="2"></textarea>
      </div>
      <input type="hidden" id="NSCI" name="NS" value="">
      <input type="hidden" id="TECI" name="TE" value="">
    </div>
  </div>
</form>
<script>
function CI_calcula() {
  var i;
  var K = new Array(20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50);
  var C = new Array(1.250,1.240,1.230,1.220,1.210,1.200,1.194,1.188,1.182,1.176,1.170,1.164,1.158,1.152,1.146,1.140,1.138,1.136,1.134,1.132,1.130,1.126,1.122,1.118,1.114,1.110,1.108,1.106,1.104,1.102,1.100);
  var MasaKG_CI = document.getElementById("MasaKG_CI").value;
  var CargaPkn_CI = document.getElementById("CargaPkn_CI").value;
  var Dmm_CI = document.getElementById("Dmm_CI").value;
  var Hmm_CI = document.getElementById("Hmm_CI").value;

  var Area_CI = Math.round(Math.pow((parseFloat(Dmm_CI) / 2),2) * Math.PI * 100)/100;
  var CargaPN_CI =  parseFloat(CargaPkn_CI) * 1000;
  var Volumen_CI = Math.round(parseFloat(Hmm_CI) * Area_CI * 100)/100;

  var Densidad_CI = Math.round(1000000000 * parseFloat(MasaKG_CI) / Volumen_CI * 100)/100;
  var RcMPa_CI = Math.round(CargaPN_CI / Area_CI * 100)/100;
  i= Math.round(RcMPa_CI/1);
  if (i<20) i=20;
  if (i>50) i=50;
  i=i - 20;
  var K2_CI = Math.round(RcMPa_CI * C[i] * 100)/100;
  document.getElementById("CargaPN_CI").value = CargaPN_CI;
  document.getElementById("Area_CI").value  = Area_CI;
  document.getElementById("Volumen_CI").value = Volumen_CI;
  document.getElementById("Densidad_CI").value = Densidad_CI;
  document.getElementById("RcMPa_CI").value = RcMPa_CI;
  document.getElementById("K2_CI").value = K2_CI;
}

</script>
