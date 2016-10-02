<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/09/2016
 * Time: 9:33
 */
?>
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><strong>{title}</strong></div>
        <div class="panel-body">
            <p class="text-center">Por favor confirme los datos del prestamo que será cerrado.</p>
            <p class="text-center alert-info"><strong>IMPORTANTE:</strong>
            <br>Confirme que el solicitante ha devuelto todos los equipos utilizados y desocupado los espacios prestados.
            Indique en el campo de observaciones el nivel de satisfacción del usuario con el servicio así como cualquier inquietud o eventualidad que haya ocurrido.
            </p>
            <hr>
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
            <form action="<?= base_url('solicitudes/cerrar/{id}') ?>" method="post">
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <div>
                        <?php echo form_error('observaciones'); ?>
                    </div>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="5" placeholder="Observaciones"></textarea>
                    <br>
                    <button type="submit" class="btn btn-danger">Confirmar cierre</button>
                    <a href="<?= base_url('solicitudes/recibir') ?>"><button type="button" class="btn btn-warning">Volver</button></a>
                </div>
            </form>
        </div>
    </div>
</div>