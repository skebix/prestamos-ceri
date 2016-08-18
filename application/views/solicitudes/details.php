<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 10:44 AM
 */
?>

<div class="panel panel-default">
    <div class="panel-heading">Detalles de la solicitud</div>
    <table class="table">
        <tbody>
            <th>Solicitante</th>
            {usuario}
            <tr><td>{primer_nombre} {segundo_nombre} {primer_apellido} {segundo_apellido}</td></tr>
            {/usuario}
            <th>Fecha de solicitud</th>
            {solicitud}
            <tr><td>{fecha_solicitud}</td></tr>
            {/solicitud}
            <th>Fecha de uso</th>
            {solicitud}
            <tr><td>{fecha_uso}</td></tr>
            {/solicitud}
            <th>Equipos reservados</th>
            {equipos}
            <tr><td>{nombre_equipo}</td></tr>
            {/equipos}
            <th>Espacios reservados</th>
            {espacios}
            <tr><td>{nombre_espacio}</td></tr>
            {/espacios}
            <th>Servicios reservados</th>
            {servicios}
            <tr><td>{nombre_servicio}</td></tr>
            {/servicios}
        </tbody>
    </table>
</div>
<button class="btn-default"><a href="<?= base_url('') ?>">Volver</a></button>
</a>