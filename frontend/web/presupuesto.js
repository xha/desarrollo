    $(function() {
        /*var id_solicitud = document.getElementById('solicitud-id_solicitud').value;
        var tabla = trae('listado_detalle');
        var i;

        if (id_solicitud>0) {
            $.get('../solicitud/buscar-detalle',{codigo : id_solicitud},function(data){
                var data = $.parseJSON(data);
                var campos = Array();
                if (data!="") {
                    for (i = 0; i < data.length; i++) {
                        campos.push(i+1);
                        campos.push(data[i].codigo);
                        campos.push(data[i].nombre);
                        campos.push(data[i].cantidad);
                        campos.push(data[i].costo);
                        campos.push(data[i].impuesto);
                        campos.push(data[i].total);
                        tabla.appendChild(add_filas(campos, 'td','editar_detalle####borrar_detalle','',7));
                    }
                }

                recorre_tabla();
            });
        }*/
    });

    function enviar_data() {
        var i_items = document.getElementById('i_items');
        var impuesto = Math.round(parseFloat(trae('impuesto').value) * 100) / 100 ;
        var descuento = Math.round(parseFloat(trae('descuento').value) * 100) / 100 ;
        var sub_total = Math.round(parseFloat(trae('sub_total').value) * 100) / 100 ;
        var total = Math.round(parseFloat(trae('total').value) * 100) / 100 ;
        var descrip = trae('presupuesto-descrip').value;
        var vendedor = trae('presupuesto-codvend').value;
        var fecha = trae('presupuesto-fechae').value;
        var codubic = trae('presupuesto-codubic').value;
        var arreglo="";
        var fila;
        var total_servicio=0;
        var total_producto=0;
        var gravable=0;
        var exento=0;
        var costo_producto=0;
        var costo_servicio=0;
        i_items.value = "";

        if ((descrip!="") && (fecha!="") && (vendedor!="") && (codubic!="")) {
            $("#listado_detalle tr").each(function (index) {
                var td = $(this).children("td");
                if (td.eq(0).text()!="") {
                    fila = td.eq(0).text();
                    i_items.value+= trae('add_fila_i_'+fila).tittle+"¬";
                    arreglo = trae('add_fila_i_'+fila).tittle.split("#");
                    cuenta = (arreglo[3] * arreglo[4]) - arreglo[6];

                    if (arreglo[8]=="1") {
                        costo_servicio+= parseFloat(arreglo[4]);
                        total_servicio+= parseFloat(cuenta);
                    } else {
                        costo_producto+= parseFloat(arreglo[4]);
                        total_producto+= parseFloat(cuenta);
                    }

                    if(arreglo[5]>0) {
                        gravable+= parseFloat(cuenta);
                    } else {
                        exento+= parseFloat(cuenta);
                    }
                }
            });

            trae('presupuesto-totalprd').value = total_producto;
            trae('presupuesto-totalsrv').value = total_servicio;
            trae('presupuesto-costoprd').value = costo_producto;
            trae('presupuesto-costosrv').value = costo_servicio;
            trae('presupuesto-monto').value = total_producto + total_servicio;
            trae('presupuesto-mtotax').value = impuesto;
            trae('presupuesto-tgravable').value = gravable;
            trae('presupuesto-texento').value = exento;
            trae('presupuesto-mtototal').value = total;
            trae('presupuesto-desctop').value = descuento;
            trae('presupuesto-credito').value = total;
                
            if (i_items.value!="") document.forms['w0'].submit();
        } else {
            alert("Faltan datos");
        }
    }

    function split_clientes() {
        var id_cliente = trae('presupuesto-codclie');
        var nombre_cliente = trae('presupuesto-descrip');
        
        nombre_cliente.value = "";
        if (id_cliente.value!="") {
            var arreglo = id_cliente.value.split(" - ");    
            id_cliente.value = arreglo[0];
            if (arreglo[1]!=undefined) {
                nombre_cliente.value = arreglo[1];
            } else {
                nombre_cliente.value = "";
            }
        }
    }

    function carga_servicios(valor) {
        var tipo_item = trae("tipo_item").value;
        var d_nombre = trae("d_nombre");
        var d_iva = trae("d_iva");

        d_nombre.value = "";
        d_iva.length = 0;
        if (valor!="") {
            $.get('../presupuesto/buscar-items',{codigo : valor, tipo : tipo_item},function(data){
                var data = $.parseJSON(data);
                if (data!="") {
                    d_nombre.value = data[0].Descrip;    
                    $.get('../presupuesto/buscar-impuestos',{codigo : valor, tipo : tipo_item},function(data){
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
        var descuento = trae('d_descuento');
        var impuesto = trae('d_impuesto');
        var total = trae('d_total');
        var sub;
        var selected;

        if (d_descuento.value=="") d_descuento.value=0;
        selected = iva.options[iva.selectedIndex].text;
        if (selected=="") selected = 0;

        if ((precio>0) && (cantidad>0)) {
            sub = (parseFloat(cantidad) * parseFloat(precio)) - parseFloat(descuento.value);
            impuesto.value = Math.round((parseFloat(sub) * (parseFloat(selected)/100)) * 100) / 100 ;
            total.value = Math.round((parseFloat(sub) + parseFloat(impuesto.value)) * 100) / 100 ;    
        }
    }

    function valida_detalle() {
        var cantidad = trae('d_cantidad').value;
        var precio = trae('d_precio').value;
        var codigo = trae('d_codigo').value;
        var nombre = trae('d_nombre').value;

        if ((cantidad!="") && (precio!="") && (codigo!="") && (nombre!="")) {
            calcula_subtotal();
            llena_tabla_detalle();
        }
    }

    function llena_tabla_detalle() {
        var fila = trae('d_fila');
        var tipo_item = trae('tipo_item').value;
        var codigo = trae('d_codigo').value;
        var nombre = trae('d_nombre').value.trim();
        var cantidad = trae('d_cantidad').value;
        var precio = trae('d_precio').value;
        var total = trae('d_total').value;
        var impuesto = trae('d_impuesto').value;
        var descuento = trae('d_descuento').value;
        var d_iva = trae('d_iva').value;
        var tabla = trae('listado_detalle');
        var otro = "";
        var sub_total = 0;
        var campos = Array();
        var bandera = true;
        var contador;
        var i = 0;
        var xxx;
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
        recorre_tabla();
    }

    function editar_detalle(response) {
        var d_fila = trae('d_fila');
        var d_nombre = trae('d_nombre');
        var d_codigo = trae('d_codigo');
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
        carga_servicios(d_codigo.value);
    }

    function borrar_detalle(response) {
        var tabla = trae('listado_detalle');
        var arreglo = response.split("#");
        tabla.deleteRow(arreglo[0]);
        recorre_tabla();
    }

    function blanquea_detalle() {
        var fila = trae('d_fila');
        var codigo = trae('d_codigo');
        var nombre = trae('d_nombre');
        var cantidad = trae('d_cantidad');
        var precio = trae('d_precio');
        var total = trae('d_total');
        var impuesto = trae('d_impuesto');
        var descuento = trae('d_descuento');
        var tabla = trae('listado_detalle');

        fila.value = "";
        codigo.value = "";
        nombre.value = "";
        cantidad.value = "";
        precio.value = "";
        total.value = "";
        impuesto.value = "";
        descuento.value = "";
    }

    function recorre_tabla() {
        var sub_total = trae('sub_total');
        var impuesto = trae('impuesto');
        var descuento = trae('descuento');
        var total = trae('total');
        var d_impuesto = 0;
        var d_total = 0;
        var d_descuento = 0;
        var d_descuento2 = 0;
        var d_sub_total = 0;
        var cantidad = 0;
        var precio = 0;

        $("#listado_detalle tr").each(function (index) {
            $(this).children("td").each(function (index2) { 
                switch (index2) {
                    case 3: 
                        cantidad = parseFloat($(this).text());
                    break;
                    case 4: 
                        precio = parseFloat($(this).text());
                    break;
                    case 5: 
                        d_impuesto = d_impuesto + parseFloat($(this).text());
                    break;
                    case 6: 
                        d_descuento = d_descuento + parseFloat($(this).text());
                        d_descuento2 = parseFloat($(this).text());
                    break;
                    case 7: 
                        d_total = d_total + parseFloat($(this).text());
                    break;
                }
                //$(this).css("background-color", "#ECF8E0");
            });
            d_sub_total = d_sub_total + ((cantidad * precio) - d_descuento2);
        });

        sub_total.value = Math.round(d_sub_total * 100) / 100;   
        impuesto.value = Math.round(d_impuesto * 100) / 100;   
        descuento.value = Math.round(d_descuento * 100) / 100;   
        total.value = Math.round((d_sub_total + d_impuesto) * 100) / 100;   
    }
