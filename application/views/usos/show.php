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
    <div class="panel-heading text-center"><strong>{title}</strong></div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="datatable">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre uso</th>
                    <th class="text-center">¿Otro uso?</th>
                    <th class="text-center">Habilitado</th>
                    <th class="text-center">Modificar</th>
                    <th class="text-center">Eliminar</th>
                    <th class="text-center">Habilitar y Deshabilitar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($usos as $le_uso): ?>
                    <tr>
                        <th class="text-center"><?= $le_uso['id'] ?></th>
                        <td class="text-center"><?= $le_uso['uso'] ?></td>
                        <td class="text-center"><?= ($le_uso['otro_uso'])? "S&iacute;": "No"; ?></td>
                        <td class="text-center"><?= ($le_uso['habilitado'])? "S&iacute;": "No"; ?></td>
                        <td class="text-center"><a href="<?= base_url('usos/actualizar/' . $le_uso['id']) ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
                        <td class="text-center"><a href="<?= base_url('usos/eliminar/' . $le_uso['id']) ?>"><i class="fa fa-times fa-2x"></i></a></td>
                        <?php if($le_uso['habilitado']): ?>
                            <td class="text-center"><a href="<?= base_url('usos/deshabilitar/' . $le_uso['id']) ?>"><i class="fa fa-lock fa-2x"></i></a></td>
                        <?php else: ?>
                            <td class="text-center"><a href="<?= base_url('usos/habilitar/' . $le_uso['id']) ?>"><i class="fa fa-unlock fa-2x"></i></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <label>
            <a class="logout-button" href="<?= base_url('usos/crear') ?>">
                <button type="button" class="btn btn-success">
                    Agregar uso
                </button>
            </a>

            <a class="logout-button" href="<?= base_url() ?>">
                <button type="button" class="btn btn-warning">
                    Volver al inicio
                </button>
            </a>
        </label>
    </div>
</div>