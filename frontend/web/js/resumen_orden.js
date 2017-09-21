function titulo_tabla () {
    var tabla = trae('listado_detalle');
    var campos = Array();
    campos.push('T');
    campos.push('Nro');
    campos.push('Fecha');
    campos.push('Asesor');
    campos.push('Placa');
    campos.push('Modelo');
    campos.push('Total');
    campos.push('Rif');
    campos.push('Representante');
    campos.push('Estatus');
    campos.push('Imp');
    
    tabla.appendChild(add_filas(campos, 'th','','',10));
}

function enviar_data() {
    var div_resultado = trae('div_resultado');
    var listado_detalle = trae('listado_detalle');
    var tabla = trae('listado_detalle');
    var fecha_desde = trae('vwresumenorden-fecha').value.split('-');
        fecha_desde = fecha_desde[2]+fecha_desde[1]+fecha_desde[0];
    var fecha_hasta = trae('vwresumenorden-fecha_transaccion').value.split('-');
        fecha_hasta = fecha_hasta[2]+fecha_hasta[1]+fecha_hasta[0];
    var numero = trae('vwresumenorden-numero_atencion').value;
    var placa = trae('vwresumenorden-placa').value;
    var asesor = trae('asesor').value;
    var activo = trae('vwresumenorden-activo').value;
    var query = '';
    var campos = Array();
    var i;
    
    div_resultado.innerHTML = "";
    listado_detalle.innerHTML = "";
    
    query+= " and fechae between '"+fecha_desde+"' and '"+fecha_hasta+"'";
    
    if (numero!="") query+= " and numero_atencion="+numero;
    if (placa!="") query+= " and placa like '%"+numero+"%'";
    if (asesor!="") query+= " and asesor="+asesor;
    if (activo!="") query+= " and activo="+activo;
    
    $.get('../vw-resumen-orden/buscar-orden',{consulta : query},function(data){
        var data = $.parseJSON(data);
        if (data!="") {
            titulo_tabla();
            var imagen = document.createElement('img');
            imagen.src = "../../../img/imprimir.png";
            imagen.style.cursor = "pointer";
            eval('imagen.onclick = function(){imprimir_resumen("'+query+'");}');
            
            var b = document.createElement('b');
            b.innerHTML = "Imprimir Resumen ";
            
            div_resultado.appendChild(b);
            div_resultado.appendChild(imagen);
            for (i = 0; i < data.length; i++) {
                campos.length=0;
                campos.push(data[i].id_transaccion);
                campos.push(data[i].numero_atencion);
                campos.push(data[i].fecha);
                campos.push(data[i].nombre_asesor);
                campos.push(data[i].placa);
                campos.push(data[i].modelo);
                campos.push(data[i].total);
                campos.push(data[i].representante);
                campos.push(data[i].nombre_representante);
                if (data[i].activo==1) {
                    campos.push('Abierta');
                } else {
                    campos.push('Cerrada');
                }
                tabla.appendChild(add_filas(campos, 'td','#imprime_orden###','',9));
            }
        } else {
            div_resultado.innerHTML = "<b>NO EXISTEN RESULTADOS</b>";
        }
    });
}

function imprime_orden (data) {
    var valor = data.split("#");
    window.open("../transaccion/imprime-orden?id="+valor[0],'_blank','');
    //transaccion/imprime-orden?id=4
}

function imprimir_resumen(query) {
    window.open("../vw-resumen-orden/imprime-resumen?consulta="+query,'_blank','');
}