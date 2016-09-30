<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 15/04/2016
 * Time: 08:25 AM
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
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre espacio</th>
            <th>Otro espacio?</th>
            <th>Habilitado</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
            <th>Habilitar y Deshabilitar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($espacios as $espacio): ?>
        <tr>
            <th scope="row"><?= $espacio['id'] ?></th>
            <td><?= $espacio['nombre_espacio'] ?></td>
            <td><?= ($espacio['otro_espacio'])? "S&iacute;": "No"; ?></td>
            <td><?= ($espacio['habilitado'])? "S&iacute;": "No"; ?></td>
            <td><a href="<?= base_url('espacios/actualizar/' . $espacio['id']) ?>">Actualizar espacio</a></td>
            <td><a href="<?= base_url('espacios/eliminar/' . $espacio['id']) ?>">Eliminar espacio</a></td>
            <?php if($espacio['habilitado']){ ?>
                <td><a href="<?= base_url('espacios/deshabilitar/' . $espacio['id']) ?>">Deshabilitar</a></td>
            <?php }else{ ?>
                <td><a href="<?= base_url('espacios/habilitar/' . $espacio['id']) ?>">Habilitar</a></td>
            <?php }; ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<br>
<a class="logout-button" href="<?= base_url('espacios/crear') ?>">
    <button type="button" class="btn btn-primary">
        Agregar espacio
    </button>
</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>