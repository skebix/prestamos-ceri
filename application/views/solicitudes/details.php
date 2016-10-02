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
    <div class="panel panel-default">
        <div class="panel-heading text-center"><strong>{title}</strong></div>
        <?php if(!empty($id_recibido)): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Esta solicitud se encuentra cerrada.</strong>
                <br>
                <p><strong>Observaciones:</strong></p>
                <p>{observaciones}</p>
            </div>
        <?php endif; ?>

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
            <br>
            <div class="form-group">
                <form action="<?= base_url('solicitudes/cerrar/{id}') ?>" method="post">
                    <?php if(empty($id_recibido)): ?>
                        <button type="submit" class="btn btn-danger">Cerrar solicitud</button>
                    <?php endif; ?>
                    <a href="<?= base_url('solicitudes/listar') ?>"><button type="button" class="btn btn-warning">Volver</button></a>
                </form>
            </div>
        </div>
    </div>
</div>