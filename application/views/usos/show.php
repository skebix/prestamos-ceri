<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 10:54 AM
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
    <div class="panel-heading">{title}</div>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre uso</th>
                <th>¿Otro uso?</th>
                <th>Habilitado</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
                <th>Habilitar y Deshabilitar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($usos as $le_uso): ?>
                <tr>
                    <th><?= $le_uso['id'] ?></th>
                    <td><?= $le_uso['uso'] ?></td>
                    <td><?= ($le_uso['otro_uso'])? "S&iacute;": "No"; ?></td>
                    <td><?= ($le_uso['habilitado'])? "S&iacute;": "No"; ?></td>
                    <td><a href="<?= base_url('usos/actualizar/' . $le_uso['id']) ?>">Actualizar uso</a></td>
                    <td><a href="<?= base_url('usos/eliminar/' . $le_uso['id']) ?>">Eliminar uso</a></td>
                    <?php if($le_uso['habilitado']): ?>
                        <td><a href="<?= base_url('usos/deshabilitar/' . $le_uso['id']) ?>">Deshabilitar</a></td>
                    <?php else: ?>
                        <td><a href="<?= base_url('usos/habilitar/' . $le_uso['id']) ?>">Habilitar</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<a class="logout-button" href="<?= base_url('usos/crear') ?>">
    <button type="button" class="btn btn-primary">
        Agregar uso
    </button>
</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>