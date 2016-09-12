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
    <div class="container">
        <p><strong>Solicitante:</strong></p>
        {usuario}
        {primer_nombre} {segundo_nombre} {primer_apellido} {segundo_apellido}
        {/usuario}
        <hr>
        <p><strong>Fecha de solicitud:</strong></p>
        {solicitud}
        {fecha_solicitud}
        {/solicitud}
        <hr>
        <p><strong>Fecha de uso:</strong></p>
        {solicitud}
        {fecha_uso}
        {/solicitud}
        <hr>
        <p><strong>Equipos reservados:</strong></p>
        {equipos}
        nombre_equipo}
        {/equipos}
        <hr>
        <p><strong>Espacios reservados:</strong></p>
        {espacios}
        {nombre_espacio}
        {/espacios}
        <hr>
        <p><strong>Servicios reservado:</strong></p>
        {servicios}
        {nombre_servicio}
        {/servicios}
    </div>
</div>
<button class="btn-default"><a href="<?= base_url('') ?>">Volver</a></button>
</a>