
<form name="form_hormigon_RI" id="form_hormigon_RI-HOR-OF-COMP" method="get" action="laboratorio-ensayos/hormigon/ensayo_hormigon_RI-HOR-OF_res.php">
  <div class="x_content">
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
      <div class="form-group">
      	<label class="control-label col-md-2 col-sm-2 col-xs-12">Masa kg</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem103" id="RI_Masa">
    		</div>
      	<label class="control-label col-md-2 col-sm-2 col-xs-12">Carga KGF</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem108" id="RI_CargaKGF" readonly>
    		</div>

      	<label class="control-label col-md-2 col-sm-2 col-xs-12">Carga PKN</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem104" id="RI_CargaPKN">
    		</div>
      	<label class="control-label col-md-2 col-sm-2 col-xs-12">Densidad (Kg/M3)</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem109" id="RI_Densidad" readonly>
    		</div>

      	<label class="control-label col-md-2 col-sm-2 col-xs-12">Ancho (mm)</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem105" id="RI_Ancho">
    		</div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Volumen (mm3)</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem110" id="RI_Volumen" readonly>
    		</div>

      	<label class="control-label col-md-2 col-sm-2 col-xs-12">Base (mm)</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem106" id="RI_Base">
    		</div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Resistencia (Mpa)</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem111" id="RI_Resistencia" readonly>
    		</div>

      	<label class="control-label col-md-2 col-sm-2 col-xs-12">Altura (mm)</label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input class="form-control" type="text" name="EnsayoItem107" id="RI_Altura" value="">
    		</div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">NCh 170</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem112" id="RI_Nch170" readonly>
    		</div>

        <label class="control-label col-md-2 col-sm-2 col-xs-12">Fecha Ensayo</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input class="form-control" type="date" name="fecha_ensayo_10" id="RI_FechaEnsayo" value="<?php echo date("Y-m-d"); ?>">
    		</div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Area (mm2)</label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12">
        	<input class="form-control" type="text" name="EnsayoItem113" id="RI_Area" readonly>
    		</div>


        <label class="control-label col-md-8 col-sm-2 col-xs-12"></label>
        <div class="input-group col-md-4 col-sm-4 col-xs-12" style="text-align:right;">
          <button type="button" class=" btn btn-warning" onclick="RI_Calcula()" >Calcular</button>
        </div>



        <label class="control-label col-md-2 col-sm-2 col-xs-12">Oservaciones</label>
        <textarea class="form-control rounded-0" id="RI_observaciones" name="observaciones" rows="2"></textarea>
      </div>

    </div>
  </div>

  <input type="hidden" id="NSRI" name="NS" value="">
  <input type="hidden" id="TERI" name="TE" value="">


</form>
<script>

function RI_Calcula() { //v3.0
  var Emasa = document.getElementById('RI_Masa').value;
  var Ecarga_pkn = document.getElementById('RI_CargaPKN').value;
  var Eancho = document.getElementById('RI_Ancho').value;
  var Ebase = document.getElementById('RI_Base').value;
  var Ehaltura = document.getElementById('RI_Altura').value;


  var Ecarga_kgf = parseFloat(Ecarga_pkn) * 1000;
  var Earea = (parseFloat(Eancho) * parseFloat(Ebase) * 100)/100;
  var Evolumen = (parseFloat(Ehaltura) * Earea * 100)/100;
  var Edensidad = (1000000000 * parseFloat(Emasa) / Evolumen * 100)/100;
  var Eresistencia = (Ecarga_kgf / Earea * 100)/100;
  var Ench170 = (Eresistencia * 0.95 * 100)/100;

  document.getElementById("RI_CargaKGF").value = Ecarga_kgf;
  document.getElementById("RI_Area").value = Earea;
  document.getElementById("RI_Volumen").value = Evolumen;
  document.getElementById("RI_Densidad").value = Edensidad;
  document.getElementById("RI_Resistencia").value = Eresistencia;
  document.getElementById("RI_Nch170").value = Ench170;

}
</script>
