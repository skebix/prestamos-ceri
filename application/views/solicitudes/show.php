<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 10:44 AM
 */
?>

<?= $this->session->mensaje; ?><br><br>

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
            <th>Fecha de solicitud</th>
            <th>Fecha de uso</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        {solicitudes}
        <tr>
            <th scope="row">{id}</th>
            <td>{fecha_solicitud}</td>
            <td>{fecha_uso}</td>
            <td><a href="<?= base_url('solicitudes/actualizar/{id}') ?>">Actualizar</a></td>
            <td><a href="<?= base_url('solicitudes/eliminar/{id}') ?>">Eliminar</a></td>
        </tr>
        {/solicitudes}
        </tbody>
    </table>
</div>
<a href="<?= base_url('prestamos-ceri') ?>">Volver</a>
<a class="logout-button" href="<?= base_url('solicitudes/crear') ?>">
    <button type="button" class="btn btn-primary">
        Crear solicitud
    </button>
</a>