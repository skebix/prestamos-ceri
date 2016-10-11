<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 09/04/2016
 * Time: 10:44 AM
 */
?>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php endif;  ?>

<?php if($this->session->flashdata('info')): ?>
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('info'); ?></strong>
    </div>
<?php endif;  ?>

<?php if($this->session->flashdata('warning')): ?>
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('warning'); ?></strong>
    </div>
<?php endif;  ?>

<?php if($this->session->flashdata('danger')): ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('danger'); ?></strong>
    </div>
<?php endif;  ?>
<br>

<div class="col-md-6 col-md-offset-3">

    <?php if(!empty($id_recibido)): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Esta solicitud se encuentra cerrada.</strong>
            <br>
        </div>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-heading text-center"><strong>{title}</strong></div>

        <div class="panel-body">

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


            <?php if(empty($id_recibido)): ?>
                <a class="logout-button" href="<?= base_url('solicitudes/cerrar/{id}') ?>">
                    <button type="button" class="btn btn-danger">
                        <strong>Cerrar solicitud</strong>
                    </button>
                </a>
            <?php endif; ?>

            <a class="logout-button pull-right" href="<?= base_url('solicitudes/listar') ?>">
                <button type="button" class="btn btn-primary">
                    <strong>Volver</strong>
                </button>
            </a>

        </div>
    </div>
</div>