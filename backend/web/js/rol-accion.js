var num_acciones;
$(function() {
    buscar_acciones();    
    buscar_rol_accion();
});

function buscar_rol_accion() {
    var rol = trae('rolaccion-id_rol').value;
    
    if (rol!="") {
        $.get('../rol-accion/buscar-accion',{rol : rol},function(data){
            var data = $.parseJSON(data);

            if (data!="") {
                for (var i = 0; i < data.length; i++) {
                    trae("i_accion_"+data[i].id_accion).checked = true;
                }
            }
        });
    }
}

function buscar_acciones() {
    var div_accion = trae('div_accion');
    num_acciones=0;
    $.get('../rol-accion/buscar-accion',{},function(data){
        var data = $.parseJSON(data);
        
        if (data!="") {
            num_acciones = data.length;
            for (var i = 0; i < data.length; i++) {
                var div = document.createElement('div');
                var input1 = document.createElement('input');
                var b = document.createElement('b');
                    
                div.align="left";
                div.id="d_accion_"+i;
                div.style= "width: 24%; float: left; padding: 5px";
                b.style= "padding: 5px";
                b.innerHTML = data[i].descripcion;
                
                input1.type = "checkbox";
                input1.id = "i_accion_"+data[i].id_accion;
                input1.style.marginRight = "4px";

                div.appendChild(input1);
                div.appendChild(b);
                div_accion.appendChild(div);
            }
        }
    });
}

function seleccionar_todos() {
    var seleccionar = trae('seleccionar');
    
    $("#div_accion :input").each(function(){	
        if (seleccionar.checked) {
            this.checked = true;
        } else {
            this.checked = false;
        }
    });
}

function enviar_data() {
    var i_items = document.getElementById('i_items');
    var rol = trae('rolaccion-id_rol').value;
    
    i_items.value = "";
    
    if (rol!="") {
        $("#div_accion :input").each(function(){	
            var campos = this.id.split("_");
            if (this.checked) {
                i_items.value+= campos[2]+"#";
            }
        });

        if (i_items.value!="") document.forms['w0'].submit();
    } else {
        alert("Faltan datos");
    }
}