nro_filas = 0;
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
    var t_total = 0;
    var i;
    
    $.get('../transaccion/buscar-detalle-taller',{id_transaccion : id_transaccion, serv : 1},function(data){
        var data = $.parseJSON(data);
        var campos = Array();
        if (data!="") {
            for (i = 0; i < data.length; i++) {
//Nro 	Código 	Descripción 	Cantidad 	Precio 	Tax 	Total 	Serv 	Imp 	Mecánico 	Observación
                if (data[i].CodTaxs==null) data[i].CodTaxs = 0;
                if (data[i].monto==null) data[i].monto = 0;
                if (data[i].CodMeca==null) data[i].CodMeca = "";
                if (data[i].observacion==null) data[i].observacion = "";
                campos.length = 0;
                campos.push(i+1);
                campos.push(data[i].CodItem);
                campos.push(data[i].descripcion);
                campos.push(data[i].cantidad);
                campos.push(data[i].costo);
                campos.push(data[i].monto);
                t_total = parseFloat(data[i].total) + parseFloat(data[i].monto);
                campos.push(t_total);
                campos.push(1);
                campos.push(data[i].CodTaxs);
                campos.push(data[i].CodMeca);
                campos.push(data[i].observacion);
                tabla.appendChild(add_filas(campos, 'td','editar_detalle####borrar_detalle','',10));
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
    var rol = trae('rol');
    var cliente = trae('transaccion-pagador').value;
    
    d_nombre.value = "";
    d_iva.length = 0;
    if (d_codigo.value!="") {
        var campo = d_codigo.value.split(" - ");
        $.getJSON('../transaccion/buscar-items',{codigo : campo[0], cliente : cliente},function(data){
            if (data!="") {
                h_bloqueo.innerHTML = "";
                if (rol!=3) {
                    if (data.Error!="") {
                        h_bloqueo.innerHTML = data.Error;
                    }
                }
                
                if (h_bloqueo.innerHTML!="") return false;
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

function calcula_subtotal() {
    var cantidad = trae('d_cantidad').value;
    var precio = trae('d_precio').value;
    var iva = trae('d_iva');
    var impuesto = trae('d_impuesto');
    var total = trae('d_total');
    var sub;
    var selected;

    if (iva.value!="") {
        selected = iva.options[iva.selectedIndex].text;
    } else {
        selected = 0;
    }
    
    if (selected=="") selected = 0;

    if ((precio>0) && (cantidad>0)) {
        sub = (parseFloat(cantidad) * parseFloat(precio));
        impuesto.value = Math.round((parseFloat(sub) * (parseFloat(selected)/100)) * 100) / 100 ;
        total.value = Math.round((parseFloat(sub) + parseFloat(impuesto.value)) * 100) / 100 ;    
    }
}

function valida_detalle() {
    var cantidad = trae('d_cantidad').value;
    var precio = trae('d_precio').value;
    var codigo = trae('transaccion-d_codigo').value;
    var nombre = trae('d_nombre').value;
    var tipo_item = trae('tipo_item').value;
    var mecanico = trae('d_mecanico').value;
    var mensaje = trae('mensaje_alerta');

    mensaje.style.visibility = "hidden";
    mensaje.innerHTML = "";
    if ((cantidad!="") && (mecanico!="") && (precio!="") && (codigo!="") && (nombre!="") && (tipo_item!="")) {
        llena_tabla_detalle();
    } else {
        mensaje.style.visibility = "visible";
        mensaje.innerHTML = "Faltan Datos";
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
    var d_iva = trae('d_iva').value;
    var mecanico = trae('d_mecanico').value;
    var observacion = trae('d_observacion').value;
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
        campos.push(total);
        campos.push(tipo_item);
        campos.push(d_iva);
        campos.push(mecanico);
        campos.push(observacion);
        tabla.appendChild(add_filas(campos, 'td','editar_detalle####borrar_detalle','',10));
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
                    otro = otro + total + "#";
                    $(this).text(total);
                break;
                case 7: 
                    otro = otro + tipo_item + "#";
                    $(this).text(tipo_item);
                break;
                case 8: 
                    otro = otro + d_iva + "#";
                    $(this).text(d_iva);
                break;
                case 9: 
                    otro = otro + mecanico + "#";
                    $(this).text(mecanico);
                break;
                case 10: 
                    otro = otro + observacion + "#";
                    $(this).text(observacion);
                break;
                case 11: 
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
    var d_total = trae('d_total');
    var mecanico = trae('d_mecanico');
    var observacion = trae('d_observacion');
    var arreglo = response.split("#");

    d_fila.value = arreglo[0];
    d_codigo.value = arreglo[1];
    d_nombre.value = arreglo[2];
    d_cantidad.value = parseFloat(arreglo[3]);
    d_precio.value = parseFloat(arreglo[4]);
    d_impuesto.value = parseFloat(arreglo[5]);
    d_total.value = parseFloat(arreglo[6]);
    mecanico.value = arreglo[9];
    observacion.value = arreglo[10];
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
    var tipo_item = trae('tipo_item');
    var mecanico = trae('d_mecanico');
    var observacion = trae('d_observacion');

    fila.value = "";
    codigo.value = "";
    tipo_item.value = "";
    nombre.value = "";
    cantidad.value = "";
    precio.value = "";
    total.value = "";
    impuesto.value = "";
    observacion.value = "";
    mecanico.value = "";
}

function enviar_data() {
    var i_items = document.getElementById('i_items');
    var fila;
    
    i_items.value = "";
    
    $("#listado_detalle tr").each(function (index) {
        var td = $(this).children("td");
        if ((td.eq(0).text()!="") && (td.eq(9).text()!="")) {
            fila = td.eq(0).text();
            i_items.value+= trae('add_fila_i_'+fila).tittle+"¬";
        }
    });

    if (i_items.value!="") {
        document.forms['w0'].submit();
    } else {
        alert('Faltan Datos (Servicios, Mecánicos asignados');
    }
}