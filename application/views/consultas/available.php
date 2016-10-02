<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/09/2016
 * Time: 14:31
 */
?>
<div class="panel panel-default">
    <div class="panel-heading text-center"><strong>Disponibilidad de equipos</strong></div>
    <div class="panel-body">
        <?php if(!empty($equipos)): ?>
            <div class="dataTable_wrapper">
                <div  class='text-center alert-success'>
                    <i class="fa fa-smile-o fa-3x"></i>
                    <br>
                    ¡Hay equipos disponibles en la fecha y horas seleccionadas!
                </div>
                <hr>
                <table class="table table-striped table-bordered table-hover" id="datatable">
                    <thead>
                    <tr>
                        <th>Nombre de Equipo</th>
                        <th>Categor&iacute;a de Equipo</th>
                    </tr>
                    </thead>
                    <tbody>
                    {equipos}
                    <tr>
                        <td>{nombre_equipo}</td>
                        <td>{categoria}</td>
                    </tr>
                    {/equipos}
                    </tbody>
                </table>
            </div>
        <?php else: ?>
        <div  class='text-center alert-info'>
            <i class="fa fa-frown-o fa-3x"></i>
            <br>
            ¡Lo sentimos! No hay equipos disponibles en la fecha y las horas seleccionadas.
        </div>
        <?php endif; ?>
    </div>
    <div class="panel-heading text-center"><strong>Disponibilidad de espacios</strong></div>
    <div class="panel-body">
        <?php if(!empty($espacios)): ?>
            <div class="dataTable_wrapper">
                <div  class='text-center alert-success'>
                    <i class="fa fa-smile-o fa-3x"></i>
                    <br>
                    ¡Hay espacios disponibles en la fecha y horas seleccionadas!
                </div>
                <hr>
                <table class="table table-striped table-bordered table-hover" id="datatable2">
                    <thead>
                    <tr>
                        <th>Nombre espacio</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($espacios as $espacio): ?>
                        <tr>
                            <td><?= $espacio['nombre_espacio'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div  class='text-center alert-info'>
                <i class="fa fa-frown-o fa-3x"></i>
                <br>
                ¡Lo sentimos! No hay espacios disponibles en la fecha y las horas seleccionadas.
            </div>
        <?php endif; ?>
    </div>
</div>