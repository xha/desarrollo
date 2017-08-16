$(function() {
    buscar_vehiculo();    
    buscar_detalle();    
});

function buscar_vehiculo() {
    var id_vehiculo = trae('transaccion-id_vehiculo').value;
    
    $.get('../transaccion/buscar-vehiculo',{id_vehiculo : id_vehiculo},function(data){
        var data = $.parseJSON(data);
        if (data!="") {
            var tipo = trae('v_tipo');
            var modelo = trae('v_modelo');
            var anio = trae('v_anio');
            var color = trae('v_color');
            var placa = trae('v_placa');

            tipo.value = data.tipo;
            modelo.value = data.modelo;
            anio.value = data.anio;
            color.value = data.color;
            placa.value = data.placa;
        }
    });
}

function buscar_detalle() {
    var id_transaccion = trae("transaccion-id_transaccion").value;
    var tabla = trae('listado_detalle');
    var i;
    
    $.get('../transaccion/buscar-detalle-solicitud',{id_transaccion : id_transaccion},function(data){
        var data = $.parseJSON(data);
        var campos = Array();
        if (data!="") {
            for (i = 0; i < data.length; i++) {
                if (data[i].CodTaxs==null) data[i].CodTaxs = 0;
                if (data[i].monto==null) data[i].monto = 0;
                campos.length = 0;
                campos.push(i+1);
                campos.push(data[i].CodItem);
                campos.push(data[i].descripcion);
                //campos.push(number_format(data[i].cantidad,2));
                campos.push(data[i].cantidad);
                campos.push(data[i].costo);
                campos.push(data[i].monto);
                campos.push(0);
                campos.push(data[i].total);
                campos.push(0);
                campos.push(data[i].CodTaxs);
                tabla.appendChild(add_filas(campos, 'td','editar_detalle####borrar_detalle','',9));
            }     
        }
    });
}

function carga_servicios() {
    var d_nombre = trae("d_nombre");
    var d_iva = trae("d_iva");
    var d_codigo = trae("transaccion-d_codigo");
    var tipo_item = trae("tipo_item");
    var precio = trae("d_precio");
    
    d_nombre.value = "";
    d_iva.length = 0;
    if (d_codigo.value!="") {
        var campo = d_codigo.value.split(" - ");
        $.get('../transaccion/buscar-items',{codigo : campo[0]},function(data){
            var data = $.parseJSON(data);
            if (data!="") {
                d_codigo.value = campo[0];
                d_nombre.value = data.Descrip;    
                tipo_item.value = data.EsServ;
                precio.value = data.Precio1;
                $.get('../transaccion/buscar-impuestos',{codigo : campo[0],tipo : data.EsServ},function(data){
                    var data2 = $.parseJSON(data);

                    if (data2!="") {
                        for (var i = 0; i < data2.length; i++) {
                            var conteo = d_iva.length;
                            var prueba = new Option(data2[i].Monto,data2[i].CodTaxs,"","");
                            d_iva[conteo] = prueba;
                        }
                    }
                });
            }
        });
    }
}

function valida_detalle() {
    var cantidad = trae('d_cantidad').value;
    var precio = trae('d_precio').value;
    var codigo = trae('transaccion-d_codigo').value;
    var nombre = trae('d_nombre').value;
    var tipo_item = trae('tipo_item').value;

    if ((cantidad!="") && (precio!="") && (codigo!="") && (nombre!="") && (tipo_item!="")) {
        llena_tabla_detalle();
    }
}

