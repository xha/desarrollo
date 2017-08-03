function presiona(e, funcion) {
    var tecla = (document.all) ? event.keyCode : e.which;
    if (tecla==13) {
        funcion();
    }
}

function IsNumeric(sText) {
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;

   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;
}

function trae(idobjeto){
   var objeto = document.getElementById(idobjeto);
   return objeto;
}

function cambia(id,ruta) {
    var imagen = trae(id);
    imagen.src = ruta;
}

function textCounter(field, countfield, maxlimit) {
    var field = trae(field);
    var countfield = trae(countfield);
    if (field.value.length > maxlimit) {// if too long...trim it!
        field.value = field.value.substring(0, maxlimit);
    // otherwise, update 'characters left' counter
    } else { 
        countfield.value = maxlimit - field.value.length;
    };
};

function respuesta(response) {
    if (response>0) {
        response='A';
    }
    switch (response) {
        case "A":
            alert("Registro Actualizado");
        break;
        case "C":
            alert("Registro Insertado");
        break;
        case "N":
            alert("Registro No Encontrado");
        break;
        case "D":
            alert("Registro Eliminado");
        break;
        case "X":
            alert("Error, información no coincide");
        break;
    default:
        alert(response);
    }
}

function entero(e){
      	var tipo=e.keyCode;
      	if ((tipo == 8) || (tipo == 9))  
            return true; // 3 8,37,39,46
        var key = '';
        var strCheck = '0123456789.';
        var whichCode = (window.Event) ? e.which : e.keyCode;
        //if (whichCode == 13) return true; // Enter
        key = String.fromCharCode(whichCode); // Get key value from key code
        if (strCheck.indexOf(key) == -1) 
            return false; // Not a valid key
}

function validar_campo(id_campo,id_div_msj,msj){
    var retorno = false;
//    if ((document.getElementById(id_campo).value != '') && (document.getElementById(id_campo).value != '0')){ CAMBIADO POR MEJORAR
    if ((document.getElementById(id_campo).value != '')){
        document.getElementById(id_div_msj).innerHTML='';
        document.getElementById(id_div_msj).className="";
        retorno = true; 
    }
    else{ 
    document.getElementById(id_div_msj).className="alerta_msj";
    document.getElementById(id_div_msj).innerHTML=(retorno==false)?msj:'';
    }
    return retorno;
}

function add_filas(row, clase, funcion, falso, limite, identi) {
    //EL FALSO ES EL CAMPO PARA CAMBIAR LA FILA DE COLOR, DEPENDIENDO DE TRUE O FALSE
    if (!funcion) {
        funcion = "";
    }
    if (!falso) {
        falso = "";
    }
    if (!limite) {
        limite = "";
    }
    if (typeof identi == "undefined"){
        identi = 0;
    }
    var otro = "";
    var funciones = funcion.split("#");
    var tr = document.createElement('tr');
    tr.id = "add_filas_"+row[identi];
    tr.className = '';
    tr.align = 'center';
    var td = new Array();
    var node = new Array();
    var texto;
    
    if ((limite=='') || (limite==0)) {
        limite = row.length;
    }

    for (var i = 0; i < row.length; i++) {
        if (clase=='td') {
            otro = otro + row[i]+ "#";
        }
        
        td[i] = document.createElement(clase);
        if (clase=='td') {
            td[i].align = 'left';
        }

        if (falso!="") {
            if (row[parseInt(falso)]=='0') {
                td[i].style.backgroundColor = '#FFE1E1';
            } else {
                td[i].style.backgroundColor = '#FFF';
            } 
        }
        
        if ((row[i]=='0') && (i==falso)) {
            texto = "Inactivo";
        } else if ((row[i]=='1') && (i==falso) && (falso!="")) {
            texto = "Activo";
        } else {
            texto = row[i];
        }
        
        if (i <= limite) {
            node[i] = document.createTextNode(texto);
            td[i].style.maxWidth="400px";
            td[i].appendChild(node[i]);
            tr.appendChild(td[i]);
        }
    }
    
    if (funcion!="") {
        if (clase=='td')  {
            td = document.createElement(clase);
            td.align='center';
            td.style.cursor = "pointer";
            td.style.verticalAlign = "middle";
            for (i=0; i < funciones.length;i++) {
                var imagen = document.createElement('img');
                if (funciones[i]!="") {
                    imagen.width = "28";
                    imagen.style.padding = "3px";
                    imagen.tittle = otro;
                    imagen.id = "add_fila_i_"+row[identi];
                    switch(i) {
                        case 0:
                            imagen.src = "../../img/edit.png";
                            eval("imagen.onclick = function(){"+funciones[i]+"(this.tittle);}");
                        break;
                        case 1:
                            imagen.src = "../../img/imprimir.png";
                            eval("imagen.onclick = function(){"+funciones[i]+"(this.tittle);}");
                        break;
                        case 2:
                            imagen.src = "../../img/buscar.png";
                            eval("imagen.onclick = function(){"+funciones[i]+"(this.tittle);}");
                        break;
                        case 3:
                            imagen.src = "../../img/devolver.png";
                            eval("imagen.onclick = function(){"+funciones[i]+"(this.tittle);}");
                        break;
                        case 4:
                            imagen.src = "../../img/delete.png";
                            eval("imagen.onclick = function(){"+funciones[i]+"(this.tittle);}");
                        break;
                        default:
                            imagen.src = "../../img/delete.png";
                            eval("imagen.onclick = function(){"+funciones[i]+"(this.tittle);}");
                    }
                    td.appendChild(imagen);
                }
            }
            tr.appendChild(td);
        }
    }    
    
    return tr;
}

