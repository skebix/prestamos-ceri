<?php
/**
 * Created by PhpStorm.
 * User: SkyDaddy
 * Date: 26/6/2016
 * Time: 5:15 PM
 */
?>
<div class="panel panel-default">
    <a data-toggle="collapse" href="#collapsetb1" aria-expanded="false" aria-controls="collapsetb1">
        <div class="panel-heading text-center">
            <i class="fa fa-list-alt fa-3x"></i>
            <br>
            <strong>Estad&iacute;sticas del servicio de pr&eacute;stamos por categor&iacute;as de usuario</strong>
        </div>
    </a>
    <div class="panel-body">
        <div class="dataTable_wrapper collapse" id="collapsetb1">
            <table class="table table-bordered table-hover" id="datatable">
                <thead>
                <tr>
                    <th class="text-center">Tipo de usuario</th>
                    <th class="text-center">Cantidad de usuarios</th>
                    <th class="text-center">Tiempo de pr&eacute;stamos</th>
                </tr>
                </thead>
                <tbody>
                {category_stats}
                <tr>
                    <td scope="row">{categoria}</td>
                    <td class="text-center">{cantidad}</td>
                    <td class="text-center">{tiempo}</td>
                </tr>
                {/category_stats}
                <tr>
                    <th scope="row">TOTALES</th>
                    <th class="text-center"><?php echo $summary['cantidad_total']; ?></th>
                    <th class="text-center"><?php echo $summary['tiempo_total']; ?></th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <a data-toggle="collapse" href="#collapsetb2" aria-expanded="false" aria-controls="collapsetb2">
        <div class="panel-heading text-center">
            <i class="fa fa-bank fa-3x"></i>
            <br>
            <strong>Estad&iacute;sticas de pr&eacute;stamos de salas y espacios</strong>
        </div>
    </a>
    <div class="panel-body">
        <div class="dataTable_wrapper collapse" id="collapsetb2">
            <table class="table table-bordered table-hover" id="datatable2">
                <thead>
                <tr>
                    <th class="text-center">Salas y espacios</th>
                    <th class="text-center">Cantidad de prestamos</th>
                    <th class="text-center">Tiempo de uso</th>
                </tr>
                </thead>
                <tbody>
                {materials_stats}
                <tr>
                    <td scope="row">{espacio}</td>
                    <td class="text-center">{cantidad_prestamo}</td>
                    <td class="text-center">{tiempo_prestamo}</td>
                </tr>
                {/materials_stats}
                <tr>
                    <th scope="row">TOTALES</th>
                    <th class="text-center"><?php echo $summary2['cantidad_total']; ?></th>
                    <th class="text-center"><?php echo $summary2['tiempo_total']; ?></th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Seccion de estadisticas de uso de salas y espacios-->
<div class="panel panel-default">
    <a data-toggle="collapse" href="#collapsetb3" aria-expanded="false" aria-controls="collapsetb3">
        <div class="panel-heading text-center">
            <i class="fa fa-video-camera fa-3x"></i>
            <br>
            <strong>Estad&iacute;sticas de usos de salas y espacios</strong>
        </div>
    </a>
    <div class="panel-body">
        <div class="dataTable_wrapper collapse" id="collapsetb3">
            <table class="table table-bordered table-hover" id="datatable3">
                <thead>
                <tr>
                    <th class="text-center">Uso de salas y espacios</th>
                    <th class="text-center">Cantidad de prestamos</th>
                    <th class="text-center">Tiempo de uso</th>
                </tr>
                </thead>
                <tbody>
                {use_stats}
                <tr>
                    <td scope="row">{uso_espacio}</td>
                    <td class="text-center">{cantidad_prestamo}</td>
                    <td class="text-center">{tiempo_prestamo}</td>
                </tr>
                {/use_stats}
                <tr>
                    <th scope="row">TOTALES</th>
                    <th class="text-center"><?php echo $summary3['cantidad_total']; ?></th>
                    <th class="text-center"><?php echo $summary3['tiempo_total']; ?></th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Seccion de estadisticas de equipos-->
<div class="panel panel-default">
    <a data-toggle="collapse" href="#collapsetb4" aria-expanded="false" aria-controls="collapsetb4">
        <div class="panel-heading text-center">
            <i class="fa fa-laptop fa-3x"></i>
            <br>
            <strong>Estad&iacute;sticas del servicio de pr&eacute;stamos de equipos</strong>
        </div>
    </a>
    <div class="panel-body">
        <div class="dataTable_wrapper collapse" id="collapsetb4">
            <table class="table table-bordered table-hover" id="datatable4">
                <thead>
                <tr>
                    <th class="text-center">Equipos</th>
                    <th class="text-center">Cantidad de prestamos</th>
                    <th class="text-center">Tiempo de uso</th>
                </tr>
                </thead>
                <tbody>
                {stuff_stats}
                <tr>
                    <td scope="row">{equipos}</td>
                    <td class="text-center">{cantidad_prestamo}</td>
                    <td class="text-center">{tiempo_prestamo}</td>
                </tr>
                {/stuff_stats}
                <tr>
                    <th scope="row">TOTALES</th>
                    <th class="text-center"><?php echo $summary4['cantidad_total']; ?></th>
                    <th class="text-center"><?php echo $summary4['tiempo_total']; ?></th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>