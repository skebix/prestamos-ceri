<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 10:44 AM
 */
?>

<span class="glyphicon glyphicon-envelope"></span><?= $this->session->mensaje; ?>

<div class="panel panel-default">
    <div class="panel-heading">Detalles de la solicitud</div>
    <div class="container">
        <p><strong>Solicitante:</strong></p>
        {primer_nombre} {segundo_nombre} {primer_apellido} {segundo_apellido}
        <hr>
        <p><strong>Fecha de solicitud:</strong></p>
            {fecha_solicitud}
        <hr>
        <p><strong>Fecha de uso:</strong></p>
            {fecha_uso}
        <hr>

        <?php if(!empty($equipos)): ?>
        <p><strong>Equipos reservados:</strong></p>
        <ul>
            {equipos}
                <li>{nombre_equipo}</li>
            {/equipos}
        </ul>
        <hr>
        <?php endif; ?>

        <?php if(!empty($espacios)): ?>
        <p><strong>Espacios reservados:</strong></p>
        <ul>
            {espacios}
            <li>{nombre_espacio}</li>
            {/espacios}
        </ul>
        <hr>
        <?php endif; ?>

        <?php if(!empty($servicios)): ?>
        <p><strong>Servicios reservados:</strong></p>
        <ul>
            {servicios}
            <li>{nombre_servicio}</li>
            {/servicios}
        </ul>
        <?php endif; ?>

        <div class="form-group">
            <form action="<?= base_url('solicitudes/cerrar/{id}') ?>" method="post">
                <button type="submit" class="btn btn-danger">Cerrar solicitud</button>
            </form>
        </div>
    </div>
</div>
<button class="btn-default"><a href="<?= base_url('') ?>">Volver</a></button>
</a>