function splitLast( val ) {
    return val.split( /;\s*/ );
}

function extractLast( term ) {
    return splitLast( term ).pop();
}

function paginador(pag,total,data,tabla,extra) {
    if (typeof extra == "undefined"){
        var ext = 'title_tabla';
        var ext2 = 'llenar_tabla';
    } else {
        var ext = 'title_tabla_'+extra;
        var ext2 = 'llenar_tabla_'+extra;
    }
    var div = trae('paginado');
    var paginas,i,clase;
    div.innerHTML = "";
    pagina = pag;
    paginas = Math.ceil(total/ptotal_fin);
    var ul = document.createElement('ul');
    ul.className="pagination";
    for (i=1;i<=paginas;i++) {
        clase="";
        var li = document.createElement('li');
        var a = document.createElement('a');
        if (i==pag) clase="active";
        
        li.className = clase;
        a.href="";
        eval('a.onclick= function(){paginador("'+i+'","'+total+'","'+data+'","'+tabla+'","'+extra+'")}');
        a.innerHTML = i;
        li.appendChild(a);        
        ul.appendChild(li);        
    }
    div.appendChild(ul);

    var fnparams = [tabla];
    var fn = window[ext];
    if (typeof fn === "function") fn.apply(null, fnparams);

    var fnparams2 = [tabla,data];
    var fn2 = window[ext2];
    if (typeof fn2 === "function") fn2.apply(null, fnparams2);
}

function oculta_mensaje(elemento,texto,tipo) {
    var element = trae(elemento);
    var color = "";
    if (typeof tipo == "undefined"){
        color = texto;
    } else {
        color = parseInt(tipo);
    }
    
    switch (true) {
        case (color==0):
            clase = "callout callout-warning";
        break;
        case (color > 0):
            clase = "callout callout-success";
        break;
        default:
            clase = "callout callout-danger";
    }
    
    element.className = clase;
    element.innerHTML = texto;
    $(element).show();
    $(element).delay(8000).hide(600);
}

function deshabilita_opcion(btn,img,opt) {
    if (typeof opt == "undefined"){
        opt = 0;
    }
    var boton = trae(btn);
    var img = trae(img);

    if (opt==0) {
        img.style.visibility = "visible";
        boton.disabled = true;
    } else {
        img.style.visibility = "hidden";
        boton.disabled = false;
    }
}