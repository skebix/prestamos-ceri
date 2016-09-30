<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 14/04/2016
 * Time: 03:52 PM
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
    <div class="panel-heading">Lista de Servicios</div>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Servicio</th>
                <th>Categor&iacute;a del Servicio</th>
                <th>Habilitado</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
                <th>Habilitar y Deshabilitar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($servicios as $k => $servicio): ?>
                <tr>
                    <th scope="row"><?= $servicio['id'] ?></th>
                    <td><?= $servicio['nombre_servicio'] ?></td>
                    <td><?= $servicio['categoria'] ?></td>
                    <td><?= ($servicio['habilitado'])? 'S&iacute': 'No'; ?></td>
                    <td><a href="<?= base_url('servicios/actualizar/' . $servicio['id']) ?>">Actualizar</a></td>
                    <td><a href="<?= base_url('servicios/eliminar/' . $servicio['id']) ?>">Eliminar</a></td>
                    <?php if($servicio['habilitado']){ ?>
                        <td><a href="<?= base_url('servicios/deshabilitar/' . $servicio['id']) ?>">Deshabilitar</a></td>
                    <?php }else{ ?>
                        <td><a href="<?= base_url('servicios/habilitar/' . $servicio['id']) ?>">Habilitar</a></td>
                    <?php }; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<a class="logout-button" href="<?= base_url('servicios/crear') ?>">
    <button type="button" class="btn btn-primary">
        Agregar servicio
    </button>
</a>

<a class="logout-button" href="<?= base_url() ?>">
    <button type="button" class="btn btn-primary">
        Volver al home
    </button>
</a>