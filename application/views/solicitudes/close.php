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
            <hr>

            <ul class="list-group">
                <li class="list-group-item">Solicitud n&uacute;mero:   <strong>{id}</strong></li>
                <?php if(!empty($id_recibido)): ?>
                    <li class="list-group-item">Observaciones:   <strong>{observaciones}</strong></li>
                <?php endif; ?>
                <li class="list-group-item">Reservado por:   <strong>{primer_nombre_reservado} {segundo_nombre_reservado} {primer_apellido_reservado} {segundo_apellido_reservado}</strong></li>
                <?php if(!empty($id_recibido)): ?>
                    <li class="list-group-item">Recibido por:  <strong>{primer_nombre_recibido} {segundo_nombre_recibido} {primer_apellido_recibido} {segundo_apellido_recibido}</strong></li>
                <?php endif; ?>
                <li class="list-group-item">Solicitante:   <strong>{primer_nombre} {segundo_nombre} {primer_apellido} {segundo_apellido}</strong></li>
                <li class="list-group-item">Fecha solicitud:   <strong>{fecha_solicitud}</strong></li>
                <li class="list-group-item">Fecha uso:   <strong>{fecha_uso}</strong></li>
                <li class="list-group-item">Hora entrega:   <strong>{hora_entrega}</strong></li>
                <li class="list-group-item">Hora devoluci&oacute;n:   <strong>{hora_devolucion}</strong></li>
            </ul>


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
            <br>

            <form action="<?= base_url('solicitudes/cerrar/{id}') ?>" method="post">
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <div>
                        <?php echo form_error('observaciones'); ?>
                    </div>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="5" placeholder="Observaciones"></textarea>
                    <br>

                    <button type="submit" class="btn btn-danger"><strong>Confirmar cierre</strong></button>

                    <a class="logout-button pull-right" href="<?= base_url('solicitudes/recibir') ?>">
                        <button type="button" class="btn btn-primary"><strong>Volver</strong></button>
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>