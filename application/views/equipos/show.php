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
    <div class="panel-heading text-center"><strong>{title}</strong></div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="datatable">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre de Equipo</th>
                    <th class="text-center">Categor&iacute;a de Equipo</th>
                    <th class="text-center">Habilitado</th>
                    <th class="text-center">Modificar</th>
                    <th class="text-center">Eliminar</th>
                    <th class="text-center">Habilitar y Deshabilitar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($equipos as $k => $equipo): ?>
                <tr>
                    <th scope="row" class="text-center"><?= $equipo['id'] ?></th>
                    <td class="text-center"><?= $equipo['nombre_equipo'] ?></td>
                    <td class="text-center"><?= $equipo['categoria'] ?></td>
                    <td class="text-center"><?= ($equipo['habilitado'])? 'S&iacute': 'No'; ?></td>
                    <td class="text-center"><a href="<?= base_url('equipos/actualizar/' . $equipo['id']) ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
                    <td class="text-center"><a href="<?= base_url('equipos/eliminar/' . $equipo['id']) ?>"><i class="fa fa-times fa-2x"></i></a></td>
                    <?php if($equipo['habilitado']){ ?>
                        <td class="text-center"><a href="<?= base_url('equipos/deshabilitar/' . $equipo['id']) ?>"><i class="fa fa-lock fa-2x"></i></a></td>
                    <?php }else{ ?>
                        <td class="text-center"><a href="<?= base_url('equipos/habilitar/' . $equipo['id']) ?>"><i class="fa fa-unlock fa-2x"></i></a></td>
                    <?php }; ?>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a class="logout-button" href="<?= base_url('equipos/crear') ?>">
            <button type="button" class="btn btn-primary">
                <strong>Nuevo equipo</strong>
            </button>
        </a>

        <a class="logout-button pull-right" href="<?= base_url() ?>">
            <button type="button" class="btn btn-default">
                <strong>Volver al inicio</strong>
            </button>
        </a>

    </div>
</div>