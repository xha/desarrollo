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
    var td = trae('listado_detalle');
    var i;
    
    $.get('../transaccion/buscar-detalle-solicitud',{id_transaccion : id_transaccion, serv : 1},function(data){
        var data = $.parseJSON(data);
        var campos = Array();
        if (data!="") {
            for (i = 0; i < data.length; i++) {
                var ul = document.createElement('ul');
                var div = document.createElement('div');
                var li = document.createElement('li');
                var node = document.createTextNode(data[i].CodItem+" - "+data[i].descripcion);
                
                ul.style.float = "left";
                ul.style.width = "33%";
                li.appendChild(node);
                ul.appendChild(li);
                div.appendChild(ul);
                td.appendChild(div);
            }
        }
    });
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