/**
 * Created by skebix on 31/03/2016.
 */

$(document).ready(function(){

    $(".help-block").parent().parent().addClass('has-error');

    $(function () {
        $('#fecha_uso').datetimepicker({ //Poner minDate: new Date() si se quiere que la fecha no pueda ser anterior a hoy
            format: 'DD/MM/YYYY',
            minDate: new Date(),
            locale: 'es'
        });
    });

    var hora_entrega = $('#hora_entrega');
    var hora_devolucion = $('#hora_devolucion');

    hora_entrega.datetimepicker({
        format: 'hh:mm A',
        minDate: moment().startOf('day'),
        maxDate: moment().endOf('day'),
        locale: 'es'
    });

    hora_devolucion.datetimepicker({
        format: 'hh:mm A',
        useCurrent: false,
        minDate: moment().startOf('day'),
        maxDate: moment().endOf('day'),
        locale: 'es'
    });

    hora_entrega.on("dp.change", function(e) {
        hora_devolucion.data("DateTimePicker").minDate(e.date);
    });

    hora_devolucion.on("dp.change", function(e) {
        hora_entrega.data("DateTimePicker").maxDate(e.date);
    });

    hora_devolucion.on("dp.show", function(e) {
        if (!hora_devolucion.data("DateTimePicker").date()) {
            var defaultDate = hora_entrega.data("DateTimePicker").date().add(1, 'hours');
            hora_devolucion.data("DateTimePicker").defaultDate(defaultDate);
        }
    });

    Array.prototype.diff = function(a){
        return this.filter(function(i){
            return a.indexOf(i) < 0;
        });
    };

    var equipos = [];
    var equipos_disponibles = [];
    var valor_equipo_anterior = -1;

    function ajax_equipos(){

        var fecha_uso = $("input[name='fecha_uso']").val();
        var hora_entrega = $("input[name='hora_entrega']").val();
        var hora_devolucion = $("input[name='hora_devolucion']").val();

        $.ajax({
            type: "POST",
            url: base_url + "solicitudes/nuevo-equipo",
            dataType: 'json',
            data: {fecha_uso: fecha_uso, hora_entrega: hora_entrega, hora_devolucion: hora_devolucion},
            success: function(data){
                equipos = data;

                selects_equipos = $('select[id^="select_nuevo_equipo_"]');

                selects_equipos.each(function(index) {
                    valor_actual = $(this).val();
                    texto_equipo = equipos.find(function by_value(o) {
                        return o.id === valor_actual;
                    }).nombre_equipo;
                    $(this).empty();
                    $(this).append('<option value="' + valor_actual + '">' + texto_equipo + '</option>');
                });

                actualizar_selects_equipos();

                cantidad_selects = selects_equipos.length;

                if(cantidad_selects == equipos.length){
                    $('.nuevo-equipo').addClass('hidden');
                }
            },
            error: function() {
                console.log(base_url + "solicitudes/nuevo-equipo");
            }
        });
    }

    if (typeof cantidad_clicks_nuevo_equipo == 'undefined') {
        cantidad_clicks_nuevo_equipo = 0;
    }

    $(".nuevo-equipo").click(function(event) {
        event.preventDefault();

        if(cantidad_clicks_nuevo_equipo == 0){
            var fecha_uso = $("input[name='fecha_uso']").val();
            var hora_entrega = $("input[name='hora_entrega']").val();
            var hora_devolucion = $("input[name='hora_devolucion']").val();
            $.ajax({
                type: "POST",
                url: base_url + "solicitudes/nuevo-equipo",
                dataType: 'json',
                data: {fecha_uso: fecha_uso, hora_entrega: hora_entrega, hora_devolucion: hora_devolucion},
                success: function(data){
                    equipos = data;

                    equipos_disponibles = get_equipos_disponibles();

                    nuevo_equipo(equipos);
                },
                error: function() {
                    console.log(base_url + "solicitudes/nuevo-equipo");
                }
            });
        }else{
            nuevo_equipo(equipos);
        }
    });

    function get_equipos_disponibles(){
        opciones_seleccionadas = $.map($('select[id^="select_nuevo_equipo_"] option:selected'), function(n){
            return n.value;
        });

        lista_equipos = $.map(equipos, function(n){
            return n['id'];
        });

        equipos_disponibles = lista_equipos.diff(opciones_seleccionadas);

        return equipos_disponibles;
    }

    function actualizar_selects_equipos(){
        equipos_disponibles = get_equipos_disponibles();

        $('select[id^="select_nuevo_equipo_"] option').not(':selected').remove();

        for(i = 0; i < equipos.length; i++) {
            index = equipos_disponibles.indexOf(equipos[i].id);
            if(index != -1){
                $('select[id^="select_nuevo_equipo_"]').append('<option value="' + equipos[i].id + '">' + equipos[i].nombre_equipo + '</option>');
            }
        }
    }

    function nuevo_equipo(equipos){

        $('#nuevo-equipo').append('<div id="div-nuevo-equipo-' + cantidad_clicks_nuevo_equipo +
            '"><select class="form-control"' + 'id="select_nuevo_equipo_' + cantidad_clicks_nuevo_equipo +
            '" name="select_nuevo_equipo[]"></select><button type="button" class="btn btn-danger" id="eliminar-equipo-' + cantidad_clicks_nuevo_equipo +
            '">Eliminar equipo</button></div>');

        equipos_disponibles = get_equipos_disponibles();

        valor_primer_equipo = equipos_disponibles.shift();
        texto_primer_equipo = equipos.find(function by_value(o) {
            return o.id === valor_primer_equipo;
        }).nombre_equipo;
        $('#select_nuevo_equipo_' + cantidad_clicks_nuevo_equipo).append('<option value="' + valor_primer_equipo + '">' + texto_primer_equipo + '</option>');

        actualizar_selects_equipos();

        cantidad_selects = $('select[id^="select_nuevo_equipo_"]').length;

        if(cantidad_selects == equipos.length){
            $('.nuevo-equipo').addClass('hidden');
        }

        cantidad_clicks_nuevo_equipo = cantidad_clicks_nuevo_equipo + 1;
    }

    $("#nuevo-equipo").on({
        "focus" : function(e) {
            valor_equipo_anterior = $(this).val();
            $(this).blur();
        },
        "change" : function(e) {
            equipos_disponibles.push(valor_equipo_anterior);
            index = equipos_disponibles.indexOf($(this).val());
            if(index != -1){
                equipos_disponibles.splice(index, 1);
            }
            actualizar_selects_equipos();
        }
    }, 'select[id^="select_nuevo_equipo_"]');


    $("#nuevo-equipo").on("click", 'button[id^="eliminar-equipo-"]' , function(){
        select_equipos = $(this).prev();
        valor = select_equipos.val();
        $(this).parent().remove();
        $('.nuevo-equipo').removeClass('hidden');
        equipos_disponibles.push(valor);
        actualizar_selects_equipos();
    });

    var espacios = [];
    var usos = [];
    var espacios_disponibles = [];
    var valor_espacio_anterior = -1;
    var valor_uso_anterior =  -1;
    var index_otro_espacio = -1;
    var index_otro_uso = -1;
    var valor_otro_espacio = -1;
    var valor_otro_uso = -1;

    function ajax_espacios(){

        var fecha_uso = $("input[name='fecha_uso']").val();
        var hora_entrega = $("input[name='hora_entrega']").val();
        var hora_devolucion = $("input[name='hora_devolucion']").val();

        $.ajax({
            type: "POST",
            url: base_url + "solicitudes/nuevo-espacio",
            dataType: 'json',
            data: {fecha_uso: fecha_uso, hora_entrega: hora_entrega, hora_devolucion: hora_devolucion},
            success: function(data){
                espacios = data.espacios;
                usos = data.usos;

                for(i = 0; i < espacios.length; i++) {
                    if(espacios[i].nombre_espacio == 'Otro (especifique)'){
                        index_otro_espacio = i;
                        valor_otro_espacio = espacios[i].id;
                    }
                }

                for(i = 0; i < usos.length; i++) {
                    if(usos[i].uso == 'Otro (especifique)'){
                        index_otro_uso = i;
                        valor_otro_uso = usos[i].id;
                    }
                }

                selects_espacios = $('select[id^="select_nuevo_espacio_"]');

                selects_espacios.each(function(index) {
                    valor_actual = $(this).val();
                    texto_espacio = espacios.find(function by_value(o) {
                        return o.id === valor_actual;
                    }).nombre_espacio;
                    $(this).empty();
                    $(this).append('<option value="' + valor_actual + '">' + texto_espacio + '</option>');
                });

                selects_usos = $('select[id^="select_usos_espacio_"]');

                selects_usos.each(function(index) {
                    valor_actual = $(this).val();

                    texto_uso = usos.find(function by_value(o) {
                        return o.id === valor_actual;
                    }).uso;
                    $(this).empty();
                    $(this).append('<option value="' + valor_actual + '">' + texto_uso + '</option>');
                });

                selects_usos.each(function(index) {
                    for(i = 0; i < usos.length; i++) {
                        if($(this).val() != usos[i].id){
                            $(this).append('<option value="' + usos[i].id + '">' + usos[i].uso + '</option>');
                        }
                    }
                });

                actualizar_selects_espacios();
            },
            error: function() {
                console.log(base_url + "solicitudes/nuevo-espacio");
            }
        });
    }

    if (typeof cantidad_clicks_nuevo_espacio == 'undefined') {
        cantidad_clicks_nuevo_espacio = 0;
    }

    $(".nuevo-espacio").click(function(event) {
        event.preventDefault();

        if(cantidad_clicks_nuevo_espacio == 0){
            var fecha_uso = $("input[name='fecha_uso']").val();
            var hora_entrega = $("input[name='hora_entrega']").val();
            var hora_devolucion = $("input[name='hora_devolucion']").val();
            $.ajax({
                type: "POST",
                url: base_url + "solicitudes/nuevo-espacio",
                dataType: 'json',
                data: {fecha_uso: fecha_uso, hora_entrega: hora_entrega, hora_devolucion: hora_devolucion},
                success: function(data){
                    espacios = data.espacios;
                    usos = data.usos;

                    for(i = 0; i < espacios.length; i++) {
                        if(espacios[i].nombre_espacio == 'Otro (especifique)'){
                            index_otro_espacio = i;
                            valor_otro_espacio = espacios[i].id;
                        }
                    }

                    espacios_disponibles = get_espacios_disponibles();

                    nuevo_espacio(espacios, usos);
                },
                error: function() {
                    console.log(base_url + "solicitudes/nuevo-espacio");
                }
            });
        }else{
            nuevo_espacio(espacios, usos);
        }
    });

    function get_espacios_disponibles(){
        opciones_seleccionadas = $.map($('select[id^="select_nuevo_espacio_"] option:selected'), function(n){
            if(n.text != 'Otro (especifique)'){
                return n.value;
            }
        });

        lista_espacios = $.map(espacios, function(n){
            return n['id'];
        });

        espacios_disponibles = lista_espacios.diff(opciones_seleccionadas);

        return espacios_disponibles;
    }

    function actualizar_selects_espacios(){

        espacios_disponibles = get_espacios_disponibles();

        espacios_disponibles.sort();

        $('select[id^="select_nuevo_espacio_"] option').not(':selected').remove();

        $('select[id^="select_nuevo_espacio_"]').each(function(index) {
            for(i = 0; i < espacios_disponibles.length; i++) {

                texto_espacio = espacios.find(function by_value(o) {
                    return o.id === espacios_disponibles[i];
                }).nombre_espacio;

                if($(this).val() != valor_otro_espacio){
                    $(this).append('<option value="' + espacios_disponibles[i] + '">' + texto_espacio + '</option>');
                }else{
                    if(espacios_disponibles[i] != valor_otro_espacio){
                        $(this).append('<option value="' + espacios_disponibles[i] + '">' + texto_espacio + '</option>');
                    }
                }
            }
        });
    }

    function nuevo_espacio(espacios, usos){

        div_nuevo_equipo = $('#nuevo-espacio');

        div_nuevo_equipo.append('<div id="div-nuevo-espacio-' + cantidad_clicks_nuevo_espacio +
            '"><select class="form-control"' + 'id="select_nuevo_espacio_' + cantidad_clicks_nuevo_espacio +
            '" name="select_nuevo_espacio[]"></select><label for="select_usos_espacio[]" class="control-label">Qu&eacute; uso le dar&aacute; al espacio?</label><select class="form-control"' + 'id="select_usos_espacio_' + cantidad_clicks_nuevo_espacio +
            '" name="select_usos_espacio[]"></select><button type="button" class="btn btn-danger" id="eliminar-espacio-' + cantidad_clicks_nuevo_espacio +
            '">Eliminar espacio</button></div>');

        for(i = 0; i < usos.length; i++){
            $('#select_usos_espacio_' + cantidad_clicks_nuevo_espacio).append('<option value="' + usos[i].id + '">' + usos[i].uso + '</option>');
        }

        espacios_disponibles = get_espacios_disponibles();

        valor_primer_espacio = espacios_disponibles.shift();

        if(valor_primer_espacio == valor_otro_espacio){
            espacios_disponibles.push(valor_primer_espacio);
        }

        texto_primer_espacio = espacios.find(function by_value(o) {
            return o.id === valor_primer_espacio;
        }).nombre_espacio;

        select_nuevo_espacio = $('#select_nuevo_espacio_' + cantidad_clicks_nuevo_espacio);
        select_nuevo_espacio.append('<option value="' + valor_primer_espacio + '">' + texto_primer_espacio + '</option>');

        if(select_nuevo_espacio.val() == valor_otro_espacio){
            $('<input type="text" class="form-control" name="input_nuevo_espacio[]" id="input_nuevo_espacio_' + cantidad_clicks_nuevo_espacio + '" />').insertAfter(select_nuevo_espacio);
        }

        actualizar_selects_espacios();

        cantidad_clicks_nuevo_espacio = cantidad_clicks_nuevo_espacio + 1;
    }

    $("#nuevo-espacio").on({
        "focus" : function(e) {
            valor_espacio_anterior = $(this).val();
            $(this).blur();
        },
        "change" : function(e) {
            index = -1;
            if(valor_espacio_anterior != valor_otro_espacio){
                espacios_disponibles.push(valor_espacio_anterior);
            }else{
                $(this).siblings('input[id^="input_nuevo_espacio_"]').remove();
            }
            if($(this).val() != valor_otro_espacio){
                index = espacios_disponibles.indexOf($(this).val());
            }else{
                id_select_espacio = this.id;
                numero_de_select = id_select_espacio.substr(id_select_espacio.length - 1);
                $('<input type="text" class="form-control" name="input_nuevo_espacio[]" id="input_nuevo_espacio_' + numero_de_select + '" />').insertAfter($(this));
            }
            if(index != -1){
                espacios_disponibles.splice(index, 1);
            }

            actualizar_selects_espacios();
        }
    }, 'select[id^="select_nuevo_espacio_"]');

    $("#nuevo-espacio").on({
        "focus" : function(e) {
            valor_uso_anterior = $(this).val();
            $(this).blur();
        },
        "change" : function(e) {
            id_select_espacio = this.id;
            numero_de_select = id_select_espacio.substr(id_select_espacio.length - 1);
            if(valor_uso_anterior == valor_otro_espacio) {
                $('#input_otro_uso_' + numero_de_select).remove();
            }
            if($(this).val() == valor_otro_espacio){
                $('<input type="text" class="form-control" name="input_otro_uso[]" id="input_otro_uso_' + numero_de_select + '" data-id="' + numero_de_select + '" />').insertAfter($(this));
            }
        }
    }, 'select[id^="select_usos_espacio_"]');

    $("#nuevo-espacio").on("click", 'button[id^="eliminar-espacio-"]' , function(){
        select_espacios = $(this).siblings('select[id^="select_nuevo_espacio_"]');
        valor = select_espacios.val();
        $(this).parent().remove();

        if(valor != valor_otro_espacio){
            espacios_disponibles.push(valor);
        }

        actualizar_selects_espacios();
    });

    $(window).load(function() {
        if(typeof flag_update != 'undefined'){
            fu = moment(fu, 'YYYY-MM-DD').format('DD/MM/YYYY');
            he = moment(he, 'HH:mm:ss').format('hh:mm A');
            hd = moment(hd, 'HH:mm:ss').format('hh:mm A');

            sfu = $("input[name='fecha_uso']");
            she = $("input[name='hora_entrega']");
            shd = $("input[name='hora_devolucion']");

            sfu.val(fu);
            she.val(he);
            shd.val(hd);
        }

        if(cantidad_clicks_nuevo_equipo > 0){
            ajax_equipos();
        }

        if(cantidad_clicks_nuevo_espacio > 0){
            ajax_espacios();
        }
        
        if(cantidad_clicks_nuevo_servicio > 0){
            ajax_servicios();
        }
    });

    var servicios = [];

    function ajax_servicios(){
        $.ajax({
            type: "POST",
            url: base_url + "solicitudes/nuevo-servicio",
            dataType: 'json',
            data: {},
            success: function(data){
                servicios = data;

                selects_servicios = $('select[id^="select_nuevo_servicio_"]');

                selects_servicios.each(function(index) {
                    valor_actual = $(this).val();
                    texto_servicio = servicios.find(function by_value(o) {
                        return o.id === valor_actual;
                    }).categoria;
                    $(this).empty();
                    $(this).append('<option value="' + valor_actual + '">' + texto_servicio + '</option>');
                    for(i = 0; i < servicios.length; i++) {
                        if(servicios[i].id != valor_actual){
                            $(this).append('<option value="' + servicios[i].id + '">' + servicios[i].categoria + '</option>');
                        }
                    }
                });
            },
            error: function() {
                console.log(base_url + "solicitudes/nuevo-equipo");
            }
        });
    }

    if(typeof cantidad_clicks_nuevo_servicio == 'undefined'){
        cantidad_clicks_nuevo_servicio = 0;
    }

    $(".nuevo-servicio").click(function(event) {
        event.preventDefault();

        if(cantidad_clicks_nuevo_servicio == 0){
            $.ajax({
                type: "POST",
                url: base_url + "solicitudes/nuevo-servicio",
                dataType: 'json',
                data: {},
                success: function(data){
                    servicios = data;
                    nuevo_servicio(data);
                },
                error: function() {
                    console.log(base_url + "solicitudes/nuevo-servicio");
                }
            });
        }else{
            nuevo_servicio(servicios);
        }
    });

    function nuevo_servicio(servicios){
        $('#nuevo-servicio').append('<div id="div-nuevo-servicio-' + cantidad_clicks_nuevo_servicio + '"><select class="form-control" name="select_nuevo_servicio[]" id="select_nuevo_servicio_' + cantidad_clicks_nuevo_servicio + '"></select><input type="text" class="form-control" name="input_nuevo_servicio[]" id="input_nuevo_servicio_' + cantidad_clicks_nuevo_servicio + '" /><button type="button" class="btn btn-danger" id="eliminar-servicio-' + cantidad_clicks_nuevo_servicio + '">Eliminar servicio</button></div>');

        $.each(servicios, function(index, value){
            $('#select_nuevo_servicio_' + cantidad_clicks_nuevo_servicio).append('<option value=' + value['id'] + '>' + value['categoria'] + '</option>');
        });

        cantidad_clicks_nuevo_servicio = cantidad_clicks_nuevo_servicio + 1;
    }

    $("#nuevo-servicio").on("click", 'button[id^="eliminar-servicio-"]' , function(){
        select_servicios = $(this).prev();
        valor = select_servicios.val();
        $(this).parent().remove();
    });

});