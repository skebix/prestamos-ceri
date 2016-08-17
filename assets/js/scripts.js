/**
 * Created by skebix on 31/03/2016.
 */

$(document).ready(function(){

    $(".help-block").parent().parent().addClass('has-error');

    $(function () {
        $('#fecha_uso').datetimepicker({
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

    var cantidad_clicks_nuevo_equipo = 0;
    var equipos = [];

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
                    nuevo_equipo(data);
                },
                error: function() {
                    console.log(base_url + "solicitudes/nuevo-equipo");
                }
            });
        }else{
            nuevo_equipo(equipos);
        }
    });

    function nuevo_equipo(equipos){
        $('#nuevo-equipo').append('<div id="div-nuevo-equipo-' + cantidad_clicks_nuevo_equipo + '"><select class="form-control" name="select-nuevo-equipo-' + cantidad_clicks_nuevo_equipo + '" id="select-nuevo-equipo-' + cantidad_clicks_nuevo_equipo + '"></select><button type="button" class="btn btn-danger" id="eliminar-equipo-' + cantidad_clicks_nuevo_equipo + '">Eliminar equipo</button></div>');

        $.each(equipos, function(index, value){
            $('#select-nuevo-equipo-' + cantidad_clicks_nuevo_equipo).append('<option value=' + value['id'] + '>' + value['nombre_equipo'] + '</option>');
        });

        cantidad_selects = $('select[id^="select-nuevo-equipo-"]').length;

        if(cantidad_selects != 1){
            var opciones_seleccionadas = $.map($('select[id^="select-nuevo-equipo-"] option:selected'), function(n){
                return n.value;
            });

            var lista_equipos = $.map(equipos, function(n){
                return n['id'];
            });

            var equipos_disponibles = lista_equipos.diff(opciones_seleccionadas);

            $('#select-nuevo-equipo-' + cantidad_clicks_nuevo_equipo + ' option:selected').removeAttr('selected');
            $('#select-nuevo-equipo-' + cantidad_clicks_nuevo_equipo + ' option[value="' + equipos_disponibles[0] + '"]').attr('selected','selected');
        }

        if(cantidad_selects == equipos.length){
            $('.nuevo-equipo').addClass('hidden');
        }

        cantidad_clicks_nuevo_equipo = cantidad_clicks_nuevo_equipo + 1;
    }

    $("#nuevo-equipo").on("change", 'select[id^="select-nuevo-equipo-"]' , function(){
        var opciones = $('select[id^="select-nuevo-equipo-"] option');

        opciones.prop("disabled","");

        var opciones_seleccionadas = $.map($('select[id^="select-nuevo-equipo-"] option:selected'), function(n){
            return n.value;
        });

        opciones.filter(function(){
            return $.inArray($(this).val(), opciones_seleccionadas) > -1;
        }).prop("disabled", "disabled");

        opciones.filter(function(){
            return $.inArray($(this).val(), opciones_seleccionadas) == -1;
        }).prop("disabled", "");

    }).trigger("change");

    Array.prototype.diff = function(a){
        return this.filter(function(i){
            return a.indexOf(i) < 0;
        });
    };

    /*var opciones_seleccionadas = $('select[id^="select-nuevo-equipo-"] :selected');

    function manejar_agregar_equipos(equipos){
        $('#nuevo-equipo').append('<div id="div-nuevo-equipo-' + cantidad_clicks_nuevo_equipo + '"><select class="form-control" name="select-nuevo-equipo-' + cantidad_clicks_nuevo_equipo + '" id="select-nuevo-equipo-' + cantidad_clicks_nuevo_equipo + '"></select><button type="button" class="btn btn-danger" id="eliminar-equipo-' + cantidad_clicks_nuevo_equipo + '">Eliminar equipo</button></div>');

        opciones_seleccionadas = $('select[id^="select-nuevo-equipo-"] :selected');

        if(cantidad_clicks_nuevo_equipo == 0){
            $.each(equipos, function(index, value){
                $('#select-nuevo-equipo-' + cantidad_clicks_nuevo_equipo).append('<option value=' + value['id'] + '>' + value['nombre_equipo'] + '</option>');
            });
        }else{
            equipos_en_uso = [];

            opciones_seleccionadas.each(function(index){
                equipos_en_uso[index] = this.value;
            });

            $.each(equipos, function(index, value){
                if(equipos_en_uso.indexOf(value['id']) == -1) {
                    $('#select-nuevo-equipo-' + cantidad_clicks_nuevo_equipo).append('<option value=' + value['id'] + '>' + value['nombre_equipo'] + '</option>');
                }
            });
        }

        if(opciones_seleccionadas.length == equipos.length - 1){
            $('.nuevo-equipo').addClass('hidden');
        }

        cantidad_clicks_nuevo_equipo = cantidad_clicks_nuevo_equipo + 1;
    }

    var previous_nuevo_equipo;

    $("#nuevo-equipo").on({
        "focus" : function(e){
            previous_nuevo_equipo = $(this).val();
        },
        "change" : function(e){

            todos_select = $('select[id^="select-nuevo-equipo-"]');

            todos_select.each(function(index){
                $(this).append('<option value=' + equipos_disponibles[previous_nuevo_equipo - 1]['id'] + '>' + equipos_disponibles[previous_nuevo_equipo - 1]['nombre_equipo'] + '</option>');
            });

            previous_nuevo_equipo = $(this).val();
        }
    }, 'select[id^="select-nuevo-equipo-"]');

    $("#nuevo-equipo").on("click", 'button[id^="eliminar-equipo-"]' , function(){
        select_equipos = $(this).prev();
        valor = select_equipos.val();
        console.log(valor + '++++');
        $(this).parent().remove();
        $('.nuevo-equipo').removeClass('hidden');
    });

    */

});