function llena_tabla_detalle() {
    var fila = trae('d_fila');
    var tipo_item = trae('tipo_item').value;
    var codigo = trae('transaccion-d_codigo').value;
    var nombre = trae('d_nombre').value.trim();
    var cantidad = trae('d_cantidad').value;
    var precio = trae('d_precio').value;
    var total = trae('d_total').value;
    var impuesto = trae('d_impuesto').value;
    var descuento = trae('d_descuento').value;
    var d_iva = trae('d_iva').value;
    var tabla = trae('listado_detalle');
    var otro = "";
    var campos = Array();
    var bandera = true;
    var contador;
    var i = 0;
    var total_filas = tabla.rows.length;

    if (fila.value > total_filas) fila.value = total_filas;
    if (fila.value < 1) {
        while (bandera) {
            contador = total_filas + i;
            if (!trae('add_fila_i_'+contador)) {
                fila.value = contador;
                bandera = false;
            } else {
                i++;
            }    
        }

        campos.push(fila.value);
        campos.push(codigo);
        campos.push(nombre);
        campos.push(cantidad);
        campos.push(precio);
        campos.push(impuesto);
        campos.push(descuento);
        campos.push(total);
        campos.push(tipo_item);
        campos.push(d_iva);
        tabla.appendChild(add_filas(campos, 'td','editar_detalle####borrar_detalle','',9));
    } else {
        var tr = trae('add_filas_'+fila.value);
        $(tr).children("td").each(function (index) {
            switch (index) {
                case 0: 
                    otro = otro + fila.value + "#";
                    $(this).text(fila.value);
                break;
                case 1: 
                    otro = otro + codigo + "#";
                    $(this).text(codigo);
                break;
                case 2: 
                    otro = otro + nombre + "#";
                    $(this).text(nombre);
                break;
                case 3: 
                    otro = otro + cantidad + "#";
                    $(this).text(cantidad);
                break;
                case 4: 
                    otro = otro + precio + "#";
                    $(this).text(precio);
                break;
                case 5: 
                    otro = otro + impuesto + "#";
                    $(this).text(impuesto);
                break;
                case 6: 
                    otro = otro + descuento + "#";
                    $(this).text(descuento);
                break;
                case 7: 
                    otro = otro + total + "#";
                    $(this).text(total);
                break;
                case 8: 
                    otro = otro + tipo_item + "#";
                    $(this).text(tipo_item);
                break;
                case 9: 
                    otro = otro + d_iva + "#";
                    $(this).text(d_iva);
                break;
                case 10: 
                    var imagen = trae('add_fila_i_'+fila.value);
                    imagen.tittle = otro;
                break;
            }
        });
    }
    blanquea_detalle();
}

function editar_detalle(response) {
    var d_fila = trae('d_fila');
    var d_nombre = trae('d_nombre');
    var d_codigo = trae('transaccion-d_codigo');
    var d_cantidad = trae('d_cantidad');
    var d_precio = trae('d_precio');
    var d_impuesto = trae('d_impuesto');
    var d_descuento = trae('d_descuento');
    var d_total = trae('d_total');
    var arreglo = response.split("#");

    d_fila.value = arreglo[0];
    d_codigo.value = arreglo[1];
    d_nombre.value = arreglo[2];
    d_cantidad.value = parseFloat(arreglo[3]);
    d_precio.value = parseFloat(arreglo[4]);
    d_impuesto.value = parseFloat(arreglo[5]);
    d_descuento.value = parseFloat(arreglo[6]);
    d_total.value = parseFloat(arreglo[7]);
    carga_servicios();
}

function borrar_detalle(response) {
    var tabla = trae('listado_detalle');
    var arreglo = response.split("#");
    tabla.deleteRow(arreglo[0]);
}

function blanquea_detalle() {
    var fila = trae('d_fila');
    var codigo = trae('transaccion-d_codigo');
    var nombre = trae('d_nombre');
    var cantidad = trae('d_cantidad');
    var precio = trae('d_precio');
    var total = trae('d_total');
    var impuesto = trae('d_impuesto');
    var descuento = trae('d_descuento');
    var tipo_item = trae('tipo_item');
    var tabla = trae('listado_detalle');

    fila.value = "";
    codigo.value = "";
    tipo_item.value = "";
    nombre.value = "";
    cantidad.value = "";
    precio.value = "";
    total.value = "";
    impuesto.value = "";
    descuento.value = "";
}

function calcula_subtotal() {
    var cantidad = trae('d_cantidad').value;
    var precio = trae('d_precio').value;
    var iva = trae('d_iva');
    var descuento = trae('d_descuento');
    var impuesto = trae('d_impuesto');
    var total = trae('d_total');
    var sub;
    var selected;

    if (descuento.value=="") descuento.value=0;
    if (iva.value!="") {
        selected = iva.options[iva.selectedIndex].text;
    } else {
        selected = 0;
    }
    
    if (selected=="") selected = 0;

    if ((precio>0) && (cantidad>0)) {
        sub = (parseFloat(cantidad) * parseFloat(precio)) - parseFloat(descuento.value);
        impuesto.value = Math.round((parseFloat(sub) * (parseFloat(selected)/100)) * 100) / 100 ;
        total.value = Math.round((parseFloat(sub) + parseFloat(impuesto.value)) * 100) / 100 ;    
    }
}

function enviar_data() {
    var i_items = document.getElementById('i_items');
    var fila;
    
    i_items.value = "";
    
    $("#listado_detalle tr").each(function (index) {
        var td = $(this).children("td");
        if (td.eq(0).text()!="") {
            fila = td.eq(0).text();
            i_items.value+= trae('add_fila_i_'+fila).tittle+"¬";
        }
    });

    if (i_items.value!="") document.forms['w0'].submit();
}