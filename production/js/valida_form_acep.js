function ver_vacio(campo){
    if(campo.value=="" || campo.value="null" || campo.value==0){
        alert("Este campo no puede estar vacio");
        campo.focus();
        return false;
    }else{
        return true;
    }
}



function solo_letras(letras){
    if(letras.match(/[a-zA-Z ]+/) == false){
        return false;
    }else{
        return true;
    }
    
}

function valida_email(email){
    if(email.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/)== false){
        return false;
    }else{
        return true;
    }
}

function solo_numeros(numero){
    if(numero.match(/[0-9]/)== false){
       return false;
       }else{
       return true;
       }
    
}

////////////////////////////////////////////////////////////////////////////////////////////////////
function checkRut(rut) {
    // Despejar Puntos
             
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    
    // Aislar Cuerpo y Dígito Verificador
    var cuerpo = valor.slice(0,-1);
    var dv = valor.slice(-1).toUpperCase();
    
    // Formatear RUN
    rut.value = cuerpo + '-'+ dv
    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
    
    // Calcular Dígito Verificador
    var suma = 0;
    var multiplo = 2;
    var i;
    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {
    
        // Obtener su Producto con el Múltiplo Correspondiente
        var index = multiplo * valor.charAt(cuerpo.length - i);
        
        // Sumar al Contador General
        suma = suma + index;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    var dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
    return true;
}


/////////////////////////////////////////////////////////////////////////////



 function verificar_radio(){ //se activa en el submit
 
var m = document.getElementById("mensual");
var q = document.getElementById("quincenal");
var s = document.getElementById("semanal");    

if ( (m.checked == false ) || (q.checked == false ) || (s.checked == false ) )
{
return false;
}else{
return true; 
}
 }
///////////////////////////////////////////////////////////////////////////



function validar() {  

var empresa_solicitante = document.getElementById('empresa_solicitante');
var nombre_solicitante =document.getElementById('nombre_solicitante');
var email_solicitante = document.getElementById('email_solicitante');
var empresa_constructora = document.getElementById('empresa_constructora');
var nombre_obra = document.getElementById('nombre_obra');
var codigo_obra = document.getElementById('codigo_obra');
var direccion_obra = document.getElementById('direccion_obra');
var comuna_obra = document.getElementById('comuna_obra');
var fono_obra = document.getElementById('fono_obra');
var encargado_terreno = document.getElementById('encargado_terreno');
var email_encargado = document.getElementById('encargado_terreno');
var telefono_encargado = document.getElementById('telefono_encargado');
var entidad_fiscal = document.getElementById('entidad_fiscal');
var empresa_encargada = document.getElementById('empresa_encargada');
var profesional_acargo = document.getElementById('profesional_acargo');
var razon_social = document.getElementById('razon_social');
var rut_empresa_factura = document.getElementById('rut_empresa_factura');
var giro_empresa = document.getElementById('giro_empresa');
var direccion_factura = document.getElementById('direccion_factura');
var nombre_ciudad = document.getElementById('nombre_ciudad');
var forma_pago = document.getElementById('forma_pago');
var telefono_facturacion = document.getElementById('telefono_facturacion');
var periodo_facturacion = document.getElementById('periodo_facturacion');    //periodo de facturacion se obtiene con la funcion verificar_radio//
var email_facturacion = document.getElementById('email_facturacion');
var nombre_aceptante = document.getElementById('nombre_aceptante');
var id_cotizacion_insert = $id_cotizacion;
    
    
    if(ver_vacio(empresa_solicitante)==true || ver_vacio(nombre_solicitante)==true || ver_vacio(email_solicitante)==true || ver_vacio(empresa_constructora)==true || ver_vacio(nombre_obra)==true || ver_vacio(codigo_obra)==true || ver_vacio(direccion_obra)==true || ver_vacio(comuna_obra)==true || ver_vacio(fono_obra)==true || ver_vacio(encargado_terreno)==ture || ver_vacio(email_encargado)==true || ver_vacio(telefono_encargado)==true || ver_vacio(entidad_fiscal)==true || ver_vacio(empresa_encargada)==true || ver_vacio(profesional_acargo)==true || ver_vacio(razon_social)==true || ver_vacio(rut_empresa_factura)==true || ver_vacio(nombre_ciudad)==true || ver_vacio(forma_pago)==true || ver_vacio(telefono_facturacion)==true || ver_vacio(email_facturacion)==true || ver_vacio(nombre_aceptante)==true || ver_vacio(id_cotizacion_insert)==true ){
{
if(solo_letras(empresa_solicitante) == false){
                empresa_solicitante.setCustomValidity("Debe ingresar Solo letras por favor");
                empresa_solicitante.focus();
                return false;
}else{
if(empresa_solicitante.length<4 || empresa_solicitante.length > 30){
                empresa_solicitante.setCustomValidity("El nombre debe poseer un minimo de 4 y maximo de 30 caracteres");
                empresa_solicitante.focus();
                return false;
}else{
if(solo_letras(nombre_solicitante)== false){
                nombre_solicitante.setCustomValidity("Debe ingresar Solo letras por favor");
                nombre_solicitante.focus(); 
                return false;
            
}else{
if(valida_email(email_solicitante)==false){
                email_solicitante.setCustomValidity("La cuenta de email ingresada no es valida");
                email_solicitante.values=="";
                email_solicitante.focus();
                return false;
}else{
if(empresa_constructora.match(/[aA-zZ0-9]/)==false){
                empresa_constructora.setCustomValidity("Ingrese nombre sin caracteres especiales porfavor");
                empresa_constructora.focus();
                return false;
}else{
if(solo_letras(nombre_obra)==false){
                nombre_obra.setCustomValidity("Debe ingresar Solo letras por favor");
                nombre_obra.focus();
                return false;
                          
}else{
if(codigo_obra.length<4){
                codigo_obra.setCustomValidity("El codigo no cumple con el minimo de caracteres requeridos");
                codigo_obra.focus();
                return false;
                                  
}else{
if(direccion_obra.match(/[aA-zZ0-9]/)==false){
                direccion_obra.setCustomValidity("Solo letras y numeros porfaor");
                direccion_obra.focus();
                return false;
                                      
}else{
if(solo_letras(comuna_obra)== false){
                comuna_obra.setCustomValidity("Debe ingresar Solo letras por favor");
                comuna_obra.focus();
                return false;
                                         
}else{
if(solo_numeros(fono_obra)==false){
                fono_obra.setCustomValidity("Debe ingresar Solo numeros porfavor");
                fono_obra.focus();
                return false;
}else{
if(solo_letras(encargado_terreno)== false){
                encargado_terreno.setCustomValidity("Debe ingresar Solo letras por favor");
                encargado_terreno.focus();
                return false;
}else{
if(valida_email(email_encargado)== false){
                email_encargado.setCustomValidity("La cuenta de email ingresada no es valida");
                email_encargado.focus();
                return false;
}else{
if(solo_numeros(telefono_encargado)==false){
                telefono_encargado.setCustomValidity("Debe ingresar Solo numeros porfavor");
                telefono_encargado.focus();
                return false;
}else{
if(entidad_fiscal.value==0){
                entidad_fiscal.setCustomValidity("No ha seleccionado una Entidad Fiscal");
                entidad_fiscal.focus();
                return false;
}else{
if(solo_letras(empresa_encargada)== false){
                empresa_encargada.setCustomValidity("Debe ingresar Solo letras por favor");
                empresa_encargada.focus();
                return false;
}else{
if(solo_letras(profesional_acargo)== false){
                profesional_acargo.setCustomValidity("Debe ingresar Solo letras por favor");
                profesional_acargo.focus();
                return false;
}else{
if(solo_letras(razon_social)== false){
                razon_social.setCustomValidity("Debe ingresar Solo letras por favor");
                razon_social.focus();
                return false;
}else{
if(checkRut(rut_empresa_factura)== false){
                rut_empresa_factura.values=="";
                rut_empresa_factura.focus();
                return false;
}else{
if(solo_letras(nombre_ciudad)== false){
                nombre_ciudad.setCustomValidity("Debe ingresar Solo letras por favor");
                nombre_ciudad.focus();
                return false;
}else{
var x= verificar_radio();
if(x==false){
                periodo_facturacion.setCustomValidity("Debe seleccionar una de las opciones");
                periodo_facturacion.focus();
                return false;
}else{
if(forma_pago.value==0){
                forma_pago.setCustomValidity("Debe seleccionar una de las Formas de Pago");
                forma_pago.focus();
                return false;
}else{
if(solo_numeros(telefono_facturacion)==false){
                telefono_facturacion.setCustomValidity("Debe ingresar Solo numeros   porfavor");
                telefono_facturacion.focus();
                return false;
}else{
if(valida_email(email_facturacion)== false){
                email_facturacion.setCustomValidity("El email ingresado no es valido");
                email_facturacion.focus();
                return false;
}else{
if(solo_letras(nombre_aceptante)==false){
                nombre_aceptante.setCustomValidity("Debe ingresar Solo letras porfavor");
                nombre_aceptante.focus();
                return false;
                                            }else{
                                               empresa_solicitante.setCustomValidity("Debe ingresar Solo letras porfavor");
                                                empresa_solicitante.focus();
                                                return false;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }                                                              
    }
}
}
}
}                                    
}
}
}
}
}
}
}
}}}}