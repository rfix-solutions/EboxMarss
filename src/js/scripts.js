function valida_rut(){
  return Rut(document.getElementById("rut_cliente").value);
}

//inicio funcion verificar CheckBoxs
function validar(esto){
valido=false;
for(a=0;a<esto.elements.length;a++){
if(esto[a].getElementById('ensayos').type=="checkbox" && esto[a].checked==true){
valido=true;
break
}else{
alert("Marque alguna casilla!");
}
}
return valido;

}
//termino funcion verificar Checkboxs
function cambiaGrupo(chk) {
  var padreDIV=chk;
  while( padreDIV.nodeType==1 && padreDIV.tagName.toUpperCase()!="DIV" )
    padreDIV=padreDIV.parentNode;
  //ahora que padreDIV es el DIV, cogeremos todos sus checkboxes
  var padreDIVinputs=padreDIV.getElementsByTagName("input");
  for(var i=0; i<padreDIVinputs.length; i++) {
    if( padreDIVinputs[i].getAttribute("type")=="checkbox" )
      padreDIVinputs[i].checked = chk.checked;
  }
}

    // Funcion Validar Rut
function checkRut(rut_cliente) {

    var valor = rut_cliente.value.replace('.', '');

    valor = valor.replace('-', '');

    cuerpo = valor.slice(0, -1);
    dv = valor.slice(-1).toUpperCase();

    rut_cliente.value = cuerpo + '-' + dv

    if (cuerpo.length < 7) {
        rut_cliente.setCustomValidity("RUT Incompleto");
        return false;
    }

    suma = 0;
    multiplo = 2;

    for (i = 1; i <= cuerpo.length; i++) {

        index = multiplo * valor.charAt(cuerpo.length - i);

        suma = suma + index;

        if (multiplo < 7) {
            multiplo = multiplo + 1;
        } else {
            multiplo = 2;
        }

    }

    dvEsperado = 11 - (suma % 11);

    dv = (dv == 'K') ? 10 : dv;
    dv = (dv == 0) ? 11 : dv;

    if (dvEsperado != dv) {
        rut_cliente.setCustomValidity("RUT Inválido");
        return false;
    }

    rut_cliente.setCustomValidity('');
}

function letrasYnumeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789.";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz.";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}



//Función SoloNumeros
function soloNumeros(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
