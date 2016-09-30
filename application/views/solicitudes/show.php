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

<div class="panel panel-default">
    <div class="panel-heading">Lista de solicitudes</div>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Solicitante</th>
                <th>Fecha de solicitud</th>
                <th>Fecha de uso</th>
                <th>Habilitado</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
                <th>Habilitar y Deshabilitar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($solicitudes as $k => $solicitud): ?>
                <tr>
                    <th scope="row"><?= $solicitud['id'] ?></th>
                    <td><?= $solicitud['primer_nombre'] ?> <?= $solicitud['segundo_nombre'] ?> <?= $solicitud['primer_apellido'] ?> <?= $solicitud['segundo_apellido'] ?></td>
                    <td><?= $solicitud['fecha_solicitud'] ?></td>
                    <td><?= $solicitud['fecha_uso'] ?></td>
                    <td><?= ($solicitud['habilitado'])? 'S&iacute': 'No'; ?></td>
                    <td><a href="<?= base_url('solicitudes/actualizar/' . $solicitud['id']) ?>">Actualizar</a></td>
                    <td><a href="<?= base_url('solicitudes/eliminar/' . $solicitud['id']) ?>">Eliminar</a></td>
                    <?php if($solicitud['habilitado']){ ?>
                        <td><a href="<?= base_url('solicitudes/deshabilitar/' . $solicitud['id']) ?>">Deshabilitar</a></td>
                    <?php }else{ ?>
                        <td><a href="<?= base_url('solicitudes/habilitar/' . $solicitud['id']) ?>">Habilitar</a></td>
                    <?php }; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<a class="logout-button" href="<?= base_url('solicitudes/crear') ?>">
    <button type="button" class="btn btn-primary">
        Crear solicitud
    </button>
</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>
