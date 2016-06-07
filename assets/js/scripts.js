/**
 * Created by skebix on 31/03/2016.
 */

$(document).ready(function(){
    $(".help-block").parent().parent().addClass('has-error');

    $(function () {
        $('.date').datetimepicker({
            format: 'YYYY/MM/DD'
        });
    });

});