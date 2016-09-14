<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 10:44 AM
 */
?>

<span class="glyphicon glyphicon-envelope"></span> <?= $this->session->mensaje; ?>

<div class="panel panel-default">
    <div class="panel-heading">Lista de solicitudes</div>
    <div class="panel-body">
        <p>Aquí se encuentran las solicitudes válidas y activas
        </p>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Solicitante</th>
            <th>Fecha de solicitud</th>
            <th>Fecha de uso</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        {solicitudes}
        <tr>
            <th scope="row">{id}</th>
            <td>{primer_nombre} {segundo_nombre} {primer_apellido} {segundo_apellido}</td>
            <td>{fecha_solicitud}</td>
            <td>{fecha_uso}</td>
            <td>
                <a href="<?= base_url('solicitudes/actualizar/{id}') ?>">Actualizar</a> /
                <a href="<?= base_url('solicitudes/eliminar/{id}') ?>">Eliminar</a> /
                <a href="<?= base_url('solicitudes/detalles/{id}') ?>">Ver Detalles</a>
            </td>
        </tr>
        {/solicitudes}
        </tbody>
    </table>
</div>
<a href="<?= base_url('') ?>">Volver</a>
<a class="logout-button" href="<?= base_url('solicitudes/crear') ?>">
    <button type="button" class="btn btn-primary">
        Crear solicitud
    </button>
</a>