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

            if (i_items.value!="") document.forms['w0'].submit();
        } else {
            alert("Faltan datos");
        }
    }

    function procesar_condominio() {
        var numerod = document.getElementById('numerod').value;
        var cliente = document.getElementById('cliente').value;
        var id_usuario = document.getElementById('id_usuario').value;
        var btn_enviar = document.getElementById('btn_enviar');
        var imag = document.getElementById('imag');

        if ((numerod!="") && (cliente)) {
            btn_enviar.disabled = true;
            imag.style.visibility = 'visible';
            $.get('../presupuesto/procesar-condominio',{numerod : numerod, usuario: id_usuario},function(data){
                var data = $.parseJSON(data);
                respuesta(data.salida);
                btn_enviar.disabled = false;
                imag.style.visibility = 'hidden';
                window.location = window.location;
            });
        }
    }        

    function buscar_presupuesto() {
        var numerod = trae("numerod");
        var cliente = trae("cliente");
        var descripcion = trae("descripcion");
        var vendedor = trae("vendedor");
        var ubicacion = trae("ubicacion");
        var fecha = trae("fecha");
        var descuento = trae("descuento");
        var sub_total = trae("sub_total");
        var impuesto = trae("impuesto");
        var total = trae("total");
        var tabla = trae('listado_detalle');

        limpiar_campos();
        if (numerod.value!="") {
            $.get('../presupuesto/buscar-encabezado',{numerod : numerod.value},function(data){
                var data = $.parseJSON(data);
                if (data!="") {
                    cliente.value = data[0].CodClie;    
                    descripcion.value = data[0].Descrip;    
                    vendedor.value = data[0].CodVend;    
                    ubicacion.value = data[0].CodUbic;    
                    fecha.value = convertDateFormat(data[0].FechaE);    
                    descuento.value = number_format(data[0].DesctoP);
                    sub_total.value = number_format(data[0].Monto);
                    impuesto.value = number_format(data[0].MtoTax);
                    total.value = number_format(data[0].MtoTotal);    
                    $.get('../presupuesto/buscar-detalle',{numerod : numerod.value},function(data2){
                        var data2 = $.parseJSON(data2);
                        var campos = Array();
                        if (data2!="") {
                            for (i = 0; i < data2.length; i++) {
                                campos.length = 0;
                                campos.push(data2[i].NroLinea);
                                campos.push(data2[i].CodItem);
                                campos.push(data2[i].Descrip1);
                                campos.push(number_format(data2[i].Cantidad,2));
                                campos.push(number_format(data2[i].Precio,2));
                                campos.push(number_format(data2[i].MtoTax,2));
                                campos.push(number_format(data2[i].Descto,2));
                                campos.push(number_format(data2[i].TotalItem,2));
                                tabla.appendChild(add_filas(campos, 'td','','',7));
                            }     
                        }
                    });
                }
            });
        }
    }

    function limpiar_campos(){
        trae("cliente").value = "";
        trae("descripcion").value = "";
        trae("vendedor").value = "";
        trae("ubicacion").value = "";
        trae("fecha").value = "";
        trae("descuento").value = "";
        trae("sub_total").value = "";
        trae("impuesto").value = "";
        trae("total").value = "";
        trae('listado_detalle').innerHTML = "";
        title_tabla();
    }

    function title_tabla() {
        var tabla = trae('listado_detalle');
        var arreglo = new Array();
            arreglo[0] = 'Nro';
            arreglo[1] = 'Código';
            arreglo[2] = 'Descripción';
            arreglo[3] = 'Cantidad';
            arreglo[4] = 'Precio';
            arreglo[5] = 'Tax';
            arreglo[6] = 'Descuento';
            arreglo[7] = 'Total';

        tabla.innerHTML = "";
        tabla.appendChild(add_filas(arreglo, 'th','','',7));
    }