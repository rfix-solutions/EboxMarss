		//inicio funcion verificar CheckBoxs
           function almenos_uno(){//encuentra almenos 1 chekbox clickeado
    
    chk=document.getElementsByName('ensayos[]');//se obtienen los elementos y se ingresan a un arreglo
for(i=0;i<chk.length;i++)//avanza segun el largo de la cantidad de elementos en el arreglo
if(chk[i].checked == true){//si encuentra un checkbox checkeado rtorna true y termina
    return true;
}else{
    if(i==chk.length && chk[i].cheked==false){//si el ultimo checkbox no esta checkeado y no ha sido encontrado un checkbox anterior checkeado retorna false
        return false;
    }
}}

        //inicio funcion verificar Precios ensayos
     function cambiar_valor(){//encuentra almenos 1 chekbox clickeado
     var precio;     
     chk=document.getElementsByName('ensayos[]');//se obtienen los elementos y se ingresan a un arreglo
for(i=0;i<chk.length;i++)//avanza segun el largo de la cantidad de elementos en el arreglo
   precio=document.getElementsByName('precio_ensayo'+i);//asigna el elemento correspondiente a cambiar a la variable precio
    if( precio.value==null||precio.value==""){//toma el value de el precio de el ensayo, como i esta representando el id no hay problemas de correlatividad... creo...
       precio.value==0; //si el value es null lo reemplaza por un 0 pero si el value es diferente solo sigue
   
}
} 